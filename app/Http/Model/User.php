<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * 主键
     *
     * @var string
     */
    protected $primaryKey="user_id";

    /**
     * 是否管理时间戳
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * 可操作字段
     *
     * @var string
     */
    protected $fillable = ['user_name', 'user_password','user_phone','user_email','createtime','lasttime','status','token'];
}
