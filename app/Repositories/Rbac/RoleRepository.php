<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\Rbac;

use App\Models\Rbac\RoleModel;
use App\Repositories\EloquentRepository;

class AdminRepository extends EloquentRepository
{
    public function __construct(RoleModel $roleModel)
    {
        $this->model = $roleModel;
        parent::__construct($this->model);
    }
}