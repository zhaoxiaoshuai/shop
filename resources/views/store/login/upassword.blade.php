@extends('layouts.StoreAdmin')

@section('content')

  <div class="row"> 
   <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
    <div class="widget am-cf"> 
     <div class="widget-head am-cf"> 
      <div class="widget-title am-fl">
       修改密码
      </div> 
      <div class="widget-function am-fr"> 
       <a href="javascript:;" class="am-icon-cog"></a> 
      </div> 
     </div> 
     <div class="widget-body am-fr"> 
      <form action="{{ url('store/admin/dopassword') }}" method="post" class="am-form tpl-form-line-form"> 
      <input type="hidden" name="store_admin_id" value="{{ $store_admin['store_admin_id'] }}">
      {{csrf_field()}}
      <div class="am-form-group"> 
        <label for="user-name" class="am-u-sm-3 am-form-label">管理员</label> 
        <div class="am-u-sm-9"> 
         <input type="text" value="{{ $store_admin['store_admin_name'] }}" readonly class="tpl-form-input" id="user-name"/> 
        </div> 
       </div> 
       <div class="am-form-group"> 
        <label for="user-name" class="am-u-sm-3 am-form-label">原密码</label> 
        <div class="am-u-sm-9"> 
         <input type="text" name="pwd" class="tpl-form-input" id="user-name" placeholder="请输入原密码" /> 
        </div> 
       </div> 
       <div class="am-form-group"> 
        <label for="user-name" class="am-u-sm-3 am-form-label">新密码</label> 
        <div class="am-u-sm-9"> 
         <input type="text" name="newpwd" class="tpl-form-input" id="user-name" placeholder="请输入新密码" /> 
        </div> 
       </div>
       <div class="am-form-group"> 
        <label for="user-name" class="am-u-sm-3 am-form-label">确认新密码</label> 
        <div class="am-u-sm-9"> 
         <input type="text" name="rnewpwd" class="tpl-form-input" id="user-name" placeholder="请确认新密码" /> 
        </div> 
       </div>
       <div class="am-form-group"> 
        <div class="am-u-sm-9 am-u-sm-push-3"> 
         <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">修改</button> 
        </div> 
       </div> 
      </form> 
     </div> 
    </div> 
   </div> 
  </div>

@endsection