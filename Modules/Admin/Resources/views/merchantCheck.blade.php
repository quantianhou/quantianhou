    <div class="bjui-pageContent">
    <form action="" id="merchantCheck_form">
        <fieldset>
            <legend>审核</legend>
            <table class="table table-condensed table-hover">
                <tbody>
                <tr>
                    <td>
                        <label for="j_dialog_operation" class="control-label x90">审核商家：</label>
                        <label id="merchantCheck_merchant_name"></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="j_dialog_name" class="control-label x90">审核状态：</label>
                        <input type="radio" name="status" id="merchantCheck_status" value="4"
                               data-toggle="icheck" data-label="通过" checked>
                        <input type="radio" name="status" id="merchantCheck_status" value="3"
                               data-toggle="icheck" data-label="退回">
                        <input type="radio" name="status" id="merchantCheck_status" value="5"
                               data-toggle="icheck" data-label="拒绝">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="j_dialog_name" class="control-label x90">审核意见：</label>
                        <textarea cols="30" name="check_remark" id="check_remark"></textarea>
                    </td>
                </tr>
                </tbody>
            </table>
        </fieldset>

    </form>

    <br />
    <div>
        <button type="button" id="merchantCheck_save_btn" class="btn btn-green">保存</button>
    </div>
</div>
<script>
    //拉取数据
    if(BJUI.URLDATA.hasOwnProperty("merchantCheck") && BJUI.URLDATA.merchantCheck.hasOwnProperty("id")){
        if(BJUI.URLDATA.merchantCheck.id[0] >0){//至少有一条数据
            var oo = {
                url : '/api/merchants/getMerchants',
                loadingmask:true,
                data : {id:BJUI.URLDATA.merchantCheck.id},
                callback:function(res){
                    if(res.error) return $(this).alertmsg('error', res.info), !1;
                    $.CurrentDialog.find('#merchantCheck_merchant_name').html(res.data);
                }
            };
            $(document).bjuiajax('doAjax', oo);
        }
    }
    //监听"保存"按钮点击事件
    $.CurrentDialog.find('#merchantCheck_save_btn').on('click',function(){
        var post_data = $.CurrentDialog.find('#merchantCheck_form').serialize();
        var oo = {
            url : '/api/merchants/checkMerchants',
            type: 'POST',
            loadingmask:true,
            data : {id: BJUI.URLDATA.merchantCheck.id, check_remark: $('#check_remark').val(), status: $('input[name="status"]:checked').val()},
            okCallback:function(res){
                if(res.error) return $(this).alertmsg('error', res.message), !1;
                BJUI.dialog('close', 'openMerchantCheck');//关闭当前弹窗
                $('#merchant_list_table').datagrid('refresh');//刷新数据列表
            },
            errCallback:function(res){
                BJUI.alertmsg('error', res.message);
            }
        };
        $(document).bjuiajax('doAjax', oo);
    });
</script>



