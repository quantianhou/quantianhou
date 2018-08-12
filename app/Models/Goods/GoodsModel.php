<?php
namespace App\Models\Goods;

use App\Models\BaseModel;

class GoodsModel extends BaseModel {

    protected  $table = 'a_goods';

    protected $fillable = ['sn', 'name', 'single_name', 'show_name', 'nation_sn', 'approval_number', 'brand', 'company', 'place', 'alias', 'specifications', 'dosage_form', 'unit', 'validity_period', 'has_mhj', 'basic_medicine', 'easy_break', 'easy_smell', 'curing', 'save_method', 'component', 'category_goods', 'category_component', 'control_code', 'service_information', 'search_words', 'reference_price', 'selling_price', 'high_price', 'treatment', 'use_time1', 'use_time2'];

    public function extra(){
        return $this->hasOne(ExtraModel::class,'goods_id');
    }
}