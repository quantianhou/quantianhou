<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\Rbac;

use App\Models\Rbac\AccessModel;
use App\Repositories\EloquentRepository;

class AdminRepository extends EloquentRepository
{
    public function __construct(AccessModel $accessModel)
    {
        $this->model = $accessModel;
        parent::__construct($this->model);
    }
}