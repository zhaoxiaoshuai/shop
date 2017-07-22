<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Common;
use App\Http\Model\Merchant;
use App\Http\Model\Mtype;
use App\Http\Model\Good;

class MerchantController extends Common
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        // dd($request->all());
        //获取店铺id
        if(!$request->has('merchant_id')){
            return view('errors.404');
        }
        $id = $request->input('merchant_id');
        //获取店铺信息
        $merchant = Merchant::where('merchant_id',$id)->get()[0];
        //获取店铺分类
        $mtype = Mtype::where('merchant_id',$id)->get();
         //热销商品
        $sellgoods = Good::where('merchant_id',$id)-> limit(4) -> orderBy('good_salecnt','desc')->get();
        //分页获取全部商品
        $count = 2;

        if($request->has('o')){
            $o = $request->only('o')['o'];
             $d = empty($request->input('d')) ? 'asc' : $request->input('d');
            $goods = Good::where('merchant_id',$id)-> orderBy($o,$d) -> paginate($count);
            //加载前台店铺页面
            return view('home/merchant/index',compact('merchant','mtype','goods','sellgoods','o','d'));
        }
        $goods = Good::where('merchant_id',$id) -> paginate($count);
        //加载前台店铺页面
        $o = '';
        return view('home/merchant/index',compact('merchant','mtype','goods','sellgoods','o'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGoodlist(Request $request)
    {
        
        //获取店铺id
        $merchant_id = $request->only('merchant_id')['merchant_id'];
        //获取分类id
        $mtype_id = $request->only('mtype_id')['mtype_id'];

        //获取分类商品
        $count = 2;
        $goods = Good::where('merchant_id',$merchant_id) ->where('mtype_id',$mtype_id)-> paginate($count);
        
        //获取店铺信息
        $merchant = Merchant::where('merchant_id',$merchant_id)->get();
        //获取店铺分类
        $mtype = Mtype::where('merchant_id',$merchant_id)->get();
         
        $merchant = $merchant[0];

        // dd($goods);
        //加载前台店铺页面
        return view('home/merchant/goodlist',compact('merchant','mtype','goods'));
        
    }
}
