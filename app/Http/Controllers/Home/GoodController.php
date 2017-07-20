<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Collectiongoods;
use App\Http\Model\Good;
use App\Http\Model\Merchant;

use App\Http\Model\Goodpic;
use App\Http\Model\Type;
use Illuminate\Http\Request;

use App\Http\Model\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class GoodController extends Controller
{
    /**
     * 商品列表
     * @param  Request $request 商品分类id
     * @return 前台商品列表页面
     * @author gcj
     * @Date
     */
    public function goodList(Request $request,$type_id)
    {
        $perpage = 2;
//        //取出销量前四的商品
        $good = Good::where('good_status','!=','2')
            ->where('type_id','=',$type_id)
            ->orderBy('good_salecnt','desc')
            ->limit(4)
            ->get();
//
        //判断是否传递价格参数
        if($request->has('order')){
            $order = $request->input('order');
            $d = empty($request->input('d')) ? 'asc' : $request->input('d');
            $goods = Good::where('good_status','!=','2')
                ->where('type_id','=',$type_id)
                ->orderBy($order,$d)
                ->paginate($perpage);
            return view('home.good.goodlist',compact('good','order','goods','d','type_id'));
        }
        $order = '';
        $d = '';
        //取出所有 非下架商品并分页   商品状态0新品 1上架 2下架
        $goods = Good::where('good_status','!=','2')->where('type_id','=',$type_id)->paginate($perpage);
        return view('home.good.goodlist',compact('good','order','goods','d','type_id'));

    }

    /**
     * 新品列表
     * @param  Request $request 商品分类id
     * @return 前台新品列表页面
     * @author gcj
     * @Date
     */
    public function newgoodList(Request $request,$id)
    {
        $perpage = 2;
        //取出销量前四的商品
        $good = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy('good_salecnt','desc')->limit(4)->get();

        //取出所有新品商品 商品状态0新品 1上架 2下架
        $newgoods = Good::where('good_status','=','0')->where('type_id','=',$id)->paginate(4);
//        dd($goods);
        return view('home.good.newgoodlist',['newgoods'=>$newgoods,'type_id'=>$id,'good'=>$good]);
    }
    /**
     * 商品详情页面
     * @param  Request $request 商品id
     * @return 前台商品详情页面
     * @author gcj
     * @Date
     */
    public function goodDetail($id)
    {
        //浏览次数加1
        Good::where('good_id',$id)->increment('good_vcnt');
        //关联分类表
        $good =   Good::join('type','goods.type_id','=','type.type_id')->where('good_id',$id)->first();
        //随机取出当前分类5件商品
        $like = Good::join('type','goods.type_id','=','type.type_id')
            ->where('good_id',$id)
            ->orderBy(\DB::raw('RAND()'))
            ->take(4)
            ->get();
        //关联评论表
        $comment = Good::join('comment','goods.good_id','=','comment.good_id')
            ->join('user_details','comment.user_id','=','user_details.user_id')
            ->where('goods.good_id',$id)
            ->paginate(10);
        //取出该商品所有的图片
        $pics = Good::find($id)->pics()->get();
        //取出该当前子分类
        $type = Type::where('type_id',$good['type_id'])->first();

           $x= self::getparent($type);
           array_unshift($x,$type);
           $y = array_reverse($x);
           $arr = [];
           foreach ($y as $k=>$v){
               $arr[]=$v['type_name'];
           }
           $line = implode($arr,'  >  ');

           //取出商品所在店铺
           $merchant = Merchant::where('merchant_id',$good['merchant_id'])->first();
        return view('home.good.gooddetail',compact('good','pics','line','comment','merchant','like'));


    }
     public  function getparent($type)
    {
        //获取全部分类
        $types = Type::get();
            static $arr=[];
            foreach($types as $k => $v){
                if($type['pid'] == $v['type_id']){
                    $arr[] = $types[$k];
                    if($v['pid'] != '0'){
                        $this -> getparent($v);
                    }
                }
            }
        return $arr;
    }
}
