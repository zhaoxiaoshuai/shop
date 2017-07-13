@include('layouts.home_header')


    <div class="top">

        <div class="logo"><a href="Index.html"><img src="{{ 'http://php182.oss-cn-beijing.aliyuncs.com/'.config('web.conf_logo') }}" /></a></div>
        <div class="search">
            <form action="home/search" method="post">
                {{ csrf_field() }}
                <input type="text" value="" name="search" class="s_ipt" />
                <input type="submit" value="搜索" class="s_btn" />
            </form>
            <span class="fl"><a href="#">咖啡</a><a href="#">iphone 6S</a><a href="#">新鲜美食</a><a href="#">蛋糕</a><a href="#">日用品</a><a href="#">连衣裙</a></span>
        </div>
        <div class="i_car">
            <div class="car_t">购物车 [ <span>3</span> ]</div>
            <div class="car_bg">
                <!--Begin 购物车未登录 Begin-->
                <div class="un_login">还未登录！<a href="{{ url('') }}" style="color:#ff4e00;">马上登录</a> 查看购物车！</div>

                <!--End 购物车未登录 End-->
                <!--Begin 购物车已登录 Begin-->
                <ul class="cars">
                    <li>
                        <div class="img"><a href="#"><img src="{{ asset('home/assets/images/car1.jpg')}}" width="58" height="58" /></a></div>

                        <div class="name"><a href="#">法颂浪漫梦境50ML 香水女士持久清新淡香 送2ML小样3只</a></div>
                        <div class="price"><font color="#ff4e00">￥399</font> X1</div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="{{ asset('home/assets/images/car2.jpg')}}" width="58" height="58" /></a></div>

                        <div class="name"><a href="#">香奈儿（Chanel）邂逅活力淡香水50ml</a></div>
                        <div class="price"><font color="#ff4e00">￥399</font> X1</div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="{{ asset('home/assets/images/car2.jpg')}}" width="58" height="58" /></a></div>

                        <div class="name"><a href="#">香奈儿（Chanel）邂逅活力淡香水50ml</a></div>
                        <div class="price"><font color="#ff4e00">￥399</font> X1</div>
                    </li>
                </ul>
                <div class="price_sum">共计&nbsp; <font color="#ff4e00">￥</font><span>1058</span></div>
                <div class="price_a"><a href="#">去购物车结算</a></div>
                <!--End 购物车已登录 End-->
            </div>
        </div>
    </div>
    <!--End Header End-->
    <!--Begin Menu Begin-->
    <div class="menu_bg">
        <div class="menu">
            <!--Begin 商品分类详情 Begin-->
            <div class="nav">
                <div class="nav_t">全部商品分类</div>
                <div class="leftNav">
                   <ul >
                   @foreach($data as $k=>$v)
                    <li >
                        <a href="home/goodlist/{{$v['type_id']}}"><div class="fj">
                            <span class="n_img"></span>
                            <span class="fl">{{ $v['type_name']}}</span>
                             </div>
                        </a>
                        <div class="zj" style="top:{{ $i = $i-40}}px;display:none;">
                            <div class="zj_l">
                                <?php $type2 = DB::table('type')->where('pid',$v['type_id'])->get(); ?>

                                @foreach($type2 as $k2 => $v2)
                                <div class="zj_l_c">
                                    <h2><a href="home/goodlist/{{$v2['type_id']}}">{{ $v2['type_name'].'/' }} </a></h2>
                                    <?php $type3 = DB::table('type')->where('pid',$v2['type_id'])->get(); ?>
                                    @if(!empty($type3))
                                     @foreach($type3 as $k3 => $v3)
                                    <a href="home/goodlist/{{$v3['type_id']}}">{{ $v3['type_name'].'|'}}</a>
                                    @endforeach
                                     @endif
                                </div>
                                    @endforeach
                        </div>
                    </li>
                    @endforeach         
                </ul>
                </div>
            </div>
            <!--End 商品分类详情 End-->
            <ul class="menu_r">
                <li><a href="Index.html">首页</a></li>
                <li><a href="Food.html">美食</a></li>
                <li><a href="Fresh.html">生鲜</a></li>
                <li><a href="HomeDecoration.html">家居</a></li>
                <li><a href="SuitDress.html">女装</a></li>
                <li><a href="MakeUp.html">美妆</a></li>
                <li><a href="Digital.html">数码</a></li>
                <li><a href="GroupBuying.html">团购</a></li>
            </ul>
            <div class="m_ad">中秋送好礼！</div>
        </div>
    </div>
    <!--End Menu End-->
@section('content')


@show

@include('layouts.home_footer')