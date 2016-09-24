{include "admin/public/header.tpl.php"}

<style>
    /*.cat-class-1 .cat-title {*/
        /*padding-left: 20px;*/
    /*}*/
</style>

<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span
            class="c-gray en">&gt;</span> 数据库管理<span class="c-gray en">&gt;</span> 字段管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i
                class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20 text-c">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-primary radius" onclick="system_database_add1('添加字段','/admin/setting/databaseAddField?id=<?php echo $cats['id'];?>')" href="javascript:;"><i class="f-ui-iconfont">&#xe600;</i> 添加字段</a></span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">数据字段名</th>
                <th width="80">数据类型</th>
                <th width="80">备注</th>
                <th width="100">维护</th>
            </tr>
            </thead>
            <tbody>

            {foreach from=$data item=row}
                <tr class="text-c cat-class-<?php echo $row['class'];?>">
                    <td><?php echo $row['0'];?></td>
                    <td><?php echo $row['1'];?></td>
                    <td><?php echo $row['2'];?></td>
                    <td class="f-14">
                        <a title="编辑" href="/admin/setting/databaseEditField?table_name=<?php echo $cats['table_name'];?>&name=<?php echo $row['0'];?>&id=<?php echo $cats['id'];?>" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i></a>
                        <a title="删除" href='/admin/setting/databaseDelField?table_name=<?php echo $cats['table_name'];?>&name=<?php echo $row['0'];?>>&id=<?php echo$cats['id'];?>' class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i></a>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    /*系统-栏目-添加*/
    function system_database_add1(title, url, w, h) {
        layer_show(title, url, w, h);
    }
</script>

{include "admin/public/footer.tpl.php"}

