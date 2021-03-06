@extends('layouts.admin')

@section('content')
    <div class="widget-body am-fr">

        <form action="{{ url('admin/nav') }}" method="POST" class="am-form tpl-form-border-form tpl-form-border-br">
            @if (count($errors) > 0)
                <ul style="margin-left:350px;color:red">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            {{ csrf_field() }}
            <div class="am-form-group">
                <label for="user-name" class="am-u-sm-3 am-form-label"><font><font>导航名称</font></font>
                    <span class="tpl-form-line-small-title"><font><font></font></font></span></label>
                <div class="am-u-sm-9">
                    <input type="text" class="tpl-form-input" id="user-name" name="nav_name" value="{{ old('nav_name') }}" placeholder="请输入导航名称">
                    {{--<small><font><font>请填写导航名称</font></font></small>--}}
                </div>
            </div>
            <div class="am-form-group">
                <label for="user-name" class="am-u-sm-3 am-form-label"><font><font>导航地址</font></font>
                    <span class="tpl-form-line-small-title"><font><font></font></font></span></label>
                <div class="am-u-sm-9">
                    <input type="text" class="tpl-form-input" id="user-href" name="nav_url" value="http://47.94.85.247/{{ old('nav_url') }}" placeholder="请输入导航地址">
                    {{--<small><font><font>请填写网站域名</font></font></small>--}}
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


