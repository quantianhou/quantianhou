<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateACategoryRelationMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('a_category_relation_map')){
            Schema::create('a_category_relation_map', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('category_goods_id')->default(0)->comment('己方分类id');
                $table->integer('category_third_id')->default(0)->comment('第三方分类id');
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
