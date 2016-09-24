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

    .row td {
        vertical-align: middle;
        line-height: 30px;
        padding: 10px;
    }
</style>
<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span
            class="c-gray en">&gt;</span> 增加基本设置 <a class="btn btn-success radius r mr-20"
                                                    style="line-height:1.6em;margin-top:3px"
                                                    href="javascript:location.replace(location.href);" title="刷新"><i
                class="f-ui-iconfont">&#xe68f;</i></a></nav>


<div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l">
        <a href="/admin/global/setting" onclick="datadel()"
           class="btn btn-danger radius"><i class="f-ui-iconfont"><-</i>
            返回</a>
    </span>
</div>

<div class="pd-20">
    <form action="/admin/global/update" method="post" class="form form-horizontal" id="form-article-add">
        <div id="tab-system" class="HuiTab">
            <div class="row cl">
                <table>
                    <tr>
                        <td class="td_label" style=""> 显示名称：</td>
                        <td class="td_main" style="">
                            <div class="formControls col-6" style="">
                                <input type="text" id="" name="setting_title"
                                       value="<?php echo $item['setting_title'];?>" class="input-text">
                            </div>
                            <div class="formControls col-2" style="">
                                ＊必须填写
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_label" style=""> 类型：</td>
                        <td class="td_main" style="">
                            <div class="formControls col-6" style="">
                                <select name="setting_type" id="">
                                    <option value="int">整数</option>
                                    <option value="text">单行文本</option>
                                    <option value="multi_text">带格式文本</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_label" style=""> 标示符：</td>
                        <td class="td_main" style="">
                            <div class="formControls col-6" style="">
                                <input type="text" id="" name="setting_name"
                                       value="<?php echo $item['setting_name'];?>" class="input-text">
                            </div>
                            <div class="formControls col-2" style="">
                                ＊必须填写
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_label" style=""> 排序：</td>
                        <td class="td_main" style="">
                            <div class="formControls col-6" style="">
                                <input type="text" id="" name="sort"
                                       value="<?php echo $item['sort'];?>" class="input-text">
                            </div>
                            <div class="formControls col-2" style="">
                                ＊必须填写
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_label" style="">备注信息：</td>
                        <td class="td_main" style="">
                            <div class="formControls col-6" style="">
                                <input type="text" id="" name="setting_summary"
                                       value="<?php echo $item['setting_summary'];?>" class="input-text">
                            </div>
                            <div class="formControls col-2" style="">
                                ＊必须填写
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div><input type="hidden" name="id" value="<?php echo $item['id'];?>"/></div>
        </div>
        <div class="row cl">
            <div class="col-10 col-offset-2">
                <button class="btn btn-primary radius" type="submit"><i
                            class="f-ui-iconfont">&#xe632;</i> 保存
                </button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">
                    &nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>

{include "admin/public/footer.tpl.php"}
