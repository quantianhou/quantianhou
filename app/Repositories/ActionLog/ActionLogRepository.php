<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/6
 * Time: 上午10:16
 */

namespace App\Repositories\ActionLog;


use App\Models\ActionLog\ActionLogModel;
use App\Repositories\EloquentRepository;

class ActionLogRepository extends EloquentRepository
{
    public function __construct(ActionLogModel $actionLogModel)
    {
        $this->model = $actionLogModel;
        parent::__construct($this->model);
    }

    public function getOneLog($id = 0, $columns = ['a_action_log.*','a_admin.username'])
    {
//        $result = $this->model
//            ->where('data_id', $id)
//            ->orderBy('id','desc')
//            ->first($columns);

        $result = $this->model->leftJoin('a_admin', 'a_action_log.a_admin_id', '=', 'a_admin.id')->where([
            ['data_id','=',$id]
        ])->orderBy('id','desc')->first($columns);

        return $result;
    }
}