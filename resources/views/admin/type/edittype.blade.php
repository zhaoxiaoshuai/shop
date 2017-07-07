@extends('layouts.admin')

@section('content')
  
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
  <div class="widget am-cf">
    <div class="widget-head am-cf">
      <div class="widget-title am-fl"><a href="{{url('admin/atype')}}">返回查看</a></div>
      <div class="widget-function am-fr">
        <a href="javascript:;" class="am-icon-cog"></a>
      </div>

    </div>
    @if (count($errors) > 0)
  <div >
    <font size="5">修改失败</font>
    <ul>
      @foreach ($errors -> all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
    <div class="widget-body am-fr">
     @foreach($data as $k=>$v)
      <form action="{{url('admin/atype/'.$v['type_id'])}}"  method="post" class="am-form tpl-form-border-form tpl-form-border-br">
       {{csrf_field()}}
      <input type="hidden" name="_method" value="put">
        <div class="am-form-group">
          <label for="user-name" class="am-u-sm-3 am-form-label">商品/分类名称 :
          <span class="tpl-form-line-small-title"></span></label>
          <div class="am-u-sm-9">
            <input type="text" value="{{ $v['type_name'] }}" name="type_name" class="tpl-form-input" id="user-name" placeholder="请输入分类文字">
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-phone" class="am-u-sm-3 am-form-label">父级分类 :
            <span class="tpl-form-line-small-title"></span>
          </label>
          <div class="am-u-sm-9 ">
            <select name="good_id" data-am-selected="{searchBox: 1}" disabled="disabled" style="display: none;">
                  <?php 
                    $n = substr_count( $v['type_npath'] ,'-')-2;
                    $v['type_name'] = str_repeat('&nbsp;',$n*8).'|--'.$v['type_name'];
                  ?>
                    <option value="{{ $v['type_name'] }}">{{ $v['type_name'] }}</option>
             </select>   
            </select>
          </div>
        </div>

        <div class="am-form-group">
          <label class="am-u-sm-3 am-form-label">关键字 :
            <span class="tpl-form-line-small-title"></span></label>
          <div class="am-u-sm-9">
            <input name="type_keyword" type="text" value="{{ $v['type_keyword'] }}"></div>
        </div>
        
        <div class="am-form-group">
          <label class="am-u-sm-3 am-form-label">是否显示 :
            <span class="tpl-form-line-small-title"></span></label>
          <div class="am-u-sm-9">
            <?php
              $res = $v['type_show'];
            ?>
            <input name="type_show" type="radio" <?php if($res == '1'){echo 'checked';}?>  value="{{ $v['type_show'] }}" />是&nbsp;&nbsp;
            <input name="type_show" type="radio" <?php if($res == '2'){echo 'checked';}?> value="{{ $v['type_show'] }}"  />否
        </div><br></br>

        <div class="am-form-group">
          <label class="am-u-sm-3 am-form-label">设为首页推荐 :
            <span class="tpl-form-line-small-title"></span></label>
          <div class="am-u-sm-9">
          <?php
            $res = $v['type_recommend']
          ?>
            <input name="type_recommend" <?php if($res == '1'){echo 'checked';}?> type="radio" value="{{ $v['type_recommend'] }}" />精品&nbsp;&nbsp;
            <input name="type_recommend" <?php if($res == '2'){echo 'checked';}?> type="radio" value="{{ $v['type_recommend'] }}" checked="checked" />最新&nbsp;&nbsp;
            <input name="type_recommend" <?php if($res == '3'){echo 'checked';}?> type="radio" value="{{ $v['type_recommend'] }}" />热门

        </div><br></br>
        
        
        <div class="am-form-group">
          <label for="user-intro" class="am-u-sm-3 am-form-label">分类描述 :</label>
          <div class="am-u-sm-9">
            <textarea name="type_describe" type="text" class="" rows="10" id="user-intro" value="{{ $v['type_describe'] }}">{{ $v['type_describe'] }}</textarea>
          </div>
        </div>
         @endforeach
        <div class="am-form-group">
          <div class="am-u-sm-9 am-u-sm-push-3">
            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button></div>
        </div>
      </form>

    </div>
  </div>
</div>


@endsection