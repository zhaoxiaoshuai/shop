<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="{{asset('layer/layer.js')}}"></script>
</head>
<body>
@if(session('error'))
    <script>
        layer.msg('链接失效请重新发送邮件',{icon:5});
    </script>
    @endif
@if(session('errors'))
    <script>
        layer.msg('请重新发送邮件',{icon:5});
    </script>
@endif
蘑菇街商城：
<div style="background-color:#d0d0d0;background-image:url(http://weixin.qq.com/zh_CN/htmledition/images/weixin/letter/mmsgletter_2_bg.png);text-align:center;padding:40px;">
    <div class="mmsgLetter" style="width:580px;margin:0 auto;padding:10px;color:#333;background-color:#fff;border:0px solid #aaa;border-radius:5px;-webkit-box-shadow:3px 3px 10px #999;-moz-box-shadow:3px 3px 10px #999;box-shadow:3px 3px 10px #999;font-family:Verdana, sans-serif; ">

        <div class="mmsgLetterHeader" style="height:23px;background:url(http://weixin.qq.com/zh_CN/htmledition/images/weixin/letter/mmsgletter_2_bg_topline.png) repeat-x 0 0;">

        </div>
        <div class="mmsgLetterContent" style="text-align:left;padding:30px;font-size:14px;line-height:1.5;background:url(http://weixin.qq.com/zh_CN/htmledition/images/weixin/letter/mmsgletter_2_bg_wmark.jpg) no-repeat top right;">

            <div>

                <p class="salutation" style="font-weight:bold;">
                    Hi,{{ $email }}：
                </p>
                <p>请点击以下链接，重置密码：<br>
                <a href="{{url('home/user/emailfindpwd/?id='.$id.'&token='.$token)}}">http://www.lamp.com/home/user/findpwd</a><br><br>如果这不是您的邮件请忽略，很抱歉打扰您，请原谅。</p>
            </div>
        </div>
        <div class="mmsgLetterFooter" style="margin:16px;text-align:center;font-size:12px;color:#888;text-shadow:1px 0px 0px #eee;">
        </div>
    </div>
</div>
</body>
</html>