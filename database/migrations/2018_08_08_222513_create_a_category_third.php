<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateACategoryThird extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('a_category_third')){
            Schema::create('a_category_third', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('category_name', 30)->nullable()->default('')->comment('分类名称');
                $table->integer('parent_id')->default(0)->comment('父ID');
                $table->integer('sort_weight')->default(0)->comment('排序');
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
