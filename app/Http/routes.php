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
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
	//后台登录
	Route::get('login','LoginController@login');
	//处理登录
	Route::post('dologin','LoginController@dologin');
	//生成验证码
	Route::get('captcha/{num}.jpg','LoginController@captcha')->where('name','[0-9]+');
	//ajax判断验证码
	Route::post('proving','LoginController@proving');

	Route::group(['middleware' => 'login'],function(){
		//后台退出
		Route::get('logout','LoginController@logout');
		//后台首页
		Route::get('index','LoginController@index');
	    //管理员管理
	    Route::resource('admin','adminController');
	    //管理员修改自己信息
	    Route::get('admin/editself/{id}','adminController@editself');
	    Route::post('admin/updateself/','adminController@updateself');
	    //商品管理
	    Route::resource('good','GoodController');
	    Route::any('upload','GoodController@upload');
	    //角色控制器
	    Route::resource('role','roleController');
		//管理员管理
		Route::resource('admin','adminController');
		//订单管理
		Route::resource('orders','Orders\OrdersController');
		// 后台分类管理
		Route::resource('atype','TypeController');
	});
});

//友情链接
Route::resource('admin/link','Admin\LinkController');
//轮播图路由
Route::resource('admin/carousel','Admin\CarouselController');

//系统配置
Route::resource('admin/config','Admin\ConfController');
Route::any('admin/upload','Admin\ConfController@upload');//LOGO图片上传
Route::any('admin/upload2','Admin\ConfController@upload2');//缩略图片上传

// 商家信息路由
Route::resource('admin/astore','Admin\StoreController');
Route::get('admin/astoreindex/{x}','Admin\StoreController@astoreindex');

// 商家店铺路由
// Route::resource('admin/merchant','Admin\MerchantController');





/*==========================前台===============================*/
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

//前台首页
Route::get('/', function () {
    return view('home.index');
});

// 前台商家路由
Route::resource('home/hstore','Home\StoreController');
// 入驻市场路由
Route::get('home/MerSettled','Home\StoreController@MerSettled');
