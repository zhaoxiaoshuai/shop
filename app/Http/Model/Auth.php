<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    /**
    * 与模型关联的数据表。
    *
    * @var string
    */
    protected $table = 'auth';
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
    protected $primaryKey="auth_id";
    /**
     * 指定可以操作的字段.
     *
     * @var array
     */
    protected $fillable = ['auth_id', 'auth_name','auth_content','auth_description','auth_group'];

    //将权限数据排序，权限名称添加缩进，返回有层次关系的权限数据
    public static function tree(){
        //获取所有权限
        $auths = self::get();
        //添加缩进
        $auths = self::getTree($auths);

        return $auths;
    }

    public static function getTree($auths)
    {
        $arr = [];
        foreach($auths as $k=>$v){
//            判断是否是一级类
            if($auths[$k]->auth_group == 0){
                $auths[$k]['_name'] =  $auths[$k]->auth_name;
                $arr[] = $auths[$k];
//                找当前一级类下的二级类
                foreach ($auths as $m=>$n){
//                    当前分类是在遍历的一级类的子分类
                   if($v->auth_id == $n->auth_group){
                        $auths[$m]['_name'] = "|-|-".$auths[$m]->auth_name;
                        $arr[] = $auths[$m];
                   }
                }
            }
        }
        return $arr;

    }
}
