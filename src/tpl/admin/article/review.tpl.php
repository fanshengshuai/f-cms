{include "admin/public/header.tpl.php"}

<div class="pd-20">
    <form action="/admin/article/doReview" method="post" class="form form-horizontal" id="form-admin-add">
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>标题：</label>
            <div class="formControls col-5">
                <?php echo $mm['title'];?>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>审核：</label>
            <div class="formControls col-5 skin-minimal">
                <div class="radio-box">
                    <input type="radio" id="sex-1" name="review" datatype="*" nullmsg="请选择！" value="1" checked="checked">
                    <label for="sex-1">通过</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="sex-2" name="review" value="2">
                    <label for="sex-2">不通过</label>
                </div>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                <input type="hidden" name="id" value="<?php echo $mm['id'];?>"/>
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
{include "admin/public/footer.tpl.php"}