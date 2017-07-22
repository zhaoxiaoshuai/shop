<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        // dd(session('logins')->user_id);

        //加载收货地址的表单
        $uid = session('logins')['user_id'];
        // dd($uid);
        $data = Address::join('user','delivery_address.user_id','=','user.user_id')->where('user.user_id',$uid)->paginate(2);
        $res = Address::where('user_id',$uid)->first();
        if(empty($res)){
            return view('home.address.show');
        }else{
            return view('home.address.index',['data'=>$data]);
        }
        
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加表单
        return view('home.address.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加操作
        //获取指定部分的数据
        $uid = session('logins')->user_id;
        // dd($uid);
        $data = $request -> except('_token');
        // dd($data);
        $data1['name'] = $data['name'];
        $data1['phone'] = $data['phone'];
        $arr = [$data['province'],$data['city'],$data['area'],$data['address']];
        $data1['address'] = implode(' ',$arr);
        $data1['user_id'] = $uid;
        $data1['email'] = $data['email'];
        // dd($data1);
        $res = Address::create($data1);
        if($res){
            // 如果session中有back那就跳到订单页去
            if (!empty(session('back')) && session('back')=='commit') {
                return redirect('/home/orders/create');
            }
            return redirect('/home/address');
        }else{
            return "添加失败！";
        }
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
    public function edit($id)
    {
        //找到要修改的信息,返回给页面
        $data = Address::where('address_id',$id)->first();
        // dd($data);
        $arr = explode(' ',$data->address);
        // dd($arr[3]);
        return view('home.address.edit',['data'=>$data,'arr'=>$arr]);
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
        //接收要修改的数据
        $data = $request -> except('_token','_method');
        
        $data1['name'] = $data['name'];
        $data1['phone'] = $data['phone'];
        $arr = [$data['province'],$data['city'],$data['area'],$data['address']];
        $data1['address'] = implode(' ',$arr);
        
        //通过ID查找到地址  再进行修改
        $re = Address::where('address_id',$id) -> update($data1);
        // dd($re);
        //更新是否成功
        if($re){
            //如果成功返回到收货地址页面
            return redirect('home/address');
        }else{
            //如果失败,返回
            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //删除对应id的用户
       $re =  Address::where('address_id',$id)->delete();
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
