<?php

namespace Modules\Api\Http\Controllers\MerchantAccount;

use App\Repositories\MerchantAccount\MerchantAccountRepository;
use App\Repositories\Area\AreaRepository;
use App\Repositories\ActionLog\ActionLogRepository;
use App\Repositories\Admin\AdminRepository;
use Mockery\CountValidator\Exception;
use Illuminate\Http\Request;
use Modules\Api\Http\Controllers\ApiController;
use Carbon\Carbon;

class MerchantAccountController extends ApiController
{
    private $merchants;

    public function __construct(MerchantAccountRepository $merchantAccount,AreaRepository $areas,ActionLogRepository $actionLog,AdminRepository $adminRepository)
    {
        parent::__construct();
        $this->merchants = $merchantAccount;
        $this->areas = $areas;
        $this->actionLog = $actionLog;
        $this->adminRepository = $adminRepository;
    }

    
    //通过商家编码来给出appid和appsecrt
    public function getAppInfo(Request $request){
        $merchant_code = $request->get('merchant_code');
//        var_dump($merchant_code);exit;
        if(empty($merchant_code)){
            return [
                'statusCode' => 500,
                'error' => true,
                'message' => '参数错误',
            ];
        }
        $where[] = ['a_merchant.merchant_code','=',$merchant_code];
        $result = $this->merchants->getMerchantAccountByCode($where,['app_id','app_secret']);

        if(empty($result->app_id)){
            return [
                'statusCode' => 500,
                'error' => true,
                'message' => '不存在此商户',
            ];
        }
        $data['appId'] = $result->app_id;
        $data['appSecret'] = $result->app_secret;
        return [
            'statusCode' => 200,
            'message' => 'success',
            'data' => $data
        ];
    }
}
