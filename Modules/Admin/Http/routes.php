<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/{tmp?}', function($tmp = 'index'){
        $provinces = app(\App\Repositories\Area\AreaRepository::class)->getAreas();
		return view("admin::".$tmp)->with(compact('provinces'));
	});
});

Route::group(['middleware' => 'api','prefix' => 'api', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
	Route::group(['prefix' => 'login', 'namespace' => 'Login'], function(){
		Route::any('index', 'IndexController@index');
	});

	Route::group(['namespace' => 'Merchant'], function () {
        Route::resource('merchants', 'MerchantController');
    });

    Route::group(['namespace' => 'Area'], function () {
        Route::resource('areas', 'AreaController');
        Route::post('areas/list', 'AreaController@getList');
    });

});

Route::get('/upload/policy', 'Modules\Admin\Http\Controllers\UploadController@policy')->name('upload-policy');
