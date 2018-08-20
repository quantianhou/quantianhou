<?php

namespace App\Models\Config;

use App\Models\BaseModel;

class ConfigModel extends BaseModel
{
    protected $table = 'a_config';

    public function getMerchantCode()
    {
        $where[] = ['name','=','merchant_code'];
        $result = ConfigModel::where($where)->first();
        $merchant_code = $result['value'];
        ConfigModel::where($where)->update(array(
            "value"=> $merchant_code+1
        ));//自增
        return $merchant_code;
    }

}
