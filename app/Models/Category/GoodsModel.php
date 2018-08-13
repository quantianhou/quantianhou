<?php
namespace App\Models\Category;

use App\Models\BaseModel;

class GoodsModel extends BaseModel {

    protected  $table = 'a_category_goods';

    protected $fillable = ['category_name','parent_id','category_sn'];

    public function getId($code = '' , $names = ''){

        $cInfo = GoodsModel::where([
            'category_sn' => $code
        ])->first();

        if(!empty($cInfo)){
            return $cInfo->id;
        }else{
            $list = explode('-',$names);

            foreach ($list as $k=>$v){
                $cInfo = GoodsModel::firstOrCreate([
                    'category_name' => $v,
                    'parent_id' => $cInfo->id ?? 0,
                    'category_sn' => count($list) == ($k+1)?$code:''
                ]);
            }

            return $cInfo->id;

        }

    }
}