<style>
    input{
        width: 60% !important;
    }
    input.input30{
        width: 30% !important;
    }
</style>
<div class="bjui-pageContent">
    <form action="/api/goods/save" id="j_form_form" data-callback="checkerror" class="pageForm" data-toggle="validate">
        <input type="hidden" name="goods[id]" value="0" id="goodsid" />
        <div style="margin:15px auto 0; width:100%;">
            <fieldset>
                <legend>选项卡</legend>
                <!-- Tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#home" role="tab" data-toggle="tab">基本信息</a></li>
                    <li><a href="#home2" role="tab" data-toggle="tab">扩展信息</a></li>
                    <li><a href="#messages" role="tab" data-toggle="tab">商品详情</a></li>
                    <li><a href="#settings" role="tab" data-toggle="tab">药物禁忌维护</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="home">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                    <label for="sn" class="control-label x85">商品编码：</label>
                                    <input type="text" name="goods[sn]" id="sn" value="" data-rule="required" size="20">
                                </td>
                                <td>
                                    <label for="name" class="control-label x85">商品名称：</label>
                                    <input type="text" name="goods[name]" readonly id="name" value="" data-rule="required" size="50">
                                </td>
                                <td>
                                    <label for="single_name" class="control-label x85">通用名称：</label>
                                    <input type="text" name="goods[single_name]" id="single_name" value="" data-rule="required" size="50">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="show_name" class="control-label x85">显示名称：</label>
                                    <input type="text" name="goods[show_name]" readonly id="show_name" value="" data-rule="required" size="50">
                                </td>
                                <td>
                                    <label for="nation_sn" class="control-label x85">国际条码：</label>
                                    <input type="text" name="goods[nation_sn]" id="nation_sn" value="" data-rule="required" size="50">
                                </td>
                                <td>
                                    <label for="approval_number" class="control-label x85">批准文号：</label>
                                    <input type="text" name="goods[approval_number]" id="approval_number" value="" data-rule="required" size="50">
                                </td>
                            </tr>
                            <tr>
                                <td style="position: relative;">
                                    <label for="brand" class="control-label x85">品牌名称：</label>
                                    <input type="hidden" name="brand_text" id="brand_text" autocomplete="off" value="">
                                    <input type="hidden" name="goods[brand]" id="brand" autocomplete="off" value="">
                                    <input type="text" name="brand_name" id="brand_name" autocomplete="off">
                                    <ul class="dropdown-menu inner selectpicker" role="menu" style="max-height: 201px; overflow-y: auto; min-height: 24px; left:77px;">
                                        <li data-original-index="0" data-value="" data-text="">
                                            <a tabindex="0" class="">
                                                <span class="text">暂无搜索内容</span>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <label for="company" class="control-label x85">生产企业：</label>
                                    <input type="text" name="goods[company]" id="company" value="" data-rule="required" size="50">
                                </td>
                                <td>
                                    <label for="place" class="control-label x85">产地：</label>
                                    <input type="text" name="goods[place]" id="place" value="" data-rule="required" size="50">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="alias" class="control-label x85">别名：</label>
                                    <input type="text" name="goods[alias]" id="alias" value="" size="50">
                                </td>
                                <td>
                                    <label for="specifications" class="control-label x85">规格：</label>
                                    <input type="text" name="goods[specifications]" id="specifications" value="" data-rule="required" size="50">
                                </td>
                                <td>
                                    <label for="dosage_form" class="control-label x85">剂型：</label>
                                    <select name="goods[dosage_form]" id="dosage_form" data-toggle="selectpicker" data-rule="required">

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="unit" class="control-label x85">单位：</label>
                                    <select name="goods[unit]" id="unit" data-toggle="selectpicker" data-rule="required">

                                    </select>
                                </td>
                                <td colspan="2">
                                    <label for="validity_period" class="control-label x85">有效期：</label>
                                    <input type="text" name="goods[validity_period]" id="validity_period" value="" data-rule="required" size="50">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="has_mhj" class="control-label x85">含麻黄碱：</label>
                                    <select name="goods[has_mhj]" id="has_mhj" data-toggle="selectpicker" data-rule="required">
                                        <option value="2">否</option>
                                        <option value="1">是</option>
                                    </select>
                                </td>
                                <td>
                                    <label for="basic_medicine" class="control-label x85">基药：</label>
                                    <select name="goods[basic_medicine]" id="basic_medicine" data-toggle="selectpicker" data-rule="required">
                                        <option value="2">否</option>
                                        <option value="1">是</option>
                                    </select>
                                </td>
                                <td>
                                    <label for="easy_break" class="control-label x85">易碎易渗漏：</label>
                                    <select name="goods[easy_break]" id="easy_break" data-toggle="selectpicker" data-rule="required">
                                        <option value="2">否</option>
                                        <option value="1">是</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="easy_smell" class="control-label x85">易串味：</label>
                                    <select name="goods[easy_smell]" id="easy_smell" data-toggle="selectpicker" data-rule="required">
                                        <option value="2">否</option>
                                        <option value="1">是</option>
                                    </select>
                                </td>
                                <td>
                                    <label for="curing" class="control-label x85">重点养护：</label>
                                    <select name="goods[curing]" id="curing" data-toggle="selectpicker" data-rule="required">
                                        <option value="2">否</option>
                                        <option value="1">是</option>
                                    </select>
                                </td>
                                <td>
                                    <label for="save_method" class="control-label x85">存储方式：</label>
                                    <select name="goods[save_method]" id="save_method" data-toggle="selectpicker" data-rule="required">

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="component" class="control-label x85">成分名称：</label>
                                    <select name="goods[component]" id="component" data-toggle="selectpicker" data-rule="required">

                                    </select>
                                </td>
                                <td>
                                    <label for="category_goods" class="control-label x85">类别名称：</label>
                                    <select name="goods[category_goods]" id="category_goods" data-toggle="selectpicker" data-rule="required">

                                    </select>
                                </td>
                                <td>
                                    <label for="category_component" class="control-label x85">成分分类名称：</label>
                                    <select name="goods[category_component]" id="category_component" data-toggle="selectpicker" data-rule="required">

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="control_code" class="control-label x85">显示控制码：</label>
                                    <select name="goods[control_code]" id="control_code" data-toggle="selectpicker" data-rule="required">

                                    </select>
                                </td>
                                <td colspan="2">
                                    <label for="service_information" class="control-label x85">是否触发服务信息：</label>
                                    <select name="goods[service_information]" id="service_information" data-toggle="selectpicker" data-rule="required">
                                        <option value="2">否</option>
                                        <option value="1">是</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label for="search_words" class="control-label x85">搜索用词：</label>
                                    <input type="text" name="goods[search_words]" readonly id="search_words" value="" data-rule="required" size="50">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="reference_price" class="control-label x85">参考进价：</label>
                                    <input type="text" name="goods[reference_price]" id="reference_price" value="" size="50">
                                </td>
                                <td>
                                    <label for="selling_price" class="control-label x85">参考售价：</label>
                                    <input type="text" name="goods[selling_price]" id="selling_price" value="" size="50">
                                </td>
                                <td>
                                    <label for="high_price" class="control-label x85">最高限价：</label>
                                    <input type="text" name="goods[high_price]" id="high_price" value="" size="50">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="treatment" class="control-label x85">疗程：</label>
                                    <input type="text" name="goods[treatment]" id="treatment" value="" size="50">
                                </td>
                                <td colspan="2">
                                    <label for="use_time" class="control-label x85">单盒服用天数：</label>
                                    <input class="input30" type="text" name="goods[use_time1]" id="use_time" value="" size="50">
                                    -<input class="input30" type="text" name="goods[use_time2]" id="use_time2" value="" size="50">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="home2">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                    <label for="text_component" class="control-label x85">成分：</label>
                                    <input type="text" name="extra[text_component]" id="text_component" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="main_function" class="control-label x85">主治功能：</label>
                                    <input type="text" name="extra[main_function]" id="main_function" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="usage" class="control-label x85">用法用量：</label>
                                    <input type="text" name="extra[usage]" id="usage" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="untoward_effect" class="control-label x85">不良反应：</label>
                                    <input type="text" name="extra[untoward_effect]" id="untoward_effect" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo" class="control-label x85">禁忌：</label>
                                    <input type="text" name="extra[taboo]" id="taboo" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="attention" class="control-label x85">注意事项：</label>
                                    <input type="text" name="extra[attention]" id="attention" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="drug_women" class="control-label x85">孕妇哺乳期妇女用药：</label>
                                    <input type="text" name="extra[drug_women]" id="drug_women" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="drug_children" class="control-label x85">儿童用药：</label>
                                    <input type="text" name="extra[drug_children]" id="drug_children" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="drug_older" class="control-label x85">老人用药：</label>
                                    <input type="text" name="extra[drug_older]" id="drug_older" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="drug_interaction" class="control-label x85">药物相互作用：</label>
                                    <input type="text" name="extra[drug_interaction]" id="drug_interaction" value="">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="messages">
                        <textarea name="extra[goods_desc]" id="goods_desc" class="j-content" style="width: 100%;" data-toggle="kindeditor" data-minheight="300">

                        </textarea>
                    </div>
                    <div class="tab-pane fade" id="settings">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>药物与药物禁忌</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <label for="taboo_medicine_effect" class="control-label x85">相互作用：</label>
                                    <input type="text" name="extra[taboo_medicine_effect]" id="taboo_medicine_effect" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo_medicine_res" class="control-label x85">产生结果：</label>
                                    <input type="text" name="extra[taboo_medicine_res]" id="taboo_medicine_res" value="">
                                </td>
                            </tr>

                            <thead>
                            <tr>
                                <th>药物与食物禁忌</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <label for="taboo_food_effect" class="control-label x85">相互作用：</label>
                                    <input type="text" name="extra[taboo_food_effect]" id="taboo_food_effect" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo_food_res" class="control-label x85">产生结果：</label>
                                    <input type="text" name="extra[taboo_food_res]" id="taboo_food_res" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo_food_list" class="control-label x85">食物禁忌：</label>
                                    <input type="text" name="extra[taboo_food_list]" id="taboo_food_list" value="">
                                </td>
                            </tr>

                            </tbody>

                            <thead>
                            <tr>
                                <th>药物与疾病禁忌</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <label for="taboo_disease_effect" class="control-label x85">相互作用：</label>
                                    <input type="text" name="extra[taboo_disease_effect]" id="taboo_disease_effect" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo_disease_res" class="control-label x85">产生结果：</label>
                                    <input type="text" name="extra[taboo_disease_res]" id="taboo_disease_res" value="">
                                </td>
                            </tr>
                            </tbody>

                            <thead>
                            <tr>
                                <th>药物与人群禁忌</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <label for="taboo_kind_effect" class="control-label x85">相互作用：</label>
                                    <input type="text" name="extra[taboo_kind_effect]" id="taboo_kind_effect" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo_kind_res" class="control-label x85">产生结果：</label>
                                    <input type="text" name="extra[taboo_kind_res]" id="taboo_kind_res" value="">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </fieldset>
        </div>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close" data-icon="close">取消</button></li>
        <li><button type="submit" class="btn-default" data-icon="save">保存</button></li>
    </ul>
</div>
<script>
    $.CurrentNavtab.find('#goodsid').val(parent.GID);

    //输入联动
    $.CurrentNavtab.find('#single_name').on('input',function(){
        inputInit();
    });
    $.CurrentNavtab.find('#specifications').on('input',function(){
        inputInit();
    });

    function inputInit() {
        var single_name = $.CurrentNavtab.find('#single_name').val();
        var specifications = $.CurrentNavtab.find('#specifications').val();
        var brand = $.CurrentNavtab.find("#brand_name").val();

        $.CurrentNavtab.find('#name').val(brand+'，'+single_name+'，'+specifications);
        $.CurrentNavtab.find('#show_name').val('【'+brand+'】'+single_name);
        $.CurrentNavtab.find('#search_words').val(brand+'，'+single_name);
    }

    //获取两个分类
    var obj = {
        url : '/api/goods/options',
        type : 'POST',
        callback : function (res) {

            for(var i in res.brand){
                if(i >= 0) {
                    $.CurrentNavtab.find('fieldset #' + res.brand[i].select_name).append('<option value="' + res.brand[i].extra + '">' + res.brand[i].select_option + '</option>');
                }
            }

            //category_goods
            for(var i in res.goods){
                if(i >= 0){
                    var prefix = '';
                    for(var j=1;j<res.goods[i].level;j++){
                        prefix += ' -- ';
                    }
                    $.CurrentNavtab.find('fieldset #category_goods').append('<option value="'+res.goods[i].category_sn+'">'+prefix+res.goods[i].category_name+'</option>');
                }
            }

            for(var i in res.component){
                if(i >= 0){
                    var prefix = '';
                    for(var j=1;j<res.component[i].level;j++){
                        prefix += ' -- ';
                    }
                    $.CurrentNavtab.find('fieldset #category_component').append('<option value="'+res.component[i].category_sn+'">'+prefix+res.component[i].category_name+'</option>');
                }
            }

            $.CurrentNavtab.find('fieldset select').selectpicker('refresh');

            if(parent.GID > 0){
                $.CurrentNavtab.find('#sn').attr('readonly',true);
                var obj = {
                    url : '/api/goods/detail',
                    type : 'POST',
                    data : {id:parent.GID},
                    callback : function (res) {
                        for(var i in res.data.extra){
                            $.CurrentNavtab.find('fieldset #'+i).val(res.data.extra[i]);
                        }

                        //编辑器
                        res.data.extra && KindEditor.html("#goods_desc", res.data.extra.goods_desc);
                        for(var i in res.data.goods){
                            $.CurrentNavtab.find('fieldset #'+i).val(res.data.goods[i]);
                        }

                        $('fieldset select').selectpicker('refresh');
                    }
                }
                $(this).bjuiajax('doAjax', obj)
            }
        }
    }
    $(this).bjuiajax('doAjax', obj)

    function checkerror(res) {
        if(res.error > 0){
            $(document).alertmsg('error',res.info);
        }else{
            $(document).alertmsg('info',res.info);
        }
    }


    //初始名字
    var ssss = '#brand_name';
    //获取焦点展示
    $.CurrentNavtab.find(ssss).focus(function(){
        $(this).next().css('display','block');
    });

    //失去焦点隐藏
    $.CurrentNavtab.find(ssss).blur(function(){
        var _this = $(this);
        setTimeout(function () {
            _this.next().css('display','none');
        },300)
    });

    //抓取接口渲染数据
    $.CurrentNavtab.find(ssss).on('input',function(){
        var s = $(this).val();
        var _this = $(this);

        var obj = {
            url : '/api/goods/select/brand',
            type : 'POST',
            data : {value:s},
            callback : function (res) {
                _this.next().html('');
                if(res.list.length>0){
                    for(var i in res.list){
                        if(i >= 0){
                            _this.next().append('<li data-original-index="0" data-value="'+res.list[i].extra+'" data-text="'+res.list[i].select_option+'">\
                            <a tabindex="0" class="">\
                            <span class="text">'+res.list[i].select_option+'</span>\
                            </a>\
                            </li>');
                        }

                    }
                }else{
                    _this.next().append('<li data-original-index="0" data-value="" data-text="">\
                    <a tabindex="0" class="">\
                    <span class="text">暂无搜索内容</span>\
                    </a>\
                    </li>');
                }

            }
        }
        $(this).bjuiajax('doAjax', obj)

    });

    //点击选择
    $.CurrentNavtab.find(ssss).parent().on('click','li',function(){
        $.CurrentNavtab.find(ssss).prev().val($(this).attr('data-value')).attr('data-text',$(this).attr('data-text'));
        $.CurrentNavtab.find('#brand_text').val($(this).attr('data-text'));
        $.CurrentNavtab.find(ssss).val($(this).attr('data-text'));
        inputInit();
    });
</script>