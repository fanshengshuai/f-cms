{include "admin/public/header.tpl.php"}
<table class="table table-border table-bordered table-bg" style="width:500px;margin: 0 auto;">
    <thead>
    <tr class="text-c">
        <th style="width: 100px;">管理员组</th>
        <td class="text-l"><{$group_info.name}></td>
    </tr>
    <tr class="text-c">
        <th style="width: 100px;">权限</th>
        <td class="text-l">请在下面分类打钩选择，提交之后生效</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="2">
            <form action="" method="post">
            <table class="table table-border table-bordered table-bg">
                {foreach from=$g_info key=k item=v}
                <tr>
                    <td>
                        <?php echo $v['name'];?>
                    </td>
                </tr>
                    {foreach from=$v['action_group'] key=ke item=va}
                    <tr>
                        <td>
                            <label><input id="checkbox_{$k}_{$ke}" class="setGroupCat" type="checkbox" value="<{$k}>/<{$ke}>" name="cate[]"/><?php echo$v['name'];?><?php echo$va['name'];?></label>
                        </td>
                    </tr>
                    {/foreach}
                {/foreach}
                <tr>
                    <td style="text-align: center;">
                        <input type="submit" value="提交"/>
                    </td>
                </tr>
            </table>
            </form>
        </td>
    </tr>
    </tbody>
</table>

<script>
    $(function () {
        {foreach from=$group_info['sys_role'] item=row}
        $('#checkbox_{$row}').attr('checked', 'checked');
        {/foreach}
    });
</script>

{include "admin/public/footer.tpl.php"}