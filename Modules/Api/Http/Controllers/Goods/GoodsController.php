<?php

namespace Modules\Api\Http\Controllers\Goods;

use App\Models\B\Goods\CategoryModel;
use App\Models\B\Uniac\UniacModel;
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
                    'error' => 2010,
                    'info' => '该商户不存在',
                    'code' => 2010
                ]);
            };

            $uniacid = $tmp->uni_account_id;
        }else{
            $uniacid = $request->uniacid;
        }



        $items = $request->items;

        $uniacInfo = $this->uniacModel->find($uniacid);

        if(!$uniacInfo){
            return $this->json([
                'error' => 2010,
                'info' => '该商户不存在',
                'code' => 2010
            ]);
        }

        if(!isset($items) || empty($items)){
            return $this->json([
                'error' => 2010,
                'info' => 'items参数缺失',
                'code' => 2010
            ]);
        }

        if(count($items) > 999){
            return $this->json([
                'error' => 2010,
                'info' => 'items最大支持999个组',
                'code' => 2010
            ]);
        }

        $success = [];

        foreach ($items as $item){

            //获取a端商品
            $where = [];
            if(isset($item['nation_sn'])){
                $where = ['nation_sn','=',$item['nation_sn']];
            }elseif(isset($item['sn'])){
                $where = ['sn','=',$item['sn']];
            }

            if(empty($where)){
                continue;
            }
            $goodsInfo = $this->goodsModel->where([
                $where
            ])->first();

            //不存在商品返回
            if(!$goodsInfo){
                continue;
            }

            //获取分类信息
            $categoryInfo = $this->goodsCategoryModel->where([
                ['category_sn','=',$goodsInfo->category_goods_sn]
            ])->first();

            //不存在分类
            if(!$categoryInfo){
                continue;
            }

            //查询b端是否有当前分类
            $bCategoryInfo = $this->bCategoryModel->firstOrCreate([
                'uniacid' => $uniacid,
                'name' => $categoryInfo->thirdCategory->first()->category_name,
                'level' => 1
            ]);

            $sign = [];
            if(isset($item['nation_sn'])){
                $sign = [
                    'productsn' => $item['nation_sn']
                ];
            }elseif(isset($item['sn'])){
                $sign = [
                    'goodssn' => $item['sn']
                ];
            }
            //导入当前商品
            $this->bGoodsModel->firstOrCreate($sign,[
                'uniacid'   => $uniacid,
                'title' => $item['name'],
                'guige' => $goodsInfo->specifications ?? '',
                'goodssn'   => $item['sn'],
                'productsn' => $item['nation_sn'],
                'productprice'  => $item['price'],
                'marketprice'   => $item['price'],
                'total' => $item['inventory'],
            ]);

            $success[] = $item;
        }

        return $this->json([
            'data' => $success,
            'info' => '请求成功',
            'code' => 2010
        ]);

    }

}
