<{include "public/header.tpl.php"}>

<div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l">
        <a class="btn btn-primary radius" href="/admin/Block/list"><i class="f-ui-iconfont">&#xe600;</i>
            返回列表</a>
    </span>
</div>

<div class="pd-20">
    <form action="/admin/block/edit" method="post" class="form form-horizontal" id="form-block-edit">
        <div class="row cl">
            <label class="form-label col-2">类型：</label>

            <div class="formControls col-10">
                <select name="block_type" id="block_type">
                    <option value="0">数据调用</option>
                    <option value="1">广告</option>
                    <option value="3">静态</option>
                </select>

                <script type="text/javascript">
                    $("#block_type").val(<{$block_data.block_type}>);
                </script>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>标识(请勿修改)：</label>
            <{if $block_data}>
            <div class="formControls col-10">
                <input type="text" class="input-text" style="display: none" value="<{$block_data.block_name}>" placeholder="" id="" name="block_name">
                <{$block_data.block_name}>
            </div>
            <{else}>
            <div class="formControls col-10">
                <input type="text" class="input-text" value="<{$block_data.block_name}>" placeholder="" id="" name="block_name">
            </div>
            <{/if}>
        </div>
        <div class="row cl">
            <label class="form-label col-2">显示标题：</label>

            <div class="formControls col-10">
                <input type="text" class="input-text" value="<{$block_data.block_title}>" placeholder="" id="" name="block_title">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-2">所在位置：</label>

            <div class="formControls col-10">
                <input type="text" class="input-text" value="<{$block_data.area}>" placeholder="" id="" name="area">
            </div>
        </div>
<!--        <div class="row cl">-->
<!--            <div class="col-10 col-offset-2">-->
<!--                <input type="hidden" name="bid" value="<{$block_data.bid}>"/>-->
<!--                <button class="btn btn-primary radius" type="submit"><i-->
<!--                            class="f-ui-iconfont">&#xe632;</i> 保存-->
<!--                </button>-->
<!--                <button onClick="layer_close();" class="btn btn-default radius" type="button">-->
<!--                    &nbsp;&nbsp;取消&nbsp;&nbsp;</button>-->
<!--            </div>-->
<!--        </div>-->
    </form>
</div>


<{if $block_data}>
<!--下半部分-->
<div style="margin:auto; width: 80%;">
    <div class="pd-20" style="margin-left: 0">
<{if $block_data.bid==1}>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a class="btn btn-primary radius" href="/admin/block/bItemEdit?bid=<{$block_data.bid}>"><i class="f-ui-iconfont">&#xe600;</i>
                    添加广告</a>
            </span>
        </div>
<{/if}>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort">
                <thead>
                <tr class="text-c">
                    <!--                    <th width="40"><input name="" type="checkbox" value=""></th>-->
<!--                    <th width="40">排序</th>-->
                    <th width="60">标题</th>
                    <th>简介</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <{foreach from=$block_item_list item=block_item}>
                    <tbody>
                    <tr class="text-c va-m">
                        <!--                    <td><input name="" type="checkbox" value=""></td>-->
<!--                        <td class="text-l"><input name="sort[<{$block_item['item_id']}>]"-->
<!--                                                  value="<{$block_item['sort']}>" class="form-control"-->
<!--                                                  style="width:50px;"/></td>-->
                        <td class="text-l"><a target="_blank" href="<{$block_item['url']}>"><{$block_item['title']}></a>
                        </td>
                        <td class="text-l"><a title="点击查看图片" target="_blank"
                                              href="<{$_F.s_url}>/uploads/<{$block_item['pic']}>"><{$block_item['pic']}>
                        </td>
                        <td class="td-manage">
                            <{*<a style="text-decoration:none" onClick="product_stop(this,'10001')"*}>
                                                 <{*href="javascript:;" title="下架"><i class="f-ui-iconfont">&#xe6de;</i></a>*}>
                            <a style="text-decoration:none" class="ml-5"
                               href="/admin/block/bItemEdit?bid=<{$bid}>&item_id=<{$block_item.item_id}>" title="编辑"><i
                                        class="f-ui-iconfont">&#xe6df;</i></a>
                            <{if $block_data.bid==1}>

                            <a style="text-decoration:none" class="ml-5"
                               href="/admin/block/bItemDelete?item_id=<{$block_item.item_id}>"
                                                                                 title="删除"><i class="f-ui-iconfont">
                                    &#xe6e2;</i></a>
                            <{/if}>

                        </td>
                    </tr>
                    </tbody>
                <{/foreach}>
            </table>
        </div>
    </div>
</div>
<{/if}>




<script type="text/javascript">


    var code;

    function showCode(str) {
        if (!code) code = $("#code");
        code.empty();
        code.append("<li>" + str + "</li>");
    }


    /*图片-添加*/
    function product_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-查看*/
    function product_show(title, url, id) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-审核*/
    function product_shenhe(obj, id) {
        layer.confirm('审核文章？', {
                    btn: ['通过', '不通过'],
                    shade: false
                },
                function () {
                    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                    $(obj).remove();
                    layer.msg('已发布', {icon: 6, time: 1000});
                },
                function () {
                    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
                    $(obj).remove();
                    layer.msg('未通过', {icon: 5, time: 1000});
                });
    }
    /*图片-下架*/
    function product_stop(obj, id) {
        layer.confirm('确认要下架吗？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_start(this,id)" href="javascript:;" title="发布"><i class="f-ui-iconfont">&#xe603;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
            $(obj).remove();
            layer.msg('已下架!', {icon: 5, time: 1000});
        });
    }

    /*图片-发布*/
    function product_start(obj, id) {
        layer.confirm('确认要发布吗？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_stop(this,id)" href="javascript:;" title="下架"><i class="f-ui-iconfont">&#xe6de;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布!', {icon: 6, time: 1000});
        });
    }
    /*图片-申请上线*/
    function product_shenqing(obj, id) {
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        $(obj).parents("tr").find(".td-manage").html("");
        layer.msg('已提交申请，耐心等待审核!', {icon: 1, time: 2000});
    }
    /*图片-编辑*/
    function product_edit(title, url, id) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-删除*/
    function product_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $(obj).parents("tr").remove();
            layer.msg('已删除!', {icon: 1, time: 1000});
        });
    }
</script>


<{include "public/footer.tpl.php"}>