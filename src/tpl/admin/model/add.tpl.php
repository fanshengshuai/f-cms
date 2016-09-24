{include "admin/public/header.tpl.php"}

<!--<link href="<{$smarty.const.APP_RES}>/lib/icheck/icheck.css" rel="stylesheet" type="text/css"/>-->
<!--<link href="<{$smarty.const.APP_RES}>/lib/f-ui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css"/>-->

<!--<script type="text/javascript" src="<{$smarty.const.APP_RES}>/lib/icheck/jquery.icheck.min.js"></script>-->


<title>栏目设置</title>

<div class="pd-20">
    <form action="" method="post" class="form form-horizontal" id="form-category-add">
        <div id="tab-category" class="HuiTab">
            <div class="tabBar cl">
                <span>基本设置</span>
            </div>
            <div class="tabCon" style="display: block;">
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>模块名称：</label>
                    <div class="formControls col-6">
                        <input type="text" class="input-text" placeholder="" id="model_name" name="model_name" datatype="*2-16">
                    </div>
                    <div class="col-3" id="model_name_msg" style="color: red"></div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>模块标识：</label>
                    <div class="formControls col-6">
                        <input type="text" class="input-text" placeholder="" id="table_name" name="table_name" datatype="*2-16">(英文+数字)
                    </div>
                    <div class="col-3" id="table_name_msg" style="color: red"></div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>关联表：</label>
                    <div class="formControls col-6">
                        <input type="text" class="input-text" placeholder="" id="table_rel" name="table_rel" datatype="*2-16">
                    </div>
                    <div class="col-3" id="model_addon_msg"></div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">可录入：</label>
                    <div class="formControls col-6">
                        <input type="checkbox" name="readonly"/>
                    </div>
                    <div class="col-3" id="model_addon_msg"></div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">栏目管理：</label>
                    <div class="formControls col-6">
                        <input type="checkbox" name="has_cate"/>
                    </div>
                    <div class="col-3" id="model_addon_msg"></div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>附加表：</label>
                    <div class="formControls col-6">
                        <input type="text" class="input-text" placeholder="" id="model_addon" name="model_addon" datatype="*2-16">
                    </div>
                    <div class="col-3" id="model_addon_msg"></div>
                </div>
            </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    $('#form-category-add').submit(function(){
        var model_name = $('#model_name').val();
        var table_name = $('#table_name').val();
        document.getElementById('model_name_msg').innerHTML = '';
        document.getElementById('table_name_msg').innerHTML = '';
        if(!model_name){
            document.getElementById('model_name_msg').innerHTML = '请填写模块名称!';
            return false;
        }
        if(!table_name){
            document.getElementById('table_name_msg').innerHTML = '请填写模块标识!';
            return false;
        }
        return true;
    });
    $(function () {
//        $('.skin-minimal input').iCheck({
//            checkboxClass: 'icheckbox-blue',
//            radioClass: 'iradio-blue',
//            increaseArea: '20%'
//        });

        $("#form-article-category-add").Validform({
            tiptype: 2,
            callback: function (form) {
                form[0].submit();
                var index = parent.layer.getFrameIndex(window.name);
                parent.$('.btn-refresh').click();
                parent.layer.close(index);
            }
        });
        $.Huitab("#tab-category .tabBar span", "#tab-category .tabCon", "current", "click", "0");
    });
</script>
{include "admin/public/footer.tpl.php"}