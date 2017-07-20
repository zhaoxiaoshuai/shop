<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Label_attr extends Model
{
     // 模型关联
    protected $table = 'label_attr';
    protected  $primaryKey = 'la_id';
    //允许所有字段添加
    protected  $guarded = [];
    public $timestamps = false;

    public function labels()
    {
        return $this->belongsTo('App\Http\Model\Label','label_id','label_id');
    }
}
