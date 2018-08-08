
<script type="text/javascript">

    $.CurrentNavtab.find('.formarea').on('submit',function(){
        var post_data = $.CurrentNavtab.find('.formarea').serialize();
        var oo = {
            url : '/api/merchants',
            loadingmask:true,
            data : post_data,
            callback:function(res){
                if(res.errors) {
                    alert(2323);
                    return $(this).alertmsg('error', res.message), !1;
                }
                $(this).alertmsg('info', res.info, {
                    autoClose:false,
                    okCall: function () {
                        productList_refresh();
                        $.CurrentNavtab.navtab('close');
                    }
                });
            },
        };

        $(document).bjuiajax('doAjax', oo);
    });

</script>

<div class="bjui-pageContent">

    <div style="margin:10px 0px 0px 17px;">
        <form class="formarea" data-toggle="validate">
            <input type="hidden" name="id" />
            <table class="table" border="0" width="60%">

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>商家类型：</label>
                    </td>
                    <td>
                        <input type="radio" name="merchant_type" id="" checked value="1"> 公司:
                        <input type="radio" name="merchant_type" id="" value="2"> 个人
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>商家联系人：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="merchant_contacts" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>商家联系电话：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="merchant_phone" size="30" data-rule="required"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>加盟类型：</label>
                    </td>
                    <td>
                        <input type="radio" name="franchising_type" id="" checked value="1"> 加强
                        <input type="radio" name="franchising_type" id="" value="2"> 简捷
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>商家名称：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="merchant_name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>商家简称：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="merchant_short_name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">商家logo：</label>
                    </td>

                    <td id="content_showimg">
                        <div class="btn btn-success role-upload-image" data-field_name="merchant_logo[]">上传</div>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>经营方式：</label>
                    </td>
                    <td>
                        <input type="radio" name="manage_type" id="" checked value="1"> 连锁
                        <input type="radio" name="manage_type" id="" value="2"> 非连锁
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>机构类型：</label>
                    </td>
                    <td>
                        <input type="radio" name="organization_type" id="" checked value="1"> 药店
                        <input type="radio" name="organization_type" id="" value="2"> 医疗机构
                        <input type="radio" name="organization_type" id="" value="3"> 其他企业
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>详细地址：</label>
                    </td>
                    <td>
                        <div class="row-input">
                            <select name="address_province" data-toggle="selectpicker" data-nextselect="#j_form_city1" data-refurl="/api/areas/list?parent_id={value}">
                                <option value="" selected>--省市--</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->id }}" selected="">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            <select name="address_city" id="j_form_city1" data-toggle="selectpicker" data-nextselect="#j_form_area1" data-refurl="/api/areas/list?parent_id={value}" data-emptytxt="--城市--">
                                <option value="">--城市--</option>
                            </select>
                            <select name="address_district" id="j_form_area1" data-toggle="selectpicker"  data-emptytxt="--区县--">
                                <option value="">--区县--</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>是否虚拟：</label>
                    </td>
                    <td>
                        <input type="radio" name="is_virtual" id="" checked value="1"> 是
                        <input type="radio" name="is_virtual" id="" value="2"> 不是
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>是否第三方：</label>
                    </td>
                    <td>
                        <input type="radio" name="is_third_party" id="" checked value="1"> 是
                        <input type="radio" name="is_third_party" id="" value="2"> 不是
                    </td>
                </tr>


                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>企业负责人：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="企业负责人" name="company_person_name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>邮政编码：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="post_code" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>传真：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="fax" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>企业负责人电话：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="company_person_mobile" size="30" data-rule="required"><span></span>
                    </td>
                </tr>


                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>税务登记证号：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="tax_register_num" size="30" data-rule="required"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>组织机构代码：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="institution_num" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>质量负责人：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="quality_person" size="30" data-rule="required"><span></span>
                    </td>
                </tr>


                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>GPS认证：</label>
                    </td>
                    <td>
                        <input type="radio" name="GPS_status" id="" checked value="1"> 通过
                        <input type="radio" name="GPS_status" id="" value="2"> 不通过
                    </td>
                </tr>


                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>营业执照：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="business_license_num" size="30" data-rule="required"><br>
                        有效期： <input type="text" name="business_license_expiry_date" value="2018-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="business_license_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>药品经营许可证：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="drug_license_num" size="30" data-rule="required"><br>
                        有效期： <input type="text" name="drug_license_expriy_date" value="2016-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="drug_license_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>法人身份证：</label>
                    </td>
                    <td>
                        姓名： <input type="text" placeholder="请填写名称" name="legal_person_name" size="30" data-rule="required"><br>
                        身份证号： <input type="text" value="2016-10-01 10:01:01" name="legal_person_id_num" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">

                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="legal_person_img[]">照片</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>GPS证书：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="GSP_num" size="30" data-rule="required"><br>
                        有效期： <input type="text" value="2016-10-01 10:01:01" name="GSP_expriy_date" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="GSP_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>食物流通许可证书：</label>
                    </td>
                    <td>
                        许可证号： <input type="text"  placeholder="请填写名称" name="food_licence_num" size="30" data-rule="required"><br>
                        有效期： <input type="text" value="2016-10-01 10:01:01" data-toggle="datepicker" name="food_licence_expriy_date" data-pattern="yyyy-MM-dd HH:mm:ss">
                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="food_licence_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>医疗机构许可证：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="medical_institution_num" size="30" data-rule="required"><br>
                        有效期： <input type="text" name="medical_institution_expriy_date" value="2016-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">

                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="medical_institution_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>医疗器械许可证：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="medical_app_num" size="30" data-rule="required"><br>
                        有效期： <input type="text" name="medical_app_expriy_date" value="2016-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">

                        附件上传：
                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="medical_app_img[]">附件上传</button>
                            <input type="file" id="content_img_upload_file" name="medical_app_img" class="content_img_upload_file" multiple="multiple"  /><br />
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>互联网药品交易服务许可证：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="internet_med_tran_num" size="30" data-rule="required"><br>
                        有效期： <input type="text" name="internet_med_tran_expriy_date" value="2016-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">

                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="internet_med_tran_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>互联网药品信息服务许可证：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="internet_med_info_num" size="30" data-rule="required"><br>
                        有效期： <input type="text" name="internet_med_info_expriy_date" value="2016-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="internet_med_info_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td align="left" colspan="2">
                        <button type="submit" id="confirm" class="btn btn-green">生成</button>
                        <button type="button" onclick="$.CurrentNavtab.navtab('refresh');" class="btn btn-green">取消</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
<script>

    $('#js-role-time-data').datepicker({pattern:'dd/MM/yyyy', minDate:'2016-10-01'})
    $('.role-upload-image').click(function () {
        vueUpload($(this), 'merchant_logo[]')
    });

</script>