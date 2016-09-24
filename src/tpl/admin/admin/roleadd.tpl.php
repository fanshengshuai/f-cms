{include "admin/public/header.tpl.php"}

<div class="pd-20">
    <form action="" method="post" class="form form-horizontal" id="form-user-character-add">
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>角色名称：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" value="" placeholder="" id="user-name" name="user-name" datatype="*4-16" nullmsg="用户账户不能为空">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2">备注：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" value="" placeholder="" id="" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2">网站角色：</label>
            <div class="formControls col-10">
                <dl class="permission-list">
                    <dt>
                        <label>
                            <input type="checkbox" value="" name="user-Character-0" id="user-Character-0">
                            资讯管理</label>
                    </dt>
                    <dd>
                        <dl class="cl permission-list2">
                            <dt>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-0" id="user-Character-0-0">
                                    栏目管理</label>
                            </dt>
                            <dd>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-0-0" id="user-Character-0-0-0">
                                    添加</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-0-0" id="user-Character-0-0-1">
                                    修改</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-0-0" id="user-Character-0-0-2">
                                    删除</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-0-0" id="user-Character-0-0-3">
                                    查看</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-0-0" id="user-Character-0-0-4">
                                    审核</label>
                                <label class="c-orange"><input type="checkbox" value="" name="user-Character-0-0-0" id="user-Character-0-0-5"> 只能操作自己发布的</label>
                            </dd>
                        </dl>
                        <dl class="cl permission-list2">
                            <dt>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-1" id="user-Character-0-1">
                                    文章管理</label>
                            </dt>
                            <dd>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-1-0" id="user-Character-0-1-0">
                                    添加</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-1-0" id="user-Character-0-1-1">
                                    修改</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-1-0" id="user-Character-0-1-2">
                                    删除</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-1-0" id="user-Character-0-1-3">
                                    查看</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-0-1-0" id="user-Character-0-1-4">
                                    审核</label>
                                <label class="c-orange"><input type="checkbox" value="" name="user-Character-0-2-0" id="user-Character-0-2-5"> 只能操作自己发布的</label>
                            </dd>
                        </dl>
                    </dd>
                </dl>
                <dl class="permission-list">
                    <dt>
                        <label>
                            <input type="checkbox" value="" name="user-Character-0" id="user-Character-1">
                            用户中心</label>
                    </dt>
                    <dd>
                        <dl class="cl permission-list2">
                            <dt>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-1-0" id="user-Character-1-0">
                                    用户管理</label>
                            </dt>
                            <dd>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-1-0-0" id="user-Character-1-0-0">
                                    添加</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-1-0-0" id="user-Character-1-0-1">
                                    修改</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-1-0-0" id="user-Character-1-0-2">
                                    删除</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-1-0-0" id="user-Character-1-0-3">
                                    查看</label>
                                <label class="">
                                    <input type="checkbox" value="" name="user-Character-1-0-0" id="user-Character-1-0-4">
                                    审核</label>
                            </dd>
                        </dl>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="row cl">
            <div class="col-10 col-offset-2">
                <button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="//cdn.bootcss.com/jquery/1.12.1/jquery.min.js"></script>
<script type="text/javascript" src="/res/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/res/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/res/lib/My97DatePicker/WdatePicker.js"></script>


<script>
    $(function(){
        $(".permission-list dt input:checkbox").click(function(){
            $(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
        });
        $(".permission-list2 dd input:checkbox").click(function(){
            var l =$(this).parent().parent().find("input:checked").length;
            var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
            if($(this).prop("checked")){
                $(this).closest("dl").find("dt input:checkbox").prop("checked",true);
                $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
            }
            else{
                if(l==0){
                    $(this).closest("dl").find("dt input:checkbox").prop("checked",false);
                }
                if(l2==0){
                    $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
                }
            }

        });
    });
</script>
{include "admin/public/footer.tpl.php"}