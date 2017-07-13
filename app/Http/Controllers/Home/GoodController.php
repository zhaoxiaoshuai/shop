<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Good;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品列表页
     */
    public function goodList()
    {
        //取出所有非下架商品 商品状态0新品 1上架 2下架
        $goods = Good::where('good_status','!=','2')->paginate(4);
//        dd($goods);
        return view('home.good.goodlist',compact('goods'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 新品列表页
     */
    public function newgoodList()
    {
        //取出所有新品商品 商品状态0新品 1上架 2下架
        $newgoods = Good::where('good_status','=','0')->paginate(4);
//        dd($goods);
        return view('home.good.newgoodlist',compact('newgoods'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品详情页
     */
    public function goodDetail($id)
    {
        //浏览次数加1
        Good::where('good_id',$id)->increment('good_vcnt');
//        dd($a);
        //关联分类表
        $good =   Good::join('type','goods.type_id','=','type.type_id')->where('good_id',$id)->first();
//        dd($good);
        return view('home.good.gooddetail',compact('good'));
    }
}
