<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2018/8/7
 * Time: 下午8:45
 */

namespace Modules\Admin\Http\Controllers;


use Illuminate\Routing\Controller;

class BaseController extends Controller
{

    public function success($data, $status, $msg = '')
    {
        return [
            'err' => $status,
            'data' => $data,
            'msg' => $msg,
        ];
    }
}