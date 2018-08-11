<?php

namespace App\Models\MerchantAccount;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use App\Models\Merchant\Merchant;

class MerchantAccount extends Model
{
    protected $table = 'users';//微擎的表

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

    /**
     * role
     * 获取用户角色信息
     */

    public function getMerchantAccounts(){
        //return $this->hasMany(Merchant::class, 'a_merchant_id', 'id');
        return DB::table('users')
            ->leftJoin('a_merchant', 'users.a_merchant_id', '=', 'a_merchant.id')->select(['users.*','a_merchant.id as merchant_id','a_merchant.merchant_name','a_merchant.status_name'])
            ->get();
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
