<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'detail';
    protected  $primaryKey = 'detail_id';
    //允许所有字段添加
    protected  $guarded = [];
    public $timestamps = false;
}
