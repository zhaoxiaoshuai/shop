<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
恭喜您注册成功：<h3>{{ $email }}</h3>,点击<a href="{{url('home/user/okactivate/?id='.$id.'&token='.$token)}}">连接</a>立即激活，如果这不是您的邮件请忽略，很抱歉打扰您，请原谅。
</body>
</html>