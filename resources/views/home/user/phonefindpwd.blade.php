<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="{{url('home/assets/css/style.css')}}" />

    <title>{{ config('web.conf_title') }}</title>
    <meta name="description" content="{{ config('web.conf_description') }}" />
    <meta name="keywords" content="{{ config('web.conf_keywords') }}" />
    <!--[if IE 6]>
    <script src="{{url('home/assets/js/iepng.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a');
    </script>
    <![endif]-->
    <script type="text/javascript" src="{{url('home/assets/js/jquery-1.11.1.min_044d0927.js')}}"></script>
    <script type="text/javascript" src="{{url('home/assets/js/jquery.bxslider_e88acd1b.js')}}"></script>

    <script type="text/javascript" src="{{url('home/assets/js/jquery-1.8.2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('home/assets/js/menu.js')}}"></script>

    <script type="text/javascript" src="{{url('home/assets/js/select.js')}}"></script>

    <script type="text/javascript" src="{{url('home/assets/js/lrscroll.js')}}"></script>

    <script type="text/javascript" src="{{url('home/assets/js/iban.js')}}"></script>
    <script type="text/javascript" src="{{url('home/assets/js/fban.js')}}"></script>
    <script type="text/javascript" src="{{url('home/assets/js/fban.js')}}"></script>
    <script type="text/javascript" src="{{url('home/assets/js/mban.js')}}"></script>
    <script type="text/javascript" src="{{url('home/assets/js/bban.js')}}"></script>
    <script type="text/javascript" src="{{url('home/assets/js/hban.js')}}"></script>
    <script type="text/javascript" src="{{url('home/assets/js/tban.js')}}"></script>
    <script src="{{asset('layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{url('home/assets/js/lrscroll_1.js')}}"></script>
    <script src="{{url('home/js/gVerify.js')}}"></script>

    <title>尤洪</title>
</head>
<body>

<!--Begin Login Begin-->
<div class="log_bg">
    <div class="top">
        <div class="logo"><a href="Index.html"><img src="{{url('home/assets/images/logo.png')}}" /></a></div>
    </div>
    <div class="login">
        <div class="log_img"><img src="{{url('home/assets/images/l_img.png')}}" width="611" height="425" /></div>
        <div class="log_c">
            <form action="{{url('home/user/phonefindpwd')}}" method="post">
                {{csrf_field()}}
                <div style="margin-top:100px;margin-left:30px;">手机用户:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$phone}}<br><br></div>
                <input type="hidden" name="user_phone" value="{{$phone}}"  />
                <div style="margin-left:30px;">手机验证码:<input type="text" style="width:140px;height:40px;font-size:20px;" name="code" id="phone_code" value="" placeholder="请输入验证码"/>
                    <div id="v_container" style="width:150px;height:50px;float:right;margin-right:69px;"></div>
                </div>
                <div style="margin:60px 60px;"><input type="submit" id="submit" value="确认" class="log_btn" /></div>
            </form>
            <script>
                $(function(){
                    var aa = false;
                    $('#phone_code').blur(function(){
                       if($('#phone_code').val() != {{$phonecode}}){
                           layer.msg('验证码错误',{icon:2});
                           return false;
                       }else{
                           aa=true;
                       }
                    });
                    $('#submit').click(function(){
                       if(aa==true){
                           return true;
                       }
                       return false;
                    });
                })
            </script>
        </div>
    </div>
</div>
<!--End Login End-->
<!--Begin Footer Begin-->
<div class="btmbg">
    <div class="btm">
        备案/许可证编号：京ICP备12009302号-1-www.surprise.com   Copyright © 2015-2018 意外网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br />
        <img src="{{url('home/assets/images/b_1.gif')}}" width="98" height="33" /><img src="{{url('home/assets/images/b_2.gif')}}" width="98" height="33" /><img src="{{url('home/assets/images/b_3.gif')}}" width="98" height="33" /><img src="{{url('home/assets/images/b_4.gif')}}" width="98" height="33" /><img src="{{url('home/assets/images/b_5.gif')}}" width="98" height="33" /><img src="{{url('home/assets/images/b_6.gif')}}" width="98" height="33" />
    </div>
</div>

</body>


<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
</html>

