<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\Goods;

use App\Models\Goods\GoodsModel;
use App\Repositories\EloquentRepository;

class GoodsRepository extends EloquentRepository
{
    public function __construct(
        GoodsModel $goods
    )
    {
        $this->model = $goods;
        parent::__construct($this->model);
    }

    public function getMerchants()
    {
        $result = $this->model->get();
        return $result;
    }
}