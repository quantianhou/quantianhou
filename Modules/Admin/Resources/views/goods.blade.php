<style>
    label.x85 {
        display: inline-block;
        width: 70px !important;
        padding-right: 5px;
    }
</style>
<script type="text/javascript">
    //获取两个分类
    var obj = {
        url : '/api/goods/options',
        type : 'POST',
        callback : function (res) {
            for(var i in res.brand){
                $('fieldset #'+res.brand[i].select_name).append('<option value="'+res.brand[i].id+'">'+res.brand[i].select_option+'</option>');
            }

            //category_goods
            for(var i in res.goods){
                if(i >= 0){
                    var prefix = '';
                    for(var j=1;j<res.goods[i].level;j++){
                        prefix += ' -- ';
                    }
                    $('fieldset #category_goods').append('<option value="'+res.goods[i].id+'">'+prefix+res.goods[i].category_name+'</option>');
                }
            }

            $('fieldset select').selectpicker('refresh');
        }
    }
    $(this).bjuiajax('doAjax', obj)
    //刷新
    function refresh(){
        $(this).navtab('refresh');
    }

    //新增
    function addgoods(obj) {

        parent.GID = 0;
        $(obj).navtab({id:'goodsdetail', url:'/goodsdetail', title:'商品编辑'});
    }

    //删除
    function deletegoods(obj) {
        var choose = $('#goods_list').data('selectedDatas');
        var json = {};
        for(var ii in choose){
            json[ii] = choose[ii].id;
        }
        var obj = {
            url : '/api/goods/delete',
            type : 'POST',
            data : {id:json},
            callback : function (res) {
                return $(document).alertmsg('error', '已删除');
            }
        }
        $(this).bjuiajax('doAjax', obj)
    }

    //编辑
    function editline(obj) {
        var choose = $('#goods_list').data('selectedDatas');
        if(choose.length != 1){
            return $(document).alertmsg('error', '请选择一个商品')
        }

        parent.GID = choose[0].id;
        $(obj).navtab({id:'goodsdetail', url:'/goodsdetail', title:'商品编辑'});
    }

    //导入
    function goodsimport(obj) {
        $(obj).navtab({id:'goodsimport', url:'/goodsimport', title:'商品导入'});
    }

    //搜索
    $(function(){
        $.CurrentNavtab.find('#goodlist').click(function(){

            var options = {
                dataUrl:'api/goods/index',
                postData:formJson('#goods_search'),
                clearOldPostData:false
            };
            $.CurrentNavtab.find('#goods_list').datagrid('reload', options);
        });
    });

    function formJson(id) {
        var register =$(id);
        var formData = register.serializeArray();

        //将json数组转为json 对象
        return transformToJson(formData);
    }

    // 转为json数据格式
    function transformToJson(formData){
        var obj={}
        for (var i in formData) {

            obj[formData[i].name]=formData[i]['value'];
        }
        return obj;
    }

</script>
<div class="bjui-pageContent">
    <form action="" id="goods_search">
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
                        <input type="text" name="other[sn_start]" id="sn_start" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85" style="text-align: center;">~</label>
                        <input type="text" name="other[sn_end]" id="sn_end" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">商品名称：</label>
                        <input type="text" name="goods[name]" id="name" value="">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="single_name" class="control-label x85">品牌名称：</label>
                        <select name="goods[brand]" id="brand" data-toggle="selectpicker" data-width="150">
                            <option value="">全部</option>
                        </select>
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">国际码：</label>
                        <input type="text" name="goods[nation_sn]" id="nation_sn" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">批准文号：</label>
                        <input type="text" name="goods[approval_number]" id="approval_number" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">生产企业：</label>
                        <input type="text" name="goods[company]" id="company" value="">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="single_name" class="control-label x85">成分编码：</label>
                        <input type="text" name="goods[category_component_sn]" id="category_component_sn" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">成分名称：</label>
                        <input type="text" name="goods[category_component_name]" id="category_component_name" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">类别编码：</label>
                        <input type="text" name="goods[category_goods_sn]" id="category_goods_sn" value="">
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">类别名称：</label>
                        <select name="goods[category_goods]" id="category_goods" data-toggle="selectpicker" data-width="150">
                            <option value="">全部</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="single_name" class="control-label x85">微商图片：</label>
                        <select name="goods[has_imgaes]" id="has_pic" data-toggle="selectpicker" data-width="150">
                            <option value="">全部</option>
                            <option value="1">有</option>
                            <option value="2">无</option>
                        </select>
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">商品详情：</label>
                        <select name="other[has_desc]" id="has_desc" data-toggle="selectpicker" data-width="150">
                            <option value="">全部</option>
                            <option value="1">有</option>
                            <option value="2">无</option>
                        </select>
                    </td>
                    <td>
                        <label for="single_name" class="control-label x85">显示名称：</label>
                        <input type="text" name="goods[show_name]" id="show_name" value="">
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
        <button type="button" class="btn btn-green" onclick="addgoods(this)">新增</button>
        <button type="button" class="btn btn-green" onclick="deletegoods(this)">删除</button>
        <button type="button" class="btn btn-green" onclick="editline(this)">修改</button>
        <button type="button" class="btn btn-green" onclick="goodsimport(this)">导入</button>
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
                {name:'sn', width: 150,align:'center',label:'商家编码'},
                {name: 'name', width: 150, align:'center', label: '商品名称'},
                {name: 'show_name', width: 150, align:'center', label: '显示名称'},
                {name: 'specifications', width: 150, align:'center', label: '规格'},
                {name: 'brand', width: 150, align:'center', label: '品牌名称'},
                {name: 'nation_sn', width: 150, align:'center', label: '国际条形码'},
                {name: 'approval_number', width: 150, align:'center', label: '批准文号'},
                {name: 'company', width: 150, align:'center', label: '生产企业'},
                {name: 'place', width: 150, align:'center', label: '产地'},
                {name: 'category_component_sn', width: 150, align:'center', label: '成分编码'},
                {name: 'category_goods_sn', width: 150, align:'center', label: '类别编码'},
                {name: 'category_goods_name', width: 150, align:'center', label: '类别名称'},
                {name: 'updated_at', width: 150, align:'center', label: '操作时间'},
			],
			dataUrl: 'api/goods/index',
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

