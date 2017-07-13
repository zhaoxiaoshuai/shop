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
	        <div class="widget-title am-fl">权限修改</div>
	        <div class="widget-function am-fr">
	            <a href="javascript:;" class="am-icon-cog"></a>
	        </div>
	    </div>
	    <div class="widget-body am-fr">

	        <form action="{{url('admin/auth/'.$data['auth_id'])}}" class="am-form tpl-form-border-form tpl-form-border-br" method="POST" >
	        <input type="hidden" name="_method" value="put">
	            <div class="am-form-group">
	                <label for="auth_name" class="am-u-sm-3 am-form-label">权限名称</label>
	                <div class="am-u-sm-9">
	                    <input type="text" class="tpl-form-input" id="auth_name" name="auth_name" value="{{$data['auth_name']}}">
	                    <small></small>
	                </div>
	            </div>
	            <div class="am-form-group">
	                <label for="auth_content" class="am-u-sm-3 am-form-label">权限内容</label>
	                <div class="am-u-sm-9">
	                    <input type="text" class="tpl-form-input" id="auth_content" name="auth_content" value="{{$data['auth_content']}}">
	                    <small></small>
	                </div>
	            </div>
	            <div class="am-form-group">
	                <label for="auth_description" class="am-u-sm-3 am-form-label">权限描述</label>
	                <div class="am-u-sm-9">
                        <textarea class="" name="auth_description" rows="10" id="auth_description">{{$data['auth_description']}}</textarea>
                    </div>
	            </div>
				<div class="am-form-group">
	                <label for="user-phone" class="am-u-sm-3 am-form-label">权 限 组</label>
	                <div class="am-u-sm-9">
	                    <select data-am-selected="{searchBox: 0}" name="auth_group" style="display: none;">
	                   	@foreach($arr as $k=>$v)
	                      <option  @if($data['auth_group'] == $k) selected @endif value="{{$k}}">{{$v}}</option>
						@endforeach
	                    </select>
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