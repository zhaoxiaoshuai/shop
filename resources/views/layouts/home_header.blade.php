<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="{{ asset('home/assets/css/style.css') }}" />

    <link type="text/css" rel="stylesheet" href="{{ asset('home/css/button.css') }}" />
    <title>{{ config('web.conf_title') }}</title>
    <meta name="description" content="{{ config('web.conf_description') }}" />
    <meta name="keywords" content="{{ config('web.conf_keywords') }}" />
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
    <!--[if IE 6]>
    <script src="js/iepng.js" type="text/javascript"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a');
    </script>
    <![endif]-->
    <script type="text/javascript" src="{{ asset('home/assets/js/jquery-1.11.1.min_044d0927.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/jquery.bxslider_e88acd1b.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/jquery-1.8.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/menu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/iban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/fban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/f_ban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/mban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/bban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/hban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/tban.js') }}"></script>
    <script src="{{asset('layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/lrscroll_1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/js/PCASClass.js') }}"></script>
    <link type="text/css" rel="stylesheet" href="{{asset('home/assets/css/style.css')}}" />
    <script type="text/javascript" src="{{asset('home/assets/js/jquery-1.8.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/assets/js/menu.js')}}"></script>
    <link rel="stylesheet" href="{{asset('home/css/layui.css')}}"  media="all">
    <script type="text/javascript" src="{{asset('home/assets/js/lrscroll_1.js')}}"></script>
    <script src="{{asset('home/js/layui.js')}}" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('home/assets/css/ShopShow.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('home/assets/css/MagicZoom.css')}}" />
    <script type="text/javascript" src="{{asset('home/assets/js/MagicZoom.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/assets/js/num.js')}}">
        var jq = jQuery.noConflict();
    </script>
    <script type="text/javascript" src="{{asset('home/assets/js/p_tab.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/assets/js/shade.js')}}"></script>
</head>
<body>
<!--Begin Header Begin-->
<div class="soubg">
    <div class="sou">
        <!--Begin 所在收货地区 Begin-->
        <span class="s_city_b">
        	<span class="fl"><a href="{{ url('') }}"><b>首页</b></a></span>
        </span>
        <!--End 所在收货地区 End-->
             @if(session('logins'))
                <span class="fl" style="margin-left:400px">
                    欢迎 : <a style="color:#C40D0D;" href="{{url('home/user/userdetails')}}">{{session('deta_name')}}</a> &nbsp;&nbsp;&nbsp;
                    <a href="{{url('home/user/exit')}}">退出</a>
                    &nbsp;|&nbsp;<a href="{{ url('home/orders') }}">我的订单</a>&nbsp;|
                </span>
            @else
                <span class="fl" style="margin-left:400px">你好，请<a href="{{url('home/login')}}">登录</a>&nbsp;
                <a href="{{url('home/user/register')}}" style="color:#ff4e00;">免费注册</a>

                </span>
             @endif
             @if(session('exit'))
                <script>
                    layer.msg('已退出',{icon:1});
                </script>
             @endif
        	<span class="ss">
            	<div class="ss_list">
                	<a href="#">收藏夹</a>
                    <div class="ss_list_bg">
                    	<div class="s_city_t"></div>
                        <div class="ss_list_c">
                        	<ul>
                            	<li><a href="{{url('home/Collectiongoods')}}">我的收藏夹</a></li>
                            </ul>
                        </div>
                    </div>     
                </div>
               <div class="ss_list">
                	<a href="javascript:void(0)">我的小店</a>
                    <div class="ss_list_bg">
                        <div class="s_city_t"></div>
                        <div class="ss_list_c">
                            <ul>
                                <li><a href="{{ url('store/admin/login') }}">管理后台</a></li>
                                <li><a href="{{ url('home/MerSettled') }}">市场入驻</a></li>
                                <li><a href="javascript:void(0)">商家社区</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

        </span>
    </div>
</div>

