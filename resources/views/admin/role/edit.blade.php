@extends('layouts.admin')
@section('content')
	@if (count($errors) > 0)
		<div class="bg-danger">
		    <ul>
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
	        <div class="widget-title am-fl">修改角色</div>
	        <div class="widget-function am-fr">
	            <a href="javascript:;" class="am-icon-cog"></a>
	        </div>
	    </div>
	    <div class="widget-body am-fr">

	        <form action="{{url('admin/role/'.$data['role_id'])}}" class="am-form tpl-form-border-form tpl-form-border-br" method="POST" >
	       		 <input type="hidden" name="_method" value="put">
	            <div class="am-form-group">
	                <label for="admin_name" class="am-u-sm-3 am-form-label">角色名</label>
	                <div class="am-u-sm-9">
	                    <input type="text" class="tpl-form-input" id="role_name" name="role_name" value="{{$data['role_name']}}" placeholder="请输入要添加的角色名">
	                    <small></small>
	                </div>
	            </div>
	            <div class="am-form-group">
	                <label for="admin_phone" class="am-u-sm-3 am-form-label">角色描述</label>
	                <div class="am-u-sm-9">
                        <textarea class="" name="role_description" rows="10" id="user-intro" placeholder="请输入角色描述">{{$data['role_description']}}</textarea>
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