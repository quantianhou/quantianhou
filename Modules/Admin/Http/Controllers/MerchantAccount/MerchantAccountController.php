<?php

namespace Modules\Admin\Http\Controllers\MerchantAccount;

use App\Repositories\MerchantAccount\MerchantAccountRepository;
use App\Repositories\Area\AreaRepository;
use App\Repositories\ActionLog\ActionLogRepository;
use App\Repositories\Admin\AdminRepository;
use Mockery\CountValidator\Exception;
use Modules\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\BaseController;
use Carbon\Carbon;
//use Modules\admin\Http\Requests\Merchant\MerchantRequest;

class MerchantAccountController extends AdminController
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

    public function index(Request $request)
    {
        $a_merchant_id = $request->get('a_merchant_id');
        $merchant_code = $request->get('merchant_code');
        $status = $request->get('status');
        $address_detail = $request->get('address_detail');

        $add_admin_name = $request->get('add_admin_name');
        $created_at_start = $request->get('created_at_start');
        $created_at_end = $request->get('created_at_end');
        $update_admin_name = $request->get('update_admin_name');
        $updated_at_start = $request->get('updated_at_start');
        $updated_at_end = $request->get('updated_at_end');

        $where = [];
        $byAddAdminOrUpdateAdmin = '';
        if(!empty($a_merchant_id)){
            $where['users.a_merchant_id'] = $a_merchant_id;
        }
        if(!empty($merchant_code)){
            $where['a_merchant.merchant_code'] = $merchant_code;
        }
        if(!empty($status)){
            if($status == 7){
                $where[] = ['a_merchant.status','=', 7];
            }
            if($status == "!7"){
                $where[] = ['a_merchant.status','<>', 7];
            }
        }
        if(!empty($address_detail)){
            $where[] = ['a_merchant.address_detail','LIKE','%'.$address_detail.'%'];
        }
        if(!empty($add_admin_name)){
            $where[] = ['a_admin.username','=',$add_admin_name];
            $byAddAdminOrUpdateAdmin = 'add';
        }
        if(!empty($created_at_start) && !empty($created_at_end)){
            $created_at_start .= " 00:00:00";
            $created_at_end .= " 23:59:59";
            $where[] = ['users.created_at','>=',$created_at_start];
            $where[] = ['users.created_at','<=',$created_at_end];
        }
        if(!empty($update_admin_name)){
            $where[] = ['a_admin.username','=',$update_admin_name];
            $byAddAdminOrUpdateAdmin = 'update';
        }
        if(!empty($updated_at_start) && !empty($updated_at_end)){
            $updated_at_start .= " 00:00:00";
            $updated_at_end .= " 23:59:59";
            $where[] = ['users.updated_at','>=',$updated_at_start];
            $where[] = ['users.updated_at','<=',$updated_at_end];
        }
//        if(!empty($created_at_end)){
//            $where[] = ['users.address_detail','LIKE','%'.$address_detail.'%'];
//        }

        $list = $this->merchants->getMerchantAccounts(['users.*','a_merchant.*','a_merchant.id as merchant_id','users.created_at as user_created_at','users.updated_at as user_updated_at'], $where, $byAddAdminOrUpdateAdmin);
//        dd(\DB::getQueryLog());exit;
        foreach($list as $k => $v){
            //拼接完整地址
            $full_address = '';
            $full_address .= $this->areas->getOneArea($v['address_province'], ['id', 'name'],1)->name;
            $full_address .= $this->areas->getOneArea($v['address_city'], ['id', 'name'],1)->name;
            $full_address .= $this->areas->getOneArea($v['address_district'], ['id', 'name'],1)->name;
            $full_address .= $v['address_detail'];
            $list[$k]['full_address'] = $full_address;

            $add_admin_info = $this->adminRepository->getNameByAdminId($v['add_admin_id']);
            $list[$k]['add_admin'] = $add_admin_info->username;

            //看当前账号最后更新人
//            $last_update_admin = $this->actionLog->getOneLog($v['id']);
//            $list[$k]['last_update_admin'] = !empty($last_update_admin->username) ? $last_update_admin->username : '';
//            $list[$k]['last_update_created_at'] = !empty($last_update_admin->created_at->timestamp) ? date('Y-m-d h:i:s',$last_update_admin->created_at->timestamp) : '';
            $last_update_admin = $this->adminRepository->getNameByAdminId($v['update_admin_id']);
            $list[$k]['last_update_admin'] = !empty($last_update_admin->username) ? $last_update_admin->username : '';
            $list[$k]['last_update_created_at'] = $v->user_updated_at;
        }
//
        return $list;
    }


    //重置密码
    public function resetPasswd(Request $request)
    {
        $uid = $request->get('uid');
        //重置成123456
        $salt = $this->random(8);
        $data['password'] = $this->user_hash("123456", $salt);
        $data['salt'] = $salt;
        try {
            $result = $this->merchants->updateByOtherColumn('uid', $uid, $data);
            return [
                'statusCode' => 200,
                'data' => $result,
                'message' => '密码已成功重置为123456',
            ];

        }catch (\Exception $e){
            return [
                'statusCode' => 500,
                'error' => true,
                'message' => '密码重置失败，请重试',
            ];
        }
    }

    /**
     * 新增商家B端账号
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        if(empty($request->get('username'))){
            return [
                'statusCode' => 500,
                'error' => true,
                'message' => '请输入账号名称',
            ];
        }
        if(empty($request->get('password'))){
            return [
                'statusCode' => 500,
                'error' => true,
                'message' => '请输入原始密码',
            ];
        }
        $data = $this->makeData($request);
        $hasUser = $this->merchants->getMerchantAccountByUsername($data['username']);
        if(!empty($hasUser->uid)){
            return [
                'statusCode' => 500,
                'error' => true,
                'message' => '用户名已存在，请重新输入',
            ];
        }
        try {
            $result = $this->merchants->create($data);
            return [
                'statusCode' => 200,
                'data' => $result,
                'message' => '添加成功',
            ];

        }catch (\Exception $e){
            return [
                'statusCode' => 500,
                'error' => true,
                'message' => '添加失败，请重试',
            ];
        }
    }

    private function makeData(Request $request)
    {
        $salt = $this->random(8);
        $data = [
            'username' => $request->get('username'),
            'password' => $this->user_hash($request->get('password'), $salt),
            'salt' => $salt,
            'a_merchant_id' => $request->get('a_merchant_id'),
            'add_admin_id' => $this->admin->id,
            'user_status' => 1,
            'created_at' => date('Y-m-d H:i:s'),

            'groupid' => 1,//微擎的字段，写死，微擎框架的商城组
            'type' => 0,//微擎的字段，写死，不知道意义
            'status' => 2,//微擎的字段，写死，不知道意义
            'joindate' => time(),//微擎的字段
            'joinip' => $request->ip(),//微擎的字段
            'joindate' => time(),//微擎的字段
            'lastip' => $request->ip(),//微擎的字段
            'lastvisit' => time(),//微擎的字段
            'remark' => '',//微擎的字段
            'starttime' => time(),//微擎的字段
            'endtime' => strtotime('365 days'),//微擎的字段,根据商城组读取的users_group里的timelimit字段，数据表里读取出是365天，这里直接写死成365天
        ];

        return $data;
    }

    public function user_hash($passwordinput, $salt) {
        //937f950d 是微擎框架的 $_W['config']['setting']['authkey']
        $passwordinput = "{$passwordinput}-{$salt}-937f950d";
        return sha1($passwordinput);
    }

    function random($length, $numeric = FALSE) {
        $seed = base_convert(md5(microtime() . $_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
        $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
        if ($numeric) {
            $hash = '';
        } else {
            $hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
            $length--;
        }
        $max = strlen($seed) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $seed{mt_rand(0, $max)};
        }
        return $hash;
    }

    private function makeMerchantCode()
    {
        return md5(time() . rand(0, 999999));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
