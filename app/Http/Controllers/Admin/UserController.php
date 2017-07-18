<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request -> has('username')){
            //分页查询
//            $status = trim($request['status']);
            $username = trim($request['username']);
//            $stas = User::where('status',$status)->paginate(3);
            $data = User::where('user_email','like',"%".$username."%") -> orwhere('user_phone','like',"%".$username."%")->paginate(3);
//            dd($data);
            return view('admin.user.index',compact('data','username'));
        }else{
            //判断排序
            if($request->has('o')){
                $order = $request->input('o');
                $d = empty($request->input('d')) ? 'asc' : $request->input('d');
//                 dd($order);
                //取数据
                $key = '';
                $data = User::orderBy($order,$d) -> paginate(10);
                return view('admin.user.index',compact('data','key','o','d'));
            }
            //查询出User表所有的值
            $data = User::paginate(10);
            //向前台模板传变量
            return view('admin.user.index',compact('data','desc'));
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo 2;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo 3;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        //查询用户数据
        $data = User::where('user_id',$id)->first();
        //返回给视图
        return view('admin.user.edit',compact('data'));
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
        $status = $request -> except('_token','_method');
        //通过ID查找到用户  再进行修改
        $re = User::where('user_id',$id) -> update($status);
        //更新是否成功
        if($re){
            //如果成功返回到用户列表页面
            return redirect('admin/user');
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
        //删除对应的用户
        $re =  User::where('user_id',$id)->delete();
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
