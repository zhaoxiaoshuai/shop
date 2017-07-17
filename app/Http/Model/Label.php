<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    // 模型关联
    protected $table = 'label';
    protected  $primaryKey = 'id';
    //允许所有字段添加
    protected  $guarded = [];
    public $timestamps = false;
}
