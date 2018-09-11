<?php
namespace Modules\Api\Http\Controllers\Goods;

use App\Models\A\Store\GoodsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Api\Http\Controllers\ApiController;

class ErpCallBackController extends ApiController
{

    public function erpback(Request $request){
        file_put_contents('1.txt',var_export($_POST,true),FILE_APPEND);

        $data = $request->data;

        if(empty($data)){
            exit('success');
        }

        foreach ($data as $v){
            $store = DB::table('ewei_shop_store')->where('erp_shop_code',$v['storeNo'])->first();

            if(!$store){
                continue;
            }

            //更新门店商品
            $good = GoodsModel::where([
                ['shop_id','=',$store->id],
                ['goodssn','=',$v['goodsNo']]
            ])->first();
            $good -> productprice = $v['goodsPrice'];
            $good -> total = $v['goodsStock'];
            $good -> save();
        }

        exit('success');
    }

    //获取java库存与价格
    public function getjavadata()
    {

        //获取商户
        $merchents = DB::table('a_merchant')->get();

        foreach ($merchents as $merchent){

            //获取门店
            if(!$merchent->merchant_code){
                continue;
            }

            $shops = DB::table('ewei_shop_store')->where('a_merchant_id',$merchent->id)->get();

            foreach ($shops as $shop){

                //获取商品
                if(!$shop->erp_shop_code){
                    continue;
                }

                GoodsModel::where('shop_id',$shop->id)->chunk(100, function ($goods) use ($merchent,$shop) {

                    $ids = '';
                    foreach ($goods as $good) {
                        $ids .= $good->productsn.',';
                    }

                    //推送接口
                    $ids && self::getHttpResponseGET('http://47.98.124.157:8822/api/v1/goods_price_stock/query_goods_price_stocks?companyNo='.$merchent->merchant_code.'&storeNo='.$shop->erp_shop_code.'&goodsNo='.trim($ids,',').'&tokenUrl=http%3A%2F%2Fapi.test.ymkchen.com%2Fgoods%2Ferpback');
                });

            }
        }

        return $this->json([
            'info' => 'success'
        ]);
    }

    public static function curlOpen($url, $cfg)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if ($cfg['ssl']) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($cfg['post']));
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        //print_r($info);exit;
        curl_close($ch);

        return $result;
    }

    public static function getHttpResponseGET($url, $cacert_url = '')
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        $responseText = curl_exec($curl);
        curl_close($curl);
        return $responseText;
    }

}