@extends('layouts.home_user')

@section('content')
		<div class="m_right">
            <p></p>			
            <div class="mem_tit">
            	<span class="fr" style="font-size:12px; color:#55555; font-family:'宋体'; margin-top:5px;"><a href="" onclick="history.go(-1)">返回上一级操作</a></span>用户评价
            </div>
            <form action="{{ url('home/comment') }}" method="POST">
                {{ csrf_field() }}
			<table border="0" class="ma_tab" style="width:930px; margin-bottom:30px;" cellspacing="0" cellpadding="0">
                @foreach($data as $v)
                        <input type="hidden" name="user_id" value="{{ $v['user_id'] }}">
                        <input type="hidden" name="good_id" value="{{ $v['good_id'] }}">
                        <input type="hidden" name="merchant_id" value="{{ $v['merchant_id'] }}">
                        <input type="hidden" name="order_id" value="{{ $v['order_id'] }}">
              <tr>
                <td>商品</td>
                <td colspan="2"><div class="sm_img"><img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $v['good_pic'] }}" width="48" height="48" /></div>{{ $v['good_name'] }}</td>
              </tr>
                    @endforeach
              <tr valign="top" height="80">
                <td>商品满意度</td>
                <td colspan="2" style="padding-top:10px;">
                    <input type="radio" name="level" value="1">差评
                    <input type="radio" name="level" value="2">中评
                    <input type="radio" name="level" value="3">好评
                </td>
              </tr>
                <tr valign="top" height="180">
                    <td>评价晒单</td>
                    <td colspan="2" style="padding-top:10px;"><textarea class="add_txt" style="width:540px; height:130px;" name="connect"></textarea></td>
                </tr>
			</table>
            
            <p align="center">
            	<input type="submit" value="提交" class="btn_tj" />
            </p>
            </form>
        </div>
 @endsection
