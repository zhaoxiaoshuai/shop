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
        <div class="logo" style="width:270px;height:115px;"><a href="Index.html"><img src="{{ 'http://php182.oss-cn-beijing.aliyuncs.com/'.config('web.conf_logo') }}" /></a></div>
    </div>
    <div class="login">
        <div class="log_img"><img src="{{url('home/assets/images/l_img.png')}}" width="611" height="425" /></div>
        <div class="log_c">
            @if(session('okemail'))
                <script>
                    layer.msg('邮件已发送',{icon:1});
                </script>
            @endif
                @if(session('reemail'))
                    <script>
                        layer.msg('地址失效请重新发送邮件',{icon:5});
                    </script>
                @endif
            <form action="{{url('home/user/okfindpwd')}}" method="post">
                {{csrf_field()}}
                <div style="margin-top:100px;margin-left:30px;">用户名:<input type="text" name="user" value="" id="user" class="l_user" placeholder="请输入邮箱 | 手机号"/><br><br></div>
                <div style="margin-left:30px;">验证码:<input type="text" style="width:140px;height:40px;font-size:20px;" name="code" id="code_input" value="" placeholder="请输入验证码"/>
                    <div id="v_container" style="width:150px;height:50px;float:right;margin-right:69px;"></div>
                </div>
                <div style="margin:60px 60px;"><input type="submit" id="submit" value="确认" class="log_btn" /></div>
            </form>
            <script>
                var aa = false;
                var bb = false;
                var verifyCode = new GVerify("v_container");
                $('#code_input').blur(function(){
                    var res = verifyCode.validate(document.getElementById("code_input").value);
                    if(res){
                        layer.msg('正确',{icon:1});
                        aa = true;
                    }else{
                        layer.msg("验证码错误",{icon:2});
                        return false;
                    }
                })
                $('#user').blur(function(){
                    var user = $('#user').val();
                    $.get('{{url('home/user/dofindpwd')}}',{user:user},function(data){
                        if(data==2){
                            layer.msg('请输入正确账号',{icon:5});
                            return false;
                        }else{
                            bb = true;
                        }
                    });
                })
                $('#submit').click(function(){
                    if($('#user').val()==""){
                        layer.msg('请输入邮箱',{icon:7});
                        return false;
                    }
                    if($('#code_input').val()==''){
                        layer.msg('请输入验证码',{icon:7});
                        return false;
                    }
                    if(aa == true && bb == true){
                        return true;
                    }else{
                        return false;
                    }
                    return false;
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

