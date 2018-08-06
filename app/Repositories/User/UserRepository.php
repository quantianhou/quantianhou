<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\User;


use App\Models\User;
use App\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
        parent::__construct($this->model);
    }
}