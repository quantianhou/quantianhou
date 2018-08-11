<script type="text/javascript">
    $(function(){
        $.CurrentNavtab.find('#adpositionList_queryBtn').click(function(){
            var adpid=$("#adpid").val();
            var options = {
                dataUrl:'api/adPosition/searchFor',
                postData:{
                    city_id:$.CurrentNavtab.find('#city_id').val(),
                    adpid:adpid,
                },
                clearOldPostData:false
            };
            $.CurrentNavtab.find('#adlist-table').datagrid('reload', options);
        });
    });

    //编辑删除
    function operating(value){
        var signStr = '';
        signStr += '<button type="button" class="btn btn-green" data-fresh="true" data-toggle="navtab"  data-id="advertising_PositionUpdate" data-url="adEdit.html" onclick="BJUI.URLDATA.ad={id:'+value+'}" data-title="广告编辑" data-icon="">编辑</button>';
        signStr += '&nbsp;&nbsp;<button type="button" class="btn btn-green" data-toggle="doajax" data-callback="refresh" data-confirm-msg="确定要删除吗？" data-id="lockadmin" data-url="/api/adPosition/deleteAd/id/' +value+'">删除</button>';
        return signStr;
    }

    //刷新
    function refresh(){
//        $(this).navtab('refresh');
        $.CurrentNavtab.find('#adpositionList_queryBtn').click();
    }

</script>
<div class="bjui-pageContent">
    <form action="" id="shop_store_serarch_form">
        <div class="row-input">
            <select name="address_province" data-toggle="selectpicker" data-rule="required" data-nextselect="#j_form_city1" data-refurl="/api/areas/list?parent_id={value}">
                <option value="" selected>--省市--</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}" selected="">{{ $province->name }}</option>
                @endforeach
            </select>
            <select name="address_city" id="j_form_city1" data-toggle="selectpicker"  data-rule="required" data-nextselect="#j_form_area1" data-refurl="/api/areas/list?parent_id={value}" data-emptytxt="--城市--">
                <option value="">--城市--</option>
            </select>
            <select name="address_district" id="j_form_area1" data-toggle="selectpicker"  data-emptytxt="--区县--">
                <option value="">--区县--</option>
            </select>
        </div>
        <div class="">
            <select name="merchant_type" >
                <option value="" selected>商家类型</option>
                <option value="1">公司</option>
                <option value="2">个人</option>
            </select>
        </div>
        <div class="">
            <select name="status" >
                <option value="" selected>状态</option>
                <option value="1">新增</option>
                <option value="2">取消</option>
                <option value="3">签约</option>
                <option value="4">冻结</option>
            </select>
        </div>

        <div class="">
            <label for="">签约时间</label>
            <input type="text" name="created_at" value="2018-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
            -
            <input type="text" name="created_at" value="2018-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
        </div>


        <div class="">
            <label for="">门店编码</label>
            <input type="text" name="merchant_code" id="">
        </div>


        <div class="">
            <label for="">门店名称</label>
            <input type="text" name="merchant_code" id="">
        </div>

        <div class="">
            <label for="">门店简称</label>
            <input type="text" name="merchant_code" id="">
        </div>
        <div class="">
            <label for="">门店联系人</label>
            <input type="text" name="merchant_code" id="">
        </div>


        <div class="">
            <label for="">商家名称</label>
            <input type="text" name="merchant_name" id="">

        </div>

        <div class="">
            <label for="">签约人 ---------</label>
            <input type="text" name="merchant_code" id="">
        </div>

        <div class="">
            <label for="">营业执照号</label>
            <input type="text" name="business_license_num" id="">
        </div>

        <div class="">
            <label for="">药品经营许可证号</label>
            <input type="text" name="drug_license_expriy_date" id="">
        </div>

        <div class="">
            <label for="">合同编号</label>
            <input type="text" name="merchant_code" id="">
        </div>

        <div class="">
            <select name="manage_type" >
                <option value="" selected>机构类型</option>
                <option value="1">药店</option>
                <option value="2">医疗机构</option>
            </select>
        </div>
        <div class="">
            <select name="manage_type" >
                <option value="" selected>经营方式</option>
                <option value="1">连锁</option>
                <option value="2">非连锁</option>
            </select>
        </div>

        <div class="">
            <select name="merchant_type" >
                <option value="" selected>档案类型</option>
                <option value="1">加盟</option>
                <option value="2">注册</option>
            </select>
        </div>

        <div class="">
            <label for="">药证截止日期</label>
            <input type="text" name="drug_license_expriy_date_at" value="2018-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
            -
            <input type="text" name="drug_license_expriy_date_end" value="2018-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
        </div>

        <div class="">
            <label for="">合同有效日期</label>
            <input type="text" name="drug_license_expriy_date_at" value="2018-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
            -
            <input type="text" name="drug_license_expriy_date_end" value="2018-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
        </div>
        <div class="">
            <button id="adpositionList_queryBtn" type="submit" class="btn btn-default" data-icon="search" data-toggle="">搜索</button>
        </div>

    </form>

    <br />
    <div style="margin:10px 0px 0px 17px;" id="adpositiontList_services">
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/shop_store', title:'添加门店'}">  添加门店</button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/shop_store', title:'添加门店'}"> 取消签约</button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/shop_store', title:'添加门店'}"> 导入</button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/shop_store', title:'添加门店'}">门店档案导出</button>
    </div>
    <input type="hidden" id="city_id" name="city_id" />
    <div style="padding:15px; height:100%;width:99.8%" >

        <table id="shop_store_serarch_form-table"   data-toggle="datagrid" data-options="{
            gridTitle:'商家列表',
			toolbarCustom: $('#addQuestionBtn'),
			filterThead: false,
			columns: [
                {name:'id', width: 100,align:'center',label:'ID',hide:'false'},
                {name:'shop_code', width: 150,align:'center',label:'门店编码'},
                {name: 'province_name', width: 150, align:'center', label: '省'},
                {name: 'city_name', width: 180, align:'center', label: '市'},
                {name: 'area_name', width: 180, align:'center', label: '区'},
                {name: 'merchant_name', width: 70, align:'center', label: '商家名称'},
                {name: 'storename', width: 70, align:'center', label: '门店名称'},
                {name: 'store_short_name', width: 70, align:'center', label: '门店简称'},
                {name: 'store_contacts', width: 70, align:'center', label: '门店联系人'},
                {name: 'store_phone', width: 70, align:'center', label: '门店联系方式'},
                {name: 'manage_type', width: 70, align:'center', label: '经营方式'},
                {name: 'organization_type', width: 70, align:'center', label: '机构类型'},
                {name: 'manage_type', width: 70, align:'center', label: '档案类型'},
                {name: 'manage_type', width: 70, align:'center', label: '状态'},
                {name: 'manage_type', width: 70, align:'center', label: '合同编号'},
                {name: 'manage_type', width: 70, align:'center', label: '签约人'},
                {name: 'manage_type', width: 70, align:'center', label: '签约时间'},
                {name: 'manage_type', width: 70, align:'center', label: '取消签约人'},
                {name: 'manage_type', width: 70, align:'center', label: '取消签约时间'},
                {name: 'manage_type', width: 70, align:'center', label: '取消签约时间'},
                {name: 'manage_type', width: 70, align:'center', label: '冻结原因'},
                {name: 'adid', width: 120,label:'操作',align:'center',render: operating},
			],
			dataUrl: 'api/shop_store/index',
			editUrl: 'api/merchant',
			delUrl : 'api/merchant/delOrder',
			paging: {total:50, pageSize:20},
			editMode: 'dialog',
			editDialogOp: {width:500, height:180, mask:false},
			inlineEditMult: false,
			showEditbtnscol: false,
			fullGrid: false,
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


    $.CurrentNavtab.find('#shop_store_serarch_form').on('submit',function(){
        var post_data = $.CurrentNavtab.find('#shop_store_serarch_form').serialize();
        console.log(post_data);

        var options = {
            dataUrl: 'ap/shop_store/index',
            postData: post_data
        };


        $.CurrentNavtab.find('#shop_store_serarch_form').datagrid('reload', options)

    });


    if(0){
        $.CurrentNavtab.find('.box_center').css('display','block');
    }else{
        $.CurrentNavtab.find('.box_center').css('display','none');
    }


    //手动排序显示
    function adorderby(json){
        var operating ='<input id="ordernumber" style="width:50px;" type="text" value="">&nbsp;&nbsp;'+
            '<button type="button" class="btn btn-green" data-fresh="true" data-toggle="navtab" onclick="getAllOrder(this,'+json+')" data-id="rbac_role" data-title="确定" data-icon="">确定</button>';
        return operating;
    }
    //点击确定后更新排序
    function getAllOrder(obj,adid){
        //获取排序的新值
        var ordernumber= $(obj).siblings('#ordernumber').val();
        $.ajax({
            type: 'POST',
            url: 'api/adPosition/adUpdateSort',
            data:  {ordernumber:ordernumber,adid:adid},
            dataType: 'JSON',
            success:function(res){
                if(res.error) return $(this).alertmsg('info', res.info);
                $(this).alertmsg('info', res.info);
                cardlist_refreshApplyTable(0);
            },
            error : function(){

            },
            timeout: 30000//30秒
        });
    }
    //创建申请表后回调-刷新列表
    function cardlist_refreshApplyTable(){
        $('#adlist-table').datagrid('refresh');
    }
</script>

<script type="text/javascript">
    function adaddhtml(obj) {
        adpid=$("#adpid").val();
        $(document).navtab({id:'mydialog', url:'adAdd.html', title:'广告添加'});
    }
</script>



