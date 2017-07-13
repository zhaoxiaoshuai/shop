<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Store;
use App\Http\Model\Merchant;
use App\Http\Model\User;
use App\Http\Model\StoreAdmin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Services\OSS;
use Validator;

class StoreController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 返回接收用户申请入驻信息
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-8 10:02
     */
    public function CreateStore(Request $request)
    {
        // 将信息存入闪存中
        $request->flash();

        // 获取指定数据存在相对应的表中shop_merchant
        $data1 = $request -> only('merchant_name','merchant_title','merchant_leverl','merchant_style');
        $data1['user_id'] = '29';  // 用户id。。。。。。。。。。。。。。。
        $data1['merchant_ctime'] = time();
        $merid = Merchant::insertGetId($data1); // 返回插入Id
        // dump($data1);

        if($merid){

            // 获取省 市 区 地址
            $province = $request -> input('province');
            $city = $request -> input('city');
            $area = $request -> input('area');
            
            // 获取指定数据存在相对应的表中shop_store
            $data2 = $request -> only('store_username','store_phone','store_email','detailed_address','number_id','number_pic1','number_pic2','bank_username','bank_account','bank_name','platform_use_fee','store_margin','percent');
            $data2['user_id'] = '29';   // 用户id。。。。。。。。。。。。。。。。
            $data2['merchant_id'] = $merid;
            $data2['contact_address'] = "{$province}"."{$city}"."{$area}";
            $data2['apply_time'] = time();
            $sto = Store::create($data2);
            // dump($data2);
            
            // 获取当前用户的用户名和密码存入到商家管理表(shop_store_admin)
            $user_id = '29'; // 用户id。。。。。。。。。。。。。。。
            $user = User::where('user_id',$user_id)->first();
            
            // 获取指定数据存在相对应的表中shop_store_admin
            $data3['merchant_id'] = $merid;
            $data3['store_admin_name'] = $user['user_name'];
            $data3['store_admin_password'] = $user['user_password'];
            $data3['status'] = '1';
            $data3['insert_time'] = time();
            $sto_adm = StoreAdmin::create($data3);

            return redirect('home/MerApplication3');
        }else{
            return back()->with('error','申请失败(请检查相关信息！)');
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

    public function upload1()
    {
//        将上传文件移动到制定目录，并以新文件名命名
        $file = Input::file('store_pic1');
        if($file->isValid()) {
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;

           // 将图片上传到本地服务器
            // $path = $file->move(public_path() . '/uploads', $newName);

           // 将图片上传到七牛云
           // \Storage::disk('qiniu')->writeStream('uploads/'.$newName, fopen($file->getRealPath(), 'r'));

           // oss上传
           $result = OSS::upload('uploads/store/'.$newName, $file->getRealPath());

       // 返回文件的上传路径
            $filepath = 'uploads/store/' . $newName;
            return $filepath;
        }
    }

    public function upload2()
    {
       // 将上传文件移动到制定目录，并以新文件名命名
        $file = Input::file('store_pic2');
        if($file->isValid()) {
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;

           // 将图片上传到本地服务器
            // $path = $file->move(public_path() . '/uploads', $newName);

           // 将图片上传到七牛云
           // \Storage::disk('qiniu')->writeStream('uploads/'.$newName, fopen($file->getRealPath(), 'r'));

           // oss上传
           $result = OSS::upload('uploads/store/'.$newName, $file->getRealPath());

       // 返回文件的上传路径
            $filepath = 'uploads/store/' . $newName;
            return $filepath;
        }
    }
    
    /**
     * 返回入驻市场页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-7 14:40
     */
    public function MerSettled()
    {
        // 加载商户入驻页面
        return view('home.store.MerSettled');
    }

    /**
     * 返回申请入驻市场页面(一)
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-7 23:15
     */
    public function MerApplication1()
    {
        // 加载商户申请入驻页面1
        return view('home.store.MerApplication1');
    }

    /**
     * 返回申请入驻市场页面(二)
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-7 23:15
     */
    public function MerApplication2()
    {
        // 加载商户申请入驻页面2
        return view('home.store.MerApplication2');
    }

    /**
     * 返回申请入驻市场页面(三)
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-8 02:15
     */
    public function MerApplication3()
    {
        // 加载商户申请入驻页面3
        return view('home.store.MerApplication3');
    }
}
