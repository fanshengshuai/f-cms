{include "admin/public/header.tpl.php"}

<title>基本设置</title>
<style>
    .td_label {
        padding-right: 20px;
        width: 150px;
        text-align: right;
    }

    .td_main {
        float: left;
        width: 600px;
    }

    .row tr {

    }

    .row table{

        width: 60%;
      padding-top: 50px;

    }



    .row td {
        vertical-align: middle;
        line-height: 16px;
        padding: 8px;
        margin-top: 9px;
    }
</style>
<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span
            class="c-gray en">&gt;</span> 基本设置 <a class="btn btn-success radius r mr-20"
                                                  style="line-height:1.6em;margin-top:3px"
                                                  href="javascript:location.replace(location.href);" title="刷新"><i
                class="f-ui-iconfont">&#xe68f;</i></a></nav>


<div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l">
       <!-- <a href="javascript:;" onclick="datadel()"
        class="btn btn-danger radius"><i class="f-ui-iconfont"></i>
        批量删除</a>-->
        <a class="btn btn-primary radius" href="/admin/global/settingAdd"><i class="f-ui-iconfont"></i>
            添加设置项目</a></span>
</div>

<div class="pd-20">
    <form action="" method="post" class="form form-horizontal" id="form-article-add">
        <div id="tab-system" class="HuiTab">
            <div class="">
                <div class="row cl">
                    <table>

                        {foreach from=$setting item=row}

                            <tr class="pic_del_ico">
<!--                                <td style="width:10px;text-align: left;max-width:10px;" >-->
<!--                                    <img src="<{$smarty.const.APP_RES}>/images/wxbt.png" class="del_ico" style="display:none;"/>-->
<!--                                </td>-->

                                <td class="td_label" style="margin-top:15px;">
                                    <?php echo $row['setting_title'];?>&nbsp;(<?php echo $row['setting_name'];?>)
                                </td>

                                <td class="formControls col-12"  >

                                        <input type="text" class="input-text"
                                               name="<?php echo $row['setting_name'];?>" value="<?php echo $row['setting_value'];?>"><?php echo$row['setting_summary'];?>
                                </td>


                                <td class="f-14-delete">
                                    <div style="width:30px;">



                                        <input  type="text" name="sort"  id="btn" class="input-text" style="width: 40px;"  onblur="myFunction(this,{$row['id']});" value="<?php echo $row['sort'];?>">

                                    </div>

                                </td>


                             <td class="td_label1" style="float:left;font-size: 14px;margin-bottom:7%;margin-left: -35%;">

                                 <a title="编辑" href="/admin/global/settingEdit?id=<?php echo $row['id'];?>"class="ml-5"><i class="f-ui-iconfont">&#xe6df;</i></a>
                                 <a id="Layer1" title="删除" onclick="system_database_del(this,'{$row.id}')" class="ml-5"><i class="f-ui-iconfont">&#xe6e2;</i></a>


                                    <?php /*echo $row['setting_summary'];*/?>
                                </td>
                            </tr>
                        {/foreach}


                    </table>
                </div>
            </div>
            <div><input type="hidden" name="id" value="<?php echo $info['id'];?>"/></div>
        </div>
        <div class="row cl">
            <div class="col-10 col-offset-2">
                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i
                            class="f-ui-iconfont">&#xe632;</i> 保存
                </button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">
                    &nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>

<!--排序-->
<script>
    function myFunction(obj,module_id)
    {

        if(document.getElementById('btn')) {

            $.post('/admin/model/setting_sort', {
                sort:obj.value,
                module_id: module_id

            });
        }
    }

</script>

<script>
  /* $(document).ready(function(){
        $("pic_del_ico").mouseover(function(){
                $(this).find(".del_ico").css("display","block")
            }
        )
        $("pic_del_ico").mouseleave(function(){
                $(this).find(".del_ico").css("display","none")
            }
        )
    });*/


    /*删除*/
    function system_database_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {

            $.getJSON('/admin/Global/settingDel?model={$modelData.id}&id=' + id, {}, function (retData) {
                if (retData.result == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                } else {
                    layer.msg('删除失败:' + retData.msg, {icon: 1, time: 1000});
                }
            });
        });
    }
    //显示隐藏垃圾图标
    $(document).ready(function(){
        $(".f-14-delete").mouseover(function(){
                $(this).find(".ml-5").css("display","block")
            }
        )
        $(".f-14-delete").mouseleave(function(){
                $(this).find(".ml-5").css("display","none")
            }
        )
    });







</script>
{include "admin/public/footer.tpl.php"}
