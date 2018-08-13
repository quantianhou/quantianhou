<?php

namespace App\Models\ShopStore;

use App\Models\Area\Area;
use App\Models\Merchant\Merchant;
use App\Repositories\Area\AreaRepository;
use Illuminate\Database\Eloquent\Model;

class ShopStore extends Model
{
    protected $table = 'ewei_shop_store';

    protected $guarded = [];
    protected $appends = [
        'province_name',
        'city_name',
        'area_name',
        'organization_type_name',
        'manage_type_name',
        'store_status_name',
        'a_merchant_id_name'
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

    public function getOrganizationTypeNameAttribute()
    {
        $result = [0 => '未知' ,1 => '连锁', 2 => '非连锁'];
        $organization = 0 ;
        if(!empty($this->organization_type))
        {
            $organization = $this->organization_type;
        }
        return array_get($result, $organization);
    }

    public function getManageTypeNameAttribute()
    {
        $result = [0 => '未知' , 1 => '连锁', 2 => '非连锁'];
        $manage_type = 0 ;
        if(!empty($this->manage_type))
        {
            $manage_type = $this->manage_type;
        }
        return array_get($result, $manage_type);
    }

    public function getStoreStatusNameAttribute()
    {
//        门店状态：2新增、1签约、3取消、4冻结
        $result = [
            1 =>'签约',
            2 => '新增',
            3 => '取消',
            4 => '冻结',
        ];
        return array_get($result, $this->store_status);
    }

    public function getAMerchantIdNameAttribute()
    {
        $merchant_id = $this->a_merchant_id;
        $merchant_name = '未知';
        if($merchant_id > 0)
        {
            $merchantModel = new Merchant();
            $info = $merchantModel->find($merchant_id);
            if(!empty($info))
            {
                return $info->merchant_name;
            }
        }
        return $merchant_name;
    }

}
