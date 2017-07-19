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
//后台登录
Route::get('admin/login','Admin\LoginController@login');
//处理登录
Route::post('admin/dologin','Admin\LoginController@dologin');
//生成验证码
Route::get('admin/captcha/{num}.jpg','Admin\LoginController@captcha')->where('name','[0-9]+');
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
        //上传商品大图
        Route::any('goods/upload','GoodController@upload');
        //上传商品其他图片
        Route::any('goods/uploadpic','GoodController@uploadpic');
//        商品资源路由
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
		Route::resource('admin','adminController');
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
		//LOGO图片上传
		Route::any('uploadconf','ConfController@uploadconf');
		// 商家信息路由
		Route::resource('astore','StoreController');
		Route::get('astoreindex/{x}','StoreController@astoreindex');
		// 后台分类管理
		Route::resource('atype','TypeController');
		// 用户管理
		Route::resource('user','UserController');
	});
});

/*==========================前台===============================*/
//前台登录
Route::get('home/login','Home\LoginController@login');
Route::post('home/login/do','Home\LoginController@logindo');
//前台退出
Route::get('home/user/exit','Home\UserController@exit');
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
Route::get('home/user/mycenter','Home\UserController@mycenter');
//用户详情
Route::get('home/user/user_details','Home\UserController@user_details');

//用户评论
//Route::resource('home/user/user_comment','Home\CommentController');
//修改信息
Route::post('home/user/update','Home\UserController@update');
//头像上传
Route::post('home/user/upload','Home\UserController@upload');
//修改密码
Route::get('home/user/edit/{id}','Home\UserController@edit');
Route::post('home/user/editpassword','Home\UserController@editpassword');
Route::post('home/user/updatepassword','Home\UserController@updatepassword');
//找回密码页面
Route::get('home/user/findpwd','Home\UserController@findpwd');
//发送验证码
Route::get('home/user/dofindpwd','Home\UserController@dofindpwd');
//确认验证码
Route::post('home/user/okfindpwd','Home\UserController@okfindpwd');
//邮箱修改密码
Route::get('home/user/emailfindpwd','Home\UserController@emailfindpwd');
//确认修改密码
Route::post('home/user/findpwdok','Home\UserController@findpwdok');
//手机修改密码
Route::post('home/user/phonefindpwd','Home\UserController@phonefindpwd');
//确认手机修改密码
Route::post('home/user/phonepwdfind','Home\UserController@phonepwdfind');


//前台首页
Route::get('/', 'Home\IndexController@index');
//前台全局搜索
Route::post('home/search','Home\SearchController@search');
// 前台收货地址
Route::resource('home/address','Home\AddressController');
// 订单路由
Route::get('home/orders/commit','Home\OrdersController@commit');  //提交订单
Route::post('home/orders/comfirm','Home\OrdersController@comfirm');  //确认订单
Route::get('home/orders/finish','Home\OrdersController@finish');  //生成订单
//前台个人订单显示
Route::resource('home/orders','Home\OrdersController');
//取消订单
Route::any('home/changeorders/{id}','Home\OrdersController@changeorders');
//确认收货
Route::any('home/shouhuo/{id}','Home\OrdersController@shouhuo');
//前台订单评价
Route::resource('home/comment','Home\CommentController');
// 加载购物车
Route::get('home/mycart/addmycart','Home\MycartController@addmycart');
//清空购物车
Route::get('home/mycart/delete','Home\MycartController@delete');
Route::resource('home/mycart','Home\MycartController');





// 前台商家路由
Route::resource('home/hstore','Home\StoreController');
// 入驻市场路由
Route::get('home/MerSettled','Home\StoreController@MerSettled');
//入驻市场提交
Route::post('home/CreateStore','Home\StoreController@CreateStore');
// 用户入驻市场申请页面路由1(如果用户没登录走这个路由)
Route::get('home/MerApplication1','Home\StoreController@MerApplication1');
// 用户入驻市场申请页面路由2
Route::get('home/MerApplication2','Home\StoreController@MerApplication2');
// 用户入驻市场申请页面路由3
Route::get('home/MerApplication3','Home\StoreController@MerApplication3');
// 用户入驻市场申请图片上传
Route::any('home/upload1','Home\StoreController@upload1');
Route::any('home/upload2','Home\StoreController@upload2');
//前台商品路由
//前台商品列表页路由
Route::any('home/goodlist/{id}','Home\GoodController@goodList');
//前台商品详情页路由
Route::any('/home/gooddetail/{id}','Home\GoodController@goodDetail');
//前台新品商品列表页路由
Route::any('home/newgoodlist/{id}','Home\GoodController@newgoodList');
//前台店铺路由
Route::controller('/home/merchant','Home\MerchantController');
//收藏详情页
Route::resource('home/Collectiongoods','Home\CollectiongoodsController');
Route::get('home/collection/{id}','Home\CollectiongoodsController@collection');

////前台商品按销量排序列表页路由
//Route::any('home/salelist/{id}','Home\GoodController@saleList');

/*==========================商家后台===============================*/
// 商家后台店铺管理
Route::controller('store/setup','Store\MersetupController');
// 商家后台商品管理
Route::resource('store/goods','Store\GoodsController');
// 添加商品上传图片
Route::any('store/upload','Store\GoodsController@upload');
// 商家后台分类管理
Route::resource('store/type','Store\TypeController');
// 商家后台订单管理
Route::resource('store/orders','Store\OrderController');
// 商家后台登录 处理登录 退出 首页 修改密码
Route::controller('store/admin','Store\LoginController');
// 生成验证码
Route::get('store/captcha/{num}.jpg','Store\LoginController@captcha')->where('name','[0-9]+');
// ajax判断验证码
Route::post('store/proving','Store\LoginController@proving');
// 商家后台登录页(用于商家中的管理员登录)
Route::get('store/login2','Store\LoginController@login2');
// 商家后台回复评论

// 商家后台首页
Route::get('store/index','Store\LoginController@index');


