<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('a_goods')){
            Schema::create('a_goods', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('sn', 20)->nullable()->default('')->comment('商品编码');
                $table->string('name', 50)->nullable()->default('')->comment('商品商品名称');
                $table->string('single_name', 50)->nullable()->default('')->comment('通用名称');
                $table->string('show_name', 50)->nullable()->default('')->comment('显示名称');
                $table->string('nation_sn', 50)->nullable()->default('')->comment('国际条码');
                $table->string('approval_number', 50)->nullable()->default('')->comment('批准文号');
                $table->integer('brand')->default(0)->comment('品牌名称');
                $table->string('company', 50)->nullable()->default('')->comment('生产企业');
                $table->string('place', 50)->nullable()->default('')->comment('产地');
                $table->string('alias', 50)->nullable()->default('')->comment('别名');
                $table->string('specifications', 50)->nullable()->default('')->comment('规格');
                $table->integer('dosage_form')->default(0)->comment('剂型');
                $table->integer('unit')->default(0)->comment('单位');
                $table->string('validity_period', 50)->nullable()->default('')->comment('有效期');
                $table->integer('has_mhj')->default(2)->comment('含麻黄碱');
                $table->integer('basic_medicine')->default(2)->comment('基药');
                $table->integer('easy_break')->default(2)->comment('易碎易漏');
                $table->integer('easy_smell')->default(2)->comment('易串味');
                $table->integer('curing')->default(2)->comment('重点养护');
                $table->integer('save_method')->default(2)->comment('储存方式');
                $table->integer('component')->default(2)->comment('成分');
                $table->integer('category_goods')->default(2)->comment('类别名称');
                $table->integer('category_component')->default(2)->comment('成分分类名称');
                $table->integer('control_code')->default(2)->comment('显示控制码');
                $table->integer('service_information')->default(2)->comment('是否触发服务信息');
                $table->string('search_words', 50)->nullable()->default('')->comment('搜索词');
                $table->string('reference_price', 50)->nullable()->default('')->comment('参考进价');
                $table->string('selling_price', 50)->nullable()->default('')->comment('参考售价');
                $table->string('high_price', 50)->nullable()->default('')->comment('最高限价');
                $table->string('treatment', 50)->nullable()->default('')->comment('疗程');
                $table->string('use_time1', 50)->nullable()->default('')->comment('单盒服用天数');
                $table->string('use_time2', 50)->nullable()->default('')->comment('单盒服用天数');
                $table->timestamps();
                $table->softDeletes()->comment('删除时间');
                $table->engine = 'InnoDB';
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
