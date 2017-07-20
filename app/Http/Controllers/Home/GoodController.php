<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Collectiongoods;
use App\Http\Model\Good;
use App\Http\Model\Merchant;

use App\Http\Model\Goodpic;
use App\Http\Model\Type;
use Illuminate\Http\Request;
use App\Http\Model\Label;
use App\Http\Model\Label_attr;
use App\Http\Model\Good_attr;
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
    public function goodList(Request $request,$id)
    {
    $perpage = 8;
        //取出分类下所有标签
        $labels = Label::where('type_id',$id)->get();
        // dd($labels);
        //取出标签下的值
        $arr= [];
        foreach ($labels as $k => $v) {
            $v['attr'] = Label_attr::where('label_id',$v['label_id'])->get();
            $arr[] = $v;
        }
        // dd($arr);
        
        //取出销量前四的商品
        $good = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy('good_salecnt','desc')->limit(4)->get();
        //如果通过标签搜索过来
        if($request->has('la_id')){
            //取出商品属性关系表中的商品id
            $good_id = Good_attr::where('la_id',$request->input('la_id'))->lists('good_id');
            //取出商品
            $goods = Good::whereIn('good_id',$good_id)->paginate($perpage);

             return view('home.good.goodlist',['arr'=>$arr,'goods'=>$goods,'type_id'=>$id,'good'=>$good]);

        }
       //判断是否传递销量参数
        if($request->has('salecnt')){
        $salecnt = $request->only('salecnt');
        $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($salecnt['salecnt'],'desc')->paginate($perpage);

        return view('home.good.goodlist',['goods'=>$goods,'type_id'=>$id,'good'=>$good]);
        }
        //判断是否传递价格参数
        if($request->has('price')){
            $price = $request->only('price');
            $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($price ['price'],'desc')->paginate($perpage);
            return view('home.good.goodlist',['goods'=>$goods,'type_id'=>$id,'good'=>$good]);
        }
        //取出所有 非下架商品并分页   商品状态0新品 1上架 2下架
        $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->paginate($perpage);
        return view('home.good.goodlist',['arr'=>$arr,'goods'=>$goods,'type_id'=>$id,'good'=>$good]);
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
        $perpage = 8;
        //取出销量前四的商品
        $good = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy('good_salecnt','desc')->limit(4)->get();
        //如果有销量参数
        if($request->has('salecnt')){
            $salecnt = $request->only('salecnt');
            $goods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($salecnt['salecnt'],'desc')->paginate($perpage);
            return view('home.good.newgoodlist',['newgoods'=>$newgoods,'type_id'=>$id,'good'=>$good]);
        }
        //如果有价格参数
        if($request->has('price')){
            $price = $request->only('price');
            $newgoods = Good::where('good_status','!=','2')->where('type_id','=',$id)->orderBy($price ['price'],'desc')->paginate($perpage);
            return view('home.good.newgoodlist',['newgoods'=>$goods,'type_id'=>$id,'good'=>$good]);
        }
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
        //关联评论表
        $comment = Good::join('comment','goods.good_id','=','comment.good_id')
            ->join('user_details','comment.user_id','=','user_details.user_id')
            ->where('goods.good_id',$id)
            ->paginate(10);
        // return view('home.good.gooddetail',['good'=>$good,'comment'=>$comment]);
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
         // dd($merchant);
//        dd($types);
        return view('home.good.gooddetail',compact('good','pics','line','comment','merchant'));
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
