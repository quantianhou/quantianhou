<?php
namespace App\Models\B\Goods;

use App\Models\BaseModel;

class CategoryModel extends BaseModel {

    protected  $table = 'ewei_shop_category';

    public $timestamps = false;

    protected $fillable = ['uniacid','name','level'];

}