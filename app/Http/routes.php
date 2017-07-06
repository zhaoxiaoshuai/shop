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

//后台登录页
Route::get('/admin/login',function(){
	return view('admin.login');
});
//后台首页
Route::get('/admin/index',function(){
    return view('admin.index');
});

//友情链接
Route::resource('link','Admin\LinkController');
//系统配置
Route::resource('config','Admin\ConfController');
Route::any('upload','Admin\ConfController@upload');//LOGO图片上传
Route::any('upload2','Admin\ConfController@upload2');//缩略图片上传


