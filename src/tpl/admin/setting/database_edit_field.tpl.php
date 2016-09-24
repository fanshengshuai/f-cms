{include "admin/public/header.tpl.php"}

<link href="/res/lib/f-ui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="/res/lib/icheck/jquery.icheck.min.js"></script>


<title>栏目设置</title>

<div class="pd-20">
    <form action="" method="post" class="form form-horizontal" id="form-category-add">
        <div id="tab-category" class="HuiTab">
            <div class="tabBar cl">
                <span>基本设置</span>
            </div>
            <div class="tabCon">
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>字段名称：</label>
                    <div class="formControls col-6">
                        <input type="text" class="input-text" value="<?php echo $catData['0'];?>" placeholder="" id="field_name" name="field_name" datatype="*2-16">
                    </div>
                    <div class="col-3" style="color: red" id="field_name_msg"></div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>数据类型：</label>

                    <div class="formControls col-6">
                        <input type="text" class="input-text" value="<?php echo $catData['1'];?>" placeholder="" id="field_type" name="field_type" datatype="*2-16">
                    </div>
                    <div class="col-3" style="color: red" id="field_type_msg"></div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>备注：</label>

                    <div class="formControls col-6">
                        <input type="text" class="input-text" value="<?php echo $catData['2'];?>" placeholder="" id="field_summary" name="field_summary" datatype="*2-16">
                    </div>
                    <div class="col-3" style="color: red" id="field_summary_msg"></div>
                </div>
            </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input type="hidden" name="table_name" value="<?php echo $table_name;?>"/>
                <input type="hidden" name="field_name_old" value="<?php echo $catData['0'];?>"/>
                <input type="hidden" name="field_type_old" value="<?php echo $catData['1'];?>"/>
                <input type="hidden" name="id" value="<?php echo $id;?>"/>
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    $('#form-category-add').submit(function(){
        var module_name = $('#field_name').val();
        var table_name = $('#field_type').val();
        document.getElementById('field_name_msg').innerHTML = '';
        document.getElementById('field_type_msg').innerHTML = '';
        if(!module_name){
            document.getElementById('field_name_msg').innerHTML = '请填写字段名称!';
            return false;
        }
        if(!table_name){
            document.getElementById('field_type_msg').innerHTML = '请填写数据类型!';
            return false;
        }
        return true;
    });

    $(function () {
        $.Huitab("#tab-category .tabBar span", "#tab-category .tabCon", "current", "click", "0");
    });
</script>
{include "admin/public/footer.tpl.php"}
