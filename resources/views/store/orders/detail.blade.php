@extends('layouts.StoreAdmin')

@section('content')
  <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
	<div class="widget am-cf"> 
		<div class="widget-head am-cf"> 
			<div class="widget-title am-fl">
				订单详细信息
			</div> 
			<div class="widget-function am-fr"> 
				<a href="javascript:;" class="am-icon-cog"></a> 
			</div> 
		</div> 
    <div class="widget-body am-fr">
    <?php
        			$arr = ['1'=>'一般订单','加急订单'];
        			$arr2 = ['1'=>'下单未发货','出库,未收货','收货完成','作废'];
        		?>
	<form action="" method="" class="am-form tpl-form-border-form tpl-form-border-br">
	<input type="hidden" name="_method" value="put">
	{{ csrf_field() }} 
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">商品名称</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['good_name'] }}" disabled class="tpl-form-input am-margin-top-xs " id="user-name" placeholder="" /> 
			</div> 
		</div> 
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">商品图片</label> 
			<div class="am-u-sm-9"> 
				<img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $data['good_pic'] }}" style="width:200px;height:100px;">
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">商品数量</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['order_cnt'] }}" disabled class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">商品价格</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['good_price'] }}" disabled class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">下单时间</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ date('Y-m-d H:i:s',$data['order_time']) }}" disabled class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">订单号</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $orders_id }}" disabled class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">订单类型</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $arr[$data['order_type']] }}" disabled class="tpl-form-input" id="user-name" placeholder="" /> 
			</div>  
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">订单总金额</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['order_total'] }}" disabled class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">收货人</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['order_linkman'] }}" disabled class="tpl-form-input" id="user-name" placeholder=""  /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">联系电话</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['order_phone'] }}" disabled class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">收货地址</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['order_address'] }}" disabled class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">买家留言</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $data['order_msg'] }}" disabled class="tpl-form-input" id="user-name" placeholder="" /> 
			</div> 
		</div>
		
		<div class="am-form-group"> 
			<label for="user-name" class="am-u-sm-3 am-form-label">订单状态</label> 
			<div class="am-u-sm-9"> 
				<input type="text" name="" value="{{ $arr2[$data['order_status']] }}" disabled class="tpl-form-input" id="user-name" placeholder="" /> 
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