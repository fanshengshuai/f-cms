<{include "public/header.tpl.php"}>

<title>基本设置</title>
<nav class="breadcrumb">
    <i class="f-ui-iconfont">&#xe67f;</i>
    首页 <span class="c-gray en">&gt;</span>
    权限设置
    <a class="btn btn-success radius r mr-20"
       style="line-height:1.6em;margin-top:3px"
       href="javascript:location.replace(location.href);" title="刷新"><i class="f-ui-iconfont">&#xe68f;</i></a>
</nav>

<?php if (0): ?>
<div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l">
        <a class="btn btn-primary radius" href="/admin/global/settingAdd"><i class="f-ui-iconfont"></i>
            添加用户组</a></span>
</div>
<?php endif; ?>

<div class="pd-20">
    <form action="" method="post" class="form form-horizontal" id="form-article-add">
        <div id="tab-system" class="HuiTab">
            <{*<div class="tabBar cl"><span>基本设置</span><span>安全设置</span><span>邮件设置</span><span>其他设置</span></div>*}>
            <div class="">
                <div class="row cl">
                    <table class="table table-border table-bordered table-bg">
                        <thead>
                        <tr>
                            <th scope="col" colspan="3">用户组设置</th>
                        </tr>
                        <tr class="text-c">
                            <th style="width: 100px;">用户组</th>
                            <th style="width: 100px;">国外供求查看权限</th>
                            <th>操作</th>
                        </tr>
                        </thead>

                        <{foreach from=$member_group item=row}>
                            <tr class="pic_del_ico">
                                <td style="width: 100px;">
                                    <{$row.group_name}>
                                </td>
                                <td  style="width: 100px;text-align:center;">
                                    <{if $row.inter_auth == 1}>
                                        <a title="" href="javascript:;" class="admin_audit label label-success radius" onclick="no_allow(this,'<{$row.gid}>')">允许</a>
                                    <{elseif $row.inter_auth == 2}>
                                        <a title="" href="javascript:;" class="admin_audit label radius" onclick="is_allow(this,'<{$row.gid}>')">禁止</a>
                                    <{/if}>
                                </td>
                                <td>
                                    <a onclick="layer_show('用户组编辑','/admin/group/modify?gid=<{$row.gid}>','800','500')" href="javascript:;">修改权限</a>
                                </td>
                            </tr>
                        <{/foreach}>
                    </table>
                </div>
            </div>
            <div><input type="hidden" name="id" value="<{$info.id}>"/></div>
        </div>
<!--        <div class="row cl">-->
<!--            <div class="col-10 col-offset-2">-->
<!--                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i-->
<!--                            class="f-ui-iconfont">&#xe632;</i> 保存-->
<!--                </button>-->
<!--                <button onClick="layer_close();" class="btn btn-default radius" type="button">-->
<!--                    &nbsp;&nbsp;取消&nbsp;&nbsp;</button>-->
<!--            </div>-->
<!--        </div>-->
    </form>
</div>
<script>
    //编辑
    function is_allow(obj,id){
        layer.confirm('确认要允许此用户组查看国外供求信息吗？',function(index){
            $.post('/admin/Group/allow', {id:id,audit:1}, function(data){
                if(data == 1) {
                    $(obj).parent().empty().html('<a title="" href="javascript:;" class="admin_audit label label-success radius" onclick="no_allow(this,'+id+')">允许</a>');
                    layer.msg('已允许!',{icon:1,time:1000});
                }else{
                    layer.msg('未完成，请重试',1);
                }
            });
        });
    }
    //编辑重新变成未编辑
    function no_allow(obj,id){
        layer.confirm('确认要禁止此用户组查看国外供求信息吗？',function(index){
            $.post('/admin/Group/allow', {id:id,audit:2}, function(data){
                if(data == 1) {
                    $(obj).parent().empty().html('<a title="" href="javascript:;" class="admin_audit label radius" onclick="is_allow(this,'+id+')">禁止</a>');
                    layer.msg('已禁止!',{icon:1,time:1000});
                }else{
                    layer.msg('未完成，请重试',1);
                }
            });
        });
    }
    $(document).ready(function () {
        $(".pic_del_ico").mouseover(function () {
                    $(this).find(".del_ico").css("display", "block")
                }
        )
        $(".pic_del_ico").mouseleave(function () {
                    $(this).find(".del_ico").css("display", "none")
                }
        )
    });
</script>
<{include "public/footer.tpl.php"}>