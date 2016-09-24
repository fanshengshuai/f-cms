<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>后台管理登陆</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <script type="text/javascript" src="//cdn.bootcss.com/jquery/1.12.1/jquery.min.js"></script>

    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="/res/admin/login.css"/>
</head>
<body>
<!--[if lt IE 10]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<div id="app" class="container">
    <div class="userlist-container">
        <!--        <img class="logo" src="/res/admin/img/logo-512.png">-->
        <h2>管理后台</h2>
        <section class="signin-wrap">
            <form action="/admin/public/login" method="post" id="loginForm">
                <div class="form-group ">
                    <label>
                        <span>用户名</span>
                        <input autocomplete="off" id="username" name="username" type="text" placeholder="账户"
                               class="input-text size-L"
                               datatype="/\w{5,16}/i" nullmsg="请输入用户名" errormsg="用户名为5到16位的数字、字母、下划线"
                               ajaxurl="/admin/public/ckUser">
                    </label>
                    <div class="tips"></div>
                </div>
                <div class="form-group ">
                    <label>
                        <span>密码</span>
                        <input autocomplete="off" id="password" name="password" type="password" placeholder="密码"
                               class="input-text size-L"
                               datatype="/\w{6,16}/i" nullmsg="请输入密码" errormsg="密码为6到16位的数字、字母、下划线">
                    </label>
                    <div class="tips"></div>
                </div>

                <div class="form-group ">
                    <label>
                        <input autocomplete="off" type="text" name="code" placeholder="验证码"
                               class="pull-left"
                               style="width:150px;"
                               datatype="s4-4" nullmsg="请输入验证码" errormsg="验证码为4位" ajaxurl="/admin/public/ckCaptcha"/>
                        <img src="/admin/public/captcha" style="margin-top: 8px;" class="pull-right"
                             onclick="this.src=this.src+'?a'" title="看不清，换一张"/>
                    </label>
                    <div class="tips"></div>
                </div>
                <button type="submit" class="btn submit-btn">登录</button>
            </form>
            <p id="error_info" class="signin-error" style="display: none;"></p>
        </section>
    </div>
</div>
<script type="text/javascript" src="/res/lib/Validform/5.3.2/Validform.min.js"></script>

<script type="text/javascript">
    $(function () {
        //看不清换一张
        $('#kanbuqing').click(function () {
            $(this).prev().trigger('click');
        });
        //表单验证
        $("#loginForm").Validform({
            tiptype: function (msg, o, cssctl) {
                if (!o.obj.is("form")) {
                    var objtip = o.obj.parents("label").next();
                    cssctl(objtip, o.type);
                    objtip.text(msg);
                }
            },
            ajaxPost: true,
            callback: function (form) {
                if (form.status == "y") {
                    setTimeout(function () {
                        location.href = "/admin/";
                    }, 1000);
                } else if (form.status == "n") {
                    $('#error_info').html(form.msg).show();
                }
            }
        });
    });

    document.onkeydown = keydown;
    function keydown(e) {
        var currKey = 0, e = e || event;
        currKey = e.keyCode || e.which || e.charCode;//支持IE、FF
        if (currKey == 13) {
            if (event) {
                e.returnValue = false;
            } else {
                e.preventDefault();
            }
            $("#loginForm").submit();
        }
//        if (currKey == 27) {
//            // 按 Esc     //要做的事情
//        }
    }
</script>
</body>
</html>