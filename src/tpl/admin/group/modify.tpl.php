<{include "public/header.tpl.php"}>
<table class="table table-border table-bordered table-bg">
    <thead>
    <tr class="text-c">
        <th style="width: 100px;">用户组</th>
        <td class="text-l"><{$group_info.group_name}></td>
    </tr>
    <tr class="text-c">
        <th style="width: 100px;">权限</th>
        <td class="text-l">请在下面分类打钩选择，点选之后马上生效</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="2">
            <table class="table table-border table-bordered table-bg">
                <{foreach from=$cats item=row}>
                    <{if $row.class eq 0}>
                        <tr>
                            <th>
                                <{$row.name}>
                            </th>
                        </tr>
                    <{else}>
                        <tr>
                            <td>
                                <{if $row.class eq 1}>

                                    <{if $row.child eq 1}>
                                        <div><{$row.name}></div>
                                    <{else}>
                                        <label>
                                            <input id="checkbox_<{$gid}>_<{$row.id}>" class="setGroupCat"
                                                   type="checkbox"
                                                   value="<{$row.id}>"
                                                   name="cate"/> <{$row.name}></label>
                                    <{/if}>

                                <{elseif $row.class eq 2}>
                                    <label><input id="checkbox_<{$gid}>_<{$row.id}>" type="checkbox" class="setGroupCat"
                                                  value="<{$row.id}>"
                                                  name="cate"/> <{$row.name}></label>
                                <{/if}>
                            </td>
                        </tr>
                    <{/if}>
                <{/foreach}>
            </table>
        </td>
    </tr>
    </tbody>
</table>

<script>
    $(function () {
        <{foreach from=$group_cat item=row}>
        $('#checkbox_<{$row.gid}>_<{$row.cat_id}>').attr('checked', 'checked');
        <{/foreach}>
    });

    $('.setGroupCat').click(function () {
        console.log(this);
        selectCat(this);
    });

    function selectCat(obj) {
        obj = $(obj);
        var id = obj.attr('id');
        var result = /.+_(.+)_(.+)/.exec(id);
        var gid = result[1];
        var cat_id = result[2];
        console.log(gid, cat_id);

        $.get("/admin/group/selectCat", {
            gid: gid,
            cat_id: cat_id,
            select: obj.is(":checked") ? 1 : 2
        }, function (retData) {
        });
    }

</script>

<{include "public/footer.tpl.php"}>