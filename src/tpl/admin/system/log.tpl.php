{include "admin/public/header.tpl.php"}
<title>系统日志</title>
<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span
            class="c-gray en">&gt;</span> 系统日志 <a class="btn btn-success radius r mr-20"
                                                  style="line-height:1.6em;margin-top:3px"
                                                  href="javascript:location.replace(location.href);" title="刷新"><i
                class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l"><a href="javascript:;" onclick="datadel()"
                                                               class="btn btn-danger radius"><i class="f-ui-iconfont">
                    &#xe6e2;</i> 批量删除</a></span> <span class="r"></span></div>
    <table class="table table-border table-bordered table-bg table-hover table-sort">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="80">ID</th>
            <th width="100">类型</th>
            <th>内容</th>
            <th width="120">用户名</th>
            <th width="122">客户端IP</th>
            <th width="150">时间</th>
            <th width="70">操作</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$log_list item=row}
            <tr class="text-c">
                <td><input type="checkbox" value="<?php echo $row['id'];?>" name="del"></td>

                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['log_type'];?></td>
                <td><?php echo $row['content'];?></td>
                <td><?php echo $row['manager_name'];?></td>
                <td><?php echo $row['ip'];?></td>
                <td><?php echo $row['create_time'];?></td>
                <td>
<!--                    <a title="详情" href="javascript:;" onclick="system_log_show(this,'10001')" class="ml-5"-->
<!--                    style="text-decoration:none"><i class="f-ui-iconfont">&#xe665;</i></a>-->

                    <a title="删除"
                       href="javascript:;"
                       onclick="system_log_del(this,<?php echo $row['id'];?>)"
                       class="ml-5"
                       style="text-decoration:none"><i
                                class="f-ui-iconfont">&#xe6e2;</i></a>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
    <div id="pageNav" class="pageNav">{$pager}</div>
</div>
<script type="text/javascript" src="/res/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    /*系统-栏目-删除*/
    function system_log_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {

            $.getJSON('/admin/system/logDel?id=' + id, {}, function (retData) {
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
            layer.msg('请选择要批量删除的日记!', {icon: 1, time: 1000});
        }else
        {

            layer.confirm('确认要删除吗？', function (index) {

                $.post('/admin/System/systemdel', { id: aa}, function (data) {
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