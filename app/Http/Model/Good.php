<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //    模型关联表
    protected $table = 'goods';
    protected $primaryKey="good_id";
//    protected $fillable = ['user_name', 'user_pass'];
    protected $guarded = [];
    public $timestamps = false;
    /**
     * 获取缩略图。
     */
    public function pics()
    {
        return $this->hasMany('App\Http\Model\Goodpic','good_id','good_id');
    }
}
