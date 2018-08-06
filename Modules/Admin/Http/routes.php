<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/{tmp?}', function($tmp = 'index'){
		return view("admin::".$tmp);
	});
});

Route::group(['middleware' => 'api','prefix' => 'api', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
	Route::group(['prefix' => 'login', 'namespace' => 'Login'], function(){
		Route::post('/index', 'IndexController@index');
	});
});
