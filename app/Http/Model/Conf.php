<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Conf extends Model
{
    //
    protected $table = 'config';
    protected  $primaryKey = 'id';
    //允许所有字段添加
    protected  $guarded = [];
    public $timestamps = false;
}
