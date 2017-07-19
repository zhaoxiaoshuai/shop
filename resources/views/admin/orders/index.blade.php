@extends('layouts.admin')
@section('content')
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title  am-cf">
                        订单列表
                    </div>
                </div>
                <div class="widget-body  am-fr">
					<div class="search_wrap" style="margin-left:25px">
						<form action="" method="get">
							<table class="search_tab" >
								<tr>
									<th width="100">订单号查询:</th>
										<td><input type="text" name="orders" value="@if(empty($orders)) @else{{$orders}}  @endif"placeholder="请输入订单号" style="color:red;"
										value=""
										></td>
										<td><input type="submit" name="sub" value="查询"></td>
								</tr>
							</table>
						</form>
					</div>
                    <div class="am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black "
                        id="example-r">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>订单号</th>
                                    <th>下单人</th>
                                    <th>收货人</th>
                                    <th>收货地址</th>
                                    <th>联系电话</th>
                                    <th>订单状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $status = [1=>'下单未发货','出库,未收货','收货完成','作废','订单已取消','待付款'];
                            	?>

                               @foreach($data as $k=>$v)
                               
                                <tr class="even gradeC">
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->order_id}}</td>
                                    <td>{{$v->user_name}}</td>
                                    <td>{{$v->order_linkman}}</td>
                                    <td>{{$v->order_address}}</td>
                                    <td>{{$v->order_phone}}</td>
                                    <td>{{$status[$v->order_status]}}</td>
                                    <td>
                                        <div class="tpl-table-black-operation">
                                            <a href="javascript:;" class="tpl-table-black-operation-del" onclick="DelOrders({{$v->order_id}})" >
                                                <i class="am-icon-trash">
                                                </i>
                                                删除订单
                                            </a>
                                            <a href="{{url('admin/orders/'.$v->order_id.'/edit')}}" >
                                                <i class="am-icon-pencil">
                                                </i>
                                                修改订单
                                            </a>
                                            <a href="{{url('admin/detail/'.$v->order_id)}}" >
                                                <i class="am-icon-pencil">
                                                </i>
                                                订单详情
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                                <!-- more data -->
                            </tbody>
                        </table>
                    </div>
                    <div class="am-u-lg-12 am-cf">
                        <?php
                        	$orders = empty($orders) ? '' : $orders;
                        ?>

                        <div class="am-fr">
                        
                           
                                 {!! $data->appends(['orders'=>$orders])->render() !!}
                            
                        </div>
					<style>
						.am-fr ul li {
							
							font-size: 15px;
							float:left;
							padding: 6px 12px;
						}
					</style>
					<script>

        function DelOrders(order_id){
            //询问框
            layer.confirm('是否确认删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                //           url ==> admin/user/{user}   http://project182.com/admin/user/2
                $.post("{{url('admin/orders/')}}/"+order_id,{'_method':'DELETE','_token':"{{csrf_token()}}"},function(data){
                if(data.status == 0){
                    location.href = location.href;
                    layer.msg(data.msg, {icon: 6});
                }else{
                    location.href = location.href;
                    layer.msg(data.msg, {icon: 5});
                }
                });


            }, function(){

            });

        }


    </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection