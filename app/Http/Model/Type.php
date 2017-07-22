<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //    模型关联表
    protected $table = 'type';
    protected $primaryKey="type_id";
   // protected $fillable = ['user_name', 'user_pass'];
    protected $guarded = [];
    public $timestamps = false;

     /**
     * 获取分类的标签。
     */
    public function labels()
    {
        return $this->hasMany('App\Http\Model\Label','type_id','type_id');
    }
}
