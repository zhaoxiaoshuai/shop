@extends('layouts.admin')
@section('content')
@if (count($errors) > 0)
	<div class="bg-danger">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li style="background:#f0ad4e" >{{ $error }}</li>

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
	        <div class="widget-title am-fl">修改管理员</div>
	        <div class="widget-function am-fr">
	            <a href="javascript:;" class="am-icon-cog"></a>
	        </div>
	    </div>
	    <div class="widget-body am-fr">

	        <form action="{{url('admin/admin/'.$data['admin_id'])}}" class="am-form tpl-form-border-form tpl-form-border-br" method="POST" >
	        	<input type="hidden" name="_method" value="put">
	            <div class="am-form-group">
	                <label for="admin_name" class="am-u-sm-3 am-form-label">管理员名</label>
	                <div class="am-u-sm-9">
	                    <input type="text" disabled="disabled"  class="tpl-form-input" id="admin_name" name="admin_name" value="{{$data['admin_name']}}" placeholder="请输入要添加的管理员名">
	                    <small></small>
	                </div>
	            </div>
				
				
	            <div class="am-form-group">
	                <label for="admin_phone" class="am-u-sm-3 am-form-label">联系电话</label>
	                <div class="am-u-sm-9">
	                    <input type="text" class="tpl-form-input" id="admin_phone" name="admin_phone" value="{{$data['admin_phone']}}" placeholder="请输入联系电话">
	                    <small></small>
	                </div>
	            </div>
				<div class="am-form-group">
	                <label for="admin_email" class="am-u-sm-3 am-form-label">邮　　箱</label>
	                <div class="am-u-sm-9">
	                    <input type="email" class="tpl-form-input" id="admin_email" name="admin_email" value="{{$data['admin_email']}}" placeholder="请输入邮箱">
	                    <small></small>
	                </div>
	            </div>
	            <div class="am-form-group">
	                <label for="" class="am-u-sm-3 am-form-label">角　　色</label>
	                <div class="am-u-sm-9">
	                    @foreach($role as $k=>$v)
	                      <input id="admin_role{{$v['role_id']}}" 
	                      @foreach($admin_role as $kk=>$vv) 
	                     	 @if($vv['role_id'] == $v['role_id'])checked @endif
	                      @endforeach 
	                       type="checkbox" name='role_id[]' value="{{$v['role_id']}}">
	                      <label for="admin_role{{$v['role_id']}}">{{$v['role_name']}}</label>
	                    @endforeach
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