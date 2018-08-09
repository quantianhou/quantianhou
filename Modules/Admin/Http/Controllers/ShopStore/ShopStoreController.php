<?php

namespace Modules\Admin\Http\Controllers\ShopStore;

use App\Repositories\Merchant\MerchantRepository;
use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\BaseController;
use Modules\admin\Http\Requests\Merchant\MerchantRequest;

class ShopStoreController extends BaseController
{
    private $merchants;

    public function __construct(MerchantRepository $merchants)
    {
        $this->merchants = $merchants;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = [];
        if ($request->get('merchant_type')) {
            dd($request->all());
        }
        $list =  $this->merchants->getListByWhere($filters);
        return $list;
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
        $result = $this->merchants->create($data);
        return $this->success($result, 200, '添加成功');
    }

    private function makeData(Request $request)
    {
        $data = [
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
