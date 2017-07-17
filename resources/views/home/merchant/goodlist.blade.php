@extends('layouts.home_merchant')
@section('content')
 <div class="content mar_20">
        <div class="l_list" style="width:100%" >
        	<div class="list_t">
            	<span class="fl list_or">
                	<a href="#" class="now">默认</a>
                    <a href="#">
                    	<span class="fl">销量</span>                        
                        <span class="i_up">销量从低到高显示</span>
                        <span class="i_down">销量从高到低显示</span>                                                     
                    </a>
                    <a href="#">
                    	<span class="fl">价格</span>                        
                        <span class="i_up">价格从低到高显示</span>
                        <span class="i_down">价格从高到低显示</span>     
                    </a>
                    <a href="#">新品</a>
                </span>
            </div>
            <div class="list_c">
                <ul class="cate_list">
                @foreach($goods as $k=>$v)
                	<li style="width:230px" >
                    	<div class="img"><a href="{{url('home/gooddetail/'.$v['good_id'])}}"><img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$v['good_pic']}}" width="210" height="185"></a></div>
                        <div class="price">
                            <font>￥<span>{{$v['good_price']}}</span></font> 
                        </div>
                        <div class="name"><a href="#">{{ $v['good_name'] }}</a></div>
                        <div class="carbg">
                        	<a href="#" class="ss">收藏</a>
                            <a href="#" class="j_car">加入购物车</a>
                        </div>
                    </li>
                @endforeach
                </ul>
               <!--  <div class="pages">
                	<a href="#" class="p_pre">上一页</a><a href="#" class="cur">1</a><a href="#">2</a><a href="#">3</a>...<a href="#">20</a><a href="#" class="p_pre">下一页</a>
                </div>
                -->
                <div class="pages">
                   {!! $goods -> render() !!}
                </div>
                
                
            </div>
        </div>
    </div>
    <style type="text/css">
        .pages .pagination li{
            float:left;
        }
        .active span{
            color: #FFF;
            background-color: #ff4e00;
            border: 1px solid #ff4e00;
        }
        .pages span{
            height: 36px;
            line-height: 36px;
            overflow: hidden;
            color: #666666;
            font-size: 16px;
            text-align: center;
            display: inline-block;
            padding: 0 12px;
            margin: 0 4px;
            border: 1px solid #cccccc;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
        }
    </style>
       <script>
		window.onload = function(){
			// 1.获取元素
			var li = document.getElementById('li');
			var ol = document.getElementById('ol');
			
			li.onmouseover = function(){
				ol.style.display = 'block';
			}

			li.onmouseout = function(){
				ol.style.display = 'none';
			}
		}
	</script>
@endsection