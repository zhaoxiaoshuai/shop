<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Model\Orders;
use App\Http\Model\Detail;
use App\Http\Model\Comment;

class OrdersController extends Controller
{
    /**
     * 订单显示页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Orders::join('user','orders.user_id','=','user.user_id')
            ->orderBy('order_time','desc')
            ->paginate(5);
        return view('home.orders.index',compact('orders'));
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
}
