@extends('layouts.StoreAdmin')

@section('content')
	<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
  <div class="widget am-cf">
    <div class="widget-head am-cf">
      <div class="widget-title am-fl">边框表单</div>
      <div class="widget-function am-fr">
        <a href="javascript:;" class="am-icon-cog"></a>
      </div>
    </div>
    @if (count($errors) > 0)
  <div >
    <font size="5">添加失败</font>
    <ul>
      @foreach ($errors -> all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
    <div class="widget-body am-fr">
      <form action="{{url('store/type')}}"  method="post" class="am-form tpl-form-border-form tpl-form-border-br">
       {{csrf_field()}}
        <div class="am-form-group">
          <label for="user-name" class="am-u-sm-3 am-form-label">商品/分类名称 :
          <span class="tpl-form-line-small-title"></span></label>
          <div class="am-u-sm-9">
            <input type="text" name="type_name" class="tpl-form-input" id="user-name" placeholder="请输入分类文字">
          </div>
        </div>
        
        <div class="am-form-group">
          <label for="user-phone" class="am-u-sm-3 am-form-label">父级分类 :
            <span class="tpl-form-line-small-title"></span>
          </label>
          <div class="am-u-sm-9">
            <select name="pid" data-am-selected="{searchBox: 1}" style="display: none;">
              <option value="0">==顶级分类==</option>
              @foreach($data as $k=>$v)
                  <?php 
                  $n = substr_count( $v['type_npath'] ,'-')-2;
                  $v['type_name'] = str_repeat('&nbsp;',$n*8).'|--'.$v['type_name'];
                  ?>
                  <option value="{{ $v['type_id'] }}">{{ $v['type_name'] }}</option>
              @endforeach   
             </select> 
             
            </select>
          </div>
        </div>

        <div class="am-form-group">
          <label class="am-u-sm-3 am-form-label">关键字 :
            <span class="tpl-form-line-small-title"></span></label>
          <div class="am-u-sm-9">
            <input name="type_keyword" type="text" placeholder="输入搜索关键字"></div>
        </div>
        
        <div class="am-form-group">
          <label class="am-u-sm-3 am-form-label">是否显示 :
            <span class="tpl-form-line-small-title"></span></label>
          <div class="am-u-sm-9">
            <input name="type_show" type="radio" value="1" />是&nbsp;&nbsp;
            <input name="type_show" type="radio" value="2" checked="checked" />否
        </div><br></br>

        <div class="am-form-group">
          <label class="am-u-sm-3 am-form-label">设为首页推荐 :
            <span class="tpl-form-line-small-title"></span></label>
          <div class="am-u-sm-9">
            <input name="type_recommend" type="checkbox" value="1" />精品&nbsp;&nbsp;
            <input name="type_recommend" type="checkbox" value="2" checked="checked" />最新&nbsp;&nbsp;
            <input name="type_recommend" type="checkbox" value="3" />热门
        </div><br></br>
        
        
        <div class="am-form-group">
          <label for="user-intro" class="am-u-sm-3 am-form-label">分类描述 :</label>
          <div class="am-u-sm-9">
            <textarea name="type_describe" class="" rows="10" id="user-intro" placeholder="请输入描述内容"></textarea>
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