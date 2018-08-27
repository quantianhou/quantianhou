<?php
Route::group(['domain' => 'api'.config('app.base_url')],function() {

    Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function () {
        Route::get('/', 'ApiController@index');
    });

});
