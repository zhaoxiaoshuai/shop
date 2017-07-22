<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{	
	//关联的表名
    protected $table = 'orders';
    //
    protected $primaryKey="id";
    //时间
    public $timestamps = false;
    //不可被赋值的字段
    protected $guarded = [];
}
