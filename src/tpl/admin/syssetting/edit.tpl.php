{include "admin/public/header.tpl.php"}

<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 基本设置 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <form action="" method="post" class="form form-horizontal" id="form-article-add">
        <div id="tab-system" class="HuiTab">
            <div class="tabBar cl"><span>基本设置</span><span>安全设置</span><span>邮件设置</span><span>其他设置</span></div>
            <div class="tabCon">
                <div class="row cl">
                    <table>

                        {foreach from=$setting item=item}
                        <tr>
                            <td style="width:250px;">
                                <{$item.label}>
                            </td>
                            <td style="width:1200px;margin-right:1px;">
                                <div class="formControls col-10" style="">
                                    <input type="text" id="website-title" name="{$item.name}" value="{$item.setting_value}" class="input-text">
                                </div>
                            </td>
                            <td>
                            </td>
                        </tr>
                        {/foreach}
                    </table>
                    <label class="form-label col-2">
                    </label>
                </div>
            </div>
            <div><input type="hidden" name="id" value="<{$info.id}>"/></div>
        </div>
        <div class="row cl">
            <div class="col-10 col-offset-2">
                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="f-ui-iconfont">&#xe632;</i> 保存</button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
        $.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
    });
</script>
{include "admin/public/footer.tpl.php"}