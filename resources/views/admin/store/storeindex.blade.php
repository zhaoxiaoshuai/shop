@extends('admin.layouts.index')

@section('content')
  <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
	<div class="widget am-cf"> 
		<div class="widget-head am-cf"> 
			<div class="widget-title am-fl">
				边框表单
			</div> 
			<div class="widget-function am-fr"> 
				<a href="javascript:;" class="am-icon-cog"></a> 
			</div> 
		</div> 
    <div class="widget-body am-fr">
    <?php 
    	$arr = ['1'=>'未审核','审核通过','审核不通过'];
    	$arr2 = ['1'=>'初级','中级','高级'];
    	$arr3 = ['1'=>'包包','配饰','内衣','运动户外','男装','女装','家电'];
     ?>
    @foreach($data as $k=> $v) 
	<form action="" method="" class="am-form tpl-form-border-form tpl-form-border-br">
	<input type="hidden" name="_method" value="put">
	{{ csrf_field() }} 
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">姓名</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['store_username'] }}" class="tpl-form-input am-margin-top-xs " id="user-name" placeholder="" /> 
			</div> 
		</div> 
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">电子邮箱</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['store_email'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">联系电话</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['store_phone'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">联系地址</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['contact_address'].$v['detailed_address'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">身份证号</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['number_id'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div>  
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">身份证正面</label> 
			<div class="am-u-sm-9"> 
				<img src="{{ $v['number_pic1'] }}">
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">身份证反面</label> 
			<div class="am-u-sm-9"> 
				<img src="{{ $v['number_pic2'] }}">
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">银行开户名</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['bank_username'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">个人银行账户</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['bank_account'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">开户银行支行名称</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['bank_name'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺名称</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['merchant_name'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺标题</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['merchant_title'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺等级</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $arr2[$v['merchant_leverl']] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺分类</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $arr3[$v['merchant_style']] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">平台使用费</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['platform_use_fee'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">商家保证金</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['store_margin'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">分成百分比</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $v['percent'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">审核意见</label> 
			<div class="am-u-sm-9"> 
				<textarea class="" name="" value="" rows="10" id="user-intro" placeholder="">{{ $v['audit_opinion'] }}</textarea> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">申请时间</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ date('Y-m-d H:i:s',$v['apply_time']) }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">审核状态</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $arr[$v['audit_status']] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		
		<div class="am-form-group"> 
			<div class="am-u-sm-9 am-u-sm-push-3"> 
				<button type="button" onclick="history.go(-1)" class="am-btn am-btn-primary tpl-btn-bg-color-success ">返回</button> 
			</div>
		</div> 
	</form>
	@endforeach 
    </div> 
	</div> 
   </div>
@endsection