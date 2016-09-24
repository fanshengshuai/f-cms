{include "header.tpl"}

<div class="row">
    <div class="col-xs-1"></div>
</div>

<div class="row">
    <div class="col-sm-3 text-right">标题：</div>

    <div class="col-sm-7">
        {$feedbackData.title}
    </div>
</div>

<div class="row">
    <div class="col-sm-3 text-right">手机号：</div>

    <div class="col-sm-7">
        {$feedbackData.contact}
    </div>
</div>

<div class="row">
    <div class="col-sm-3 text-right">QQ：</div>

    <div class="col-sm-7">
        {$feedbackData.qq}
    </div>
</div>

<div class="row">
    <div class="col-sm-3 text-right">时间：</div>

    <div class="col-sm-7">
        {$feedbackData.create_time}
    </div>
</div>

<div class="row">
    <div class="col-sm-3 text-right">内容： </div>

    <div class="col-sm-7">
        {$feedbackData.content}
    </div>
</div>


<div class="clearfix"></div>

{include "footer.tpl"}