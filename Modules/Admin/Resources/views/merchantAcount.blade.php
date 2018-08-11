    <div class="bjui-pageContent">
    <form action="" id="merchant_serarch_form">
        <fieldset>
            <legend>信息填写</legend>
            <table class="table table-condensed table-hover">
                <tbody>
                <tr>
                    <td>
                        <label for="j_dialog_operation" class="control-label x90">所属商家：</label>
                        <select class="select-nm" name="dialog.operation" id="j_dialog_operation" data-toggle="selectpicker"
                        >
                            <option value="">全部</option>
                            <option value="1">业务1</option>
                            <option value="2" selected>订房部</option>
                            <option value="3">领队</option>
                            <option value="4">导游</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="j_dialog_name" class="control-label x90">账户名称：</label>
                        <input type="text" name="dialog.name" id="j_dialog_name" value="" data-rule="required"
                               size="20">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="j_dialog_name" class="control-label x90">原始密码：</label>
                        <input type="text" name="dialog.name" id="j_dialog_name" value="" data-rule="required"
                               size="20">
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
        <button type="button" class="btn btn-green">保存</button>
    </div>
</div>
<script>


    $.CurrentNavtab.find('#merchant_serarch_form').on('submit',function(){
        var post_data = $.CurrentNavtab.find('#merchant_serarch_form').serialize();
        console.log(post_data);return;
        var oo = {
            url : '/api/merchants',
            type: 'GET',
            loadingmask:true,
            data : post_data,
            callback:function(res){

            },
        };

        $(document).bjuiajax('doAjax', oo);
    });


    //创建申请表后回调-刷新列表
    function cardlist_refreshApplyTable(){
        $('#adlist-table').datagrid('refresh');
    }
</script>



