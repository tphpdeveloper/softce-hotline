<?php


Route::group([
    'namespace' => 'Softce\Hotline\Http\Controllers',
    'prefix' => 'admin/hotline',
    'middleware' => ['web']
    ],function(){

    Route::get('/create', ['as' => 'admin.hotline.create', 'uses' => 'HotlineController@create']);

});

?>