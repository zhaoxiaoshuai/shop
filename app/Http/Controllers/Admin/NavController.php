<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NavController extends Controller
{

    /**
     *查看导航信息
     *
     *@return 导航列表
     * 时间
     * author :gcj
     */
    public function index(Request $request)
    {
        //如果是通过查询方式过来的
        if($request->has('keywords')){
            $key = trim($request->input('keywords'));
            $data = Nav::where('nav_name','like',"%".$key."%")->paginate(3);
            return view('admin.nav.index',['data'=>$data,'key'=>$key]);
        }
        $data =  Nav::orderBy('nav_id','asc')->paginate(3);
        return view('admin.nav.index',['data'=>$data]);

    }

    /**
     * 添加导航
     *
     * @return 添加页面
     * 时间
     * author :gcj
     */
    public function create()
    {
        return view('admin.nav.add');
    }

    /**
     * 接收用户添加数据
     * 时间
     * author :gcj
     *
     * @param  \Illuminate\Http\Request  $request
     * @return 成功或失败
     */
    public function store(Request $request)
    {

        $this ->validate($request,[
            'nav_name' =>'required',
            'nav_url' =>'required',
        ],[
            'nav_name.required' => '导航名称不能为空',
            'nav_url.required' => '导航地址不能为空',
        ]);
        $res = $request -> except('_token');
        $nav = new Nav();
        $nav->nav_name = $res['nav_name'];
        $nav->nav_url = $res['nav_url'];
        $re = $nav->save();//执行添加语句
        if($re){
            return redirect('admin/nav');
        }else{
            return back()->with('error','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */
    public function show($id)
    {
        //
    }

    /**
     * 修改页面
     *
     * @param  要修改的id  $id
     * @return 返回数据到修改页面
     * 时间 2017-07-04 21:00
     * author :huangyan
     */
    public function edit($id)
    {
        $data = Nav::where('nav_id',$id)->first();
        return view('admin.nav.edit',compact('data'));
    }

    /**
     * 执行修改
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 时间 2017-07-04 21:00
     * author :huangyan
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','_method');
        $res = Nav::where('nav_id',$id)->update($data);
//        dd($res);
        //判断是否修改成功
        if($res){
            return redirect('admin/nav'); //成功返回到列表页
        }else{
            return back()->with('error','修改失败');//失败返回上一级操作
        }
    }

    /**
     * 删除一条数据
     *
     * @param  删除的id  $id
     * @return \Illuminate\Http\Response
     * 时间 2017-07-04 21:00
     * author :huangyan
     */
    public function destroy($id)
    {
        //删除对应id的导航
        $res = Nav::where('nav_id', $id)->delete();
        if ($res) {
            $data = [
                'status' => 0,
                'msg' => '删除成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '删除失败'
            ];
        }
        return $data;
    }
}
