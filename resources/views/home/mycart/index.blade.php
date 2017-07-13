@extends('layouts.home_index')

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
            @foreach($data as $k=>$v)
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
                        <input type="button" value="" onclick="jianUpdate1(jq(this));" class="car_btn_1"
                        />
                        <input type="text" value="{{$v->cart_cnt}}" name="" class="car_ipt" />
                        <input type="button" value="" onclick="addUpdate1(jq(this));" class="car_btn_2"
                        />
                    </div>
                </td>
                <td align="center" style="color:#ff4e00;">
                    {{$v->good_price}}
                </td>
                <td align="center">
                    {{ $v->good_price*$v->cart_cnt }}
                </td>
                <td align="center" >
                    <a href="#" onclick="ShowDiv('MyDiv','fade')">
                        删除
                    </a>
                     
                    <a href="#">
                        加入收藏
                    </a>
                </td>
            </tr>
            @endforeach
            <tr height="70">
                <td colspan="6" style="font-family:'Microsoft YaHei'; border-bottom:0;">
                    <label class="r_rad">
                        <input type="checkbox" name=""   class="all" /> 全选
                    </label>
                    
                    <label class="r_txt">
                       &nbsp; &nbsp; &nbsp;  <a>清空购物车</a>
                    </label>
                    <span class="fr">
                        商品总价：
                        <b style="font-size:22px; color:#ff4e00;">
                           {{$total}}
                        </b>
                    </span>
                </td>
            </tr>
            <tr valign="top" height="150" >
                <td colspan="6" align="right">
                    <a href="#">
                        <img src="{{ asset('home/images/buy1.gif') }}" />
                    </a>
                    &nbsp; &nbsp;
                    <a href="#">
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







        var num=$("#num_id").html();
    num--;
    if(num<1){
        $("#num_id").html(0);
        $("#pay_num_id").val(0);
        $("#total_price").html(0);
        $("#total_prices").html(0);
    }else{
        $("#num_id").html(num);
        $("#pay_num_id").val(num);
        var price = $("#one_price").html();
        $("#total_price").html(price * num);
        $("#pay_total_id").val(price * num);        
    }

       
    </script>
    <!--End 弹出层-删除商品 End-->
@endsection