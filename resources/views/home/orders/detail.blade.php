@extends('layouts.home_user')

@section('content')
		<div class="m_right">
            <p></p>
            <div class="mem_tit">
                <span class="fr" style="font-size:12px; color:#55555; font-family:'宋体'; margin-top:5px;"><a href="" onclick="history.go(-1)">返回</a></span>订单详情
            </div>
           	<table border="0" class="order_tab" style="width:930px;" cellspacing="0" cellpadding="0">
              <tr>                                                                                                                                       
                <td align="center" width="350">商品名称</td>
                <td align="center" width="180">单价</td>
                <td align="center" width="180">数量</td>
                <td align="center" width="160">价格</td>
              </tr>
                @foreach($data as $v)
              <tr>
                <td style="font-family:'宋体';">
                	<div class="sm_img"><img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $v['good_pic'] }}" width="48" height="48" /></div>{{ $v['good_name'] }}
                </td>
                <td align="center">￥{{ $v['good_price'] }}</td>
                <td align="center">{{ $v['order_cnt'] }}</td>
                <td align="center">{{ $v['order_total'] }}</td>
              </tr>
                    @endforeach
            </table>


            
        </div>
@endsection