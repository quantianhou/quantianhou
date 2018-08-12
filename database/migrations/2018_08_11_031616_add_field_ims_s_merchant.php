<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldImsSMerchant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ims_merchant', function (Blueprint $table) {
            $table->string('drug_license_num')->default('')->comment('药品经营许可证号');
            $table->timestamp('drug_license_expriy_date')->default(null)->comment('药品经营许可证有效期');
            $table->string(    'drug_license_img')->default('')->comment('药品经营许可证图片');
            $table->string('legal_person_name')->default('')->comment('法人姓名');
            $table->string('legal_person_id_num')->default('')->comment('法人身份证号');
            $table->string('legal_person_img')->default('')->comment('法人照片');
            $table->string('GSP_num')->default('')->comment('GSP证件号');
            $table->timestamp('GSP_expriy_date')->default(null)->comment('GSP证件有效期');
            $table->string('GSP_img')->default('')->comment('GSP证件照片');
            $table->string('food_licence_num')->default('')->comment('食品流通许可证');
            $table->timestamp('food_licence_expriy_date')->default(null)->comment('食品流通证有效期');
            $table->string('food_licence_img')->default('')->comment('食品流通证照片');
            $table->string('medical_institution_num')->default('')->comment('医疗机构许可证号');
            $table->timestamp('medical_institution_expriy_date')->default(null)->comment('医疗有效期');
            $table->string('medical_institution_img')->default('')->comment('证件照片');
            $table->string('medical_app_num')->default('')->comment('医疗器械证件号');
            $table->timestamp('medical_app_expriy_date')->default(null)->comment('医疗器械证件有效期');
            $table->string('medical_app_img')->default('')->comment('医疗器械证件照片');
            $table->string('internet_med_tran_num')->default('')->comment('互联网药品交易服务证件号');
            $table->timestamp('internet_med_tran_expriy_date')->default(null)->comment('互联网药品交易服务证件有效期');
            $table->string('internet_med_tran_img')->default('')->comment('互联网药品交易服务证件照片');

            $table->string('internet_med_info_num')->default('')->comment('互联网药品信息服务证件号');
            $table->timestamp('internet_med_info_expriy_date')->default(null)->comment('互联网药信息服务证件有效期');
            $table->string('internet_med_info_img')->default('')->comment('互联网药品信息服务证件照片');

            $table->string('company_person_name')->default('')->comment('企业负责人姓名');
            $table->string('company_person_id_num')->default('')->comment('企业负责人电话号');
            $table->string('email')->default('')->comment('邮箱');
            $table->string('fax')->default('')->comment('传真');
            $table->tinyInteger('GPS_status')->default(1)->comment('Gps是否通过认证 1 未通过 2 通过');
            $table->string('quality_person')->default('')->comment('质量负责人姓名');
            $table->string('institution_num')->default('')->comment('组织机构代码');
            $table->string('tax_register_num')->default('')->comment('税务登记证号');
        });
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
