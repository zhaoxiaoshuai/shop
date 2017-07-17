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
                <label for="user-name" class="am-u-sm-3 am-form-label"><font><font>标签名称</font></font>
                    <span class="tpl-form-line-small-title"><font><font>标签名</font></font></span></label>
                <div class="am-u-sm-9">
                    <input type="text" class="tpl-form-input" id="user-name" name="label_name" value="" placeholder="请输入标签名">
                    <small><font><font>请填写标签名称</font></font></small>
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


