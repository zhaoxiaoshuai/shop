@extends('layouts.home_good')

@section('content')

<div class="content mar_20">
    <img src="{{asset('home/images/img2.jpg')}}" />        
</div>
    <div class="content mar_20">
    	<form action="{{url('home/orders/comfirm')}}" method="post">
    	{{ csrf_field() }}
    		<div class="two_bg">
        	<div class="two_t">
            	<span class="fr"><a href="{{url('home/mycart')}}">修改</a></span>商品列表
            </div>
            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="car_th" width="550">商品名称</td>
                <td class="car_th" width="140">属性</td>
                <td class="car_th" width="150">购买数量</td>
                <td class="car_th" width="130">单价</td>
                <td class="car_th" width="140">小计</td>
              </tr>
            @foreach($data as $k=>$v)
              <tr class="car_tr">
                <td>
                    <div class="c_s_img"><img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $v->good_pic}}" width="73" height="73" /></div>
                    {{$v->good_name}}
                </td>
                <td align="center">{{$v->good_desc}}</td>
                <td align="center">{{$v->cart_cnt}}</td>
                <td align="center" style="color:#ff4e00;">￥{{$v->good_price}}</td>
                <td align="center">{{$v->good_price * $v->cart_cnt}}</td>
              </tr>
            @endforeach
              <tr>
                <td colspan="5" align="right" style="font-family:'Microsoft YaHei';">
                    商品总价：￥{{$total}}
                </td>
              </tr>

            </table>

            <div class="two_t">
            	<span class="fr"><a href="{{url('home/address/create')}}">添加收货地址</a></span>收货人信息
            </div>
            <table border="0" class="peo_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
              <tr>
              	<td class="car_th" width="5%"></td>
                <td class="car_th" width="140" align="center">收货人姓名</td>
                <td class="car_th" width="550" align="center">详细地址</td>
                <td class="car_th" width="220" align="center">电话</td>
                <td class="car_th" width="200" align="center">邮箱</td>
                
              </tr>
              @foreach($list as $k=>$v)
              <tr class="eeeee" >
              	<td width="5%"><input type="checkbox" name="address" value="{{$v->address_id}}">
                <td align="center" >{{$v->name}}</td>
                <td align="center" >{{$v->address}}</td>
                <td align="center" >{{$v->phone}}</td>
                <td align="center" >{{$v->email}}</td>
              </tr>
              @endforeach
            </table>
              
            <div class="two_t">
            	支付方式
            </div>
            <ul class="pay">
                <li>余额支付<div class="ch_img"></div></li>
                <li>银行亏款/转账<div class="ch_img"></div></li>
                <li>货到付款<div class="ch_img"></div></li>
                <li class="checked">支付宝<div class="ch_img"></div></li>
            </ul> 
            <div class="two_t">
            	其他信息
            </div>
            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td align="right" style="padding-right:0;"><b style="font-size:14px;">订单附言：</b></td>
                <td style="padding-left:0;"><textarea name="order_msg" class="add_txt" style="width:860px; height:50px;"></textarea></td>
              </tr>
            </table>
            
            <table border="0" style="width:900px; margin-top:20px;" cellspacing="0" cellpadding="0">
              
              <tr height="70">
                <td align="right">
                	<b style="font-size:14px;">应付款金额：<span style="font-size:22px; color:#ff4e00;">￥{{$total}}</span></b>
                </td>
              </tr>
              <tr height="70">
                <td align="right"><button id="button"  style="margin:0;padding:0;list-style-type:none" type="submit" ><img src="{{asset('home/images/btn_sure.gif')}}" /></button></td>
              </tr>
            </table>

            
        	
        </div>
    	</form>
    	
    </div>
@endsection