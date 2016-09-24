<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<{$smarty.const.APP_RES}>/lib/html5.js"></script>
    <script type="text/javascript" src="<{$smarty.const.APP_RES}>/lib/respond.min.js"></script>
    <script type="text/javascript" src="<{$smarty.const.APP_RES}>/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="<{$smarty.const.APP_RES}>/css/f-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="<{$smarty.const.APP_RES}>/css/f-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="<{$smarty.const.APP_RES}>/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <link href="<{$smarty.const.APP_RES}>/lib/f-ui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.f-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>更新会员信息</title>
</head>
<body>
<div class="pd-20">
    <form action="/admin/Member/update" method="post" class="form form-horizontal" id="form-admin-add">
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>会员：</label>
            <div class="formControls col-5">
                <{$adinfo.username}>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>手机：</label>
            <div class="formControls col-5">
                <input type="text" class="input-text" value="<{$adinfo.username}>" placeholder="" id="user-tel" name="username"  datatype="m" nullmsg="手机不能为空">
            </div>
            <div class="col-4"> </div>
        </div>

        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>邮箱：</label>
            <div class="formControls col-5">
                <input type="text" class="input-text" placeholder="@" name="email" id="email" datatype="e" nullmsg="请输入邮箱！" value="<{$adinfo.email}>">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>昵称：</label>
            <div class="formControls col-5">
                <input type="text" class="input-text"  name="nickname" id="" nullmsg="昵称！" value="<{$adinfo.nickname}>">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                <input type="hidden" name="m_id" value="<{$adinfo.m_id}>"/>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-admin-add").Validform({
            tiptype:2,
            ajaxPost:true,
            callback:function(form){
                if(form.status=="y"){
                    setTimeout(function(){
                        parent.location.reload();
                    },2000);
                }
            }
        });
    });
</script>
</body>
</html>