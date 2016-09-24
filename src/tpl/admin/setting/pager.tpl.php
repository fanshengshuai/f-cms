{include "admin/public/header.tpl.php"}

<style>
    /*.cat-class-1 .cat-title {*/
        /*padding-left: 20px;*/
    /*}*/
</style>

<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 页面管理 <span
            class="c-gray en">&gt;</span> 页面列表 <a class="btn btn-success radius r mr-20"
                                                  style="line-height:1.6em;margin-top:3px"
                                                  href="javascript:location.replace(location.href);" title="刷新"><i
                class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20 text-c">
    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l"> <a class="btn btn-primary radius"
                                             onclick="system_page_add('添加页面','/admin/setting/pageAdd','1000','800')"
                                             href="javascript:;"><i class="f-ui-iconfont">&#xe600;</i> 添加页面</a></span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th width="80">URL</th>
                <th>样式</th>
                <th>内容</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$page_info item=row}
            <tr class="text-c cat-class-1">
                    <td><input type="checkbox" name="" value=""></td>
                    <td><?php echo $row['id'];?></td>
                    <td><a href="<?php echo $row['url'];?>" target="_black"><?php echo $row['url'];?></a></td>
                    <td><?php echo $row['style|strip_tags|truncate:100'];?></td>
                    <td><?php echo $row['content|strip_tags|truncate:100'];?></td>
                    <td class="f-14"><a title="编辑" href="javascript:;"
                                        onclick="system_page_edit('页面编辑','/admin/setting/pageEdit?id=<?php echo $row['id'];?>','1000','800')"
                                        style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i></a>
                        <a title="删除" href="javascript:;" onclick="system_page_del(this,'<?php echo $row['id'];?>')" class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i></a></td>
            </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function list_show(id){
        if($('.'+id).hasClass('hidden')){
            $('.children').addClass('hidden');
            $('.'+id).removeClass('hidden');
        }else{
            $('.'+id).addClass('hidden');
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
    function system_page_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*系统-栏目-编辑*/
    function system_page_edit(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*系统-栏目-删除*/
    function system_page_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {

            $.getJSON('/admin/setting/pageDel?id=' + id, {}, function (retData) {
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

include "admin/public/footer.tpl.php"}