<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    //   轮播图 模型关联表
    protected $table = 'carousel';
    protected $primaryKey="id";
    protected $guarded = [];
    public $timestamps = false;
}
