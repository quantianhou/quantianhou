<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateARbacAccess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('a_rbac_access')){
            Schema::create('a_rbac_access', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('role_id')->comment('角色ID');
                $table->integer('node_id')->comment('节点ID');
                $table->timestamps();
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
