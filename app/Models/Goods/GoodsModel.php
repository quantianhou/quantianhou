<?php
namespace App\Models\Goods;

use App\Models\BaseModel;
use App\Models\Category\ComponentModel;

class GoodsModel extends BaseModel {

    protected  $table = 'a_goods';

    protected $fillable = ['sn', 'name', 'single_name', 'show_name', 'nation_sn', 'approval_number', 'brand', 'company', 'place', 'alias', 'specifications', 'dosage_form', 'unit', 'validity_period', 'has_mhj', 'basic_medicine', 'easy_break', 'easy_smell', 'curing', 'save_method', 'component', 'category_goods', 'category_component', 'control_code', 'service_information', 'search_words', 'reference_price', 'selling_price', 'high_price', 'treatment', 'use_time1', 'use_time2'];

    protected $appends = [
        'brand_name',
        'category_component_sn',
        'category_goods_sn',
        'category_goods_name'
    ];

    public function extra(){
        return $this->hasOne(ExtraModel::class,'goods_id');
    }

    public function getBrandNameAttribute()
    {
        return DataModel::find($this->brand)->select_option;
    }

    public function getCategoryComponentSnAttribute()
    {
        return ComponentModel::find($this->category_component)->category_sn;
    }

    public function getCategoryGoodsSnAttribute(){
        return \App\Models\Category\GoodsModel::find($this->category_goods)->category_sn;
    }

    public function getCategoryGoodsNameAttribute(){
        return \App\Models\Category\GoodsModel::find($this->category_goods)->category_name;
    }
}