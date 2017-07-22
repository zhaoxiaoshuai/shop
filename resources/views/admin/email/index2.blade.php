<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	#one
	{
		font-size:20px;
		font-weight:bold;
	}
</style>
<body>
<span id="one">Hello！:</span>
<span>{{ $store_username }}</span>
<p>您申请的店铺《{{ $merchant_name }}》审核通过。注：【 {{ $audit_opinion }}】</p>
<p>请点击-》<a href="{{ url('home/MerSettled') }}">『管理后台』</a>《-进行管理</p>
</body>
</html>
