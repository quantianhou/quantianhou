<?php

namespace Modules\admin\Http\Requests\ShopStore;

use Illuminate\Foundation\Http\FormRequest;

class ShopStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'manage_type' => 'required',
            'organization_type' => 'required',
            'legal_person_id_num' => 'required',
            'legal_person_name' => 'required',
            'drug_license_img' => 'required',
            'drug_license_expriy_date' => 'required',
            'drug_license_num' => 'required',
            'business_license_img' => 'required',
            'business_license_expiry_date' => 'required',
            'business_license_num' => 'required',
            'GSP_num' => 'required',
            'GSP_expriy_date' => 'required',
            'GSP_img' => 'required',
            'food_licence_num' => 'required',
            'food_licence_expriy_date' => 'required',
            'food_licence_img' => 'required',
            'medical_institution_num' => 'required',
            'medical_institution_expriy_date' => 'required',
            'medical_institution_img' => 'required',
            'medical_app_num' => 'required',
            'medical_app_expriy_date' => 'required',
            'medical_app_img' => 'required',
            'internet_med_tran_num' => 'required',
            'internet_med_tran_expriy_date' => 'required',
            'internet_med_tran_img' => 'required',
            'company_person_name' => 'required',
            'company_person_mobile' => 'required',
            'post_code' => 'required',
            'fax' => 'required',
            'quality_person' => 'required',
            'institution_num' => 'required',
            'tax_register_num' => 'required',
        ];
    }
}
