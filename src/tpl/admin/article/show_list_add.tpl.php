<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <script type="text/javascript" src="/res/js/jquery-1.9.1.min.js"></script>

    <!--[if lt IE 9]>
    <script type="text/javascript" src="/res/lib/html5.js"></script>
    <script type="text/javascript" src="/res/lib/respond.min.js"></script>
    <script type="text/javascript" src="/res/lib/PIE_IE678.js"></script>

    <![endif]-->
    <link href="/res/admin/css/f-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/res/admin/css/f-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="/res/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />

    <link href="/res/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/res/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>新增资讯</title>
    <style>
        .error{ background-color: #98ff8e
        }
    </style>
</head>
<body>
<div class="pd-20">
    <form action="/admin/Article/demand_ins" method="post" name="myform" class="form form-horizontal" id="form-article-add" enctype="multipart/form-data">
        <div class="row cl">
            <label class="form-label col-1"><span class="c-red">*</span>图片：</label>

            <div class="formControls col-8">
                <input type="text" class="input-text required" placeholder="" id="pic" name="pic" value="<?php echo $info['pic'];?>" onclick="$('#up_pic').click()">
                <input type="file" style="display: none" class="input-text" placeholder="" id="up_pic" name="up_pic" value="" onchange="document.getElementById('pic').value=this.value">
            <span style="color: red">{if $type==6}宽度1920px，高度500px{else}宽度400px，高度不限{/if}</span>
            </div>
        </div>
        <div class="row cl">
            <div class="col-10 col-offset-2">
                <input type="hidden" name="type" value="<?php echo $type;?>">
                <button onClick="" class="btn btn-primary radius" type="submit"><i class="f-ui-iconfont">&#xe632;</i> 保存并提交</button>
                <button  onClick="layer_close();" class="btn btn-default radius" type="reset">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>