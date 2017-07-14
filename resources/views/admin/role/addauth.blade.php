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
	        <div class="widget-title am-fl">角色授权</div>
	        <div class="widget-function am-fr">
	            <a href="javascript:;" class="am-icon-cog"></a>
	        </div>
	    </div>
	    <div class="widget-body am-fr">

	        <form action="{{url('admin/role/doroleauth')}}" class="am-form tpl-form-border-form tpl-form-border-br" method="POST" >
	        	<input type="hidden" name="role_id" value="{{$role['role_id']}}">
	            <div class="am-form-group">
	                <label for="role_name" class="am-u-sm-3 am-form-label">角色名</label>
	                <div class="am-u-sm-9">
	                    <input type="text" class="tpl-form-input" disabled="disabled" id="role_name" name="role_name" value="{{$role['role_name']}}">
	                    <small></small>
	                </div>
	            </div>
				 <div class="am-form-group">
	                <table style="margin-left: 150px;width:86%;" border=1>
	                    <tbody>
	                    @foreach($arr as $k => $v)	
	                        <tr class="gradeX">
	                            <td style="width: 160px;">
	                            	{{$v}}
	                            </td>
	                            <td>
	                            	@foreach($auth[$k] as $kk =>$vv)
	                            	<div style="float:left;width:200px;height:30px" >
	                            		<input type="checkbox"
											@if(in_array($vv['auth_id'],$id)) checked @endif
	                            		 name="auth_id[]" value="{{$vv['auth_id']}}" >&nbsp;&nbsp;{{$vv['auth_name']}}
	                            	</div>
	                            	@endforeach
	                            </td>
	                        </tr> 
	                    @endforeach
	                    </tbody>
	                </table>
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