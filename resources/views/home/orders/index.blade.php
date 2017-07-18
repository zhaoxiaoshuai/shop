@extends('layouts.home_user')

@section('content')
		<div class="m_right">
            <p></p>
            <div class="mem_tit">我的订单</div>
            <table border="0" class="order_tab" style="width:930px; text-align:center; margin-bottom:30px;" cellspacing="0" cellpadding="0">
              <tr>                                                                                                                                                    
                <td width="20%">订单号</td>
                <td width="20%">下单时间</td>
                <td width="15%">订单总金额</td>
                <td width="20%">订单状态</td>
                <td width="25%">操作</td>
              </tr>
                <?php $status = ['1'=>'下单未发货','出库,未收货','已收货','作废','订单已取消'];
                ?>
                @foreach($orders as $k=>$v)
              <tr>
                <td><font color="#ff4e00">{{ $v['order_id'] }}</font></td>
                <td>{{ date('Y-m-d H:i:s',$v['order_time']) }}</td>
                <td>{{ $v['order_total'] }}</td>
                <td>{{$status[$v->order_status]}}</td>
                <td><a href="{{ url('home/orders/'.$v['order_id']) }}">详情</a> |
                    @if( ($v['order_status'] == 3)  )
                    <a href="{{ url('home/comment/'.$v['order_id']) }}">评价</a> |
                    @endif
                    @if( ($v['order_status'] == 2) || ($v['order_status'] == 1) )
                    <a href="{{ url('home/changeorders/'.$v['order_id']) }}">取消订单</a>
                    @endif
                    @if( ($v['order_status'] == 2) || ($v['order_status'] == 1) )
                    <a href="{{ url('home/shouhuo/'.$v['order_id']) }}">确认收货</a>
                    @endif
                  </td>
              </tr>
                 @endforeach
            </table>
            
        </div>

	<!--End 用户中心 End-->
@endsection