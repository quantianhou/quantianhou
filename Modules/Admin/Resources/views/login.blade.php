<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>系统登录</title>
    <script src="/B-JUI/BJUI/js/jquery-1.7.2.min.js"></script>
    <link href="/B-JUI/BJUI/themes/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        * {
            font-family: "Verdana", "Tahoma", "Lucida Grande", "Microsoft YaHei", "Hiragino Sans GB", sans-serif;
        }

        body {
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        a:link {
            color: #285e8e;
        }

        .main_box {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -180px;
            margin-left: -300px;
            padding: 30px;
            width: 600px;
            height: 340px;
            background: #FAFAFA;
            background: rgba(255, 255, 255, 0.5);
            border: 1px #DDD solid;
            border-radius: 5px;
            -webkit-box-shadow: 1px 5px 8px #888888;
            -moz-box-shadow: 1px 5px 8px #888888;
            box-shadow: 1px 5px 8px #888888;
        }

        .main_box .setting {
            position: absolute;
            top: 5px;
            right: 10px;
            width: 10px;
            height: 10px;
        }

        .main_box .setting a {
            color: #FF6600;
        }

        .main_box .setting a:hover {
            color: #555;
        }

        .login_logo {
            margin-bottom: 20px;
            height: 45px;
            text-align: center;
        }

        .login_logo img {
            height: 45px;
        }

        .login_msg {
            text-align: center;
            font-size: 16px;
        }

        .login_form {
            padding-top: 20px;
            font-size: 16px;
        }

        .login_box .form-control {
            display: inline-block;
            *display: inline;
            zoom: 1;
            width: auto;
            font-size: 18px;
        }

        .login_box .form-control.x319 {
            width: 319px;
        }

        .login_box .form-control {
            width: 164px;
        }

        .login_box .form-group {
            margin-bottom: 20px;
        }

        .login_box .form-group label.t {
            width: 120px;
            text-align: right;
            cursor: pointer;
        }

        .login_box .form-group.space {
            padding-top: 15px;
            border-top: 1px #FFF dotted;
        }

        .login_box .form-group img {
            margin-top: 1px;
            height: 32px;
            vertical-align: top;
        }

        .login_box .m {
            cursor: pointer;
        }

        .bottom {
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="main_box">
    <div class="login_box">
        <div class="login_form">
            <div id="login_form">
                <input type="hidden" id='isAli' name='isAli' value=''/>
                <div id='dfgdf' class="form-group">
                    <label for="js_username" class="t">用户名：</label>
                    <input id="js_username" value="" name="user_name" type="text" class="form-control x319 in" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="js_password" class="t">密　码：</label>
                    <input id="js_password" value="" name="password" type="password" class="form-control x319 in">
                </div>
                <div class="form-group space">
                    <label class="t"></label>　　　
                    <input type="submit" id="login_ok" value="&nbsp;登&nbsp;录&nbsp;" class="btn btn-primary btn-lg">&nbsp;&nbsp;&nbsp;&nbsp;
                    <a value="&nbsp;重&nbsp;置&nbsp;" class="btn btn-default btn-lg">&nbsp;重&nbsp;置&nbsp;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom">Copyright &copy; 2018 </div>
</div>
</body>
</html>
<script src="http://static.littleobean.com/js/layer3.0/layer.js"></script>
<script type="text/javascript">
    $(function () {
        $("#login_ok").click(function () {
            var data = {username: $('#js_username').val(), password: $('#js_password').val()};
            if (!data.username || !data.password) {
                layer.alert('用户名或密码为空');
                return false;
            }

            $.ajax({
                type: 'POST',
                url: '/api/login/index',
                data: data,
                dataType: 'json',
                success: function (result) {
                    if (result.error > 0) {
                        return layer.alert(result.info);
                    }
                    window.location.href = '/index';
                },
                timeout: 30000
            });
            return false;
        });
    });
</script>
