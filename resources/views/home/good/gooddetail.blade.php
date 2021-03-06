@extends('layouts.home_good')

@section('content')

<div class="i_bg">
	<div class="postion">
            <span class="fl">{{$line}}</span>
    </div>
>
    <div class="content">

        <div id="tsShopContainer">
            <div id="tsImgS"><a href="" title="Images" class="MagicZoom" id="MagicZoom"><img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$good->good_pic}}" width="390" height="390" /></a></div>
            <div id="tsPicContainer">
                <div id="tsImgSArrL" onclick="tsScrollArrLeft()"></div>
                <div id="tsImgSCon" style="width: 360px">
                    <ul>
                        <li onclick="showPic(0)" rel="MagicZoom" class="tsSelectImg"><img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$good->good_pic}}" tsImgS="images/ps1.jpg" width="79" height="79" style="display: block"/></li>
                    @foreach($pics as $k=>$v)
                        <li onclick="showPic(0)" rel="MagicZoom" class="tsSelectImg"><img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$v->good_pics}}" tsImgS="images/ps1.jpg" width="79" height="79" style="display: block"/></li>
                        @endforeach
                    </ul>
                </div>
                <div id="tsImgSArrR" onclick="tsScrollArrRight()"></div>
            </div>
            {{--<img class="MagicZoomLoading" width="16" height="16" src="" alt="Loading..." />--}}
        </div>

        <div class="pro_des">
        	<div class="des_name">
            	<p>{{$good->good_name}}</p>
                {{--{!!$good->good_desc!!}--}}
                <input id="eeeee" type="hidden" value="{{$good->good_id}}">
            </div>
            <div class="des_price">
            	本店价格：<b>{{$good->good_price}}</b><br />
                {{--消费积分：<span>28R</span>--}}
            </div>
            <div class="des_choice">
            	<span class="fl">型号选择：</span>
                <ul>
                	<li class="checked">30ml<div class="ch_img"></div></li>
                    <li>50ml<div class="ch_img"></div></li>
                    <li>100ml<div class="ch_img"></div></li>
                </ul>
            </div>
            <div class="des_choice">
            	<span class="fl">颜色选择：</span>
                <ul>
                	<li>红色<div class="ch_img"></div></li>
                    <li class="checked">白色<div class="ch_img"></div></li>
                    <li>黑色<div class="ch_img"></div></li>
                </ul>
            </div>
            <div class="des_share">
                
            	<div class="d_sh">
                	分享
                    <div class="d_sh_bg">
                    	
                    </div>
                </div>                
                @if($coll)
                    <a href="javascript:;"  id="delcollGood" ><span class="d_care"   aria-hidden="">已收藏</span></a>
                @else
                    <a href="javascript:;"  id="collGood" ><span class="d_care"   aria-hidden="">收藏</span></a>
                @endif

                <script>
            $(function(){
                //收藏
                $('#collGood').click(function()
                {
                    $.get("{{url('home/collection/'.$good->good_id)}}",{},function(data){
                        if(data == 1){
                            location.href = location.href;
                            layer.msg('收藏成功',{icon:1});
                        }else if(data == 2){
                            location.href = location.href;
                            layer.msg('收藏失败',{icon:2});
                        }else if(data == 3){
                            location.href = location.href;
                            layer.msg('已收藏',{icon:1});
                        }else if(data == 4){
                            layer.msg('请先登录',{icon:2});
                            location.href = "{{url('/home/login')}}";
                        }                                               
                    });
                });
                //取消收藏
                $('#delcollGood').click(function()
                {
                    $.get("{{url('home/collection1/'.$good->good_id)}}",{},function(data){
                        if(data == 1){
                            location.href = location.href;
                            layer.msg('取消收藏成功',{icon:1});
                        }else if(data == 2){
                            location.href = location.href;
                            layer.msg('取消收藏失败',{icon:2});
                        }                   
                    });
                });
            });
        </script>


              
            </div>
            <div class="des_join">
            	<div class="j_nums">
                	<input type="text" value="1" name="" id="n_ipt_n" class="n_ipt" />
                    <input type="button" value="" onclick="addUpdate(jq(this));" class="n_btn_1" />
                    <input type="button" value="" onclick="jianUpdate(jq(this));" class="n_btn_2" />
                </div>

                <span id="fffff" class="fl"><a onclick="ShowDiv_1('MyDiv1','fade1')"><img src="{{asset('home/images/j_car.png')}}" /></a></span>
                <script type="text/javascript">
                    $(function(){
                        $('#fffff').click(function(){
                            var n_ipt = $('#n_ipt_n').val();
                            var good_id = $('#eeeee').val();
                            $.get('{{url('home/mycart/addmycart')}}', {n_ipt: n_ipt,good_id:good_id}, function(data) {
                                console.log(data);
                            });
                        })
                    })

                </script>
            </div>            
        </div>    
        @if($merchant)
        <div class="s_brand">
        	<div class="shop-info-search-header">
   <div class="shop-info-box">
    <div class="J-user-info-box">
     <div class="J-shop-user-info J-show-user-detail">
          <a href="{{url('home/merchant/index?merchant_id='.$merchant['merchant_id'])}}" class="avatar" title="{{$merchant['merchant_name']}}"> 
                <img style="width:80px;height:80px;margin: 22px 0px 10px 50px;" class="face fl" src="http://php182.oss-cn-beijing.aliyuncs.com/{{$merchant['merchant_logo']}}" />
          </a>
      <div class="name-score-wrap"> 
       <div style="display:block;margin: 1px 1px 1px 60px;" class="name-wrap fl"> 
            <a href="{{url('home/merchant/index')}}" class="name fl" title="{{$merchant['merchant_name']}}">{{$merchant['merchant_name']}}</a> 
       </div> 
      </div>
     </div>
     <div class="shop-header-action">
     
       <div class="mogutalk_widget_btn kefu fl mogutalk_widget4" style="width: 48px;
        height:20px;background: url(https://s10.mogucdn.com/pic/150519/sp1ku_iezdizbwmi3temjugezdambqmmyde_1x1.gif) no-repeat 50%;background-size: 42px; margin: 1px 1px 1px 60px;cursor: pointer;" onclick="_MEIQIA('showPanel')" data-bid="1pile4#23" data-style="widget4" data-from="shop-header"></div>
       </a>
     </div>
    </div>
   </div>
  </div>
        </div>
    </div>
    @endif
    <div class="content mar_20">
    	<div class="l_history">
        	<div class="fav_t">用户还喜欢</div>
        	<ul>
                @foreach($like as $k=>$v)
            	<li>
                    <div class="img"><a href="{{url('home/gooddetail')}}/{{$v->good_id}}"><img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$v->good_pic}}" width="185" height="162" /></a></div>
                	<div class="name"><a href="{{url('home/gooddetail')}}/{{$v->good_id}}">{{$v->good_name}}</a></div>
                    <div class="price">
                    	<font>￥<span>{{$v->good_price}}</span></font> &nbsp;
                    </div>
                </li>
                @endforeach
        	</ul>
        </div>
        <div class="l_list">

            <div class="des_border">

            <div class="des_border" id="p_details">
                <div class="des_t">商品详情</div>
                <div class="des_con">
                	<table border="0" align="center" style="width:745px; font-size:14px; font-family:'宋体';" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>
                            {!!$good->good_desc!!}
                            @foreach($pics as $k=>$v)
                                <img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$v->good_pics}}" tsImgS="images/ps1.jpg" width="750"  style="display: block"/>
                                <br>
                            @endforeach
                        </td>
                      </tr>
                    </table>

                    <p align="center">

					</p>

                </div>
          	</div>

            <div class="des_border" id="p_comment">
            	<div class="des_t">商品评论</div>

                <table border="0" class="jud_tab" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="175" class="jud_per">
                    	<p>80.0%</p>好评度
                    </td>
                    <td width="300">
                    	<table border="0" style="width:100%;" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="90">好评<font color="#999999">（80%）</font></td>
                            <td><img src="{{ asset('home/assets/images/pl.gif') }}" align="absmiddle" /></td>
                          </tr>
                          <tr>
                            <td>中评<font color="#999999">（20%）</font></td>
                            <td><img src="{{ asset('home/assets/images/pl.gif') }}" align="absmiddle" /></td>
                          </tr>
                          <tr>
                            <td>差评<font color="#999999">（0%）</font></td>
                            <td><img src="{{ asset('home/assets/images/pl.gif') }}" align="absmiddle" /></td>
                          </tr>
                        </table>
                    </td>
                    <td width="185" class="jud_bg">
                    </td>
                  </tr>
                </table>



                <table border="0" class="jud_list" style="width:100%; margin-top:30px;" cellspacing="0" cellpadding="0">
                    @foreach($comment as $v)
                  <tr valign="top">
                    <td width="160"><img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $v['deta_face'] }}" width="20" height="20" align="absmiddle" />&nbsp;{{ $v['deta_name'] }}</td>
                    <td>
                    	{{ $v['comment_connect'] }} <br />
                        <font color="#999999">{{ date('Y-m-d H:i:s',$v['comment_time']) }}</font>
                    </td>
                  </tr>
                    @endforeach

                </table>

                <div class="pages">
                    {!! $comment->render() !!}
                </div>

          	</div>




    <!--Begin 弹出层-收藏成功 Begin-->
    <div id="fade" class="black_overlay"></div>
    <div id="MyDiv" class="white_content">
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyDiv','fade')"><img src="images/close.gif" /></span>
            </div>
            <div class="notice_c">

                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="40"><img src="images/suc.png" /></td>
                    <td>
                    	<span style="color:#3e3e3e; font-size:18px; font-weight:bold;">您已成功收藏该商品</span><br />
                    	<a href="#">查看我的关注 >></a>
                    </td>
                  </tr>
                  <tr height="50" valign="bottom">
                  	<td>&nbsp;</td>
                    <td><a href="#" class="b_sure">确定</a></td>
                  </tr>
                </table>

            </div>
        </div>
    </div>
    <!--End 弹出层-收藏成功 End-->
    <!--Begin 弹出层-加入购物车 Begin-->
    <div id="fade1" class="black_overlay"></div>
    <div id="MyDiv1" class="white_content">
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv_1('MyDiv1','fade1')"><img src="{{asset('home/images/close.gif')}}" /></span>
            </div>
            <div class="notice_c">

                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="40"><img src="{{asset('home/images/suc.png')}}" /></td>
                    <td>

                    	<span style="color:#3e3e3e; font-size:18px; font-weight:bold;">宝贝已成功添加到购物车</span><br />
                    	
                    </td>
                  </tr>
                  <tr height="50" valign="bottom">
                  	<td>&nbsp;</td>
                    <td><a href="{{url('home/mycart/create')}}" class="b_sure">去购物车结算</a><a href="{{url('/')}}" class="b_buy">继续购物</a></td>
                  </tr>
                </table>

            </div>
        </div>
    </div>
    <!--End 弹出层-加入购物车 End-->
    
<script>
  function Collection(good_id){
            //询问框
            layer.confirm('是否确认收藏？', {
                btn: ['确定','取消'] //按钮
            }, function(){ 
                
                $.get("{{url('home/collection')}}/"+good_id,{},function(data){
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