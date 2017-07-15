
@extends('layouts.StoreAdmin')

@section('content')
<div class="row-content am-cf">
  <div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
      <div class="widget am-cf">
        <div class="widget-head am-cf">
          <div class="widget-title  am-cf">查看分类</div></div>
        <div class="widget-body  am-fr">
          <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
            <div class="am-form-group">
              <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                  <button type="button" class="am-btn am-btn-default am-btn-success">
                    <a href="{{url('store/type/create')}}"><span class="am-icon-plus"></span>新增</a></button>
                </div>
              </div>
            </div>
          </div>

          <<!-- div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
            <div class="am-form-group tpl-table-list-select">
                <th>关键字: </th>
            </div>
          </div> -->
         <!--  <form action="">
          <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
            <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
              <input type="text"  name="keywords" class="am-form-field " placeholder="输入搜索关键字">
              <span class="am-input-group-btn">
                 <button type="submit"  class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" ></button>
              </span>
            </div>
          </div>
          </form> -->
          <div class="am-u-sm-12">
            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>分类名称</th>
                  <th>父分类ID</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach($mtype as $k=>$v)
                <tr class="gradeX">
                  <td>{{ $v['mtype_id'] }}</td>
                  <td>{{ $v['mtype_name'] }}</td>
                  <td>{{ $v['mtype_pid']}}</td>
                  <td>
                    <div class="tpl-table-black-operation">
                      <a href="{{ url('store/type/'.$v['mtype_id'].'/edit')}}">
                        <i class="am-icon-pencil"></i>编辑</a>
                      <a href="javascript:;" onclick="DelType({{ $v['mtype_id'] }})" class="tpl-table-black-operation-del">
                        <i class="am-icon-trash"></i>删除</a>
                    </div>
                  </td>
                </tr>
                @endforeach
            </tbody>
                
            </table>
          </div>
          <div class="am-u-lg-12 am-cf">
       <div class="am-u-lg-12 am-cf ">
        <style>
        .am-rf .pagination li{float:left;fone-size:20px;padding-left:10px;}
        </style>
        <div class='am-rf'>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function DelType(mtype_id){
            //询问框
            layer.confirm('是否确认删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){ 
                //           url ==> admin/user/{user}   http://project182.com/admin/user/2
                
                $.post("{{url('store/type/')}}/"+mtype_id,{'_method':'DELETE','_token':"{{csrf_token()}}"},function(data){
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