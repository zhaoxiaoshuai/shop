<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Conf;

class ConfController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        return view('admin.conf.conf');
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
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {

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
     * 查看系统配置 是否修改
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 时间 2017-07-05 16:20
     * author : huangyan
     */
    public function edit($id)
    {
        $data = Conf::where('id',$id)->first();
        return view('admin.conf.conf',compact('data'));
    }

    /**
     * 修改系统配置
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *  时间 2017-07-05 16:20
     * author : huangyan
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','_method');
        $data['conf_logo'] = 'uploads/config/'.$data['conf_logo'];
        $data['conf_ico'] = 'uploads/config/'.$data['conf_ico'];
        $res = Conf::where('id',$id)->update($data);
        if($res){
            return redirect('config/1/edit');
        }else{
            return back()->with('error','修改失败');
        }
    }
    /**
     *LOGO 图片上传
     */

    public function upload()
    {
        //将上传的文件移动到指定目录,并为新文件命名

        $logo = Input::file('conf_logo');

        if($logo->isValid()) {
            $entension = $logo->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;

            //将图片上传到本地服务器
            $path = $logo->move(public_path() . '/uploads/config/', $newName);

           //回文件的上传路径
            $logopath = 'uploads/config/' . $newName;
            return $logopath;
         }
    }

    /**
     *缩略 图片上传
     */

    public function upload2()
    {
        //将上传的文件移动到指定目录,并为新文件命名
        $ico = Input::file('conf_ico');
        if($ico->isValid()) {
//            $entension = $ico->getClientOriginalExtension();//上传文件的后缀名
            $newName = 'favicon.ico';

            //将图片上传到本地服务器
            $path = $ico->move(public_path() . '/', $newName);

            //返回文件的上传路径
            $icopath =  $newName;
            return $icopath;
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
        //
    }
}
