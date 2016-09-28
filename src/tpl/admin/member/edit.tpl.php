{include "admin/public/header.tpl.php"}

<div class="pd-20">
    <form action="/admin/member/update" method="post" class="form form-horizontal" id="form-admin-add">
        <div class="row cl">
            <label class="form-label col-3">会员：</label>
            <div class="formControls col-5">
                {$adinfo.user_name}
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>手机：</label>
            <div class="formControls col-5">
                <input type="text" class="input-text" value="{$adinfo.phone}" placeholder="" id="user-tel"
                       name="phone" datatype="m" nullmsg="手机不能为空">
            </div>
            <div class="col-4"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>邮箱：</label>
            <div class="formControls col-5">
                <input type="text" class="input-text" placeholder="@" name="email" id="email" datatype="e"
                       nullmsg="请输入邮箱！" value="{$adinfo.email}">
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>昵称：</label>
            <div class="formControls col-5">
                <input type="text" class="input-text" name="nick_name" id="nick_name" nullmsg="昵称！" value="{$adinfo.nick_name}"/>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                <input type="hidden" name="id" value="{$adinfo.id}"/>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function () {
        $("#form-admin-add").Validform({
            tiptype: 2,
            ajaxPost: true,
            callback: function (form) {
                if (form.status == "y") {
                    setTimeout(function () {
                        parent.location.reload();
                    }, 2000);
                }
            }
        });
    });
</script>


{include "admin/public/footer.tpl.php"}