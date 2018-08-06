
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
    $.CurrentNavtab.find("#content_img_upload_file").change(function() {
        for(var i in this.files){
            var file = this.files[i];
            if(file.size > 1048576){
                return $(this).alertmsg('info', '图片大小不能超过1M');
            }
            var reader = new FileReader();
            reader.readAsDataURL(file);//调用自带方法进行转换
            reader.onload = function(e) {

                $.CurrentNavtab.find('#content_showimg').append('<div style="display: inline-block; margin: 5px;">\
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
                        <label class="label-control"><span style="color:red">*</span>分类：</label>
                    </td>
                    <td>
                        <select data-toggle="selectpicker" id="categorylist" name="category_id" data-width="200">

                        </select>
                    </td>
                </tr>

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
                        <input type="radio" name="merchant_type" id="" checked value="1"> 加强
                        <input type="radio" name="merchant_type" id="" value="2"> 简捷
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>商家名称：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>商家简称：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">商家logo：</label>
                    </td>

                    <td id="content_showimg">
                        <input type="file" id="content_img_upload_file" multiple="multiple"  /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>经营方式：</label>
                    </td>
                    <td>
                        <input type="radio" name="merchant_type" id="" checked value="1"> 连锁
                        <input type="radio" name="merchant_type" id="" value="2"> 非连锁
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>机构类型：</label>
                    </td>
                    <td>
                        <input type="radio" name="merchant_type" id="" checked value="1"> 药店
                        <input type="radio" name="merchant_type" id="" value="2"> 医疗机构
                        <input type="radio" name="merchant_type" id="" value="3"> 其他企业
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>详细地址：</label>
                    </td>
                    <td>
                        <div class="row-input">
                            <select name="province1" data-toggle="selectpicker" data-nextselect="#j_form_city1" data-refurl="../../json/select/city_{value}.html">
                                <option value="all">--省市--</option>
                                <option value="bj" selected="">北京</option>
                                <option value="sh">上海</option>
                            </select>
                            <select name="city1" id="j_form_city1" data-toggle="selectpicker" data-nextselect="#j_form_area1" data-refurl="../../json/select/area_{value}.html" data-val="bj" data-emptytxt="--城市--">
                                <option value="all">--城市--</option>
                            </select>
                            <select name="area1" id="j_form_area1" data-toggle="selectpicker" data-val="朝阳" data-emptytxt="--区县--">
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
                        <input type="checkbox" name="merchant_type" id="" value="1"> 第三方
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>是否第三方：</label>
                    </td>
                    <td>
                        <input type="checkbox" name="merchant_type" id="" value="1"> 加强
                    </td>
                </tr>


                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>企业负责人：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="企业负责人" name="name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>邮政编码：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>传真：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>企业负责人电话：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>


                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>税务登记证号：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>组织机构代码：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>质量负责人：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="name" size="30" data-rule="required"><span></span>
                    </td>
                </tr>


                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>GPS认证：</label>
                    </td>
                    <td>
                        <input type="radio" name="merchant_type" id="" checked value="1"> 通过
                        <input type="radio" name="merchant_type" id="" value="2"> 不通过
                    </td>
                </tr>


                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>营业执照：</label>
                    </td>
                    <td>
                        许可证号： <input type="text" placeholder="请填写名称" name="name" size="30" data-rule="required"><span></span>
                        有效期： <input type="text" placeholder="请填写名称" name="name" size="30" id="js-role-time-data" class="role-time-data" data-rule="required"><span></span>
                        <div class="">
                            <input type="file" id="content_img_upload_file" multiple="multiple"  /><br />
                        </div>
                    </td>
                </tr>

                <!--<tr>-->
                <!--<td align="right" width="300px;">-->
                <!--<label class="label-control"><span style="color:red">*</span>商品描述：</label>-->
                <!--</td>-->
                <!--<td>-->
                <!--<textarea cols="30" class="form-control" name="description" placeholder="请填写描述"></textarea>-->
                <!--</td>-->
                <!--</tr>-->

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>规格：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="10片/盒" name="unit" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>排序：</label>
                    </td>
                    <td>
                        <input type="text" value="1" data-rule="required" name="ordernumber" placeholder="0~99999"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">
                            <!--<span style="color:red">*</span>-->
                            商品内容：</label>
                    </td>
                    <td>
                        <textarea cols="30" class="form-control" name="content" placeholder="请填写内容"></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control">
                            <!--<span style="color:red">*</span>-->
                            商品内容图片(宽<=630px，高度不限)：</label>
                    </td>

                    <td id="content_showimg">
                        <input type="file" id="content_img_upload_file" multiple="multiple"  /><br />
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>状态：</label>
                    </td>
                    <td>
                        <select data-toggle="selectpicker" name="on_sale" data-width="200">
                            <option value="1">上架</option>
                            <option value="2">下架</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>商品图片(宽550px，高550px;1:1即可)：</label>
                    </td>

                    <td id="showimg">
                        <input type="file" id="img_upload_file" multiple="multiple"  /><br />
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>商品价格：</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="例：9.99" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>商品原价：</label>
                    </td>
                    <td>
                        <input type="text" value="2016-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                    </td>
                </tr>

                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>是否为境外商品：</label>
                    </td>
                    <td>
                        <select data-toggle="selectpicker" name="is_overseas" data-width="200">
                            <option value="1">是</option>
                            <option value="2">否</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="300px;">
                        <label class="label-control"><span style="color:red">*</span>库存数量：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="0 ~ 99999" name="inventory_num" data-rule="required"><span></span>
                    </td>
                </tr>

                <tr>
                    <td align="right" colspan="2">
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