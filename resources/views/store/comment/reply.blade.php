@extends('layouts.StoreAdmin')

@section('content')
  <div class="am-u-sm-12 am-u-md-12 am-u-lg-12"> 
  <div class="widget am-cf"> 
    <div class="widget-head am-cf"> 
      <div class="widget-title am-fl">
        商品评论回复
      </div> 
      <div class="widget-function am-fr"> 
        <a href="javascript:;" class="am-icon-cog"></a> 
      </div> 
    </div> 
    <div class="widget-body am-fr">
   
    
  <form action="{{ url('store/comment/reply')}}" method="post" class="am-form tpl-form-border-form tpl-form-border-br">
  <input type="hidden" name="id" value="{{ $com['id'] }}">
  {{ csrf_field() }} 
    <div class="am-form-group"> 
      <label for="user-name" class="am-u-sm-3 am-form-label">商品名称</label> 
      <div class="am-u-sm-9"> 
        <input type="text" name="" value="{{ $com['good_name'] }}" class="tpl-form-input am-margin-top-xs " id="user-name" placeholder="" readonly/> 
      </div> 
    </div> 
    <div class="am-form-group"> 
      <label for="user-name" class="am-u-sm-3 am-form-label">商品图片</label> 
      <div class="am-u-sm-9"> 
        <img src="http://php182.oss-cn-beijing.aliyuncs.com/{{ $com['good_pic'] }}" style="width:200px;height:100px;">
      </div> 
    </div>
    <div class="am-form-group"> 
      <label for="user-name" class="am-u-sm-3 am-form-label">商品价格</label> 
      <div class="am-u-sm-9"> 
        <input type="text" name="" value="{{ $com['good_price'] }}" class="tpl-form-input" id="user-name" placeholder="" readonly/> 
      </div> 
    </div>
    <div class="am-form-group"> 
      <label for="user-name" class="am-u-sm-3 am-form-label">评论等级</label> 
      <div class="am-u-sm-9"> 
        <input type="text" name="" value="{{ $arr[$com['comment_level']] }}" class="tpl-form-input" id="user-name" placeholder="" readonly/> 
      </div> 
    </div>
    <div class="am-form-group"> 
      <label for="user-name" class="am-u-sm-3 am-form-label">评论内容</label> 
      <div class="am-u-sm-9"> 
        <textarea class="" name="" value="" rows="10" id="user-intro" readonly>{{ $com['comment_connect'] }}</textarea>
      </div> 
    </div>
    <div class="am-form-group"> 
      <label for="user-name" class="am-u-sm-3 am-form-label">评论时间</label> 
      <div class="am-u-sm-9"> 
        <input type="text" name="" value="{{ date('Y-m-d H:i:s',$com['comment_time']) }}" class="tpl-form-input" id="user-name" placeholder="" readonly/> 
      </div> 
    </div>
    <div class="am-form-group"> 
      <label for="user-name" class="am-u-sm-3 am-form-label">回复内容</label> 
      <div class="am-u-sm-9"> 
        <textarea class="" name="reply_connect" value="" rows="10" id="user-intro" placeholder=""></textarea> 
      </div> 
    </div>
    
    <div class="am-form-group"> 
      <div class="am-u-sm-9 am-u-sm-push-3"> 
        <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">回复</button> 
      </div>
    </div>
    <div class="am-form-group"> 
      <div class="am-u-sm-9 am-u-sm-push-3"> 
        <button type="button" onclick="history.go(-1)" class="am-btn am-btn-primary tpl-btn-bg-color-success ">返回</button> 
      </div>
    </div> 
  </form>
    </div> 
  </div> 
   </div>
@endsection
