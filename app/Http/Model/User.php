<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //关联的表名
    protected $table = 'user';
    //
    protected $primaryKey="user_id";
    //时间
    public $timestamps = false;
    //不可被赋值的字段
    protected $guarded = [];
}
