<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Good;
use App\Http\Model\Comment;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class CommentController extends Controller
{
    /**
     * 返回商品评论列表页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-17 16:17
     */
    public function getIndex()
    {
        $com = DB::table('comment')
                    ->join('goods','comment.good_id','=','goods.good_id')
                    ->where('comment.merchant_id','0')
                    ->paginate(5);
        //加载商品评论列表
        return view('admin.comment.index',compact('com'));
    }

    /**
     * 返回商品回复评论页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-17 19:17
     */
    public function getReply($id)
    {
        // 多表查询  评论表和商品表
        $com = Comment::join('goods','goods.good_id','=','comment.good_id')
                ->where('comment.id',$id)
                ->select('id','good_name','good_pic','good_price','comment_connect','comment_time','comment_level')
                ->first();
        
       $arr = ['1'=>'差评','中评','好评'];
        // 加载回复评论页面列表
        return view('admin.comment.reply',compact('com','arr'));
    }

    /**
     * 返回执行回复评论商品页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-17 20:27
     */
    public function postReply(Request $request)
    {
        // 接收指定数据
        $re = $request->except('_token');
        $data['reply_connect'] = $re['reply_connect'];
        $data['reply_time'] = time();
        $com = Comment::where('id',$re['id'])->update($data);

        if($com){
            return redirect('admin/comment/index');
        }
    }

    /**
     * 返回已回复评论商品列表页面
     * @param 参数
     * @return 返回值
     * @author 邹鹏
     * @Date 2017-7-17 22:00
     */
    public function getShow(Request $request)
    {
        // 获取关键字
        $key = trim($request->input('keywords'));
            
        $arr = ['1'=>'差评','中评','好评'];
        // 确认keywords是否有输入值
        if($request->has('keywords')){
            

            $com = Comment::join('goods','goods.good_id','=','comment.good_id')
                            ->where('comment.merchant_id','0')
                            ->where('comment.reply_connect','!=','null')
                            ->where('goods.good_name','like',"%".$key."%")
                            ->select('good_name','comment_level','comment_connect','comment_time','reply_connect','reply_time')
                            ->paginate(5);
            // 加载已回复评论商品列表页面
            return view('admin.comment.show',compact('com','arr','key')); 
        }else{  
            $com = Comment::join('goods','goods.good_id','=','comment.good_id')
                            ->where('comment.merchant_id','0')
                            ->where('comment.reply_connect','!=','null')
                            ->select('good_name','comment_level','comment_connect','comment_time','reply_connect','reply_time')
                            ->paginate(5);
            // dd($com);
            // 加载已回复评论商品列表页面
            return view('admin.comment.show',compact('com','arr','key')); 
        }
        
    }

    
}
