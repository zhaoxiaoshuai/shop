<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Mtype extends Model
{
    /**
    * 与模型关联的数据表。
    *
    * @var string
    */
    protected $table = 'mtype';
    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * 指定主键。
     *
     * @var string
     */
    protected $primaryKey="mtype_id";
    /**
     * 指定可以操作的字段.
     *
     * @var array
     */
    protected $fillable = ['mtype_name', 'merchant_id'];
    //    将分类数据排序，分类名称添加缩进，返回有层次关系的分类数据
    public function tree(){
        //先排序
        $mtype = $this->get();
        //添加缩进
        $mtype = $this->getTree($mtype);
        return $mtype;
    }

    public function getTree($mtype)
    {
        $arr = [];
        foreach($mtype as $k=>$v){
//            判断是否是一级类
            if($mtype[$k]->mtype_pid == 0){
                $mtype[$k]['_name'] =  $mtype[$k]->mtype_name;
                $arr[] = $mtype[$k];
//                找当前一级类下的二级类
                foreach ($mtype as $m=>$n){
//                    当前分类是在遍历的一级类的子分类
                   if($v->mtype_id == $n->mtype_pid){
                        $mtype[$m]['_name'] = "|-|-".$mtype[$m]->mtype_name;
                        $arr[] = $mtype[$m];
                   }
                }
            }
        }

        return $arr;

    }
}
