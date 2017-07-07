<?php

namespace App\Http\Controllers\Admin\Orders;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Orders;
use App\Http\Model\User;
use DB;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        

        //通过user_id查询user_name
        // $res = Orders::join('user','user.user_id','=','orders.user_id')->get();
        // dd($res);
        //带搜索条件分页查询
        if($request->has('orders')){
            //查询的订单号
            $orders = trim($request->input('orders'));

            $data = Orders::join('user','user.user_id','=','orders.user_id')->where('order_id',$orders)->paginate(5);
            
            return view('admin.orders.index',['data'=>$data,'orders'=>$orders]);
        }else{
            $data = Orders::join('user','user.user_id','=','orders.user_id')->orderBy('id','desc')->paginate(5);
            // dd($data);
            // dd($data);
            return view('admin.orders.index',['data'=>$data]);
        };
        
        
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($orders)
    {
        //找到要修改的订单,显示到页面
        $data = Orders::join('user','user.user_id','=','orders.user_id')->where('order_id',$orders)->first();
        // dd(date('Y-m-d H:i:s',$data['order_time']));
        // dd($data->user_id);
        return view('admin.orders.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $orders)
    {
        // dd($request->all());
        // dd($orders);
        $input =  $request->except(['_token',"_method"]);
        // dd($input);
        $res = Orders::where('order_id',$orders)->update($input);
        if($res){
//            如果成功，返回到订单列表页
            return redirect('admin/orders');
        }else{
//            如果失败，返回去
            return back()->with('error',"修改失败");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order)
    {
        //删除对应的订单号
       $re =  Orders::where('order_id',$order)->delete();
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
}
