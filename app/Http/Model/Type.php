<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //    模型关联表
    protected $table = 'type';
    protected $primaryKey="type_id";
   // protected $fillable = ['user_name', 'user_pass'];
    protected $guarded = [];
    public $timestamps = false;
}
