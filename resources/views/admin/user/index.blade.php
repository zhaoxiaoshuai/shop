@extends('layouts.admin')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">
                            用户列表
                        </div>
                    </div>
                    <div class="widget-body  am-fr">
                        <div class="search_wrap" style="margin-left:560px">
                            <form action="{{url('admin/user')}}" method="get">
                            {{--<span style="font-size:14px;color:#282d2f">状态查询</span>&nbsp;--}}
                            {{--<input type="text" name="status" style="font-size:12px;color:#000000;" value="" placeholder="请输入1或0" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
                            <span style="font-size:14px;color:#282d2f">账号查询</span>&nbsp;
                                <input type="text" name="username" style="font-size:12px;color:#000000;" value="@if(empty($username))  @else {{$username}}  @endif" placeholder="手机号/邮箱" >
                                <input type="submit"  class="button" value="查询">
                            </form>
                        </div>
                        <div class="am-u-sm-12">
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black "
                                   id="example-r">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>手机账号</th>
                                    <th>邮箱账号</th>
                                    <th>
                                        @if(empty($d) || $d == 'asc')
                                            <a href="{{url('admin/user/').'?o=createtime&d=desc'}}">
                                                创建时间
                                            </a>
                                        @else
                                            <a href="{{url('admin/user/').'?o=createtime'}}">
                                                创建时间
                                            </a>
                                        @endif
                                    </th>
                                    <th style="width:20px;">token</th>
                                    <th>
                                        @if(empty($d) || $d == 'asc')
                                            <a href="{{url('admin/user/').'?o=status&d=desc'}}">
                                                状态
                                            </a>
                                        @else
                                            <a href="{{url('admin/user/').'?o=status'}}">
                                                状态
                                            </a>
                                        @endif
                                    </th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $k => $v)
                                    <tr class="even gradeC">
                                        <td>{{$v->user_id}}</td>
                                        <td>{{$v->user_phone}}</td>
                                        <td>{{$v->user_email}}</td>
                                        <td>{{date('Y-m-d H:i:s',$v->createtime)}}</td>
                                        <td>{{$v->token}}</td>
                                        <td>{{$v->status}}</td>
                                        <td>
                                            <div class="tpl-table-black-operation">
                                                <a href="javascript:;" class="tpl-table-black-operation-del" onclick="DelUser({{$v->user_id}})" >
                                                    <i class="am-icon-trash">
                                                    </i>
                                                    删除
                                                </a>
                                                <a href="{{url('admin/user/'.$v->user_id.'/edit')}}" >
                                                    <i class="am-icon-pencil">
                                                    </i>
                                                    修改
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach


                                <!-- more data -->
                                </tbody>
                            </table>
                            <?php
                                $username  = empty($username) ? '' : $username;
                            ?>
                        </div>
                        <div class="am-u-lg-12 am-cf">
                            <div class="am-u-lg-12 am-cf ">
                                <style>
                                    .am-rf .pagination li{float:left;fone-size:20px;padding-left:10px;}
                                </style>
                                {!! $data->appends(['username'=>$username])->render() !!}
                            </div>
                        </div>
                        <div class="am-u-lg-12 am-cf">

                            <div class="am-fr">




                            </div>
                            <style>
                                .am-fr ul li {

                                    font-size: 15px;
                                    float:left;
                                    padding: 6px 12px;
                                }
                            </style>
                            <script>
                                function DelUser(user_id){
                                    //询问框
                                    layer.confirm('是否确认删除？', {
                                        btn: ['确定','取消'] //按钮
                                    }, function(){
                                        //           url ==> admin/user/{user}   http://project182.com/admin/user/2
                                        $.post("{{url('admin/user/')}}/"+user_id,{'_method':'DELETE','_token':"{{csrf_token()}}"},function(data){
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection