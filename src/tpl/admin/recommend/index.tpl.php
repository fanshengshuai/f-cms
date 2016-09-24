{include "admin/public/header.tpl.php"}

<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 推荐管理 <span class="c-gray en">&gt;</span> 推荐列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <form action="/admin/recommend/index" method="get">
    <div class="text-c">
<!--        <span class="select-box inline">-->
<!--                <select name="num" class="select" id="">-->
<!--                    <option value="10" <{if $num == 10}>selected="selected"<{/if}>>显示10条</option>-->
<!--                    <option value="25" <{if $num == 25}>selected="selected"<{/if}>>显示25条</option>-->
<!--                    <option value="50" <{if $num == 50}>selected="selected"<{/if}>>显示50条</option>-->
<!--                    <option value="100" <{if $num == 100}>selected="selected"<{/if}>>显示100条</option>-->
<!--                </select>-->
<!--		</span>&nbsp;&nbsp;&nbsp;&nbsp;-->
        <span class="select-box inline">
				<select name="cat_id" class="select" id="select_back">
                    <option value="">请选择</option>
                    <option value="1" {if $cat_id == 1}selected="selected"{/if}>国  内-会员企业推介</option>
                    <option value="2" {if $cat_id == 2}selected="selected"{/if}>于家村-会员风采</option>
                    <option value="3" {if $cat_id == 3}selected="selected"{/if}>E辣椒-推荐企业</option>
                </select>
        </span>&nbsp;&nbsp;&nbsp;&nbsp;

        <input type="text" name="title" value="<?php echo $title;?>" placeholder=" 推荐标题" style="width:250px" class="input-text"/>
        <button name="" id="" class="btn btn-success" type="submit"><i class="f-ui-iconfont">&#xe665;</i> 搜索</button>

    </div>
</form>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            {if $gid <= 5}
            <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="f-ui-iconfont">&#xe6e2;</i> 批量删除</a>
            {/if}
            <a class="btn btn-primary radius"  href="/admin/Recommend/add"><i class="f-ui-iconfont">&#xe600;</i> 添加推荐</a>
        </span>
        <span class="r">共有数据：<strong><?php echo $page_info['total'];?></strong> 条</span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th width="240">标题</th>
                <th width="80">分类</th>
                <th width="80">排序</th>
                <th width="240">URL</th>
                <th width="120">添加时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach from="$info" item="item"}
            <tr class="text-c">
                <td><input type="checkbox" value="<?php $item['id'];?>" name="del"></td>
                <td><?php echo $item['id'];?></td>
                <td><?php echo $item['title'];?></td>
                <td>
                    <?php if ($item['cat_id'] == 1){
                    echo 国内-会员企业推介;}
                    elseif ($item['cat_id'] == 2){
                    echo 于家村-会员风采;}
                    elseif ($item['cat_id'] == 3){
                    echo E辣椒-推荐企业;}
                    ?>
                </td>
                <td><?php $item['sort'];?></td>
                <td><?php echo $item['url'];?></td>
                <td><?php $item['create_time'];?></td>
                <td class="f-14 td-manage">
                    <a style="text-decoration:none" class="ml-5"  href="/admin/Recommend/add?id=<?php $item['id'];?>" title="编辑"><i class="f-ui-iconfont">&#xe6df;</i></a>
                    {if $gid <= 5}
                    <a style="text-decoration:none" class="ml-5" onClick="recommend_del(this,'<?php echo $item['id'];?>')" href="javascript:;" title="删除"><i class="f-ui-iconfont">&#xe6e2;</i></a>
                    {/if}
                </td>
            </tr>
            {/foreach}
            </tbody>

        </table>
        {include "admin/public/pager.tpl.php"}
    </div>
</div>



<script type="text/javascript">

    /*资讯-删除*/
    function recommend_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.post('/admin/Recommend/del',{id:id},function(data){
                if(data == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }else{
                    layer.msg('删除失败，请重试',1);
                }
            });
        });
    }
    //批量删除
    function datadel() {
        layer.confirm('确认要删除吗？', function (index) {
            var aa = '';
            $('input[name=del]:checked').each(function () {
                aa += ',' + $(this).val();
            });
            if (aa == '') {
                layer.msg('请选择要批量删除的信息!', {icon: 1, time: 1000});
            }
            $.post('/admin/Recommend/del', {id: aa}, function (data) {
                if (data == 1) {
                    $('input[name=del]:checked').parents('tr').remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }else{
                    layer.msg('删除失败，请重试',1);
                }
            });
        });
    }

</script>

{include "admin/public/footer.tpl.php"}