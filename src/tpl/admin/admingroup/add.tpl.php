{include "admin/public/header.tpl.php"}

<div style="width:500px;height:500px;margin:0 auto;">
    <form action="" method="post">
        <input type="text" name="name" value="<{$info.name}>"
               style="width:200px;height:30px;margin:100px auto 0;display: block;"/>
        <input type="hidden" name="id" value="<{$info.id}>"/>
        <input type="submit" value="提交"
               style="width:50px;height:30px;margin:100px auto 0;display:block;background:#C50808;color:white;border:none;border-radius:5px;"/>
    </form>
</div>
{include "admin/public/footer.tpl.php"}