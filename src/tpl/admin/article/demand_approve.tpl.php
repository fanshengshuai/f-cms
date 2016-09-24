{include "admin/public/header.tpl.php"}

{if $statu}

<script type="text/javascript">
    $(document).ready(function(){
        var statu = {$statu};
        $('#select_statues').val(statu);
    })
</script>
{/if}
{if $sousuo}
<script type="text/javascript">
    $(document).ready(function(){
        var id = {$sousuo};
        $('#select_back').val(id);
    })
</script>
    {/if}
<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span class="c-gray en">&gt;</span> 需求审核 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <form action="" method="post">
    <div class="text-c">
        <span class="select-box inline">
                <select name="num" class="select" id="select_statues">
                    <option value="10" {if $num == 10}selected="selected"{/if}>显示10条</option>
                    <option value="25" {if $num == 25}selected="selected"{/if}>显示25条</option>
                    <option value="50" {if $num == 50}selected="selected"{/if}>显示50条</option>
                    <option value="100" {if $num == 100}selected="selected"{/if}>显示100条</option>
                </select>
		</span>&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="select-box inline">
				<select name="cat_id" class="select" id="select_back">
                    <option value="">请选择..</option>
                    {foreach from=$cats item=row}
                    {if $row['class'] == 0}
                    <optgroup label="<?php echo $row['name'];?>"></optgroup>
                    {elseif $row['class'] == 1}
                    {if $row['child'] == 1}
                    <optgroup label="|-<?php echo $row['name'];?>" style="padding-left: 10px;"></optgroup>
                    {else}
                    <option value="<?php echo $row['id'];?>" style="padding-left: 10px;"> |- <?php echo $row['name'];?></option>
                    {/if}
                    {elseif $row['class'] == 2}
                    <option value="<?php echo $row['id'];?>" style="padding-left: 20px;"> |- <?php echo $row['name'];?></option>
                    {/if}
                    {/foreach}
                </select>
        </span>&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="select-box inline">
                <select name="statu" class="select" id="select_statues">
                    <option value="">请选择..</option>
                    <option value="1">已审核</option>
                    <option value="2">未审核</option>
                </select>
		</span>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="title1" value="<?php echo $key_2;?>" placeholder=" 资讯名称" style="width:250px" class="input-text"/>
        <button name="" id="" class="btn btn-success" type="submit"><i class="f-ui-iconfont">&#xe665;</i> 搜资讯</button>

    </div>
</form>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
            <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="f-ui-iconfont">&#xe6e2;</i> 批量删除</a>
              <a href="javascript:;" onclick="through()" class="btn btn-primary radius"><i class="f-ui-iconfont">&#xe6e2;
                  </i> 批量审核</a>
            <a class="btn btn-primary radius"  href="/admin/Article/demand_article_add"><i class="f-ui-iconfont">&#xe600;
                </i> 添加资讯</a>
        </span> <span class="r">共有数据：<strong><?php echo $page_info['total'];?></strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th><input type="checkbox" name="" value=""></th>
                <th>ID</th>
                <th>标题</th>
<!--                <th>排序</th>-->
                <th>应用领域</th>
                <th>技术领域</th>
                <th>所在城市</th>
                <th>金额范围</th>
                <th width="120">来源</th>
                <th width="120">提交时间</th>
<!--                <th width="75">浏览次数</th>-->
                <th width="60">发布状态</th>
                <th width="120">备注</th>
            </tr>
            </thead>
            <tbody>
            {foreach from="$info" item="item"}
            <tr class="text-c">
                <td><input type="checkbox" value="<?php echo $item['id'];?>" name="del"></td>
                <td><?php echo $item['id'];?></td>
                <td class="text-l"><?php echo $item['title'];?></td>
<!--                <td><{$item.sort}></td>-->
                <td><?php echo $item['keywords'];?></td>
                <td><?php echo $item['desn'];?></td>
                <td><?php echo $item['province'];?>/<?php echo $item['city'];?></td>
                <td>{if $item['stage'] == 1}>5万以下{elseif $item['stage'] == 2}5-20万{elseif $item['stage'] == 3}20-100万{elseif $item['stage'] == 4}100-500万{elseif $item['stage'] == 5}>500万以上{/if}</td>
                <td><?php echo $item['comefrom'];?></td>
                <td><?php echo $item['create_time'];?></td>
<!--                <td><{$item.views}></td>-->
                <td class="td-status" audit_id="<?php echo $item['id'];?>">
                        {if $item['status'] == 1}
                        <span class="admin_audit label label-success radius">已审核</span>
                        {else}
                        <a title="审核" href="javascript:;" class="admin_audit label label-success radius" onclick="is_audit(this,'<?php echo $item['id'];?>')">未审核</a>
                        {/if}
                    </td>
                <td><?php echo $item['mybz'];?></td>
            </tr>
            {/foreach}
            </tbody>

        </table>
        {include "admin/public/pager.tpl.php"}
    </div>
</div>


<script type="text/javascript" src="//cdn.bootcss.com/jquery/1.12.1/jquery.min.js"></script>
<script type="text/javascript" src="/res/lib/layer/1.9.3/layer.js"></script>



<script type="text/javascript">
    function is_audit(obj,id){
        layer.confirm('确认要审核吗？',function(index){
            $.post('/admin/Article/audit', {id:id}, function(data){
                if(data == 1) {
                    $(obj).parents("tr").find(".td-status").empty().html('<span class="admin_audit label label-success radius">已审核 </span>');
                    layer.msg('已审核!',{icon:1,time:1000});
                }else{
                    layer.msg('未完成，请重试',1);
                }
            });
        });
    }

    /*资讯-添加*/
    function article_add(title,url,w,h){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*资讯-编辑*/
    function article_edit(title,url,id,w,h){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*资讯-删除*/
    function article_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……
            $.post('/admin/Article/del',{id:id},function(data){
                if(data == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }else{
                    layer.msg('删除失败，请重试',1);
                }
            });
        });
    }

    /*资讯-审核*/
    function article_shenhe(obj,id){
        layer.confirm('审核文章？', {
                btn: ['通过','不通过'],
                shade: false
            },
            function(){
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                $(obj).remove();
                layer.msg('已发布', {icon:6,time:1000});
            },
            function(){
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
                $(obj).remove();
                layer.msg('未通过', {icon:5,time:1000});
            });
    }

    /*资讯-下架*/

    function article_stop(obj,id){
        layer.confirm('确认要下架吗？',function(index){
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="f-ui-iconfont">&#xe603;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
            $(obj).remove();
            layer.msg('已下架!',{icon: 5,time:1000});
        });
    }

    /*资讯-发布*/

    function article_start(obj,id){
        layer.confirm('确认要发布吗？',function(index){
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="f-ui-iconfont">&#xe6de;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布!',{icon: 6,time:1000});
        });
    }
    /*资讯-申请上线*/
    function article_shenqing(obj,id){
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        $(obj).parents("tr").find(".td-manage").html("");
        layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
    }
    function datadel(){
        var aa = '';
        $('input[name=del]:checked').each(function(){
            aa += ','+$(this).val();
        });
        if(aa == ''){
            layer.msg('请选择要批量删除的文章!',{icon:1,time:1000});
        }

        $.post('/admin/Article/article_del',{a_id:aa},function(data){
            if(data == 1) {
                $('input[name=del]:checked').parents('tr').remove();
                layer.msg('已删除!',{icon:1,time:1000});
            }
        });
    }

    function through(){
        var aa = '';
        $('input[name=del]:checked').each(function(){
            aa += ','+$(this).val();
        });
        if(aa == ''){
            layer.msg('请选择要批量审核的文章!',{icon:1,time:1000});
        }

        $.post('/admin/Article/article_through',{a_id:aa},function(data){
            if(data == 1) {
                $('input[name=del]:checked').parents('tr').remove();
                layer.msg('已审核!',{icon:1,time:1000});
            }
        });
    }
</script>

{include "admin/public/footer.tpl.php"}