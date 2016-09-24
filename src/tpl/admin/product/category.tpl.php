{include "admin/public/header.tpl.php"}

<nav class="breadcrumb">
    <i class="f-ui-iconfont">&#xe67f;</i>\
    首页 <span class="c-gray en">&gt;</span>
    系统管理 <span class="c-gray en">&gt;</span>
    栏目管理 <a class="btn btn-success radius r mr-20"
            style="line-height:1.6em;margin-top:3px"
            href="javascript:location.replace(location.href);" title="刷新"><i
            class="f-ui-iconfont">&#xe68f;</i></a>
</nav>

<div class="pd-20 text-c">
    <div class="text-c">
        <input type="text" name="" id="" placeholder="栏目名称、id" style="width:250px" class="input-text">
        <button name="" id="" class="btn btn-success" type="submit"><i class="f-ui-iconfont">&#xe665;</i> 搜索</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l"><a class="btn btn-primary radius"
                           onclick="system_category_add('添加资讯','/admin/product/categoryAdd')"
                           href="javascript:;"><i class="f-ui-iconfont">&#xe600;</i>
                添加栏目</a></span>
        <!--        <span class="r">共有数据：<strong>0</strong> 条</span>-->
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <!--                <th width="80">排序</th>-->
                <th>栏目名称</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>

            {foreach from=$cats item=row}
            <tr class="text-c cat-class-<?php echo $row['class']; ?>">
                <td><input type="checkbox" name="" value=""></td>
                <td><?php echo $row['id']; ?></td>
                <!--                    <td><{$row.sort}></td>-->
                <td class="text-l cat-title">

                    <?php if ($row['class'] == 0): ?>
                        <?php echo $row['name']; ?>
                        <span style="color: red">(一级菜单请勿删除!!!)</span>
                    <?php else: ?>
                        　<span style="color: #777;">|-</span> <?php echo $row['name']; ?>
                    <?php endif; ?>
                </td>
                <td class="f-14">
                    <a title="编辑" href="javascript:;"
                       onclick="system_category_edit('栏目编辑','/admin/product/categoryAdd?id=<?php echo $row['id']; ?>>','700','480')"
                       style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i>
                    </a>
                    <a title="删除" href="javascript:;"
                       onclick="system_category_del('栏目删除','/admin/product/categoryDel?id=<?php echo $row['id']; ?>>','700','480')"
                       style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i>
                    </a>
            </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function list_show(id) {
        if ($('.' + id).hasClass('hidden')) {
            $('.children').addClass('hidden');
            $('.' + id).removeClass('hidden');
        } else {
            $('.' + id).addClass('hidden');
        }
    }
    //    $('.table-sort').dataTable({
    //        "aaSorting": [[1, "desc"]],//默认第几个排序
    //        "bStateSave": true,//状态保存
    //        "aoColumnDefs": [
    //            //{ "bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
    //            {
    //                "orderable": false, "aTargets": [0, 4]
    //            }// 制定列不参与排序
    //        ]
    //    });
    /*系统-栏目-添加*/
    function system_category_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*系统-栏目-编辑*/
    function system_category_edit(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*系统-栏目-删除*/
    function system_category_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {

            $.getJSON('/admin/product/categoryDel?id=' + id, {}, function (retData) {
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

{include "admin/public/footer.tpl.php"}