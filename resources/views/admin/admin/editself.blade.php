@extends('layouts.admin')
@section('content')
	@if (count($errors) > 0)
		<div class="bg-danger">
		    <ul>
		        @foreach ($errors->all() as $error)

		            <li  style="background:#f0ad4e"  >{{ $error }}</li>

		        @endforeach
		    </ul>
		</div>
	@endif
	@if(session('error'))
	   <p style="background:#f0ad4e">  {{session('error')}}</p>
	@endif
 <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
	<div class="widget am-cf">
	    <div class="widget-head am-cf">
	        <div class="widget-title am-fl">添加管理员</div>
	        <div class="widget-function am-fr">
	            <a href="javascript:;" class="am-icon-cog"></a>
	        </div>
	    </div>
	    <div class="widget-body am-fr">

	        <form action="{{url('admin/admin/updateself')}}" class="am-form tpl-form-border-form tpl-form-border-br" method="POST" >
	        		<input type="hidden" name="admin_id" value="{{$data['admin_id']}}">
	            <div class="am-form-group">
	                <label for="admin_name" class="am-u-sm-3 am-form-label">账户名</label>
	                <div class="am-u-sm-9">
	                    <input type="text" class="tpl-form-input" id="admin_name" name="admin_name" value="{{$data['admin_name']}}" disabled="disabled">
	                    <small></small>
	                </div>
	            </div>
	            <div class="am-form-group">
	                <label for="oldpassword" class="am-u-sm-3 am-form-label">旧密码</label>
	                <div class="am-u-sm-9">
	                    <input type="password" class="tpl-form-input" id="oldpassword" name="oldpassword" value="" placeholder="请旧密码">
	                    <small></small>
	                </div>
	            </div>
				<div class="am-form-group">
	                <label for="admin_password" class="am-u-sm-3 am-form-label">新密码</label>
	                <div class="am-u-sm-9">
	                    <input type="password" class="tpl-form-input" id="admin_password" name="admin_password" value="" placeholder="请输入新密码">
	                    <small></small>
	                </div>
	            </div>
	            <div class="am-form-group">
	                <label for="repassword" class="am-u-sm-3 am-form-label">重复密码</label>
	                <div class="am-u-sm-9">
	                    <input type="password" class="tpl-form-input" id="repassword" name="repassword" value="" placeholder="重复输入新密码">
	                    <small></small>
	                </div>
	            </div>
	            <div class="am-form-group">
	                <div class="am-u-sm-9 am-u-sm-push-3">
	                <input type="submit"  class="am-btn am-btn-primary tpl-btn-bg-color-success " value="修改" >
	                </div>
	            </div>
	            {{ csrf_field() }}
	        </form>
	    </div>
	</div>
</div>

@endsection