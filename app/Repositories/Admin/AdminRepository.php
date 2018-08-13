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
    public function __construct(
        AdminModel $adminModel
    )
    {
        $this->model = $adminModel;
        parent::__construct($this->model);
    }

    /**
     * 获取用户权限组
     */
    public function getNodeByAdminId($adminId){

        return self::merge($this->model->find($adminId)->role()->first()->node->toArray());
    }

    private function merge($node,$access = null,$pid = 0){

        $arr = array();

        foreach($node as $v){
            if(is_array($access)){
                $v['access'] = in_array($v['id'],$access) ? 1 : 0;
            }
            if($v['pid'] == $pid){
                $v['child'] = self::merge($node,$access,$v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * 根据id获取用户信息
     */
    public function getNameByAdminId($adminId){

        return $this->model->where([
            ['id','=',$adminId]
        ])->first();
    }
}