@extends('layouts.StoreAdmin')

@section('content')
  <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
	<div class="widget am-cf"> 
		<div class="widget-head am-cf"> 
			<div class="widget-title am-fl">
				店铺基本信息
			</div> 
			<div class="widget-function am-fr"> 
				<a href="javascript:;" class="am-icon-cog"></a> 
			</div> 
		</div> 
    <div class="widget-body am-fr">
   
    
	<form action="" method="post" class="am-form tpl-form-border-form tpl-form-border-br">
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺logo</label>
			<div class="am-u-sm-9"> 
				<img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $data['merchant_logo'] }}" style="width:70px;height:70px;">
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺名称</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['merchant_name'] }}" class="tpl-form-input am-margin-top-xs " id="user-name" placeholder="" /> 
			</div> 
		</div> 
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺标题</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['merchant_title'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺关键字</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['merchant_keywords'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺头部图片</label>
			<div class="am-u-sm-9"> 
				<img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $data['merchant_pic'] }}" style="width:708px;height:150px;">
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">客服QQ</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['service_qq'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">客服电话</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['service_phone'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺等级</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $arr4[$data['merchant_leverl']] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺类型</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $arr1[$data['merchant_style']] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺信用</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['merchant_credit'] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">店铺状态</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $arr3[$data['merchant_status']] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-phone" class="am-u-sm-3 am-form-label">店铺营业状态</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $arr2[$data['close_merchant']] }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">关闭店铺的原因</label> 
			<div class="am-u-sm-9"> 
				<textarea class="" name="" value="{{ $data['close_reason'] }}" rows="10" id="user-intro" placeholder=""></textarea> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">创建店铺时间</label>
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ date('Y-m-d H:i:s',$data['merchant_ctime']) }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">修改店铺时间</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ date('Y-m-d H:i:s',$data['merchant_utime']) }}" class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
	</form>
    </div> 
	</div> 
   </div>
@endsection
