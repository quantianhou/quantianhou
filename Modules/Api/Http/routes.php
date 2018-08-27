<?php
Route::group(['domain' => 'api'.config('app.base_url')],function() {

    Route::group(['middleware' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function () {
        Route::get('/', 'ApiController@index');
        Route::get('/duan', function(){
            return 'PS 段工';
        });

        //商家管理
        Route::group(['prefix' => 'merchantAccount', 'namespace' => 'merchantAccount'], function () {
            Route::any('getAppInfo', 'MerchantAccountController@getAppInfo');//通过商家编码来给出appid和appsecrt
        });

    });

});
