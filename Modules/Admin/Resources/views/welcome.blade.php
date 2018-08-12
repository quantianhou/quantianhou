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
    var oo = {
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

</script>

<div class="bjui-pageContent">

    <div style="margin:10px 0px 0px 17px;">
        <form class="formarea">
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
                        <label class="label-control"><span style="color:red">*</span>商品名称：</label>
                    </td>
                    <td>
                        <input type="text" placeholder="请填写名称" name="name" size="30" data-rule="required"><span></span>
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
                        <input type="text" name="original_price" placeholder="例：19.99" data-rule="required"><span></span>
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