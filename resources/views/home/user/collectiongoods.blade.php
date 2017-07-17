@extends('layouts.home_user')

@section('content')

	
<div class="m_right">
            <p></p>
            <div class="mem_tit">
                <span class="fr" style="font-size:12px; color:#55555; font-family:'宋体'; margin-top:5px;">共发现4件</span>我的收藏
            </div>
            <table border="0" class="order_tab" style="width:930px;" cellspacing="0" cellpadding="0">
              <tbody>
              <tr>                                                                                                                                       
                <td align="center" width="420">商品名称</td>
                <td align="center" width="180">价格</td>
                <td align="center" width="270">操作</td>
              </tr>

              @foreach($data as $k=>$v)
              <tr>
                <td style="font-family:'宋体';">
                    <div class="sm_img">
                    <img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $v['good_pic'] }}" width="48" height="48">
                    </div>{{ $v['good_name'] }}
                </td>
                <td align="center">￥{{ $v['good_price'] }}</td>
                <td align="center">
                    
                    <a href="#" style="color:#ff4e00;">加入购物车</a>&nbsp; &nbsp;
                    <a href="javascript:;" onclick="DelCollect({{ $v['good_id'] }})">删除</a>
                    </td>
              </tr>
              @endforeach   
              
              
              
            </tbody></table>
        </div>
<script>
  function DelCollect(good_id){
            //询问框
            layer.confirm('是否确认删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){ 
                
                $.post("{{url('home/Collectiongoods')}}/"+good_id,{'_method':'DELETE','_token':"{{csrf_token()}}"},function(data){
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