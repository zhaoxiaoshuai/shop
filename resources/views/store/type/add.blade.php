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
    <div class="widget-body am-fr">
      <form action="{{url('store/type')}}"  method="post" class="am-form tpl-form-border-form tpl-form-border-br">
       {{csrf_field()}}
        <div class="am-form-group">
          <label for="mtype_name" class="am-u-sm-3 am-form-label">分类名称 :
          <span class="tpl-form-line-small-title"></span></label>
          <div class="am-u-sm-9">
            <input type="text" name="mtype_name" class="tpl-form-input" id="mtype_name" placeholder="请输入分类名称">
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-phone" class="am-u-sm-3 am-form-label">父级分类 :
            <span class="tpl-form-line-small-title"></span>
          </label>
          <div class="am-u-sm-9">
              <select name="mtype_pid" data-am-selected="{searchBox: 0}" style="display: none;">
                <option value="0">==顶级分类==</option>
                @foreach($mtype as $k=>$v)
                    <option value="{{ $v['mtype_id'] }}">{{ $v['_name'] }}</option>
                @endforeach   
               </select> 
          </div>
        </div>
        <div class="am-form-group">
          <div class="am-u-sm-9 am-u-sm-push-3">
            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button></div>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection