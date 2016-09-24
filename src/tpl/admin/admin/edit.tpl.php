{include "admin/public/header.tpl.php"}
<div class="pd-20">
    <form action="/admin/Admin/update" method="post" class="form form-horizontal" id="form-admin-add">
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>管理员：</label>
            <div class="formControls col-5">
                <?php echo $adinfo['username'];?>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red"></span>修改密码：</label>
            <div class="formControls col-5">
                <input type="password" name="password" placeholder="密码" autocomplete="off" value="" class="input-text" datatype="/\w{6,16}/i" nullmsg="密码不能为空" errormsg="请填写6到16位的数字，字母，下划线" ignore="ignore">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red"></span>确认密码：</label>
            <div class="formControls col-5">
                <input type="password"  placeholder="确认密码" autocomplete="off" class="input-text" errormsg="您两次输入的新密码不一致！" datatype="*0-16" nullmsg="确认密码不能为空！" recheck="password" id="newpassword">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>性别：</label>
            <div class="formControls col-5 skin-minimal">
                <div class="radio-box">
                    <input type="radio" id="sex-1" name="sex" datatype="*" nullmsg="请选择性别！" value="1"  {if $adinfo.sex == 1}checked="checked"{/if}
                    <label for="sex-1">男</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="sex-2" name="sex" value="0" <{if $adinfo.sex == 0}>checked="checked"<{/if}>>
                    <label for="sex-2">女</label>
                </div>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>手机：</label>
            <div class="formControls col-5">
                <input type="text" class="input-text" value="<?php echo $adinfo['phone'];?>" placeholder="" id="user-tel" name="phone"  datatype="m" nullmsg="手机不能为空">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>邮箱：</label>
            <div class="formControls col-5">
                <input type="text" class="input-text" placeholder="@" name="email" id="email" datatype="e" nullmsg="请输入邮箱！" value="<?php echo $adinfo['email'];?>">
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3">角色：</label>
            <div class="formControls col-5"> <span class="select-box" style="width:150px;">
				<select class="select" name="role_id" size="1">
                    <option value="0" {if $adinfo.role_id == 0}selected="selected"{/if}>超级管理员</option>
                    <option value="1" {if $adinfo.role_id == 1}selected="selected"{/if}>总编</option>
                    <option value="2" {if $adinfo.role_id == 2}selected="selected"{/if}>栏目主辑</option>
                    <option value="3" {if $adinfo.role_id == 3}selected="selected"{/if}>栏目编辑</option>
                </select>
				</span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3">备注：</label>
            <div class="formControls col-5">
                <textarea name="remark" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="textarealength(this,100)"><?php echo $adinfo['remark'];?></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                <input type="hidden" name="a_id" value="<?php echo $adinfo['a_id'];?>"/>
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
{include "admin/public/footer.tpl.php"}