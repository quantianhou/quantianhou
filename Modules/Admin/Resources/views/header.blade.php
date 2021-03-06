<div class="bjui-navbar-header">
    <button type="button" class="bjui-navbar-toggle btn-default" data-toggle="collapse"
            data-target="#bjui-navbar-collapse">
        <i class="fa fa-bars"></i>
    </button>
    <a class="bjui-navbar-logo" href="#">
        {{--<img style="width:50%; margin-left:0px;margin-top:12px;"src="/B-JUI/logo.png">--}}
        <img style="width:20%; margin-left:0px;margin-top:12px;"src="/B-JUI/logo.png">
    </a>
</div>
<nav id="bjui-navbar-collapse">
    <ul class="bjui-navbar-right">
        <li><a href="#">欢迎登录：<span style="color:#FF6600" id="userInfo"></span></a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">我的账户 <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                {{--<li>--}}
                    {{--<a href="changepwd.html" data-toggle="dialog" data-id="changepwd_page" data-mask="true" data-width="400" data-height="260">--}}
                        {{--<span class="glyphicon glyphicon-lock"></span>--}}
                        {{--修改密码--}}
                    {{--</a>--}}
                {{--</li>--}}
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
                var cls = '';
//                if(i == 0){
//                    cls = 'class="active"';
//                }else{
//                    cls = '';
//                }
                appendStr += '<li '+cls+'><a href="javascript:;" data-toggle="slidebar"><i class="fa fa-database"></i> ' + result.data[i].name + '</a>\
                        <div class="items hide" data-noinit="true">\
                             <ul class="menu-items" data-faicon="table">';
                mix = result.data[i].child;
                for (var j in mix) {
                    if (!(j >= 0)) {
                        continue;
                    }
                    appendStr += '<li><a href="' + mix[j].route + '" data-options="{id:\'tab_' + mix[j].id + '\', faicon:\'table\'}" >' + mix[j].name + '</li>';
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
                    window.location.href = '/login';
                },
                error: function () {

                },
                timeout: 30000//30秒
            });
        });

        //用户信息
        $.ajax({
            type: 'POST',
            url: '/api/login/getUser',
            data: {},
            dataType: 'json',
            success: function (result) {
                if (result.error) {
                    window.location.href = '/login';return ;
                }
                $('#userInfo').html(result.data);
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