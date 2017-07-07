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




/*==========================后台===============================*/
//后台登录
Route::get('admin/login','Admin\LoginController@login');
//处理登录
Route::post('admin/dologin','Admin\LoginController@dologin');
//生成验证码
Route::get('admin/captcha/{num}.jpg','Admin\LoginController@captcha')->where('name','[0-9]+');

//管理员管理
Route::resource('admin/admin','Admin\adminController');

//角色控制器
Route::resource('admin/role','Admin\roleController');
//商品管理
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::resource('admin','adminController');
    Route::resource('good','GoodController');
    Route::any('upload','GoodController@upload');
});
//订单管理
Route::resource('admin/orders','Admin\Orders\OrdersController');
//友情链接
Route::resource('link','Admin\LinkController');

//系统配置
Route::resource('config','Admin\ConfController');
Route::any('upload','Admin\ConfController@upload');//LOGO图片上传
Route::any('upload2','Admin\ConfController@upload2');//缩略图片上传

// 商家信息路由
Route::resource('admin/astore','Admin\StoreController');
Route::get('admin/astoreindex/{x}','Admin\StoreController@astoreindex');

// 商家店铺路由
// Route::resource('admin/merchant','Admin\MerchantController');
// 前台商家路由
Route::resource('hstore','Home\StoreController');
// 后台分类管理
Route::resource('admin/atype','Admin\TypeController');






