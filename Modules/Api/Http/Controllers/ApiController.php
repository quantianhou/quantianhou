<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{

    public function __construct()
    {
        if (config('app.debug')) {
            \DB::enableQueryLog();
        }

        $this->middleware(function ($request, $next) {
            return $next($request);
        });
    }

    public function json($data = [],$sign = true){
        $sign && config('app.debug') && $data['sql'] = \DB::getQueryLog();
        return response()->json($data);
    }
}
