<?php

namespace App\http\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
    * 与模型关联的数据表。
    *
    * @var string
    */
    protected $table = 'role';
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
    protected $primaryKey="role_id";
    /**
     * 指定可以操作的字段.
     *
     * @var array
     */
    protected $fillable = ['role_name', 'role_description'];
     public function auths()
    {
        return $this->belongsToMany('App\Http\Model\Auth','role_auth', 'role_id', 'auth_id');
    }
}
