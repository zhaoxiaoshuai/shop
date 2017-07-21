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

/*==========================后台===============================*/
Route::resource('admin/label','Admin\LabelController');
Route::get('admin/good/setlabel/{id}','Admin\GoodController@setlabel');
Route::post('admin/good/dosetlabel','Admin\GoodController@dosetlabel');


//前缀和命名空间组
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
	//判断登录和权限中间件组
	Route::group(['middleware' =>['adminlogin','has.auth']] ,function(){
		//后台退出
		Route::get('logout','LoginController@logout');
		//后台首页
		Route::get('index','LoginController@index');
	    //管理员管理
	    Route::resource('admin','AdminController');
	    //管理员修改自己信息
	    Route::get('admin/editself/{id}','AdminController@editself');
	    Route::post('admin/updateself/','AdminController@updateself');
	    //商品管理
        //上传商品大图
        Route::any('goods/upload','GoodController@upload');
        //上传商品其他图片
        Route::any('goods/uploadpic','GoodController@uploadpic');
		//商品资源路由
	    Route::resource('good','GoodController');
        //店铺商品路由
        Route::resource('mgood','MgoodController');
        //商品详情路由
	    Route::any('good/detail/{id}','GoodController@detail');
	    //角色管理
	    Route::resource('role','RoleController');
	    //给角色授权
	    Route::get('role/roleauth/{id}','RoleController@addAuth');
	    Route::post('role/doroleauth','RoleController@doaddAuth');
		//管理员管理
		Route::resource('admin','AdminController');
		//订单管理
		Route::resource('orders','OrdersController');
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
		//轮播图图片
        Route::any('uploadcarousel','CarouselController@uploadcarousel');
		//系统配置
		Route::resource('config','ConfController');
		//权限注册
		Route::get('auth/createauth','AuthController@createauth');
		Route::resource('auth','AuthController');
		// 评论管理
		Route::controller('comment','CommentController');
		//LOGO图片上传
		Route::any('uploadconf','ConfController@uploadconf');
		// 商家信息路由
		Route::resource('astore','StoreController');
		Route::get('astoreindex/{x}','StoreController@astoreindex');
		// 后台分类管理
		Route::resource('atype','TypeController');
		// 用户管理
		Route::resource('user','UserController');
		//导航管理
        Route::resource('nav','NavController');
	});
});

/*==========================前台===============================*/
//前台首页
Route::get('/', 'Home\IndexController@index');
Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
	//前台全局搜索
	Route::post('search','SearchController@search');
	//前台登录
	Route::get('login','LoginController@login');
	Route::post('login/do','LoginController@logindo');
	//前台商品路由
	//前台商品列表页路由
	Route::any('goodlist/{id}','GoodController@goodList');
	//前台商品详情页路由
	Route::any('gooddetail/{id}','GoodController@goodDetail');
	//前台新品商品列表页路由
	Route::any('newgoodlist/{id}','GoodController@newgoodList');
	//前台用户操作
	Route::controller('user','UserController');
	//前台店铺路由
	Route::controller('merchant','MerchantController');

	//收藏
	Route::get('collection/{id}','CollectiongoodsController@Coll');
	Route::group(['middleware' =>'homelogin'] ,function(){
		// 前台收货地址
		Route::resource('address','AddressController');
		// 订单路由
		Route::get('orders/commit','OrdersController@commit');  //提交订单
		Route::post('orders/comfirm','OrdersController@comfirm');  //确认订单
		Route::get('orders/finish','OrdersController@finish');  //生成订单
		//前台个人订单显示
		Route::resource('orders','OrdersController');
		//取消订单
		Route::any('changeorders/{id}','OrdersController@changeorders');
		//确认收货
		Route::any('shouhuo/{id}','OrdersController@shouhuo');
		//去付款
		Route::any('jiesuan/{id}','OrdersController@jiesuan');
		//前台订单评价
		Route::resource('comment','CommentController');
		// 加载购物车
		Route::get('mycart/addmycart','MycartController@addmycart');
		//清空购物车
		Route::get('mycart/delete','MycartController@delete');
		Route::resource('mycart','MycartController');
		// 前台商家路由
		Route::resource('hstore','StoreController');
		// 入驻市场路由
		Route::get('MerSettled','StoreController@MerSettled');
		//入驻市场提交
		Route::post('CreateStore','StoreController@CreateStore');
		// 用户入驻市场申请页面路由1(如果用户没登录走这个路由)
		Route::get('MerApplication1','StoreController@MerApplication1');
		// 用户入驻市场申请页面路由2
		Route::get('MerApplication2','StoreController@MerApplication2');
		// 用户入驻市场申请页面路由3
		Route::get('MerApplication3','StoreController@MerApplication3');
		// 用户入驻市场申请图片上传
		Route::any('upload1','StoreController@upload1');
		Route::any('upload2','StoreController@upload2');
		//收藏详情页
		Route::resource('Collectiongoods','CollectiongoodsController');
		
		Route::get('collection1/{id}','CollectiongoodsController@Delcoll');
	});

});

/*==========================商家后台===============================*/
Route::group(['prefix'=>'store','namespace'=>'Store'],function(){
	// 商家后台登录页(用于商家中的管理员登录)
	Route::get('login2','LoginController@login2');
	// 商家后台登录 处理登录 退出 首页 修改密码
	Route::controller('admin','LoginController');
	//判断登录和权限中间件组
	Route::group(['middleware' =>['storelogin']] ,function(){
		// 商家后台店铺管理
		Route::controller('setup','MersetupController');
		// 商家后台商品管理
		Route::resource('goods','GoodsController');
		// 添加商品上传图片
		Route::any('upload','GoodsController@upload');
		// 商家后台分类管理
		Route::resource('type','TypeController');
		// 商家后台订单管理
		Route::resource('orders','OrderController');
		// 生成验证码
		Route::get('captcha/{num}.jpg','LoginController@captcha')->where('name','[0-9]+');
		// ajax判断验证码
		Route::post('proving','LoginController@proving');
		// 商家后台回复评论
		Route::controller('comment','CommentController');
		// 商家后台首页
		Route::get('index','LoginController@index');
	});
});