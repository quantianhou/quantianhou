<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\Rbac;

use App\Models\Rbac\RelationModel;
use App\Repositories\EloquentRepository;

class AdminRepository extends EloquentRepository
{
    public function __construct(RelationModel $relationModel)
    {
        $this->model = $relationModel;
        parent::__construct($this->model);
    } 
}