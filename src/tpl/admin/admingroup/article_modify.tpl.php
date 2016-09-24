{include "admin/public/header.tpl.php"}
<table class="table table-border table-bordered table-bg"  style="width:500px;margin: 0 auto;">
    <thead>
    <tr class="text-c">
        <th style="width: 100px;">管理员组</th>
        <td class="text-l"><?php echo $art_group_info['name'];?></td>
    </tr>
    <tr class="text-c">
        <th style="width: 100px;">权限</th>
        <td class="text-l">请在下面分类打钩选择，提交之后生效</td>
    </tr>
    <tr class="text-c">
        <th style="width: 100px;">敬告</th>
        <td class="text-l" style="color:red;">必须给该管理员组资讯管理的权限后此文章权限才会生效</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="2">
            <form action="" method="post">
            <table class="table table-border table-bordered table-bg">
                {foreach from=$cats item=row}
                {if $row['class'] == 0}
                <tr>
                    <th>
                        <?php echo $row['name'];?>
                    </th>
                </tr>
                {else}
                <tr>
                    <td>
                        {if $row['class']==1}

                        {if $row['child'] == 1}
                        <div><?php echo$row['name'];?></div>
                        {else}
                        <label>
                            <input id="checkbox_{$gid}_{$row.id}" class="setGroupCat"
                                   type="checkbox"
                                   value="<?php echo$row['id'];?>"
                                   name="cms[]"/> <?php echo $row['name'];?></label>
                        {/if}

                        {elseif $row['class'] == 2}
                        <label><input id="checkbox_{$gid}_{$row['id']}" type="checkbox" class="setGroupCat"
                                      value="<?php echo $row['id'];?>"
                                      name="cms[]"/> <?php echo $row['name'];?></label>
                        {/if}
                    </td>
                </tr>
                {/if}
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
        {foreach from=$art_group_info['cms_role ']item=row}
        $('#checkbox_{$gid}_{$row}').attr('checked', 'checked');
        {/foreach}
    });
</script>

{include "admin/public/footer.tpl.php"}