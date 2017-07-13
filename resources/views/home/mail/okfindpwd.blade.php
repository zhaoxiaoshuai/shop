<!doctype html>
<html lang="en">
<head
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link type="text/css" rel="stylesheet" href="{{ asset('home/css/button.css') }}" />
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
    <title>重置密码</title>
</head>
<body>
<div class="m_right">
    {{--<div style="float: left;width: 793px;padding-bottom: 20px;overflow: hidden;padding-left: 15px;padding-top: 20px;" id="per_content_wrap">--}}
    <div style="border-top: 1px solid #dfdfdf;border-left: 1px solid #dfdfdf;">
        <div style="height: 40px;background-color: #f9f9f9;padding-left: 10px;line-height: 40px;font-weight: 700;">用户密码</div>
        <div class="content_form">
            <div style="margin:0px auto;width:400px;"  >
                <form action="{{url('home/user/findpwdok')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="token" value="{{$token}}">
                    <input type="hidden" name="id" value="{{$id}}">
                    <p style="\margin-top:40px;">
                        <span style="font-size:15px;">新密码&nbsp;</span>
                        <input type="password" style="width: 280px;height: 25px;border: 2px solid #dfdfdf;"  id="xpass" value="" name="newpassword">
                        <span class="password-complex"></span>
                        <input type="hidden" class="passComplexLevel">
                        <span></span>
                    </p>
                    <p style="margin-top:40px;">
                        <span style="font-size:15px;">确认密码</span>
                        <input type="password" style="width: 280px;height: 25px;border: 2px solid #dfdfdf;"  id="repass" name="repassword">
                        <span></span>
                    </p>
                    <button id="button" type="submit" style="margin:70px auto;width:100px;height:30px;background-color: #f46;border: none;color: #fff;">确认</button>
                </form>
                </divstyle>
            </div>
        </div>
        {{--</div>--}}
    </div>
    <script>
        var bb = false;
        var cc = false;
        $('#xpass').blur(function(){
            var res = /^[A-Za-z0-9]{6,20}$/;
            var password = $('#xpass').val();
            if(!res.test(password)){
                layer.msg('请输入6-18位,小写字母,大写字母,数字三种组合的密码',{icon:7});
                return false;
            }else{
                bb = true;
            }
        });
        $('#repass').blur(function(){
            if($('#repass').val() != $('#xpass').val()){
                layer.msg('重复密码不一致',{icon:2});
                return false;
            }else{
                cc = true;
            }
        });
        $('#button').click(function(){
            if(aa == true && bb == true && cc == true){
                return true;
            }
            return false;
        });
    </script>

</body>
</html>