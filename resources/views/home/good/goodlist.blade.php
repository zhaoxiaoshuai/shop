@extends('layouts.home_good')

@section('content')

<div class="i_bg">
	<div class="postion">
    	<span class="fl">全部 >  </span>
        <!-- <span class="n_ch">
            <span class="fl">品牌：<font>香奈儿</font></span>
            <a href="#"><img src="images/s_close.gif" /></a>
        </span> -->
    </div>
    <!--Begin 筛选条件 Begin-->
    <div class="content mar_10">
    	<table border="0" class="choice" style="width:100%; font-family:'宋体'; margin:0 auto;" cellspacing="0" cellpadding="0">  
        @foreach($arr as $k=>$v)                                        
          <tr>
            <td>&nbsp; {{$v['label_name']}}:</td>
            <td class="td_a">
            @foreach($v['attr'] as $m=>$n)
            <a href="{{url('home/goodlist/'.$type_id.'?la_id='.$n['la_id'])}}">{{$n['label_attr_name']}}</a>
            @endforeach
            </td>
          </tr>                                          
        @endforeach                             
        </table>                                                                                 
    </div>
    <!--End 筛选条件 End-->
    
    <div class="content mar_20">
    	<div class="l_history">
        	<div class="his_t">
            	<span class="fl">热销</span>
                <span class="fr"><a href="#"></a></span>
            </div>
        	<ul>
                @foreach($good as $n)
            	<li>
                    <div class="img"><a href="{{url('home/gooddetail')}}/{{$n->good_id}}"><img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$n->good_pic}}" width="185" height="162" /></a></div>
                	<div class="name"><a href="{{url('home/gooddetail')}}/{{$n->good_id}}">{{$n->good_name}}</a></div>
                    <div class="price">
                    	<font>￥<span>{{$n->good_price}}</span></font> &nbsp;
                    </div>
                </li>
                @endforeach
        	</ul>
        </div>
        <div class="l_list">
        	<div class="list_t">
            	<span class="fl list_or">
                	<a href="{{url('home/goodlist/').'/'.$type_id}}" class="now">默认</a>
                    <a href="{{url('home/goodlist/').'/'.$type_id.'?order=good_salecnt'}}{{empty($d) || $d == 'asc'? '&d=desc' : ''}}" id="sale">
                    	<span class="fl">销量</span>                        
                        <span class="i_up">销量从低到高显示</span>
                        <span class="i_down">销量从高到低显示</span>
                    </a>

                    <a href="{{url('home/goodlist/').'/'.$type_id.'?order=good_price'}}{{empty($d) || $d == 'asc'? '&d=desc' : ''}}">
                    	<span class="fl">价格</span>                        
                        <span class="i_up">价格从低到高显示</span>
                        <span class="i_down">价格从高到低显示</span>     
                    </a>
                    <a href="{{url('home/newgoodlist/').'/'.$type_id}}">新品</a>
                </span>
                <span class="fr">共发现{{count($goods)}}件</span>
                <span class="fr"></span>
            </div>


            <div class="list_c">
            	
                <ul class="cate_list">
                    @foreach($goods as $k=>$v)
                	<li>
                    	<div class="img"><a href="{{url('home/gooddetail')}}/{{$v->good_id}}"><img src="http://php182.oss-cn-beijing.aliyuncs.com/{{$v->good_pic}}" width="210" height="185" /></a></div>
                        <div class="price">
                            <font>￥<span>{{$v->good_price}}</span></font> &nbsp;
                        </div>
                        <div class="name"><a href="{{url('home/gooddetail')}}/{{$v->good_id}}">{{$v->good_name}}</a></div>
                        <div class="carbg">
                        	<a href="#" class="ss">收藏</a>
                            <a href="#" class="j_car">加入购物车</a>
                        </div>
                    </li>
                        @endforeach
                </ul>

                <div class="pages">
                    {!! $goods->render() !!}
                </div>
                <style>
                    .pages .pagination{
                        float:right;
                    }
                    .pages .pagination li{
                        display: inline-block;
                        float: left;
                    }
                    .pages .pagination li span {
                        height: 36px;
                        line-height: 36px;
                        overflow: hidden;
                        text-align: center;
                        display: inline-block;
                        margin: 0 4px;
                        border: 1px solid #cccccc;
                        font-size: 15px;
                        padding: 0px 12px;
                        /*background: #ff4e00;*/
                        /*color:#FFF;*/
                    }
                    .pagination .active span{
                        background: #ff4e00;
                        color:#FFF;
                    }
                </style>
            </div>
        </div>
    </div>
 @endsection


