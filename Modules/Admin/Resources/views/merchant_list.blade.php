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
    <div style="margin:10px 0px 0px 17px;">
        <p><label class="x90">请选择广告位：</label>&nbsp;<span data-toggle="autoajaxload" class="v2getadPositionSelect" data-url="/api/adPosition/getadPosition"></span>&nbsp;&nbsp;&nbsp;
            <button id="adpositionList_queryBtn" type="button" class="btn btn-default" data-icon="search" data-toggle="">搜索</button></p><br/>
    </div>
    <br />
    <div style="margin:10px 0px 0px 17px;" id="adpositiontList_services">
        <button type="button" class="btn btn-green"  onclick="adaddhtml(this)"  >添加广告位</button>
    </div>
    <input type="hidden" id="city_id" name="city_id" />
    <div style="padding:15px; height:100%;width:99.8%" >

        <table id="adlist-table"   data-toggle="datagrid" data-options="{
            gridTitle:'广告列表',
			toolbarCustom: $('#addQuestionBtn'),
			filterThead: false,
			columns: [
                {name:'adid', width: 100,align:'center',label:'ID',hide:'false'},
                {name:'adname', width: 150,align:'center',label:'广告名称'},
                {name: 'name', width: 150, align:'center', label: '广告类型'},
                {name: 'startTime', width: 180, align:'center', label: '上展时间'},
                {name: 'endTime', width: 180, align:'center', label: '下展时间'},
                {name: 'show_status', width: 70, align:'center', label: '状态'},
                {name:'orderBy', align:'center', width: 70,label:'排序'},
                {name:'adid',align:'center',width: 120,label:'手动排序',render: adorderby},
                {name: 'adid', width: 120,label:'操作',align:'center',render: operating},
			],
			dataUrl: 'api/adPosition/searchFor',
			hiddenFields : 'id',
			editUrl: 'api/orderlist/updataOrder',
			delUrl : 'api/orderlist/delOrder',
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



