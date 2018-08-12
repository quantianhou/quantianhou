<?php

namespace App\Models\Merchant;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $table = 'a_merchant';

    protected $guarded = [];
    protected $appends = [
        'merchant_type_name',
        'manage_type_name',
        'status_name'
    ];

    public function getMerchantTypeNameAttribute()
    {
       return array_get([1 => '公司', 2 => '个人'], $this->merchant_type);
    }

    public function getManageTypeNameAttribute()
    {
        return array_get([1 => '连锁', 2 => '非连锁'], $this->manage_type);
    }

    public function getStatusNameAttribute()
    {
        $result = [
            1 =>'新增',
            2 => '审核',
            3 => '退回',
            4 => '通过',
            5 => '拒绝',
            6 => '取消',
            7 => '预约'
        ];
        return array_get($result, $this->status);
    }

}
