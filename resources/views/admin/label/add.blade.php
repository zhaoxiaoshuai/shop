@extends('layouts.admin')

@section('content')
    <div class="widget-body am-fr">

        <form action="{{ url('admin/label') }}" method="POST" class="am-form tpl-form-border-form tpl-form-border-br">
            @if (count($errors) > 0)
                <ul style="margin-left:350px;color:red">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            {{ csrf_field() }}
             <div class="am-form-group">
                <label for="user-phone" class="am-u-sm-3 am-form-label">分类名称 <span class="tpl-form-line-small-title"></span></label>
                <div class="am-u-sm-9">
                    <select data-am-selected="{searchBox: 0}"  name="type_id">
                        <option value="">请选择</option>
                        @foreach($types as $k=>$v)
                            <?php
                            $n = substr_count( $v['type_npath'] ,'-')-2;
                            $v['type_name'] = str_repeat('&nbsp;',$n*8).'|--'.$v['type_name'];
                            ?>
                            <option value="{{ $v['type_id'] }}">{{ $v['type_name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="am-form-group">
                <label for="user-name" class="am-u-sm-3 am-form-label"><font><font>标签名称</font></font>
                    <span class="tpl-form-line-small-title"><font></font></span></label>
                <div class="am-u-sm-9">
                    <input type="text" class="tpl-form-input" id="user-name" name="label_name" value="" placeholder="请输入标签名">
                    <small><font><font>请填写标签名称</font></font></small>
                </div>
            </div>
            <div class="am-form-group">
                <label for="label_attr_name" class="am-u-sm-3 am-form-label"><font><font>标签名称</font></font>
                    <span class="tpl-form-line-small-title"><font></font></span></label>
                <div class="am-u-sm-9">
                    <input type="text" class="tpl-form-input" id="label_attr_name" name="label_attr_name" value="" placeholder="请输入标签值">
                    <small><font><font>标签值与标签值之间用，分隔</font></font></small>
                </div>
            </div>
            <div class="am-form-group">
                <div class="am-u-sm-9 am-u-sm-push-3">
                    <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success "><font><font>提交</font></font></button>
                </div>
            </div>
        </form>
    </div>
@endsection


