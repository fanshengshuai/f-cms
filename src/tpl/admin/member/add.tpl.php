{include "admin/public/header.tpl.php"}

<div class="pd-20">
    <form action="/admin/Member/insert" method="post" class="form form-horizontal" id="form-member-add">
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>用户名：</label>
            <div class="formControls col-5">
                <input type="text" class="input-text" value="" placeholder="" id="user-name" name="username" datatype="/\w{5,16}/i" nullmsg="用户名不能为空" errormsg="请填写5到16位的数字、字母、下划线" ajaxurl="/admin/Member/addcheck">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>初始密码：</label>
            <div class="formControls col-5">
                <input type="password" name="password" placeholder="密码" autocomplete="off" value="" class="input-text" datatype="/\w{6,16}/i" nullmsg="密码不能为空" errormsg="请填写6到16位的数字，字母，下划线">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>确认密码：</label>
            <div class="formControls col-5">
                <input type="password"  placeholder="确认密码" autocomplete="off" class="input-text" errormsg="您两次输入的新密码不一致！" datatype="*" nullmsg="确认密码不能为空！" recheck="password" id="newpassword">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>昵称：</label>
            <div class="formControls col-5 skin-minimal">
                <input type="text" name="nickname"  autocomplete="off" value="" class="input-text" nullmsg="昵称不能为空" >
            </div>
            <div class="col-4"> </div>
        </div>
<!--        <div class="row cl">-->
<!--            <label class="form-label col-3"><span class="c-red">*</span>手机：</label>-->
<!--            <div class="formControls col-5">-->
<!--                <input type="text" class="input-text" value="" placeholder="" id="member-tel" name="phone"  datatype="m" nullmsg="手机不能为空">-->
<!--            </div>-->
<!--            <div class="col-4"> </div>-->
<!--        </div>-->
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>邮箱：</label>
            <div class="formControls col-5">
                <input type="text" class="input-text" placeholder="@" name="email" id="email" datatype="e" nullmsg="请输入邮箱！">
            </div>
            <div class="col-4"> </div>
        </div>
<!--        <div class="row cl">-->
<!--            <label class="form-label col-3"><span class="c-red">*</span>详细地址：</label>-->
<!--            <div class="formControls col-5">-->
<!--                <input type="text" class="input-text" placeholder="" name="address" id="address" datatype="s1-20" nullmsg="请输入地址！">-->
<!--            </div>-->
<!--            <div class="col-4"> </div>-->
<!--        </div>-->
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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

        $("#form-member-add").Validform({
            tiptype:2,
            ajaxPost:true,
            callback:function(form){
                if(form.status=="y"){
                    setTimeout(function(){
                        parent.location.reload();
                    },1000);
                }
            }
        });
    });
</script>
{include "admin/public/footer.tpl.php"}