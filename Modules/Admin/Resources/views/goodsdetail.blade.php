<style>
    input{
        width: 60% !important;
    }
    input.input30{
        width: 30% !important;
    }
</style>
<div class="bjui-pageContent">
    <form action="/api/goods/save" id="j_form_form" class="pageForm" data-toggle="validate">
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
                                    <input type="text" name="goods[name]" id="name" value="" data-rule="required" size="50">
                                </td>
                                <td>
                                    <label for="single_name" class="control-label x85">通用名称：</label>
                                    <input type="text" name="goods[single_name]" id="single_name" value="" data-rule="required" size="50">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="show_name" class="control-label x85">显示名称：</label>
                                    <input type="text" name="goods[show_name]" id="show_name" value="" data-rule="required" size="50">
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
                                <td>
                                    <label for="brand" class="control-label x85">品牌名称：</label>
                                    <select name="goods[brand]" id="brand" data-toggle="selectpicker" data-rule="required">
                                        <option value="">全部</option>
                                        <option value="1">业务1</option>
                                        <option value="2">业务2</option>
                                    </select>
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
                                        <option value="">全部</option>
                                        <option value="1">业务1</option>
                                        <option value="2">业务2</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="unit" class="control-label x85">单位：</label>
                                    <select name="goods[unit]" id="unit" data-toggle="selectpicker" data-rule="required">
                                        <option value="1">业务1</option>
                                        <option value="2">业务2</option>
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
                                        <option value="1">否</option>
                                        <option value="2">是</option>
                                    </select>
                                </td>
                                <td>
                                    <label for="basic_medicine" class="control-label x85">基药：</label>
                                    <select name="goods[basic_medicine]" id="basic_medicine" data-toggle="selectpicker" data-rule="required">
                                        <option value="1">否</option>
                                        <option value="2">是</option>
                                    </select>
                                </td>
                                <td>
                                    <label for="easy_break" class="control-label x85">易碎易渗漏：</label>
                                    <select name="goods[easy_break]" id="easy_break" data-toggle="selectpicker" data-rule="required">
                                        <option value="1">否</option>
                                        <option value="2">是</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="easy_smell" class="control-label x85">易串味：</label>
                                    <select name="goods[easy_smell]" id="easy_smell" data-toggle="selectpicker" data-rule="required">
                                        <option value="1">否</option>
                                        <option value="2">是</option>
                                    </select>
                                </td>
                                <td>
                                    <label for="curing" class="control-label x85">重点养护：</label>
                                    <select name="goods[curing]" id="curing" data-toggle="selectpicker" data-rule="required">
                                        <option value="1">否</option>
                                        <option value="2">是</option>
                                    </select>
                                </td>
                                <td>
                                    <label for="save_method" class="control-label x85">存储方式：</label>
                                    <select name="goods[save_method]" id="save_method" data-toggle="selectpicker" data-rule="required">
                                        <option value="1">否</option>
                                        <option value="2">是</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="component" class="control-label x85">成分名称：</label>
                                    <select name="goods[component]" id="component" data-toggle="selectpicker" data-rule="required">
                                        <option value="1">否</option>
                                        <option value="2">是</option>
                                    </select>
                                </td>
                                <td>
                                    <label for="category_goods" class="control-label x85">类别名称：</label>
                                    <select name="goods[category_goods]" id="category_goods" data-toggle="selectpicker" data-rule="required">
                                        <option value="1">否</option>
                                        <option value="2">是</option>
                                    </select>
                                </td>
                                <td>
                                    <label for="category_component" class="control-label x85">成分分类名称：</label>
                                    <select name="goods[category_component]" id="category_component" data-toggle="selectpicker" data-rule="required">
                                        <option value="1">否</option>
                                        <option value="2">是</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="control_code" class="control-label x85">显示控制码：</label>
                                    <select name="goods[control_code]" id="control_code" data-toggle="selectpicker" data-rule="required">
                                        <option value="1">否</option>
                                        <option value="2">是</option>
                                    </select>
                                </td>
                                <td colspan="2">
                                    <label for="service_information" class="control-label x85">是否触发服务信息：</label>
                                    <select name="goods[service_information]" id="service_information" data-toggle="selectpicker" data-rule="required">
                                        <option value="1">否</option>
                                        <option value="2">是</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label for="search_words" class="control-label x85">搜索用词：</label>
                                    <input type="text" name="goods[search_words]" id="search_words" value="" data-rule="required" size="50">
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
                                    <input type="text" name="goods[text_component]" id="text_component" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="main_function" class="control-label x85">主治功能：</label>
                                    <input type="text" name="goods[main_function]" id="main_function" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="usage" class="control-label x85">用法用量：</label>
                                    <input type="text" name="goods[usage]" id="usage" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="untoward_effect" class="control-label x85">不良反应：</label>
                                    <input type="text" name="goods[untoward_effect]" id="untoward_effect" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo" class="control-label x85">禁忌：</label>
                                    <input type="text" name="goods[taboo]" id="taboo" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="attention" class="control-label x85">注意事项：</label>
                                    <input type="text" name="goods[attention]" id="attention" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="drug_women" class="control-label x85">孕妇哺乳期妇女用药：</label>
                                    <input type="text" name="goods[drug_women]" id="drug_women" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="drug_children" class="control-label x85">儿童用药：</label>
                                    <input type="text" name="goods[drug_children]" id="drug_children" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="drug_older" class="control-label x85">老人用药：</label>
                                    <input type="text" name="goods[drug_older]" id="drug_older" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="drug_interaction" class="control-label x85">药物相互作用：</label>
                                    <input type="text" name="goods[drug_interaction]" id="drug_interaction" value="">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="messages">
                        <textarea name="goods_desc" id="goods_desc" class="j-content" style="width: 100%;" data-toggle="kindeditor" data-minheight="300">
                            <p><strong>HTML编辑器KindEditor：</strong></p>
                            <p><strong>已优化：</strong></p>
                            <ul>
                                <li>深度清理html标记</li>
                                <li>上传附件后，自动获取文件名（需要返回JSON属性"origin_name"）</li>
                                <li>修改一键排版为段落前空两个全角空格，主要考虑到某些行需要顶格时直接删除空格即可。</li>
                            </ul>
                            <p><br>更多参数请参见：<a href="http://kindeditor.net/" target="_blank">http://kindeditor.net/</a></p>
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
                                    <input type="text" name="goods[taboo_medicine_effect]" id="taboo_medicine_effect" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo_medicine_res" class="control-label x85">产生结果：</label>
                                    <input type="text" name="goods[taboo_medicine_res]" id="taboo_medicine_res" value="">
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
                                    <input type="text" name="goods[taboo_food_effect]" id="taboo_food_effect" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo_food_res" class="control-label x85">产生结果：</label>
                                    <input type="text" name="goods[taboo_food_res]" id="taboo_food_res" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo_food_list" class="control-label x85">食物禁忌：</label>
                                    <input type="text" name="goods[taboo_food_list]" id="taboo_food_list" value="">
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
                                    <input type="text" name="goods[taboo_disease_effect]" id="taboo_disease_effect" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo_disease_res" class="control-label x85">产生结果：</label>
                                    <input type="text" name="goods[taboo_disease_res]" id="taboo_disease_res" value="">
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
                                    <input type="text" name="goods[taboo_kind_effect]" id="taboo_kind_effect" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="taboo_kind_res" class="control-label x85">产生结果：</label>
                                    <input type="text" name="goods[taboo_kind_res]" id="taboo_kind_res" value="">
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