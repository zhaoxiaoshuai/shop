<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*==========================后台===============================*/
//管理员管理
//Route::resource('admin/admin','Admin\adminController');
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::resource('admin','adminController');
    Route::resource('good','GoodController');
    Route::any('upload','GoodController@upload');
});