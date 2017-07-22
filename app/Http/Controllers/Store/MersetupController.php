<?php

namespace App\Http\Controllers\Store;

use App\Http\Model\Merchant;
use Illuminate\Http\Request;
use App\Services\OSS;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


class MersetupController extends Controller
{
    /**
     * 返回商家后台店铺基本设置
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-15 02:05
     */
    public function getBasicsetup()
    {
        // 获取店铺id
        $merchant_id = session('store_admin')['merchant_id'];

        // 获取信息
        $data = Merchant::where('merchant_id',$merchant_id)
                        ->select('merchant_id','merchant_name','merchant_title','merchant_keywords','service_qq','service_phone','merchant_style','close_merchant','close_reason','merchant_logo','merchant_pic')
                        ->first();

        //加载店铺基本设置页
        return view('store.merchant.BasicSetup',['data'=>$data]);
    }

    /**
     * 返回商家后台执行修改店铺设置
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-15 11:40
     */
    public function postBasicsetup(Request $request)
    {
        // 接收指定数
        $data = $request->except('_token','file_upload1','file_upload2');
        $data['merchant_utime'] = time();
        // 获取id
        $merchant_id = $data['merchant_id'];
        // dd($data);
        // 执行修改
        $res = Merchant::where('merchant_id',$merchant_id)->update($data);

        if($res){
            return redirect('store/setup/information');
        }else{
            return back()->with('error','修改店铺失败');
        }
    }

    /**
     * 返回商家后台店铺基本信息
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-15 12:38
     */
    public function getInformation()
    {
        // 获取店铺id
        $merchant_id = session('store_admin')['merchant_id'];

        // 获取信息
        $data = Merchant::where('merchant_id',$merchant_id)
                        ->select('merchant_logo','merchant_name','merchant_title','merchant_keywords','merchant_pic','service_qq','service_phone','merchant_leverl','merchant_style','merchant_credit','merchant_status','close_merchant','close_reason','merchant_ctime','merchant_utime')
                         ->first();
        // 店铺类型
        $arr1 = ['1'=>'包包','配饰','内衣','运动户外','男装','女装','家用电器','手机数码','鞋子','家居建材','食品'];
        // 是否关闭店铺
        $arr2 = ['1'=>'营业中','非营业'];
        // 店铺状态
        $arr3 = ['1'=>'正常中','封店中'];
        // 店铺等级
        $arr4 = ['1'=>'初级','中级','高级'];
        // 加载店铺基本信息
        return view('store.merchant.information',['data'=>$data,'arr1'=>$arr1,'arr2'=>$arr2,'arr3'=>$arr3,'arr4'=>$arr4]);
    }
    // 上传图片
    public function postUpload($name)
    {
       // 将上传文件移动到制定目录，并以新文件名命名
        $file = Input::file($name);
        if($file->isValid()) {
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;
           // 将图片上传到本地服务器
            // $path = $file->move(public_path() . '/uploads', $newName);
           // 将图片上传到七牛云
           // \Storage::disk('qiniu')->writeStream('uploads/'.$newName, fopen($file->getRealPath(), 'r'));
           // oss上传
            $result = OSS::upload('uploads/'.$newName, $file->getRealPath());
       // 返回文件的上传路径
            $filepath = 'uploads/' . $newName;
            return $filepath;
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
