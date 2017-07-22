@extends('layouts.home_user')

@section('content')

    
    <div class="m_right">
    <p>
    </p>
    <div class="mem_tit">
        收货地址
    </div>
   	@foreach($data as $k=>$v)
    <div class="address">
        <div class="a_close">
           
        </div>
        <table border="0" class="add_t" align="center" style="width:98%; margin:10px auto;"
        cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td colspan="2" style="font-size:14px; color:#ff4e00;">
                        {{$v->name}}
                    </td>
                </tr>
                <tr>
                    <td align="right" width="80">
                        收货人姓名：
                    </td>
                    <td>
                        {{$v->name}}
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        详细地址：
                    </td>
                    <td>
                        {{$v->address}}
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        手机：
                    </td>
                    <td>
                        {{$v->phone}}
                    </td>
                </tr>
                
                
            </tbody>
        </table>
        <p align="right">
            <a href="javascript:;" onclick="DelUser({{$v->address_id}})" style="color:#ff4e00;">
                删除
            </a>
            &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="{{url('home/address/'.$v->address_id.'/edit')}}" style="color:#ff4e00;">
                编辑
            </a>
            &nbsp; &nbsp; &nbsp; &nbsp;
        </p>
    </div>
    @endforeach
    <div class="am-fr">
                        
                           
        {!! $data->render() !!}
                            
    </div>
    <style>
		.am-fr ul li {
							
			font-size: 15px;
			float:left;
			padding: 6px 12px;
		}
	</style>
    <div class="mem_tit">
        <a href="{{'address/create'}}">
            <span style="color:red;">新增收货地址</span>
        </a>
    </div>
    
   
</div>
  
</div>
    <script>

        function DelUser(address_id){
            //询问框
            layer.confirm('是否确认删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                //           url ==> admin/user/{user}   http://project182.com/admin/user/2
                $.post("{{url('home/address/')}}/"+address_id,{'_method':'DELETE','_token':"{{csrf_token()}}"},function(data){
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
<!--End 用户中心 End-->

@endsection