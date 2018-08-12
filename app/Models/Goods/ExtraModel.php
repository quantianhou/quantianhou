<?php
namespace App\Models\Goods;

use App\Models\BaseModel;

class ExtraModel extends BaseModel {

    protected  $table = 'a_goods_extra';

    protected $fillable = ['goods_id', 'text_component', 'main_function', 'usage', 'untoward_effect', 'taboo', 'attention', 'drug_women', 'drug_children', 'drug_older', 'drug_interaction', 'goods_desc', 'taboo_medicine_effect', 'taboo_medicine_res', 'taboo_food_effect', 'taboo_food_res', 'taboo_food_list', 'taboo_kind_effect', 'taboo_kind_res'];

}