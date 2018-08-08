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
            'statusCode' => $status,
            'data' => $data,
            'message' => $msg,
        ];
    }

    protected function formatImgUrl($request, $field)
    {
        $image = $request->get($field, []);
        if (empty($image)) {
            return '';
        }
        return implode('|', $image);
    }
}