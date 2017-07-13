@extends('layouts.admin')
@section('content')
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div class="widget am-cf">
        <div class="widget-head am-cf">
            <div class="widget-title  am-cf">角色列表</div></div>
        <div class="widget-body  am-fr">
            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                <div class="am-form-group">
                    <div class="am-btn-toolbar">
                       
                    </div>
                </div>
            </div>
            <form action="{{url('admin/role')}}" method="get">
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                    <div class="am-form-group tpl-table-list-select">
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                        <input type="text" name="keywords" value="{{$key or ''}}" class="am-form-field ">
                        <span class="am-input-group-btn">
                        <input type="submit" class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" value="搜索" ,>
                        </span>
                    </div>
                </div>
            </form>
            <div class="am-u-sm-12">
                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>权限名</th>
                            <th>权限内容</th>
                            <th>权限描述</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
	                    @foreach($data as $k => $v)
	                        <tr class="even gradeC">
	                            <td>{{$v['auth_id']}}</td>
	                            <td>{{$v['auth_name']}}</td>
                                <td>{{$v['auth_content']}}</td>
	                            <td>{{$v['auth_description']}}</td>
	                            <td>
	                                <div class="tpl-table-black-operation">
	                                    <a href="{{url('admin/auth/'.$v['auth_id'].'/edit')}}">
	                                        <i class="am-icon-pencil"></i>编辑</a>
	                                    <a href="javascript:;" onclick="Del({{$v['auth_id']}})"  class="tpl-table-black-operation-del">
	                                        <i class="am-icon-trash"></i>删除</a>
	                                </div>
	                            </td>
	                        </tr>
	                    @endforeach
                        <!-- more data -->
                    </tbody>
                </table>
            </div>
            <div class="am-u-lg-12 am-cf">
                <div class="am-fr">
              
                {!! $data -> appends(['keywords'=>$key]) -> render() !!}
                </div>
            </div>
            
        </div>
    </div>
</div>
<script type="text/javascript">
    function Del(id)
    {
        layer.confirm('是否确认删除？', {
          btn: ['确认','取消'] //按钮
        }, function(){
            $.post("{{url('admin/auth/')}}/"+id, {'_method':'DELETE','_token':"{{csrf_token()}}"}, function(data) {
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
<style>
	.pagination li{
    	 float:left;
    }
    .am-fr .pagination li span{
        font-size: 15px;
        padding: 6px 12px; 
    padding: 6px 12px;
    background: #3f4649;
    border: none;
    }
    .am-fr .pagination li a{
        font-size: 15px;
        padding: 6px 12px; 
	  border: 1px solid #167fa1;
	  padding: 6px 12px; 
    }
</style>
@endsection