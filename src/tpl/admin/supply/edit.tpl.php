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
    <title>编辑供求信息</title>
</head>
<body>
<div class="pd-20">
    <form action="/admin/Supply/update" method="post" class="form form-horizontal" id="form-admin-add">
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>ID：</label>
            <div class="formControls col-5">
                <?php echo $adinfo['gq_id'];?><input id="gq_id" name ="gq_id" value="<?php echo$adinfo['gq_id'];?>" type="hidden" />
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>分类：</label>
            <div class="formControls col-5 skin-minimal">
                <div class="radio-box">
                    <input type="radio" id="sex-1" name="gq_type" datatype="*" nullmsg="请选择！" value="1" {if $adinfo['gq_type'] == 1} checked="checked" {/if}>
                    <label for="sex-1">供应</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="sex-2" name="gq_type" value="2" {if $adinfo['gq_type'] == 2} checked="checked"{/if}>
                    <label for="sex-2">求购</label>
                </div>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>辣椒种类：</label>
            <div class="formControls col-5 skin-minimal">
                <select name="lj_type" id="" class="input-text">
                    <option value="0" {if $adinfo.lj_type == 0} selected="selected"{/if}>请选择</option>
                    <option value="1" {if $adinfo.lj_type == 1} selected="selected"{/if}>甜椒</option>
                    <option value="2" {if $adinfo.lj_type == 2} selected="selected"{/if}>朝天椒</option>
                    <option value="3" {if $adinfo.lj_type == 3} selected="selected"{/if}>金塔</option>
                    <option value="4" {if $adinfo.lj_type == 4} selected="selected"{/if}>北京红</option>
                    <option value="5" {if $adinfo.lj_type == 5} selected="selected"{/if}>冷冻北京红</option>
                    <option value="6" {if $adinfo.lj_type == 6} selected="selected"{/if}>冷冻金塔</option>
                    <option value="7" {if $adinfo.lj_type == 7} selected="selected"{/if}>冷冻益都红</option>
                    <option value="8" {if $adinfo.lj_type == 8} selected="selected"{/if}>辣椒粉</option>
                    <option value="9" {if $adinfo.lj_type == 9} selected="selected"{/if}>辣椒碎</option>
                    <option value="10" {if $adinfo.lj_type == 10} selected="selected"{/if}>辣椒红色素</option>
                    <option value="11" {if $adinfo.lj_type == 11} selected="selected"{/if}>辣椒籽</option>
                    <option value="12" {if $adinfo.lj_type == 12} selected="selected"{/if}>甜椒籽</option>
                    <option value="13" {if $adinfo.lj_type == 13}  selected="selected"{/if}>其他</option>
                </select>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>类型：</label>
            <div class="formControls col-5 skin-minimal">
                <select name="f_type" id="" class="input-text">
                    <option value="0" {if $adinfo.f_type == 0} selected="selected"{/if}>国内辣椒</option>
                    <option value="1" {if $adinfo.f_type == 1} selected="selected"{/if}>国外供求</option>
                    <option value="2" {if $adinfo.f_type == 2} selected="selected"{/if}>二手机械</option>
                    <option value="3"{if $adinfo.f_type == 3} selected="selected"{/if}>于家村供求</option>
                </select>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>标题：</label>
            <div class="formControls col-5">
                <input type="text" name='title' value="<?php echo $adinfo['title'];?>" class="input-text" id="f_title" datatype="s4-200" errormsg="至少4个字符,最多200个字符！"/>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>真实姓名：</label>
            <div class="formControls col-5">
                <input type="text" name='name' value="<?php echo $adinfo['name'];?>" class="input-text" id="name" datatype="s2-20" errormsg="请填写真实姓名！" nullmsg="请填写真实姓名！"/>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>联系电话：</label>
            <div class="formControls col-5">
                <input type="text" class="input-text" value="<?php echo $adinfo['phone'];?>" placeholder="" id="user-tel" name="phone"  datatype="m" nullmsg="手机不能为空" errormsg="请填写正确手机号">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>仓储地：</label>
            <div class="formControls col-5">
                <select name="city" id="personal_sd_area" class="input-text" nullmsg="请选择省份地区" errormsg="请选择省份地区" datatype="/^[1-9][0-9]?$/">
                </select>
            </div>
            <div class="col-4"> </div>
        </div>
        <script type="text/javascript">
            var s = ['请选择','安徽','北京','重庆','福建','甘肃','广东','广西','贵州','海南','河北','黑龙江','河南','香港','湖北','湖南','江苏','江西','吉林','辽宁','澳门','内蒙古','宁夏','青海','山东','上海','山西','陕西','四川','台湾','天津','新疆','西藏','云南','浙江'];
            var str = '';
            var city = {$adinfo['city']};
            $(function(){
                for(var i=0;i< s.length;i++){
                    str += '<option value="'+i+'">'+s[i]+'</option>';
                }
                $('#personal_sd_area').empty().append(str).val(city);
            })
        </script>
        <div class="row cl">
            <label class="form-label col-3">地址：</label>
            <div class="formControls col-5">
                <input type="text" name='address'  value="<?php echo $adinfo['address'];?>" class="input-text" id="address" datatype="s2-30" errormsg="长度要求2到30！" ignore="ignore"/>            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3">置顶有效期：</label>
            <div class="formControls col-5">
                <select name="last_time" id="last_time" class="personal_sd_select_2">
                    <option value="0" {if $adinfo.last_time == 0}selected="selected"{/if}>请选择</option>
                    <option value="5" {if $adinfo.last_time == 5}selected="selected"{/if}>5天之内</option>
                    <option value="10" {if $adinfo.last_time == 10}selected="selected"{/if}>10天之内</option>
                    <option value="30" {if $adinfo.last_time == 30}selected="selected"{/if}>30天之内</option>
                    <option value="60" {if $adinfo.last_time == 60}selected="selected"{/if}>60天之内</option>
                </select>
                            </div>
            <div class="col-4"> </div>
        </div>

        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                <input type="hidden" name="m_id" value="{$adinfo['m_id']}"/>
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