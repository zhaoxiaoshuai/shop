@extends('layouts.admin')
@section('content')
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title  am-cf">
                        订单详情
                    </div>
                </div>
                <div class="widget-body  am-fr">
                    
                    <div class="am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                            <thead>
                                <tr>
                                    <th>
                                        商品图片
                                    </th>
                                    <th>
                                        商品名称
                                    </th>
                                    <th>
                                        商品单价
                                    </th>
                                    <th>
                                        数量
                                    </th>
                                    <th>
                                        商品总价
                                    </th>
                                    <th>
                                        商家
                                    </th>
                                </tr>
                            </thead>
                           @foreach($data as $k=>$v)
                            <tbody>
                                <tr class="even gradeC">
                                    <td>
                                        <img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$v->good_pic}}"class="tpl-table-line-img" alt="">
                                    </td>
                                    <td class="am-text-middle">
                                       {{$v->good_name}}
                                    </td>
                                    <td class="am-text-middle">
                                        {{$v->good_price}}
                                    </td>
                                    <td class="am-text-middle">
                                        {{$v->good_count}}
                                    </td>
                                    <td class="am-text-middle">
                                        {{$v->order_total}}
                                    </td>
                                    <td class="am-text-middle">
                                        {{$v->order_source}}
                                    </td>
                                    
                                </tr>
                                <!-- more data -->
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="am-u-lg-12 am-cf">
                        <div class="am-fr">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection