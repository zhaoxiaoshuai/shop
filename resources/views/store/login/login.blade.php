<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amaze UI Admin index Examples</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="{{asset('admin/assets/i/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('admin/assets/i/app-icon72x72@2x.png')}}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <script src="{{asset('admin/assets/js/echarts.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('admin/assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/css/amazeui.datatables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/css/app.css')}}">
    <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('layer/layer.js')}}"></script>
     <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>
<body data-type="login">
    <script src="{{asset('admin/assets/js/theme.js')}}"></script>
    <div class="am-g tpl-g">
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        <div class="tpl-login">
            <div class="tpl-login-content">
                <div class="tpl-login-logo">
                </div>
                @if(session('error'))
                   <p style="background:#f0ad4e">  {{session('error')}}</p>
                @endif
                <form action="{{url('store/admin/dologin')}}" method="post" class="am-form tpl-form-line-form" id="myform">
                    {{csrf_field()}}
                    <div class="am-form-group">
                        <input name="store_admin_name" value="{{$cookie['store_admin_name'] or ''}}" type="text" class="tpl-form-input" id="store_admin_name" placeholder="请输入账号">
                    </div>
                    <div class="am-form-group">
                        <input name="store_admin_password" value="{{$cookie['store_admin_password'] or ''}}" type="password" class="tpl-form-input" id="store_admin_password" placeholder="请输入密码">
                    </div>
                    <div class="am-form-group">
                        <input type="text" style="float: left;width: 56%; margin-top: 10px;"  class="tpl-form-input" id="code" placeholder="请输入验证码">
                        <div style="float:right" id="imgCode" ><img id="img_img" src="{{ url('store/captcha/123.jpg') }}" alt="点击切换验证码"></div>
                    </div>

                    <div class="am-form-group tpl-login-remember-me">
                        <input id="remember-me" checked type="checkbox" name="remember" value="remember me">
                        <label for="remember-me">
                        记住密码
                         </label>
                    </div>

                    <div class="am-form-group">
                        <button type="submit"class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('admin/assets/js/amazeui.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/app.js')}}"></script>
    <script type="text/javascript">
    $(function(){
        $('#img_img').click(function(){
            $(this).attr('src','/store/captcha/'+Math.ceil(Math.random()*10000000)+'.jpg');
        })
        var flag1 = false;
        var flag2 = false;
        var flag3 = false;
        var flag4 = false;
        $('#code').blur(function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            if($(this).val()==''){
                layer.msg('验证码是必填的哦^^^^^^',{icon:5});
            }else{
                $.post('/store/admin/proving', {code: $(this).val()}, function(msg) { 
                    if (msg.status == 1) {
                        layer.msg(msg.msg,{icon:5});
                    }else{
                       flag4 = true; 
                    };
                });
            }
         })
        
        $('#myform').submit(function(){
            var name = $('#store_admin_name').val();
            var password = $('#store_admin_password').val();
            var codeval = $('#code').val();
            if(name==''){
                layer.msg('帐号是必填的哦^^^^^^',{icon:5});
                return false;
            }else{
                flag1 = true;
            }
            if(password==''){
                layer.msg('密码是必填的哦^^^^^^',{icon:5});
                return false;
            }else{
                flag2 = true;
            }
            if(codeval==''){
                layer.msg('验证码是必填的哦^^^^^^',{icon:5});
                return false;
            }else{
                flag3 = true;
            }

            if(flag1 && flag2 && flag3 && flag4){
                return true;
            }else{
                return false;
            }
            
        });
         
    });
    </script>
</body>
</html>



