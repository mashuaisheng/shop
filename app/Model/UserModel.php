<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    public $table = 'user';  //声明model使用的表
    protected $primaryKey ='uid';  //声明表的主键
    public $timestamps = false; //时间戳
    protected $guarded = [];//黑名单
}
