<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Role_auth extends Model
{
    /**
    * 与模型关联的数据表。
    *
    * @var string
    */
    protected $table = 'role_auth';
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
    protected $primaryKey="ra_id";
    /**
     * 指定可以操作的字段.
     *
     * @var array
     */
    protected $fillable = ['role_id', 'auth_id'];
}
