<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('a_admin')){
            Schema::create('a_admin', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('nickname', 30)->nullable()->default('')->comment('昵称');
                $table->string('username', 30)->nullable()->default('')->comment('登录名');
                $table->string('password', 100)->nullable()->default('')->comment('密码');
                $table->integer('last_login')->comment('最后登录时间');
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
