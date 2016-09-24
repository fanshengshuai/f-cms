{include "admin/public/header.tpl.php"}

<nav class="breadcrumb"><i class="f-ui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 名片交换 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="f-ui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg">
            <thead>
            <tr class="text-c">
                <th width="25">序号</th>
                <th width="100">用户名</th>
                <th width="40">昵称</th>
                <th width="100">对方用户名</th>
                <th width="40">对方昵称</th>
                <th width="130">交换时间</th>
            </tr>
            </thead>
            <tbody>
            <{foreach from=$data item=vo}>
            <tr class="text-c">
                <td><{$vo.key}></td>
                <td><{$vo.user_name}></td>
                <td> <{$vo.user_nickname}></td>
                <td><{$vo.apply_name}></td>
                <td> <{$vo.apply_nickname}></td>
                <td><{$vo.time}></td>
            </tr>
            <{/foreach}>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.table-sort').dataTable({
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
            ]
        });
//        $('.table-sort tbody').on( 'click', 'tr', function () {
//            if ( $(this).hasClass('selected') ) {
//                $(this).removeClass('selected');
//            }
//            else {
//                table.$('tr.selected').removeClass('selected');
//                $(this).addClass('selected');
//            }
//        });
    });
    /*用户-添加*/
    function member_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-查看*/
    function member_show(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-停用*/

    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){
            $.post('/admin/Member/member_stop',{m_id:id},function(data){
                if(data == 1) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="member_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="f-ui-iconfont">&#xe615;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label radius">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!', {icon: 5, time: 1000});
                }
            });
        });
    }
    /*用户-启用*/
    function member_start(obj,id){
        layer.confirm('确认要启用吗？',function(index){
            $.post('/admin/Member/member_start',{m_id:id},function(data){
                if(data == 1){
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="member_stop(this,'+id+')" href="javascript:;" title="停用" style="text-decoration:none"><i class="f-ui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!', {icon: 6,time:1000});
                }
            });
        });
    }
    /*用户-编辑*/
    function member_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }

    /*用户-编辑*/
    function member_See(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*密码-修改*/
    function change_password(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-伪删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.post('/admin/Member/member_del',{m_id:id},function(data){
                if(data == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }
            });
        });
    }
    /*用户批量伪删除*/
    function datadel(){
        var aa = '';
        $('input[name=del]:checked').each(function(){
            aa += ','+$(this).val();
        });
        if(aa == ''){
            layer.msg('请选择要批量删除的用户!',{icon:1,time:1000});
        }
        $.post('/admin/Member/member_del',{m_id:aa},function(data){
            if(data == 1) {
                $('input[name=del]:checked').parents('tr').remove();
                layer.msg('已删除!',{icon:1,time:1000});
            }
        });
    }
</script>
{include "admin/public/footer.tpl.php"}