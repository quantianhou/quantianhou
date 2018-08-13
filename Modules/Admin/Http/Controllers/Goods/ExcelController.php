<?php
namespace Modules\Admin\Http\Controllers\Goods;

use App\Models\Category\ComponentModel;
use App\Models\Goods\DataModel;
use App\Models\Goods\ExtraModel;
use App\Models\Goods\GoodsModel;
use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\AdminController;
use Excel;

class ExcelController extends AdminController
{
    public function __construct(
        GoodsModel $goodsModel,
        DataModel $dataModel,
        \App\Models\Category\GoodsModel $goodsCategoryModel,
        ComponentModel $componentModel,
        ExtraModel $extraModel
    )
    {
        parent::__construct();
        $this->goodsModel = $goodsModel;
        $this->dataModel = $dataModel;
        $this->goodsCategoryModel = $goodsCategoryModel;
        $this->componentModel = $componentModel;
        $this->extraModel = $extraModel;
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

    public function import(Request $request){

        Excel::load($_FILES['file']['tmp_name'], function($reader) {
            $data = $reader->all();

            foreach ($data as $v){
                self::saveGoods($v);
            }
        });

        return $this->json([
            'data' => 200,
            'info' => 'success',
            'code' => 200
        ]);
    }

    public function extra(){

        Excel::load($_FILES['file']['tmp_name'], function($reader) {
            $data = $reader->all();

            foreach ($data as $v){
                self::saveExtra($v);
            }
        });

        return $this->json([
            'data' => 200,
            'info' => 'success',
            'code' => 200
        ]);
    }

    /**
     * @param $data
     * @return bool
     * 导入分类
     */
    public function category(){

        Excel::load($_FILES['file']['tmp_name'], function($reader) {
            $data = $reader->all();

            foreach ($data as $v){
                self::saveCategory($v);
            }
        });

        return $this->json([
            'data' => 200,
            'info' => 'success',
            'code' => 200
        ]);
    }

    private function saveCategory($data){

        if($data['type'] > 0){
            //商品
            $this->goodsCategoryModel->getId($data["id"],$data["name"]);
        }else{
            //成分
            $this->componentModel->getId($data["id"],$data["name"]);
        }
    }

    private function saveGoods($data){

        $sn = $data["商品编码"];
        $goods = $this->goodsModel->where([
            ['sn','=',$sn]
        ])->first();

        if(empty($goods)){
            //添加
            $goods = new GoodsModel();
        }

        $imgs = self::getimg($sn);

        $goods->sn = $data["商品编码"];
        $goods->images = $imgs;
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

        return $goods->save();
    }

    private function getimg($sn){

        $s = [];
        $t = [];

        //图片下载
        $dir = iconv("UTF-8", "GBK", "upload/".$sn[0].$sn[1].'/'.$sn[2].$sn[3].'/'.$sn[4].$sn[5]);
        if (!is_dir($dir)){
            mkdir ($dir,0777,true);
        }

        //中图
        $url = 'http://img.qwysfw.cn/product/middle/'.$sn[0].$sn[1].'/'.$sn[2].$sn[3].'/'.$sn[4].$sn[5].'/1.JPG';
        $file = false;
        if(@fopen($url, 'r')){
            file_put_contents($dir.'/11.JPG',file_get_contents($url));
            $s['middle'] = $dir.'/11.JPG';
            $t[] = $dir.'/11.JPG';
        }

        //小图
        $url = 'http://img.qwysfw.cn/product/small/'.$sn[0].$sn[1].'/'.$sn[2].$sn[3].'/'.$sn[4].$sn[5].'/1.JPG';
        $file = false;
        if(@fopen($url, 'r')){
            file_put_contents($dir.'/12.JPG',file_get_contents($url));
            $s['small'] = $dir.'/12.JPG';
            $t[] = $dir.'/12.JPG';
        }

        //大图
        for ($i=1;$i<8;$i++){
            $url = 'http://img.qwysfw.cn/product/big/'.$sn[0].$sn[1].'/'.$sn[2].$sn[3].'/'.$sn[4].$sn[5].'/'.$i.'.JPG';
            $file = false;
            if(@fopen($url, 'r')){
                file_put_contents($dir.'/'.$i.'.JPG',file_get_contents($url));
                $s['big'][] = $dir.'/'.$i.'.JPG';
                $t[] = $dir.'/'.$i.'.JPG';
            }
        }

        if(!empty($t)){
            unset($t);
            return json_encode($s);
        }else{
            return json_encode([]);
        }
    }

    private function saveExtra($data){

        $goods = $this->goodsModel->where([
            ['sn','=',$data["商品编码"]]
        ])->first();

        if(empty($goods)){
            return false;
        }

        $extra = $goods->extra()->firstOrCreate([
            'goods_id' => $goods->id
        ]);

        $extra->text_component = $data["成份"];
        $extra->main_function = $data["适应症功能主治适宜人群"];
        $extra->usage = $data["用法用量食用方法及食用量"];
        $extra->untoward_effect = $data["不良反应"];
        $extra->taboo = $data["禁忌"];
        $extra->attention = $data["注意事项"];
        $extra->drug_women = $data["孕妇及哺乳期妇女用药"];
        $extra->drug_children = $data["儿童用药"];
        $extra->drug_older = $data["老人用药"];
        $extra->drug_interaction = $data["药物相互作用"];
        $extra->goods_desc = $data["保健功能"];
//        $extra->taboo_medicine_effect = $data["商品编码"];// text COLLATE utf8mb4_unicode_ci COMMENT '禁忌药物',
//        $extra->taboo_medicine_res = $data["商品编码"];// text COLLATE utf8mb4_unicode_ci COMMENT '禁忌药物结果',
//        $extra->taboo_food_effect = $data["商品编码"];// text COLLATE utf8mb4_unicode_ci COMMENT '禁忌食物',
//        $extra->taboo_food_res = $data["商品编码"];// text COLLATE utf8mb4_unicode_ci COMMENT '禁忌食物结果',
//        $extra->taboo_food_list = $data["商品编码"];// text COLLATE utf8mb4_unicode_ci COMMENT '禁忌食物列表',
//        $extra->taboo_disease_effect = $data["商品编码"];// text COLLATE utf8mb4_unicode_ci,
//        $extra->taboo_disease_res = $data["商品编码"];// text COLLATE utf8mb4_unicode_ci,
//        $extra->taboo_kind_effect = $data["不适宜人群"];// text COLLATE utf8mb4_unicode_ci COMMENT '禁忌人物',
//        $extra->taboo_kind_res = $data["商品编码"];// text COLLATE utf8mb4_unicode_ci COMMENT '禁忌人物结果',

        return $extra->save();
    }
}