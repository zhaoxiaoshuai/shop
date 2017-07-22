@extends('layouts.admin')

@section('content')
<div class="widget-body am-fr">
        @if (count($errors) > 0)
            <ul style="margin-left:350px;color:red">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if(session('error'))
           <p style="background:#f0ad4e">  {{session('error')}}</p>
         @endif
        <form action="{{ url('admin/label/'.$label['label_id']) }}" method="POST" class="am-form tpl-form-border-form tpl-form-border-br">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div class="am-form-group">
                <label for="user-name" class="am-u-sm-3 am-form-label"><font><font>标签名称</font></font>
                    <span class="tpl-form-line-small-title"><font><font>标签名</font></font></span></label>
                <div class="am-u-sm-9">
                    <input type="text" class="tpl-form-input" id="user-name" name="label_name" value="{{ $label->label_name }}" placeholder="请输入标签名">
                    <small><font><font></font></font></small>
                </div>
            </div>
              <div class="am-form-group">
                <label for="label_attr_name" class="am-u-sm-3 am-form-label"><font><font>标签名称</font></font>
                    <span class="tpl-form-line-small-title"><font></font></span></label>
                <div class="am-u-sm-9">
                    <input type="text" class="tpl-form-input" id="label_attr_name" name="label_attr_name" value="{{$str}}" placeholder="请输入标签值">
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


