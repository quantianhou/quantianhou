<div class="bjui-pageContent">
    <form id="merchant_account_list_search_from">
        <fieldset>
            <legend>搜索条件</legend>
            <table class="table table-condensed table-hover">
                <tbody>
                    <tr>
                        <td class="">
                            <label for="">归属商家</label>
                            <select name="a_merchant_id" id="a_merchant_id" data-toggle="selectpicker">
                                <option value="" selected>请选择</option>
                                @foreach($merchantAccounts as $v)
                                    <option value="{{ $v->id }}">{{ $v->merchant_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="">
                            <label for="">状态</label>
                            <select name="status" id="status"  data-toggle="selectpicker">
                                <option value="" selected>请选择</option>
                                <option value="1">新增</option>
                                <option value="2">待审核</option>
                                <option value="3">退回</option>
                                <option value="4">通过</option>
                                <option value="5">拒绝</option>
                                <option value="7">签约</option>
                                <option value="8">取消签约</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <label for="">商家编码</label>
                            <input type="text" name="merchant_code" id="merchant_code">
                        </td>
                        <td class="">
                            <label for="">商家地址</label>
                            <input type="text" name="address_detail" id="address_detail">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <label for="">创建人</label>
                            <input type="text" name="add_admin_name" id="add_admin_name">
                        </td>
                        <td class="">
                            <label for="">创建日期</label>
                            <input type="text" name="created_at_start" id="created_at_start" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                            -
                            <input type="text" name="created_at_end" id="created_at_end" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <label for="">更新人</label>
                            <input type="text" name="update_admin_name" id="update_admin_name">
                        </td>
                        <td class="">
                            <label for="">更新日期</label>
                            <input type="text" name="updated_at_start" id="updated_at_start" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                            -
                            <input type="text" name="updated_at_end" id="updated_at_end" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <button id="merchant_account_list_queryBtn" type="button" class="btn btn-default" data-icon="search" data-toggle="">搜索</button>
                        </td>
                        {{--<td colspan="3">--}}
                            {{--<div class="alert alert-warning form-inline"><i class="fa fa-warning"></i> <strong>Class说明：</strong>JS会为text或textarea自动加上Class[form-control]。</div>--}}
                        {{--</td>--}}
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </form>
    <br />
    <div id="merchant_account_table_tool" class="btn-group">
        {{--<button type="button" class="btn btn-green" >  新增</button>--}}
        <button type="button" class="btn btn-blue" data-icon="plus" onclick="openAddMerchantAccount();"><i class="fa fa-plus"></i> 新增</button>
        <button type="button" class="btn btn-orange" data-icon="undo" onclick="resetMerchantAccountPasswd();"><i class="fa fa-undo"></i> 重置密码</button>
    </div>
    <div style="padding:15px; height:100%;width:99.8%" >

        <table id="merchant_account_table"   data-toggle="datagrid" data-options="{
            gridTitle:'商家账号列表',
            showToolbar: true,
			toolbarCustom: $('#merchant_account_table_tool'),
			filterThead: false,
			columns: [
                {name:'id', width: 100,align:'center',label:'ID',hide:'false'},
                {name:'username', width: 150,align:'center',label:'账户名称'},
                {name:'merchant_name', width: 150,align:'center',label:'归属商家'},
                {name:'status_name', width: 100,align:'center',label:'归属商家状态'},
                {name:'username', width: 150,align:'center',label:'操作',hide:'false'},
                {name:'merchant_code', width:250,align:'center',label:'商家编码'},
                {name:'full_address', width: 150,align:'center',label:'商家地址'},
                {name:'user_status_name', width: 100,align:'center',label:'状态'},
                {name:'sms_balance', width: 100,align:'center',label:'短信余量'},
                {name:'username', width: 150,align:'center',label:'当面支付是否开通',hide:'false'},
                {name:'add_admin', width: 150,align:'center',label:'创建人'},
                {name:'user_created_at', width: 150,align:'center',label:'创建时间'},
                {name:'last_update_admin', width: 150,align:'center',label:'更新人'},
                {name:'last_update_created_at', width: 150,align:'center',label:'更新时间'},
			],
			dataUrl: 'api/merchantAccount/index',
			editUrl: 'api/merchant',
			delUrl : 'api/merchant/delOrder',
			paging: {total:50, pageSize:20},
			editMode: 'dialog',
			editDialogOp: {width:500, mask:false},
			inlineEditMult: false,
			showEditbtnscol: false,
			showCheckboxcol: true,
			fullGrid: true,
			delPK:'id',
			height:550,
			width:'100',
            linenumberAll:true,
            showLinenumber:true,
			contextMenuB: false}">
        </table>
    </div>
</div>

<script>

    $(function(){
        $.CurrentNavtab.find('#merchant_account_list_queryBtn').click(function(){
            var a_merchant_id = $.CurrentNavtab.find('#a_merchant_id').val();
            var merchant_code = $.CurrentNavtab.find('#merchant_code').val();
            var status = $.CurrentNavtab.find('#status').val();
            var address_detail = $.CurrentNavtab.find('#address_detail').val();
            var add_admin_name = $.CurrentNavtab.find('#add_admin_name').val();
            var created_at_start = $.CurrentNavtab.find('#created_at_start').val();
            var created_at_end = $.CurrentNavtab.find('#created_at_end').val();

            var update_admin_name = $.CurrentNavtab.find('#update_admin_name').val();
            var updated_at_start = $.CurrentNavtab.find('#updated_at_start').val();
            var updated_at_end = $.CurrentNavtab.find('#updated_at_end').val();

            var options = {
                dataUrl:'api/merchantAccount/index',
                loadType: 'POST',
                postData : {
                    a_merchant_id: a_merchant_id,
                    merchant_code: merchant_code,
                    status: status,
                    address_detail: address_detail,
                    add_admin_name: add_admin_name,
                    created_at_start: created_at_start,
                    created_at_end: created_at_end,
                    update_admin_name: update_admin_name,
                    updated_at_start: updated_at_start,
                    updated_at_end: updated_at_end
                },
            };
            console.log(options);
            $.CurrentNavtab.find('#merchant_account_table').datagrid('reload', options);
        });
    });

    //打开新增商家账号弹层窗口
    function openAddMerchantAccount() {
        BJUI.dialog({
            id:'openAddMerchantAccount',
            url:'merchantAccount',
            title:'新增商家账号',
            height: 220
        })
    }

    //重置商家登录密码
    function resetMerchantAccountPasswd(){
        //获得勾选数据
        var selectedData = $('#merchant_account_table').data('selectedDatas');
        if(!selectedData){
            BJUI.alertmsg('error', "您需要勾选一条记录！");return ;
        }
        BJUI.alertmsg('confirm', '确认重置密码？',{
            okCall: function () {
                var uid_arr = [];
                for(var k in selectedData){
                    if(!isNaN(k)){//过滤
                        var d = selectedData[k];
                        uid_arr.push(d.uid);
                    }
                }
                $.ajax({
                    type: 'POST',
                    url: 'api/merchantAccount/resetPasswd',
                    data:  {uid:uid_arr},
                    dataType: 'JSON',
                    success:function(res){
                        if(res.error) return $(this).alertmsg('error', res.message);
                        $(this).alertmsg('ok', res.message);
                        $('#merchant_account_table').datagrid('refresh');//刷新数据列表
                    },
                    timeout: 30000//30秒
                });
            }
        })
    }
</script>