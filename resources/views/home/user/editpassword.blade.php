@extends('layouts.home_user')
@section('content')
    @if(session('error'))
        <script>
            layer.msg('原密码错误',{icon:2});
        </script>
    @endif
    <div class="m_right">
        {{--<div style="float: left;width: 793px;padding-bottom: 20px;overflow: hidden;padding-left: 15px;padding-top: 20px;" id="per_content_wrap">--}}
            <div style="border-top: 1px solid #dfdfdf;border-left: 1px solid #dfdfdf;">
                <div style="height: 40px;background-color: #f9f9f9;padding-left: 10px;line-height: 40px;font-weight: 700;">用户密码</div>
                <div class="content_form">
                    <div style="margin:0px auto;width:400px;"  >
                        <form action="{{url('home/user/updatepassword')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id" value="{{$id}}">
                            <p style="margin-top:70px;">
                                <span style="font-size:15px;">原始密码</span>
                                <input type="password" style="width: 280px;height: 25px;border: 2px solid #dfdfdf;" id="jpass" name="password">
                                <span></span>
                            </p>
                            <p style="\margin-top:40px;">
                                <span style="font-size:15px;">新密码&nbsp;&nbsp;&nbsp;</span>
                                <input type="password" style="width: 280px;height: 25px;border: 2px solid #dfdfdf;"  id="xpass" value="" name="newpassword">
                                <span class="password-complex"></span>
                                <input type="hidden" class="passComplexLevel">
                                <span></span>
                            </p>
                            <p style="margin-top:40px;">
                                <span style="font-size:15px;">确认密码</span>
                                <input type="password" style="width: 280px;height: 25px;border: 2px solid #dfdfdf;"  id="repass" name="repassword">
                                <span></span>
                            </p>
                            <button id="button" type="submit" style="margin:70px auto;width:100px;height:30px;background-color: #f46;border: none;color: #fff;">确认</button>
                        </form>
                    </divstyle>
                </div>
            </div>
        {{--</div>--}}
    </div>
        <script>
            var aa = false;
            var bb = false;
            var cc = false;
            $(function(){
                $('#jpass').blur(function(){
                    var jpass  = $('#jpass').val();
                    $.post('{{url('home/user/editpassword')}}',{jpass:jpass,id:{{$id}},'_token':"{{csrf_token()}}"},function(msg){
                        if(msg==1){
                            layer.msg('原密码错误',{icon:5});
                            return false;
                        }else{
                            aa = true;
                        }
                    });
                });
                $('#xpass').blur(function(){
                    var res = /^[A-Za-z0-9]{6,20}$/;
                    var jpass  = $('#jpass').val();
                    var password = $('#xpass').val();
                    if(password == jpass){
                        layer.msg('新密码不能与旧密码相同',{icon:7});
                    }
                    if(!res.test(password)){
                        layer.msg('请输入6-18位,小写字母,大写字母,数字三种组合的密码',{icon:7});
                        return false;
                    }else{
                        bb = true;
                    }
                });
                $('#repass').blur(function(){
                    if($('#repass').val() != $('#xpass').val()){
                        layer.msg('重复密码不一致',{icon:2});
                        return false;
                    }else{
                        cc = true;
                    }
                });
                $('#button').click(function(){
                    if(aa == true && bb == true && cc == true){
                        return true;
                    }
                    return false;
                });


            })

        </script>
@endsection

