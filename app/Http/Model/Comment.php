<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //   评论 模型关联表
    protected $table = 'comment';
    protected $primaryKey="id";
    protected $guarded = [];
    public $timestamps = false;
}
