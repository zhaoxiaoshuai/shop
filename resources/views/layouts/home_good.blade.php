@include('layouts.home_header')


    <div class="top">

        <div class="logo" style="height:110px;margin-top:10px;"><a href="Index.html"><img src="{{ 'http://php182.oss-cn-beijing.aliyuncs.com/'.config('web.conf_logo') }}" /></a></div>
        <div class="search">
            <form action="{{url('home/search')}}" method="post">
                {{ csrf_field() }}
                <input type="text" value="" name="search" class="s_ipt" />
                <input type="submit" value="搜索" class="s_btn" />
            </form>
            <span class="fl"><a href="#">咖啡</a><a href="#">iphone 6S</a><a href="#">新鲜美食</a><a href="#">蛋糕</a><a href="#">日用品</a><a href="#">连衣裙</a></span>
        </div>
        <div class="i_car">
           <a href="{{url('home/mycart')}}"><div class="car_t">购物车</div></a> 
            
        </div>
    </div>
    <!--End Header End-->
    <!--Begin Menu Begin-->
    <div class="menu_bg">
        <div class="menu">
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