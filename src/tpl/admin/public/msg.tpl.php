<!doctype html>
<html lang="zh_CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo $msg;?></title>

    <style type="text/css">
        /*成功 | 错误 提示*/
        * {
            word-wrap: break-word
        }

        body {
            font: 12px Microsoft YaHei, Arial, Helvetica, sans-serif, Simsun;
            text-align: center;
            color: #333;
        }

        body, div, dl, dt, dd, ul, ol, li, pre, form, fieldset, blockquote, h1, h2, h3, h4, h5, h6, p {
            padding: 0;
            margin: 0
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: normal;
        }

        table, td, tr, th {
            font-size: 12px
        }

        li {
            list-style-type: none
        }

        table {
            margin: 0 auto
        }

        img {
            border: none
        }

        ol, ul {
            list-style: none
        }

        caption, th {
            text-align: left
        }

        .prompt_ok, .prompt_x {
            background: url(/Style/tip/images/message.gif) no-repeat;
            display: inline-block
        }

        .prompt {
            width: 640px;
            margin: 100px auto 180px;
            text-align: left;
            border: #eee 1px solid;
        }

        .prompt_con {
            width: 100%;
            background: #fff;
            overflow: hidden;
        }

        .prompt_con dl {
            overflow: hidden;
            background: #fff;
        }

        .prompt_con dt {
            width: 100%;
            font-size: 18px;
            padding: 15px;
            border-bottom: 2px solid #E7E7E7;
            font-weight: bold;
            _height: 20px;
        }

        .prompt_con dd {
            float: left;
            display: block;
            padding: 50px 15px;
        }

        .prompt_con dd h2 {
            font-size: 24px;
            line-height: 50px;
        }

        .prompt_ok {
            background-position: -72px -39px;
            width: 68px;
            height: 68px;
        }

        .prompt_x {
            background-position: 0 -39px;
            width: 68px;
            height: 68px;
        }

        .prompt_con a.a {
            color: #fff;
            padding: 0 15px;
            line-height: 30px;
            background-color: #307ba0;
            display: inline-block;
            font-size: 14px;
            margin: 20px 0px;
        }
    </style>

    {if $url}
    <script>
        function Jump() {
            window.location.href = '<?php echo $url;?>';
        }
        document.onload = setTimeout("Jump()", 1 * 1000);
    </script>
    {/if}
    <base target="_self"/>
</head>
<body>
<div class="prompt">
    <div class="prompt_con">
        <dl>
            <dt>提示信息</dt>
            {if $msgType=='error'}
            <dd><span class="prompt_x"></span></dd>
            {else}
            <dd><span class="prompt_ok"></span></dd>
            {/if}
            <dd>
                <h2><?php echo $msg;?></h2>
                {if $url}
                <p>系统将在 <span style="color:blue;font-weight:bold">1</span> 秒后自动跳转,如果不想等待,直接点击 <A HREF="/">这里</A> 跳转</p>
                {/if}
            </dd>
        </dl>
        <div class="c"></div>
    </div>
</div>
</body>
</html>