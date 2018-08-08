<?php

namespace Modules\Admin\Http\Controllers\Login;

use App\Repositories\Admin\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Http\Controllers\AdminController;

class IndexController extends AdminController
{

	public function __construct(
        AdminRepository $adminRepository
    )
    {
        parent::__construct();
        $this->adminRepository = $adminRepository;
    }

    /**
     * 登陆接口
     * @return Response
     */
    public function index(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        if(empty($username) || empty($password)){
            return $this->json([
                'error' => 2001,
                'info' => '缺少参数',
                'code' => 2001
            ]);;
        }
        $userInfo = $this->adminRepository->findWhere([
            ['username','=',$username],
            ['password','=',md5($password)],
        ]);

        if(empty($userInfo)){
            return $this->json([
                'error' => 2002,
                'info' => '用户名或密码错误',
                'code' => 2002
            ]);;
        }

        $userInfo->last_login = time();
        $userInfo->save();
        Session::put('admin', $userInfo);

        return $this->json([
            'data' => 200,
            'info' => '登陆成功',
            'code' => 200
        ]);;


    }
}
