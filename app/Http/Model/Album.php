<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class album extends Model
{
    //获取相册下面的照片
    public function photo()
    {
        return $this->hasMany('App\Model\Photo');
    }
}
