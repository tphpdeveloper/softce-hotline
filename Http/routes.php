<?php


Route::group([
    'namespace' => 'Softce\Hotline\Http\Controllers',
    'prefix' => 'admin/hotline',
    'middleware' => ['web']
    ],function(){

    Route::get('/show', ['as' => 'admin.hotline.show', 'uses' => 'HotlineController@show']);
    Route::post('/create', ['as' => 'admin.hotline.create', 'uses' => 'HotlineController@create']);
    Route::get('/settings', ['as' => 'admin.hotline.settings', 'uses' => 'HotlineController@settings']);
    Route::post('/settings', ['as' => 'admin.hotline.change_settings', 'uses' => 'HotlineController@changeSettings']);

});

?>