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





/*==========================后台===============================*/
//管理员管理
Route::resource('admin/admin','Admin\adminController');
//角色控制器
Route::resource('admin/role','Admin\roleController');

//后台登录页
Route::get('/admin/login',function(){
	return view('admin.login');
});
//后台首页
Route::get('/admin/index',function(){
    return view('layouts.admin');
});

//友情链接
Route::resource('link','Admin\LinkController');
//系统配置
Route::resource('config','Admin\ConfController');
Route::any('upload','Admin\ConfController@upload');//LOGO图片上传
Route::any('upload2','Admin\ConfController@upload2');//缩略图片上传

// 后台商家信息路由
Route::resource('admin/astore','Admin\StoreController');
Route::get('admin/astoreindex/{x}','Admin\StoreController@astoreindex');
// 后台商家店铺路由
// Route::resource('admin/merchant','Admin\MerchantController');

// 后台分类管理
Route::resource('admin/atype','Admin\TypeController');



/*==========================前台===============================*/
// 前台首页
Route::get('/', function () {
    return view('home.index');
});

// 前台商家路由
Route::resource('home/hstore','Home\StoreController');
// 入驻市场路由
Route::get('home/MerSettled','Home\StoreController@MerSettled');