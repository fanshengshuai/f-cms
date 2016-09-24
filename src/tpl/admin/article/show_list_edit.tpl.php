<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <script type="text/javascript" src="/res/js/jquery-1.9.1.min.js"></script>

    <script type="text/javascript" src="/res/js/jquery.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/res/js/jquery.js"></script>
    <script type="text/javascript" src="/res/lib/html5.js"></script>
    <script type="text/javascript" src="/res/lib/respond.min.js"></script>
    <script type="text/javascript" src="/res/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="/res/admin/css/f-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="/res/admin/css/f-ui.admin.css" rel="stylesheet" type="text/css"/>
    <link href="/res/admin/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/res/lib/f-ui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.f-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>修改新闻资讯</title>
    <style>
        .error {
            background-color: #98ff8e
        }
    </style>
</head>
<body>
<div class="pd-20">
    <form action="/admin/Article/update" name="myform" method="post" class="form form-horizontal" id="form-article-add"
          enctype="multipart/form-data">
        <div class="row cl">
            <label class="form-label col-1"><span class="c-red">*</span>图片：</label>

            <div class="formControls col-8">
                <input type="text" class="input-text required" placeholder="" id="pic" name="pic" value="<?php $info['pic'];?>" onclick="$('#up_pic').click()">
                <input type="file" style="display: none" class="input-text" placeholder="" id="up_pic" name="up_pic" value="" onchange="document.getElementById('pic').value=this.value">
                <span style="color: red"><{if $info.type==6}>宽度1920px，高度500px<{else}>宽度400px，高度不限<{/if}></span>
            </div>
        </div>
        <div class="row cl">
            <input type="hidden" name="id" value="<?php echo $info['id'];?>">
            <div class="col-10 col-offset-2">
                <button class="btn btn-primary radius" type="submit"><i class="f-ui-iconfont">&#xe632;</i> 保存并提交</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>