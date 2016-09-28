{include "admin/public/header.tpl.php"}

<div class="pd-20">
    <form action="/admin/member/do_pwd" method="post" class="form form-horizontal" id="form-admin-add">
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red"></span>会员：</label>
            <div class="formControls col-5">
                {$minfo.user_name}
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red"></span>修改密码：</label>
            <div class="formControls col-5">
                <input type="password" name="password" placeholder="密码" autocomplete="off" value="" class="input-text" datatype="/\w{6,16}/i" nullmsg="密码不能为空" errormsg="请填写6到16位的数字，字母，下划线">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red"></span>确认密码：</label>
            <div class="formControls col-5">
                <input type="password"  placeholder="确认密码" autocomplete="off" class="input-text" errormsg="您两次输入的新密码不一致！" datatype="*" nullmsg="确认密码不能为空！" recheck="password" id="newpassword">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                <input type="hidden" name="id" value="{$minfo.id}"/>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $("#form-admin-add").Validform({
            tiptype:2,
            ajaxPost:true,
            callback:function(form){
                if(form.status=="y"){
                    setTimeout(function(){
                        $.Hidemsg(); //公用方法关闭信息提示框;
                        layer_close();//关闭弹出框口
                    },2000);
                }
            }
        });
    });
</script>
{include "admin/public/footer.tpl.php"}