@include('layouts.home_header')


  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script type="text/javascript">
        window.isMeilishuoMine = window.location.href.indexOf('meilishuo.com') > -1 ? true : false;
        window.layout = window.layout || {};
        if (window.isMeilishuoMine) {
            window.layout.logo = null;
        } else {
            window.layout.logo = {
                img: '{{ asset('home/assets/images/idid_ifqtam3fgu2tsyjxmizdambqgyyde_190x32.png') }}',
                link: '/pc/joinmarket/fashion',
                title: ''
            };
        }
        window.layout.menu = [];
    </script> 
  <meta name="renderer" content="webkit" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
  <title>蘑菇街类目入驻页</title> 
  <link rel="icon" href="" type="image/x-icon" /> 
  <link href="{{ asset('home/assets/css/pace.min.css') }}" rel="stylesheet" type="text/css" /> 
  <link href="{{ asset('home/assets/css/index.css-ff227c51.css') }}" rel="stylesheet" type="text/css" /> 
  <!--[if lt IE 9]>
    <script type="text/javascript" src="https://s10.mogucdn.com/__/mfp/meili-xd-lib/assets/0.0.4/lib/es5-shim.min.js,/mfp/meili-xd-lib/assets/0.0.4/lib/es5-sham.min.js,/mfp/meili-xd-lib/assets/0.0.4/lib/console-polyfill.min.js,/mfp/meili-xd-lib/assets/0.0.4/lib/json3.min.js"></script>
    <![endif]--> 
  <script type="text/javascript">
    var MOGU_DEV= 0 || "online" == "pre";
    var M_ENV = "online";
</script> 
  <script type="text/javascript" src="{{ asset('home/assets/js/m.xd.js') }}"></script> 
  <style type="text/css">.xd-teamtalk-btn{line-height:30px;height:30px;background:#f55;border-radius:4px;color:#fff;display:block;text-align:center;margin:10px 0 0;cursor:pointer;width:120px;font-size:13px}.xd-teamtalk-btn:hover{background:#f53b3b}#J_NotificationMsg{color:#666;background-color:#fee;border:1px solid #f55;border-left-width:2px;transition:box-shadow .3s ease;position:fixed;top:-70px;left:50%;min-width:500px;height:40px;line-height:40px;overflow:hidden;margin-left:-250px;text-align:center;transition:all .15s linear;font-weight:400;font-size:14px}.showNotice{top:45%!important}.w300{width:350px}#J_Notification a{color:#f55}</style>
  <style type="text/css">*{box-sizing:border-box}body{position:relative;background:#fff;min-width:1200px;margin:0;font:14px/1.5 Tahoma,Hiragino Sans GB,Microsoft yahei,serif;-webkit-font-smoothing:antialiased}.clearfix:after,.clearfix:before{content:" ";display:table}.clearfix:after{clear:both}.fl{float:left}.fr{float:right}#J_ManageTopNav{width:100%;height:60px;background:#fff;border-bottom:1px solid #eee}#J_ManageTopNav .layout-nav-wrapper{width:1200px;margin:0 auto}#J_ManageTopNav .layout-logo{float:left;margin:14px 0 0 20px}#J_ManageTopNav .layout-menu{float:left;margin:18px 0 0 55px}#J_ManageTopNav .layout-menu .nav-item{color:#666;font-size:16px;margin-left:40px;text-decoration:none}#J_ManageTopNav .layout-menu .nav-item:hover{border-bottom:2px solid #f55;color:#f55}#J_ManageTopNav .layout-user{vertical-align:top;float:right;margin:10px 20px 0}#J_ManageTopNav .layout-user .user-avatar{margin-right:11px}#J_ManageTopNav .layout-user .user-info{display:inline-block}#J_ManageTopNav .layout-user .user-message{display:block}#J_ManageTopNav .layout-user .user-logout,#J_ManageTopNav .layout-user .user-name{color:#666;text-decoration:none}#J_ManageTopNav .layout-user .user-partition{color:#999;margin:0 5px}#J_ManageTopNav .layout-user .user-login{padding:10px 0;display:inline-block;text-decoration:none;color:#666}#J_ManageTopUserNav{width:100%;min-width:1200px;height:60px;background:#f3f3f3;border-bottom:1px solid #eee}#J_ManageTopUserNav .layout-logo{float:left;margin:14px 0 0 20px}#J_ManageTopUserNav .layout-menu{float:left;margin:18px 0 0 55px}#J_ManageTopUserNav .layout-menu .nav-item{color:#666;font-size:16px;margin-right:40px;text-decoration:none}#J_ManageTopUserNav .layout-menu .nav-item:hover{border-bottom:2px solid #f55;color:#f55}#J_ManageTopUserNav .layout-user{vertical-align:top;float:right;margin:10px 20px 0}#J_ManageTopUserNav .layout-user .user-avatar{margin-right:11px}#J_ManageTopUserNav .layout-user .user-info{display:inline-block}#J_ManageTopUserNav .layout-user .user-message{display:block}#J_ManageTopUserNav .layout-user .user-logout,#J_ManageTopUserNav .layout-user .user-name{color:#666;text-decoration:none}#J_ManageTopUserNav .layout-user .user-partition{color:#999;margin:0 5px}#J_ManageBody{min-width:1200px;min-height:700px;width:100%;position:relative;background:#fff;display:table;table-layout:fixed}#J_ManageBody #J_ManageContent{display:table-cell}#J_ManageBody #J_ManageSideNav{display:table-cell;vertical-align:top;width:220px;background:#fbfbfb;border-right:1px solid #eee;overflow-x:hidden;padding-bottom:20px}#J_ManageBody #J_ManageSideNav .layout-box{border-bottom:1px solid #eee;margin:0 20px;padding:15px 0 5px}#J_ManageBody #J_ManageSideNav .layout-box h2{font-weight:400;font-size:16px;color:#333;line-height:16px;margin:0 0 12px}#J_ManageBody #J_ManageSideNav .layout-box .s-icon{position:relative;top:2px;margin-right:6px;display:inline-block}#J_ManageBody #J_ManageSideNav .layout-box ul{list-style:none;margin:0;padding:0;border:0;vertical-align:baseline}#J_ManageBody #J_ManageSideNav .layout-box li{height:30px;line-height:30px;display:inline-block;width:50%;overflow:hidden}#J_ManageBody #J_ManageSideNav .layout-box a.c{color:#f55}#J_ManageBody #J_ManageSideNav .layout-box a{color:#666;font-size:14px;display:block;text-decoration:none}#J_ManageBody #J_ManageSideNav .layout-box a:hover{color:#f55}#J_ManageFooter,#J_ManageFooterUnified{border-top:1px solid #eee;background-color:#333;width:100%;min-width:1200px;color:#fff;margin:0;text-align:center}#J_ManageFooter .layout-footer-wrapper,#J_ManageFooterUnified .layout-footer-wrapper{min-width:1200px;margin:0 auto;padding:0 20px}#J_ManageFooter .footer-top-line,#J_ManageFooterUnified .footer-top-line{margin-top:20px}#J_ManageFooter .footer-top-line .footer-app-icon,#J_ManageFooterUnified .footer-top-line .footer-app-icon{padding-bottom:8px}#J_ManageFooter .footer-top-line .xd-teamtalk,#J_ManageFooterUnified .footer-top-line .xd-teamtalk{color:#fff}#J_ManageFooter .footer-top-line .app-icon,#J_ManageFooterUnified .footer-top-line .app-icon{display:inline-block;background:url() no-repeat 0 0;width:44px;height:44px;vertical-align:top}#J_ManageFooter .footer-top-line .app-title,#J_ManageFooterUnified .footer-top-line .app-title{display:inline-block;width:75px;vertical-align:top;color:#fff;font-size:18px;line-height:23px}#J_ManageFooter .footer-top-line .through-line,#J_ManageFooterUnified .footer-top-line .through-line{border-top:1px solid #f5f5f5;width:122px;margin:0}#J_ManageFooter .footer-top-line .footer-app-tips,#J_ManageFooterUnified .footer-top-line .footer-app-tips{padding-top:8px;font-size:14px;height:30px;line-height:20px;letter-spacing:7px;color:#fff;margin:0}#J_ManageFooter .footer-top-line .footer-barcode,#J_ManageFooter .footer-top-line .footer-sj-qrcode,#J_ManageFooterUnified .footer-top-line .footer-barcode,#J_ManageFooterUnified .footer-top-line .footer-sj-qrcode{width:79px;height:79px}#J_ManageFooter .footer-top-line .footer-barcode,#J_ManageFooterUnified .footer-top-line .footer-barcode{background:url() no-repeat 0 0}#J_ManageFooter .footer-top-line .footer-sj-qrcode,#J_ManageFooterUnified .footer-top-line .footer-sj-qrcode{background:url() no-repeat 0 0}#J_ManageFooter .footer-top-line .footer-app-link,#J_ManageFooterUnified .footer-top-line .footer-app-link{margin-left:6px}#J_ManageFooter .footer-top-line .footer-app-link p,#J_ManageFooterUnified .footer-top-line .footer-app-link p{margin:0}#J_ManageFooter .footer-top-line .apk-link,#J_ManageFooter .footer-top-line .app-link,#J_ManageFooterUnified .footer-top-line .apk-link,#J_ManageFooterUnified .footer-top-line .app-link{display:block;width:140px;line-height:37px;height:37px;background-repeat:no-repeat;background-position:8px 5px;background-color:#fff;padding-left:41px;border-radius:4px;color:#f6433f;font-size:15px;text-decoration:none}#J_ManageFooter .footer-top-line .app-link,#J_ManageFooterUnified .footer-top-line .app-link{background-image:url()}#J_ManageFooter .footer-top-line .apk-link,#J_ManageFooterUnified .footer-top-line .apk-link{background-image:url();margin-top:6px}#J_ManageFooter .footer-top-line .footer-wechat-service,#J_ManageFooterUnified .footer-top-line .footer-wechat-service{margin-left:20px;color:#f5f5f5}#J_ManageFooter .footer-top-line .customer-service-title,#J_ManageFooter .footer-top-line .phone-detail,#J_ManageFooter .footer-top-line .phone-title,#J_ManageFooter .footer-top-line .work-time-title,#J_ManageFooterUnified .footer-top-line .customer-service-title,#J_ManageFooterUnified .footer-top-line .phone-detail,#J_ManageFooterUnified .footer-top-line .phone-title,#J_ManageFooterUnified .footer-top-line .work-time-title{height:30px;line-height:30px;color:#fff}#J_ManageFooter .footer-top-line .footer-phone,#J_ManageFooterUnified .footer-top-line .footer-phone{width:190px;border-right:1px solid #f5f5f5;height:68px}#J_ManageFooter .footer-top-line .customer-service-title,#J_ManageFooter .footer-top-line .phone-title,#J_ManageFooter .footer-top-line .work-time-title,#J_ManageFooterUnified .footer-top-line .customer-service-title,#J_ManageFooterUnified .footer-top-line .phone-title,#J_ManageFooterUnified .footer-top-line .work-time-title{padding-left:34px;font-size:16px;background:url() no-repeat 0 0}#J_ManageFooter .footer-top-line .phone-detail,#J_ManageFooterUnified .footer-top-line .phone-detail{font-size:23px}#J_ManageFooter .footer-top-line .footer-work-time,#J_ManageFooterUnified .footer-top-line .footer-work-time{margin-left:30px}#J_ManageFooter .footer-top-line .work-time-detail,#J_ManageFooterUnified .footer-top-line .work-time-detail{display:inline-block;margin-top:6px;width:150px;font-size:13px;color:#fff}#J_ManageFooter .footer-top-line .footer-customer-service .customer-service-detail,#J_ManageFooterUnified .footer-top-line .footer-customer-service .customer-service-detail{margin-top:6px}#J_ManageFooter .footer-top-line .footer-customer-service .customer-service-detail p,#J_ManageFooterUnified .footer-top-line .footer-customer-service .customer-service-detail p{margin:0}#J_ManageFooter .footer-top-line .footer-customer-service p,#J_ManageFooterUnified .footer-top-line .footer-customer-service p{color:#fff;font-size:13px;display:block;line-height:1.5}#J_ManageFooter .footer-customer-service .contact-service,#J_ManageFooterUnified .footer-customer-service .contact-service{display:inline-block;*display:inline;*zoom:1;color:#fff}#J_ManageFooter .footer-top-line .footer-customer-service .contact-icon,#J_ManageFooterUnified .footer-top-line .footer-customer-service .contact-icon{background:url() no-repeat 0 0;width:20px;height:22px;float:left}#J_ManageFooter .footer-bottom-line,#J_ManageFooterUnified .footer-bottom-line{margin-top:20px;padding-bottom:10px}#J_ManageFooter .footer-bottom-line .footer-bottom-link,#J_ManageFooterUnified .footer-bottom-line .footer-bottom-link{overflow:hidden}#J_ManageFooter .footer-bottom-line .bottom-link-detail,#J_ManageFooterUnified .footer-bottom-line .bottom-link-detail{margin-left:-6px}#J_ManageFooter .footer-bottom-line .bottom-link-detail a,#J_ManageFooterUnified .footer-bottom-line .bottom-link-detail a{text-decoration:none}#J_ManageFooter .footer-bottom-line a,#J_ManageFooterUnified .footer-bottom-line a{color:#fff;padding-left:8px;padding-right:8px;border-left:1px solid #f5f5f5;text-decoration:none}#J_ManageFooter .footer-bottom-line .bottom-link-title,#J_ManageFooterUnified .footer-bottom-line .bottom-link-title{color:#999;margin-top:4px}#J_ManageFooter .footer-bottom-line .footer-certify,#J_ManageFooterUnified .footer-bottom-line .footer-certify{margin-top:22px;color:#999}#J_ManageFooter .footer-bottom-line .footer-certify a,#J_ManageFooterUnified .footer-bottom-line .footer-certify a{color:#999}.browser-warning-wrapper{position:absolute;top:60px;left:0;z-index:10240;height:100%;width:100%;background:#efefef;text-align:center;border-top:1px solid #ddd}.browser-warning-wrapper .table{margin-top:50px;width:100%;display:table;border-collapse:collapse;text-align:center}.browser-warning-wrapper .table .tb-cell{width:50%;display:table-cell;vertical-align:middle}.browser-warning-wrapper .table .title{margin-top:50px;font-size:22px;font-weight:700}.browser-warning-wrapper .table .desc{margin-top:10px;font-size:18px;font-weight:700;line-height:22px;vertical-align:top}.browser-warning-wrapper .table .color-primary{color:red;vertical-align:top}.browser-warning-wrapper .table .color-primary img{vertical-align:top}</style>
  <style type="text/css">#J_ManageContent {
  background: #efefef;
}
.welcome-container {
  width: 960px;
  margin: 20px auto;
  background: #fff;
  padding: 30px 0 10px 0;
}
.welcome-container .banner-container {
  text-align: center;
}
.category-info,
.category-detail,
.category-enter {
  width: 750px;
  margin: 20px auto;
  border-bottom: 1px dashed #e0e0e0;
}
.category-info .title,
.category-detail .title,
.category-enter .title {
  padding-bottom: 5px;
}
.category-info .sub-title,
.category-detail .sub-title,
.category-enter .sub-title {
  color: #aaa;
  font-size: 15px;
  margin-bottom: 15px;
}
.category-info p,
.category-detail p,
.category-enter p {
  margin-bottom: 8px;
  color: #666;
}
.category-detail .item {
  width: 50%;
  margin-bottom: 20px;
  color: #666;
}
.category-detail i {
  background: url() no-repeat;
  display: inline-block;
  width: 43px;
  height: 43px;
  margin-right: 5px;
  vertical-align: middle;
}
.category-detail .flow {
  background-position: 0 0;
}
.category-detail .promotion {
  background-position: 0 -51px;
}
.category-detail .tool {
  background-position: 0 -102px;
}
.category-detail .flow {
  background-position: 0 -153px;
}
.category-enter {
  background: #efefef;
  padding: 20px;
  border-bottom: none;
}
.category-enter .text-primary {
  color: #f55;
}
</style>
 </head>
 <body class="  pace-done">
  <div class="pace  pace-inactive">
   <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);"> 
    <div class="pace-progress-inner"></div> 
   </div> 
   <div class="pace-activity"></div>
  </div> 
  <div id="J_ManageTopNav">
   <img src="{{ asset('home/assets/images/idid_ifqtam3fgu2tsyjxmizdambqgyyde_190x32.png') }}" style="margin-top:15px;margin-left:20px;">
  </div> 
  <div id="J_ManageBody"> 
   <div id="J_ManageContent"> 
    <div id="J_Page">
     <div data-reactid=".2">
      <div class="welcome-container" data-reactid=".2.0">
       <div class="banner-container" data-reactid=".2.0.0">
        <img src="{{ asset('home/assets/images/upload_ie2gcmbxgvrtonbvgmzdambqgiyde_750x340.jpg') }}" data-reactid=".2.0.0.0" />
       </div>
       <div class="category-info clearfix" data-reactid=".2.0.1">
        <div class="fl" data-reactid=".2.0.1.0">
         <h2 class="title" data-reactid=".2.0.1.0.0">类目市场</h2>
         <p class="sub-title" data-reactid=".2.0.1.0.1">Fashion Show</p>
         <p data-reactid=".2.0.1.0.2">蘑菇街基础类目市场涵盖女装、女包、女鞋、配饰、男装、美妆、家居、母婴等多</p>
         <p data-reactid=".2.0.1.0.3">个类目，为蘑菇街用户提供最时尚的款式。入驻类目市场，获得精准商品流量曝光</p>
         <p data-reactid=".2.0.1.0.4">，更有专业客户经理辅助，指导运营。</p>
        </div>
        <div class="fr" data-reactid=".2.0.1.1">
         <img src="{{ asset('home/assets/images/upload_ie2tenrrmuydontggezdambqhayde_168x226.jpg') }}" data-reactid=".2.0.1.1.0" />
        </div>
       </div>
       <div class="category-detail" data-reactid=".2.0.2">
        <h2 class="title" data-reactid=".2.0.2.0">类目市场权益</h2>
        <p class="sub-title" data-reactid=".2.0.2.1">Rights And Interests</p>
        <div class="clearfix" data-reactid=".2.0.2.2">
         <div class="item fl" data-reactid=".2.0.2.2.0">
          <i class="flow fl" data-reactid=".2.0.2.2.0.0"></i>
          <div class="desc fl" data-reactid=".2.0.2.2.0.1">
           <span data-reactid=".2.0.2.2.0.1.0">流量扶持，精准商品曝光</span>
           <br data-reactid=".2.0.2.2.0.1.1" />
           <span data-reactid=".2.0.2.2.0.1.2">蘑菇街千万活跃用户流量</span>
          </div>
         </div>
         <div class="item fl" data-reactid=".2.0.2.2.1">
          <i class="promotion fl" data-reactid=".2.0.2.2.1.0"></i>
          <div class="desc fl" data-reactid=".2.0.2.2.1.1">
           <span data-reactid=".2.0.2.2.1.1.0">大促活动支持</span>
           <br data-reactid=".2.0.2.2.1.1.1" />
           <span data-reactid=".2.0.2.2.1.1.2">每月促销活动，双十一双十二全站大促参与</span>
          </div>
         </div>
         <div class="item fl" data-reactid=".2.0.2.2.2">
          <i class="tool fl" data-reactid=".2.0.2.2.2.0"></i>
          <div class="desc fl" data-reactid=".2.0.2.2.2.1">
           <span data-reactid=".2.0.2.2.2.1.0">成熟的商家工具</span>
           <br data-reactid=".2.0.2.2.2.1.1" />
           <span data-reactid=".2.0.2.2.2.1.2">数据中心、粉丝工具、店铺装修工具</span>
          </div>
         </div>
         <div class="item fl" data-reactid=".2.0.2.2.3">
          <i class="client fl" data-reactid=".2.0.2.2.3.0"></i>
          <div class="desc fl" data-reactid=".2.0.2.2.3.1">
           <span data-reactid=".2.0.2.2.3.1.0">专业客户经理辅助</span>
           <br data-reactid=".2.0.2.2.3.1.1" />
           <span data-reactid=".2.0.2.2.3.1.2">客户经理手把手指导商家运营</span>
          </div>
         </div>
        </div>
       </div>
       <div class="category-enter" data-reactid=".2.0.3">
        <h2 class="title" data-reactid=".2.0.3.0">入驻方式</h2>
        <p class="sub-title" data-reactid=".2.0.3.1">Requirement</p>
        <p data-reactid=".2.0.3.2">如果你已有成熟的网店运营经验，有一定规模的正在运营中的网店作为认证（包括淘宝、天猫、京东等），且符合各类目的招商要求，可申请第一轮的审核，审核通过后，我们的特招人员会根据你提供的信息通过电话或者QQ与你洽谈，我们会根据你的实力帮你定向入驻，审核不通过，系统会发送一条信息到你填写的手机号码。</p>
        <p data-reactid=".2.0.3.3"><span data-reactid=".2.0.3.3.0">招商要求:</span><a class="xd-link" target="_blank" href="" data-reactid=".2.0.3.3.1">查看各类目招商要求和规则</a></p>
        <p data-reactid=".2.0.3.4"><span data-reactid=".2.0.3.4.0">联系我们：</span><a class="xd-btn primary" href="{{ url('home/MerApplication2') }}" data-reactid=".2.0.3.4.1">申请定向入驻</a></p>
        <p class="mt40 text-primary" data-reactid=".2.0.3.5"><span data-reactid=".2.0.3.5.0">提示：为形成良好向上的市场竞争环境，推动商家持续提升发展，从而不断提高消费者满意度，星级商家在蘑菇街经营，从2016年7月1日开始，蘑菇街将按照店铺每笔交易最终成交金额的一定比例收取技术服务费。具体规则请见：</span><a target="_blank" href="http://www.mogujie.com/rule/mogu?categoryId=309&amp;ruleId=1593" class="xd-link" data-reactid=".2.0.3.5.1">《技术服务费收费及返还规则》</a></p>
       </div>
      </div>
     </div>
    </div> 
   </div> 
  </div> 
   
  <script type="text/javascript" src="{{ asset('home/assets/js/sha256.min.js-a103c92c.js') }}"></script> 
  <!-- <script type="text/javascript" src="{{ asset('home/assets/js/index.js-fc135b41.js') }}"></script>  -->
  <script type="text/javascript" src="{{ asset('home/assets/js/trace.min.js') }}"></script> 
  <script type="text/javascript" src="{{ asset('home/assets/js/188116820283.js') }}" name="MTAH5" sid="500333767" cid="500333775" opts="{&quot;senseHash&quot;:false}"></script> 
 </body>
@include('layouts.home_footer') 
