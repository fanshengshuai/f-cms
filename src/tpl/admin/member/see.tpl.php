{include "admin/public/header.tpl.php"}

<div class="pd-20" style="margin-left: 100px">
    <div class="row cl">
        <label class="form-label col-2"><span class="c-red">*</span>用户类型：</label>
        <div class="formControls col-7">
            {if $adinfo.type == 2}企业{else}个人{/if}
        </div>
    </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>会员：</label>
            <div class="formControls col-7">
                {$adinfo.user_name}
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>手机：</label>
            <div class="formControls col-7">
                {$adinfo.phone}
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>邮箱：</label>
            <div class="formControls col-7">
                {$adinfo.email}
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>昵称：</label>
            <div class="formControls col-7">
                {$adinfo.nick_name}
            </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="button" onclick="location='/admin/member/export'" value="&nbsp;&nbsp;导出Excel&nbsp;&nbsp;">
            </div>
        </div>
</div>
{include "admin/public/header.tpl.php"}