<?php
namespace App\Models\B\Goods;

use App\Models\BaseModel;

class GoodsModel extends BaseModel {

    protected  $table = 'ewei_business_goods';

    public $timestamps = false;

    protected $fillable = ['uniacid','title','goodssn','productsn','productprice','marketprice','total'];

}