{include "admin/public/header.tpl.php"}

<style>
    /*.cat-class-1 .cat-title {*/
    /*padding-left: 20px;*/
    /*}*/
</style>
<nav class="breadcrumb">
    <i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>
    系统管理 <span class="c-gray en">&gt;</span>
    模块管理
    <a class="btn btn-success radius r mr-20"
       style="line-height:1.6em;margin-top:3px"
       href="javascript:location.replace(location.href);" title="刷新"><i
            class="f-ui-iconfont">&#xe68f;</i></a>
</nav>

<div class="pd-20 text-c">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-primary radius" onclick="system_database_add('新建模块','/admin/model/add')"
               href="javascript:;"><i class="f-ui-iconfont">&#xe600;</i> 新建模块</a></span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="20">ID</th>
                <th width="100">模块名称</th>
                <th width="100">模块标识</th>
                <th width="50">关联</th>
                <th width="50">附加表</th>
                <th width="50">分类</th>
                <th width="50">只读</th>
                <th width="50">排序</th>
                <th class="text-l">管理</th>
            </tr>
            </thead>
            <tbody>

            {foreach from=$cats item=row}
            <tr class="text-c cat-class-{$row.class}">
                <td>{$row['id']}</td>
                <td>{$row.model_name}</td>
                <td><?php if ($row['table_name']) echo $row['table_name']; else echo '-'; ?></td>
                <td><?php if ($row['table_rel']) echo $row['table_rel']; else echo '-'; ?></td>
                <td><?php if ($row['model_addon']) echo $row['model_addon']; else echo '-'; ?></td>
                <td id="has_cate_{$row['id']}"
                    onclick="change_has_cate(this,{$row['id']})"><?php if ($row['has_cate']) echo '有'; else echo '-'; ?></td>
                <td id="readonly_{$row['id']}"
                    onclick="change_readonly(this,{$row['id']})"><?php if ($row['readonly']) echo '是'; else echo '-'; ?></td>

                <td><input type="text" name="sort" id="btn" class="input-text" style="width: 40px;"
                           onblur="myFunction(this,{$row['id']});" value="<?php echo $row['sort']; ?>"></td>


                <td class="f-14 text-l">
                    <a title="编辑" href="/admin/model/edit?id={$row.id}" style="text-decoration:none"><i
                            class="f-ui-iconfont">&#xe6df;</i></a>
                    <a title="删除" href="javascript:;" onclick="system_database_del(this,'{$row.id}')" class="ml-5"
                       style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i></a></td>
            </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
</div>
<!--排序-->
<script>
    function myFunction(obj, module_id) {

        if (document.getElementById('btn')) {

            $.post('/admin/model/change_btn', {
                sort: obj.value,
                module_id: module_id

            });
        }
    }

</script>

<script>
    function change_has_cate(job, module_id) {
        var html = document.getElementById('has_cate_' + module_id).innerText;
        var status = 0;
        if (html == "有") {
            document.getElementById('has_cate_' + module_id).innerText = "-";
        } else {
            document.getElementById('has_cate_' + module_id).innerText = "有";
            status = 1;
        }
        $.post('/admin/model/change_has_cate', {
            status: status,
            module_id: module_id
        });
    }
    function change_readonly(job, module_id) {
        var status = 0;
        var html = document.getElementById('readonly_' + module_id).innerText;
        if (html == "是") {
            document.getElementById('readonly_' + module_id).innerText = "-";
        } else {
            document.getElementById('readonly_' + module_id).innerText = "是";
            status = 1;
        }
        $.post('/admin/model/change_readonly', {
            status: status,
            module_id: module_id
        });
    }
</script>


<script type="text/javascript">
    /*$('.table-sort').dataTable({
     "aaSorting": [[1, "desc"]],//默认第几个排序
     "bStateSave": true,//状态保存
     "aoColumnDefs": [
     { "bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
     {
     "orderable": false, "aTargets": [0, 4]
     }// 制定列不参与排序
     ]
     });*/
    /*系统-栏目-添加*/
    function system_database_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*系统-栏目-删除*/
    function system_database_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {

            $.getJSON('/admin/model/del?id=' + id, {}, function (retData) {
                if (retData.result == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                } else {
                    layer.msg('删除失败:' + retData.msg, {icon: 2, time: 1000});
                }
            });
        });
    }

</script>

{include "admin/public/footer.tpl.php"}