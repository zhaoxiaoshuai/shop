@extends('layouts.admin')
@section('content')
<div class="row" >
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-fl" >
                    订单信息 
                </div>
                <div class="widget-function am-fr">
                    <a href="javascript:;" class="am-icon-cog">
                    </a>
                </div>
            </div>
            <div class="widget-body am-fr">
            	<div class="result_title">
		            
		            @if(session('error'))
		              <p style="background:#f0ad4e">  {{session('error')}}</p>
		            @endif
        		</div>
                <form class="am-form tpl-form-border-form tpl-form-border-br" action="{{url('admin/orders/'.$data->order_id)}}" method="post" >
                <input type="hidden" name="_method" value="put">
                {{csrf_field()}}
                    <div class="am-form-group" >
                        <label for="user-name"  class="am-u-sm-3 am-form-label" >
                            订单号
                        </label>
                        <div class="am-u-sm-9">
                            <input type="text" disabled class="tpl-form-input" id="user-name" name="order_id" value="{{$data->order_id}}">
                        </div>
                    </div>
                    <div class="am-form-group" >
                        <label for="user-name" class="am-u-sm-3 am-form-label" >
                            订单类型
                        </label>
                        <div class="am-u-sm-9">
                            <input type="text" disabled class="tpl-form-input" id="user-name" name="order_type" value="{{$data->order_type}}">
                        </div>
                    </div>
                    <div class="am-form-group" >
                        <label for="user-name" class="am-u-sm-3 am-form-label" >
                            下单人
                        </label>
                        <div class="am-u-sm-9">
                            <input type="text" disabled class="tpl-form-input" id="user-name" name="user_id" value="{{$data->user_name}}">
                        </div>
                    </div>
                     <div class="am-form-group" >
                        <label for="user-name" class="am-u-sm-3 am-form-label" >
                            下单时间
                        </label>
                        <div class="am-u-sm-9">
                            <input type="text" disabled class="tpl-form-input" id="user-name" name="order_time" value="{{date('Y-m-d H:i:s',$data->order_time)}}">
                        </div>
                    </div>
                     <div class="am-form-group" >
                        <label for="user-name" class="am-u-sm-3 am-form-label" >
                            收货人
                        </label>
                        <div class="am-u-sm-9">
                            <input type="text"  class="tpl-form-input" id="user-name" name="order_linkman" value="{{$data->order_linkman}}">
                        </div>
                    </div>
                     <div class="am-form-group" >
                        <label for="user-name" class="am-u-sm-3 am-form-label" >
                            收货地址
                        </label>
                        <div class="am-u-sm-9">
                            <input type="text"  class="tpl-form-input" id="user-name" name="order_address" value="{{$data->order_address}}">
                        </div>
                    </div>
                     <div class="am-form-group" >
                        <label for="user-name" class="am-u-sm-3 am-form-label" >
                            总金额
                        </label>
                        <div class="am-u-sm-9">
                            <input type="text" disabled class="tpl-form-input" id="user-name" name="order_total" value="{{$data->order_total}}">
                        </div>
                    </div>
                     <div class="am-form-group" >
                        <label for="user-name" class="am-u-sm-3 am-form-label" >
                            商品数量
                        </label>
                        <div class="am-u-sm-9">
                            <input type="text" disabled class="tpl-form-input" id="user-name" name="order_cnt" value="{{$data->order_cnt}}">
                        </div>
                    </div>
                     <div class="am-form-group" >
                        <label for="user-name" class="am-u-sm-3 am-form-label" >
                            联系电话
                        </label>
                        <div class="am-u-sm-9">
                            <input type="text"  class="tpl-form-input" id="user-name" name="order_phone" value="{{$data->order_phone}}">
                        </div>
                    </div>
                    <div class="am-form-group" >
                        <label for="user-name" class="am-u-sm-3 am-form-label" >
                            商家
                        </label>
                        <div class="am-u-sm-9">
                            <input type="text" disabled class="tpl-form-input" id="user-name" name="order_source" value="{{$data->order_source}}">
                        </div>
                    </div>
                   	<div class="am-form-group" >
                        <label for="user-name" class="am-u-sm-3 am-form-label" >
                            订单状态
                        </label>
                        <div class="am-u-sm-9">
                            <input type="radio"  class="tpl-form-input" id="user-name" name="order_status" @if($data->order_status=='1') checked @endif value="1"> 下单未发货
                            <input type="radio"  class="tpl-form-input" id="user-name" name="order_status" @if($data->order_status=='2') checked @endif value="2" > 出库,未发货
                            <input type="radio"  class="tpl-form-input" id="user-name" name="order_status" @if($data->order_status=='3') checked @endif value="3"> 收货完成
                            <input  type="radio"  class="tpl-form-input" id="user-name"  name="order_status" @if($data->order_status=='4') checked @endif value="4"> 作废
                            <input  type="radio"  class="tpl-form-input" id="user-name"  name="order_status" @if($data->order_status=='5') checked @endif value="5"> 订单已取消
                        </div>
                 
                    </div>
                   
                    
                   
                    <div class="am-form-group">
                        <label for="user-intro" class="am-u-sm-3 am-form-label">
                            留言
                        </label>
                        <div class="am-u-sm-9">
                            <textarea class="" disabled rows="10" id="user-intro" name="order_msg">{{$data->order_msg}}
                            </textarea>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <input type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success " value="提交"/>
                             
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection