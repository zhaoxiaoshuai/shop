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
@include('layouts.home_nav')
        </div>
    </div>
    <!--End Menu End-->
@section('content')


@show

@include('layouts.home_footer')