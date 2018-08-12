<?php
namespace App\Models\Rbac;

use App\Models\BaseModel;

class RoleModel extends BaseModel {

    protected  $table = 'a_rbac_role';


    /**
     * role
     * 获取角色授权节点
     */

    public function node(){
        return $this->belongsToMany(NodeModel::class, 'a_rbac_access', 'role_id', 'node_id');
    }
}