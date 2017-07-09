<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class StoreAdmin extends Model
{
    //连接数据库  shop_store_admin
    protected $table = 'store_admin';
    // protected $primaryKey="store_admin_id";
    // 获取指定字段
    // protected $fillable = ['sid','uid','mid'];

    // 获取所有的字段
    protected $guarded = [];

    public $timestamps = false;
}
