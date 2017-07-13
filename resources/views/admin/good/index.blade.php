@extends('layouts.admin')
@section('content')
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title  am-cf" style="margin:20px"><h1>商品列表</h1></div>
            </div>
            <div class="widget-body  am-fr">
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                    <div class="am-form-group">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <button type="button" class="am-btn am-btn-default am-btn-success"><a
                                            href="{{url('admin/good/create')}}"><span class="am-icon-plus">新增</span></a></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                    <div class="am-form-group tpl-table-list-select">
                        <select data-am-selected="{btnSize: 'sm'}" style="display: none;">
                            <option value="option1">所有类别</option>
                            <option value="option2">IT业界</option>
                            <option value="option3">数码产品</option>
                            <option value="option3">笔记本电脑</option>
                            <option value="option3">平板电脑</option>
                            <option value="option3">只能手机</option>
                            <option value="option3">超极本</option>
                        </select>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                        <form action="{{url('/admin/good')}}" method="get">
                            <input type="text" class="am-form-field " name="keywords" style="width:60%">
                            <span class="am-input-group-btn">
                            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button>
                            </span>
                        </form>
                    </div>
                </div>
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
                                        <a href="{{url('admin/good/'.$v->good_id.'/edit')}}">
                                            <i class="am-icon-pencil"></i> 编辑
                                        </a>
                                        <a href="javascript:;" onclick="DelGood({{$v->good_id}})" class="tpl-table-black-operation-del">
                                            <i class="am-icon-trash"></i> 删除
                                        </a>
                                        <a href="{{url('admin/good/detail').'/'.$v->good_id}}">
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
                    <?php
                    $key = empty($key)?'':$key;
                    ?>
                    <div class="am-fr">
                            {!! $data->appends(['keywords' => $key])->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    <script>
        function DelGood(good_id){
            //询问框
            layer.confirm('是否确认删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                //           url ==> admin/user/{user}   http://project182.com/admin/user/2
                $.post("{{url('admin/good/')}}/"+good_id,{'_method':'DELETE','_token':"{{csrf_token()}}"},function(data){
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