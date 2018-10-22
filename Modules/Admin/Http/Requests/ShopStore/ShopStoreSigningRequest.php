<?php

namespace Modules\admin\Http\Requests\ShopStore;

use Illuminate\Foundation\Http\FormRequest;

class ShopStoreSigningRequest extends FormRequest
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
            'contract_num' => 'required',
            'contract_start_time' => 'required',
            'contract_end_time' => 'required',
        ];
    }



}
