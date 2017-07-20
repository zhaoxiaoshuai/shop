<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    //    模型关联表
    protected $table = 'navs';
    protected $primaryKey="nav_id";
    protected $guarded = [];
    public $timestamps = false;
}
