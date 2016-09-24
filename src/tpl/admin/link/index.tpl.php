{include "admin/public/header.tpl.php"}

<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 其他版块 <span
        class="c-gray en">&gt;</span> 友情链接 <a class="btn btn-success radius r mr-20"
                                              style="line-height:1.6em;margin-top:3px"
                                              href="javascript:location.replace(location.href);" title="刷新"><i
            class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l"><a href="/admin/Link/add" class="btn btn-primary radius"><i class="f-ui-iconfont">&#xe600;</i>
                添加友情链接</a></span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="200">标题</th>
                <th width="200">URL</th>
                <th width="150">位置</th>
                <th width="150">排序</th>
                <th width="150">操作</th>
            </tr>
            </thead>
            <tbody>
            <{foreach from=$info item=vo}>
            <tr class="text-c">
                <td><{$vo.id}></td>
                <td><{$vo.title}></td>
                <td><{$vo.url}></td>
                <td>
                    <{if $vo.sort == 1}>
                    上层
                    <{elseif $vo.sort == 2}>
                    下层
                    <{/if}>
                </td>
                <td><{$vo.link_sort}></td>
                <td class="td-manage">
                    <a title="编辑" href="/admin/Link/add?id=<{$vo.id}>" class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i></a>
                    <a title="删除" href="javascript:;" onclick="link_del(this,'<{$vo.id}>')" class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i></a>
                </td>
            </tr>
            <{/foreach}>
            </tbody>
        </table>
        <{include "public/pager.tpl.php"}>
    </div>
</div>
<script type="text/javascript">
    /*删除*/
    function link_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.post('/admin/Link/del', {id: id}, function (data) {
                if (data == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }
            });
        });
    }
</script>
{include "admin/public/footer.tpl.php"}