<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
	protected $adminInfo;

    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $this->adminInfo = Session::get('admin');
            return $next($request);
        });
    }
}