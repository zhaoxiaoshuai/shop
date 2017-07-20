<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Store;
use App\Http\Model\merchant;
use App\Http\Model\StoreAdmin;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Mail;

class StoreController extends Controller
{
    /**
     * 返回后台商家列表页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-3 20:55
     */
    public function index(Request $request)
    {
        // 获取指定输入值
        $key1 = trim($request->input('keywords1'));
        $key2 = trim($request->input('keywords2'));
        // dd($key2);
        // 多表查询
        $data = DB::table('store')
                ->join('user','store.user_id','=','user.user_id')
                ->join('merchant','store.merchant_id','=','merchant.merchant_id')
                // ->select('store_id','user_name','store_username','merchant_id','merchant_name','merchant_leverl','store_phone','platform_use_fee','percent','audit_status')
                ->where('audit_status','=','2')
                ->orderBy('store_id','desc')
                ->paginate(5);
      // dd($data);
        // has 确认是否有输入值
        if($request->has('keywords1')){
           // 多表查询
            $data = DB::table('store')
                ->join('user','store.user_id','=','user.user_id')
                ->join('merchant','store.merchant_id','=','merchant.merchant_id')
                // ->select('store_id','user_name','store_username','merchant_id','merchant_name','merchant_leverl','store_phone','platform_use_fee','percent','audit_status')
                ->where('merchant_leverl','=',"{$key1}")
                ->where('audit_status','=','2')
                ->paginate(5);
        }

        // has 确认是否有输入值
        if($request->has('keywords2')){
           // 多表查询
            $data = DB::table('store')
                ->join('user','store.user_id','=','user.user_id')
                ->join('merchant','store.merchant_id','=','merchant.merchant_id')
                // ->select('store_id','user_name','store_username','merchant_id','merchant_name','merchant_leverl','store_phone','platform_use_fee','percent','audit_status')
                ->where('audit_status','=','2')
                ->where('merchant_name','like',"%".$key2."%")
                ->paginate(5); 
        }

        // dd($data);

        $arr = ['1'=>'未审核','审核通过','审核不通过'];
        $arr2 = ['1'=>'初级','中级','高级'];

        // 加载商家列表模块
        return view('admin.store.storelist',['data'=>$data,'arr'=>$arr,'arr2'=>$arr2,'key1'=>$key1,'key2'=>$key2]);

    }

    /**
     * 返回后台商家申请列表页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-3 20:55
     */
    public function create()
    {
        // 多表查询
        $store = DB::table('store')
            ->where('audit_status','1')
            ->join('user','store.user_id','=','user.user_id')
            ->join('merchant','store.merchant_id','=','merchant.merchant_id')
            ->select('store_id','user_name','store_username','merchant_name','merchant_leverl','store_phone','platform_use_fee','percent','audit_status')
            ->orderBy('store_id','desc')
            ->get();

        $arr = ['1'=>'未审核','审核通过','审核不通过'];
        $arr2 = ['1'=>'初级','中级','高级'];

        //加载商家显示模版
        return view('admin.store.applylist',['data'=>$store,'arr'=>$arr,'arr2'=>$arr2]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
        
    }

    /**
     * 返回后台商家审核通过信息详情页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-3 20:55
     */
    public function astoreindex($id)
    {
        // 多表查询
        $store = DB::table('store')
            ->where('store_id',$id)
            ->join('user','store.user_id','=','user.user_id')
            ->join('merchant','store.merchant_id','=','merchant.merchant_id')
            ->get()[0];

        $arr = ['1'=>'未审核','审核通过','审核不通过'];
        $arr2 = ['1'=>'初级','中级','高级'];
        $arr3 = ['1'=>'包包','配饰','内衣','运动户外','男装','女装','家电','手机数码','鞋子','家居建材','食品'];

       //加载商户信息模版
        return view('admin.store.storeindex',['data'=>$store,'arr'=>$arr,'arr2'=>$arr2,'arr3'=>$arr3]); 
    }

    /**
     * 返回后台商家申请详情页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-4 14:30
     */
    public function show($id)
    {
        // 多表查询
        $store = DB::table('store')
            ->where('store_id',$id)
            ->join('user','store.user_id','=','user.user_id')
            ->join('merchant','store.merchant_id','=','merchant.merchant_id')
            ->get()[0];

        $arr2 = ['1'=>'初级','中级','高级'];
        $arr3 = ['1'=>'包包','配饰','内衣','运动户外','男装','女装','家电','手机数码','鞋子','家居建材','食品'];
        
        // 加载商家详情信息页
        return view('admin.store.storedetails',['data'=>$store,'arr2'=>$arr2,'arr3'=>$arr3]);
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
     * 审批入驻商申请信息
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-5 13:50
     */
    public function update(Request $request, $id)
    {
        // 接收数据
        $data = $request -> except('_method','_token');
        $data['audit_time'] = time();

        // 执行修改
        $res = Store::where('store_id',$id)->update($data);
        
        // 指定字段查询
        $store = Store::where('store_id',$id)->select('store_id','merchant_id','user_id','store_username','audit_status','store_email','audit_opinion')->get()[0];
        
        if($res){
            
            // 如果 audit_status 等于2 就以邮箱的通知用户
            if ($store['audit_status'] == '2') {

               
                $merchant = Merchant::where('merchant_id',$store['merchant_id'])->select('merchant_name')->get()[0];
                // 获取姓名
                $store_username = $store['store_username'];
                // 获取店铺名
                $merchant_name = $merchant['merchant_name'];
                // 获取邮箱   通过邮箱通知用户审核不通过
                $store_email = $store['store_email'];
                // 获取审核意见  发给用户
                $audit_opinion = $store['audit_opinion'];
                // 调用发送邮件方法
                $res1 = self::mailto2($store_email,$merchant_name,$audit_opinion,$store_username);

                // 执行修改用户状态( 状态 0未激活 1已激活 2商家用户)
                $res2 = User::where('user_id',$store['user_id'])->update(['status'=>'2']);
                // 修改用户存在session中的状态
                $res3 = session('logins')['status'] = '2';

               
            }


            // 如果 audit_status 等于3 就执行删除
            if ($store['audit_status'] == '3') {

               
                $merchant = Merchant::where('merchant_id',$store['merchant_id'])->select('merchant_name')->get()[0];
                // 获取姓名
                $store_username = $store['store_username'];
                // 获取店铺名
                $merchant_name = $merchant['merchant_name'];
                // 获取邮箱   通过邮箱通知用户审核不通过
                $store_email = $store['store_email'];
                // 获取审核意见  发给用户
                $audit_opinion = $store['audit_opinion'];
                // 调用发送邮件方法
                $mail = self::mailto1($store_email,$merchant_name,$audit_opinion,$store_username);
                
                // 执行删除 shop_merchant
                $mer = Merchant::where('merchant_id',$store['merchant_id'])->delete();
                // 执行删除 shop_store_admin
                $stoadm = StoreAdmin::where('merchant_id',$store['merchant_id'])->delete();
                // 执行删除 shop_store
                $sto = Store::where('store_id',$store['store_id'])->delete();

                
            }
                return redirect('admin/astore/create');

        }else{
                return redirect('admin/astore/create')->with('error','审核失败');
        }
    }

    // 审核不通过
    public static function mailto1($email,$merchant_name,$audit_opinion,$store_username){

        Mail::send('admin.email.index1', ['merchant_name'=>$merchant_name,'audit_opinion'=>$audit_opinion,'store_username'=>$store_username], function ($m) use ($email) {
           
            $m->to($email)->subject('这是一封店铺审核通知邮件!');
        });
    }

    // 审核通过
    public static function mailto2($email,$merchant_name,$audit_opinion,$store_username){

        Mail::send('admin.email.index2', ['merchant_name'=>$merchant_name,'audit_opinion'=>$audit_opinion,'store_username'=>$store_username], function ($m) use ($email) {
           
            $m->to($email)->subject('这是一封店铺审核通知邮件!');
        });
    }

    /**
     * 删除商户申请店铺信息
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-5 19:00
     */
    public function destroy($id)
    {
        // 获取shop_store表中的字段 store_id   merchant_id
        $store = Store::where('store_id',$id)->select('store_id','merchant_id')->get()[0];

        // 执行删除   shop_merchant
        $mer = Merchant::where('merchant_id',$store['merchant_id'])->delete();
        // 执行删除   shop_store_admin
        $stoadm = StoreAdmin::where('merchant_id',$store['merchant_id'])->delete();
        // 执行删除   shop_store
        $sto = Store::where('store_id',$store['store_id'])->delete();

        if($stoadm && $mer && $sto){
            // 0表示成功 其他表示失败
            $data = [
                'status'=>0,
                'msg'=>'删除成功!'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'删除失败!'
            ];
        }
        return $data;


    }
}
