<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/{tmp?}', function($tmp = 'index'){
        $provinces = app(\App\Repositories\Area\AreaRepository::class)->getAreas();
		return view("admin::".$tmp)->with(compact('provinces'));
	});
});

Route::group(['middleware' => 'web','prefix' => 'api', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    //登陆接口
	Route::group(['prefix' => 'login', 'namespace' => 'Login'], function(){
		Route::any('index', 'IndexController@index');
	});

	//商品管理
    Route::group(['prefix' => 'goods', 'namespace' => 'Login'], function(){
        Route::any('index', 'GoodsController@index');
        Route::post('save', 'GoodsController@save');
    });

	Route::group(['namespace' => 'Merchant'], function () {
        Route::resource('merchants', 'MerchantController');
    });

    //权限系统
    Route::group(['prefix' => 'rbac', 'namespace' => 'Rbac'], function(){
        Route::post('menu', 'RbacController@menu');
    });

    Route::group(['namespace' => 'Area'], function () {
        Route::resource('areas', 'AreaController');
        Route::post('areas/list', 'AreaController@getList');
    });

});

Route::get('/upload/policy', 'Modules\Admin\Http\Controllers\UploadController@policy')->name('upload-policy');
