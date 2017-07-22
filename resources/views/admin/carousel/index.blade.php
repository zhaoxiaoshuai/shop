@extends('layouts.admin')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">轮播图列表</div>


                    </div>
                    <div class="widget-body  am-fr">
                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <div class="am-form-group">
                                <div class="am-btn-toolbar">

                                </div>
                            </div>
                        </div>

                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-3" style="width:100px">
                            图片名称
                        </div>
                        <form action="{{ url('admin/carousel') }}" method="GET">
                            <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                    <input type="text" class="am-form-field " name="keywords" value="@if(empty($key)) @else{{$key}} @endif">
                                    <span class="am-input-group-btn">
                                 <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button>
                        </form>
          </span>
                            </div>
                        </div>

                        <div class="am-u-sm-12">
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>轮播图名称</th>
                                    <th>轮播图来源</th>
                                    <th>轮播图链接</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data))
                                    @foreach($data as $k => $v)
                                <tr class="gradeX">
                                    <th class="am-text-middle">{{ $v->id }}</th>
                                    <td class="am-text-middle">{{ $v->carousel_name }}</td>
                                    <td class="am-text-middle">{{ $v->carousel_pic }}</td>
                                    <td class="am-text-middle">{{ $v->carousel_url }}</td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <a href="{{ url('admin/carousel/'.$v->id.'/edit') }}"><i class="am-icon-pencil"></i> 编辑</a>
                                            <a href="javascript:;" onclick="DelLink({{$v->id}})" class="tpl-table-black-operation-del"><i class="am-icon-trash"></i> 删除</a>
                                        </div>
                                    </td>
                                </tr>
                                    @endforeach
                                @endif

                                <!-- more data -->
                                </tbody>
                            </table>
                        </div>
                <script>
                    function DelLink(id){
                        //询问框
                        layer.confirm('是否确认删除？', {
                            btn: ['确定','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/carousel')}}/"+id,{'_method':'DELETE','_token':"{{ csrf_token() }}"},function(data){
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
                        <div class="am-u-lg-12 am-cf">

                            <div class="am-fr">
                                <style>
                                    .am-fr .pagination li{float:left;fone-size:20px;padding-left:10px;}
                                </style>
                                <?php $key = empty($key) ? '' : $key; ?>
                                {!! $data->appends(['keywords' => $key])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection