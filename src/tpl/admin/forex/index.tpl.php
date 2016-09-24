<{include "public/header.tpl.php"}>

<style>
    /*.cat-class-1 .cat-title {*/
    /*padding-left: 20px;*/
    /*}*/
</style>

<nav class="breadcrumb">
    <i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 内容管理 <span
            class="c-gray en">&gt;</span> 国际_外汇
    <a class="btn btn-success radius r mr-20"
       style="line-height:1.6em;margin-top:3px"
       href="javascript:location.replace(location.href);" title="刷新"><i class="f-ui-iconfont">&#xe68f;</i></a>
</nav>
<div class="pd-20 text-c">
    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l"><a href="javascript:;" onclick="datadel()"
                                                               class="btn btn-danger radius"><i class="f-ui-iconfont"> &#xe6e2;</i> 批量删除</a>
 <a class="btn btn-primary radius" href="/admin/forex/add"><i class="f-ui-iconfont">&#xe600;</i> 添加外汇</a></span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <!--<th width="25"><input type="checkbox" name="" value=""></th>-->
                <th width="80">币种</th>
                <th width="120">中间价</th>
                <th width="120">排序</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            <{foreach from=$data item=row}>
                <tr class="text-c">
                    <!--<td><input type="checkbox" name="" value=""></td>-->
                    <td><{$row.currency}></td>
                    <td><{$row.unit}></td>
                    <td><{$row.sort}></td>
                    <td class="f-14">
                        <a title="编辑" href="/admin/forex/edit?id=<{$row.id}>"
                           style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i></a>
                        <a title="删除" href="javascript:;" onclick="f_del(this,'<{$row.id}>')"
                           class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i>
                        </a>
                    </td>
                </tr>
                <{/foreach}>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

    /*系统-栏目-删除*/
    function f_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {

            $.getJSON('/admin/Forex/del?id=' + id, {}, function (retData) {
                if (retData.result == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                } else {
                    layer.msg('删除失败!', {icon: 1, time: 1000});
                }
            });
        });
    }
</script>

<{include "public/footer.tpl.php"}>
