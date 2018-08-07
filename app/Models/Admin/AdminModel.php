<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

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

}