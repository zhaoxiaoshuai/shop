@extends('admin.layouts.index')

@section('contion')

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
        <th>联系电话</th> 
        <th>平台使用费</th> 
        <th>商家保证金</th> 
        <th>分成利率</th>
        <th>状态</th>
        <th>状操作</th>
       </tr> 
      </thead> 
      <tbody> 
       <tr class="gradeX"> 
        <td>Amaze UI 模式窗口</td> 
        <td>张鹏飞</td> 
        <td>2016-09-26</td> 
        <td>2016-09-26</td> 
        <td>2016-09-26</td> 
        <td>2016-09-26</td> 
        <td>2016-09-26</td> 
        <td> 
         <div class="tpl-table-black-operation"> 
          <a href="{{ url('astore/{1}') }}"> <i class="am-icon-pencil"></i>查看</a> 
          <a href="javascript:;" class="tpl-table-black-operation-del"> <i class="am-icon-trash"></i>忽略</a> 
         </div> </td> 
       </tr> 
       
       <!-- more data --> 
      </tbody> 
     </table> 
    </div> 
   </div> 
  </div>

@endsection
