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
<div class="pd-20" style="margin-left: 100px">
    <div class="row cl">
        <label class="form-label col-2"><span class="c-red">*</span>用户类型：</label>
        <div class="formControls col-7">
            <{if $adinfo.type == 2}>企业<{else}>个人<{/if}>
        </div>
    </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>会员：</label>
            <div class="formControls col-7">
                <{$adinfo.username}>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>手机：</label>
            <div class="formControls col-7">
                <{$adinfo.username}>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>邮箱：</label>
            <div class="formControls col-7">
                <{$adinfo.email}>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>昵称：</label>
            <div class="formControls col-7">
                <{$adinfo.nickname}>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>名片一：</label>
            <div class="formControls col-7">
                <ul>
                    <li style="padding: 3px 0">姓名：<{$adinfo.name}></li>
                    <li style="padding: 3px 0"><span>单位：<{$adinfo.company}></span></li>
                    <li style="padding: 3px 0"><span>所在地：<{$adinfo.province}>/<{$adinfo.city}></span></li>
                    <li style="padding: 3px 0"><span>手机：<{$adinfo.phone}></span></li>
                    <li style="padding: 3px 0"><span>微信号：<{$adinfo.weixin}></span></li>
                    <li style="padding: 3px 0">头衔：<{$adinfo.title}></li>
                    <li style="padding: 3px 0"><span>职位：<{$adinfo.position}></span></li>
                    <li style="padding: 3px 0"><span>地址：<{$adinfo.address}></span></li>
                    <li style="padding: 3px 0"><span>邮箱：<{$adinfo.email1}></span></li>
                    <li style="padding: 3px 0"><span>QQ号：<{$adinfo.qq}></span></li>
                    <span>经营/研究领域:<br/></span><p style="text-indent: 2em;word-wrap : break-word;"><{$adinfo.content}></p>
                </ul>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>名片二：</label>
            <div class="formControls col-7">
                <ul>
                    <li style="padding: 3px 0">姓名：<{$adinfo.name1}></li>
                    <li style="padding: 3px 0"><span>单位：<{$adinfo.company1}></span></li>
                    <li style="padding: 3px 0"><span>所在地：<{$adinfo.province1}>/<{$adinfo.city1}></span></li>
                    <li style="padding: 3px 0"><span>手机：<{$adinfo.phone1}></span></li>
                    <li style="padding: 3px 0"><span>微信号：<{$adinfo.weixin1}></span></li>
                    <li style="padding: 3px 0">头衔：<{$adinfo.title1}></li>
                    <li style="padding: 3px 0"><span>职位：<{$adinfo.position1}></span></li>
                    <li style="padding: 3px 0"><span>地址：<{$adinfo.address1}></span></li>
                    <li style="padding: 3px 0"><span>邮箱：<{$adinfo.email2}></span></li>
                    <li style="padding: 3px 0"><span>QQ号：<{$adinfo.qq1}></span></li>
                    <span>经营/研究领域:<br/></span><p style="text-indent: 2em;word-wrap : break-word;"><{$adinfo.content1}></p>
                </ul>
            </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="button" onclick="location='/admin/member/export'" value="&nbsp;&nbsp;导出Excel&nbsp;&nbsp;">
            </div>
        </div>
</div>
</body>
</html>