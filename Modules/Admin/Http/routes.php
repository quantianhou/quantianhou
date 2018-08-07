<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/{tmp?}', function($tmp = 'index'){
		return view("admin::".$tmp);
	});
});

Route::group(['middleware' => 'web','prefix' => 'api', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    //登陆
    Route::group(['prefix' => 'login', 'namespace' => 'Login'], function(){
        Route::post('index', 'IndexController@index');

        Route::resource('merchants', 'MerchantController');
    });

    //权限系统
    Route::group(['prefix' => 'rbac', 'namespace' => 'Rbac'], function(){
        Route::post('menu', 'RbacController@menu');
    });
});
