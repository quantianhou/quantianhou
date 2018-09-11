<?php

namespace App\Models\A\Store;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use App\Models\Merchant\Merchant;

class GoodsModel extends Model
{
    protected $table = 'ewei_shop_goods';

    protected $guarded = [];

}