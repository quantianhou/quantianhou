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
        $this->middleware(function ($request, $next) {
            $this->admin = Session::get('admin');
            return $next($request);
        });
    }
}