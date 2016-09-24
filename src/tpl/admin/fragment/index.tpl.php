{include "admin/public/header.tpl.php"}

<nav class="breadcrumb">
    <i class="f-ui-iconfont">&#xe67f;</i>
    首页 <span class="c-gray en">&gt;</span>
    内容管理 <span class="c-gray en">&gt;</span>
    文章管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px"
            href="javascript:location.replace(location.href);" title="刷新"><i class="f-ui-iconfont">&#xe68f;</i></a>
</nav>
<div class="pd-20 text-c">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <div class="l">
            <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="f-ui-iconfont">
                    &#xe6e2;</i> 批量删除</a>
            <a class="btn btn-primary radius" href="/admin/fragment/add"><i class="f-ui-iconfont">&#xe600;</i> 添加</a>
        </div>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">标示</th>
                <th width="120">标题</th>
                <th class="text-l">操作</th>
            </tr>
            </thead>
            <tbody>

            {foreach from=$list item=row}
            <tr class="text-c cat-class-{$row.class}">
                <td><input type="checkbox" name="del" value="<?php echo $row['id'];?>"></td>
                <td>{$row.name}</td>
                <td><a target="_blank" href="/front/a/viewF?id={$row.id}">{$row.title}</a></td>
                <td class="f-14 text-l">
                    <a title="编辑" href="/admin/fragment/add?id={$row.id}"
                       style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i></a>
                    <a title="删除" href="javascript:;" onclick="f_del(this,'{$row.id}')"
                       class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i>
                    </a>
                </td>
            </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

    /*系统-栏目-删除*/
    function f_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {

            $.getJSON('/admin/fragment/del?id=' + id, {}, function (retData) {
                if (retData.result == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                } else {
                    layer.msg('删除失败!', {icon: 1, time: 1000});
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
            layer.msg('请选择要批量删除的内容!', {icon: 1, time: 1000});
        }else
        {

            layer.confirm('确认要删除吗？', function (index) {

                $.post('/admin/fragment/fragment_del', { id: aa}, function (data) {
                    if (data == 1) {
                        $('input[name=del]:checked').parents('tr').remove();
                        layer.msg('已删除!', {icon: 1, time: 1000});
                    }
                });

            });

        }

    }



</script>
{include "admin/public/footer.tpl.php"}