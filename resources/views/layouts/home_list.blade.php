            <!--Begin 商品分类详情 Begin-->
            <div class="nav">
                <div class="nav_t">全部商品分类</div>
                <div class="leftNav">
                   <ul >
                   @foreach($data as $k=>$v)
                    <li >
                        <a href="home/goodlist/{{$v['type_id']}}"><div class="fj">
                            <span class="n_img"></span>
                            <span class="fl">{{ $v['type_name']}}</span>
                             </div>
                        </a>
                        <div class="zj" >
                            <div class="zj_l">
                                <?php $type2 = DB::table('type')->where('pid',$v['type_id'])->get(); ?>

                                @foreach($type2 as $k2 => $v2)
                                <div class="zj_l_c">
                                    <h2><a href="home/goodlist/{{$v2['type_id']}}">{{ $v2['type_name'].'/' }} </a></h2>
                                    <?php $type3 = DB::table('type')->where('pid',$v2['type_id'])->get(); ?>
                                    @if(!empty($type3))
                                     @foreach($type3 as $k3 => $v3)
                                    <a href="home/goodlist/{{$v3['type_id']}}">{{ $v3['type_name'].'|'}}</a>
                                    @endforeach
                                     @endif
                                </div>
                                    @endforeach
                        </div>
                    </li>
                    @endforeach         
                </ul>
                </div>
            </div>
            <!--End 商品分类详情 End-->