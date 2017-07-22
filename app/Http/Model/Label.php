<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    // 模型关联
    protected $table = 'label';
    protected  $primaryKey = 'label_id';
    //允许所有字段添加
    protected  $guarded = [];
    public $timestamps = false;
    //获取属于哪个分类
    public function type()
    {
        return $this->belongsTo('App\Http\Model\Type','type_id','type_id');
    }

     /**
     * 获取标签值。
     */
    public function las()
    {
        return $this->hasMany('App\Http\Model\Label_attr','label_id','label_id');
    }
}
