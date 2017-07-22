<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Link;

class LinkController extends Controller
{
    /**
     *查看友情链接信息
     *
     *@return 友情链接列表
     * 时间 2017-07-04 21:00
     * author :huangyan
     */
    public function index(Request $request)
    {
        //如果是通过查询方式过来的
        if($request->has('keywords')){
            $key = trim($request->input('keywords'));
            $data = Link::where('link_name','like',"%".$key."%")->paginate(3);
            return view('admin.link.index',['data'=>$data,'key'=>$key]);
        }
       $data =  Link::orderBy('id','asc')->paginate(3);
        return view('admin.link.index',['data'=>$data]);

    }

    /**
     * 添加友情链接
     *
     * @return 添加页面
     * 时间 2017-07-04 21:00
     * author :huangyan
     */
    public function create()
    {
        return view('admin.link.add');
    }

    /**
     * 接收用户添加数据
     * 时间 2017-07-04 21:00
     * author :huangyan
     *
     * @param  \Illuminate\Http\Request  $request
     * @return 成功或失败
     */
    public function store(Request $request)
    {

        $this ->validate($request,[
            'link_name' =>'required',
            'link_href' =>'required',
        ],[
            'link_name.required' => '网站名称不能为空',
            'link_href.required' => '网站域名不能为空',
        ]);
        $res = $request -> except('_token');
        $link = new Link();
        $link->link_name = $res['link_name'];
        $link->link_href = $res['link_href'];
        $re = $link->save();//执行添加语句
             if($re){
                 return redirect('admin/link');
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
        $data = Link::where('id',$id)->first();
        return view('admin.link.edit',compact('data'));
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
//        dump($data);
        $res = Link::where('id',$id)->update($data);
        //判断是否修改成功
        if($res){
            return redirect('admin/link'); //成功返回到列表页
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
        //删除对应id的友情链接
        $res = Link::where('id',$id)->delete();
        if($res){
            $data = [
                'status' => 0,
                'msg' => '删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除失败'
            ];
        }
        return $data;
    }
}
