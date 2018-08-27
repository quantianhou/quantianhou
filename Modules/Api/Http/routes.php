<?php
Route::group(['domain' => 'api'.config('app.base_url')],function() {

    Route::group(['middleware' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function () {
        Route::get('/', 'ApiController@index');
        Route::get('/duan', function(){
            return 'PS 段工';
        });

    });

});
