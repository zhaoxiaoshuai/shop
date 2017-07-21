@extends('layouts.home_user')


@section('content')
    @if(session('updateok'))
        <script>
            layer.msg('修改成功',{icon:1});
        </script>
    @endif
        <form action="{{url('home/user/update')}}" id="user_form" method="post">
            <div class="m_right">
                <div class="m_des">
                    <table border="0" style="width:870px; line-height:22px;" cellspacing="0" cellpadding="0">

                        <tr valign="top">
                            <td width="115" style="position: relative;"><img src="@if(empty($deta->deta_face)) {{url('uploads/config/touxiang.jpg')}} @else {{url("".$deta->deta_face)}} @endif" name="pic" id="pic" width="90" height="90" />
                                <input type="hidden" name="deta_face" id="user_pic" style="width:300px;" value="{{$deta->deta_face}}">
                                <input type="file" class="file_file" name="file_upload" id="file_upload" value="">
                                <input type="button" value="上传头像" class="btn_btn">
                                <br>
                            <td>
                                <div class="m_user">用户名 : {{$data->user_name}} </div>
                                <div>积分 : <strong style="color:red;">{{$deta->deta_score}}</strong></div>
                                <p>
                                    上一次登录时间:
                                        @if(session('logins')['lasttime'] == 0)
                                             {{('您是第一次登陆哦!') }}
                                        @else
                                            {{date('Y年-m月-d日 H:i:s',session('logins')['lasttime'])}}
                                        @endif
                                </p>
                                <div>注册日期 : <strong>{{date('Y年-m月-d日',$data->createtime)}}</strong> </div>
                                <div class="m_notice">
                                    用户中心公告！
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                @if(session('error'))
                    <script>
                        layer.msg('修改失败',{icon:5});
                    </script>
                    @endif
                @if(session('okupdate'))
                    <script>
                        layer.msg('修改成功',{icon:1});
                    </script>
                @endif
                <div class="mem_t">账号信息</div>
                    {{csrf_field()}}
                    <input type="hidden" name="user_id" value="{{$data -> user_id}}">
                    <span style="margin:0px 100px;">
                        <em style="color:red;">*</em>&nbsp;&nbsp;&nbsp;昵&nbsp;&nbsp;&nbsp;&nbsp;称&nbsp;:&nbsp;
                        <div class="layui-inline">
                            <input type="text" class="layui-input" name="deta_name" value="{{$deta->deta_name}}">
                            </div>
                    </span><br /><br />
                    <span style="margin:0px 100px;">
                        <em style="color:red;">*</em>&nbsp;&nbsp;&nbsp;性&nbsp;&nbsp;&nbsp;&nbsp;别&nbsp;:&nbsp;
                            <input type="radio" @if($deta->deta_sex=='男') {{'checked'}}  @endif name="deta_sex" class="jdradio" value="男"><label class="mr10">男</label>
                            <input type="radio" @if($deta->deta_sex=='女') {{'checked'}}  @endif name="deta_sex" class="jdradio" value="女"><label class="mr10">女</label>
                            <input type="radio" @if($deta->deta_sex=='保密') {{'checked'}}  @endif name="deta_sex" class="jdradio" value="保密"><label class="mr10">保密</label>
                    </span><br /><br />
                    <span style="margin:0px 100px;">
                        <em style="color:red;">*</em>&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;龄&nbsp;:&nbsp;
                        <div class="layui-inline">
                        <input type="text" class="layui-input" name="deta_age" value="{{$deta->deta_age}}">
                            </div>
                    </span><br><br>

                                        <script type="text/javascript">
                                            $(function () {
                                                $("#file_upload").change(function () {

                                                    uploadImage();
                                                });
                                            });

                                            function uploadImage() {
                                                 // 判断是否有选择上传文件
                                                var imgPath = $("#file_upload").val();
                                                if (imgPath == "") {
                                                    alert("请选择上传图片！");
                                                    return;
                                                }
                                                //判断上传文件的后缀名
                                                var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                                if (strExtension != 'jpg' && strExtension != 'gif'
                                                    && strExtension != 'png' && strExtension != 'bmp') {
                                                    alert("请选择图片文件");
                                                    return;
                                                }

                                                var formData = new FormData($('#user_form')[0]);

                                                $.ajax({
                                                    type: "POST",
                                                    url: "/home/user/upload",
                                                    data: formData,
                                                    async: true,
                                                    cache: false,
                                                    contentType: false,
                                                    processData: false,
                                                    success: function(data) {
//                                    console.log(data);
//                                    alert("上传成功");

                                                        $('#pic').attr('src','http://php182.oss-cn-beijing.aliyuncs.com/'+data);

                                                        $('#pic').show();
                                                        $('#user_pic').val('http://php182.oss-cn-beijing.aliyuncs.com/'+data);

                                                    },
                                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                        alert("上传失败，请检查网络后重试");
                                                    }
                                                });
                                            }

                                        </script>
                    <span style="margin:0px 100px;">
                        <em style="color:red;">*</em>&nbsp;&nbsp;&nbsp;所在地&nbsp;:&nbsp;
                        <div class="layui-inline">
                        <input type="text" class="layui-input" name="deta_addr" value="{{$deta->deta_addr}}">
                        </div>
                    </span><br><br>
                <span style="margin:0px 100px;">
                <em style="color:red;">*</em>&nbsp;&nbsp;&nbsp;生&nbsp;&nbsp;&nbsp;&nbsp;日&nbsp;:&nbsp;
                <div class="layui-inline">
                    <input class="layui-input" name="deta_birthday" placeholder="选择生日" value="{{date('Y-m-d',$deta->deta_birthday)}}" onclick="layui.laydate({elem: this, festival: true})">
                </div>
                    </span><br><br>
                <script>
                    layui.use('laydate', function(){
                        var laydate = layui.laydate;
                        var start = {
                            min: laydate.now()
                            ,max: '2099-06-16 23:59:59'
                            ,istoday: false
                            ,choose: function(datas){
                                end.min = datas; //开始日选好后，重置结束日的最小日期
                                end.start = datas //将结束日的初始值设定为开始日
                            }
                        };

                        var end = {
                            min: laydate.now()
                            ,max: '2099-06-16 23:59:59'
                            ,istoday: false
                            ,choose: function(datas){
                                start.max = datas; //结束日选好后，重置开始日的最大日期
                            }
                        };
                    });
                </script>
                    <span style="margin:0px 100px;">
                        <em style="color:red;">*</em>&nbsp;&nbsp;&nbsp;职&nbsp;&nbsp;&nbsp;&nbsp;业&nbsp;:&nbsp;
                        <div class="layui-inline">
                        <select class="layui-input" name="deta_job" id="industryInfo">
                            <option value="">请选择</option>
                            <option  @if($deta->deta_job=='计算机硬件及网络设备') {{'selected'}}  @endif value="计算机硬件及网络设备">计算机硬件及网络设备</option>
                            <option  @if($deta->deta_job=='计算机软件') {{'selected'}}  @endif value="计算机软件">计算机软件</option>
                            <option  @if($deta->deta_job=='IT服务（系统/数据/维护）/多领域经营') {{'selected'}}  @endif value="IT服务（系统/数据/维护）/多领域经营">IT服务（系统/数据/维护）/多领域经营</option>
                            <option  @if($deta->deta_job=='互联网/电子商务') {{'selected'}}  @endif value="互联网/电子商务">互联网/电子商务</option>
                            <option  @if($deta->deta_job=='网络游戏') {{'selected'}}  @endif value="网络游戏">网络游戏</option>
                            <option  @if($deta->deta_job=='通讯（设备/运营/增值服务）') {{'selected'}}  @endif value="通讯（设备/运营/增值服务）">通讯（设备/运营/增值服务）</option>
                            <option  @if($deta->deta_job=='电子技术/半导体/集成电路') {{'selected'}}  @endif value="电子技术/半导体/集成电路">电子技术/半导体/集成电路</option>
                            <option  @if($deta->deta_job=='仪器仪表及工业自动化') {{'selected'}}  @endif value="仪器仪表及工业自动化">仪器仪表及工业自动化</option>
                            <option  @if($deta->deta_job=='金融/银行/投资/基金/证券') {{'selected'}}  @endif value="金融/银行/投资/基金/证券">金融/银行/投资/基金/证券</option>
                            <option  @if($deta->deta_job=='保险') {{'selected'}}  @endif value="保险">保险</option>
                            <option  @if($deta->deta_job=='房地产/建筑/建材/工程') {{'selected'}}  @endif value="房地产/建筑/建材/工程">房地产/建筑/建材/工程</option>
                            <option  @if($deta->deta_job=='家居/室内设计/装饰装潢') {{'selected'}}  @endif value="家居/室内设计/装饰装潢">家居/室内设计/装饰装潢</option>
                            <option  @if($deta->deta_job=='物业管理/商业中心') {{'selected'}}  @endif value="物业管理/商业中心">物业管理/商业中心</option>
                            <option  @if($deta->deta_job=='广告/会展/公关/市场推广') {{'selected'}}  @endif value="广告/会展/公关/市场推广">广告/会展/公关/市场推广</option>
                            <option  @if($deta->deta_job=='媒体/出版/影视/文化/艺术') {{'selected'}}  @endif value="媒体/出版/影视/文化/艺术">媒体/出版/影视/文化/艺术</option>
                            <option  @if($deta->deta_job=='咨询/管理产业/法律/财会') {{'selected'}}  @endif value="咨询/管理产业/法律/财会">咨询/管理产业/法律/财会</option>
                            <option  @if($deta->deta_job=='印刷/包装/造纸') {{'selected'}}  @endif value="印刷/包装/造纸">印刷/包装/造纸</option>
                            <option  @if($deta->deta_job=='检验/检测/认证') {{'selected'}}  @endif value="检验/检测/认证">检验/检测/认证</option>
                            <option  @if($deta->deta_job=='教育/培训') {{'selected'}}  @endif value="教育/培训">教育/培训</option>
                            <option  @if($deta->deta_job=='贸易/进出口') {{'selected'}}  @endif value="贸易/进出口">贸易/进出口</option>
                            <option  @if($deta->deta_job=='中介服务') {{'selected'}}  @endif value="中介服务">中介服务</option>
                            <option  @if($deta->deta_job=='快速消费品（食品/饮料/烟酒/化妆品') {{'selected'}}  @endif value="快速消费品（食品/饮料/烟酒/化妆品">快速消费品（食品/饮料/烟酒/化妆品</option>
                            <option  @if($deta->deta_job=='零售/批发') {{'selected'}}  @endif value="零售/批发">零售/批发</option>
                            <option  @if($deta->deta_job=='办公用品及设备') {{'selected'}}  @endif value="办公用品及设备">办公用品及设备</option>
                            <option  @if($deta->deta_job=='耐用消费品（服装服饰/纺织/皮革/家具/家电）') {{'selected'}}  @endif value="耐用消费品（服装服饰/纺织/皮革/家具/家电）">耐用消费品（服装服饰/纺织/皮革/家具/家电）</option>
                            <option  @if($deta->deta_job=='大型设备/机电设备/重工业') {{'selected'}}  @endif value="大型设备/机电设备/重工业">大型设备/机电设备/重工业</option>
                            <option  @if($deta->deta_job=='礼品/玩具/工艺美术/收藏品') {{'selected'}}  @endif value="礼品/玩具/工艺美术/收藏品">礼品/玩具/工艺美术/收藏品</option>
                            <option  @if($deta->deta_job=='汽车/摩托车（制造/维护/配件/销售/服务）') {{'selected'}}  @endif value="汽车/摩托车（制造/维护/配件/销售/服务）">汽车/摩托车（制造/维护/配件/销售/服务）</option>
                            <option  @if($deta->deta_job=='加工制造（原料加工/模具）') {{'selected'}}  @endif value="加工制造（原料加工/模具）">加工制造（原料加工/模具）</option>
                            <option  @if($deta->deta_job=='医药/生物工程') {{'selected'}}  @endif value="医药/生物工程">医药/生物工程</option>
                            <option  @if($deta->deta_job=='交通/运输/物流') {{'selected'}}  @endif value="交通/运输/物流">交通/运输/物流</option>
                            <option  @if($deta->deta_job=='酒店/餐饮') {{'selected'}}  @endif value="酒店/餐饮">酒店/餐饮</option>
                            <option  @if($deta->deta_job=='娱乐/体育/休闲') {{'selected'}}  @endif value="娱乐/体育/休闲">娱乐/体育/休闲</option>
                            <option  @if($deta->deta_job=='医疗/护理/美容/保健') {{'selected'}}  @endif value="医疗/护理/美容/保健">医疗/护理/美容/保健</option>
                            <option  @if($deta->deta_job=='医疗设备/器械') {{'selected'}}  @endif value="医疗设备/器械">医疗设备/器械</option>
                            <option  @if($deta->deta_job=='能源/矿产/采掘/冶炼') {{'selected'}}  @endif value="能源/矿产/采掘/冶炼">能源/矿产/采掘/冶炼</option>
                            <option  @if($deta->deta_job=='电气/电力/水利') {{'selected'}}  @endif value="电气/电力/水利">电气/电力/水利</option>
                            <option  @if($deta->deta_job=='旅游/度假') {{'selected'}}  @endif value="旅游/度假">旅游/度假</option>
                            <option  @if($deta->deta_job=='石油/石化/化工') {{'selected'}}  @endif value="石油/石化/化工">石油/石化/化工</option>
                            <option  @if($deta->deta_job=='政府/公共事业/非盈利机构') {{'selected'}}  @endif value="政府/公共事业/非盈利机构">政府/公共事业/非盈利机构</option>
                            <option  @if($deta->deta_job=='环保') {{'selected'}}  @endif value="环保">环保</option>
                            <option  @if($deta->deta_job=='航空/航天') {{'selected'}}  @endif value="航空/航天">航空/航天</option>
                            <option  @if($deta->deta_job=='学术/科研') {{'selected'}}  @endif value="学术/科研">学术/科研</option>
                            <option  @if($deta->deta_job=='其它') {{'selected'}}  @endif value="其它">其它</option>
                            <option  @if($deta->deta_job=='农/林/牧/渔') {{'selected'}}  @endif value="农/林/牧/渔">农/林/牧/渔</option>
                            <option  @if($deta->deta_job=='跨领域经营') {{'selected'}}  @endif value="跨领域经营">跨领域经营</option>
                        </select>
                            </div>
                    </span><br><br>
                    <span style="margin:0px 200px;">
                        <input type="submit" class="layui-btn" value="修改">
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </span>
                </form>
            </div>
        </div>
        <!--End 用户中心 End-->

@endsection