<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //连接数据库
    protected $table = 'store';
    // protected $primaryKey="store_id";
    // 获取指定字段
    // protected $fillable = ['sid','uid','mid'];

    // 获取所有的字段
    protected $guarded = [];

    public $timestamps = false;
}
