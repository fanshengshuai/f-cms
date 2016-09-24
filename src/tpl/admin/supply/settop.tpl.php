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
    <script type="text/javascript" src="/res/home/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/res/lib/My97DatePicker/WdatePicker.js"></script>
    <title>更新会员信息</title>
</head>
<body>
<div class="pd-20">
    <form action="/admin/Supply/doSetTop" method="post" class="form form-horizontal" id="form-admin-add">
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>标题：</label>
            <div class="formControls col-5">
                <?php echo$mm['title'];?>>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red"></span>置顶到期时间：</label>
            <div class="formControls col-5">
                <input type="text" onfocus="WdatePicker()" id="top_time" value="<?php echo $defaultTime;?>"
                       name="top_time" value="<?php echo $mm['top_time'];?>" class="input-text Wdate" style="width:200px;">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red"></span>置顶排序：</label>
            <div class="formControls col-5">
                <input type="text" name='top_order'  value="<?php echo$mm['top_order'];?>" class="input-text" id="f_top_order"  errormsg="排序号输入不正确！" ignore="ignore"/>            </div>
            <div class="col-4"> </div>
        </div>

        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                <input type="hidden" name="gq_id" value="<?php echo$mm['gq_id'];?>"/>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="//cdn.bootcss.com/jquery/1.12.1/jquery.min.js"></script>
<script type="text/javascript" src="/res/lib/icheck/jquery.icheck.min.js"></script>

<script type="text/javascript" src="/res/lib/layer/1.9.3/layer.js"></script>


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