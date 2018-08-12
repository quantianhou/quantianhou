<?php
namespace Modules\Admin\Http\Controllers\Goods;

use App\Models\Category\ComponentModel;
use App\Models\Goods\DataModel;
use App\Models\Goods\GoodsModel;
use Modules\Admin\Http\Controllers\AdminController;
use Excel;

class ExcelController extends AdminController
{
    public function __construct(
        GoodsModel $goodsModel,
        DataModel $dataModel,
        \App\Models\Category\GoodsModel $goodsCategoryModel,
        ComponentModel $componentModel
    )
    {
        parent::__construct();
        $this->goodsModel = $goodsModel;
        $this->dataModel = $dataModel;
        $this->goodsCategoryModel = $goodsCategoryModel;
        $this->componentModel = $componentModel;
    }

    //Excel文件导出
    public function export(){

        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];

        Excel::create('学生成绩',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }

    public function import(){

        $filePath = '../storage/app/public/base.xls';
        Excel::load($filePath, function($reader) {
            $data = $reader->all();

            foreach ($data as $v){
                self::saveGoods($v);
            }
        });


    }

    private function saveGoods($data){

        $goods = $this->goodsModel->where([
            ['sn','=',$data["商品编码"]]
        ])->first();

        if(empty($goods)){
            //添加
            $goods = $this->goodsModel;
        }

        $goods->sn = $data["商品编码"];
        $goods->name = $data["商品名称"];
        $goods->single_name = $data["通用名称"];
        $goods->show_name = $data["显示名称"];
        $goods->nation_sn = $data["国际条码"];
        $goods->approval_number = $data["批准文号"];
        $goods->brand = $this->dataModel->getId('brand',$data["品牌名称"],$data['品牌编码']);
        $goods->company = $data["生产企业"];
        $goods->place = $data["产地"];
        $goods->alias = $data["别名"];
        $goods->specifications = $data["规格"];
        $goods->dosage_form = $data["剂型"];// *********************
        $goods->unit = $this->dataModel->getId('unit',$data["单位"]);
        $goods->validity_period = $data["有效期月"];
        $goods->has_mhj = $data["是否含有麻黄碱"];
        $goods->basic_medicine = $data["基药"];
        $goods->easy_break = $data["易碎易渗漏"];
        $goods->easy_smell = $data["易串味"];
        $goods->curing = $data["重点养护"];
        $goods->save_method = $data["存储方式"];
        $goods->component = $this->dataModel->getId('component',$data["成份名称"],$data['成份编码']);
        $goods->category_goods = $this->goodsCategoryModel->getId($data["类别编码"],$data["类别名称"]);
        $goods->category_goods_sn = $data["类别编码"];
        $goods->category_goods_name = $data["类别名称"];
        $goods->category_component = $this->componentModel->getId($data["成份分类"],$data["成份分类名称"]);
        $goods->category_component_sn = $data["成份分类"];
        $goods->category_component_name = $data["成份分类名称"];
        $goods->control_code = $this->dataModel->getId('control_code',$data['商品显示控制名称'],$data["商品显示控制码"]);
        $goods->service_information = $data["是否触发服务信息"];
        $goods->search_words = $data["搜索用词"];
        $goods->reference_price = $data["全维价"];
        $goods->selling_price = $data["全维价"];
        $goods->high_price = $data["全维价"];
        $goods->treatment = $data["疗程"];
        $goods->use_time1 = $data["单盒服用最短天数"];
        $goods->use_time2 = $data["单盒服用最长天数"];

        $goods->save();


        return $this->json([
            'data' => 456
        ]);
    }

    private function saveExtra($data){

    }
}