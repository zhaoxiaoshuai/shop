@extends('layouts.admin')

@section('content')

  <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
   <div class="widget am-cf"> 
    <div class="widget-head am-cf"> 
     <div class="widget-title am-fl">
      入驻商申请列表
     </div> 
     <div class="widget-function am-fr"> 
      <a href="javascript:;" class="am-icon-cog"></a> 
     </div> 
    </div> 
    <div class="widget-body  widget-body-lg am-fr"> 
     <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r"> 
      <thead> 
       <tr> 
        <th>会员名称</th> 
        <th>入驻商用户</th> 
        <th>店铺名称</th>
        <th>店铺等级</th> 
        <th>联系电话</th> 
        <th>平台使用费</th> 
        <th>分成利率</th>
        <th>状态</th>
        <th>状操作</th>
       </tr> 
      </thead> 
      <tbody>
      <?php 
      	$arr = ['1'=>'未审核','审核通过','审核不通过'];
      	$arr2 = ['1'=>'初级','中级','高级'];
      ?>
      @foreach($data as $k=>$v)
       <tr class="gradeX"> 
        <td>{{ $v['user_name'] }}</td> 
        <td>{{ $v['store_username'] }}</td> 
        <td>{{ $v['merchant_name'] }}</td>
        <td>{{ $arr2[$v['merchant_leverl']] }}</td> 
        <td>{{ $v['store_phone'] }}</td> 
        <td>{{ $v['platform_use_fee'] }}</td> 
        <td>{{ $v['percent'] }}</td> 
        <td>{{ $arr[$v['audit_status']] }}</td> 
        <td> 
         <div class="tpl-table-black-operation"> 
          <a href="{{ url('admin/astore/'.$v['store_id']) }}"> <i class="am-icon-pencil"></i>审核</a> 
         </div> </td> 
       </tr> 
       @endforeach
       <!-- more data --> 
      </tbody> 
     </table> 
    </div> 
   </div> 
  </div>

@endsection
