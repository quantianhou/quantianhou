
<script type="text/javascript">

    $.CurrentNavtab.find('#confirm').on('click',function(){
        var post_data = $.CurrentNavtab.find('.formarea').serialize();
        var oo = {
            url : '/api/service/make',
            loadingmask:true,
            data : post_data,
            callback:function(res){
                if(res.error) return $(this).alertmsg('error', res.info), !1;
                $(this).alertmsg('info', res.info, {
                    autoClose:false,
                    okCall: function () {
                        productList_refresh();
                        $.CurrentNavtab.navtab('close');
                    }
                });
            }
        };
        $(document).bjuiajax('doAjax', oo);
    });

    //商品内容图片
    $.CurrentNavtab.find(".content_img_upload_file").change(function() {
        var faterObj = $(this).parent();
        for(var i in this.files){
            var file = this.files[i];
            if(file.size > 1048576){
                return $(this).alertmsg('info', '图片大小不能超过1M');
            }
            var reader = new FileReader();
            reader.readAsDataURL(file);//调用自带方法进行转换
            reader.onload = function(e) {

                    faterObj.append('<div style="display: inline-block; margin: 5px;">\
                    <input type="hidden" value="'+this.result+'" name="content_img[]" />\
                    <img width="100" height="100" src="'+this.result+'" />\
                    <a onclick="$(this).parent().remove()" style="display: block; text-align: center;">删除</a>\
                    </div>')
            };
        }

    });
    //图片
    $.CurrentNavtab.find("#img_upload_file").change(function() {
        for(var i in this.files){
            var file = this.files[i];
            if(file.size > 1048576){
                return $(this).alertmsg('info', '图片大小不能超过1M');
            }
            var reader = new FileReader();
            reader.readAsDataURL(file);//调用自带方法进行转换
            reader.onload = function(e) {

                $.CurrentNavtab.find('#showimg').append('<div style="display: inline-block; margin: 5px;">\
                    <input type="hidden" value="'+this.result+'" name="img[]" />\
                    <img width="100" height="100" src="'+this.result+'" />\
                    <a onclick="$(this).parent().remove()" style="display: block; text-align: center;">删除</a>\
                    </div>')
            };
        }

    });
    //获取分类
    /*var oo = {
        url : '/api/service/getCategory',
        loadingmask:true,
        data : {},
        callback:function(res){

            if(res.error) return $(this).alertmsg('error', res.info), !1;

            for(var i in res.data){
                if(!res.data[i].id){
                    continue;
                }
                var prefix = '';
                for(var ii = 1;ii < res.data[i].level;ii++){
                    prefix += ' --- '
                }
                $.CurrentNavtab.find('#categorylist').append('<option value="'+res.data[i].id+'">'+prefix+res.data[i].category_name+'</option>')
                $.CurrentNavtab.find('select').selectpicker('refresh');
            }
        }
    };
    $(document).bjuiajax('doAjax', oo);

    //判断是否需要拉取数据
    if(BJUI.URLDATA.service.id > 0){
        var oo = {
            url : '/api/service/one',
            loadingmask:true,
            data : {id:BJUI.URLDATA.service.id},
            callback:function(res){

                if(res.error) return $(this).alertmsg('error', res.info), !1;

                for(var i in res.data){

                    if(i != 'img'){
                        $.CurrentNavtab.find('input[name='+i+']').val(res.data[i])
                        $.CurrentNavtab.find('select[name='+i+']').val(res.data[i])
                        $.CurrentNavtab.find('textarea[name='+i+']').val(res.data[i])
                    }
                }

                //图片处理
                for(var i in res.data['img']){
                    if(isNaN(i)){
                        continue;
                    }
                    $.CurrentNavtab.find('#showimg').append('<div style="display: inline-block; margin: 5px;">\
                    <input type="hidden" value="'+res.data['img'][i]+'" name="img[]" />\
                    <img width="100" height="100" src="http://img.littleobean.com/'+res.data['img'][i]+'" />\
                    <a onclick="$(this).parent().remove()" style="display: block; text-align: center;">删除</a>\
                    </div>')
                }
                //内容图片处理
                for(var i in res.data['content_img']){
                    if(isNaN(i)){
                        continue;
                    }
                    if(res.data['content_img'][i] == ""){
                        continue;
                    }
                    $.CurrentNavtab.find('#content_showimg').append('<div style="display: inline-block; margin: 5px;">\
                    <input type="hidden" value="'+res.data['content_img'][i]+'" name="content_img[]" />\
                    <img width="100" height="100" src="http://img.littleobean.com/'+res.data['content_img'][i]+'" />\
                    <a onclick="$(this).parent().remove()" style="display: block; text-align: center;">删除</a>\
                    </div>')
                }
                $.CurrentNavtab.find('select').selectpicker('refresh');
            }
        };
        $(document).bjuiajax('doAjax', oo);
    }
*/
</script>

<div class="bjui-pageContent">

    <div style="margin:10px 0px 0px 17px;">
        <form class="formarea" enctype="multipart/form-data">
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
                        <input type="file" name="merchant_logo" id="content_img_upload_file" class="content_img_upload_file" multiple="multiple"  /><br />
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
                            <select name="address_province" data-toggle="selectpicker" data-nextselect="#j_form_city1" data-refurl="../../json/select/city_{value}.html">
                                <option value="all">--省市--</option>
                                <option value="bj" selected="">北京</option>
                                <option value="sh">上海</option>
                            </select>
                            <select name="address_city" id="j_form_city1" data-toggle="selectpicker" data-nextselect="#j_form_area1" data-refurl="../../json/select/area_{value}.html" data-val="bj" data-emptytxt="--城市--">
                                <option value="all">--城市--</option>
                            </select>
                            <select name="address_district" id="j_form_area1" data-toggle="selectpicker" data-val="朝阳" data-emptytxt="--区县--">
                                <option value="all">--区县--</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>是否虚拟：</label>
                    </td>
                    <td>
                        <input type="checkbox" name="is_virtual" id="" value="1"> 第三方
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>是否第三方：</label>
                    </td>
                    <td>
                        <input type="checkbox" name="is_third_party" id="" value="1"> 加强
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
                            <input type="file" id="content_img_upload_file" name="business_license_img" class="content_img_upload_file" multiple="multiple"  /><br />
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
                            附件上传：<input type="file" name="drug_license_img" id="content_img_upload_file" class="content_img_upload_file" multiple="multiple"  /><br />
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
                            附件上传：
                            <input type="file" id="content_img_upload_file" name="legal_person_img" class="content_img_upload_file" multiple="multiple"  /><br />
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

                        附件上传：
                        <div class="content_showimg">
                            <input type="file" id="content_img_upload_file" name="GSP_img" class="content_img_upload_file" multiple="multiple"  /><br />
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

                        附件上传：
                        <div class="content_showimg">
                            <input type="file" id="content_img_upload_file" name="food_licence_img" class="content_img_upload_file" multiple="multiple"  /><br />
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

                        附件上传：
                        <div class="content_showimg">
                            <input type="file" id="content_img_upload_file" name="medical_institution_img" class="content_img_upload_file" multiple="multiple"  /><br />
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

                        附件上传：
                        <div class="content_showimg">
                            <input type="file" id="content_img_upload_file" name="internet_med_tran_img" class="content_img_upload_file" multiple="multiple"  /><br />
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

                        附件上传：
                        <div class="content_showimg">
                            <input type="file" id="content_img_upload_file" name="internet_med_info_img" class="content_img_upload_file" multiple="multiple"  /><br />
                        </div>
                    </td>
                </tr>


                <tr>
                    <td align="left" colspan="2">
                        <button type="button" id="confirm" class="btn btn-green">生成</button>
                        <button type="button" onclick="$.CurrentNavtab.navtab('refresh');" class="btn btn-green">取消</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
<script>
    $('#js-role-time-data').datepicker({pattern:'dd/MM/yyyy', minDate:'2016-10-01'})
</script>