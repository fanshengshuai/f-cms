{include "admin/public/header.tpl.php"}

<div class="pd-20">
    <form action="/admin/Link/add" method="post" class="form form-horizontal" id="form-member-add">
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>友情链接标题：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" placeholder="" id="" name="title" value="<{$info.title}>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>友情链接URL：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" placeholder="" id="" name="url" value="<{$info.url}>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>友情链接所在位置：</label>
            <div class="formControls col-10">
                <select name="sort" id="" class="input-text" >
                    <option value="1" <{if $info.sort ==1}>selected="selected"<{/if}>>上层</option>
                    <option value="2" <{if $info.sort ==2}>selected="selected"<{/if}>>下层</option>
                </select>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>友情链接排序:(数值大排在前边)</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" placeholder="" id="" name="link_sort" value="<{$info.link_sort}>">
            </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                <{if $info}>
                <input type="hidden" name="id" value="<{$info.id}>"/>
                <{/if}>
            </div>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    $(function(){
        var ue = UE.getEditor('editor');
    });
</script>
{include "admin/public/footer.tpl.php"}