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
DB::listen(function($sql, $bindings, $time) {
                // dump($sql);
                // dump($bindings);
            });

Route::get('/', function () {
    return view('welcome');
});

// 大后台商家信息路由
Route::resource('admin/astore','Admin\StoreController');
Route::get('admin/astoreindex/{x}','Admin\StoreController@astoreindex');
// 大后台商家店铺路由
// Route::resource('admin/merchant','Admin\MerchantController');
// 前台商家路由
Route::resource('hstore','Home\StoreController');
