{include 'header.tpl'}

<form class="form-inline" rel="ajax" method="post" action="/admin/global/agreement" enctype="multipart/form-data">
    <table class="table">
        <tr>
            <th style="width:100px;">注册协议</th>
            <td>
                <textarea id="agreement" class="form-control" style="width:700px; height:500px;"
                          name="agreement">{$settings.agreement}</textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">保存</button>
            </td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    $(function() {
        create_editor('agreement');
    });
</script>

{include 'footer.tpl'}