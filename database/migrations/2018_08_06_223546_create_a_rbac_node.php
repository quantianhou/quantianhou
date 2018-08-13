<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateARbacNode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('a_rbac_node')){
            Schema::create('a_rbac_node', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('name', 20)->nullable()->default('')->comment('节点名称');
                $table->string('route', 255)->nullable()->default('')->comment('路由');
                $table->string('icon', 10)->nullable()->default('')->comment('图标');
                $table->integer('pid')->comment('父ID');
                $table->integer('sort')->comment('排序');
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
