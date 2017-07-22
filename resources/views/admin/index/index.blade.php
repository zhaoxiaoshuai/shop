@extends('layouts.admin')
@section('content')

	<h1><p style="background:#f0ad4e">{{session('success')}}</p></h1>

<div class="result_wrap" style="margin-top:50px;margin-left:50px">
	<div class="result_title">
		<h3>系统基本信息</h3>
	</div>
	<div class="result_content" style="margin-left:30px">
		<ul>
			<li style="margin:10px 0px;">
				<label style="margin-right:100px;">操作系统</label><span>{{ PHP_OS }}</span>
			</li>
			<li  style="margin:10px 0px;">
				<label style="margin-right:100px;">运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
			</li>

			<li style="margin:10px 0px;">
				<label style="margin-right:60px;">静静设计-版本</label><span>v-0.1</span>
			</li>
			<li style="margin:10px 0px;">
				<label style="margin-right:65px;">上传附件限制</label><span><?php echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"; ?></span>
			</li>
			<li style="margin:10px 0px;">
				<label style="margin-right:95px;">北京时间</label><span>{{date('Y-m-d H:i:s',time())}}</span>
			</li>
			<li style="margin:10px 0px;">
				<label style="margin-right:55px;">服务器域名/IP</label><span>{{$_SERVER['SERVER_NAME']}} [ {{$_SERVER['SERVER_ADDR']}} ]</span>
			</li>
			<li style="margin:10px 0px;">
				<label style="margin-right:130px;">Host</label><span>{{$_SERVER['SERVER_ADDR']}}</span>
			</li>
		</ul>
	</div>
</div>


<div class="result_wrap" style="margin-top:50px;margin-left:50px">
	<div class="result_title">
		<h3>使用帮助</h3>
	</div>
	<div class="result_content"  style="margin-left:30px">
		<ul>
			<li style="margin:10px 0px;">
				<label style="margin-right:70px;">交流网站：</label><span><a href="#">http://bbs.itxdl.cn</a></span>
			</li>
			<li style="margin:10px 0px;">
				<label style="margin-right:65px;">交流QQ群：</label><span><a href="#"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png"></a></span>
			</li>
		</ul>
	</div>
</div>
<!--结果集列表组件 结束-->


@endsection