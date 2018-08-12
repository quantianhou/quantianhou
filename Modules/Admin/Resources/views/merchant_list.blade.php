<div class="bjui-pageContent">
    <form action="" id="merchant_list_serarch_form">
        <fieldset>
            <legend>搜索条件</legend>
            <table class="table table-condensed table-hover">
                <tbody>
                <tr>
                    <td>
                        <label for="">地区</label>
                        <select name="address_province" data-toggle="selectpicker"  data-nextselect="#j_form_city1" data-refurl="/api/areas/list?parent_id={value}">
                            <option value="" selected>--请选择--</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>

                        <select name="address_city" id="j_form_city1" data-toggle="selectpicker" data-nextselect="#j_form_area1" data-refurl="/api/areas/list?parent_id={value}" data-emptytxt="--请选择--">
                            <option value="">--请选择--</option>
                        </select>

                        <select name="address_district" id="j_form_area1" data-toggle="selectpicker"  data-emptytxt="--请选择--">
                            <option value="">--请选择--</option>
                        </select>
                    </td>
                    <td class="">
                        <label for="">商家编码</label>
                        <input type="text" name="merchant_code" id="">
                    </td>
                    <td class="">
                        <label for="">商家名称</label>
                        <input type="text" name="merchant_name" id="">
                    </td>
                </tr>
                <tr>
                    <td class="">
                        <label for="">状态</label>
                        <select name="status"  data-toggle="selectpicker">
                            <option value="" selected>状态</option>
                            <option value="1">新增</option>
                            <option value="2">待审核</option>
                            <option value="3">退回</option>
                            <option value="4">通过</option>
                            <option value="5">拒绝</option>
                            <option value="7">签约</option>
                            <option value="8">取消签约</option>
                        </select>
                    </td>
                    <td class="">
                        <label for="">签约时间</label>
                        <input type="text" name="contract_time_start" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                        -
                        <input type="text" name="contract_time_end" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                    </td>
                    <td class="">
                        <label for="">合同编号</label>
                        <input type="text" name="contract_num" id="">
                    </td>
                </tr>
                <tr>
                    <td class="">
                        <label for="">签约人</label>
                        <input type="text" name="contract_operator" id="">
                    </td>

                    <td class="">
                        <label for="">营业执照号</label>
                        <input type="text" name="business_license_num" id="">
                    </td>

                    <td class="">
                        <label for="">药品经营许可证号</label>
                        <input type="text" name="drug_license_num" id="">
                    </td>
                    <td class="">
                        <label for="">经营方式</label>
                        <select name="manage_type" data-toggle="selectpicker">
                            <option value="" selected>经营方式</option>
                            <option value="1">连锁</option>
                            <option value="2">非连锁</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="">
                        <label for="">商家类型</label>
                        <select name="merchant_type" data-toggle="selectpicker">
                            <option value="" selected>商家类型</option>
                            <option value="1">公司</option>
                            <option value="2">个人</option>
                        </select>
                    </td>
                    <td class="">
                        <label for="">合同有效期</label>
                        <input type="text" name="contract_start_time" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                        -
                        <input type="text" name="contract_end_time" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                    </td>
                    {{--<td class="">--}}
                        {{--<label for="">档案类型</label>--}}
                        {{--<select name="merchant_type" data-toggle="selectpicker">--}}
                            {{--<option value="" selected>档案类型</option>--}}
                            {{--<option value="1">加盟</option>--}}
                            {{--<option value="2">注册</option>--}}
                        {{--</select>--}}
                    {{--</td>--}}
                </tr>
                <tr>
                    <td class="">
                        <label for="">药证截止日期</label>
                        <input type="text" name="drug_license_expriy_date_start" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                        -
                        <input type="text" name="drug_license_expriy_date_end" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
                    </td>
                    <td class="">
                        <button id="merchant_list_queryBtn" type="submit" class="btn btn-default" data-icon="search" data-toggle="">搜索</button>
                    </td>
            </table>
        </fieldset>
    </form>

    <br />
    <div id="merchant_list_table_tool" class="btn-group">
        <button type="button" class="btn btn-blue" data-icon="plus"  data-toggle="navtab"  data-options="{id:'merchant', url:'/merchant', title:'添加商家'}" onclick="BJUI.URLDATA.merchant={}">  新增</button>
        <button type="button" class="btn btn-blue" data-icon="plus"  data-toggle="navtab"  onclick="openEditMerchant()">  修改</button>
        <button type="button" class="btn btn-green"  onclick="applyCheckMerchant()"> 申请审核 </button>
        <button type="button" class="btn btn-green"  onclick="checkMerchant()"> 审核 </button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/merchant', title:''}"> 批量审核 </button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/merchant', title:''}"> 签约 </button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/merchant', title:''}"> 导入 </button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/merchant', title:''}"> 导出商家档案 </button>
    </div>
    <div style="padding:15px; height:100%;width:99.8%" >

        <table id="shop-store-table"   data-toggle="datagrid" data-options="{
            gridTitle:'商家列表',
            showToolbar: true,
			toolbarCustom: $('#merchant_list_table_tool'),
			filterThead: false,
			columns: [
                {name:'id', width: 100,align:'center',label:'ID',hide:'false'},
                {name:'merchant_code', width: 150,align:'center',label:'商家编码'},
                {name:'address_province', width: 150,align:'center',label:'省'},
                {name:'address_city', width: 150,align:'center',label:'市'},
                {name:'address_district', width: 150,align:'center',label:'区'},
                {name: 'merchant_name', width: 150, align:'center', label: '商家名称'},
                {name: 'merchant_short_name', width: 180, align:'center', label: '商家简称'},
                {name: 'merchant_contacts', width: 180, align:'center', label: '商家联系人'},
                {name: 'merchant_phone', width: 70, align:'center', label: '联系电话'},
                {name: 'manage_type_name', width: 70, align:'center', label: '经营方式'},
                {name: 'merchant_type_name', width: 70, align:'center', label: '商家类型'},
                {{--{name: 'manage_type', width: 70, align:'center', label: '档案类型'},--}}
                {name: 'status_name', width: 70, align:'center', label: '状态'},
                {name: 'check_remark', width: 70, align:'center', label: '审核意见'},
                {name: 'contract_num', width: 70, align:'center', label: '合同编号'},
                {name: 'contract_operator', width: 70, align:'center', label: '签约人'},
                {name: 'contract_time', width: 70, align:'center', label: '签约时间'},
                {name: 'contract_cancel_operator', width: 70, align:'center', label: '取消签约人'},
                {name: 'contract_cancel_time', width: 70, align:'center', label: '取消签约时间'},
                {name: 'contract_start_time', width: 70, align:'center', label: '合同有效期'},
                {name: 'contract_end_time', width: 70, align:'center', label: '合同有效期'},
			],
			dataUrl: 'api/merchants/index',
			editUrl: 'api/merchant',
			delUrl : 'api/merchant/delOrder',
			paging: {total:50, pageSize:10},
			editMode: 'dialog',
			editDialogOp: {width:500, height:180, mask:false},
			inlineEditMult: false,
			showEditbtnscol: false,
			showCheckboxcol: true,
			fullGrid: false,
			delPK:'id',
			height:450,
			width:'100',
            linenumberAll:true,
            showLinenumber:true,
			contextMenuB: false}">
        </table>
    </div>
</div>

<script>
    //打开新增商家账号弹层窗口
    function openEditMerchant() {
        //获得勾选数据
        var selectedData = $('#shop-store-table').data('selectedDatas');
        if(!selectedData || selectedData.length == 0){
            BJUI.alertmsg('error', "您需要勾选一条记录！");return ;
        }
        if(selectedData.length>1){
            BJUI.alertmsg('error', "您只能勾选一条记录进行编辑！");return ;
        }
        var id = selectedData[0]['id'];
        BJUI.URLDATA.merchant = {id: id};
        BJUI.navtab({
            id:'openEditMerchant',
            url:'merchant',
            title:'编辑商家'
        })
    }

    //申请审核
    function applyCheckMerchant(){
        //获得勾选数据
        var selectedData = $('#shop-store-table').data('selectedDatas');
        if(!selectedData || selectedData.length == 0){
            BJUI.alertmsg('error', "您需要勾选一条记录！");return ;
        }
        if(selectedData.length>1){
            BJUI.alertmsg('error', "您只能勾选一条记录进行申请审核！");return ;
        }
        BJUI.alertmsg('confirm', '确认提交申请吗？',{
            okCall: function () {
                var id_arr = [];
                for(var k in selectedData){
                    if(!isNaN(k)){//过滤
                        var d = selectedData[k];
                        id_arr.push(d.id);
                    }
                }
                $.ajax({
                    type: 'POST',
                    url: 'api/merchants/applyCheck',
                    data:  {id:id_arr[0]},
                    dataType: 'JSON',
                    success:function(res){
                        if(res.error) return $(this).alertmsg('error', res.message);
                        $(this).alertmsg('ok', res.message);
                        $('#shop-store-table').datagrid('refresh');//刷新数据列表
                    },
                    timeout: 30000//30秒
                });
            }
        })
    }

    //审核
    function checkMerchant(){
        //获得勾选数据
        var selectedData = $('#shop-store-table').data('selectedDatas');
        if(!selectedData || selectedData.length == 0){
            BJUI.alertmsg('error', "您需要勾选一条记录！");return ;
        }
        if(selectedData.length>1){
            BJUI.alertmsg('error', "您只能勾选一条记录进行审核！");return ;
        }
        BJUI.dialog({
            id:'openMerchantCheck',
            url:'merchantCheck',
            title:'审核商家账号',
            height: 220
        })

    }

    $.CurrentNavtab.find('#merchant_list_serarch_form').on('submit',function(event){
        var post_data = $.CurrentNavtab.find('#merchant_list_serarch_form').serializeArray();
        var options = {
            dataUrl: 'api/merchants/index',
            postData: {post_data: post_data}
        };
        $.CurrentNavtab.find('#shop-store-table').datagrid('reload', options);
        event.preventDefault();
    });

    //创建申请表后回调-刷新列表
    function cardlist_refreshApplyTable(){
        $('#adlist-table').datagrid('refresh');
    }
</script>