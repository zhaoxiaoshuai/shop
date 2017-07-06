<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class TypeController extends Controller
{
    /**
     * 返回后台商家列表页面
     * @param 参数
     * @return 返回值
     * @author 邹帅
     * @Date 2017-7-4 15:46
     */
    public function index()
    {
        $data = DB::table('type')->orderBy('type_npath', 'asc')->get();
        
        return view('admin.type.viewtype',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加分类模版
        //获取一级分类
        $data = DB::table('type')->select('type_id','type_name','type_path','type_npath')->orderBy('type_npath', 'asc')->get();
        
        return view('admin.type.addtype',['data'=>$data]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       $this->validate($request, [
            'good_id' => 'required',
            'type_name' => 'required',
        ],[
            'good_id.required' => '商品类型名称必填',
            'type_name.required' => '商品名称必填',

        ]);


       // 获取
        $data = $request->except('_token');
        
        if($data['good_id'] == '0'){
            $data['type_path'] = '0-';
        }else{
            // 根据子类的pid获取到父类的信息
            $res = DB::table('type')->where('type_id',$data['good_id'])->get()[0];
            $data['type_path'] = $res['type_npath'];
        }
        
        // 先插入一个半成品 获取tid
        $tid = DB::table('type')->insertGetId($data);
        // 自己的 npath  =  自己的path.自己的tid.'-'
        $data['type_npath'] = $data['type_path'].$tid.'-';
        // 修改数据
        $res = DB::table('type')->where('type_id',$tid)->update($data);

        if ($res) {
            return redirect('admin/atype');
             
        }else{
             return back()->with('error','添加失败');

           
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data = DB::table('type')->where('type_id',$id)->get();
        // dd($data);
        return view('admin.type.edittype',['data'=>$data]);
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

        // $data = DB::table('type')->where('type_id',$id)->get();
        $input = $request->except('_token','_method');
        $res = DB::table('type')->where('type_id', $id)->update($input);
        if($res){
            return redirect('admin/atype');
        }else{
             return back()->with('error','添加失败');
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

            echo 11111111;
//          //删除对应id的用户
//        $re =  User::where('user_id',$id)->delete();
// //       0表示成功 其他表示失败
//        if($re){
//            $data = [
//                 'status'=>0,
//                 'msg'=>'删除成功！'
//            ];
//        }else{
//            $data = [
//                'status'=>1,
//                'msg'=>'删除失败！'
//            ];
//        }
//        return $data;
    }
    }
// }