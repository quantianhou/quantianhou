<?php

namespace Modules\Api\Http\Controllers\Goods;

use App\Models\B\Goods\CategoryModel;
use App\Models\B\Uniac\UniacModel;
use App\Models\Category\ThirdModel;
use App\Models\Goods\GoodsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Api\Http\Controllers\ApiController;
use App\Models\Category\GoodsModel as GoodsCategoryModel;
use App\Models\B\Goods\GoodsModel as BGoodsModel;

class GoodsController extends ApiController
{

    public function __construct(
        GoodsModel $goodsModel,
        GoodsCategoryModel $goodsCategoryModel,
        UniacModel $uniacModel,
        CategoryModel $bCategoryModel,
        BGoodsModel $bGoodsModel
    )
    {
        parent::__construct();
        $this->goodsModel = $goodsModel;
        $this->goodsCategoryModel = $goodsCategoryModel;
        $this->uniacModel = $uniacModel;
        $this->bCategoryModel = $bCategoryModel;
        $this->bGoodsModel = $bGoodsModel;
    }

    /**
     * 商品同步
     */
    public function index(Request $request){

        if(!isset($request->uniacid)){
            //通过code获取uniacid
            $merchant_code = $request->merchant_code;

            if(!$merchant_code){
                return $this->json([
                    'error' => 2010,
                    'info' => '缺少商户code',
                    'code' => 2010
                ]);
            }
            $tmp = DB::table('b_users_uniaccount_relationship')->where([
                ['merchant_code','=',$merchant_code]
            ])->first();

            if(!$tmp){
                return $this->json([
                    'error' => 2011,
                    'info' => '该商户不存在',
                    'code' => 2011
                ]);
            };

            $uniacid = $tmp->uni_account_id;
        }else{
            $uniacid = $request->uniacid;
        }



        $items = $request->items;
        file_put_contents('duan.txt',var_export($items,true),FILE_APPEND);

        $uniacInfo = $this->uniacModel->find($uniacid);

        if(!$uniacInfo){
            return $this->json([
                'error' => 2012,
                'info' => '该商户不存在',
                'code' => 2012
            ]);
        }

        if(!isset($items) || empty($items)){
            return $this->json([
                'error' => 2013,
                'info' => 'items参数缺失',
                'code' => 2013
            ]);
        }

        if(count($items) > 999){
            return $this->json([
                'error' => 2014,
                'info' => 'items最大支持999个组',
                'code' => 2014
            ]);
        }

        $success = [];

        foreach ($items as $item){

            $item['goodsCode'] = $item['goodsCode'] ?? $item['goodscode'];
            $item['barCode'] = $item['barCode'] ?? $item['barcode'];
            $item['goodsName'] = $item['goodsName'] ?? $item['goodsname'];
            $item['goodsRetailPrice'] = $item['goodsRetailPrice'] ?? $item['goodsretailprice'];
            $item['goodsStock'] = $item['goodsStock'] ?? $item['goodsstock'];

            if(isset($item['barCode']) && $item['barCode']){
                //获取a端商品
                $goodsInfo = $this->goodsModel->where([
                    ['nation_sn','=',$item['barCode']]
                ])->first();

                //不存在商品返回
                if(!$goodsInfo){
                    continue;
                }

                $clist = ThirdModel::get();
                $clist->map(function ($item) use($uniacid){
                    $bCategoryInfo = $this->bCategoryModel->firstOrCreate([
                        'uniacid' => $uniacid,
                        'name' => $item->category_name,
                        'level' => 1
                    ]);
                });

            }

            //导入当前商品
            if(isset($item['barCode']) && $item['barCode']){
                $this->bGoodsModel->firstOrCreate([
                    'productsn' => $item['barCode']
                ],[
                    'uniacid'   => $uniacid,
                    'title' => $item['goodsName']??'',
//                'guige' => $goodsInfo->specifications ?? '',
                    'goodssn'   => $item['goodsCode']??'',
                    'productsn' => $item['barCode']??'',
                    'productprice'  => $item['goodsRetailPrice']??'',
                    'marketprice'   => $item['goodsRetailPrice']??'',
                    'total' => $item['goodsStock']??'',
                ]);
            }else{
                $this->bGoodsModel->firstOrCreate([
                    'goodssn' => $item['goodsCode']??''
                ],[
                    'uniacid'   => $uniacid,
                    'title' => $item['goodsName']??'',
//                'guige' => $goodsInfo->specifications ?? '',
                    'goodssn'   => $item['goodsCode']??'',
                    'productsn' => $item['barCode']??'',
                    'productprice'  => $item['goodsRetailPrice']??'',
                    'marketprice'   => $item['goodsRetailPrice']??'',
                    'total' => $item['goodsStock']??'',
                ]);
            }
 

            $success[] = $item;
        }

        return $this->json([
            'data' => 200,
            'info' => '请求成功',
            'code' => 200
        ]);

    }

    public function test(){
        $list = ThirdModel::get();
        $list->map(function ($item){
            $bCategoryInfo = $this->bCategoryModel->firstOrCreate([
                'uniacid' => $uniacid,
                'name' => $item->category_name,
                'level' => 1
            ]);
        });
    }

}
