<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\MerchantAccount;

use App\Models\MerchantAccount\MerchantAccount;
use App\Repositories\EloquentRepository;

class MerchantAccountRepository extends EloquentRepository
{
    public function __construct(MerchantAccount $merchantAccount)
    {
        $this->model = $merchantAccount;
        parent::__construct($this->model);
    }

    public function getListByWhere($filters = [], $columns = ['*'], $with = [])
    {
        $result = $this->model
            ->with($with)
            ->whereNested(function ($query) use ($filters) {
                if (empty($query)) return;
                foreach ($filters as $filter) {
                    $query->where($filter[0], $filter[1], $filter[2]);
                }
            })->get($columns);
    }

    public function getMerchantAccounts($field = [])
    {
        //$result = $this->model->getMerchantAccounts();
        $result = $this->model->leftJoin('a_merchant', 'users.a_merchant_id', '=', 'a_merchant.id')->select($field)->get("*");

        foreach ($result as $v){
            $v->ddd = $v->getStatusNameAttribute();
        }
        dd($result);
        //$result = $this->model->leftJoin('a_merchant', 'users.a_merchant_id', '=', 'a_merchant.id')->select()->get("*");
        return $result;
    }
}