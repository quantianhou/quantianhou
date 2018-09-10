<?php
namespace Modules\Api\Http\Controllers\Goods;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Api\Http\Controllers\ApiController;

class ErpCallBackController extends ApiController
{

    public function erpback(){
        file_put_contents('1.txt',var_export($_POST,true),FILE_APPEND);
        echo 'success';
    }

    //获取java库存与价格
    public function getjavadata()
    {

//        $res = self::getHttpResponseGET('http://47.98.124.157:8822/api/v1/goods_price_stock/query_goods_price_stocks?companyno=100003&storeno=3123&goodsno=614245&tokenUrl=http%3A%2F%2Fapi.test.ymkchen.com%2Fgoods%2Ferpback');
        $res = self::getHttpResponseGET('http://47.98.124.157:8822/api/v1/goods_price_stock/query_goods_price_stocks?companyNo=100003&storeNo=3123&goodsNo=614245&tokenUrl=http%3A%2F%2Fapi.test.ymkchen.com%2Fgoods%2Ferpback');

//        $res = self::curlOpen('http://47.98.124.157:8822/api/v1/goods_price_stock/query_goods_price_stocks', [
//            'post' => [
//                'companyno' => 100003,
//                'goodsno' => 3123,
//                'goodsno' => 614245
//            ]
//        ]);
        print_r(json_decode($res, true));
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