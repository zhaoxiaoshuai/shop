<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //关联的表名
    protected $table = 'delivery_address';
    //
    protected $primaryKey="address_id";
    //时间
    public $timestamps = false;
    //不可被赋值的字段
    protected $guarded = [];
}
