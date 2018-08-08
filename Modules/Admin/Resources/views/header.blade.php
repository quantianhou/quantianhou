<div class="bjui-navbar-header">
    <button type="button" class="bjui-navbar-toggle btn-default" data-toggle="collapse"
            data-target="#bjui-navbar-collapse">
        <i class="fa fa-bars"></i>
    </button>
    <a class="bjui-navbar-logo" href="#">
        <img style="width:48%; margin-left:30px;margin-top:12px;"src="/xyd_logo.png">
    </a>
</div>
<nav id="bjui-navbar-collapse">
    <ul class="bjui-navbar-right">
        <li><a href="#">欢迎登录：<span style="color:#FF6600" id="userInfo"></span></a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">我的账户 <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="changepwd.html" data-toggle="dialog" data-id="changepwd_page" data-mask="true" data-width="400" data-height="260">
                        <span class="glyphicon glyphicon-lock"></span>
                        修改密码
                    </a>
                </li>
                <li><a id="loginOut" class="red">&nbsp;<span class="glyphicon glyphicon-off"></span> 注销登录</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="bjui-hnav">
    <button type="button" class="btn-default bjui-hnav-more-left" title="导航菜单左移"><i class="fa fa-angle-double-left"></i>
    </button>
    <div id="bjui-hnav-navbar-box">
        <ul id="bjui-hnav-navbar">
        </ul>
    </div>
    <button type="button" class="btn-default bjui-hnav-more-right" title="导航菜单右移"><i
            class="fa fa-angle-double-right"></i></button>
</div>
<script type="text/javascript">
    //菜单加载
    $.ajax({
        type: 'POST',
        url: '/api/rbac/menu',
        data: {},
        dataType: 'json',
        success: function (result) {
            var mix, appendStr = '';
            for (var i in result.data) {
                if (!(i >= 0)) {
                    continue;
                }
                appendStr += '<li><a data-toggle="slidebar"><i class="fa fa-database"></i> ' + result.data[i].title + '</a>\
                        <div class="items hide" data-noinit="true">\
                            <ul id="bjui-hnav-tree' + (i + 1) + '" class="ztree ztree_main" data-toggle="ztree" data-on-click="MainMenuClick" data-expand-all="true" data-faicon="plane">';
                mix = result.data[i].child;
                for (var j in mix) {
                    if (!(j >= 0)) {
                        continue;
                    }
                    appendStr += '<li data-id="' + mix[j].id + '" data-pid="0" data-url="' + mix[j].link_url + '" data-faicon="folder-open-o" data-faicon-close="folder-o">' + mix[j].title + '</li>';

                }
                appendStr += '</ul></div></li>';
            }
            $('#bjui-hnav-navbar').append(appendStr);
        },
        error: function () {

        },
        timeout: 30000//30秒
    });
    $(function () {
        $('#loginOut').click(function () {
            $.ajax({
                type: 'POST',
                url: '/api/login/logout',
                data: {},
                dataType: 'json',
                success: function (result) {
                    if (result.error) {
                        return layer.alert(result.info);
                    }
                    window.location.href = '/login.html';
                },
                error: function () {

                },
                timeout: 30000//30秒
            });
        });

        //用户信息
        $.ajax({
            type: 'POST',
            url: '/api/index/index',
            data: {},
            success: function (result) {
                if (result) {
                    $('#userInfo').html(result);
                } else {
                    window.location.href = '/login';
                }
            },
            error: function () {

            },
            timeout: 30000//30秒
        });
    });
    //单击事件
    function ZtreeClick(event, treeId, treeNode) {
        event.preventDefault()
        for (var i in treeNode) {
            console.log(i + ' - ' + treeNode[i]);
        }

        if (treeNode.name) $('#j_menu_name').val(treeNode.name)
        if (treeNode.url) {
            //$('#j_menu_url').val(treeNode.url)
            $(this).navtab({id: 'navtab', url: treeNode.url, title: 'ztree'})
        } else {
            //$('#j_menu_url').val('')
        }
    }
</script>