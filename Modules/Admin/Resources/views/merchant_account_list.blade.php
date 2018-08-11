<script type="text/javascript">
    $(function(){
        $.CurrentNavtab.find('#adpositionList_queryBtn').click(function(){
            console.log("qqq");
            var options = {
                dataUrl:'api/merchants/index',
                postData:{
//                    city_id:$.CurrentNavtab.find('#city_id').val(),
                },
                clearOldPostData:false
            };
            $.CurrentNavtab.find('#merchant-table').datagrid('reload', options);
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
            <select name="address_province" data-toggle="selectpicker"  data-nextselect="#j_form_city1" data-refurl="/api/areas/list?parent_id={value}">
                <option value="" selected>--省市--</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}" selected="">{{ $province->name }}</option>
                @endforeach
            </select>
            <select name="address_city" id="j_form_city1" data-toggle="selectpicker" data-nextselect="#j_form_area1" data-refurl="/api/areas/list?parent_id={value}" data-emptytxt="--城市--">
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
                <option value="2">审核</option>
                <option value="3">退回</option>
                <option value="4">通过</option>
                <option value="5">拒绝</option>
                <option value="6">取消</option>
                <option value="7">预约</option>
            </select>
        </div>

        <div class="">
            <label for="">签约时间</label>
            <input type="text" name="created_at" value="2018-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
            -
            <input type="text" name="created_at" value="2018-10-01 10:01:01" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss">
        </div>


        <div class="">
            <label for="">商家编码</label>
            <input type="text" name="merchant_code" id="">
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
            <label for="">商家名称</label>
            <input type="text" name="merchant_name" id="">
        </div>

        <div class="">
            <label for="">合同编号</label>
            <input type="text" name="merchant_code" id="">
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
            <button id="adpositionList_queryBtn" type="button" class="btn btn-default" data-icon="search" data-toggle="">搜索</button>
        </div>

    </form>

    <br />
    <div style="margin:10px 0px 0px 17px;" id="adpositiontList_services">
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/merchant', title:'添加商家'}">  添加商家</button>
    </div>
    <input type="hidden" id="city_id" name="city_id" />
    <div style="padding:15px; height:100%;width:99.8%" >

        <table id="shop-store-table"   data-toggle="datagrid" data-options="{
            gridTitle:'商家列表',
			toolbarCustom: $('#addQuestionBtn'),
			filterThead: false,
			columns: [
                {name:'id', width: 100,align:'center',label:'ID',hide:'false'},
                {name:'username', width: 150,align:'center',label:'账户名称'},
                {name:'merchant_name', width: 150,align:'center',label:'归属商家'},
                {name:'status', width: 150,align:'center',label:'归属商家状态'},
                {name:'username', width: 150,align:'center',label:'操作'},
                {name:'username', width: 150,align:'center',label:'商家编码'},
                {name:'username', width: 150,align:'center',label:'商家地址'},
                {name:'username', width: 150,align:'center',label:'状态'},
                {name:'username', width: 150,align:'center',label:'短信余量'},
                {name:'username', width: 150,align:'center',label:'当面支付是否开通'},
                {name:'username', width: 150,align:'center',label:'创建人'},
                {name:'username', width: 150,align:'center',label:'创建时间'},
                {name:'username', width: 150,align:'center',label:'更新人'},
                {name:'username', width: 150,align:'center',label:'更新时间'},
                {name: 'adid', width: 120,label:'操作',align:'center',render: operating},
			],
			dataUrl: 'api/merchantAccount/index',
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
            dataUrl: 'api/shop_store/index',
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