<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Conf;
use App\Services\OSS;
use DB;

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
        $data = $request->except('_token','_method','conf_logo');
       // $data['conf_logo'] = 'uploads/config/'.$data['conf_logo'];
        $data['conf_logo'] = $data['logo_thumb'];
        unset($data['logo_thumb']);

        //dd($data);
        $res = Conf::where('id',$id)->update($data);
        if($res){
            $this->putFile();
            return redirect('admin/config/1/edit');

        }else{
            return back()->with('error','修改失败');
        }

    }

    /**
     * 从数据库中读取系统配置,写入到指定文件
     */
    public function putFile()
    {
       // 读出config数据表中的conf_name,conf_content这两列数据，
        $arr = DB::table('config')->where('id',1)->first();
       // dd($arr);
       // 变成字符串形式
        $str ='<?php  return '.var_export($arr,true).';';
        // dd($str);
        //找到要写入的文件的路径
//        base_path函数返回项目根目录的绝对路径：
//        config_path函数返回应用配置目录的绝对路径：
        $path = base_path().'/config/web.php';
    
//        dd($path);
       $aa =  file_put_contents($path,$str);

       // dd($aa);


//        写入config/web.php文件
    }
    /**
     *LOGO 图片上传
     */

    public function uploadconf()
    {
        //将上传的文件移动到指定目录,并为新文件命名

        $logo = Input::file('conf_logo');

        if($logo->isValid()) {
            $entension = $logo->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;

            //将图片上传到本地服务器

            // $path = $logo->move(public_path() . '/uploads/config/', $newName);

            //将图片上传到oss上传
            $result = OSS::upload('uploads/config/'.$newName, $logo->getRealPath());

           //回文件的上传路径
            $logopath = 'uploads/config/' . $newName;
            return $logopath;
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
