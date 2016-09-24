{include "admin/public/header.tpl.php"}

<?php
$fields = json_decode($modelData['summary'], true);
plugin_init($modelData);
?>

<nav class="breadcrumb">
    <i class="f-ui-iconfont">&#xe67f;</i>
    首页 <span class="c-gray en">&gt;</span>
    内容管理 <span class="c-gray en">&gt;</span>
    {$modelData.model_name}
    <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px"
       href="javascript:location.replace(location.href);" title="刷新"><i
            class="f-ui-iconfont">&#xe68f;</i></a>
</nav>


<div class="pd-20">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <div class="l">
            <?php if (!$modelData['readonly']): ?>
                <a id="btn-bat-del" href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="f-ui-iconfont">
                        &#xe6e2;</i> 批量删除</a>
                <?php if (!$modelData['add']): ?>
                <a id="btn-add" class="btn btn-primary radius" href="/admin/content/add?model={$modelData.id}"><i
                        class="f-ui-iconfont">
                        &#xe600;</i> 添加</a>

                <?php endif; ?>

            <?php endif; ?>

         <!-- 导入-->
            <?php get_plugin_tpl('admin_opt_area_left', $modelData);?>
        </div>
        <div class="r">
           <!--查询-->
            <?php get_plugin_tpl('admin_opt_area_right', $modelData); ?>
        </div>
    </div>
</div>

<div class="pd-20">

    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="80">ID</th>
            {foreach from=$list[0]['show_list'] key=key item=val}
            <th><?php echo $key; ?></th>
            {/foreach}
            <th>管理</th>

        </tr>
        </thead>
        <tbody>
        {foreach from=$list item=row}
        <tr class="text-c cat-class-{$row.class}">
            <td><input type="checkbox" value="<?php echo $row['id']; ?>" name="del"></td>

            <td><?php echo $row['id']; ?></td>
            {foreach from=$row['show_list'] item=val}
            <td><?php echo $val; ?></td>


            {/foreach}
            <td class="f-14">
                <?php if (intval($_REQUEST['model']) != 12) { ?>
                    <a title="编辑" href="/admin/content/add?model={$modelData.id}&id={$row.id}"
                       style="text-decoration:none"><i
                            class="f-ui-iconfont">&#xe6df;</i></a>
                <?php } ?>
                <a title="删除" href="javascript:;" onclick="system_database_del(this,'{$row.id}')" class="ml-5"
                   style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i></a></td>
        </tr>
        {/foreach}
        </tbody>
    </table>
</div>
{include "public/pager.tpl.php"}


<script type="text/javascript">


    /*系统-栏目-删除*/
    function system_database_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {

            $.getJSON('/admin/content/del?model={$modelData.id}&id=' + id,{}, function (retData) {
                if (retData.result == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                } else {
                    layer.msg('删除失败:' + retData.msg, {icon: 1, time: 1000});
                }
            });
        });
    }







    /*批量删除*/
    function datadel() {
        var aa = '';
        $('input[name=del]:checked').each(function () {
            aa += ',' + $(this).val();
        });
        if (aa == '') {
            layer.msg('请选择要批量删除的文章!', {icon: 1, time: 1000});
        } else {
            layer.confirm('确认要删除吗？', function (index) {

                $.post('/admin/content/del?model={$modelData.id}', {id: aa}, function (retData) {
                    if (retData.result == 1) {
                        $('input[name=del]:checked').parents('tr').remove();
                        layer.msg('已删除!', {icon: 1, time: 1000});
                    }
                });
            });
        }
    }











</script>

{include "admin/public/footer.tpl.php"}