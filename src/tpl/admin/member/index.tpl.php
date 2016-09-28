{include "admin/public/header.tpl.php"}

<nav class="breadcrumb">
    <i class="f-ui-iconfont">&#xe67f;</i>
    首页 <span class="c-gray en">&gt;</span>
    用户中心 <span class="c-gray en">&gt;</span>
    用户管理
    <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px"
       href="javascript:location.replace(location.href);" title="刷新"><i
            class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
                <i class="f-ui-iconfont"> &#xe6e2;</i> 批量删除
            </a>
            <a href="/admin/member/export_all" class="btn btn-primary radius"><i class="f-ui-iconfont">&#xe600;</i>批量导出</a></span>
        <span class="r">共有数据：<strong>{$count}</strong> 条</span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="25">序号</th>
                <th width="40">ID</th>
                <th width="100">用户名</th>
                <th width="*">昵称</th>
                <th width="150">邮箱</th>
                <th width="130">加入时间</th>
                <th width="70">类型</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$ainfo item=vo}
            <tr class="text-c">
                <td><input type="checkbox" value="{$vo.id}" name="del"></td>
                <td>{$vo.key}</td>
                <td>{$vo.id}</td>
                <td class="text-l">{$vo.user_name}</td>
                <td> {$vo.nick_name}</td>
                <td>{$vo.email}</td>
                <td>{$vo.create_time}</td>
                {if $vo["status"] == 1}
                <td class="td-status"><span class="label label-success radius">{if $vo.type==2}企业{else}个人{/if}</span>
                </td>
                <td class="td-manage">
                    <a style="text-decoration:none"
                       onClick="member_See('管理员查看','/admin/Member/see?a_id={$vo.id}','{$vo.id}','800','600')"
                       href="javascript:;" title="查看详细资料">
                        <i class="f-ui-iconfont">&#xe631;</i></a>
                    <a title="编辑" href="javascript:;"
                       onclick="member_edit('管理员编辑','/admin/Member/edit?a_id={$vo.id}','{$vo.id}','800','400')"
                       class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i></a> <a
                        style="text-decoration:none" class="ml-5"
                        onClick="change_password('修改密码','/admin/Member/change_pwd?id={$vo.id}','{$vo.id}','600','270')"
                        href="javascript:;" title="修改密码"><i class="f-ui-iconfont">&#xe63f;</i></a> <a title="删除"
                                                                                                      href="javascript:;"
                                                                                                      onclick="member_del(this,'{$vo.id}')"
                                                                                                      class="ml-5"
                                                                                                      style="text-decoration:none"><i
                            class="f-ui-iconfont">&#xe6e2;</i></a></td>
                {elseif $vo.status == 0}
                <td class="td-status"><span class="label radius">已停用</span></td>
                <td class="td-manage"><a style="text-decoration:none" onClick="member_start(this,'{$vo.id}')"
                                         href="javascript:;" title="启用"><i class="f-ui-iconfont">&#xe615;</i></a> <a
                        title="编辑" href="javascript:;"
                        onclick="member_edit('管理员编辑','/admin/Member/edit?a_id={$vo.id}','{$vo.id}','800','400')"
                        class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i></a> <a
                        style="text-decoration:none" class="ml-5"
                        onClick="change_password('修改密码','/admin/Member/change_pwd?id={$vo.id}','{$vo.id}','600','270')"
                        href="javascript:;" title="修改密码"><i class="f-ui-iconfont">&#xe63f;</i></a> <a title="删除"
                                                                                                      href="javascript:;"
                                                                                                      onclick="member_del(this,'{$vo.id}')"
                                                                                                      class="ml-5"
                                                                                                      style="text-decoration:none"><i
                            class="f-ui-iconfont">&#xe6e2;</i></a></td>
                {/if}
            </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(function () {
//        $('.table-sort').dataTable({
//            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
//            "bStateSave": true,//状态保存
//            "aoColumnDefs": [
//                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
//                {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
//            ]
//        });
//        $('.table-sort tbody').on( 'click', 'tr', function () {
//            if ( $(this).hasClass('selected') ) {
//                $(this).removeClass('selected');
//            }
//            else {
//                table.$('tr.selected').removeClass('selected');
//                $(this).addClass('selected');
//            }
//        });
    });
    /*用户-添加*/
    function member_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*用户-查看*/
    function member_show(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*用户-停用*/

    function member_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {
            $.post('/admin/Member/member_stop', {id: id}, function (data) {
                if (data == 1) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="member_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="f-ui-iconfont">&#xe615;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label radius">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!', {icon: 5, time: 1000});
                }
            });
        });
    }
    /*用户-启用*/
    function member_start(obj, id) {
        layer.confirm('确认要启用吗？', function (index) {
            $.post('/admin/Member/member_start', {id: id}, function (data) {
                if (data == 1) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="member_stop(this,' + id + ')" href="javascript:;" title="停用" style="text-decoration:none"><i class="f-ui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!', {icon: 6, time: 1000});
                }
            });
        });
    }
    /*用户-编辑*/
    function member_edit(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }

    /*用户-编辑*/
    function member_See(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*密码-修改*/
    function change_password(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*用户-伪删除*/
    function member_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.post('/admin/member/member_del', {id: id}, function (data) {
                if (data == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }
            });
        });
    }
    /*用户批量伪删除*/
    function datadel() {
        var aa = '';
        $('input[name=del]:checked').each(function () {
            aa += ',' + $(this).val();
        });
        if (aa == '') {
            layer.msg('请选择要批量删除的用户!', {icon: 1, time: 1000});
        }
        $.post('/admin/Member/member_del', {id: aa}, function (data) {
            if (data == 1) {
                $('input[name=del]:checked').parents('tr').remove();
                layer.msg('已删除!', {icon: 1, time: 1000});
            }
        });
    }
</script>
{include "admin/public/footer.tpl.php"}