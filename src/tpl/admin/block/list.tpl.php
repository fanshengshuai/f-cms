<{include "public/header.tpl.php"}>
<div>
    <nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="f-ui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a class="btn btn-primary radius" onclick="product_add('添加产品','/admin/block/edit?bid=<{$block.bid}>')" href="javascript:;"><i class="f-ui-iconfont">&#xe600;</i> 添加。。</a></span>  </div>
        <div class="mt-20">
            <{foreach from=$block_list key=area item=block_area}>
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th colspan="10" style="text-align: left; background:#eee;">区域 <{$area}></th>
                </tr>
                <tr>
            <table class="table table-border table-bordered table-bg table-hover table-sort">
                <thead>
                <tr class="text-c">
<!--                    <th width="40"><input name="" type="checkbox" value=""></th>-->
                    <th width="40">标识</th>
                    <th width="60">显示名称</th>
                    <{*<th width="60">未定义字段</th>*}>
<!--                    <th width="100">单价</th>-->
                    <{*<th width="60">发布状态</th>*}>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                <{foreach name=block_area from=$block_area item=block}>
                <tr class="text-c va-m">
<!--                    <td><input name="" type="checkbox" value=""></td>-->
                    <td><{$block['bid']}></td>
                    <td class="text-l"><a href="/admin/block/edit?bid=<{$block.bid}>">&nbsp;<{$block['block_title']}></a></td>
                    <{*<td class="text-l"><{$block['block_name']}></td>*}>
                    <{*<td class="td-status"><span class="label label-success radius">已发布</span></td>*}>
                    <td class="td-manage">
                        <{*<a style="text-decoration:none" onClick="product_stop(this,'10001')" href="javascript:;" title="下架"><i class="f-ui-iconfont">&#xe6de;</i></a>*}>
                        <a href="/admin/block/edit?bid=<{$block.bid}>">修改</a>
<!--                        <a href="/admin/block/remove?bid=<{$block.bid}>">删除</a>-->
                        <{*<a style="text-decoration:none" class="ml-5" onClick="product_edit('产品编辑','product-add.html','10001')" href="javascript:;" title="编辑"><i class="f-ui-iconfont">&#xe6df;</i></a>*}>
                        <{*<a style="text-decoration:none" class="ml-5" onClick="product_del(this,'10001')" href="javascript:;" title="删除"><i class="f-ui-iconfont">&#xe6e2;</i></a>*}>
                    </td>
                </tr>
                <{/foreach}>
                </tbody>
            </table></tr>
            </table>
            <br/>
            <{/foreach}>
        </div>
    </div>
</div>
<script type="text/javascript">

    var code;

    function showCode(str) {
        if (!code) code = $("#code");
        code.empty();
        code.append("<li>"+str+"</li>");
    }


    /*图片-添加*/
    function product_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-查看*/
    function product_show(title,url,id){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-审核*/
    function product_shenhe(obj,id){
        layer.confirm('审核文章？', {
                btn: ['通过','不通过'],
                shade: false
            },
            function(){
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                $(obj).remove();
                layer.msg('已发布', {icon:6,time:1000});
            },
            function(){
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
                $(obj).remove();
                layer.msg('未通过', {icon:5,time:1000});
            });
    }
    /*图片-下架*/
    function product_stop(obj,id){
        layer.confirm('确认要下架吗？',function(index){
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_start(this,id)" href="javascript:;" title="发布"><i class="f-ui-iconfont">&#xe603;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
            $(obj).remove();
            layer.msg('已下架!',{icon: 5,time:1000});
        });
    }

    /*图片-发布*/
    function product_start(obj,id){
        layer.confirm('确认要发布吗？',function(index){
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_stop(this,id)" href="javascript:;" title="下架"><i class="f-ui-iconfont">&#xe6de;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布!',{icon: 6,time:1000});
        });
    }
    /*图片-申请上线*/
    function product_shenqing(obj,id){
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        $(obj).parents("tr").find(".td-manage").html("");
        layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
    }
    /*图片-编辑*/
    function product_edit(title,url,id){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-删除*/
    function product_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});
        });
    }
</script>
<!--</body>-->
<!--</html>-->

<br/>
<br/>
<br/>
<br/>
<{include "public/footer.tpl.php"}>
