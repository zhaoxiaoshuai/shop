@extends('layouts.admin')

@section('content')
  <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
	<div class="widget am-cf"> 
		<div class="widget-head am-cf"> 
			<div class="widget-title am-fl">
				入驻商户申请详细信息
			</div> 
			<div class="widget-function am-fr"> 
				<a href="javascript:;" class="am-icon-cog"></a> 
			</div> 
		</div> 
    <div class="widget-body am-fr">
   
    
	<form action="{{ url('admin/astore/'.$data['store_id']) }}" method="post" class="am-form tpl-form-border-form tpl-form-border-br">
	<input type="hidden" name="_method" value="put">
	{{ csrf_field() }} 
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">姓名</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['store_username'] }}" class="tpl-form-input am-margin-top-xs " id="user-name" placeholder="" /> 
			</div> 
		</div> 
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">电子邮箱</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['store_email'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">联系电话</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['store_phone'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">联系地址</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['contact_address'].$data['detailed_address'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">身份证号</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['number_id'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div>  
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">身份证正面</label> 
			<div class="am-u-sm-9"> 
				<img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $data['number_pic1'] }}" style="width:200px;height:100px;">
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">身份证反面</label> 
			<div class="am-u-sm-9"> 
				<img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $data['number_pic2'] }}" style="width:200px;height:100px;">
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">银行开户名</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['bank_username'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">个人银行账户</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['bank_account'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">开户银行支行名称</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['bank_name'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺名称</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['merchant_name'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺标题</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['merchant_title'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺等级</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $arr2[$data['merchant_leverl']] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺分类</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $arr3[$data['merchant_style']] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">平台使用费</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['platform_use_fee'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">商家保证金</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['store_margin'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">分成百分比</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['percent'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">审核意见</label> 
			<div class="am-u-sm-9"> 
				<textarea class="" name="audit_opinion" value="" rows="10" id="user-intro" placeholder="审核意见由审核人填写返回给商户">{{ $data['audit_opinion'] }}</textarea> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">申请时间</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ date('Y-m-d H:i:s',$data['apply_time']) }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-phone" class="am-u-sm-3 am-form-label">审核状态</label> 
			<div class="am-u-sm-9"> 
			<select name="audit_status" style="color:black;">
				<option value="1">未审核</option>
				<option value="2">审核通过</option>
				<option value="3">审核不通过</option>
			</select>
			</div> 
		</div>
		<div class="am-form-group"> 
			<div class="am-u-sm-9 am-u-sm-push-3"> 
				<button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button> 
			</div>
		</div>
		<div class="am-form-group"> 
			<div class="am-u-sm-9 am-u-sm-push-3"> 
				<button type="button" onclick="history.go(-1)" class="am-btn am-btn-primary tpl-btn-bg-color-success ">返回</button> 
			</div>
		</div> 
	</form>
    </div> 
	</div> 
   </div>
@endsection
