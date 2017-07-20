@extends('layouts.admin')

@section('content')
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">标签列表</div>
                    </div>
                <div class="am-u-sm-12">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>值</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($attr))
                            @foreach($attr as $k => $v)
                                <tr class="gradeX">
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $v['label_attr_name'] }}</td>
                                </tr>
                            @endforeach
                        @endif
                        <!-- more data -->
                        </tbody>
                    </table>
                    <button style="float:right" class="am-btn am-btn-primary tpl-btn-bg-color-success " onclick="javascript:history.back(-1);" ><font><font>返回</font></font></button>
                </div>
                <div class="am-u-lg-12 am-cf">
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection