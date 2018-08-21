<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\Merchant;

use App\Models\Merchant\Merchant;
use App\Repositories\EloquentRepository;

class MerchantRepository extends EloquentRepository
{
    public function __construct(Merchant $merchant)
    {
        $this->model = $merchant;
        parent::__construct($this->model);
    }

    public function getMerchants()
    {
        $result = $this->model->get();
        return $result;
    }

    public function getOneMerchant($id = 0, $columns = ['*'])
    {
        $result = $this->model
            ->where('id', $id)
            ->first($columns);
        return $result;
    }

    //得到还没开通账号的商家列表
    public function getMerchantNoAccounts($field = ['a_merchant.id','a_merchant.merchant_name'], $where = [])
    {
        $result = $this->model->leftJoin('users', 'users.a_merchant_id', '=', 'a_merchant.id')->where($where)->whereNull('users.uid')->select($field)->get();
        return $result;
    }
}