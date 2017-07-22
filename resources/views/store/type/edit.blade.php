@extends('layouts.StoreAdmin')

@section('content')
	<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
  <div class="widget am-cf">
    <div class="widget-head am-cf">
      <div class="widget-title am-fl">添加分类</div>
      <div class="widget-function am-fr">
        <a href="javascript:;" class="am-icon-cog"></a>
      </div>
    </div>
    @if(session('error'))
       <p style="background:#f0ad4e">  {{session('error')}}</p>
    @endif
    <div class="widget-body am-fr">
      <form action="{{url('store/type/'.$mtype['mtype_id'])}}"  method="post" class="am-form tpl-form-border-form tpl-form-border-br">
       {{csrf_field()}}
       <input type="hidden" name="_method" value="put">
        <div class="am-form-group">
          <label for="mtype_name" class="am-u-sm-3 am-form-label">分类名称 :
          <span class="tpl-form-line-small-title"></span></label>
          <div class="am-u-sm-9">
            <input type="text" name="mtype_name" class="tpl-form-input" id="mtype_name" value="{{$mtype['mtype_name']}}">
          </div>
        </div>
        <div class="am-form-group">
          <label for="pmtype_name" class="am-u-sm-3 am-form-label">父级分类 :
          <span class="tpl-form-line-small-title"></span></label>
          <div class="am-u-sm-9">
            <input type="text" name="pmtype_name" disabled="disabled" class="tpl-form-input" id="pmtype_name" value="@if($pmtype) {{$pmtype['mtype_name']}} @else 顶级分类  @endif">
          </div>
        </div>
        <div class="am-form-group">
          <div class="am-u-sm-9 am-u-sm-push-3">
            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">修改</button></div>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection