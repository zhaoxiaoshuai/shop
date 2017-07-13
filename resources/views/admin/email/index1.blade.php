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
<p>您申请的店铺《{{ $merchant_name }}》审核不通过。注：【 {{ $audit_opinion }} 】</p>
<p>请点击-》<a href="{{ url('home/MerSettled') }}">『市场入驻』</a>《-重新申请</p>
</body>
</html>