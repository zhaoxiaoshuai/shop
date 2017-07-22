@include('layouts.home_header')
<div class="m_top_bg">
        <div class="top">
            <div class="m_logo" style="height:110px;width:210px;margin-top:15px;"><a href="{{ url('') }}"><img src="{{ 'http://php182.oss-cn-beijing.aliyuncs.com/'.config('web.conf_logo') }}"></a></div>
            <div class="m_search" style="width:360px;margin-left:370px;">
                <form>
                    <input type="text" value="" class="m_ipt" style="width:250px;">
                    <input type="submit" value="搜索" class="m_btn">
                </form>
                <span class="fl"><a href="#">咖啡</a><a href="#">iphone 6S</a><a href="#">新鲜美食</a><a href="#">蛋糕</a><a href="#">日用品</a><a href="#">连衣裙</a></span>
            </div>
            <div class="i_car">
                <a href="{{url('home/mycart')}}"><div class="car_t">购物车</div></a>
                
            </div>
        </div>
    </div>

<!--Begin 用户中心 Begin -->
<div class="m_content">
    <div class="m_left">
        <div class="left_n">管理中心</div>
        <div class="left_m">
            <div class="left_m_t t_bg1">订单中心</div>
            <ul>
                <li><a href="{{ url('home/orders') }}">我的订单</a></li>
                <li><a href="{{url('home/Collectiongoods')}}">我的收藏</a></li>

                <li><a href="{{url('home/address')}}">收货地址</a></li>
                <li><a href="#">缺货登记</a></li>
                <li><a href="#">跟踪订单</a></li>
            </ul>
        </div>
        <div class="left_m">
            <div class="left_m_t t_bg2">会员中心</div>
            <ul>
                <li><a href="{{url('home/user/userdetails')}}" >用户信息</a></li>
                <li><a href="{{url('home/user/edit/'.session('logins')['user_id'])}}">修改密码</a>
                </li>
            </ul>
        </div>

        <div class="left_m">
            <div class="left_m_t t_bg3">账户中心</div>
            <ul>
                <li><a href="Member_Safe.html">账户安全</a></li>
                <li><a href="Member_Packet.html">我的红包</a></li>
                <li><a href="Member_Money.html">资金管理</a></li>
            </ul>
        </div>
        <div class="left_m">
            <div class="left_m_t t_bg4">分销中心</div>
            <ul>
                <li><a href="Member_Member.html">我的会员</a></li>
                <li><a href="Member_Results.html">我的业绩</a></li>
                <li><a href="Member_Commission.html">我的佣金</a></li>
                <li><a href="Member_Cash.html">申请提现</a></li>
            </ul>
        </div>
    </div>
    @section('content')
        @show

    @include('layouts.home_footer')