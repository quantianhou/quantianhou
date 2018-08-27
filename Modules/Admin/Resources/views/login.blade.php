<html lang="zh-cn">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link href="/B-JUI/login/pc.css" rel="stylesheet">
    <link rel="stylesheet" href="/B-JUI/login/global.css" media="all">
    <link rel="stylesheet" href="/B-JUI/login/layui.css" media="all">
    <style type="text/css">
        .blk_div{
            width:150px;height:120;margin:20px;float:left;
        }
        .blk_table{
            height:100%;
            width:100%;
            background-color:#c2c2c2;
        }
        .blk_table td{
            color:white;
        }
    </style>
    <style type="text/css">
        html, body {
            height: 100%;
            width:100%;
        }
    </style>
    <title>药美康臣-用户登录 </title>
</head>
<body style="overflow-y:hidden;"><input value="/merp" id="ctx" type="hidden">
<link href="/B-JUI/login/style.css" rel="stylesheet">

<img alt="" src="/B-JUI/login/5.png" style="position:absolute;z-index:0;overflow-y: hidden" id="loginbg" width="100%">

<div class="login_c">
    <div class="login_m">
        <table width="100%" align="center">
            <tbody><tr>
                <td>

                </td>
            </tr>
            </tbody></table>
        <div class="panel" id="lg_panel" style="margin: 0 auto;top: 50%;margin-top: -100px;" align="center">
            <span>欢迎登陆-药美康臣</span>
            <p class="loginPrompt" id="errMsg"></p>
            <br>
            <form id="login_form" action="/merp/pc/signin.do" method="post">
	            <span class="ipt">
	            <i class="fa fa-user" style="font-size:18px;position:absolute;margin-left:20px;margin-top:11px;"></i>
	            <input id="js_username" name="username" class="easyui-validatebox formText2 validatebox-text validatebox-invalid" placeholder="请输入用户名" style="width:220px; height:40px;font-size:15px; line-height:40px;margin-left:10px;" data-options="required:true" title="" type="text">
	            </span>
	            <span class="ipt">
	            <i class="fa fa-lock" style="font-size:20px;position:absolute;margin-left:20px;margin-top:11px;"></i>
	            <input id="js_password" name="password" autocomplete="off" class="easyui-validatebox formText2 validatebox-text validatebox-invalid" placeholder="请输入您的密码" style="width:220px; height:40px;font-size:15px; line-height:40px;margin-left:10px;" data-options="required:true" title="" type="password">
	            </span>
	            <span class="ipt">
	            <input id="login_ok" class="layui-btn layui-btn-big layui-btn-normal layui-btn-radius" style="margin-left:-5px;width:250px" value="登&nbsp;&nbsp;录" type="button">
	            </span>
                <input value="" id="screen_width" name="width" type="hidden">
                <input value="" id="screen_height" name="height" type="hidden">
                <input value="" id="loginmac" name="loginmac" type="hidden">
            </form>
        </div>
    </div>
</div>
<div class="login_b" style="display: none;">©2018 药美康臣-版权所有</div>

<div class="panel window" style="display: none; width: 238px; left: 835px; top: 238px;"><div class="panel-header panel-header-noborder window-header" style="width: 238px;"><div class="panel-title">打印模板选择</div><div class="panel-tool"><a href="javascript:void(0)" class="panel-tool-close"></a></div></div><div id="printWindowSelect" class="easyui-window panel-body panel-body-noborder window-body" title="" data-options="modal:true,closed:true,collapsible:false,minimizable:false,maximizable:false,close:function(){$('#printSelectId').html('');}" style="width: 236px; height: 134px;">

    </div></div><div class="window-shadow" style="display: none; left: 835px; top: 238px;"></div><div class="window-mask" style="display: none; width: 1920px; height: 1058px;"></div><div class="panel window" style="display: none; width: 0px; left: 954px; top: 305px;"><div class="panel-header panel-header-noborder window-header" style="width: 0px;"><div class="panel-title">.</div><div class="panel-tool"><a href="javascript:void(0)" class="panel-tool-close"></a></div></div><div id="otherWindow" class="easyui-window panel-body panel-body-noborder window-body" title="" data-options="modal:false,closed:true,collapsible:false,minimizable:false,maximizable:false,resizable:false" style="width: 0px; height: 0px;">

    </div></div><div class="window-shadow" style="display: none; left: 954px; top: 305px;"></div><div class="panel window" style="display: none; width: 588px; left: 660px; top: 148px;"><div class="panel-header panel-header-noborder window-header" style="width: 588px;"><div class="panel-title">查看消息通知</div><div class="panel-tool"><a href="javascript:void(0)" class="panel-tool-collapse"></a><a href="javascript:void(0)" class="panel-tool-min"></a><a href="javascript:void(0)" class="panel-tool-max"></a><a href="javascript:void(0)" class="panel-tool-close"></a></div></div><div id="msgWindow" class="easyui-window panel-body panel-body-noborder window-body" title="" data-options="modal:false,closed:true" style="width: 586px; height: 314px;">

    </div></div><div class="window-shadow" style="display: none; left: 660px; top: 148px;"></div><div class="layui-layer-move"></div>
</body></html>


<script src="/B-JUI/BJUI/js/jquery-1.7.2.min.js"></script>
<script src="http://static.littleobean.com/js/layer3.0/layer.js"></script>
<script type="text/javascript">
    var layerid = null;
    document.onkeydown = function(){                //网页内按下回车触发
        if(event.keyCode==13)
        {
            if(layerid==null){
                document.getElementById("login_ok").click();
            }else{
                layerid = null;
                layer.closeAll();
            }
            return false;
        }
    }
    $(function () {
        $("#login_ok").click(function () {
            var data = {username: $('#js_username').val(), password: $('#js_password').val()};
            if (!data.username || !data.password) {
                layerid = layer.alert('用户名或密码为空');
                return false;
            }

            $.ajax({
                type: 'POST',
                url: '/api/login/index',
                data: data,
                dataType: 'json',
                success: function (result) {
                    if (result.error > 0) {
                        return (layerid = layer.alert(result.info), 0);
                    }
                    window.location.href = '/index';
                },
                timeout: 30000
            });
            return false;
        });
    });
</script>
