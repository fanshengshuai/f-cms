{include "admin/public/header.tpl.php"}

<div class="pd-20">
    <form action="/admin/Message/update" method="post" class="form form-horizontal" id="form-member-add">
        <div class="row cl">
            <label class="form-label col-1"><span class="c-red">*</span>站内信标题：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" placeholder="" id="" name="title" value="<?php echo $info['title'];?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-1"><span class="c-red">*</span>站内信内容：</label>
            <div class="formControls col-10">
                <script id="editor" type="text/plain" name="content" style="width:100%;height:400px;"><?php echo $info['content'];?></script>
            </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                <input type="hidden" name="id" value="<?php echo $info['id'];?>"/>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        var ue = UE.getEditor('editor');
    });
</script>
{include "admin/public/footer.tpl.php"}