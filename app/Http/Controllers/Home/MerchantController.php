<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        //获取店铺信息
        
        //获取分类

        //获取全部商品

        //加载前台店铺页面
        return view('home/merchant/index');
        
    }

    
}
