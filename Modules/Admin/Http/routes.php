<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/{tmp?}', function($tmp = 'index'){
        $provinces = app(\App\Repositories\Area\AreaRepository::class)->getAreas();
        $merchants = app(\App\Repositories\Merchant\MerchantRepository::class)->getMerchants();
        if(in_array($tmp, ["merchantAccount"])){
            $merchantNoAccounts = app(\App\Repositories\Merchant\MerchantRepository::class)->getMerchantNoAccounts();
            //dd(\DB::getQueryLog());exit;
            return view("admin::".$tmp)->with(compact('merchantNoAccounts'));
        }
        if(in_array($tmp, ["merchant_account_list"])){
            $merchantAccounts = app(\App\Repositories\MerchantAccount\MerchantAccountRepository::class)->getMerchantAccounts();
            return view("admin::".$tmp)->with(compact('merchantAccounts'));
        }
		return view("admin::".$tmp)->with(compact('provinces', 'merchants'));
	});
});

Route::group(['middleware' => 'web','prefix' => 'api', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    //登陆接口
	Route::group(['prefix' => 'login', 'namespace' => 'Login'], function(){
		Route::any('index', 'IndexController@index');
        Route::any('logout', 'IndexController@logout');
        Route::any('getUser', 'IndexController@getUser');
	});

	//商品管理
    Route::group(['prefix' => 'goods', 'namespace' => 'Goods'], function(){
        Route::any('index', 'GoodsController@index');       //商品列表
        Route::post('save', 'GoodsController@save');
    });


   //商家管理
	Route::group(['namespace' => 'Merchant'], function () {
        Route::resource('merchants', 'MerchantController');
        Route::post('merchants/index', 'MerchantController@index');
        Route::post('merchants/getOne', 'MerchantController@getOne');
    });

    //商家管理
	Route::group(['namespace' => 'MerchantAccount'], function () {
        Route::resource('merchantAccount', 'MerchantAccountController');
        Route::post('merchantAccount/index', 'MerchantAccountController@index');
        Route::post('merchantAccount/add', 'MerchantAccountController@add');//添加商家B端账号
        Route::post('merchantAccount/resetPasswd', 'MerchantAccountController@resetPasswd');//重置商家B端账号密码
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
