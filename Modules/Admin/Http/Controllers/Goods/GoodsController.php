<?php

namespace Modules\Admin\Http\Controllers\Goods;

use App\Models\Rbac\RoleModel;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Http\Controllers\AdminController;

class GoodsController extends AdminController
{

	public function __construct(

    )
    {
        parent::__construct();

    }

    /**
     * 菜单
     * @return Response
     */
    public function save()
    {


        return $this->json([
            'data' => 200,
            'info' => '保存',
            'code' => 200
        ]);
    }


}