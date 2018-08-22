<?php
namespace App\Models\Goods;

use App\Models\BaseModel;
use App\Models\Category\ComponentModel;

class GoodsModel extends BaseModel {

    protected  $table = 'a_goods';

    protected $fillable = ['sn', 'name','images', 'single_name', 'show_name', 'nation_sn', 'approval_number', 'brand', 'company', 'place', 'alias', 'specifications', 'dosage_form', 'unit', 'validity_period', 'has_mhj', 'basic_medicine', 'easy_break', 'easy_smell', 'curing', 'save_method', 'component', 'category_goods', 'category_component', 'control_code', 'service_information', 'search_words', 'reference_price', 'selling_price', 'high_price', 'treatment', 'use_time1', 'use_time2'];

    protected $appends = [
        'brand_name',
        'brand_text',
        'category_component_sn',
        'category_goods_sn',
        'category_goods_name'
    ];

    public function extra(){
        return $this->hasOne(ExtraModel::class,'goods_id');
    }

    public function getBrandNameAttribute()
    {
        $res = DataModel::where([
            'select_name' => 'brand',
            'extra' => $this->brand
        ])->first();
        return empty($res) ? '': $res->select_option;
    }

    public function getBrandTextAttribute()
    {
        $res = DataModel::where([
            'select_name' => 'brand',
            'extra' => $this->brand
        ])->first();
        return empty($res) ? '': $res->select_option;
    }
    
    public function getCategoryComponentSnAttribute()
    {
        return $this->category_component;
    }

    public function getCategoryGoodsSnAttribute(){

        return $this->category_goods;
    }

    public function getCategoryGoodsNameAttribute(){
        $res = \App\Models\Category\GoodsModel::where([
            'category_sn' => $this->category_goods
        ])->first();
        return $res->category_name;
    }
}