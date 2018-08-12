<?php
namespace App\Models\Admin;

use App\Models\BaseModel;
use App\Models\Rbac\RoleModel;

class AdminModel extends BaseModel {

    protected  $table = 'a_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'username', 'last_login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * role
     * 获取用户角色信息
     */

    public function role(){
        return $this->belongsToMany(RoleModel::class, 'a_rbac_admin_role', 'admin_id', 'role_id');
    }

}