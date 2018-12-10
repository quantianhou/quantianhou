<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\Area;


use App\Models\Area\Area;
use App\Repositories\EloquentRepository;

class AreaRepository extends EloquentRepository
{
    public function __construct(Area $area)
    {
        $this->model = $area;
        parent::__construct($this->model);
    }

    /**
     * 查找地区通过parent_id
     * @param int $parentId
     * @param array $colnums
     * @param int $ifJson
     *
     * @return array|\Illuminate\Support\Collection
     */
    public function getAreas($parentId = 0, $colnums = ['*'], $ifJson = 0)
    {
        $result = $this->model
            ->where('parent_id', $parentId)
            ->get($colnums);

        if ($ifJson) {
            return $this->toAreaJson($result);
        }
        return $result;
    }

    /**
     * 查找地区通过parent_id
     * @param int $parentId
     * @param array $colnums
     * @param int $ifJson
     *
     * @return array|\Illuminate\Support\Collection
     */
    public function getAreasByParentName($name = 0, $colnums = ['*'], $ifJson = 0)
    {
        $parentId = $this->model
            ->where('name', $name)
            ->first($colnums);
        $result = $this->model
            ->where('parent_id', $parentId->id)
            ->get($colnums);

        if ($ifJson) {
            return $this->toAreaJson($result);
        }
        return $result;
    }

    public function getOneArea($id = 0, $columns = ['*'])
    {
        $result = $this->model
            ->where('id', $id)
            ->first($columns);

        return $result;
    }

    /**
     * 组合联动
     * @param Area $result
     *
     * @return array
     */
    private function toAreaJson($result)
    {
        $areas = [];
        if ($result->isNotEmpty()) {
            foreach ($result as $item) {
               $areas[] = [
                   'value' => $item->id,
                   'label' => $item->name,
               ];
            }
        }
        return $areas;
    }

    /**
     * 组合联动，value和label都是文本，不用code
     * @param Area $result
     *
     * @return array
     */
    private function toAreaJsonUseText($result)
    {
        $areas = [];
        if ($result->isNotEmpty()) {
            foreach ($result as $item) {
                $areas[] = [
                    'value' => $item->name,
                    'label' => $item->name,
                ];
            }
        }
        return $areas;
    }

    public function getName()
    {
        $result = \Cache::remember('area_list', 3600, function () {
            return $this->model->get();
        });
        return $result;
    }
}