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

        return $result;
    }
}