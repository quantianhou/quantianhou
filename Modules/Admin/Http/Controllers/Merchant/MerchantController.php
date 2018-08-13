<?php

namespace Modules\Admin\Http\Controllers\Merchant;

use App\Repositories\Merchant\MerchantRepository;
use App\Repositories\Area\AreaRepository;
use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\BaseController;
use Modules\admin\Http\Requests\Merchant\MerchantRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MerchantController extends BaseController
{
    private $merchants;

    public function __construct(MerchantRepository $merchants,AreaRepository $areas)
    {
        $this->merchants = $merchants;
        $this->areas = $areas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = [];
        $post_data = $request->get('post_data');
        if(!empty($post_data) && is_array($post_data)){
            foreach($post_data as $val){
                if(!empty($val['value'])) {
                    $type = '=';
                    if(in_array($val['name'],["address_city",'address_district']) && !is_numeric($val['value'])){
                        continue ;
                    }
                    if(in_array($val['name'],["merchant_name",''])){
                        $type = 'LIKE';
                        $val['value'] = '%'.$val['value'].'%';
                    }
                    //签约时间
                    if(in_array($val['name'],["contract_time_start",'contract_time_end'])){
                        if($val['name'] == 'contract_time_start'){
                            $type = '>=';
                            $val['name'] = 'contract_time';
                        }
                        if($val['name'] == 'contract_time_end'){
                            $type = '<=';
                            $val['name'] = 'contract_time';
                        }
                    }
                    //合同有效日期
                    if(in_array($val['name'],["contract_start_time",'contract_end_time'])){
                        if($val['name'] == 'contract_start_time'){
                            $type = '<=';
                        }
                        if($val['name'] == 'contract_end_time'){
                            $type = '>=';
                        }
                    }
                    //药证截止日期
                    if(in_array($val['name'],["drug_license_expriy_date_start",'drug_license_expriy_date_end'])){
                        if($val['name'] == 'drug_license_expriy_date_start'){
                            $type = '>=';
                            $val['name'] = 'drug_license_expriy_date';
                        }
                        if($val['name'] == 'drug_license_expriy_date_end'){
                            $type = '<=';
                            $val['name'] = 'drug_license_expriy_date';
                        }
                    }
                    $filters[] = [$val['name'],$type, $val['value']];
                }
            }
        }
        $pageSize = $request->get('pageSize', 10);
        $pageCurrent = $request->get('pageCurrent');
        $list =  $this->merchants->getListByWhere($filters, ['*'], [], $pageSize, $pageCurrent);
        foreach($list as $key=>$v){
            $list[$key]['address_province'] = $this->areas->getOneArea($v['address_province'], ['id', 'name'],1)->name;
            $list[$key]['address_city'] = $this->areas->getOneArea($v['address_city'], ['id', 'name'],1)->name;
            $list[$key]['address_district'] = $this->areas->getOneArea($v['address_district'], ['id', 'name'],1)->name;
        }
//        dd(\DB::getQueryLog());exit;
//        print_R($list);exit;
        return $this->pageSuccess($list);
    }
    
    public function getOne(Request $request){
        $id = $request->get('id');
        $result = $this->merchants->getOneMerchant($id);

        $init = array('value'=>'','label'=>'所有');
        $citys = $this->areas->getAreas($result['address_province'], ['id', 'name'],1);
        array_unshift($citys, $init);
        $district = $this->areas->getAreas($result['address_city'], ['id', 'name'],1);
        array_unshift($district, $init);
        return [
            'statusCode' => 200,
            'data' => $result,
            'area' => array('citys'=> $citys, 'district'=> $district),
            'message' => 'success',
        ]; 
    }

    public function getMerchants(Request $request){
        $id = $request->get('id');
        if(empty($id) || !is_array($id)){
            return [
                'statusCode' => 200,
                'error' => true,
                'message' => '参数错误',
            ];
        }
        $name = '';
        foreach($id as $val){
            $name .= $this->merchants->getOneMerchant($val, [ 'merchant_name'])->merchant_name . ',';
        }
        $name = substr($name, 0, -1);
        return [
            'statusCode' => 200,
            'data' => $name,
            'message' => 'success',
        ];
    }

    //审核商家
    public function checkMerchants(Request $request){
        $id = $request->get('id');
        if(empty($id) || !is_array($id)){
            return [
                'statusCode' => 200,
                'error' => true,
                'message' => '参数错误',
            ];
        }
        $id[] = 'aaa';
        $data = array();
        $data['check_remark'] = $request->get('check_remark');
        $data['status'] = $request->get('status');
        foreach($id as $v){
            $result = $this->merchants->getOneMerchant($id, ['merchant_name','status']);
            if($result['status'] != 2){
                return [
                    'statusCode' => 200,
                    'error' => true,
                    'message' => '商家['.$result['merchant_name'].']的状态无法进行提交审核',
                ];
            }
        }
        $res = $this->merchants->updateByOtherColumn('id', $id, $data);
        //dd(\DB::getQueryLog());exit;
        if($res){
            return [
                'statusCode' => 200,
                'message' => '审核成功',
            ];
        }else{
            return [
                'statusCode' => 200,
                'error' => true,
                'message' => '审核失败',
            ];
        }
    }

    //申请审核
    public function applyCheck(Request $request){
        $id = $request->get('id');
        $result = $this->merchants->getOneMerchant($id);
        if($result['status'] != 1 && $result['status'] != 3){
            return [
                'statusCode' => 200,
                'error' => true,
                'message' => '商家当前状态无法进行提交审核',
            ];
        }
        $data['status'] = 2;
        $result = $this->merchants->update($id, $data);
        return $this->success($result, 200, '申请审核成功');
    }

    //签约
    public function signing(Request $request)
    {
        $data = $request->all();
        if(isset($data['id']) && !empty($data['id']))
        {
            $result = $this->merchants->getOneMerchant($data['id']);
            if($result['status'] == 7){
                return [
                    'statusCode' => 200,
                    'error' => true,
                    'message' => '商家已签约，无法重复签约',
                ];
            }
            if($result['status'] != 4){
                return [
                    'statusCode' => 200,
                    'error' => true,
                    'message' => '商家当前状态无法进行签约',
                ];
            }
            $admin = Session::get('admin');
            $update_data = [
                'contract_num' => $data['contract_num'],
                'contract_operator_id' => $admin['id'],
                'contract_operator' => $admin['username'],
                'status' => 7,
                'contract_time' =>  date('Y-m-d H:i:s'),
                'contract_start_time' => $data['contract_start_time'],
                'contract_end_time' => $data['contract_end_time']
            ];

            $res = $this->merchants->updateByOtherColumn('id',$data['id'],$update_data);
            if($res)
            {
                return [
                    'statusCode' => 200,
                    'data' => $res,
                    'message' => '成功签订合约',
                ];
            }else{
                return [
                    'statusCode' => 500,
                    'error' => true,
                    'message' => '签订合约失败',
                ];
            }
        }
    }

    //取消签约
    public function cancel(Request $request)
    {
        $data = $request->get('info');
        $info = json_decode($data,true);
        if(!empty($info))
        {
            $ids = array_column($info,'id');
            foreach($ids as $v){
                $result = $this->merchants->getOneMerchant($v, ['merchant_name','status']);
                if($result['status'] == 8){
                    return [
                        'statusCode' => 200,
                        'error' => true,
                        'message' => '商家['.$result['merchant_name'].']无法重复取消签约',
                    ];
                }
                if($result['status'] != 7){
                    return [
                        'statusCode' => 200,
                        'error' => true,
                        'message' => '商家['.$result['merchant_name'].']的状态无法取消签约',
                    ];
                }
            }
            $admin = Session::get('admin');
            $update_data = [
                'contract_cancel_operator_id' => $admin['id'],
                'contract_cancel_operator' => $admin['username'],
                'contract_cancel_time' => date('Y-m-d H:i:s'),
                'status' => 8
            ];
            $res = $this->merchants->updateByOtherColumn('id',$ids,$update_data);

            if($res)
            {
                return [
                    'statusCode' => 200,
                    'data' => $res,
                    'message' => '成功取消签约',
                ];
            }else{
                return [
                    'statusCode' => 500,
                    'error' => true,
                    'message' => '取消签约失败',
                ];
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MerchantRequest $request)
    {
        $data = $this->makeData($request);
        if(!empty($data['id'])){
            $id = $data['id'];
            unset($data['id']);
            $result = $this->merchants->update($id, $data);
            return $this->success($result, 200, '修改成功');
        }else{
            $result = $this->merchants->create($data);
            return $this->success($result, 200, '添加成功');
        }
    }

    private function makeData(Request $request)
    {
        $data = [
            'id' => $request->get('id'),
            'merchant_type' => $request->get('merchant_type'),
            'manage_type' => $request->get('manage_type'),
            'organization_type' => $request->get('organization_type'),
            'merchant_phone' => $request->get('merchant_phone'),
            'merchant_contacts' => $request->get('merchant_contacts'),
            'merchant_logo' => $this->formatImgUrl($request, 'merchant_logo'),
            'merchant_short_name' => $request->get('merchant_short_name'),
            'merchant_name' => $request->get('merchant_name'),
            'franchising_type' => $request->get('franchising_type'),
            'legal_person_id_num' => $request->get('legal_person_id_num'),
            'legal_person_name' => $request->get('legal_person_name'),
            'drug_license_img' => $this->formatImgUrl($request, 'drug_license_img'),
            'drug_license_expriy_date' => $request->get('drug_license_expriy_date'),
            'drug_license_num' => $request->get('drug_license_num'),
            'business_license_img' => $this->formatImgUrl($request, 'business_license_img'),
            'business_license_expiry_date' => $request->get('business_license_expiry_date'),
            'business_license_num' => $request->get('business_license_num'),
            'is_third_party' => $request->get('is_third_party', 2),
            'is_virtual' => $request->get('is_virtual', 2),
            'address_detail' => $request->get('address_detail', ''),
            'address_district' => $request->get('address_district'),
            'address_city' => $request->get('address_city'),
            'address_province' => $request->get('address_province'),
            'GSP_num' => $request->get('GSP_num'),
            'GSP_expriy_date' => $request->get('GSP_expriy_date'),
            'GSP_img' => $this->formatImgUrl($request, 'GSP_img'),
            'food_licence_num' => $request->get('food_licence_num'),
            'food_licence_expriy_date' => $request->get('food_licence_expriy_date'),
            'food_licence_img' => $this->formatImgUrl($request, 'food_licence_img'),
            'medical_institution_num' => $request->get('medical_institution_num'),
            'medical_institution_expriy_date' => $request->get('medical_institution_expriy_date'),
            'medical_institution_img' => $this->formatImgUrl($request, 'medical_institution_img'),
            'medical_app_num' => $request->get('medical_app_num'),
            'medical_app_expriy_date' => $request->get('medical_app_expriy_date'),
            'medical_app_img' => $this->formatImgUrl($request, 'medical_app_img'),
            'internet_med_tran_num' => $request->get('internet_med_tran_num'),
            'internet_med_tran_expriy_date' => $request->get('internet_med_tran_expriy_date'),
            'internet_med_tran_img' => $this->formatImgUrl($request, 'internet_med_tran_img'),
            'internet_med_info_num' => $request->get('internet_med_info_num'),
            'internet_med_info_expriy_date' => $request->get('internet_med_info_expriy_date'),
            'internet_med_info_img' => $this->formatImgUrl($request, 'internet_med_info_img'),
            'company_person_name' => $request->get('company_person_name'),
            'company_person_mobile' => $request->get('company_person_mobile'),
            'post_code' => $request->get('post_code'),
            'fax' => $request->get('fax'),
            'GPS_status' => $request->get('GPS_status'),
            'quality_person' => $request->get('quality_person'),
            'institution_num' => $request->get('institution_num'),
            'tax_register_num' => $request->get('tax_register_num'),
            'merchant_code' => $this->makeMerchantCode(),
            'legal_person_img' => $this->formatImgUrl($request, 'legal_person_img')
        ];

        return $data;
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
