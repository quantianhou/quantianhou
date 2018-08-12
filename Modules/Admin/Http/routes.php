<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/{tmp?}', function($tmp = 'index'){
        $provinces = app(\App\Repositories\Area\AreaRepository::class)->getAreas();
        $merchants = app(\App\Repositories\Merchant\MerchantRepository::class)->getMerchants();
		return view("admin::".$tmp)->with(compact('provinces', 'merchants'));
	});
});

Route::group(['middleware' => 'web','prefix' => 'api', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    //登陆接口
	Route::group(['prefix' => 'login', 'namespace' => 'Login'], function(){
		Route::any('index', 'IndexController@index');
	});

	//商品管理
    Route::group(['prefix' => 'goods', 'namespace' => 'Goods'], function(){
        Route::any('index', 'GoodsController@index');       //商品列表
        Route::post('save', 'GoodsController@save');        //商品添加/修改
        Route::post('detail', 'GoodsController@detail');        //商品详情
        Route::post('options', 'GoodsController@options');        //下拉框选项
        Route::post('delete', 'GoodsController@delete');        //下拉框选项
        Route::get('export','ExcelController@export');
        Route::get('import','ExcelController@import');
    });


   //商家管理
	Route::group(['namespace' => 'Merchant'], function () {
        Route::resource('merchants', 'MerchantController');
        Route::post('merchants/index', 'MerchantController@index');
    });

    //权限系统
    Route::group(['prefix' => 'rbac', 'namespace' => 'Rbac'], function(){
        Route::post('menu', 'RbacController@menu');
    });

    Route::group(['namespace' => 'Area'], function () {
        Route::resource('areas', 'AreaController');
        Route::post('areas/list', 'AreaController@getList');
    });


    //门店管理
    Route::group(['namespace' => 'ShopStore'], function () {
        Route::resource('shop_store', 'ShopStoreController');
        Route::post('shop_store/index', 'ShopStoreController@index');
    });
});

Route::get('/upload/policy', 'Modules\Admin\Http\Controllers\UploadController@policy')->name('upload-policy');
