<?php
namespace App\Models\Goods;

use App\Models\BaseModel;

class DataModel extends BaseModel {

    protected  $table = 'a_goods_data';

    protected $fillable = ['select_name','select_option','extra','parent_extra'];

    public function getId($type = null,$value = '',$extra = ''){

        $dataInfo = DataModel::where([
            'select_name' => $type,
            'select_option' => $value
        ])->first();

        if(empty($dataInfo)){
            return 0;
//            $dataInfo = new DataModel();
//            $dataInfo->select_name = $type;
//            $dataInfo->select_option = $value;
//            $dataInfo->extra = $extra;
//            $dataInfo->save();
        }

        return $dataInfo->id;

    }
}