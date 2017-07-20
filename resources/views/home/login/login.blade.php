<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>用户登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="AmazeUI-2.4.2/assets/css/amazeui.css" />
    <link href="{{asset('home/css/dlstyle.css')}}" rel="stylesheet" type="text/css"></head>
    <script src="{{asset('home/AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('layer/layer.js')}}"></script>
<body>
<div class="login-boxtitle">
    <a href="{{url('/')}}">
        <img alt="logo" src="{{ 'http://php182.oss-cn-beijing.aliyuncs.com/'.config('web.conf_logo')}}" /></a>
</div>
<div class="login-banner">
    <div class="login-main">
        <div class="login-banner-bg">
            <span></span>
            <img src="{{asset('home/images/big.jpg')}}" /></div>
        <div class="login-box">
            <h3 class="title">登录商城</h3>
            <div class="clear"></div>
            <div class="login-form">
                <form action="{{url('home/login/do')}}" method="post">
                    {{csrf_field()}}
                    <div class="user-name">
                        <label for="user">
                            <i class="am-icon-user"></i>
                        </label>
                        <input type="text" name="username" id="username" value="{{$cookie['username'] or ''}}" placeholder="邮箱/手机/用户名"></div>
                    <div class="user-pass">
                        <label for="password">
                            <i class="am-icon-lock"></i>
                        </label>
                        <input type="password"  name="user_password" id="user_password" value="{{$cookie['user_password'] or ''}}" placeholder="请输入密码"></div>
                    <div class="am-cf">
                        <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm"></div>

            </div>
            @if(session('error'))
            <script>
                layer.msg('用户不存在',{icon:5});
            </script>
            @endif
            @if(session('errors'))
                <script>
                    layer.msg('账号或密码错误',{icon:5});
                </script>
            @endif
            @if(session('activation'))
                <script>
                    layer.msg('请激活后重新登录',{icon:7});
                </script>
            @endif
            @if(session('okfindpwd'))
                <script>
                    layer.msg('修改成功',{icon:1});
                </script>
            @endif
            <div class="login-links">
                <label for="remember-me">
                    <input id="remember-me" type="checkbox" checked name="remember" >记住密码
                </label>
                <a href="{{url('home/user/findpwd')}}" class="am-fr">忘记密码</a>
                <a href="{{url('home/user/register')}}" class="zcnext am-fr am-btn-default">注册</a>
                <br />
            </div>
        </div>
    </div>
    </form>
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