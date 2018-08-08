<div class="bjui-pageContent">
    <form action="ajaxDone1.html" id="j_form_form" class="pageForm" data-toggle="validate">
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
                    <div class="tab-pane fade active in" id="home"><p>选项卡的a标签上添加[data-toggle="ajaxtab"]属性可以实现ajax加载内容。</p><p>[data-reload]属性可以定义点击该选项卡时是否每次都需要重新加载。</p></div>
                    <div class="tab-pane fade" id="home2"><!-- Ajax加载 --></div>
                    <div class="tab-pane fade" id="messages">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>一一</td>
                                    <td>♂</td>
                                    <td>2000-01-01</td>
                                    <td>CN</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="settings">No4. Settings</div>
                </div>
            </fieldset>
        </div>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close" data-icon="close">关闭</button></li>
    </ul>
</div>