@extends('layouts.StoreAdmin')

@section('content')

  <div class="row-content am-cf"> 
   <div class="row"> 
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
     <div class="widget am-cf"> 
      <div class="widget-head am-cf"> 
       <div class="widget-title  am-cf">
        评论列表
       </div> 
      </div> 
      <div class="widget-body  am-fr"> 
       <div class="am-u-sm-12 am-u-md-6 am-u-lg-6"> 
        <div class="am-form-group"> 
         <div class="am-btn-toolbar"> 
          <div class="am-btn-group am-btn-group-xs"> 
	       
          </div> 
         </div> 
        </div> 
       </div> 
	
   <div class="am-u-sm-12">
        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
            <thead>
            <tr class="gradeX">
                <th class="tc" width="5%"><input type="checkbox" name="" id="inp"></th>
                <th>商品名称</th>
                <th>评论内容</th>
                <th>评论时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                @foreach($com as $k=>$v)
                    <tr class="gradeX">
                    <td width="5%"><input type="checkbox" name="" class="cls"></td>
                    <td>{{ $v['good_name'] }}</td>
                    <td>{{ $v['comment_connect'] }}</td>
                    <td>{{ date('Y-m-d H:i:s',$v['comment_time']) }}</td>
                    <td>
                        <div class="tpl-table-black-operation">
                        	<a href="{{url('store/comment/reply/'.$v['id'])}}">
                                <i class="am-icon-pencil"></i> 回复
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
    <style>
        .am-rf .pagination li{float:left;fone-size:20px;padding-left:10px;}
    </style>
        <div class='am-rf'>
          {!! $com->render() !!}
        </div>
    </div>
        
      </div> 
     </div> 
    </div> 
   </div> 
  </div>


    
@endsection