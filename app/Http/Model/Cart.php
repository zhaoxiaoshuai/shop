<?php

namespace App\http\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected  $primaryKey = 'cart_id';
    //允许所有字段添加
    protected  $guarded = [];
    public $timestamps = false;
}
