<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\ShopStore;

use App\Models\ShopStore\ShopStore;
use App\Repositories\EloquentRepository;

class ShopStoreRepository extends EloquentRepository
{
    public function __construct(ShopStore $shopStore)
    {
        $this->model = $shopStore;
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