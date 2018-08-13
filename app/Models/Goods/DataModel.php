<?php
namespace App\Models\Goods;

use App\Models\BaseModel;

class DataModel extends BaseModel {

    protected  $table = 'a_goods_data';


    public function getId($type = null,$value = '',$extra = ''){

        $dataInfo = DataModel::where([
            'select_name' => $type,
            'select_option' => $value
        ])->first();

        if(empty($dataInfo)){
            $dataInfo = new DataModel();
            $dataInfo->select_name = $type;
            $dataInfo->select_option = $value;
            $dataInfo->extra = $extra;
            $dataInfo->save();
        }

        return $dataInfo->id;

    }
}