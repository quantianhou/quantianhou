<?php

namespace Modules\Admin\Http\Controllers\ShopStore;

use App\Repositories\ShopStore\ShopStoreRepository;
use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\BaseController;
use Modules\admin\Http\Requests\ShopStore\ShopStoreRequest;

class ShopStoreController extends BaseController
{
    private $shopStores;

    public function __construct(ShopStoreRepository $shopStores)
    {
        $this->shopStores =$shopStores;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = [];
        $pageSize = $request->get('pageSize', 20);
        if ($request->get('merchant_type')) {
            dd($request->all());
        }
        $list =  $this->shopStores->getListByWhere($filters, ['*'], [], $pageSize);
        return $this->pageSuccess($list);
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
        $result = $this->shopStores->create($data);
        return $this->success($result, 200, '添加成功');
    }

    private function makeData(Request $request)
    {
        $data = [
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
//            'provincecode' => $request->get('provincecode', ''),
            'provincecode' => 1,
//            'citycode' => $request->get('citycode', ''),
            'citycode' => 1,
//            'areacode' => $request->get('areacode', ''),
            'areacode' => 1,
            'store_contacts' => $request->get('store_contacts', ''),
            'store_phone' => $request->get('store_phone', ''),
            'store_sms_sign' => $request->get('store_sms_sign', ''),
            'organization_introduce' => $request->get('organization_introduce', ''),
            'organization_logo' => $this->formatImgUrl($request, 'organization_logo'),
            'organization_front_img' => $this->formatImgUrl($request, 'organization_front_img'),
            'shop_code' => $this->makeCode()

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
