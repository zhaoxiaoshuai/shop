@include('layouts.home_header')


    <div class="top">

        <div class="logo" style="height:110px;margin-top:10px;"><a href="{{ url('') }}"><img src="{{ 'http://php182.oss-cn-beijing.aliyuncs.com/'.config('web.conf_logo') }}" /></a></div>
        <div class="search">
            <form action="{{url('home/search')}}" method="post">
                {{ csrf_field() }}
                <input type="text" value="" name="search" class="s_ipt" />
                <input type="submit" value="搜索" class="s_btn" />
            </form>
        </div>
        <div class="i_car">
            <a href="{{url('home/mycart')}}"><div class="car_t">购物车</div></a>
           
        </div>
    </div>
    <!--End Header End-->
    <!--Begin Menu Begin-->
    <div class="menu_bg">
        <div class="menu">
@include('layouts.home_list')
            <ul class="menu_r">
                <li><a href="">首页</a></li>
                <li><a href="">美食</a></li>
                <li><a href="">生鲜</a></li>
                <li><a href="">家居</a></li>
                <li><a href="">女装</a></li>
                <li><a href="">美妆</a></li>
                <li><a href="">数码</a></li>
                <li><a href="">团购</a></li>
            </ul>
        </div>
    </div>
    <!--End Menu End-->
@section('content')


@show

@include('layouts.home_footer')