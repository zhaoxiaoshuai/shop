<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Orders;
use App\Http\Model\Detail;
use App\Http\Model\Comment;

class CommentController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request ->except('_token');
        $comment = new Comment();
        $comment->user_id = $data['user_id'];
        $comment->good_id = $data['good_id'];
        $comment->merchant_id = $data['merchant_id'];
        $comment->order_id = $data['order_id'];
        $comment->comment_level = $data['level'];
        $comment->comment_connect = $data['connect'];
        $comment->comment_time = time();
        $id = $data['order_id'];
        $res = $comment->save();//执行添加语句
        if($res){
            return redirect('home/orders');
        }else{
            return back()->with('error','添加失败');
        }
    }

    /**
     * 加载评论页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request,$id)
    {
//        评论列表
        //获取传递的参数 订单号
        $res = $request->all();

        $data = Detail::join('orders','detail.order_id','=','orders.order_id')
            ->join('goods','goods.good_id','=','detail.good_id')
            ->where('goods.good_id','=',$id)
            ->where('detail.order_id','=',$res['order_id'])
            ->get();
            // dd($data);
        return view('home.comment.index',['data'=>$data]);
    }

    /**
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
