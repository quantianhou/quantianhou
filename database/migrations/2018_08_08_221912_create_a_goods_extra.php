<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAGoodsExtra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('a_goods_extra')){
            Schema::create('a_goods_extra', function(Blueprint $table)
            {
                $table->increments('id');
                $table->text('text_component', 65535)->nullable()->comment('成分');
                $table->text('main_function', 65535)->nullable()->comment('主治功能');
                $table->text('usage', 65535)->nullable()->comment('用法用量');
                $table->text('untoward_effect', 65535)->nullable()->comment('不良反应');
                $table->text('taboo', 65535)->nullable()->comment('禁忌');
                $table->text('attention', 65535)->nullable()->comment('注意事项');
                $table->text('drug_women', 65535)->nullable()->comment('孕妇哺乳期妇女用药');
                $table->text('drug_children', 65535)->nullable()->comment('儿童用药');
                $table->text('drug_older', 65535)->nullable()->comment('老人用药');
                $table->text('drug_interaction', 65535)->nullable()->comment('药物相互作用');
                $table->text('goods_desc', 65535)->nullable()->comment('商品详情');
                $table->text('taboo_medicine_effect', 65535)->nullable()->comment('禁忌药物');
                $table->text('taboo_medicine_res', 65535)->nullable()->comment('禁忌药物结果');
                $table->text('taboo_food_effect', 65535)->nullable()->comment('禁忌食物');
                $table->text('taboo_food_res', 65535)->nullable()->comment('禁忌食物结果');
                $table->text('taboo_food_list', 65535)->nullable()->comment('禁忌食物列表');
                $table->text('taboo_kind_effect', 65535)->nullable()->comment('禁忌人物');
                $table->text('taboo_kind_res', 65535)->nullable()->comment('禁忌人物结果');
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
