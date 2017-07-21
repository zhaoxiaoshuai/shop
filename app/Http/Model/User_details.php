<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User_details extends Model
{
    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'user_details';

    /**
     * 主键
     *
     * @var string
     */
    protected $primaryKey="deta_id";

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
    protected $fillable = ['deta_score', 'deta_job','deta_addr','deta_face','deta_age','deta_sex','deta_birthday','user_id',];
}
