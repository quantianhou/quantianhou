<?php

namespace App\Models\ShopStore;

use App\Models\Area\Area;
use App\Repositories\Area\AreaRepository;
use Illuminate\Database\Eloquent\Model;

class ShopStore extends Model
{
    protected $table = 'ewei_shop_store';

    protected $guarded = [];
    protected $appends = [
        'province_name',
        'city_name',
        'area_name'
    ];

    public function getProvinceNameAttribute()
    {
        return $this->getName($this->provincecode);
    }

    public function getCityNameAttribute()
    {
        return $this->getName($this->citycode);
    }

    public function getAreaNameAttribute()
    {
        return $this->getName($this->areacode);
    }

    public function getName($id)
    {
        $areaList = app(AreaRepository::class)->getName();
        foreach ($areaList as $item) {
            if ($item['id'] == $id) {
                return $item['name'];
            }
        }
        return '';
    }

}
