{include "admin/public/header.tpl.php"}

<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span
        class="c-gray en">&gt;</span> 数据库管理<span class="c-gray en">&gt;</span> 字段管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i
            class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20 text-c">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-primary radius" onclick="system_database_add1('添加字段','/admin/model/addField?id={$cats.id}')" href="javascript:;"><i class="f-ui-iconfont">&#xe600;</i> 添加字段</a></span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">数据字段名</th>
                <th width="80">数据类型</th>
                <th width="80">报表</th>
                <th width="80">备注</th>
                <th width="80">列表显示</th>
                <th width="30">排序</th>
                <th width="30">类型</th>
                <th width="100">维护</th>
            </tr>
            </thead>
            <tbody>
             <?php foreach($data as $key=> $row){?>
            <tr class="text-c cat-class-{$row.class}">
                <td>{$row[0]}</td>
                <td>{$row.1}</td>
                <td id="report_form_{$row[0]}"  onclick="report_form(this,{$cats.id},'{$row[0]}')"><?php if ($row['3']) echo '是'; else echo '-';?></td>
                <td>{$row.2}</td>
                <td id="column_display_{$row[0]}"  onclick="column_display(this,{$cats.id},'{$row[0]}')"><?php if ($row['4']) echo '是'; else echo '-';?></td>
                <td><input type="text" value="{$row.5}" class="input-text" style="width: 50px" onblur="save_info(this,'{$key}')"></td>
                <td><select onchange="change_type(this,'{$key}')">
                        <option <?php if($row[6]==0||$row[6]==''||$row[6]==null){echo "selected";} ?> value="0">单行文本</option>
                        <option <?php if($row[6]==1){echo "selected";} ?> value="1">多行文本</option>
                        <option <?php if($row[6]==2){echo "selected";} ?> value="2">编辑器</option>
                    </select></td>
                <td class="f-14">
                    <a title="编辑" href="/admin/model/editField?table_name={$cats.table_name}&name={$row.0}&id={$cats.id}" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i></a>
                    <a title="删除" href='/admin/model/delField?table_name={$cats.table_name}&name={$row.0}&id={$cats.id}' class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i></a>
                </td>
            </tr>
            <? } ?>
            </tbody>
        </table>
        <input type="hidden" value="{$cats.id}" id="cat_id_list">
    </div>
</div>
<script>
    function change_type(obj,key_value){
        var id = $("#cat_id_list").val();
        var value = $(obj).val();
        $.post('/admin/model/change_type?model=10',{
            key_value:key_value,
            id:id,
            value:value
        },function(retData){
        });
    }
    function save_info(obj,key_value){
        var id = $("#cat_id_list").val();
        var sort = $(obj).val();
        $.post('/admin/model/change_sort?model=10',{
            key_value:key_value,
            id:id,
            sort:sort
        },function(retData){
        });
    }

    function column_display(job, module_id,cat_name) {
        var html = document.getElementById('column_display_'+cat_name).innerText;
        var status = 0;
        if (html == "是") {
            document.getElementById('column_display_'+cat_name).innerText = "-";
        } else {
            document.getElementById('column_display_'+cat_name).innerText = "是";
            status = 1;
        }
        $.post('/admin/model/change_column_display',{
            status:status,
            cat_name:cat_name,
            module_id:module_id
        });
    }

    function report_form(job, module_id,cat_name) {
        var html = document.getElementById('report_form_'+cat_name).innerText;
        var status = 0;
        if (html == "是") {
            document.getElementById('report_form_'+cat_name).innerText = "-";
        } else {
            document.getElementById('report_form_'+cat_name).innerText = "是";
            status = 1;
        }
        $.post('/admin/model/change_report_form',{
            status:status,
            cat_name:cat_name,
            module_id:module_id
        });
    }
</script>
<script type="text/javascript">
    /*系统-栏目-添加*/
    function system_database_add1(title, url, w, h) {
        layer_show(title, url, w, h);
    }
</script>
{include "admin/public/footer.tpl.php"}