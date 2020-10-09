<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    public $table = 'p_goods';  //声明model使用的表
    protected $primaryKey ='goods_id';  //声明表的主键
    public $timestamps = false; //时间戳
    protected $guarded = [];//黑名单
}
