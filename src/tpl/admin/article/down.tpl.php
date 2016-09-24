<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/res/lib/html5.js"></script>
    <script type="text/javascript" src="/res/lib/respond.min.js"></script>
    <script type="text/javascript" src="/res/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="/res/admin/css/f-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/res/admin/css/f-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="/res/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />

    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.f-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>下载附件</title>
</head>
<body>
<div class="pd-20" style="margin-left: 100px">
    <div class="row cl">
        <label class="form-label col-2"><span class="c-red">*</span>提示：</label>
        <div class="formControls col-10" style="color: red">
          如果作者上传的是文档，则会下载，如果是图片则会在页面中打开。
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-2"><span class="c-red">*</span>附件1：</label>
        <div class="formControls col-7">
            {if $data['plugs1']}
            <a href="/PUBLIC_ROOTuploads/<?php echo $data['plugs1'];?>"  target="_blank">下载</a>
            {else}
            暂无
            {/if}
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-2"><span class="c-red">*</span>附件1：</label>
        <div class="formControls col-7">
            {if $data['plugs2']}
            <a href="/PUBLIC_ROOTuploads/<?php echo $data['plugs2'];?>" target="_blank">下载</a>
            {else}
            暂无
            {/if}
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-2"><span class="c-red">*</span>附件1：</label>
        <div class="formControls col-7">
            {if $data['plugs3']}
            <a href="/PUBLIC_ROOTuploads/<?php echo $data['plugs3'];?>" target="_blank">下载</a>
            {else}
            暂无
            {/if}
        </div>
    </div>
</div>
</body>
</html>