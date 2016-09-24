{include file="header.tpl"}

<ol class="breadcrumb">
    <li class="active">用户反馈</li>
</ol>

<table class="table table-hover">
    <thead>
    <tr>
        <th style="width:20px;">ID</th>
        <th style="width:80px;">手机号</th>
        <th style="width:80px;">qq</th>
        <th>标题</th>
        <th style="width:160px;">时间</th>
        <th style="width:80px;">操作</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$feedbackList item=item}
        <tr>
            <td>{$item.auto_id}</td>
            <td>{$item.contact}</td>
            <td>{$item.qq}</td>
            <td><a rel="ajax" href="/admin/feedback/detail?auto_id={$item['auto_id']}">{$item.content|truncate:30}</a>
            </td>
            <td>{$item.create_time}</td>
            <td>
                <a rel="ajax" href="/admin/feedback/detail?auto_id={$item['auto_id']}" class="btn-delete">详情</a>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>
{include "pager.tpl"}

<script type="text/javascript">
    $(function() {
        jQuery('#search_date').find("option[value='{$smarty.get.search_date}']").attr('selected', true);
        jQuery('#search_mall_id').find("option[value='{$smarty.get.search_mall_id}']").attr('selected', true);
        jQuery('#search_pay_status').find("option[value='{$smarty.get.search_pay_status}']").attr('selected', true);
    });
</script>

{include file="footer.tpl"}
