<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\MerchantAccount;

use App\Models\MerchantAccount\MerchantAccountModel;
use App\Repositories\EloquentRepository;

class MerchantAccountRepository extends EloquentRepository
{
    public function __construct(MerchantAccountModel $merchantAccount)
    {
        $this->model = $merchantAccount;
        parent::__construct($this->model);
    }

    public function getMerchantAccounts($field = ['*'], $where = [], $byAddAdminOrUpdateAdmin = '')
    {
        //$result = $this->model->getMerchantAccounts();
        $model = $this->model->rightJoin('a_merchant', 'users.a_merchant_id', '=', 'a_merchant.id')->where([
            ['users.uid','>',1]
        ]);
        if(!empty($byAddAdminOrUpdateAdmin)){
            if($byAddAdminOrUpdateAdmin == "add"){
                $model->rightJoin('a_admin', 'users.add_admin_id', '=', 'a_admin.id');
            }
            if($byAddAdminOrUpdateAdmin == "update"){
                $model->rightJoin('a_admin', 'users.update_admin_id', '=', 'a_admin.id');
            }
        }
        
        $model->where($where);
        //if($where[''])
        $result = $model->select($field)->get();
        //$this->model;
        return $result;
    }

    public function getMerchantAccountByUsername($username, $field = ['*'])
    {
        $result = $this->model->where([
            ['username','=',$username]
        ])->select($field)->first();
        return $result;
    }

    //通过商家编码来给出appid和appsecrt
    public function getMerchantAccountByCode($where, $field = ['*'])
    {
        $model = $this->model->rightJoin('a_merchant', 'users.a_merchant_id', '=', 'a_merchant.id')->where([
            ['users.uid','>',1]
        ]);
        $model->where($where);
        $result = $model->select($field)->first();
        return $result;
    }

    
}