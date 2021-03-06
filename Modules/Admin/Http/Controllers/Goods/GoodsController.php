<?php

namespace Modules\Admin\Http\Controllers\Goods;

use App\Models\Category\ComponentModel;
use App\Models\Category\GoodsModel;
use App\Models\Goods\DataModel;
use App\Repositories\Goods\GoodsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Http\Controllers\AdminController;

class GoodsController extends AdminController
{

	public function __construct(
        GoodsRepository $goods,
        DataModel $dataModel,
        GoodsModel $categoryGoodsModel,
        ComponentModel $categoryComponentModel
    )
    {
        parent::__construct();
        $this->goods = $goods;
        $this->dataModel = $dataModel;
        $this->categoryGoodsModel = $categoryGoodsModel;
        $this->categoryComponentModel = $categoryComponentModel;
    }

    /**
     * 商品列表
     */
    public function index(Request $request){

        $filters = [];
        $goods = $request->get('goods');
        $other = $request->get('other');
        $like = $request->get('like');
        $has_imgaes = $request->get('has_imgaes');
        if(!empty($goods)){
            foreach ($goods as $k => $v){
                $v && $filters[] = [$k,'=',$v];
            }
        }

        if($has_imgaes == 1){
            $filters[] = [$k,'=',$v];
        }

        if(!empty($like)){
            foreach ($like as $k => $v){
                $v && $filters[] = [$k,'like','%'.$v.'%'];
            }
        }

        if(!empty($other)){
            foreach ($other as $k => $v){
                if(!$v){
                    continue;
                }
                $k== 'sn_start' && $filters[] = ['sn','>=',$v];
                $k== 'sn_end' && $filters[] = ['sn','<=',$v];
                $k== 'component_name' && $filters[] = ['component','=',DataModel::where([
                        'select_name' => 'component',
                        'select_option' => $v
                    ])->first()->extra ?? ''];

            }
        }

        $pageSize = $request->get('pageSize', 20);
        $pageCurrent = $request->get('pageCurrent');
        $list =  $this->goods->getListByWhere($filters, ['*'], [], $pageSize, $pageCurrent);

        return $this->pageSuccess($list);

    }

    /**
     * 编辑/修改
     * @return Response
     */
    public function save(Request $request)
    {
        $goods = $request->get('goods');
        $extra = $request->get('extra');

        $brand_text = $request->get('brand_text');
        $brand_name = $request->get('brand_name');

        if(!$brand_text || trim($brand_text) != trim($brand_name)){
            return $this->json([
                'error' => 2001,
                'info' => '品牌名称不可修改 不可为空',
                'code' => 2001
            ]);
        }

        if(!$goods['id']){
            $hasGoods = $this->goods->getBy('sn',$goods['sn']);
            if(count($hasGoods) > 0){
                return $this->json([
                    'error' => 2001,
                    'info' => '商品编码已存在',
                    'code' => 2001
                ]);
            }
        }
        //添加商品
        $this->goods->saveGoods($goods,$extra);
        return $this->json([
            'data' => 200,
            'info' => '保存成功',
            'code' => 200
        ]);
    }

    /**
     * 删除
     */
    public function delete(Request $request){

        $ids = $request->get('id');

        $this->goods->deleteGoods($ids);
        return $this->json([
            'data' => 200,
            'info' => '操作成功',
            'code' => 200
        ]);
    }

    /*
     * 搜索获取下拉
     */
    public function select($type = 'brand',Request $request){

        $value = $request->value;
        $data = [];
        if($type == 'brand' && $value){
            $data = $this->dataModel
                ->where('select_option','like','%'.$value.'%')
                ->whereIn('select_name',['brand'])->limit(20)->get();
        }


        return $this->json([
            'list' => $data
        ]);

    }

    /**
     * 获取商品信息
     */
    public function detail(Request $request){

        $id = $request->get('id');
        $goodsInfo = $this->goods->getdetail($id);

        return $this->json([
            'data' => $goodsInfo,
            'info' => 'success',
            'code' => 200
        ]);
    }

    /**
     * @param $data
     * @return array
     * 获取下拉选项
     */
    public function options(){
        //品牌
        //$brand = $this->dataModel->whereIn('select_name',['brand'])->limit(100)->get()->toArray();
        $component = $this->dataModel->whereIn('select_name',['component'])->limit(100)->get()->toArray();
        $data = $this->dataModel->whereIn('select_name',['control_code','dosage_form','save_method','unit'])->get()->toArray();

        //$data = array_merge($data,$brand);
        $data = array_merge($data,$component);

        //商品分类
        $category_goods = $this->categoryGoodsModel->get();

        //成分分类
        $category_component = $this->categoryComponentModel->get();

        return $this->json([
            'brand' => $data,
            'goods' => $category_goods,
            'component' => $category_component,
        ]);

    }

    /**
     * 商品图片
     */
    public function images(Request $request){

        $id = $request->get('id');
        $index = $request->get('index');

        $goods = \App\Models\Goods\GoodsModel::find($id);

        $images = json_decode($goods->images,true);
        $data = [];
        if($index == 1){//大图
            $data['images'] = $images['big'] ?? [];
        }else if($index == 2){//中图
            $data['images'] = $images['middle'] ?? [];
        }else{//小图
            $data['images'] = $images['small'] ?? [];
        }

        return $this->json($data);

    }

    /**
     * @param $data
     * @return array
     * bjui返回列表
     */
    public function pageSuccess($data)
    {
        return [
            'total' => $data->total(),
            'pageCurrent' => $data->currentPage(),
            'list' => ($data->toArray())['data'],
            'sql' => \DB::getQueryLog()
        ];
    }

    /**
     * 重组分类
     */
    private function merge($list,$p = 0,$l = 1){

        static $arr = [];

        foreach ($list as $k => $v){
            if($v['parent_id'] == $p){
                $v['level'] = $l;
                $arr[] = $v;
                self::merge($list,$v['id'],$l+1);
            }
        }

        return $arr;
    }
    /**
     * 重组分类
     */
    private function merge2($list,$p = 0,$l = 1){

        static $arr2 = [];

        foreach ($list as $k => $v){
            if($v['parent_id'] == $p){
                $v['level'] = $l;
                $arr2[] = $v;
                self::merge2($list,$v['id'],$l+1);
            }
        }

        return $arr2;
    }

}
