<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Model\Orders;
use App\Http\Model\Detail;
use App\Http\Model\Comment;

use App\Http\Model\User;
use App\Http\Model\Cart;
use App\Http\Model\Address;
use App\Http\Model\Good;
use App\Http\Controllers\Common;


class OrdersController extends Common
{
    /**
     * 订单显示页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('logins')->user_id;
//        dd($id);
        $orders = User::join('orders','user.user_id','=','orders.user_id')
            ->where('user.user_id',$id)
            ->select('orders.order_id','orders.order_time','orders.order_total','orders.order_status')
            ->orderBy('order_time','desc')
            ->paginate(5);
            // dd($orders);

//        $com = Orders::join('comment','orders.order_id','=','comment.order_id')
//            ->select('comment.comment_content')
//            ->where('orders.order_id',)
//            ->get()[0];
//        dd($com);
        return view('home.orders.index',['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //查询商品
        $uid = session('logins')['user_id'];
        $data = Cart::join('goods','goods.good_id','=','cart.good_id')->where('user_id',$uid)->where('cart_status',1)->get();
        //显示生成订单列表
        // dd($data);
        //获取总金额
        $total = "";
        foreach ($data as $to) {
            $total += $to->good_price*$to->cart_cnt;
        }
        //获取用户的地址
        $list = Address::where('user_id',$uid)->get();
        session(['back'=>'commit']);

        return view('home.orders.commit',compact('data','total','list'));
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
     * 订单详情
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //订单详情列表
        $data = Detail::join('orders','detail.order_id','=','orders.order_id')
            ->join('goods','goods.good_id','=','detail.good_id')
            ->where('orders.order_id','=',$id)
            ->get();
        return view('home.orders.detail',['data'=>$data]);
    }

    //取消订单
    public function changeorders($id)
    {
        $data = Orders::where('order_id',$id)->update(['order_status'=>5]);
        if($data){
            return redirect('home/orders');
        }else{
            return back()->with('error','取消失败');
        }
    }

    //确认收货
    public function shouhuo($id)
    {
        $data = Orders::where('order_id',$id)->update(['order_status'=>3]);
        if($data){
            return redirect('home/orders');
        }else{
            return back()->with('error','取消失败');
        }
    }

     //去付款
    public function jiesuan($id)
    {
        $data = Orders::where('order_id',$id)->update(['order_status'=>1]);
        if($data){
            return redirect('home/orders');
        }else{
            return back()->with('error','付款失败');
        }
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
        //

    }

    //提交订单
    public function commit(Request $request)
    {
        //获取用户的信息
        $uid = session('logins')['user_id'];
        //获取选中的商品id
        $good_id = $request->only('good_id')['good_id'];
        //查询购物车中相应的商品id
        $good = [];
        $status = ['cart_status'=>1];
        foreach ($good_id as $k => $v) {
            $data = Cart::where('user_id',$uid)->where('good_id',$v)->update($status);
        }

        return $status;
    }

    //确认订单 加入订单信息
    public function comfirm(Request $request)
    {   
        
        //获取用户的id
        $uid = session('logins')['user_id'];
        //获取购买的信息
        $list = Cart::join('goods','goods.good_id','=','cart.good_id')->where('user_id',$uid)->get();
        // dd($list);
        $arr = [];
        $total = '';
        foreach($list as $k=>$v){
            $total += $v->cart_cnt * $v->good_price;
            array_push($arr,$v->good_id);
        }
        
        session(['arr'=>$arr]);
        // dd($arr[]);

        DB::beginTransaction();
        //获取用户的信息
        $data = $request -> except('_token');
        
        $address_id = $data['address'];
        $order_msg = $data['order_msg'];
        $res = Address::where('address_id',$address_id)->get();
        // 获取数据 写入订单表
        $data1['order_id'] = date('YmdHis').rand(1000,9999);
        $data1['order_type'] = 1;
        $data1['user_id'] = $uid;
        $data1['order_time'] = time();
        $data1['order_total'] = $total;
        $data1['order_cnt'] = $v->cart_cnt;
        $data1['order_status'] = 6;
        $data1['order_msg'] = $order_msg;
        foreach($res as $kk=>$vv){
            $data1['order_linkman'] = $vv->name;
            $data1['order_address'] = $vv->address;
            $data1['order_phone'] = $vv->phone;
        }
        $res1 = Orders::create($data1);
        // 获取数据写入详情表
         foreach($arr as $o){
             $res2 = DB::table('detail')->insert([
                ['order_id' => $data1['order_id'],'good_id' => $o]
            ]);
        }
       
        //修改商品表的库存和销量
        $re = Good::where('good_id',$v->good_id)->get();
        
        foreach($re  as $kkk=>$vvv){
            $data3['good_count'] = $vvv->good_count - $data1['order_cnt'];
            $data3['good_salecnt'] = $vvv->good_salecnt + $data1['order_cnt'];
        }
        $res3 = Good::where('good_id',$v->good_id) -> update($data3);
        // dd($res3);
        if($res1 && $res2 && $res3){
            DB::commit();
            return redirect()->action('Home\OrdersController@finish');
        }else{
            DB::rollBack();
            return back()->with('error','下单失败');
        }
        
        
        
    }

    public function finish()
    {
        //用户的id
        $uid = session('logins')['user_id'];
        //查询订单号
        $data = Orders::where('user_id',$uid)->orderBy('order_time','desc')->first();
        
        $total = $data->order_total;
        $order_id = $data->order_id;
        //  清空购物车里面购买的商品
        //商品的id
        $arr = session('arr');
        //删除对应的购物车商品
        $res = Cart::whereIn('good_id',$arr)->delete();
        return view('home.orders.comfirm',['total'=>$total,'order_id'=>$order_id]);
    }
}
