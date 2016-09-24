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
    <title>删除的用户</title>
</head>
<body>
<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 删除的用户<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <form action="/admin/Member/deletedlist" method="post">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" name="datemin" value="<{$datemin}>" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" name="datemax" value="<{$datemax}>" class="input-text Wdate" style="width:120px;">
            <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称" id="" name="username" value="<{$username}>">
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="f-ui-iconfont">&#xe665;</i> 搜用户</button>
        </div>
    </form>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="f-ui-iconfont">&#xe6e2;</i> 批量删除</a> </span> <span class="r">共有数据：<strong><{$count}></strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th width="100">用户名</th>
                <th width="40">昵称</th>
                <th width="150">邮箱</th>
                <th width="130">加入时间</th>
                <th width="70">状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <{foreach from=$ainfo item=vo}>
            <tr class="text-c">
                <td><input type="checkbox" value="<{$vo.m_id}>" name="del"></td>
                <td><{$vo.m_id}></td>
                <td><u style="cursor:pointer" class="text-primary" onclick="member_show('<{$vo.username}>','/admin/Member/show?m_id=<{$vo.m_id}>','<{$vo.m_id}>','360','400')"><{$vo.username}></u></td>
                <td> <{$vo.nickname}></td>
                <td><{$vo.email}></td>
                <td><{date('Y-m-d H:i:s',$vo.rtime)}></td>
                <td class="td-status"><span class="label label-danger radius">已删除</span></td>
                <td class="td-manage"><a style="text-decoration:none" href="javascript:;" onClick="member_huanyuan(this,'<{$vo.m_id}>')" title="还原"><i class="f-ui-iconfont">&#xe66b;</i></a> <a title="彻底删除" href="javascript:;" onclick="member_del(this,'<{$vo.m_id}>')" class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i></a></td>
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

    /*用户-还原*/
    function member_huanyuan(obj,id){
        layer.confirm('确认要还原吗？',function(index){
            $.post('/admin/Member/member_hy',{m_id:id},function(data){
                if(data == 1){
                    location.reload();
                    layer.msg('已还原!',{icon: 6,time:1000});
                }
            });

        });
    }

    /*用户-彻底删除*/
    function member_del(obj,id){
        layer.confirm('确认要彻底删除吗？',function(index){
            $.post('/admin/Member/all_delete',{m_id:id},function(data){
                if(data == 1){
                    $(obj).parents("tr").remove();
                    layer.msg('已彻底删除!',{icon:1,time:1000});
                }
            });

        });
    }
    /*用户批量彻底删除*/
    function datadel(){
        var aa = '';
        $('input[name=del]:checked').each(function(){
            aa += ','+$(this).val();
        });
        if(aa == ''){
            layer.msg('请选择要批量删除的用户!',{icon:1,time:1000});
        }
        $.post('/admin/Member/all_delete',{m_id:aa},function(data){
            if(data == 1) {
                $('input[name=del]:checked').parents('tr').remove();
                layer.msg('已彻底删除!',{icon:1,time:1000});
            }
        });
    }
    /*用户-查看*/
    function member_show(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
</script>
</body>
</html>