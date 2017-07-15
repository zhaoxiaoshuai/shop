@include('layouts.home_header')
<link rel="stylesheet" href="{{url('home/assets/css/merchant.css')}}">
<link rel="stylesheet" href="{{url('home/assets/css/shopHeader.css')}}"> 

<div class="shop-info-search-header">
   <div class="shop-info-box">
    <div class="J-user-info-box">
     <div class="J-shop-user-info J-show-user-detail">
      <a href="" class="avatar" title="衣起来"> <img class="face fl" src="./images/upload_02ig2d6b16ac69b4065k6jdi9k9kj_320x320.jpg_100x100.jpg" /></a>
      <div class="name-score-wrap"> 
       <div class="name-wrap fl"> 
        <a href="" class="name fl" title="衣起来">衣起来</a> 
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
       <ol class="li li3"> 
        <li><span class="tag">所在地区：</span>广东省广州市</li> 
        <li><span class="tag">商品数：</span>249</li> 
        <li><span class="tag">收藏数：</span>7882</li> 
        <li><span class="tag">销售量：</span>49288</li> 
        <li><span class="tag">创建时间：</span>2015年11月10日</li> 
        <li><span class="tag">店铺保证金：</span>已缴纳</li> 
        <li class="pl20"> <img class="shop-individual-licen" src="./images/upload_ifqtozjzmizdaylbguzdambqgyyde_182x45.png" alt="" /> </li> 
        <li class="tc mt10 mb3"><a class="go-detail" href="" target="_blank" rel="nofollow">查看详情</a></li> 
       </ol> 
      </div> 
      <ol class="li li1"> 
       <li class="title">动态评分</li> 
       <li>描述相符： <span class="num"> 4.60 </span> </li> 
       <li>质量满意： <span class="num"> 4.57 </span> </li> 
       <li>价格合理： <span class="num"> 4.58 </span> </li> 
       <li>服务周到： <span class="num"> 4.59 </span> </li> 
      </ol> 
      <ol class="li li2"> 
       <li class="title">比同行平均</li> 
       <li> <span class="tag up"> 高 </span> 3.06% </li> 
       <li> <span class="tag up"> 高 </span> 3.12% </li> 
       <li> <span class="tag up"> 高 </span> 3.48% </li> 
       <li> <span class="tag up"> 高 </span> 2.14% </li> 
      </ol> 
      <ol class="li li4" v-if="shopDetailInfo.dsr"> 
       <li class="title">本店</li> 
       <li>平均发货时间： <span class="low"> 1.06 </span>天 </li> 
       <li>退货率： <span class="num"> 3.50 % </span> </li> 
       <li>有效投诉率： <span class="num"> 0.00 % </span> </li> 
      </ol> 
      <ol class="li li5"> 
       <li class="title">行业</li> 
       <li> 0.95 天 </li> 
       <li> 6.25 ％ </li> 
       <li> 0.02 ％ </li> 
      </ol> 
     </div>
     <div class="shop-header-action">
      <a class="J-shop-follow shop-follow fl" rel="nofollow" href="javascript:;">收藏店铺</a> 
      <a href="javascript:;" class="chart fl clearfix" id="mogutalk_widget_box">
       <div class="mogutalk_widget_btn kefu fl mogutalk_widget4" data-bid="1pile4#23" data-style="widget4" data-from="shop-header"></div></a>
     </div>
     <div class="shop-header-arrow J-show-user-detail"></div>
     <div class="line-right fr"></div>
    </div>
   </div>
  </div>
  <div class="J-shop-top-banner">
   <div class="top-banner-img" style="background-image: url(./images/11qjt0_ieydoylfguydsmddmiytambqgyyde_1920x150.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center"></div>
  </div>
  <div class="J-shop-top-nav">
   <div class="top-nav">
    <div class="nav-mask"></div>
    <ul>
     <li><a href="">首页</a></li>
     <li id="li" class="J-top-nav-title"><a href="" id="x1">全部商品<em class="arrow"></em></a>
      <ol id="ol" class="category-list" style="display: none;">
       <li><a href="">上衣</a></li>
       <li><a href="">下装</a></li>
       <li><a href="">套装</a></li>
       <li><a href="">外套</a></li>
       <li><a href="">连衣裙</a></li>
       <li><a href="">牛仔外套</a></li>
      </ol></li>
    </ul>
   </div>
  </div> 
@section('content')

 @show 
  



@include('layouts.home_footer')