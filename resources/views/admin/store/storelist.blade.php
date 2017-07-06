@extends('admin.layouts.index')

@section('contion')
    <div class="container-fluid am-cf" style="height:120px;">
  		<form class="am-form tpl-form-border-form tpl-form-border-br"> 
   			<span>
   				<label for="user-name" class="am-u-sm-3 am-form-label">入驻商名称</label>
   				<div class="am-u-sm-9" style="width:150px;left:-580px;">
                    <input type="text" class="tpl-form-input" id="user-name" placeholder="请输入入驻商名称">
                </div>
   			</span>
   			<span style="float:right;margin-right:200px;">
   				<label for="user-phone" class="am-u-sm-3 am-form-label" style="width:100px;left:-80px;">入驻商等级</label>
   				<div class="am-u-sm-9" >
                    <select name="" style="margin-top:-30px;margin-left:-20px;">
  						<option value="" style="color:black;">请选择</option>
  						<option value="a" style="color:black;">1</option>
  						<option value="b">2</option>
  						<option value="o">3</option>
  					<select>
                </div>
   			</span>
   			<span>
   				<button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success .tpl-header-search-btn am-icon-search" style="margin-left:620px;height:33px;margin-top:-64px;">索搜</button>
   			</span>
  		</form>
    </div>

@endsection