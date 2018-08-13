<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>全天候-后台管理系统</title>
<meta name="Keywords" content=""/>
<!-- bootstrap - css -->
<link href="/B-JUI/BJUI/themes/css/bootstrap.css" rel="stylesheet">
<!-- core - css -->
<link href="/B-JUI/BJUI/themes/css/style.css" rel="stylesheet">
<link href="/B-JUI/BJUI/themes/blue/core.css" id="bjui-link-theme" rel="stylesheet">
<!-- plug - css -->
<link href="/B-JUI/BJUI/plugins/kindeditor_4.1.10/themes/default/default.css" rel="stylesheet">
<link href="/B-JUI/BJUI/plugins/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="/B-JUI/BJUI/plugins/niceValidator/jquery.validator.css" rel="stylesheet">
<link href="/B-JUI/BJUI/plugins/bootstrapSelect/bootstrap-select.css" rel="stylesheet">
<link href="/B-JUI/BJUI/themes/css/FA/css/font-awesome.min.css" rel="stylesheet">
<!--[if lte IE 7]>
<link href="BJUI/themes/css/ie7.css" rel="stylesheet">
<![endif]-->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lte IE 9]>
    <script src="BJUI/other/html5shiv.min.js"></script>
    <script src="BJUI/other/respond.min.js"></script>
<![endif]-->
<!-- jquery -->
<script src="/B-JUI/BJUI/js/jquery-1.7.2.min.js"></script>
<script src="/B-JUI/BJUI/js/jquery.cookie.js"></script>
<!--[if lte IE 9]>
<script src="BJUI/other/jquery.iframe-transport.js"></script>    
<![endif]-->
<!-- BJUI.all 分模块压缩版 -->
<script src="/B-JUI/BJUI/js/bjui-all.js"></script>

<!-- swfupload for uploadify && kindeditor -->
<script src="/B-JUI/BJUI/plugins/swfupload/swfupload.js"></script>
<!-- kindeditor -->
<script src="/B-JUI/BJUI/plugins/kindeditor_4.1.10/kindeditor-all.min.js"></script>
<script src="/B-JUI/BJUI/plugins/kindeditor_4.1.10/lang/zh_CN.js"></script>
<!-- colorpicker -->
<script src="/B-JUI/BJUI/plugins/colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- ztree -->
<script src="/B-JUI/BJUI/plugins/ztree/jquery.ztree.all-3.5.js"></script>
<!-- nice validate -->
<script src="/B-JUI/BJUI/plugins/niceValidator/jquery.validator.js"></script>
<script src="/B-JUI/BJUI/plugins/niceValidator/jquery.validator.themes.js"></script>
<!-- bootstrap plugins -->
<script src="/B-JUI/BJUI/plugins/bootstrap.min.js"></script>
<script src="/B-JUI/BJUI/plugins/bootstrapSelect/bootstrap-select.min.js"></script>
<script src="/B-JUI/BJUI/plugins/bootstrapSelect/defaults-zh_CN.min.js"></script>
<!-- icheck -->
<script src="/B-JUI/BJUI/plugins/icheck/icheck.min.js"></script>
<!-- dragsort -->
<script src="/B-JUI/BJUI/plugins/dragsort/jquery.dragsort-0.5.1.min.js"></script>

<!--layer   -->
<script src="/layer/layer.js"></script>
    <!-- toastr -->
<script src="/js/toastr.min.js"></script>
    <!-- 文件上传oos -->
<script src="/js/vue_upload.js"></script>

<!-- init -->
<script type="text/javascript">
$(function() {

	


    BJUI.init({
        JSPATH       : '/B-JUI/BJUI/',         //[可选]框架路径
        PLUGINPATH   : '/B-JUI/BJUI/plugins/', //[可选]插件路径
        loginInfo    : {url:'timeout', title:'登录', width:400, height:200}, // 会话超时后弹出登录对话框
        statusCode   : {ok:200, error:300, timeout:301}, //[可选]
        ajaxTimeout  : 50000, //[可选]全局Ajax请求超时时间(毫秒)
        pageInfo     : {total:'total', pageCurrent:'pageCurrent', pageSize:'pageSize', orderField:'orderField', orderDirection:'orderDirection'}, //[可选]分页参数
        alertMsg     : {displayPosition:'topcenter', displayMode:'slide', alertTimeout:3000}, //[可选]信息提示的显示位置，显隐方式，及[info/correct]方式时自动关闭延时(毫秒)
        keys         : {statusCode:'statusCode', message:'message'}, //[可选]
        ui           : {
                         windowWidth      : 0,    //框架可视宽度，0=100%宽，> 600为则居中显示
                         showSlidebar     : true, //[可选]左侧导航栏锁定/隐藏
                         clientPaging     : true, //[可选]是否在客户端响应分页及排序参数
                         overwriteHomeTab : false //[可选]当打开一个未定义id的navtab时，是否可以覆盖主navtab(我的主页)
                       },
        debug        : true,    // [可选]调试模式 [true|false，默认false]
        theme        : 'sky' // 若有Cookie['bjui_theme'],优先选择Cookie['bjui_theme']。皮肤[五种皮肤:default, orange, purple, blue, red, green]
    })
    
    // main - menu
    $('#bjui-accordionmenu')
        .collapse()
        .on('hidden.bs.collapse', function(e) {
            $(this).find('> .panel > .panel-heading').each(function() {
                var $heading = $(this), $a = $heading.find('> h4 > a')
                
                if ($a.hasClass('collapsed')) $heading.removeClass('active')
            })
        })
        .on('shown.bs.collapse', function (e) {
            $(this).find('> .panel > .panel-heading').each(function() {
                var $heading = $(this), $a = $heading.find('> h4 > a')
                
                if (!$a.hasClass('collapsed')) $heading.addClass('active')
            })
        })
    
    $(document).on('click', 'ul.menu-items > li > a', function(e) {
        var $a = $(this), $li = $a.parent(), options = $a.data('options').toObj()
        var onClose = function() {
            $li.removeClass('active')
        }
        var onSwitch = function() {
            $('#bjui-accordionmenu').find('ul.menu-items > li').removeClass('switch')
            $li.addClass('switch')
        }
        
        $li.addClass('active')
        if (options) {
            options.url      = $a.attr('href')
            options.onClose  = onClose
            options.onSwitch = onSwitch
            if (!options.title) options.title = $a.text()

            if (!options.target)
                $a.navtab(options)
            else
                $a.dialog(options)
        }

        e.preventDefault()
    })
	BJUI.URLDATA = {};

})
STEP = 0;
//菜单-事件
function MainMenuClick(event, treeId, treeNode) {
    event.preventDefault()
    
    if (treeNode.isParent) {
        var zTree = $.fn.zTree.getZTreeObj(treeId)
        
        zTree.expandNode(treeNode, !treeNode.open, false, true, true)
        return
    }
    
    if (treeNode.target && treeNode.target == 'dialog')
        $(event.target).dialog({id:treeNode.tabid, url:treeNode.url, title:treeNode.name})
    else
        $(event.target).navtab({id:treeNode.tabid, url:treeNode.url, title:treeNode.name, fresh:treeNode.fresh, external:treeNode.external})
}
</script>
<!-- for doc begin -->
<link type="text/css" rel="stylesheet" href="/B-JUI/js/syntaxhighlighter-2.1.382/styles/shCore.css"/>
<link type="text/css" rel="stylesheet" href="/B-JUI/js/syntaxhighlighter-2.1.382/styles/shThemeEclipse.css"/>
<script type="text/javascript" src="/B-JUI/js/syntaxhighlighter-2.1.382/scripts/brush.js"></script>
<link href="/B-JUI/doc/doc.css" rel="stylesheet">

<script type="text/javascript">
$(function(){
    SyntaxHighlighter.config.clipboardSwf = '/js/syntaxhighlighter-2.1.382/scripts/clipboard.swf'
    $(document).on(BJUI.eventType.initUI, function(e) {
        SyntaxHighlighter.highlight();
    })
	//范海龙2016-02-21
	$('header').load("/header");
	$('footer').load("/footer");
})
</script>
<!-- for doc end -->
</head>
<body>
    <!--[if lte IE 7]>
        <div id="errorie"><div>您还在使用老掉牙的IE，正常使用系统前请升级您的浏览器到 IE8以上版本 <a target="_blank" href="http://windows.microsoft.com/zh-cn/internet-explorer/ie-8-worldwide-languages">点击升级</a>&nbsp;&nbsp;强烈建议您更改换浏览器：<a href="http://down.tech.sina.com.cn/content/40975.html" target="_blank">谷歌 Chrome</a></div></div>
    <![endif]-->
    <div id="bjui-window">
    <header id="bjui-header"></header>
    <div id="bjui-container">
        <div id="bjui-leftside">
            <div id="bjui-sidebar-s">
                <div class="collapse"></div>
            </div>
            <div id="bjui-sidebar">
                <div class="toggleCollapse"><h2><i class="fa fa-bars"></i> 导航栏 <i class="fa fa-bars"></i></h2><a href="javascript:;" class="lock"><i class="fa fa-lock"></i></a></div>
                <div class="panel-group panel-main" data-toggle="accordion" id="bjui-accordionmenu" data-heightbox="#bjui-sidebar" data-offsety="26">
                </div>
            </div>
        </div>
        <div id="bjui-navtab" class="tabsPage">
            <div class="tabsPageHeader">
                <div class="tabsPageHeaderContent">
                    <ul class="navtab-tab nav nav-tabs" id="mainTabUl">
                        <li data-url="welcome"><a href="javascript:;"><span><i class="fa fa-home"></i> #maintab#</span></a></li>
                    </ul>
                </div>
                <div class="tabsLeft">
                    <i class="fa fa-angle-double-left"></i>
                </div>
                <div class="tabsRight"><i class="fa fa-angle-double-right"></i></div>
                <div class="tabsMore"><i class="fa fa-angle-double-down"></i></div>
            </div>
            <ul class="tabsMoreList">
                <li><a href="javascript:;">#maintab#</a></li>
            </ul>
            <div class="navtab-panel tabsPageContent">
                <div class="navtabPage unitBox">
                    <div class="bjui-pageContent" style="background:#FFF;">
                        {{--Loading...--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer id="bjui-footer"></footer>
    </div>
</body>

<link rel="stylesheet" href="/css/toastr.min.css">
</html>