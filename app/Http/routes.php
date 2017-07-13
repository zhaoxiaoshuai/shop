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
	//没有权限返回页面
	Route::get('back',function(){
    	return view('errors.403');
	});
	//后台登录
	Route::get('login','LoginController@login');
	//处理登录
	Route::post('dologin','LoginController@dologin');
	//生成验证码
	Route::get('captcha/{num}.jpg','LoginController@captcha')->where('name','[0-9]+');
	//ajax判断验证码
	Route::post('proving','LoginController@proving');

	Route::group(['middleware' =>['login','has.auth']] ,function(){
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
	    Route::any('good/detail/{id}','GoodController@detail');
	    //角色管理
	    Route::resource('role','RoleController');
	    //给角色授权
	    Route::get('role/roleauth/{id}','RoleController@addAuth');
	    Route::post('role/doroleauth','RoleController@doaddAuth');
		//管理员管理
		Route::resource('admin','adminController');
		//订单管理
		Route::resource('orders','Orders\OrdersController');
		// 后台分类管理
		Route::resource('atype','TypeController');
		// 用户管理
		Route::resource('user','UserController');
		//订单详情
		Route::resource('detail','DetailController');
		// 商家管理
		Route::resource('astore','StoreController');
		Route::get('astoreindex/{x}','StoreController@astoreindex');
		//友情链接
		Route::resource('link','LinkController');
		//轮播图路由
		Route::resource('carousel','CarouselController');
		//系统配置
		Route::resource('config','ConfController');
		//权限注册
		Route::resource('auth','AuthController');
		Route::any('uploadconf','ConfController@uploadconf');//LOGO图片上传
	});
});

// 商家店铺路由
// Route::resource('admin/merchant','Admin\MerchantController');

/*==========================前台===============================*/
//前台登录
Route::get('home/login','Home\LoginController@login');
Route::post('home/login/do','Home\LoginController@logindo');

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

//个人中心
Route::get('home/user/user_details','Home\UserController@user_details');
//用户评论
Route::resource('home/user/user_comment','Home\CommentController');
//前台首页
Route::get('/', 'Home\IndexController@index');
//前台全局搜索
Route::post('home/search','Home\SearchController@search');


// 前台商家路由
// 用户提交申请信息路由
Route::post('home/CreateStore','Home\StoreController@CreateStore');
// 用户入驻市场路由
Route::get('home/MerSettled','Home\StoreController@MerSettled');
// 用户入驻市场申请页面路由1(如果用户没登录走这个路由)
Route::get('home/MerApplication1','Home\StoreController@MerApplication1');
// 用户入驻市场申请页面路由2
Route::get('home/MerApplication2','Home\StoreController@MerApplication2');
// 用户入驻市场申请页面路由3
Route::get('home/MerApplication3','Home\StoreController@MerApplication3');
// 用户入驻市场申请图片上传
Route::any('home/upload1','Home\StoreController@upload1');
Route::any('home/upload2','Home\StoreController@upload2');


/*==========================商家后台===============================*/
// 商家后台商品管理
Route::resource('store/goods','Store\GoodsController');
// 添加商品上传图片
Route::any('store/upload','Store\GoodsController@upload');
// 商家后台分类管理
Route::resource('store/type','Store\TypeController');
// 商家后台订单管理
Route::resource('store/orders','Store\OrderController');
// 商家后台登录
Route::get('store/login','Store\LoginController@login');
// 处理登录
Route::post('store/dologin','Store\LoginController@dologin');
// 生成验证码
Route::get('store/captcha/{num}.jpg','Store\LoginController@captcha')->where('name','[0-9]+');
// ajax判断验证码
Route::post('store/proving','Store\LoginController@proving');
// 商家后台首页
Route::get('store/index','Store\LoginController@index');



