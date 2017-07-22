<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\Common;
class IndexController extends Common
{
    /**
     * 加载一个商城主页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //分类
        $type = DB::table('type')->where('pid',0)->get();
        //修改分类的CSS样式
        $i = 40;
        //轮播图
        $carousel = DB::table('carousel')->orderBy('id','desc')->limit(3)->get();
//        dd($carousel);
        //友情链接
        $link = DB::table('link')->limit(5)->get();
        //查询销量最高的几件商品
        $goods = DB::table('goods')->orderBy('good_salecnt','desc')->limit(5)->get();
//        dd($goods);
        //楼层
        $datas = DB::table('type')->where('pid',0)->limit(3)->get();
        
        return view('home.index',['data'=>$type,'i'=>$i,'carousel'=>$carousel,'link'=>$link,'goods'=>$goods,'datas'=>$datas]);
    }


}

