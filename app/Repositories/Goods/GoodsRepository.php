<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\Goods;

use App\Models\Goods\ExtraModel;
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

    public function saveGoods($goods,$extra)
    {
        if($goods['id'] > 0){
            //修改
            $goodsInfo = $this->model->find($goods['id']);
            $this->update($goods['id'],$goods);
            return $goodsInfo->extra()->update($extra);
        }else{
            //新增
            $goodsInfo = $this->model->create($goods);
            return $goodsInfo->extra()->create($extra);
        }

    }

    /**
     * 删除
     */
    public function deleteGoods($ids = []){
        return $this->model->delete($ids);
    }

    /**
     * 获取详情
     */
    public function getdetail($id){

        $goodsInfo = $this->model->find($id);
        return [
            'goods' => $goodsInfo,
            'extra' => $goodsInfo->extra
        ];
    }
}