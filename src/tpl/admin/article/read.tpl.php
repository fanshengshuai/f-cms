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
</head>
<body>
<div class="pd-20" style="width: 750px">
    <form action="/admin/Member/update" method="post" class="form form-horizontal" id="form-admin-add">
        <div class="row cl" style="display: block">
            <label class="form-label col-3"> 详情：</label>
            <div class="formControls col-5">
                <?php echo $data['content'];?>
            </div>
        </div>
        <div class="row cl" style="display: block">
            <label class="form-label col-3"> 备注：</label>
            <div class="formControls col-5">
                {if $data['mybz']}
                {$data['mybz']}
                {else}
                暂无
                {/if}
            </div>
        </div>
        <div class="row cl" style="display: block">
            <label class="form-label col-3"> 技术领域：</label>
            <div class="formControls col-5">
                <?php echo $data['keywords'];?>
            </div>
        </div>
        <div class="row cl" style="display: block">
            <label class="form-label col-3"> 行业领域：</label>
            <div class="formControls col-5">
                <?php echo $data['desn'];?>
            </div>
        </div>
    </form>
</div>
</body>
</html>