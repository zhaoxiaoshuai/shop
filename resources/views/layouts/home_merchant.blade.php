@include('layouts.home_header')
<link rel="stylesheet" href="{{url('home/assets/css/merchant.css')}}">
<link rel="stylesheet" href="{{url('home/assets/css/shopHeader.css')}}"> 

<div class="shop-info-search-header">
   <div class="shop-info-box">
    <div class="J-user-info-box">
     <div class="J-shop-user-info J-show-user-detail">
      <a href="{{url('home/merchant/index')}}" class="avatar" title="{{$merchant['merchant_name']}}"> <img class="face fl" src="http://php182.oss-cn-beijing.aliyuncs.com/{{$merchant['merchant_logo']}}" /></a>
      <div class="name-score-wrap"> 
       <div class="name-wrap fl"> 
        <a href="{{url('home/merchant/index')}}" class="name fl" title="{{$merchant['merchant_name']}}">{{$merchant['merchant_name']}}</a> 
        <p class="mark"> </p> 
       </div> 
       <div class="score-wrap"> 
        <p class="star"> <i></i> <i></i> <i></i> <i></i> </p> 
        <p class="descript"> <span class="cat"> 描述<b class="">4.60</b> </span> <span class="cat"> 质量<b class="">4.57</b> </span> <span class="cat"> 价格<b class="">4.58</b> </span> <span class="cat"> 服务<b class="">4.59</b> </span> </p> 
       </div>
      </div>
     </div>
     <div class="J-shop-user-info-detail"> 
      <div class="info-box fl"> 
       
      </div>  
     </div>
     <div class="shop-header-action">
      <a class="J-shop-follow shop-follow fl" rel="nofollow" href="javascript:;">收藏店铺</a> 
      <a href="javascript:;" class="chart fl clearfix" id="mogutalk_widget_box">
       <div class="mogutalk_widget_btn kefu fl mogutalk_widget4" onclick="_MEIQIA('showPanel')" data-bid="1pile4#23" data-style="widget4" data-from="shop-header"></div></a>
     </div>
     <div class="shop-header-arrow J-show-user-detail"></div>
     <div class="line-right fr"></div>
    </div>
   </div>
  </div>
  <div class="J-shop-top-banner">
   <div class="top-banner-img" style="background-image: url(http://php182.oss-cn-beijing.aliyuncs.com/{{$merchant['merchant_pic']}}); background-repeat: no-repeat; background-size: cover; background-position: center center"></div>
  </div>
  <div class="J-shop-top-nav">
   <div class="top-nav">
    <div class="nav-mask"></div>
    <ul>
     <li><a href="{{url('home/merchant/index')}}">首页</a></li>
     <li id="li" class="J-top-nav-title"><a href="" id="x1">全部商品<em class="arrow"></em></a>
      <ol id="ol" class="category-list" style="display: none;">
        @foreach($mtype as $k=>$v)
       <li><a href="{{url('home/merchant/goodlist').'?merchant_id='.$merchant['merchant_id'].'&mtype_id='.$v['mtype_id']}}">{{ $v['mtype_name'] }}</a></li>
        @endforeach
      </ol>
      </li>
    </ul>
   </div>
  </div> 
   <script type='text/javascript'>
    (function(m, ei, q, i, a, j, s) {
        m[i] = m[i] || function() {
            (m[i].a = m[i].a || []).push(arguments)
        };
        j = ei.createElement(q),
            s = ei.getElementsByTagName(q)[0];
        j.async = true;
        j.charset = 'UTF-8';
        j.src = '//static.meiqia.com/dist/meiqia.js?_=t';
        s.parentNode.insertBefore(j, s);
    })(window, document, 'script', '_MEIQIA');
     _MEIQIA('entId', ' ');
    </script>
    <script>
     _MEIQIA('hidePanel');
    </script>
@section('content')

 @show 
  



@include('layouts.home_footer')