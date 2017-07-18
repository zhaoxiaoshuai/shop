<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Good;
use App\Http\Model\Mtype;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MgoodController extends Controller
{
    /**
     * 商家后台商品列表
     * @param Request $request
     * @return  商家后台商品列表页面
     * @author gcj
     * @Date
     */
    public function index(Request $request)
    {

        // 如果keywords参数有值说明是通过查询进入index方法的，否则是通过商品列表导航进入的
        if($request->has('keywords')){
            $key = trim($request->input('keywords')) ;
            $good = Good::where('good_name','like',"%".$key."%")
                ->paginate(10);
            return view('admin.mgood.index',['data'=>$good,'key'=>$key]);
        }else{
            //两表联查shop_goods shop_type
            $data =  Good::join('type','goods.type_id','=','type.type_id')
                ->orderBy('goods.good_id','asc')
                ->paginate(10);
//             dd($data);
            // 向前台模板传变量的一种方法
            return view('admin.mgood.index',compact('data'));
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
     * 商家后台商品列表
     * @param 商品id
     * @return  商家后台商品详情页面
     * @author gcj
     * @Date
     */
    public function show($id)
    {
        //加载店铺商品详情页
        //两表联查shop_goods shop_type
        $data =  Good::join('type','goods.type_id','=','type.type_id')
            ->where('goods.good_id',$id)
            ->first();
        // 获取店铺的id
        $merchant_id = session('store_admin')['merchant_id'];
        // 获取店铺分类
        $mtype = Mtype::where('merchant_id',$merchant_id)->first();
        $mtype_name = $mtype['mtype_name'];
        // 向前台模板传变量的一种方法
        return view('store.goods.details',compact('data','id','mtype_name'));
    }

    /**
     * 商家后台商品修改（仅可修改状态）
     * @param 商品id
     * @return  商家后台商品修改页面
     * @author gcj
     * @Date
     */
    public function edit($id)
    {
        // 通过shop_good表type_id查询到对应的shop_type的值
        // $type = Good::join('type','goods.type_id','=','type.type_id')->get();
        // dd($type);
        //根据传入要修改的ID商品 获取单条
        $data = Good::where('good_id',$id)->first();
        // 根据传过来的商品id获取type_id查找shop_type表里的分类
        $type = DB::table('type')->where('type_id',$data->type_id)->first();
        // dd($type['type_id']);
        $types = DB::table('type')->get();
        // dd($types);
        //取出该商品的所有图片
        $pics = DB::table('goodpic')->where('good_id',$id)->get();
        return view('admin.mgood.edit',compact('data','type','types','pics'));
    }

    /**
     * 商家后台商品修改
     * @param Request $request 商品id
     * @return  商家后台商品列表页面
     * @author gcj
     * @Date
     */
    public function update(Request $request, $id)
    {
//         接收指定值
        $data = Input::only('good_status');
        //执行修改
        $res = Good::where('good_id',$id)->update($data);

        //如果成功跳转到列表页  失败返回修改页
        if($res){
            return redirect('admin/mgood');
        }else{
            return back()->with('error','修改失败');
        }
    }

    /**
     * 商家后台商品删除
     * @param 商品id
     * @return  $data
     * @author gcj
     * @Date
     */
    public function destroy($id)
    {
        //删除对应id的商品
        $re =  Good::where('good_id',$id)->delete();
        // 0表示成功 其他表示失败
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
