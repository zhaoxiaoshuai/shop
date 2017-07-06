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
Route::resource('admin/admin','Admin\adminController');


//前台登录
Route::get('home/login','Home\LoginController@login');

//前台用户注册
Route::get('home/user/register','Home\UserController@register');

//发送邮箱Ajax
Route::get('home/user/emailajax','Home\UserController@emailajax');
//激活邮箱
Route::get('home/user/activate','Home\UserController@activate');
Route::get('home/user/okactivate','Home\UserController@okactivate');

//发送手机Ajax
Route::get('home/user/phoneajax','Home\UserController@phoneajax');


//邮箱添加用户
Route::post('home/user/create','Home\UserController@create');
//手机添加用户
Route::post('home/user/phonecreate','Home\UserController@phonecreate');
Route::get('home/user/phonecreateto','Home\UserController@phonecreateto');