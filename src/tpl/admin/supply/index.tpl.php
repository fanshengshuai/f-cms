<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,member-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/res/lib/html5.js"></script>
    <script type="text/javascript" src="/res/lib/respond.min.js"></script>
    <script type="text/javascript" src="/res/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="/res/admin/css/f-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="/res/admin/css/f-ui.admin.css" rel="stylesheet" type="text/css"/>
    <link href="/res/lib/f-ui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.f-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>供求管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 供求管理 <span
        class="c-gray en">&gt;</span> 供求审批 <a class="btn btn-success radius r mr-20"
                                              style="line-height:1.6em;margin-top:3px"
                                              href="javascript:location.replace(location.href);" title="刷新"><i
            class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <form action="/admin/Supply/index" method="post">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin"
                   name="datemin" value="<?php echo $datemin;?>" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})"
                   id="datemax" name="datemax" value="<?php echo $datemax;?>" class="input-text Wdate" style="width:120px;">
            <input type="text" class="input-text" style="width:250px" placeholder="输入标题关键字" id="" name="title"
                   value="<?php echo $title;?>">
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="f-ui-iconfont">&#xe665;</i> 搜供求
            </button>
        </div>
    </form>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            {if $gid <= 5}
            <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="f-ui-iconfont">&#xe6e2;</i> 批量删除</a>
            {/if}
            <a href="/admin/supply/export?s=excel_all"  class="btn btn-primary  radius">导出EXCEL</a>
        </span>
        <span class="r">共有数据：<strong><?php echo $count;?></strong> 条</span></div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="50">ID</th>
                <th width="50">分类</th>
                <th width="80">辣椒种类</th>
                <th width="80">类型</th>
                <th width="150">标题</th>
                <th width="90">供求用户</th>
                <th width="90">姓名</th>
                <th width="90">联系电话</th>
                <th width="80">仓储地</th>
                <th width="150">地址</th>
                <th width="130">时间</th>
                <th width="80">申请置顶</th>
                <th width="80">申请有效期</th>
                <th width="80">置顶到期</th>
                <th width="80">置顶排序</th>
                <th width="80">审核状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$ainfo item=vo}
            <tr class="text-c">
                <td><input type="checkbox" value="<?php echo $vo['gq_id'];?>" name="del"></td>
                <td><?php echo $vo['gq_id'];?>></td>
                <td>
                    {if $vo['gq_type'] == 1}
                    供应
                    {elseif $vo['gq_type'] == 2}
                    求购
                    {/if}
                </td>
                <td>{getLJTypeByIndex($vo['lj_type'])}

                </td>
                <td>
                    {if $vo['f_type'] == 0}
                    国内辣椒
                    {elseif $vo['f_type'] == 1}
                    国外供求
                    {elseif $vo['f_type'] == 2}
                    二手机械
                    {elseif $vo['f_type'] == 3}
                    于家村供求
                    {/if}
                </td>
                <td><u style="cursor:pointer" class="text-primary" onclick="supply_show('<?php echo $vo['gq_id'];?>','/admin/Supply/show?gq_id=<?php echo $vo['gq_id'];?>','<?php echo $vo['m_id'];?>','600','400')"><?php echo $vo['title'];?></u></td>
                <td><?php echo $vo['supply_name'];?></td>
                <td><?php echo $vo['name'];?></td>
                <td><?php echo $vo['phone'];?></td>
                <td><?php echo getCityByIndex($vo['city']);?></td>
                <td><?php echo $vo['address'];?></td>
                <td><?php echo date('Y-m-d H:i:s',$vo['rtime']);?></td>
                <td>
                    {if $vo['is_top'] == 1}
                    是
                    {/if}
                </td>
                <td><?php echo $vo['last_time'];?></td>
                <td>{if $vo['top_time']}{$vo['top_time']}{/if}</td>
                <td><?php echo $vo['top_order'];?></td>
                <td>
                    {if $vo['review'] == 1}
                    <span style="color:green;">已通过</span>
                    {elseif $vo['review'] == 2}
                    <span style="color:red;">未通过</span>
                    {else}
                    <span style="color:#000000;">未审核</span>
                    {/if}
                </td>

                <td class="td-manage">
                    <a style="text-decoration:none" class="ml-5" onClick="review('审核','/admin/Supply/review?gq_id={$vo['gq_id']}','{$vo['gq_id']}','600','270')" href="javascript:;" title="审核"><i class="f-ui-iconfont">&#xe61d;</i></a>
                    <a title="编辑" href="javascript:;" onclick="supply_edit('编辑供求信息','/admin/Supply/edit?gq_id={$vo['gq_id']}','{$vo['gq_id']}','600','800')" class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6df;</i></a>
                    {if $gid <= 5}
                    <a style="text-decoration:none" class="ml-5" onClick="set_top('置顶','/admin/Supply/settop?gq_id={$vo['gq_id']}','{$vo['gq_id']}','600','270')" href="javascript:;" title="置顶"><i class="f-ui-iconfont">&#xe6dc;</i></a>
                    <a title="删除" href="javascript:;" onclick="supply_del(this,'{$vo['gq_id']}')" class="ml-5" style="text-decoration:none"><i class="f-ui-iconfont">&#xe6e2;</i></a>
                    {/if}
                </td>
            </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="//cdn.bootcss.com/jquery/1.12.1/jquery.min.js"></script>
<script type="text/javascript" src="/res/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/res/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/res/lib/My97DatePicker/WdatePicker.js"></script>



<script type="text/javascript">
    $(function () {
        $('.table-sort').dataTable({
            "aaSorting": [[11, "desc"]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable": false, "aTargets": [0]}// 制定列不参与排序
            ]
        });
    });

    /*用户-查看*/
    function supply_show(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }

    /*用户-编辑*/
    function supply_edit(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*密码-审核*/
    function review(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*密码-置顶*/
    function set_top(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*用户-伪删除*/
    function supply_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.post('/admin/Supply/supply_del', {gq_id: id}, function (data) {
                if (data == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }
            });
        });
    }
    /*用户批量伪删除*/
    function datadel() {
        layer.confirm('确认要删除吗？', function (index) {
            var aa = '';
            $('input[name=del]:checked').each(function () {
                aa += ',' + $(this).val();
            });
            if (aa == '') {
                layer.msg('请选择要批量删除的信息!', {icon: 1, time: 1000});
            }
            $.post('/admin/Supply/supply_del', {gq_id: aa}, function (data) {
                if (data == 1) {
                    $('input[name=del]:checked').parents('tr').remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }
            });
        });
    }
</script>
</body>
</html>