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

    public function getOne($id = 0, $columns = ['*'])
    {
        $result = $this->model
            ->where('id', $id)
            ->first($columns);
        return $result;
    }

}