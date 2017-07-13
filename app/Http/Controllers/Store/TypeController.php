<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;

use App\Http\Model\Type;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * 返回商家后台分类添加页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-12 9:05
     */
    public function create()
    {
        //获取一级分类
        $data = DB::table('type')->select('type_id','type_name','type_path','type_npath')->orderBy('type_npath', 'asc')->get();
        
        //加载分类添加页面
        return view('store.type.add',['data'=>$data]);

    }

    /**
     * 返回商家后台执行添加分类页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-12 9:30
     */
    public function store(Request $request)
    {
        //
        // $this->validate($request, [
        //     'pid' => 'required',
        //     'type_name' => 'required',
        // ],[
        //     'pid.required' => '商品类型名称必填',
        //     'type_name.required' => '商品名称必填',

        // ]);

        // 接收数据
        // $data = $request -> except('_token');
        // dd($data);

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
