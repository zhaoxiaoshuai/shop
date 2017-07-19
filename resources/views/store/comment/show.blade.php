@extends('layouts.StoreAdmin')

@section('content')

  <div class="row-content am-cf"> 
   <div class="row"> 
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
     <div class="widget am-cf"> 
      <div class="widget-head am-cf"> 
       <div class="widget-title  am-cf">
        已回复评论列表
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
	<form action="{{ url('store/comment/show') }}" method="get">
       <div class="am-u-sm-12 am-u-md-12 am-u-lg-3"> 
        <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p" style='left:150px;'> 
         	<input type="text" name="keywords" value="" class="am-form-field " placeholder="请输入商品名"/> 
         	<span class="am-input-group-btn"> <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button> </span> 
        </div> 
       </div> 
     </form>
   <div class="am-u-sm-12">
        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
            <thead>
            <tr class="gradeX">
                <th>商品名称</th>
                <th>评论等级</th>
                <th>评论内容</th>
                <th>评论时间</th>
                <th>回复内容</th>
                <th>回复时间</th>
            </tr>
            </thead>
            <tbody>
                @foreach($com as $k=>$v)
                    <tr class="gradeX">
                    <td>{{ $v['good_name'] }}</td>
                    <td>{{ $arr[$v['comment_level']] }}</td>
                    <td>{{ $v['comment_connect'] }}</td>
                    <td>{{ date('Y-m-d H:i:s',$v['comment_time']) }}</td>
                    <td>{{ $v['reply_connect'] }}</td>
                    <td>{{ date('Y-m-d H:i:s',$v['reply_time']) }}</td>
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
          {!! $com->appends(['keywords' => $key])->render() !!}
        </div>
    </div>
        
      </div> 
     </div> 
    </div> 
   </div> 
  </div>

@endsection