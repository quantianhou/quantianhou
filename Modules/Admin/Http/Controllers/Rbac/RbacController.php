<?php

namespace Modules\Admin\Http\Controllers\Rbac;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Http\Controllers\AdminController;

class RbacController extends AdminController
{

	public function __construct()
    {
        parent::__construct();

    }

    /**
     * 菜单
     * @return Response
     */
    public function menu()
    {
		//获取菜单
    }


}
