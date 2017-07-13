@extends('layouts.home_index')
@section('content')
    <div class="i_bg bg_color">
        <div class="i_ban_bg">
            <!--Begin Banner Begin-->
            <div class="banner">
                <div class="top_slide_wrap">
                    <ul class="slide_box bxslider">
                       @foreach($carousel as $k=>$v)
                        <li><a href=""><img src="{{ $v['carousel_pic'] }}" alt="{{ $v['carousel_name'] }}" width="740" height="401" /></a></li>
                        @endforeach

                    </ul>
                    <div class="op_btns clearfix">
                        <a href="#" class="op_btn op_prev"><span></span></a>
                        <a href="#" class="op_btn op_next"><span></span></a>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                //var jq = jQuery.noConflict();
                (function(){
                    $(".bxslider").bxSlider({
                        auto:true,
                        prevSelector:jq(".top_slide_wrap .op_prev")[0],nextSelector:jq(".top_slide_wrap .op_next")[0]
                    });
                })();
            </script>
            <!--End Banner End-->
            <div class="inews">
                <div class="news_t">
                    <span class="fr"><a href="#">更多 ></a></span>新闻资讯
                </div>
                <ul>
                    <li><span>[ 特惠 ]</span><a href="#">掬一轮明月 表无尽惦念</a></li>
                    <li><span>[ 公告 ]</span><a href="#">好奇金装成长裤新品上市</a></li>
                    <li><span>[ 特惠 ]</span><a href="#">大牌闪购 · 抢！</a></li>
                    <li><span>[ 公告 ]</span><a href="#">发福利 买车就抢千元油卡</a></li>
                    <li><span>[ 公告 ]</span><a href="#">家电低至五折</a></li>
                </ul>
                <div class="charge_t">
                    话费充值<div class="ch_t_icon"></div>
                </div>
                <form>
                    <table border="0" style="width:205px; margin-top:10px;" cellspacing="0" cellpadding="0">
                        <tr height="35">
                            <td width="33">号码</td>
                            <td><input type="text" value="" class="c_ipt" /></td>
                        </tr>
                        <tr height="35">
                            <td>面值</td>
                            <td>
                                <select class="jj" name="city">
                                    <option value="0" selected="selected">100元</option>
                                    <option value="1">50元</option>
                                    <option value="2">30元</option>
                                    <option value="3">20元</option>
                                    <option value="4">10元</option>
                                </select>
                                <span style="color:#ff4e00; font-size:14px;">￥99.5</span>
                            </td>
                        </tr>
                        <tr height="35">
                            <td colspan="2"><input type="submit" value="立即充值" class="c_btn" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <!--Begin 热门商品 Begin-->
        <div class="content mar_10">
            <div class="h_l_img">
                <div class="img"><img src="{{ asset( 'home/assets/images/l_img.jpg') }}" width="188" height="188" /></div>

                <div class="pri_bg">
                    <span class="price fl">￥53.00</span>
                    <span class="fr">16R</span>
                </div>
            </div>
            <div class="hot_pro">
                <div id="featureContainer">
                    <div id="feature">
                        <div id="block">
                            <div id="botton-scroll">
                                <ul class="featureUL">
                                    @foreach( $goods as $k => $v)
                                    <li class="featureBox">
                                        <div class="box">
                                            <div class="h_icon"><img src="{{asset('home/assets/images/hot.png')}}" width="50" height="50" /></div>
                                            <div class="imgbg">
                                                <a href="home/gooddetail/{{ $v['good_id'] }}"><img src="{{ 'http://php182.oss-cn-beijing.aliyuncs.com/'.$v['good_pic'] }}" width="160" height="136" /></a>


                                            </div>
                                            <div class="name">
                                                <a href="home/gooddetail/{{ $v['good_id'] }}">
                                                    <h2>{{ $v['good_name'] }}</h2>
                                                    {{ $v['good_desc'] }}
                                                </a>
                                            </div>
                                            <div class="price">
                                                <font>￥<span>{{ $v['good_price'] }}</span></font>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <a class="h_prev" href="javascript:void();">Previous</a>
                        <a class="h_next" href="javascript:void();">Next</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mar_20">
            <img src="{{asset('home/assets/images/mban_1.jpg')}}" width="1200" height="110" />
        </div>
        <!--Begin 食品饮料 Begin-->
        @foreach($datas as $k => $v)
            <?php $arr = [];?>
        <?php $arr[] = $v['type_id']; ?>
        <div class="i_t mar_10">
            <span class="fl">{{ $v['type_name'] }}</span>
            <span class="i_mores fr"><a href="#">咖啡</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">休闲零食</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">饼干糕点</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">冲饮谷物</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">营养保健</a></span>
        </div>
        <div class="content">
            <div class="food_left">
                <div class="food_ban">
                    <div id="imgPlay2">
                        <ul class="imgs" id="actor2">
                            <li><a href="#"><img src="{{asset('home/assets/images/food_r.jpg')}}" width="211" height="286" /></a></li>
                            <li><a href="#"><img src="{{asset('home/assets/images/food_r.jpg')}}" width="211" height="286" /></a></li>
                            <li><a href="#"><img src="{{asset('home/assets/images/food_r.jpg')}}" width="211" height="286" /></a></li>
                        </ul>
                        <div class="prev_f">上一张</div>
                        <div class="next_f">下一张</div>
                    </div>
                </div>
                <div class="fresh_txt">
                    <div class="fresh_txt_c">
                        <?php $data2 = DB::table('type')->where('pid',$v['type_id'])->limit(8)->get(); ?>
                        @foreach($data2 as $k2 => $v2)
                            <?php $arr[] = $v2['type_id']; ?>
                        <a href="home/goodlist/{{$v2['type_id']}}">{{ $v2['type_name'] }}</a>
                            @endforeach
                    </div>
                </div>
            </div>
            <div class="fresh_mid">
                <ul>

                    <?php $good = DB::table('goods')->whereIn('type_id',$arr)->orderBy(\DB::raw('RAND()'))->limit(6)->get(); ?>
                    @foreach($good as $gk=>$gv)
                    <li>
                        <div class="name"><a href="home/gooddetail/{{ $gv['good_id'] }}">{{ $gv['good_name'] }}</a></div>
                        <div class="price">
                            <font>￥<span>{{ $gv['good_price'] }}</span></font>
                        </div>
                        <div class="img"><a href="home/gooddetail/{{ $gv['good_id'] }}"><img src="{{ 'http://php182.oss-cn-beijing.aliyuncs.com/'.$gv['good_pic'] }}" width="185" height="155" /></a></div>
                    </li>
                        @endforeach
                </ul>
            </div>
            <div class="fresh_right">
                <ul>
                    <li><a href="#"><img src="{{asset('home/assets/images/food_b1.jpg')}}" width="260" height="220" /></a></li>
                    <li><a href="#"><img src="{{asset('home/assets/images/food_b2.jpg')}}" width="260" height="220" /></a></li>
                </ul>
            </div>
        </div>
        <!--End 食品饮料 End-->

        @endforeach

        <!--Begin 猜你喜欢 Begin-->
        <div class="i_t mar_10">
            <span class="fl">猜你喜欢</span>
        </div>
        <div class="like">
            <div id="featureContainer1">
                <div id="feature1">
                    <div id="block1">
                        <div id="botton-scroll1">
                            <ul class="featureUL">
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="imgbg">
                                            <a href="#"><img src="{{asset('home/assets/images/hot1.jpg')}}" width="160" height="136" /></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h2>德国进口</h2>
                                                德亚全脂纯牛奶200ml*48盒
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>189</span></font> &nbsp; 26R
                                        </div>
                                    </div>
                                </li>
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="imgbg">
                                            <a href="#"><img src="{{asset('home/assets/images/hot2.jpg')}}" width="160" height="136" /></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h2>iphone 6S</h2>
                                                Apple/苹果 iPhone 6s Plus公开版
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>5288</span></font> &nbsp; 25R
                                        </div>
                                    </div>
                                </li>
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="imgbg">
                                            <a href="#"><img src="{{asset('home/assets/images/hot3.jpg')}}" width="160" height="136" /></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h2>倩碧特惠组合套装</h2>
                                                倩碧补水组合套装8折促销
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>368</span></font> &nbsp; 18R
                                        </div>
                                    </div>
                                </li>
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="imgbg">
                                            <a href="#"><img src="{{asset('home/assets/images/hot4.jpg')}}" width="160" height="136" /></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h2>品利特级橄榄油</h2>
                                                750ml*4瓶装组合 西班牙原装进口
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>280</span></font> &nbsp; 30R
                                        </div>
                                    </div>
                                </li>
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="imgbg">
                                            <a href="#"><img src="{{asset('home/assets/images/hot4.jpg')}}" width="160" height="136" /></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h2>品利特级橄榄油</h2>
                                                750ml*4瓶装组合 西班牙原装进口
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>280</span></font> &nbsp; 30R
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a class="l_prev" href="javascript:void();">Previous</a>
                    <a class="l_next" href="javascript:void();">Next</a>
                </div>
            </div>
        </div>
        <!--End 猜你喜欢 End-->
@endsection





