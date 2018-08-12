<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 *  统一上传
 */
class UploadController extends Controller
{

    /**
     * 上传文件规则
     *
     * @var array
     */
    protected $fileRules = [
        'image' => [
            'mime_types'    => 'jpg,gif,png,bmp',
            'max_file_size' => 1024 * 1024 * 2,
        ],
        'pdf'   => [
            'mime_types'    => 'pdf',
            'max_file_size' => 1024 * 1024 * 50,
        ],
        'ppt'   => [
            'mime_types'    => 'pptx,ppt',
            'max_file_size' => 1024 * 1024 * 50,
        ],
        'audio' => [
            'mime_types'    => 'mp3,wma,wav',
            'max_file_size' => 1024 * 1024 * 50,
        ],
        'zip'   => [
            'mime_types'    => 'zip',
            'max_file_size' => 1024 * 1024 * 50,
        ],
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('upload.index');
    }


    /**
     * oss policy
     *
     * @param Request $request
     * @return array
     */
    public function policy(Request $request)
    {
        $fileType = $request->get('file_type', 'image');
        //        $multi = $request->get('multi', 0);

        $checkFileType = $this->checkFileType($fileType);
        if (!$checkFileType) {
            return ['error' => 1, 'msg' => '不允许的文件类型'];
        }

        return [
            'error' => 0,
            'data'  => $this->getOSSParams($fileType)
        ];
    }

    /**
     * 检查支持文件类型
     *
     * @param $fileType
     * @return bool
     */
    protected function checkFileType($fileType)
    {
        return in_array($fileType, array_keys($this->fileRules));
    }

    /**
     * 文件路径
     *
     * @param $fileType
     * @return string
     */
    protected function getFilePath($fileType)
    {
        return 'upload/' . $fileType . '/' . date('Ym') . "/" . date('d') . "/";
    }

    /**
     * 获取oss参数
     *
     * @param $fileType
     * @return array
     */
    protected function getOSSParams($fileType)
    {
        $id = env('OSS_ACCESSKEYID');
        $key = env('OSS_ACCESSKEYSECRET');
        $host = env('OSS_HOST');

        $now = time();
        $expire = 60; //设置该policy超时时间是10s. 即这个policy过了这个有效时间，将不能访问
        $end = $now + $expire;
        $expiration = $this->gmtISO8601($end);

        $dir = $this->getFilePath($fileType);
        $rule = array_get($this->fileRules, $fileType);
        $maxFileSize = $rule['max_file_size'];
        //最大文件大小.用户可以自己设置
        $conditions[] = ['content-length-range', 0, $maxFileSize];

        //表示用户上传的数据,必须是以$dir开始, 不然上传会失败,这一步不是必须项,只是为了安全起见,防止用户通过policy上传到别人的目录
        $conditions[] = ['starts-with', '$key', $dir];

        $arr = [
            'expiration' => $expiration,
            'conditions' => $conditions,
        ];

        $policy = json_encode($arr);
        $base64_policy = base64_encode($policy);
        $string_to_sign = $base64_policy;
        $signature = base64_encode(hash_hmac('sha1', $string_to_sign, $key, true));

        $response = [];
        $response['accessid'] = $id;
        $response['host'] = $host;
        $response['policy'] = $base64_policy;
        $response['signature'] = $signature;
        $response['expire'] = $end;
        $response['dir'] = $dir;
        $response['mime_types'] = $rule['mime_types'];
        $response['file_type'] = $fileType . ' files';
        $response['file_max_size'] = $maxFileSize / 1024 / 1024 . 'm';
        return $response;
    }

    /**
     * gmtISO8601
     *
     * @param $time
     * @return string
     */
    protected function gmtISO8601($time)
    {
        $dtStr = date("c", $time);
        $mydatetime = new \DateTime($dtStr);
        $expiration = $mydatetime->format(\DateTime::ISO8601);
        $pos = strpos($expiration, '+');
        $expiration = substr($expiration, 0, $pos);
        return $expiration . "Z";
    }
}
