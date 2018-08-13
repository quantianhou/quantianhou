<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateARbacAdminRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('a_rbac_admin_role')){
            Schema::create('a_rbac_admin_role', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('admin_id')->comment('管理员ID');
                $table->integer('role_id')->comment('角色ID');
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
