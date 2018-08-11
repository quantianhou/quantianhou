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
    <form action="" id="merchant_serarch_form">
        <fieldset>
            <legend>文本框</legend>
            <table class="table table-condensed table-hover">
                <tbody>
                <tr>
                    <td>
                        <input type="text" name="goods[sn]" id="sn" value="" data-rule="required">
                    </td>
                    <td>
                        <input type="text" name="goods[name]" id="name" value="" data-rule="required">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">通用名称：</label>
                        <input type="text" name="goods[single_name]" id="single_name" value="" data-rule="required">
                    </td>
                </tr>
                <tr>
                    <td><input type="text" class="input-sm" value="小尺寸文本框"></td>
                    <td>input-sm</td>
                    <td></td>
                </tr>
                <tr>
                    <td><input type="text" class="input-nm" value="稍大尺寸文本框"></td>
                    <td>input-nm</td>
                    <td></td>
                </tr>
                <tr>
                    <td><input type="text" class="input-lg" value="较大尺寸文本框"></td>
                    <td>input-lg</td>
                    <td></td>
                </tr>
                <tr>
                    <td><input type="text" value="固定尺寸的普通文本框" size="30"></td>
                    <td></td>
                    <td>size="30"</td>
                </tr>
                <tr>
                    <td><input type="text" value="只读文本框" size="30" readonly></td>
                    <td></td>
                    <td>size="30" readonly</td>
                </tr>
                <tr>
                    <td><input type="text" value="已禁用的文本框" size="30" disabled></td>
                    <td></td>
                    <td>size="30" disabled</td>
                </tr>
                <tr>
                    <td><textarea>普通多行文本框</textarea></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><textarea cols="30">固定尺寸的普通多行文本框</textarea></td>
                    <td></td>
                    <td>cols="30"</td>
                </tr>
                <tr>
                    <td><textarea cols="30" rows="1" data-toggle="autoheight">自动调整高度的多行文本框</textarea></td>
                    <td></td>
                    <td>cols="30" rows="1" data-toggle="autoheight"</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="alert alert-warning form-inline"><i class="fa fa-warning"></i> <strong>Class说明：</strong>JS会为text或textarea自动加上Class[form-control]。</div>
                    </td>
                </tr>
                </tbody>
            </table>
        </fieldset>

    </form>

    <br />
    <div style="margin:10px 0px 0px 17px;" id="adpositiontList_services">
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/merchant', title:'添加商家'}">  添加商家</button>
    </div>
    <input type="hidden" id="city_id" name="city_id" />
    <div style="padding:15px; height:100%;width:99.8%" >

        <table id="merchant-table"   data-toggle="datagrid" data-options="{
            gridTitle:'商家列表',
			toolbarCustom: $('#addQuestionBtn'),
			filterThead: false,
			columns: [
                {name:'id', width: 100,align:'center',label:'ID',hide:'false'},
                {name:'merchant_code', width: 150,align:'center',label:'商家编码'},
                {name: 'merchant_name', width: 150, align:'center', label: '商家名称'},
                {name: 'merchant_short_name', width: 180, align:'center', label: '商家简称'},
                {name: 'merchant_contacts', width: 180, align:'center', label: '商家联系人'},
                {name: 'merchant_phone', width: 70, align:'center', label: '联系电话'},
                {name: 'manage_type_name', width: 70, align:'center', label: '经营方式'},
                {name: 'merchant_type_name', width: 70, align:'center', label: '商家类型'},
                {name: 'manage_type', width: 70, align:'center', label: '档案类型'},
                {name: 'status_name', width: 70, align:'center', label: '状态'},
                {name: 'manage_type', width: 70, align:'center', label: '审核意见'},
                {name: 'manage_type', width: 70, align:'center', label: '合同编号'},
                {name: 'manage_type', width: 70, align:'center', label: '签约人'},
                {name: 'manage_type', width: 70, align:'center', label: '签约时间'},
                {name: 'manage_type', width: 70, align:'center', label: '取消签约人'},
                {name: 'manage_type', width: 70, align:'center', label: '取消签约时间'},
                {name: 'manage_type', width: 70, align:'center', label: '合同有效期'},
                {name: 'adid', width: 120,label:'操作',align:'center',render: operating},
			],
			dataUrl: 'api/merchants/index',
			hiddenFields : 'id',
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



