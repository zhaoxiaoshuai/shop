@extends('layouts.StoreAdmin')

@section('content')

  <div class="row-content am-cf"> 
   <div class="row"> 
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
     <div class="widget am-cf"> 
      <div class="widget-head am-cf"> 
       <div class="widget-title  am-cf">
        商品列表
       </div> 
      </div> 
      <div class="widget-body  am-fr"> 
       <div class="am-u-sm-12 am-u-md-6 am-u-lg-6"> 
        <div class="am-form-group"> 
         <div class="am-btn-toolbar"> 
          <div class="am-btn-group am-btn-group-xs"> 
	       <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span><a href="{{ url('store/goods/create') }}">新增</a> </button> 
          </div> 
         </div> 
        </div> 
       </div> 
	<form action="{{ url('store/goods') }}" method="get">
       <div class="am-u-sm-12 am-u-md-12 am-u-lg-3"> 
        <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p" style='left:150px;'> 
         	<input type="text" name="keywords" class="am-form-field " placeholder="请输入商品名"/> 
         	<span class="am-input-group-btn"> <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button> </span> 
        </div> 
       </div> 
     </form>
   <div class="am-u-sm-12">
        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
            <thead>
            <tr class="gradeX">
                <th class="tc" width="5%"><input type="checkbox" name="" id="inp"></th>
                <th>商品ID</th>
                <th>商品名称</th>
                <th>商品状态</th>
                <th>商品创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($data as $k=>$v)
                    <tr class="gradeX">
                    <td width="5%"><input type="checkbox" name="" class="cls"></td>
                    <td>{{$v->good_id}}</td>
                    <td>{{$v->good_name}}</td>
                    @if($v->good_status==1)
                        <td>上架</td>
                    @elseif($v->good_status==2)
                        <td>下架</td>
                    @elseif($v->good_status==0)
                        <td>新品</td>
                    @endif
                    <td>{{date('Y-m-d H:i:s',$v->good_ctime)}}</td>
                    <td>
                        <div class="tpl-table-black-operation">
                            <a href="{{url('store/goods/'.$v->good_id.'/edit')}}">
                                <i class="am-icon-pencil"></i> 编辑
                            </a>
                            <a href="javascript:;" onclick="DelGood({{$v->good_id}})" class="tpl-table-black-operation-del">
                                <i class="am-icon-trash"></i> 删除
                            </a>
                            <a href="{{url('store/goods/').'/'.$v->good_id}}">
                                <i class="am-icon-pencil"></i> 查看
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
        <?php
        $key = empty($key)?'':$key;
        ?>
        <div class="am-rf">
                
                {!! $data->appends(['keywords' => $key])->render() !!}
        </div>
    </div>
        
      </div> 
     </div> 
    </div> 
   </div> 
  </div>


    <script>
        function DelGood(good_id){
            //询问框
            layer.confirm('是否确认删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                //           url ==> admin/user/{user}   http://project182.com/admin/user/2
                $.post("{{url('store/goods/')}}/"+good_id,{'_method':'DELETE','_token':"{{csrf_token()}}"},function(data){
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
@endsection