@extends('layouts.admin')

@section('content')
    <div class="widget-body am-fr">
        @if(session('error'))
            <p style="background:#f0ad4e">  {{session('error')}}</p>
        @endif
        <form action="{{ url('admin/nav/'.$data->nav_id) }}" method="POST" class="am-form tpl-form-border-form tpl-form-border-br">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div class="am-form-group">
                <label for="user-name" class="am-u-sm-3 am-form-label"><font><font></font></font>
                    <span class="tpl-form-line-small-title"><font><font>导航名称</font></font></span></label>
                <div class="am-u-sm-9">
                    <input type="text" class="tpl-form-input" id="user-name" name="nav_name" value="{{ $data->nav_name }}" placeholder="请输入导航名称">
                    {{--<small><font><font>请填写导航名称</font></font></small>--}}
                </div>
            </div>
            <div class="am-form-group">
                <label for="user-name" class="am-u-sm-3 am-form-label"><font><font></font></font>
                    <span class="tpl-form-line-small-title"><font><font>域名</font></font></span></label>
                <div class="am-u-sm-9">
                    <input type="text" class="tpl-form-input" id="user-name" name="nav_url" value="{{ $data->nav_url }}" placeholder="请输入导航域名">
                    {{--<small><font><font>请填写导航地址</font></font></small>--}}
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


