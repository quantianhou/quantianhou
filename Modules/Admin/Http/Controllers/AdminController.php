<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
	protected $admin;

    public function __construct()
    {
        if (config('app.debug')) {
            \DB::enableQueryLog();
        }

        $this->middleware(function ($request, $next) {
            $this->admin = Session::get('admin');

            if(empty($this->admin) && !$request->is('api/login/index')){
                return response()->json([
                    'error' => 403,
                    'info' => '请登陆',
                    'code' => 403
                ]);;
            }
            return $next($request);
        });
    }

    public function json($data = []){
        config('app.debug') && $data['sql'] = \DB::getQueryLog();
        return response()->json($data);
    }
}