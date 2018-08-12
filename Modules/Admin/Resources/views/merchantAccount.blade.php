    <div class="bjui-pageContent">
    <form action="" id="merchantAccount_form">
        <fieldset>
            <legend>信息填写</legend>
            <table class="table table-condensed table-hover">
                <tbody>
                <tr>
                    <td>
                        <label for="j_dialog_operation" class="control-label x90">所属商家：</label>
                        <select class="select-nm" name="a_merchant_id" id="dialog_merchant_id" data-toggle="selectpicker"
                        >
                            @foreach($merchantNoAccounts as $v)
                                <option value="{{ $v->id }}">{{ $v->merchant_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="j_dialog_name" class="control-label x90">账户名称：</label>
                        <input type="text" name="username" id="dialog_merchant_username" value="" data-rule="required" size="20">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="j_dialog_name" class="control-label x90">原始密码：</label>
                        <input type="text" name="password" id="dialog_merchant_password" value="" data-rule="required" size="20">
                    </td>
                </tr>
                {{--<tr>--}}
                    {{--<td colspan="3">--}}
                        {{--<div class="alert alert-warning form-inline"><i class="fa fa-warning"></i> <strong>Class说明：</strong>JS会为text或textarea自动加上Class[form-control]。</div>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                </tbody>
            </table>
        </fieldset>

    </form>

    <br />
    <div id="adpositiontList_services">
        <button type="button" id="merchantAccount_save_btn" class="btn btn-green">保存</button>
    </div>
</div>
<script>
    //监听"保存"按钮点击事件
    $.CurrentDialog.find('#merchantAccount_save_btn').on('click',function(){
        var post_data = $.CurrentDialog.find('#merchantAccount_form').serialize();
        var oo = {
            url : '/api/merchantAccount/add',
            type: 'POST',
            loadingmask:true,
            data : post_data,
            okCallback:function(res){
                BJUI.dialog('close', 'openAddMerchantAccount');//关闭当前弹窗
                $('#merchant_account_table').datagrid('refresh');//刷新数据列表
            },
            errCallback:function(res){
                BJUI.alertmsg('error', res.message);
            }
        };
        $(document).bjuiajax('doAjax', oo);
    });
</script>



