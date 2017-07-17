<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Cart;
use App\Http\Model\Good;


class MycartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid = session('logins')['user_id'];
        // dd(session('logins'));
        // dd($uid);
        // if(empty($uid)){
        //     return view('home.login.login');
        // }else{
        //     //将session中的购物车信息插入到数据库中
        //     // dd(session('cart'));
        //     $data['good_id'] = session('cart')->good_id;
        //     $data['user_id'] = $uid;
        //     $data['cart_cnt'] = session('good_num');
        //     // dd($data);
        //     $res = Cart::create($data);
        // }
        //加载购物车页面
            $data1 = Cart::join('goods','goods.good_id','=','cart.good_id')->where('cart.user_id',$uid)->get();
            // dd($data1);
                    // dd($data1);
            return view('home.mycart.index',['data1'=>$data1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //执行添加购物车
    public function show($good_id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //删除对应id的商品
       $re =  Cart::where('cart_id',$id)->delete();
//       0表示成功 其他表示失败
       if($re){
           $data = [
                'status'=>0,
                'msg'=>'删除成功！'
           ];
       }else{
           $data = [
               'status'=>1,
               'msg'=>'删除失败！'
           ];
       }
       return $data;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addmycart(Request $request)
    {
        //获取加入购物车商品的数量
        $cnt = $request->only('n_ipt')['n_ipt'];
        //获取商品的id
        $good_id = $request->only('good_id')['good_id'];
        //获取商品的信息
        $data = Good::where('good_id',$good_id)->first();
        // return $data;

        //将商品的信息存入到session
        session(['cart'=>$data]);
        session(['good_num'=>$cnt]);  
    }


    //清空购物车
    public function delete()
    {
        //获取用户的id
        $uid = session('logins')['user_id'];
        //执行删除
        $res = Cart::where('user_id',$uid)->delete();
        // dd($res);
        if($res){
            //如果成功返回首页
            return redirect('/');
        }else{
            //如果失败,返回
            return back()->with('error','删除失败');
        }
    }
}
