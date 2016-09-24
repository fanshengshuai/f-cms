{include "admin/public/header.tpl.php"}

<?php
$fields = json_decode($modelData['summary'], true);
plugin_init($modelData);
?>

<title>新增文章</title>
<style>
    .error {
        background-color: #98ff8e
    }
</style>
<div class="pd-20">
    <form action="add" name="myform" method="post" class="form form-horizontal"
          id="form-article-add" enctype="multipart/form-data">

        <input type="hidden" name="model" value="{$modelData.id}"/>
        <?php
        get_plugin_tpl('admin_content_form_before', $modelData);
//        $func = "{$modelData['table_name']}AdminModifyFormBefore";
//        if (function_exists($func)) {
//            $func($modelData, $initData);
//        }

        if ($initData): ?>
            <input type="hidden" name="id" value="{$initData.id}"/>
        <?php endif; ?>

        <div class="row cl" id="row_title">
            <label class="form-label col-2">标题：</label>

            <div class="formControls col-8">
                <input type="text" class="input-text required" placeholder="" id="title" name="title"
                       value="{$initData['title']}">
            </div>
        </div>
        <?php if ($modelData['has_cate']): ?>
            <div class="row cl">
                <label class="form-label col-2">所属分类：</label>

                <div class="formControls col-8">
                    <select class="select" id="cate_id" name="cate_id" onchange="SetSubID(this);">
                        <option value="0">请选择分类</option>
                        {foreach from=$categoryArray item=item}
                        {if $item['class']==0}
                        <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                        {else}
                        <option value="<?php echo $item['id']; ?>" style="color: #5a98de;">
                            |-<?php echo $item['name']; ?></option>
                        {/if}
                        {/foreach}
                    </select>
                    <script type="text/javascript">
                        $(function () {
                            $('#cate_id').val('{$initData.cate_id}');
                        });
                    </script>
                </div>
            </div>
        <?php endif; ?>
        <?php
        $fields = json_decode($modelData['summary'], true);
        $fields_sys = array('id', 'title', 'cate_id', 'pic', 'lang', 'content', 'create_time', 'update_time', 'remote_time', 'status');

        $table_fields = array();
        foreach ($fields as $m):
            $table_fields[] = $m[0];
            if (in_array($m[0], $fields_sys)) continue;

            $inputType = 'text';
            $inputType = 'text';
            if (strpos($m[0], '_pic')) {
                $inputType = 'file';
            }
            ?>

            <div class="row cl">
                <label class="form-label col-2"><span class="c-red">*</span>{$m.2}：</label>

                <div class="formControls col-8">
                    <?php if($m[6]==0||$m[6]==''||$m[6]==null){ ?>
                    <input type="{$inputType}" class="input-text required" placeholder="" id="{$m.0}"
                           name="data[{$m.0}]"
                           value="{$initData[$m[0]]}">
                    <?php }elseif($m[6]==1){ ?>
                        <textarea style="width: 100%;height: 180px" class="input-text required" placeholder="" id="{$m.0}"
                               name="data[{$m.0}]">{$initData[$m[0]]}</textarea>
                    <?php }else{ ?>
                        <script id="editor" type="text/plain" name="data[{$m.0}]" style="width:100%;height:400px;">{$initData[$m[0]]}</script>
                    <?php } ?>
                </div>
            </div>

            <?php
        endforeach;
        if (!in_array('title', $table_fields)): ?>
            <script type="text/javascript">
                $('#row_title').remove();
            </script>
        <?php endif;
        if (in_array('pic', $table_fields)): ?>
            <div class="row cl">
                <label class="form-label col-2"><span class="c-red">*</span>上传图片：</label>
                <div class="formControls col-2">
                    <input type="text" id="pic" name="pic" class="required input-text"/>
                    <input type="file" placeholder="请选择图片" style="display: none" name="up_pic" id="up_pic"
                           onchange="document.getElementById('pic').value=this.value"/>
                </div>
            </div>
            <script type="text/javascript">
                <?php if (in_array('pic', $table_fields)): ?>
                $('#pic').click(function () {
                    $('#up_pic').click();
                });
                <?php endif; ?>
            </script>
        <?php endif;
        if (in_array('content', $table_fields)): ?>
            <div class="row cl">
                <label class="form-label col-2"><span class="c-red">*</span>文章内容：</label>
                <div class="formControls col-10">
                    <script id="editor" type="text/plain" name="content" style="width:100%;height:400px;"><?php
                        echo $initData['content']; ?></script>
                </div>
            </div>
        <?php endif;
        get_plugin_tpl('admin_content_form_after', $modelData);
        ?>

        <div class="row cl">
            <div class="col-10 col-offset-2">
                <input type="hidden" name="type" value="<?php echo $type; ?>">
                <button onClick="" class="btn btn-primary radius" type="submit"><i class="f-ui-iconfont">&#xe632;</i>
                    保存并提交
                </button>
                <button type="button" id="filePicker"></button>
                <button onClick="layer_close();" class="btn btn-default radius" type="reset">
                    &nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="//cdn.bootcss.com/jquery/1.12.1/jquery.min.js"></script>
<script type="text/javascript" src="/res/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/res/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/res/lib/icheck/jquery.icheck.min.js"></script>

<script type="text/javascript" src="/res/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/res/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/res/lib/ueditor/1.4.3/ueditor.all.min.js"></script>
<script type="text/javascript" src="/res/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>


<script>
    function changeF() {
        document.getElementById('txt').value = document.getElementById('sel').options[document.getElementById('sel').selectedIndex].value;
    }

    function content_del(obj,id){
        $.post('/admin/content/content_list_del?model=10',{
            id:id
        },function(retData){
            if(retData.result == 1){
                $("#content_list_"+id).remove();
            }else{
                alert('删除失败，请重试！');
            }
        });
    }

    function content_save(obj,id){
        var  reach_time = $("#reach_time_"+id).val();
        var  summary = $("#summary_"+id).val();
        $.post('/admin/content/content_list_save?model=10',{
            id:id,
            reach_time:reach_time,
            summary:summary
        },function(retData){
            if(retData.result == 1){
                alert('保存成功！');
            }else{
                alert('保存失败，请重试！');
            }
        });
    }

    function content_add(id){
        var  summary = $("#txt").val();
        $.post('/admin/content/content_list_add?model=10',{
            id:id,
            summary:summary
        },function(retData){
            if(retData.result == 1){
                var add_str = "";
                var str = document.getElementById("content_list_parent").innerHTML;
                add_str = str+"<tbody id='content_list_"+retData.id+"'><tr><td><input type='text' value='"+retData.time+"' id='reach_time_"+retData.id+"'></td><td><input type='text' value='"+retData.summary+"' id='summary_"+retData.id+"'></td><td><span style='cursor: pointer' onclick='content_del(this,"+retData.id+")'>删除</span><span onclick='content_save(this,"+retData.id+")' style='margin-left:10px;cursor: pointer'>保存</span></td></tr></tbody>";
                document.getElementById("content_list_parent").innerHTML = add_str;
            }else{
                alert('添加失败，请重试！');
            }
        });
    }
</script>
<script type="text/javascript">


    $('#form-article-add').submit(function () {
        var can_submit = true;

        <?php if (in_array('content', $table_fields)): ?>
        var content = $('#ueditor_textarea_content').val();
        if (content == 0 || typeof(content) == 'undefined') {
            can_submit = false;
            $('#editor').addClass('error');
            alert('文章内容为必填项目，请补充完整。');
            return false;
        }
        <?php endif; ?>

        $('.required').each(function (i, item) {
            $('.required').removeClass('error');
            if (_this.val() == '') {
                can_submit = false;
                $(this).addClass('error');
                alert('有项目为必填项目，请补充完整。');
                return false;
            }
        });

        return can_submit;
    });

    $(function () {
        <?php if (in_array('content', $table_fields)): ?>
        var ue = UE.getEditor('editor');
        <?php endif; ?>
    });

</script>
</body>
</html>