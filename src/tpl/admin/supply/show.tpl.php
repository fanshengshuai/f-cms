{include "admin/public/header.tpl.php"}

<div class="cl pd-20" style=" background-color:#5bacb6">
    <img class="avatar size-XL l" src="/res/images/user.png">
    <dl style="margin-left:80px; color:#fff">
        <dt><span class="f-18"><?php echo $mm['title'];?></span></dt>
        <dd class="pt-10 f-12" style="margin-left:0"></dd>
    </dl>
</div>
<div class="pd-20">
    <table class="table">
        <tbody>
        <tr>
            <th class="text-r" style="width: 80px;">内容：</th>
            <td><?php echo $mm['content'];?></td>
        </tr>
        </tbody>
    </table>
</div>
{include "admin/public/footer.tpl.php"}