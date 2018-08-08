<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateARbacRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('a_rbac_role')){
            Schema::create('a_rbac_role', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('name', 20)->nullable()->default('')->comment('角色名');
                $table->string('remark', 255)->nullable()->default('')->comment('备注');
                $table->integer('pid')->comment('父ID');
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
