{include "admin/public/header.tpl.php"}

<nav class="breadcrumb">
    <i class="f-ui-iconfont">&#xe67f;</i>
    首页 <span class="c-gray en">&gt;</span>
    管理员管理 <span class="c-gray en">&gt;</span>
    管理员列表
    <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px"
       href="javascript:location.replace(location.href);" title="刷新"><i class="f-ui-iconfont">&#xe68f;</i>
    </a>
</nav>
<div class="pd-20">
    <form action="/admin/admin/index" method="post">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin"
                   name="datemin" value="<?php echo $datemin; ?>" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})"
                   id="datemax" name="datemax" value="<?php echo $datemax; ?>" class="input-text Wdate"
                   style="width:120px;">
            <input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="username"
                   value="<?php echo $username; ?>">
            <button type="submit" class="btn btn-success" id="" name=""><i class="f-ui-iconfont">&#xe665;</i> 搜用户
            </button>
        </div>
    </form>
    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l"><a href="javascript:;" onclick="datadel()"
                                                               class="btn btn-danger radius"><i class="f-ui-iconfont">
                    &#xe6e2;</i> 批量删除</a> <a href="javascript:;"
                                             onclick="admin_add('添加管理员','/admin/admin/add','800','500')"
                                             class="btn btn-primary radius"><i class="f-ui-iconfont">&#xe600;</i>
                添加管理员</a></span> <span class="r">共有数据：<strong><?php echo $count; ?></strong> 条</span></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="9">员工列表</th>
        </tr>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="40">ID</th>
            <th width="*">登录名</th>
            <th width="90">手机</th>
            <th width="150">邮箱</th>
            <th width="150">角色</th>
            <th width="130">加入时间</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$ainfo item=vo}
        <tr class="text-c">
            <td><input type="checkbox" value="<?php echo $vo['a_id']; ?>" name="del"></td>
            <td><?php echo $vo['a_id']; ?></td>
            <td><?php echo $vo['username']; ?></td>
            <td><?php echo $vo['phone']; ?></td>
            <td><?php echo $vo['email']; ?></td>
            <td><?php echo $vo['role_id']; ?></td>
            <td><?php echo date('Y-m-d H:i:s', $vo['rtime']); ?></td>
            <td class="td-manage">
                <a title="编辑" href="javascript:;"
                   onclick="admin_edit('管理员编辑','/admin/admin/edit?a_id=<?php echo $vo['a_id']; ?>','<?php echo $vo['a_id']; ?>','800','500')"
                   class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i>
                </a>
                <a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo $vo['a_id']; ?>')"
                   class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i>
                </a>
            </td>
        </tr>
        {/foreach}
        </tbody>
    </table>
</div>
<script type="text/javascript" src="//cdn.bootcss.com/jquery/1.12.1/jquery.min.js"></script>
<script type="text/javascript" src="/res/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/res/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/res/lib/My97DatePicker/WdatePicker.js"></script>


<script type="text/javascript">
    /*
     参数解释：
     title	标题
     url		请求的url
     id		需要操作的数据id
     w		弹出层宽度（缺省调默认值）
     h		弹出层高度（缺省调默认值）
     */
    /*管理员-增加*/
    function admin_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*管理员-删除*/
    function admin_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.post('/admin/Admin/admin_del', {a_id: id}, function (data) {
                if (data == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }
            });
        });
    }
    /*管理员-编辑*/
    function admin_edit(title, url, id, w, h) {
//        $.post('/admin/Admin/edit',{a_id:id},function(data){});
        layer_show(title, url, w, h);
    }
    /*管理员-停用*/
    function admin_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.post('/admin/Admin/admin_stop', {a_id: id}, function (data) {
                if (data == 1) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="f-ui-iconfont">&#xe615;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label radius">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!', {icon: 5, time: 1000});
                }
            });
        });
    }
    ;

    /*管理员-启用*/
    function admin_start(obj, id) {
        layer.confirm('确认要启用吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.post('/admin/Admin/admin_start', {a_id: id}, function (data) {
                if (data == 1) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,' + id + ')" href="javascript:;" title="停用" style="text-decoration:none"><i class="f-ui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!', {icon: 6, time: 1000});
                }
            });
        });
    }
    /*管理员-批量删除*/
    function datadel() {
        var aa = '';
        $('input[name=del]:checked').each(function () {
            aa += ',' + $(this).val();
        });
        if (aa == '') {
            layer.msg('请选择要批量删除的管理员!', {icon: 1, time: 1000});
        }
        $.post('/admin/Admin/admin_del', {a_id: aa}, function (data) {
            if (data == 1) {
                $('input[name=del]:checked').parents('tr').remove();
                layer.msg('已删除!', {icon: 1, time: 1000});
            }
        });
    }
</script>
{include "admin/public/footer.tpl.php"}