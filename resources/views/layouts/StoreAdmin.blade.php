<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('web.conf_title') }}</title>
    <meta name="description" content="{{ config('web.conf_description') }}" />
    <meta name="keywords" content="{{ config('web.conf_keywords') }}" />
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('admin/assets/i/app-icon72x72@2x.png')}}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <script src="{{asset('admin/assets/js/echarts.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('admin/assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/css/amazeui.datatables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/css/app.css')}}">
    <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>
    <style>
        .button{
            font-size:10px;
            padding: 5px 15px 5px;
            margin: 2px 2px;
            border: none;
            background: #24a0d6;
            color: #FFF;
            cursor: pointer;
        }
    </style>
</head>
<body data-type="index">
    <script src="{{asset('admin/assets/js/theme.js')}}"></script>
    <div class="am-g tpl-g">
        <!-- 头部 -->
        <header>
            <!-- logo -->
            <div class="am-fl tpl-header-logo">
                <a href="javascript:;">
                <img src="{{asset('admin/assets/img/logo.png')}}" alt=""></a>
            </div>
            <!-- 右侧内容 -->
            <div class="tpl-header-fluid">
                <!-- 侧边切换 -->
                
                
                <!-- 其它功能-->
                <div class="am-fr tpl-header-navbar">
                    <ul>
                        <!-- 欢迎语 -->
                        <li class="am-text-sm tpl-header-navbar-welcome">
                            <a href="{{ url('store/admin/upassword') }}"><span>修改密码</span> </a>

                        </li>

                        <!-- 新邮件 -->
                        

                        <!-- 新提示 -->
                        

                        <!-- 退出 -->
                        <li class="am-text-sm">
                            <a href="javascript:;" onclick='Store_Logout()'>
                                <span class="am-icon-sign-out"></span> 退出
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>

        <!-- 侧边导航栏 -->
        <div class="left-sidebar">
            <!-- 用户信息 -->
            <div class="tpl-sidebar-user-panel">
                <div class="tpl-user-panel-slide-toggleable">
                    <div style="border-radius:100%;width:135px" class="tpl-user-panel-profile-picture">
                        <img src="http://php182.oss-cn-beijing.aliyuncs.com/uploads/config/201707082335265615.png" alt="">
                    </div>
                    <span class="user-panel-logged-in-text">
                         
                    </span>
                    <span style="color:#868E8E" >{{session('store_admin')['store_admin_name']}}</span> 
                </div>
            </div>

            <!-- 菜单 -->
            <ul class="sidebar-nav">
                
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 商品管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub" style="display: none;">
                        <li class="sidebar-nav-link">
                            <a href="{{ url('store/goods/create') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span>添加商品
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="{{ url('store/goods') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span>商品列表
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 分类管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub" style="display: none;">
                        <li class="sidebar-nav-link">
                            <a href="{{ url('store/type/create') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span>添加分类
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="{{ url('store/type') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span>分类列表
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 订单管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub" style="display: none;">
                        <li class="sidebar-nav-link">
                            <a href="{{ url('store/orders') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span>订单列表
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 店铺设置
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub" style="display: none;">
                        <li class="sidebar-nav-link">
                            <a href="{{ url('store/setup/basicsetup') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span>店铺基本设置
                            </a>
                        </li>
                        <li class="sidebar-nav-link">
                            <a href="{{ url('store/setup/information') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span>店铺基本信息
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 评论管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub" style="display: none;">
                        <li class="sidebar-nav-link">
                            <a href="{{ url('store/comment/index') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span>回复评论
                            </a>
                        </li>
                        <li class="sidebar-nav-link">
                            <a href="{{ url('store/comment/show') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span>查看评论
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper"  style="color: #868E8E"  >
        @if (count($errors) > 0)
        <div class="bg-danger">
            <ul>
                @foreach ($errors->all() as $error)

                    <li  style="background:#f0ad4e"  >{{ $error }}</li>

                @endforeach
            </ul>
        </div>
    @endif
    @if(session('error'))
       <p style="background:#f0ad4e">  {{session('error')}}</p>
    @endif
        @section('content')
        
        @show
        </div>
    </div>
    </div>
    <script src="{{asset('admin/assets/js/amazeui.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/amazeui.datatables.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/app.js')}}"></script>
    <script type="text/javascript">
        
        function Store_Logout()
        {
            layer.confirm('是否确认退出？', {
              btn: ['确认','取消'] 
            }, function(){
                $.get("{{url('store/admin/logout')}}", {}, function(data) {
                    layer.msg('正在退出', {icon: 6});
                    location.href="{{url('store/admin/login')}}";
                });
            }, function(){
            });

         }
       
    </script>
</body>

</html>