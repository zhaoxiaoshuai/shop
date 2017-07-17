@extends('layouts.admin')
@section('content')
	@if (count($errors) > 0)
		<div class="bg-danger">
		    <ul  style="background:#f0ad4e">
		        @foreach ($errors->all() as $error)
		            <li>{{ $error }}</li>
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
	        <div class="widget-title am-fl">权限注册</div>
	        <div class="widget-function am-fr">
	            <a href="javascript:;" class="am-icon-cog"></a>
	        </div>
	    </div>
	    <div class="widget-body am-fr">
	        <form action="{{url('admin/auth')}}" class="am-form tpl-form-border-form tpl-form-border-br" method="POST" >
	        	<div class="am-form-group">
	                <label for="auth_name" class="am-u-sm-3 am-form-label">权限组名称</label>
	                <div class="am-u-sm-9">
	                    <input type="text" class="tpl-form-input" id="auth_name" name="auth_name" value="{{$data['auth_name']}}" disabled="disabled">
	                    <small></small>
	                </div>
	            </div>

				<input type="hidden" name="auth_group" value="{{$data['auth_id']}}">

	            <div class="am-form-group">
	                <label for="auth_name" class="am-u-sm-3 am-form-label">权限名称</label>
	                <div class="am-u-sm-9">
	                    <input type="text" class="tpl-form-input" id="auth_name" name="auth_name" value="{{old('auth_name')}}" placeholder="请输入要添加的权限名称">
	                    <small></small>
	                </div>
	            </div>
	            <div class="am-form-group">
	                <label for="auth_content" class="am-u-sm-3 am-form-label">权限内容</label>
	                <div class="am-u-sm-9">
	                    <input type="text" class="tpl-form-input" id="auth_content" name="auth_content" value="{{old('auth_content')}}" placeholder="请输入要添加的权限内容">
	                    <small></small>
	                </div>
	            </div>
	            <div class="am-form-group">
	                <div class="am-u-sm-9 am-u-sm-push-3">
	                <input type="submit"  class="am-btn am-btn-primary tpl-btn-bg-color-success " value="提交" >
	                </div>
	            </div>
	            {{ csrf_field() }}
	        </form>
	    </div>
	</div>
</div>

@endsection