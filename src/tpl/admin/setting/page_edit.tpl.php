{include "admin/public/header.tpl.php"}

<link href="/res/lib/f-ui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="/res/lib/icheck/jquery.icheck.min.js"></script>


<title>栏目设置</title>

<div class="pd-20">
    <form action="" method="post" class="form form-horizontal" id="form-category-add">
        <div id="tab-category" class="HuiTab">
            <div class="tabBar cl">
                <span>基本设置</span>
                <span>模版设置</span><span>SEO</span>
            </div>
            <div class="tabCon">
                <div class="row cl">
                    <label class="form-label col-1"><span class="c-red">*</span>URL：</label>

                    <div class="formControls col-10">
                        <input type="text" class="input-text" value="<?php echo $page_info['url'];?>"  name="url1" datatype="*2-16"
                               nullmsg="URL不能为空">
                    </div>
                    <div class="col-3"></div>
                </div>
                <div class="row cl">
                    <label class="form-label col-1"><span class="c-red">*</span>样式：</label>
                    <div class="formControls col-10">
                        <textarea name="style" style="height: 280px;width: 100%"><?php echo $page_info['style'];?></textarea>
                    </div>
                    <div class="col-3"></div>
                </div>

                <div class="row cl">
                    <label class="form-label col-1"><span class="c-red">*</span>内容：</label>
                    <div class="formControls col-10">
                        <textarea name="content"  style="height: 280px;width: 100%"><?php echo $page_info['content'];?></textarea>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-1">
                <input class="btn btn-primary radius" type="hidden" value="<?php echo $page_info['id'];?>" name="id">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    $(function () {

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
