<?php

namespace App\Http\Controllers\Store;

use App\Http\Model\Orders;
use App\Http\Model\Detail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
   /**
     * 返回商家后台订单列表页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-12 18:25
     */
    public function index(Request $request)
    {
        //获取店铺id
        $merchant_id = session('store_admin')['merchant_id'];
        //通过user_id查询user_name
        //带搜索条件分页查询
        if($request->has('orders')){
            //查询的订单号
            $orders = trim($request->input('orders'));

            $data = Orders::join('user','user.user_id','=','orders.user_id')
            ->select('id','order_id','user_name','order_linkman','order_address','order_phone','order_status')
                            ->where('order_id',$orders)
                            ->where('merchant_id',$merchant_id)
                            ->paginate(5);
            
            return view('store.orders.index',['data'=>$data,'orders'=>$orders]);
        }else{
            $data = Orders::join('user','user.user_id','=','orders.user_id')
                            ->select('id','order_id','user_name','order_linkman','order_address','order_phone','order_status')
                            ->where('merchant_id',$merchant_id)
                            ->orderBy('id','desc')
                            ->paginate(5);
            // dd($data);
            
            return view('store.orders.index',['data'=>$data]);
        }
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
     * 返回商家后台订单详情页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-12 20:55
     */
    public function show($orders_id)
    {
        $data = Detail::join('orders','detail.order_id','=','orders.order_id')
                        ->join('goods','detail.good_id','=','goods.good_id')
                        ->select('good_name','good_price','good_pic','order_type','order_time','order_linkman','order_total','order_cnt','order_address','order_phone','order_status','order_msg')
                        ->where('detail.order_id',$orders_id)
                        ->get()[0];
        
        //加载订单详情
        return view('store.orders.detail',compact('data','orders_id'));
    }

    /**
     * 返回商家后台修改订单页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-12 18:25
     */
    public function edit($orders_id)
    {
        //加载订单修改页面
        //找到要修改的订单,显示到页面
        $data = Orders::join('user','user.user_id','=','orders.user_id')
                        ->select('order_id','order_type','user_name','order_time','order_linkman','order_address','order_total','order_cnt','order_phone','order_status')
                        ->where('order_id',$orders_id)
                        ->first();
        // dd($data['order_id']);
        
        return view('store.orders.edit',['data'=>$data]);
    }

    /**
     * 返回商家后台执行修改订单
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-12 20:00
     */
    public function update(Request $request, $orders_id)
    {
        // 接收数据
        $data =  $request->except(['_token',"_method"]);

        $res = Orders::where('order_id',$orders_id)->update($data);
        if($res){
           // 如果成功，返回到订单列表页
            return redirect('store/orders');
        }else{
           // 如果失败，返回去
            return back()->with('error',"修改失败");
        }
    }

    /**
     * 返回商家后台删除订单
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-12 20:25
     */
    public function destroy($order_id)
    {
        //删除对应的订单号
       $re =  Orders::where('order_id',$order_id)->delete();
      // 0表示成功 其他表示失败
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
}
