<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="{{ asset('home/assets/css/style.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('home/css/button.css') }}" />
    <title>{{ config('web.conf_title') }}</title>
    <meta name="description" content="{{ config('web.conf_description') }}" />
    <meta name="keywords" content="{{ config('web.conf_keywords') }}" />
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

    <script type="text/javascript" src="{{ asset('home/assets/js/select.js') }}"></script>

    <script type="text/javascript" src="{{ asset('home/assets/js/lrscroll.js') }}"></script>

    <script type="text/javascript" src="{{ asset('home/assets/js/iban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/fban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/f_ban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/mban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/bban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/hban.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/tban.js') }}"></script>
    <script src="{{asset('layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{ asset('home/assets/js/lrscroll_1.js') }}"></script>



</head>
<body>
<!--Begin Header Begin-->
<div class="soubg">
    <div class="sou">
        <!--Begin 所在收货地区 Begin-->
        <span class="s_city_b">
        	<span class="fl">送货至：</span>
            <span class="s_city">
            	<span>四川</span>
                <div class="s_city_bg">
                	<div class="s_city_t"></div>
                    <div class="s_city_c">
                    	<h2>请选择所在的收货地区</h2>
                        <table border="0" class="c_tab" style="width:235px; margin-top:10px;" cellspacing="0" cellpadding="0">
                          <tr>
                            <th>A</th>
                            <td class="c_h"><span>安徽</span><span>澳门</span></td>
                          </tr>
                          <tr>
                            <th>B</th>
                            <td class="c_h"><span>北京</span></td>
                          </tr>
                          <tr>
                            <th>C</th>
                            <td class="c_h"><span>重庆</span></td>
                          </tr>
                          <tr>
                            <th>F</th>
                            <td class="c_h"><span>福建</span></td>
                          </tr>
                          <tr>
                            <th>G</th>
                            <td class="c_h"><span>广东</span><span>广西</span><span>贵州</span><span>甘肃</span></td>
                          </tr>
                          <tr>
                            <th>H</th>
                            <td class="c_h"><span>河北</span><span>河南</span><span>黑龙江</span><span>海南</span><span>湖北</span><span>湖南</span></td>
                          </tr>
                          <tr>
                            <th>J</th>
                            <td class="c_h"><span>江苏</span><span>吉林</span><span>江西</span></td>
                          </tr>
                          <tr>
                            <th>L</th>
                            <td class="c_h"><span>辽宁</span></td>
                          </tr>
                          <tr>
                            <th>N</th>
                            <td class="c_h"><span>内蒙古</span><span>宁夏</span></td>
                          </tr>
                          <tr>
                            <th>Q</th>
                            <td class="c_h"><span>青海</span></td>
                          </tr>
                          <tr>
                            <th>S</th>
                            <td class="c_h"><span>上海</span><span>山东</span><span>山西</span><span class="c_check">四川</span><span>陕西</span></td>
                          </tr>
                          <tr>
                            <th>T</th>
                            <td class="c_h"><span>台湾</span><span>天津</span></td>
                          </tr>
                          <tr>
                            <th>X</th>
                            <td class="c_h"><span>西藏</span><span>香港</span><span>新疆</span></td>
                          </tr>
                          <tr>
                            <th>Y</th>
                            <td class="c_h"><span>云南</span></td>
                          </tr>
                          <tr>
                            <th>Z</th>
                            <td class="c_h"><span>浙江</span></td>
                          </tr>
                        </table>
                    </div>
                </div>
            </span>
        </span>
        <!--End 所在收货地区 End-->
             @if(session('logins'))
                <span class="fl" style="margin-left:400px">
                    会员 : <a href="{{url('home/user/mycenter')}}">{{session('deta_name')}}</a> &nbsp;&nbsp;&nbsp;
                    <a href="{{url('home/user/exit')}}">退出</a>
                    &nbsp;|&nbsp;<a href="#">我的订单</a>&nbsp;|
                </span>
            @else
                <span class="fl" style="margin-left:400px">你好，请<a href="{{url('home/login')}}">登录</a>&nbsp;
                <a href="{{url('home/user/register')}}" style="color:#ff4e00;">免费注册</a>

                &nbsp;|&nbsp;<a href="#">我的订单</a>&nbsp;|
                </span>
             @endif
        	<span class="ss">
            	<div class="ss_list">
                	<a href="#">收藏夹</a>
                    <div class="ss_list_bg">
                    	<div class="s_city_t"></div>
                        <div class="ss_list_c">
                        	<ul>
                            	<li><a href="#">我的收藏夹</a></li>
                                <li><a href="#">我的收藏夹</a></li>
                            </ul>
                        </div>
                    </div>     
                </div>
                <div class="ss_list">
                	<a href="#">客户服务</a>
                    <div class="ss_list_bg">
                    	<div class="s_city_t"></div>
                        <div class="ss_list_c">
                        	<ul>
                            	<li><a href="#">客户服务</a></li>
                                <li><a href="#">客户服务</a></li>
                                <li><a href="#">客户服务</a></li>
                            </ul>
                        </div>
                    </div>    
                </div>|

                <div class="ss_list">
                	<a href="#">网站导航</a>
                    <div class="ss_list_bg">
                    	<div class="s_city_t"></div>
                        <div class="ss_list_c">
                        	<ul>
                            	<li><a href="#">网站导航</a></li>
                                <li><a href="#">网站导航</a></li>
                            </ul>
                        </div>
                    </div>    
                </div>
            </span>
            <div class="ss_list">
                	<a href="javascript:void(0)">我的小店</a>
                    <div class="ss_list_bg">
                    	<div class="s_city_t"></div>
                        <div class="ss_list_c">
                        	<ul>
                            	<li><a href="javascript:void(0)">管理后台</a></li>
                                <li><a href="javascript:void(0)">市场入驻</a></li>
                                <li><a href="javascript:void(0)">商家社区</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <span class="fr">|&nbsp;<a href="#">手机版&nbsp;<img src="{{ asset('home/assets/images/s_tel.png') }}" align="absmiddle" /></a></span>
        </span>
    </div>
</div>

