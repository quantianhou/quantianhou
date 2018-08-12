<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\Rbac;

use App\Models\Rbac\NodeModel;
use App\Repositories\EloquentRepository;

class NodeRepository extends EloquentRepository
{
    public function __construct(NodeModel $nodeModel)
    {
        $this->model = $nodeModel;
        parent::__construct($this->model);
    }
}