{include "admin/public/header.tpl.php"}

<div class="pd-20">
    <form action="/admin/fragment/add" method="post" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>文章标题：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" placeholder="" name="title" value="{$info.title}">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>标识：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" placeholder="" name="name" value="{$info.name}">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-2">文章内容：</label>
            <div class="formControls col-10">
                <script id="editor" type="text/plain" name="content" style="width:100%;height:400px;">{$info.content}</script>
            </div>
        </div>
        <input type="hidden" name="id" value="{$info.id}"/>
        <div class="row cl">
            <div class="col-10 col-offset-2">
                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i
                        class="f-ui-iconfont">&#xe632;</i> 保存
                </button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="/res/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/res/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/res/lib/ueditor/1.4.3/ueditor.all.min.js"></script>
<script type="text/javascript" src="/res/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    $(function () {
        var ue = UE.getEditor('editor');
    });
</script>
{include "admin/public/footer.tpl.php"}