<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\Admin;


use App\Models\Admin\AdminModel;
use App\Repositories\EloquentRepository;

class AdminRepository extends EloquentRepository
{
    public function __construct(AdminModel $adminModel)
    {
        $this->model = $adminModel;
        parent::__construct($this->model);
    }
}