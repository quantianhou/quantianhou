<?php
Route::group(['domain' => 'admin'.config('app.base_url')],function() {

    Route::group(['middleware' => 'web', 'namespace' => 'Modules\Admin\Http\Controllers'], function () {
        Route::get('/{tmp?}', function ($tmp = 'index') {
            $provinces = app(\App\Repositories\Area\AreaRepository::class)->getAreas();
            $merchants = app(\App\Repositories\Merchant\MerchantRepository::class)->getMerchants();
            if (in_array($tmp, ["merchantAccount"])) {
                $where[] = ['a_merchant.status', '=', 7];
                $merchantNoAccounts = app(\App\Repositories\Merchant\MerchantRepository::class)->getMerchantNoAccounts(['a_merchant.id', 'a_merchant.merchant_name'], $where);
                //dd(\DB::getQueryLog());exit;
                return view("admin::" . $tmp)->with(compact('merchantNoAccounts'));
            }
            if (in_array($tmp, ["merchant_account_list"])) {
                $where[] = ['users.uid', '>', 1];
                $where[] = ['a_merchant.status', '=', 7];
                $merchantAccounts = app(\App\Repositories\MerchantAccount\MerchantAccountRepository::class)->getMerchantAccounts(['*'], $where);
                return view("admin::" . $tmp)->with(compact('merchantAccounts'));
            }
            return view("admin::" . $tmp)->with(compact('provinces', 'merchants'));
        });
    });

    Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'Modules\Admin\Http\Controllers'], function () {
        //登陆接口
        Route::group(['prefix' => 'login', 'namespace' => 'Login'], function () {
            Route::any('index', 'IndexController@index');
            Route::any('logout', 'IndexController@logout');
            Route::any('getUser', 'IndexController@getUser');
        });

        //商品管理
        Route::group(['prefix' => 'goods', 'namespace' => 'Goods'], function () {
            Route::any('index', 'GoodsController@index');       //商品列表
            Route::post('save', 'GoodsController@save');        //商品添加/修改
            Route::post('detail', 'GoodsController@detail');        //商品详情
            Route::post('options', 'GoodsController@options');        //下拉框选项
            Route::post('delete', 'GoodsController@delete');        //下拉框选项
            Route::post('export', 'ExcelController@export');
            Route::any('pullimg', 'ExcelController@pullImg');
            Route::post('import', 'ExcelController@import');
            Route::post('import/extra', 'ExcelController@extra');
            Route::post('import/category', 'ExcelController@category');
            Route::post('images', 'GoodsController@images');
            Route::get('tmp', 'ExcelController@tmp');
            Route::post('select/{type}', 'GoodsController@select');
        });


        //商家管理
        Route::group(['namespace' => 'Merchant'], function () {
            Route::resource('merchants', 'MerchantController');
            Route::post('merchants/index', 'MerchantController@index');
            Route::post('merchants/getOne', 'MerchantController@getOne');//编辑页面读取商家信息用
            Route::post('merchants/applyCheck', 'MerchantController@applyCheck');
            Route::post('merchants/getMerchants', 'MerchantController@getMerchants');
            Route::post('merchants/checkMerchants', 'MerchantController@checkMerchants');//审核商家
            Route::post('merchants/signing', 'MerchantController@signing');//签约
            Route::post('merchants/cancel', 'MerchantController@cancel');//取消签约

        });

        //商家管理
        Route::group(['namespace' => 'MerchantAccount'], function () {
            //Route::resource('merchantAccount', 'MerchantAccountController');
            Route::post('merchantAccount/index', 'MerchantAccountController@index');
            Route::post('merchantAccount/add', 'MerchantAccountController@add');//添加商家B端账号
            Route::post('merchantAccount/resetPasswd', 'MerchantAccountController@resetPasswd');//重置商家B端账号密码
            Route::get('merchantAccount/getAppInfo', 'MerchantAccountController@getAppInfo');//通过商家编码来给出appid和appsecrt
        });

        //权限系统
        Route::group(['prefix' => 'rbac', 'namespace' => 'Rbac'], function () {
            Route::post('menu', 'RbacController@menu');
        });

        Route::group(['namespace' => 'Area'], function () {
            Route::resource('areas', 'AreaController');
            Route::post('areas/list', 'AreaController@getList');
            Route::post('areas/getListByParentName', 'AreaController@getListByParentName');
        });


        //门店管理
        Route::group(['namespace' => 'ShopStore'], function () {
            Route::resource('shop_store', 'ShopStoreController');
            Route::post('shop_store/index', 'ShopStoreController@index');
            Route::post('shop_store/info', 'ShopStoreController@info');
            Route::post('shop_store/cancel', 'ShopStoreController@cancel');
            Route::post('shop_store/signing', 'ShopStoreController@signing');
            Route::post('shop_store/signing_info', 'ShopStoreController@singingInfo');
        });
    });

    Route::get('/upload/policy', 'Modules\Admin\Http\Controllers\UploadController@policy')->name('upload-policy');
});