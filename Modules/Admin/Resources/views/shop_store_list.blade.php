<div class="bjui-pageContent">
    <form action="" id="store_list_serarch_form">
        <fieldset>
            <legend>搜索条件</legend>
            <table class="table table-condensed table-hover">
                <tbody>
                    <tr>
                        <td colspan="2">
                            <label>地址信息</label>
                            <select name="provincecode" data-toggle="selectpicker" data-nextselect="#j_form_city1" data-refurl="/api/areas/list?parent_id={value}">
                                <option value="" selected>--省市--</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            <select name="citycode" id="j_form_city1" data-toggle="selectpicker"  data-nextselect="#j_form_area1" data-refurl="/api/areas/list?parent_id={value}" data-emptytxt="--城市--">
                                <option value="0">--城市--</option>
                            </select>
                            <select name="areacode" id="j_form_area1" data-toggle="selectpicker"  data-emptytxt="--区县--">
                                <option value="0">--区县--</option>
                            </select>
                        </td>
                        <td>
                            <label>门店状态</label>
                            <select name="store_status" >
                                <option value="">--请选择--</option>
                                <option value="1">签约</option>
                                <option value="2">新增</option>
                                <option value="3">取消</option>
                                <option value="4">冻结</option>
                            </select>
                        </td>
                        <td>
                            <label>机构类型</label>
                            <select name="organization_type" >
                                <option value="">--请选择--</option>
                                <option value="1">药店</option>
                                <option value="2">医疗机构</option>
                                <option value="3">其他企业</option>
                            </select>
                        </td>
                        <td colspan="2">
                            <label>经营方式</label>
                            <select name="manage_type" >
                                <option value="">--请选择--</option>
                                <option value="1">连锁</option>
                                <option value="2">非连锁</option>
                            </select>
                        </td>
                        {{--<td>--}}
                            {{--<label>档案类型</label>--}}
                            {{--<select name="manage_type" >--}}
                                {{--<option value="">--请选择--</option>--}}
                                {{--<option value="1">加盟</option>--}}
                                {{--<option value="2">注册</option>--}}
                            {{--</select>--}}
                        {{--</td>--}}
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>商家名称</label>
                            <input type="text" name="a_merchant_name" id="">
                        </td>
                        <td colspan="2">
                            <label>签约人</label>
                            <input type="text" name="contractor" id="">
                        </td>
                        <td colspan="2">
                            <label>门店联系人</label>
                            <input type="text" name="store_contacts" id="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>门店编码</label>
                            <input type="text" name="store_code" id="">
                        </td>
                        <td colspan="2">
                            <label>门店名称</label>
                            <input type="text" name="storename" id="">
                        </td>
                        <td colspan="2">
                            <label>门店简称</label>
                            <input type="text" name="store_short_name" id="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label>营业执照号</label>
                            <input type="text" name="business_license_num" id="">
                        </td>
                        <td colspan="3">
                            <label>药品经营许可证号</label>
                            <input type="text" name="drug_license_num" id="">
                        </td>
                        <td colspan="2">
                        <label>合同编号</label>
                        <input type="text" name="contract_num" id="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label>药证截止日期</label>
                            <input type="text" name="search_drug_license_start_time" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd">
                            -
                            <input type="text" name="search_drug_license_end_time" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd">
                        </td>
                        <td colspan="3">
                            <label>合同有效日期</label>
                            <input type="text" name="search_contract_start_time" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd">
                            -
                            <input type="text" name="search_contract_end_time" value="" data-toggle="datepicker" data-pattern="yyyy-MM-dd">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align: center">
                            <button type="submit" class="btn btn-default" data-icon="search" data-toggle="">搜索</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </form>

    <br />
    <div id="shopstore_list_table_tool" class="btn-group">
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'shop_store', url:'/shop_store', title:'添加门店'}" onclick="BJUI.URLDATA.shop_store={}">  添加门店</button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  onclick="openEditShopStore()">  修改门店</button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  onclick="openSigning()">  门店签约</button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  onclick="openCancelSigning()"> 取消签约</button>
        {{--<button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/shop_store', title:'导入'}"> 导入</button>--}}
        {{--<button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/shop_store', title:'门店档案导出'}">门店档案导出</button>--}}
    </div>
    <div style="padding:15px; height:100%;width:99.8%" >
        <table id="shop-store-table"   data-toggle="datagrid" data-options="{
            gridTitle:'门店列表',
             showToolbar: true,
            toolbarCustom: $('#shopstore_list_table_tool'),
            filterThead: false,
            columns: [
                {name:'id', width: 100,align:'center',label:'ID',hide:'false'},
                {name: 'a_merchant_id_name', width: 70, align:'center', label: '商家名称'},
                {name:'shop_code', width: 150,align:'center',label:'门店编码'},
                {name:'erp_shop_code', width: 150,align:'center',label:'ERP端门店编码'},
                {name: 'store_short_name', width: 70, align:'center', label: '门店简称'},
                {name: 'storename', width: 70, align:'center', label: '门店名称'},
                {name: 'store_contacts', width: 70, align:'center', label: '门店联系人'},
                {name: 'store_phone', width: 70, align:'center', label: '门店联系方式'},
                {name: 'store_status_name', width: 70, align:'center', label: '门店状态'},
                {name: 'province_name', width: 150, align:'center', label: '省'},
                {name: 'city_name', width: 180, align:'center', label: '市'},
                {name: 'area_name', width: 180, align:'center', label: '区'},
                {name: 'manage_type_name', width: 70, align:'center', label: '经营方式'},
                {name: 'organization_type_name', width: 70, align:'center', label: '机构类型'},
                {name: 'contract_num', width: 70, align:'center', label: '合同编号'},
                {name: 'contract_operator', width: 70, align:'center', label: '签约人'},
                {name: 'contract_time', width: 70, align:'center', label: '签约时间'},
                {name: 'contract_cancel_operator', width: 70, align:'center', label: '取消签约人'},
                {name: 'contract_cancel_time', width: 70, align:'center', label: '取消签约时间'},
                {{--{name: 'adid', width: 120,label:'操作',align:'center',render: operating},--}}
                ],
                dataUrl: 'api/shop_store/index',
                editUrl: 'api/shop_store',
                delUrl : 'api/merchant/delOrder',
                paging: {total:50, pageSize:10},
                editMode: 'dialog',
                editDialogOp: {width:500, height:180, mask:false},
                inlineEditMult: false,
                showEditbtnscol: false,
                showCheckboxcol: true,
                fullGrid: false,
                delPK:'id',
                height:350,
                width:'100',
                linenumberAll:true,
                showLinenumber:true,
                contextMenuB: false}">
        </table>
    </div>
</div>

<script>
    $.CurrentNavtab.find('#store_list_serarch_form').on('submit',function(event){
        var post_data = $.CurrentNavtab.find('#store_list_serarch_form').serializeArray();
        console.log(post_data);
        var options = {
            dataUrl: 'api/shop_store/index',
            postData: {post_data: post_data}
        };
        $.CurrentNavtab.find('#shop-store-table').datagrid('reload', options);
        event.preventDefault();
    });

    //创建申请表后回调-刷新列表
    function cardlist_refreshApplyTable(){
        // $('#adlist-table').datagrid('refresh');
    }

    function openEditShopStore() {
        //获得勾选数据
        var selectedData = $('#shop-store-table').data('selectedDatas');
        if(!selectedData || selectedData.length == 0){
            BJUI.alertmsg('error', "您需要勾选一条记录！");return ;
        }
        if(selectedData.length>1){
            BJUI.alertmsg('error', "您只能勾选一条记录进行编辑！");return ;
        }
        var id = selectedData[0]['id'];
        BJUI.URLDATA.shop_store = {id: id};
        BJUI.navtab({
            id:'openEditShopStore',
            url:'shop_store',
            title:'编辑门店'
        })
    }
    
    function openSigning() {
        //获得勾选数据
        var selectedData = $('#shop-store-table').data('selectedDatas');
        if(!selectedData || selectedData.length == 0){
            BJUI.alertmsg('error', "您需要勾选一条记录！");return ;
        }
        if(selectedData.length>1){
            BJUI.alertmsg('error', "您只能勾选一条记录进行编辑！");return ;
        }
        var id = selectedData[0]['id'];
        var _tmp_store_status = selectedData[0]['store_status'];

        if(_tmp_store_status != 2)
        {
            BJUI.alertmsg('error', "选择的记录的门店状态不能进行签约！");return ;
        }
        if(selectedData.length > 0)
        {
            BJUI.URLDATA.shop_store = {id: id};
            BJUI.navtab({
                id:'openSigning',
                url:'shop_store_signing',
                title:'门店签约'
            })
        }
    }
    
    function openCancelSigning() {
        //获得勾选数据
        var selectedData = $('#shop-store-table').data('selectedDatas');
        if(!selectedData || selectedData.length == 0){
            BJUI.alertmsg('error', "您需要勾选一条记录！");return ;
        }

        var _tmp_info = [];
        for(var i = 0 ; i < selectedData.length ; i ++){
            if(selectedData[i].store_status == 1)
            {
                _tmp_info[i] = selectedData[i];
            }
        }

        if(_tmp_info.length <= 0)
        {
            BJUI.alertmsg('error', "您选择的记录中没有可以取消合约的数据！");return ;
        }

        BJUI.alertmsg('confirm', '确认取消签约吗？',{
            okCall: function () {
                if(_tmp_info.length > 0)
                {
                    post_data = JSON.stringify(_tmp_info);
                    var oo = {
                        url : '/api/shop_store/cancel',
                        loadingmask:true,
                        data : {'info':post_data},
                        callback:function(res){
                            if(res.errors) {
                                return $(this).alertmsg('error', res.message)
                            }
                            $(this).alertmsg('info', res.message, {
                                autoClose:false,
                                okCall: function () {
                                    $.CurrentNavtab.navtab('close');
                                    $('#shop-store-table').datagrid('refresh');//刷新数据列表
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
                }
            }
        });
    }
</script>