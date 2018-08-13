<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAGoodsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('a_goods_data')){
            Schema::create('a_goods_data', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('select_name', 30)->nullable()->default('')->comment('select的name属性值');
                $table->string('select_option', 100)->nullable()->default('')->comment('选项');
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
