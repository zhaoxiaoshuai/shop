@extends('layouts.admin')
@section('content')
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div class="widget am-cf">
        <div class="widget-head am-cf">
            <div class="widget-title  am-cf">管理员列表</div></div>
        <div class="widget-body  am-fr">
            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                <div class="am-form-group">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default am-btn-success">
                                <a href="{{url('admin/admin/create')}}"><span class="am-icon-plus"></span>新增</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{url('admin/admin')}}" method="get">
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
                            <th>用户名</th>
                            <th>联系电话</th>
                            <th>Email</th>
                            <th>
                                @if(empty($d) || $d == 'asc')
                                <a href="{{url('admin/admin/').'?o=admin_create&d=desc'}}">
                                创建时间
                                </a>
                                @else
                                <a href="{{url('admin/admin/').'?o=admin_create'}}">
                                创建时间
                                </a>
                                @endif
                            </th>
                            <th>
                                @if(empty($d) || $d == 'asc')
                                <a href="{{url('admin/admin/').'?o=admin_lasttime&d=desc'}}">
                                最后登录时间
                                </a>
                                @else
                                <a href="{{url('admin/admin/').'?o=admin_lasttime'}}">
                                创建时间
                                </a>
                                @endif
                            </th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
	                    @foreach($data as $k => $v)
	                        <tr class="even gradeC">
	                            <td>{{$v['admin_id']}}</td>
	                            <td>{{$v['admin_name']}}</td>
	                            <td>{{$v['admin_phone']}}</td>
	                            <td>{{$v['admin_email']}}</td>
	                            <td>{{date('Y年m月d日',$v['admin_create'])}}</td>
	                            @if($v['admin_lasttime'] == 0)
	                           		<td>无</td>
	                            @else
	                           	    <td>{{date('Y年m月d日',$v['admin_create'])}}</td>
	                           	@endif
	                            <td>
	                                <div class="tpl-table-black-operation">
	                                    <a href="{{url('admin/admin/'.$v['admin_id'].'/edit')}}">
	                                        <i class="am-icon-pencil"></i>编辑</a>
                                        <a href="javascript:;" onclick="Del({{$v['admin_id']}})"  class="tpl-table-black-operation-del">
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
                
                {!! $data ->appends(['keywords'=>$key,'o'=>$o])-> render() !!}
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
            $.post("{{url('admin/admin/')}}/"+id, {'_method':'DELETE','_token':"{{csrf_token()}}"}, function(data) {
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

