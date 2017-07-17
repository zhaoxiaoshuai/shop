@extends('layouts.home_good')

@section('content')

<!--End Menu End-->
<div class="i_bg">
    <div class="content mar_20">
        <img src="{{asset('home/images/img1.jpg')}}" />
    </div>
    <!--Begin 第一步：查看购物车 Begin -->
    <div class="content mar_20">
        <table border="0" class="car_tab" style="width:1200px; margin-bottom:50px;"
        cellspacing="0" cellpadding="0">
            <tr>
                <td class="car_th" width="5%"><input type="checkbox" name="" class="all"></td>
                <td class="car_th" width="490">
                    商品名称
                </td>
                <td class="car_th" width="140">
                    属性
                </td>
                <td class="car_th" width="150">
                    购买数量
                </td>
                <td class="car_th" width="130">
                    单价
                </td>
                <td class="car_th" width="140">
                    小计
                </td>
                <td class="car_th" width="200">
                    操作
                </td>
            </tr>
            @foreach($data1 as $k=>$v)
            <tr class="car_tr">
                <td width="5%"><input type="checkbox"  name="" class="child"></td>
                <td>
                    <div class="c_s_img">
                        <img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $v->good_pic}}" width="73" height="73" />
                    </div>
                    {{$v->good_name}}
                </td>
                <td align="center">
                    {{$v->good_desc}}
                </td>
                <td align="center">
                    <div class="c_num">
                        <input type="button" value="" class="car_btn_1" onclick="jianUpdate1(jq(this));" 
                        />
                        <input type="text" value="{{$v->cart_cnt}}" name="" class="car_ipt" />
                        <input type="button" value="" class="car_btn_2" onclick="addUpdate1(jq(this));" 
                        />
                        
                    </div>

                </td>
                <td align="center" style="color:#ff4e00;" >
                    {{$v->good_price}}
                </td>
                <td align="center" >
                    {{$v->cart_cnt * $v->good_price }}
                </td>
                <td align="center" >
                    <a href="javascript:;" onclick="DelGood({{$v->cart_id}})" >
                        删除
                    </a>
                     
                    <a href="#">
                        加入收藏
                    </a>
                </td>
            </tr>
            @endforeach
                <script>

        function DelGood(cart_id){
            //询问框
            layer.confirm('是否确认删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                //           url ==> admin/user/{user}   http://project182.com/admin/user/2
                $.post("{{url('home/mycart/')}}/"+cart_id,{'_method':'DELETE','_token':"{{csrf_token()}}"},function(data){
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
            <tr height="70">
                <td colspan="6" style="font-family:'Microsoft YaHei'; border-bottom:0;">
                    <label class="r_rad">
                        <input type="checkbox" name=""   class="all" /> 全选
                    </label>
                    
                    <label class="r_txt">
                       &nbsp; &nbsp; &nbsp;  <a href="{{url('home/mycart/delete')}}">清空购物车</a>
                    </label>
                    <span class="fr">
                        商品总价：
                        <b style="font-size:22px; color:#ff4e00;">
                           
                        </b>
                    </span>
                </td>
            </tr>
            <tr valign="top" height="150" >
                <td colspan="6" align="right">
                    <a href="{{url('/')}}">
                        <img src="{{ asset('home/images/buy1.gif') }}" />
                    </a>
                    &nbsp; &nbsp;
                    <a href="{{url('home/orders/commit')}}">
                        <img src="{{ asset('home/images/buy2.gif') }}" />
                    </a>
                </td>
            </tr>
        </table>
    </div>
    <!--End 第一步：查看购物车 End-->
    <!--Begin 弹出层-删除商品 Begin-->
    <div id="fade" class="black_overlay">
    </div>
    <div id="MyDiv" class="white_content">
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyDiv','fade')">
                    <img src="" />
                </span>
            </div>
            <div class="notice_c">
                <table border="0" align="center" style="font-size:16px;" cellspacing="0"
                cellpadding="0">
                    <tr valign="top">
                        <td>
                            您确定要把该商品移除购物车吗？
                        </td>
                    </tr>
                    <tr height="50" valign="bottom">
                        <td>
                            <a href="#" class="b_sure">
                                确定
                            </a>
                            <a href="#" class="b_buy">
                                取消
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.all').click(function(){
            if ($(this).is(":checked")){
                //全选
                $('.child').prop("checked", true);
            }else{
                //全不选
                
                $('.child').prop("checked", false);
                
            }
        }) 
    </script>
    <!--End 弹出层-删除商品 End-->
@endsection