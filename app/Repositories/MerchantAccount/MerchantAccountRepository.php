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

    public function getMerchantAccounts($field = [])
    {
        //$result = $this->model->getMerchantAccounts();
        $result = $this->model->rightJoin('a_merchant', 'users.a_merchant_id', '=', 'a_merchant.id')->where([
            ['users.uid','>',1]
        ])->select($field)->get();
        return $result;
    }

    //得到还没开通账号的商家列表
    public function getMerchantNoAccounts($field = [])
    {
        $result = $this->model->rightJoin('a_merchant', 'users.a_merchant_id', '=', 'a_merchant.id')->where([
            ['users.uid','>',1]
        ])->select($field)->get();
        return $result;
    }
}