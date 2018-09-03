<?php
Route::group(['domain' => 'api'.config('app.base_url')],function() {

    Route::group(['middleware' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function () {
        Route::get('/', 'ApiController@index');

        //商家管理
        Route::group(['prefix' => 'merchantAccount', 'namespace' => 'MerchantAccount'], function () {
            Route::any('getAppInfo', 'MerchantAccountController@getAppInfo');//通过商家编码来给出appid和appsecrt
        });

        //商品推送接口
        Route::group(['prefix' => 'goods', 'namespace' => 'Goods'], function () {
            Route::any('/', 'GoodsController@index');
        });
    });

});
