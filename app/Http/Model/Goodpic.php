<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Goodpic extends Model
{
    //    模型关联表
    protected $table = 'goodpic';
    protected $primaryKey="goodpic_id";
//    protected $fillable = ['user_name', 'user_pass'];
    protected $guarded = [];
    public $timestamps = false;
}
