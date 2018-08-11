<?php

namespace Modules\Admin\Http\Controllers\Goods;

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
     * 商品列表
     */
    public function index(Request $request){

        $filters = [];
        $pageSize = $request->get('pageSize', 10);
        $list =  $this->merchants->getListByWhere($filters, ['*'], [], $pageSize);

        return $this->pageSuccess($list);

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
