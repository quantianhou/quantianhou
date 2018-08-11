<style>
    label.x85 {
        display: inline-block;
        width: 70px !important;
        padding-right: 5px;
    }
</style>
<script type="text/javascript">
    //刷新
    function refresh(){
        $(this).navtab('refresh');
    }

    //编辑
    function editline() {
        var choose = $('#goods_list').data('selectedDatas');
        console.log(choose);
    }

</script>
<div class="bjui-pageContent">
    <form action="" id="merchant_serarch_form">
        <fieldset>
            <legend>搜索</legend>
            <table class="table table-condensed table-hover">
                <tbody>
                <tr>
                    <td>
                        <label for="single_name" class="control-label x85">商品编码：</label>
                        <input type="text" name="goods[sn]" id="sn" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">编码区间：</label>
                        <input type="text" name="goods[name]" id="name" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85" style="text-align: center;">~</label>
                        <input type="text" name="goods[single_name]" id="single_name" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">商品名称：</label>
                        <input type="text" name="goods[name]" id="name" value="">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="single_name" class="control-label x85">品牌名称：</label>
                        <input type="text" name="goods[sn]" id="sn" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">国际码：</label>
                        <input type="text" name="goods[name]" id="name" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">批准文号：</label>
                        <input type="text" name="goods[single_name]" id="single_name" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">生产企业：</label>
                        <input type="text" name="goods[name]" id="name" value="">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="single_name" class="control-label x85">成分编码：</label>
                        <input type="text" name="goods[sn]" id="sn" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">成分名称：</label>
                        <input type="text" name="goods[name]" id="name" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">类别编码：</label>
                        <input type="text" name="goods[single_name]" id="single_name" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">类别名称：</label>
                        <input type="text" name="goods[name]" id="name" value="">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="single_name" class="control-label x85">微商图片：</label>
                        <select name="goods[brand]" id="brand" data-toggle="selectpicker" data-width="150">
                            <option value="">全部</option>
                            <option value="1">有</option>
                            <option value="2">无</option>
                        </select>
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">商品详情：</label>
                        <select name="goods[brand]" id="brand" data-toggle="selectpicker" data-width="150">
                            <option value="">全部</option>
                            <option value="1">有</option>
                            <option value="2">无</option>
                        </select>
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">显示名称：</label>
                        <input type="text" name="goods[single_name]" id="single_name" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">&nbsp;</label>
                        <button id="goodlist" type="button" class="btn btn-default" data-icon="search" data-toggle="">搜索</button>
                    </td>
                </tr>

                </tbody>
            </table>
        </fieldset>

    </form>

    <br />
    <div id="goods_nav">
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/merchant', title:'新增商品'}">新增</button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/merchant', title:'新增商品'}">删除</button>
        <button type="button" class="btn btn-green" onclick="editline()">修改</button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/merchant', title:'新增商品'}">导入</button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/merchant', title:'新增商品'}">基本信息导出</button>
        <button type="button" class="btn btn-green" data-toggle="navtab"  data-options="{id:'test_navtab1', url:'/merchant', title:'新增商品'}">扩展信息导出</button>
    </div>
    <div style="padding:15px; height:100%;width:99.8%" >

        <table id="goods_list" data-toggle="datagrid" data-options="{
            gridTitle:'商品列表',
			showToolbar: true,
			toolbarCustom: $('#goods_nav'),
			filterThead: false,
			columns: [
                {name:'id', width: 100,align:'center',label:'ID',hide:'false'},
                {name:'merchant_code', width: 150,align:'center',label:'商家编码'},
                {name: 'merchant_name', width: 150, align:'center', label: '查看图片'},
                {name: 'merchant_name', width: 150, align:'center', label: '商品名称'},
                {name: 'merchant_name', width: 150, align:'center', label: '显示名称'},
                {name: 'merchant_name', width: 150, align:'center', label: '规格'},
                {name: 'merchant_name', width: 150, align:'center', label: '品牌名称'},
                {name: 'merchant_name', width: 150, align:'center', label: '国际条形码'},
                {name: 'merchant_name', width: 150, align:'center', label: '批准文号'},
                {name: 'merchant_name', width: 150, align:'center', label: '生产企业'},
                {name: 'merchant_name', width: 150, align:'center', label: '产地'},
                {name: 'merchant_name', width: 150, align:'center', label: '成分编码'},
                {name: 'merchant_name', width: 150, align:'center', label: '类别编码'},
                {name: 'merchant_name', width: 150, align:'center', label: '类别名称'},
                {name: 'merchant_name', width: 150, align:'center', label: '操作人'},
                {name: 'merchant_name', width: 150, align:'center', label: '操作时间'},
			],
			dataUrl: 'api/merchants/index',
			paging: {total:50, pageSize:20},
			showCheckboxcol: true,
			fullGrid: false,
			height:550,
			width:'100',
            linenumberAll:true,
            showLinenumber:true,
			contextMenuB: false}">
        </table>
    </div>
</div>

