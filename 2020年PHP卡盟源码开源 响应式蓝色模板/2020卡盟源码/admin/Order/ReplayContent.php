<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
</head>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
////////ɾ������¼
if ($Action=="del") {
$sql="delete from fast_reply where id ='$_REQUEST[Id]'";
mysql_query($sql,$conn1);
echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
}
?>
<?php if ($Action=='') {?>
<form action="?Action=save" method="post">
<input name="type" type="hidden" value="<?=$_REQUEST['type']?>" />
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td class="td_left">
���ݣ�
</td>
<td class="left">
<textarea name="content" rows="2" cols="20" id="content" style="height:80px;width:280px;"></textarea>
</td>
</tr>
<tr>
<td class="td_left">&nbsp;
</td>
<td class="left">
<input type="submit" name="Button1" value="ȷ�����" id="Button1" class="chaxun_input" />
</td>
</tr>
</table>
</form>
<?php } ?>
<?php if ($Action=='save') {
mysql_query("insert into fast_reply (type,content,username,begtime) " ."values ('$_REQUEST[type]','$_REQUEST[content]','','$begtime')",$conn1);
?>
<center><br><br><br><br>
<input name="�ر�" type="button" class="chaxun_input" id="Button2"  onClick="cl()" value="�ر�" /></center>
<?php
}

?>
</body>
</Html>
<script>
function cl(){ 
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>