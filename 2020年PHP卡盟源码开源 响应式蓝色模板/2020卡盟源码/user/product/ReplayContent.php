<?php
//echo '微信关注：聚合建站  | 全开源卡盟系统 免费下载：www.juheshe.cn  2018年9月14日 Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/user_check.php');
$Action=$_REQUEST['Action'];
////////删除单记录
if ($Action=="del"){
$Id=inject_check($_REQUEST['Id']);
$sql="delete from fast_reply where id ='$Id' and username='$_SESSION[ysk_number]'";
mysql_query($sql,$conn1);
echo "<script>alert('删除成功!');;self.location=document.referrer;</script>";
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
</head>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php if ($Action=='') {?>
<form action="?Action=save" method="post">
<input name="type" type="hidden" value="<?=$_REQUEST['type']?>" />
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td class="td_left">
内容：
</td>
<td class="left">
<textarea name="content" rows="2" cols="20" id="content" style="height:80px;width:280px;"></textarea>
</td>
</tr>
<tr>
<td class="td_left">&nbsp;
</td>
<td class="left">
<input type="submit" name="Button1" value="确认添加" id="Button1" class="chaxun_input" />
</td>
</tr>
</table>
</form>
<?php }elseif ($Action=='save') {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('对不起，非法操作！');;self.location=document.referrer;</script>";
exit();	
}
$content=strip_tags($_POST['content']);
$type=strip_tags($_POST['type']);
mysql_query("insert into fast_reply (type,content,username,begtime)" ."values ('$type','$content','$_SESSION[ysk_number]','$begtime')",$conn1);

?>
<center><br><br><br><br>
<input name="关闭" type="button" class="chaxun_input" id="Button2"  onClick="cl()" value="提交成功" /></center>
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