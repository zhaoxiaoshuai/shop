<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Good_attr extends Model
{
    // 模型关联
    protected $table = 'good_attr';
    protected  $primaryKey = 'ga_id';
    //允许所有字段添加
    protected  $guarded = [];
    public $timestamps = false;
}
