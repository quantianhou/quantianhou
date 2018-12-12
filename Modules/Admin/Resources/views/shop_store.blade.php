
<script type="text/javascript">
    $.CurrentNavtab.find('#confirm').on('click',function(event){
        event.preventDefault();
        var post_data = $.CurrentNavtab.find('#store-data-info').serialize();
        var oo = {
            url : '/api/shop_store',
            loadingmask:true,
            data : post_data,
            callback:function(res){
                if(res.errors) {
                    return $(this).alertmsg('error', res.message)
                }
                $(this).alertmsg('ok', res.message, {
                    autoClose:false,
                    okCall: function () {
                        $('#shop-store-table').datagrid('refresh');//刷新数据列表
                        $(this).navtab('closeCurrentTab');//成功后关闭当前tab页
                    }
                });
            },
            failCallback: function (msg, options) {
                console.log(msg, options, 1)
            },
            errCallback: function (json, options) {
                console.log(json, options)
            }
        };

        $(document).bjuiajax('doAjax', oo);
    });

</script>

<div class="bjui-pageContent">

    <div style="margin:10px 0px 0px 17px;">
        <form class="formarea" data-toggle="validate" id="store-data-info">
            <input type="hidden" name="id" />
            <table class="table" border="0" width="60%">

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>归属商家：</label>
                    </td>
                    <td>
                        <select name="a_merchant_id" data-toggle="selectpicker" data-rule="required" >
                            <option value="">请选择</option>
                            @foreach($merchants as $merchant)
                                <option value="{{ $merchant['id'] }}">{{ $merchant['merchant_name'] }}</option>
                            @endforeach

                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>机构编码：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="机构代码" name="organization_code" size="30" data-rule="required"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>ERP端门店编码：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请输入ERP端门店编码，用于商品和库存同步" name="erp_shop_code" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>门店名称：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="门店名称" name="storename" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>门店简称：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="门店简称" name="store_short_name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>详细地址：</label>
                    </td>
                    <td>
                        <div class="row-input">
                            <select id="sel-provance" name="province" onChange="selectCity();" class="select form-control select-group" style="width:123px;display:inline;">
                                <option value="" selected="false">省/直辖市</option>
                            </select>
                            <select id="sel-city" name="city" onChange="selectcounty(0)" class="select form-control select-group" style="width:135px;display:inline;">
                                <option value="" selected="false">请选择</option>
                            </select>
                            <select id="sel-area" name="area" class="select form-control select-group" style="width:130px;display:inline;">
                                <option value="" selected="false">请选择</option>
                            </select>

                        </div>
                        <div style="margin-top:3px">
                            <input type="text" placeholder="请填写详细地址" name="address" size="30" data-rule="required"><span></span>
                            <select id="sel-street" class="select form-control" style="width:130px;display:none;">
                                <option value="" selected="true">请选择</option>
                            </select>
                        </div>
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
                        <label class="label-control"><span style="color:red">*</span>经营方式：</label>
                    </td>
                    <td>
                        <input type="radio" name="manage_type" id="" checked value="1"> 连锁
                        <input type="radio" name="manage_type" id="" value="2"> 非连锁

                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>门店联系人：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="门店联系人" name="store_contacts" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>门店联系电话：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="门店联系人" name="tel" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->门店短信签名：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="门店短信签名" name="store_sms_sign" size="30"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->企业负责人：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="企业负责人" name="company_person_name" size="30"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->企业负责人电话：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="企业负责人电话" name="company_person_mobile" size="30"><span></span>
                    </td>
                </tr>

                {{--<tr>--}}
                {{--<td align="right" width="300px;">--}}
                {{--<label class="label-control"><span style="color:red">*</span>GSP认证：</label>--}}
                {{--</td>--}}
                {{--<td>--}}
                {{--<input type="radio" name="GPS_status" id="" checked value="1"> 通过--}}
                {{--<input type="radio" name="GPS_status" id="" value="2"> 不通过--}}
                {{--</td>--}}
                {{--</tr>--}}



                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->邮政编码：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="post_code" size="30"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->传真：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="fax" size="30"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->质量负责人：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="quality_person" size="30"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->税务登记证号：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="tax_register_num" size="30"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->组织机构代码：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="institution_num" size="30"><span></span>
                    </td>
                </tr>

                {{--字段不知道是哪个--}}
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->经度：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="经度" name="lat" size="30"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->维度：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="维度" name="lng" size="30"><span></span>
                    </td>
                </tr>

                {{--字段不知道是哪个--}}
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">机构logo：</label>
                    </td>

                    <td class="content_showimg">
                        <div class="btn btn-success role-upload-image" data-field_name="logo[]">上传</div>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">机构门头照：</label>
                    </td>

                    <td class="content_showimg">
                        <div class="btn btn-success role-upload-image" data-field_name="organization_front_img[]">上传</div>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->机构简称：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="机构简称" name="organization_introduce" size="30"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><!--span style="color:red">*</span-->机构标签：</label>
                    </td>
                    <td>
                        <input type="radio" name="tag" id="" checked value="1"> 24H
                        <input type="radio" name="tag" id="" value="2"> 医保定点
                        <input type="radio" name="tag" id="" value="2">免费送药
                    </td>
                </tr>




                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">营业执照：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="business_license_num" size="30" ><br>
                        有效期： <input type="text" name="business_license_expiry_date" value="2018-10-01" data-toggle="datepicker" data-pattern="yyyy-MM-dd">
                        <div class="">
                            <button class="btn btn-success role-upload-image" data-field_name="business_license_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">药品经营许可证：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="drug_license_num" size="30" ><br>
                        有效期： <input type="text" name="drug_license_expriy_date" value="2016-10-01" data-toggle="datepicker" data-pattern="yyyy-MM-dd">
                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="drug_license_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">法人身份证：</label>
                    </td>
                    <td>
                        姓名： <input type="text" placeholder="请填写名称" name="legal_person_name" size="30" ><br>
                        身份证号： <input type="text" name="legal_person_id_num" value="0">

                        <div class="">
                            <button class="btn btn-success role-upload-image" data-field_name="legal_person_img[]">照片</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">GPS证书：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="GSP_num" size="30" ><br>
                        有效期： <input type="text" value="2016-10-01" name="GSP_expriy_date" data-toggle="datepicker" data-pattern="yyyy-MM-dd">
                        <div class="">
                            <button class="btn btn-success role-upload-image" data-field_name="GSP_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">食物流通许可证书：</label>
                    </td>
                    <td>
                        许可证号： <input type="text"  placeholder="请填写名称" name="food_licence_num" size="30" ><br>
                        有效期： <input type="text" value="2016-10-01" data-toggle="datepicker" name="food_licence_expriy_date" data-pattern="yyyy-MM-dd">
                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="food_licence_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">医疗机构许可证：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="medical_institution_num" size="30" ><br>
                        有效期： <input type="text" name="medical_institution_expriy_date" value="2016-10-01" data-toggle="datepicker" data-pattern="yyyy-MM-dd">

                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="medical_institution_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">医疗器械许可证：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="medical_app_num" size="30" ><br>
                        有效期： <input type="text" name="medical_app_expriy_date" value="2016-10-01" data-toggle="datepicker" data-pattern="yyyy-MM-dd">

                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="medical_app_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">互联网药品交易服务许可证：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="internet_med_tran_num" size="30" ><br>
                        有效期： <input type="text" name="internet_med_tran_expriy_date" value="2016-10-01" data-toggle="datepicker" data-pattern="yyyy-MM-dd">

                        <div class="content_showimg">
                            <button class="btn btn-success role-upload-image" data-field_name="internet_med_tran_img[]">附件上传</button>
                        </div>
                    </td>
                </tr>




                <tr>
                    <td align="left" colspan="2">
                        <button type="submit" id="confirm" class="btn btn-green">生成</button>
                        <button type="button" onclick="$(this).navtab('closeCurrentTab');" class="btn btn-green">取消</button>
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
    //判断是否需要拉取数据
    if(BJUI.URLDATA.hasOwnProperty("shop_store") && BJUI.URLDATA.shop_store.hasOwnProperty("id")){
        if(BJUI.URLDATA.shop_store.id >0){
            var oo = {
                url : '/api/shop_store/info',
                loadingmask:true,
                data : {id:BJUI.URLDATA.shop_store.id},
                callback:function(res){
                    console.log(res);
                    if(res.error) return $(this).alertmsg('error', res.info), !1;
                    // //由于bjui的select控件三级联动赋值第一层后不自动联动，所以特殊处理下
                    for(var i in res.area.citys){
                        if(!isNaN(i)){
                            var d = res.area.citys[i];
                            //$.CurrentNavtab.find('select[name=city]').append('<option value="'+d.label+'">'+d.label+'</option>');
                        }
                    }
                    for(var i in res.area.district){
                        if(!isNaN(i)){
                            var d = res.area.district[i];
                            //$.CurrentNavtab.find('select[name=area]').append('<option value="'+d.label+'">'+d.label+'</option>');
                        }
                    }
                    cascdeInit("1","1",res.data.province,res.data.city,res.data.area,"''");

                    for(var i in res.data){
                        if(i != 'merchant_logo'){
                            $.CurrentNavtab.find('input:hidden[name='+i+']').val(res.data[i]);
                            $.CurrentNavtab.find('input:text[name='+i+']').val(res.data[i]);
                            $.CurrentNavtab.find('select[name='+i+']').val(res.data[i]);
                            $.CurrentNavtab.find('input:radio[name='+i+'][value="' + res.data[i] + '"]').prop("checked", "checked");
                            $.CurrentNavtab.find('textarea[name='+i+']').val(res.data[i]);
                        }
                        if(i == 'merchant_logo' || i.indexOf('_img')!= -1){
                            console.log(i);
                            var str = '<div style="display: inline-block; margin: 5px;"><input type="hidden" value="'+res.data[i]+'" name="'+i+'[]"><img width="100" height="100" src="http://qth-test.oss-cn-hangzhou.aliyuncs.com/'+res.data[i]+'"><a onclick="$(this).parent().remove()" style="display: block; text-align: center;">删除</a></div>';
                            $.CurrentNavtab.find('button[data-field_name="'+i+'[]"]').after(str);
                        }
                        if(i != 'province' && i != 'city' && i !='area'){
                            //$.CurrentNavtab.find('select').selectpicker('refresh');
                            $.CurrentNavtab.find('select[name='+i+']').selectpicker('refresh');
                        }
                    }

                }
            };
            $(document).bjuiajax('doAjax', oo);
        }
    }else{
        cascdeInit("1","0","","","","''");
    }
</script>