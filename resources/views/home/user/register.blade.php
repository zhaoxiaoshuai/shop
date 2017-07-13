<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>注册</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{asset('home/AmazeUI-2.4.2/assets/css/amazeui.min.css')}}" />
    <link href="{{asset('home/css/dlstyle.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('home/AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('home/AmazeUI-2.4.2/assets/js/amazeui.min.js')}}"></script>
    <script src="{{asset('layer/layer.js')}}"></script>

</head>

<body>
<div class="login-boxtitle">
    <a href="home/demo.html">
        <img alt="" src="{{asset('home/images/logobig.png')}}" /></a>
</div>
<div class="res-banner">
    <div class="res-main">
        <div class="login-banner-bg">
            <span></span>
            <img src="{{asset('home/images/big.jpg')}}" /></div>
        <div class="login-box">
            <div class="am-tabs" id="doc-my-tabs">
                <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                    <li class="am-active">
                        <a href="">邮箱注册</a></li>
                    <li>
                        <a href="">手机号注册</a></li>
                </ul>
                <div class="am-tabs-bd">
                    <div class="am-tab-panel am-active">
                        <form action="{{url('home/user/create')}}" method="post">
                            {{csrf_field()}}
                            <div class="user-email">
                                <label for="email">
                                    <i class="am-icon-envelope-o"></i>
                                </label>
                                <input type="email" name="user_email" id="email" value="" placeholder="请输入邮箱账号">
                            </div>
                            <div class="user-pass">
                                <label for="password">
                                    <i class="am-icon-lock"></i>
                                </label>
                                <input type="password" name="user_password" id="password" value="" placeholder="设置密码"></div>
                            <div class="user-pass">
                                <label for="passwordRepeat">
                                    <i class="am-icon-lock"></i>
                                </label>
                                <input type="password" name="user_repassword" id="repassword" value="" placeholder="确认密码"></div>
                            <div class="am-cf">
                                <input type="submit" id="submit_submit" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                            </div>
                        </form>
                        <script>
                            var aa = false;
                            var bb = false;
                            var cc = false;
                            $('#email').blur(function(){
                                var res = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
                                var email = $('#email').val();
                                if(!res.test(email)){
                                    layer.msg('请输入正确的邮箱格式',{icon:5});
                                    return false;
                                }else{
                                    $.get('emailajax',{email:email},function(data){
                                        if(data.status==2){
                                            layer.msg(data.msg,{icon:5});
                                            return false;
                                        }
                                        if(data.status==1){
                                            layer.msg(data.msg,{icon:6});
                                            aa = true;
                                        }
                                    });
                                }
                            });
                            $('#password').blur(function(){
                                var res = /^[A-Za-z0-9]{6,20}$/;
                                var password = $('#password').val();

                                if(!res.test(password)){
                                    layer.msg('请输入6-18位,小写字母,大写字母,数字三种组合的密码',{icon:7});
                                    return false;
                                }else{
                                    bb = true;
                                }
                            });
                            $('#repassword').blur(function(){
                                if($('#repassword').val() != $('#password').val()){
                                    layer.msg('重复密码不一致',{icon:2});
                                    return false;
                                }else{
                                    cc = true;
                                }
                            });
                            $('#submit_submit').click(function(){
                                if($('#email').val()==''){
                                    layer.msg('邮箱不能为空',{icon:2});
                                    return false;
                                }
                                if($('#password').val()==''){
                                    layer.msg('密码不能为空',{icon:2});
                                    return false;
                                }
                                if($('#repassword').val()==''){
                                    layer.msg('确认密码不能为空',{icon:2});
                                    return false;
                                }
                                if(aa == true && bb == true && cc == true){
                                    return true;
                                } else{
                                    return false;
                                }
                                return false;
                            });
                        </script>
                        <div class="login-links">
                            <label for="reader-me">
                                <input id="reader-me" type="checkbox" checked>点击表示您同意商城《服务协议》</label>
                        </div>


                    </div>
                    <div class="am-tab-panel">
                        <form method="post" action="{{url('home/user/phonecreate')}}">
                            {{csrf_field()}}
                            <div class="user-phone">
                                <label for="phone">
                                    <i class="am-icon-mobile-phone am-icon-md"></i>
                                </label>
                                <input type="tel" name="user_phone" id="phone" placeholder="请输入手机号"></div>
                            <div class="verification">
                                <label for="code">
                                    <i class="am-icon-code-fork"></i>
                                </label>
                                <input type="tel" name="phonecode" id="phonecode" value=""  placeholder="请输入验证码">
                                <a class="btn" href="javascript:void(0);" id="sendMobileCode">
                                    <span id="dyMobileButton">获取</span></a>
                            </div>
                            <div class="user-pass">
                                <label for="password">
                                    <i class="am-icon-lock"></i>
                                </label>
                                <input type="password" name="user_password" id="apassword" value="" placeholder="设置密码"></div>
                            <div class="user-pass">
                                <label for="passwordRepeat">
                                    <i class="am-icon-lock"></i>
                                </label>
                                <input type="password" name="user_repassword" id="arepassword" value="" placeholder="确认密码"></div>
                            <div class="am-cf">
                                <input type="submit" id="submit_to" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                            </div>
                        </form>
                        <script>
                            var t1 = false;
                            var t2 = false;
                            var t3 = false;
                            $('#phone').blur(function(){
                               var res = /^1(3|4|5|7|8)\d{9}$/;
                               var phone = $('#phone').val();
                                if(phone==''){
                                    layer.msg('手机号不能为空',{icon:5});
                                    return false;
                                }
                               if(!res.test(phone)){
                                   layer.msg('请输入正确的手机号码',{icon:5});
                                   return false;
                               }
                            });
                            codeTime=null;
                            var i=60;
                            $('#dyMobileButton').click(function(){

                                if($('#phone').val() == ''){
                                    layer.msg('请输入手机号',{icon:5});
                                    return false;
                                }
                                var res = /^1(3|4|5|7|8)\d{9}$/;
                                var phone = $('#phone').val();
                                if(!res.test(phone)){
                                    layer.msg('请输入正确的手机号码',{icon:5});
                                    return false;
                                }else{
                                    // 发送ajax 注册手机号

                                    $.get('phoneajax',{phone:phone},function(msg){

                                        if(msg.code == 'no'){
                                            layer.msg(msg,{icon:5});
                                            return;
                                        }else{
                                            layer.msg(msg,{icon:6});
                                            return;
                                        }
                                    },'json');
                                    codeTime=setInterval(function() {
                                        $('#dyMobileButton').html(i);
                                        i--;

                                        if(i<0){
                                            clearInterval(codeTime);
                                            codeTime=null;
                                            i=60;
                                            $('#dyMobileButton').html('获取');

                                        }
                                    },1000);
                                }
                                return false;
                            });
                            $('#phonecode').blur(function(){
                                if($('#phonecode').val() != "{{session('phone_code')}}"){
                                    layer.msg('验证码错误',{icon:2});
                                    t1 = false;
                                }else{
                                    t1 = true;
                                }
                            });
                            $('#apassword').blur(function(){
                                var res = /^[A-Za-z0-9]{6,20}$/;
                                var password = $('#apassword').val();
                                if(!res.test(password)){
                                    layer.msg('请输入6-18位,小写字母,大写字母,数字三种组合的密码',{icon:7});
                                    t2 = false;
                                }else{
                                    t2 = true;
                                }
                            });
                            $('#arepassword').blur(function(){
                                if($('#arepassword').val() != $('#apassword').val()){
                                    layer.msg('重复密码不一致',{icon:5});
                                    t3 = false;
                                }else{
                                    t3 = true;
                                }
                            });
                            $('#submit_to').click(function(){

                                if(t1 == true && t2 == true && t3 == true){
                                    return true;
                                } else{
                                    return false;
                                }
                                return false;
                            });

                        </script>
                        @if(session('error'))
                        <script>
                            layer.msg('用户已注册',{icon:5});
                        </script>
                        @endif
                        <div class="login-links">
                            <label for="reader-me">
                                <input id="reader-me" type="checkbox" checked>点击表示您同意商城《服务协议》</label></div>

                        <hr></div>
                    <script>$(function() {
                            $('#doc-my-tabs').tabs();
                        })</script>
                </div>
            </div>
        </div>
    </div>
    <div class="footer ">
        <div class="footer-hd ">
            <p>
                <a href="# ">恒望科技</a>
                <b>|</b>
                <a href="# ">商城首页</a>
                <b>|</b>
                <a href="# ">支付宝</a>
                <b>|</b>
                <a href="# ">物流</a></p>
        </div>
        <div class="footer-bd ">
            <p>
                <a href="# ">关于恒望</a>
                <a href="# ">合作伙伴</a>
                <a href="# ">联系我们</a>
                <a href="# ">网站地图</a>
                <em>© 2015-2025 Hengwang.com 版权所有</em></p>
        </div>
    </div>
</body>

</html>