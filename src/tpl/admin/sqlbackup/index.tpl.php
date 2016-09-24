<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>数据库维护</title>

    <script language="javascript">
        //获得选中文件的数据表
        function getCheckboxItem(){
            var myform = document.form1;
            var allSel="";
            if(myform.tables.value) return myform.tables.value;
            for(var i=0;i<myform.tables.length;i++) {
                if(myform.tables[i].checked){
                    alert(myform.tables[i].value);
                    if(allSel=="")
                        allSel=myform.tables[i].value;
                    else
                        allSel=allSel+","+myform.tables[i].value;
                }
            }
            return allSel;
        }
        function checkSubmit() {
            var myform = document.form1;
            myform.tablearr.value = getCheckboxItem();
            return true;
        }


    </script>
    <style>
        .downfile{
            float:right;
            margin-top:30px;
            margin-right:30px ;
        }
    </style>
</head>

<body background='images/allbg.gif' leftmargin='8' topmargin='8'>

<table width="99%" border="0" cellpadding="3" cellspacing="1" bgcolor="#D6D6D6">
    <tr>
        <td height="19" colspan="8" background="images/tbg.gif" bgcolor="#E7E7E7">
            <table width="96%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                    <td width="24%" style="padding-left:10px;"><strong>数据库管理</strong></td>
                    <td width="76%" align="right">
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <form name="form1" onSubmit="checkSubmit()" action="/admin/sqlbackup/back" method="post">
        <input type='hidden' name='tablearr' value='' />
        <tr bgcolor="#F7F8ED">
            <td height="24" colspan="8"><strong>默认系统表：</strong></td>
        </tr>
        <tr bgcolor="#FBFCE2" align="center">
            <td width="20%">表名</td>
            <td width="8%">记录数</td>
            <td width="8%">引擎类型</td>
            <td width="8%">编码</td>
        </tr>
        {foreach from=$re item=vo}
            <tr bgcolor="#FFFFFF" align="center">
                <td width="20%"><?php echo $vo['Name'];?></td>
                <td width="8%"><?php echo $vo['Rows'];?></td>
                <td width="8%"><?php echo $vo['Engine'];?></td>
                <td width="8%"><?php echo $vo['Collation'];?></td>
            </tr>
        {/foreach}
        <tr bgcolor="#ffffff">
            <td height="24" colspan="8" style="text-align: center;">
                <input type="submit" name="Submit" value="备份" class="coolbg np" style="width:100px;height:40px;background:#ff6600;border:none;cursor:pointer;"/>
            </td>
        </tr>
    </form>
</table>

<div class="downfile">
    <script>
        function down(name){
            location = '/admin/Sqlbackup/downFiles?act=true&name='+name;//转到
        }
        function closeme(){                     //关闭当前页面
            window.opener=null;
            window.close();
        }
    </script>
    <div style="padding:10px;width:300px;height:120px;border:1px #000000 solid;">
        说明<br/>
        先备份数据库文件，然后下载<br/>
        为确保数据安全性，请下载后立即转移该备份文件<br/>
        <button onclick="down('./data/data.sql')">同意</button>&nbsp;<button onclick="closeme()">不同意</button>
    </div>
    <div style="padding:5px;text-align:center;">阅读后点击 同意 下载</div>

</div>
</html>
