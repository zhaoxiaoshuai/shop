<?php

namespace App\http\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
    * 与模型关联的数据表。
    *
    * @var string
    */
    protected $table = 'admin';
    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * 指定主键。
     *
     * @var string
     */
    protected $primaryKey="admin_id";
    /**
     * 指定可以操作的字段.
     *
     * @var array
     */
    protected $fillable = ['admin_name', 'admin_password','admin_phone','admin_email','admin_lasttime','admin_create'];
}
