<style type="text/css">
    .round {
        padding:10px;
        border: 3px solid #dedede;
        -moz-border-radius: 15px;      /* Gecko browsers */
        -webkit-border-radius: 15px;   /* Webkit browsers */
        border-radius:15px;            /* W3C syntax */
    }
</style>

<div class="row">
    <div class="col-sm-3 text-right" style="padding-left: 5px;">反馈内容： </div>

    <div class="col-sm-7 round" style="font-size: 14px; line-height: 20px;">
        <{$feedbackData.feedback_content}>
    </div>
</div>