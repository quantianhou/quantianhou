<?php

namespace Modules\Admin\Http\Controllers\ShopStore;

use App\Repositories\ShopStore\ShopStoreRepository;
use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\BaseController;
use Modules\admin\Http\Requests\ShopStore\ShopStoreRequest;
use App\Repositories\Area\AreaRepository;
use Illuminate\Support\Facades\Session;
use Modules\admin\Http\Requests\ShopStore\ShopStoreSigningRequest;

class ShopStoreController extends BaseController
{
    private $shopStores;

    public function __construct(ShopStoreRepository $shopStores,AreaRepository $areas)
    {
        $this->shopStores =$shopStores;
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

        $search_data = $request->get('post_data');
        if(!empty($search_data))
        {
            foreach($search_data as $key => $val)
            {
                if(!empty($val['value']))
                {
                    $ftype = $fname = $fvalue = '';
                    $ftype = '=';
                    $fname = $val['name'];
                    $fvalue = $val['value'];
                    switch ($val['name'])
                    {
                        case 'search_drug_license_start_time':
                            $fname = 'drug_license_expriy_date';
                            $ftype = '>=';
                            break;
                        case 'search_drug_license_end_time':
                            $fname = 'drug_license_expriy_date';
                            $ftype = '<=';
                            break;
                        case 'search_contract_start_time':
                            $fname = 'contract_start_time';
                            $ftype = '>=';
                            break;
                        case 'search_contract_end_time':
                            $fname = 'contract_end_time';
                            $ftype = '<=';
                            break;
                    }

                    $filters[] = [$fname,$ftype, $fvalue];
                }
            }
        }

        $pageSize = $request->get('pageSize', 10);
        $pageCurrent = $request->get('pageCurrent');
        $list =  $this->shopStores->getListByWhere($filters, ['*'], [], $pageSize,$pageCurrent);
//        print_r($list);exit;
        return $this->pageSuccess($list);
    }

    public function info(Request $request)
    {
        $id = $request->get('id');
        $result = $this->shopStores->getOne($id);

        $init = array('value'=>'','label'=>'所有');
        $citys = $this->areas->getAreas($result['provincecode'], ['id', 'name'],1);
        array_unshift($citys, $init);
        $district = $this->areas->getAreas($result['citycode'], ['id', 'name'],1);
        array_unshift($district, $init);
        return [
            'statusCode' => 200,
            'data' => $result,
            'area' => array('citys'=> $citys, 'district'=> $district),
            'message' => 'success',
        ];
    }

    public function cancel(Request $request)
    {
        $data = $request->get('info');
        $info = json_decode($data,true);
        if(!empty($info))
        {
            $ids = array_column($info,'id');
            $admin = Session::get('admin');
            $update_data = [
                'contract_cancel_operator_id' => $admin['id'],
                'contract_cancel_operator' => $admin['username'],
                'contract_cancel_time' => date('Y-m-d H:i:s'),
                'store_status' => 3
            ];
            $res = $this->shopStores->updateByOtherColumn('id',$ids,$update_data);

            if($res)
            {
                return [
                    'statusCode' => 200,
                    'data' => $res,
                    'message' => '成功取消合约',
                ];
            }else{
                return [
                    'statusCode' => 500,
                    'error' => true,
                    'message' => '取消合约失败',
                ];
            }
        }
    }

    public function signing(ShopStoreSigningRequest $request)
    {
        $data = $request->all();
        if(isset($data['id']) && !empty($data['id']))
        {
            $admin = Session::get('admin');
            $update_data = [
                'contract_num' => $data['contract_num'],
                'contract_operator_id' => $admin['id'],
                'contract_operator' => $admin['username'],
                'store_status' => 1,
                'contract_time' =>  date('Y-m-d H:i:s'),
                'contract_start_time' => $data['contract_start_time'],
                'contract_end_time' => $data['contract_end_time']
            ];

            $res = $this->shopStores->updateByOtherColumn('id',$data['id'],$update_data);

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

    public function singingInfo(Request $request)
    {
        $id = $request->get('id');
        $result = $this->shopStores->getOne($id);

        return [
            'statusCode' => 200,
            'data' => $result,
            'message' => 'success',
        ];
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
     * @param  ShopStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopStoreRequest $request)
    {
        $data = $this->makeData($request);
        if(!empty($data['id'])){
            $id = $data['id'];
            unset($data['id']);
            $result = $this->shopStores->update($id, $data);
            return $this->success($result, 200, '修改成功');
        }else{
            $result = $this->shopStores->create($data);
            return $this->success($result, 200, '添加成功');
        }
    }

    private function makeData(Request $request)
    {
        $data = [
            'id' => $request->get('id'),
            'manage_type' => $request->get('manage_type'),
            'organization_type' => $request->get('organization_type'),
            'legal_person_id_num' => $request->get('legal_person_id_num'),
            'legal_person_name' => $request->get('legal_person_name'),
            'drug_license_img' => $this->formatImgUrl($request, 'drug_license_img'),
            'drug_license_expriy_date' => $request->get('drug_license_expriy_date'),
            'drug_license_num' => $request->get('drug_license_num'),
            'business_license_img' => $this->formatImgUrl($request, 'business_license_img'),
            'business_license_expiry_date' => $request->get('business_license_expiry_date'),
            'business_license_num' => $request->get('business_license_num'),
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
            'company_person_name' => $request->get('company_person_name'),
            'company_person_mobile' => $request->get('company_person_mobile'),
            'post_code' => $request->get('post_code'),
            'fax' => $request->get('fax'),
            'quality_person' => $request->get('quality_person'),
            'institution_num' => $request->get('institution_num'),
            'tax_register_num' => $request->get('tax_register_num'),
            'legal_person_img' => $this->formatImgUrl($request, 'legal_person_img'),
            'a_merchant_id' => $request->get('a_merchant_id', 0),
            'tag' => $request->get('tag', 1),
            'organization_code' => $request->get('organization_code', ''),
            'storename' => $request->get('storename', ''),
            'store_short_name' => $request->get('store_short_name', ''),
            'provincecode' => $request->get('provincecode', ''),
            'citycode' => $request->get('citycode', ''),
            'areacode' => $request->get('areacode', ''),
            'store_contacts' => $request->get('store_contacts', ''),
            'store_phone' => $request->get('store_phone', ''),
            'store_sms_sign' => $request->get('store_sms_sign', ''),
            'organization_introduce' => $request->get('organization_introduce', ''),
            'organization_logo' => $this->formatImgUrl($request, 'organization_logo'),
            'organization_front_img' => $this->formatImgUrl($request, 'organization_front_img'),
            'shop_code' => $this->makeCode(),
            'lat' => $request->get('lat', 0),
            'lng' => $request->get('lng', 0),

        ];

        return $data;
    }

    private function makeCode()
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
