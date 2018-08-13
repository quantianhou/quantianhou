<?php

namespace Modules\Admin\Http\Controllers\Rbac;

use App\Models\Rbac\RoleModel;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Http\Controllers\AdminController;

class RbacController extends AdminController
{

	public function __construct(
        AdminRepository $adminRepository
    )
    {
        parent::__construct();
        $this->adminRepository = $adminRepository;
    }

    /**
     * 菜单
     * @return Response
     */
    public function menu()
    {
		//获取菜单
        $adminId = $this->admin->id;
        $nodes = $this->adminRepository->getNodeByAdminId($adminId);

        return $this->json([
            'data' => $nodes,
            'info' => '登陆成功',
            'code' => 200
        ]);
    }


}
