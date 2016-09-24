<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,member-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<{$smarty.const.APP_RES}>/lib/html5.js"></script>
    <script type="text/javascript" src="<{$smarty.const.APP_RES}>/lib/respond.min.js"></script>
    <script type="text/javascript" src="<{$smarty.const.APP_RES}>/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="<{$smarty.const.APP_RES}>/css/f-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="<{$smarty.const.APP_RES}>/css/f-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="<{$smarty.const.APP_RES}>/lib/f-ui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.f-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 信息管理 <span class="c-gray en">&gt;</span> 信息列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
            <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="f-ui-iconfont">&#xe6e2;</i> 批量删除</a>
        </span>
        <span class="r">共有数据：<strong><{$count}></strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th width="80">发信人</th>
                <th width="40">电话</th>
                <th width="100">邮箱</th>
                <th width="130">发信时间</th>
                <th width="130">内容</th>
                <th width="70">状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <{foreach from=$info item=vo}>
            <tr class="text-c">
                <td><input type="checkbox" value="<{$vo.m_id}>" name="del"></td>
                <td><{$vo.id}></td>
                <td> <{$vo.sender}></td>
                <td> <{$vo.phone}></td>
                <td><{$vo.mail}></td>
                <td><{$vo.create_time}></td>
                <td><{$vo.info|truncate:30}></td>
                <td><{if $vo.back}>已回复<{else}>未回复<{/if}></td>
                <td class="td-manage">
                    <a title="回复" href="javascript:;" onclick="member_edit('管理员回复','/admin/Member/reply_message?a_id=<{$vo.id}>','<{$vo.id}>','800','400')" class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i></a>
                    <a title="查看" href="javascript:;" onclick="member_edit('管理员查看','/admin/Member/edit_message?a_id=<{$vo.id}>','<{$vo.id}>','800','400')" class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe631;</i></a>
                    <a title="删除" href="javascript:;" onclick="member_del(this,'<{$vo.id}>')" class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i></a>
                </td>
            </tr>
            <{/foreach}>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.table-sort').dataTable({
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
            ]
        });
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
    function member_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-查看*/
    function member_show(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-停用*/

    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){
            $.post('/admin/Member/member_stop',{m_id:id},function(data){
                if(data == 1) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="member_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="f-ui-iconfont">&#xe615;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label radius">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!', {icon: 5, time: 1000});
                }
            });
        });
    }
    /*用户-启用*/
    function member_start(obj,id){
        layer.confirm('确认要启用吗？',function(index){
            $.post('/admin/Member/member_start',{m_id:id},function(data){
                if(data == 1){
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="member_stop(this,'+id+')" href="javascript:;" title="停用" style="text-decoration:none"><i class="f-ui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!', {icon: 6,time:1000});
                }
            });
        });
    }
    /*用户-编辑*/
    function member_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*密码-修改*/
    function change_password(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-伪删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.post('/admin/Member/member_del_message',{m_id:id},function(data){
                if(data == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }
            });
        });
    }
    /*用户批量伪删除*/
    function datadel(){
        var aa = '';
        $('input[name=del]:checked').each(function(){
            aa += ','+$(this).val();
        });
        if(aa == ''){
            layer.msg('请选择要批量删除的用户!',{icon:1,time:1000});
        }
        $.post('/admin/Member/member_del',{m_id:aa},function(data){
            if(data == 1) {
                $('input[name=del]:checked').parents('tr').remove();
                layer.msg('已删除!',{icon:1,time:1000});
            }
        });
    }
</script>
</body>
</html>