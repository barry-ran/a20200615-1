<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
?>
<script>
function cl()
{ 
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>

</head>
<body>
<div style="padding:10px ">
<?php if ($Action=='') {
$proid=check_input($_GET[id]);
$sql1="select * from product where id='$proid' and docking=0 and sid=0";   //��ȡ���ݱ�
$zyc1=mysql_query($sql1,$conn1);  //ִ�и�SQl���
$row1=mysql_fetch_array($zyc1);
if ($row1['id']==''){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ�û���ҵ�����Ʒѽ!";
exit();
}
?>
<form action="?Action=save" method="post"  enctype="multipart/form-data">
<input name="id" type="hidden" value="<?=$row1['id']?>">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">��Ʒ��Ϣ��</td>
<td><?=$row1['title']?></td>
</tr>
<tr>
<td height="32" class="td_left">��Ʒ��ֵ��</td>
<td><?=$row1['price1']?> <?=$moneytype?></td>
</tr>
<tr>
<td height="32" class="td_left">�ٱ����ͣ�</td>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="3%"><input name="jubao" type="radio" value="�����Ʒ" checked="checked" /> </td>
<td width="11%">�����Ʒ</td>
<td width="4%"><input name="jubao" type="radio" value="������Ʒ"> </td>
<td width="12%">������Ʒ</td>
<td width="4%"><input name="jubao" type="radio" value="Υ����Ʒ"> </td>
<td width="66%">Υ����Ʒ</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="32" class="td_left">�ϴ���ͼ��</td>
<td><input name="upfile" type="file" id="upfile" size="40" /></td>
</tr>
<tr>
<td height="32" class="td_left">�ٱ����ݣ�</td>
<td><textarea name="content" cols="70" rows="7" class="biankuan" id="content"></textarea>
</td>
</tr>
<tr>
<td height="32" colspan="2" align="center" ><input name="�ύ" type="submit" class="button_buy"  value="��һ��" /></td>
</tr>
</table>
</form>

<?php }elseif ($Action=='save') {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}
inject_check($_POST['id']);

$total=mysql_num_rows(mysql_query("SELECT * FROM `goods_report`  where proid='$_REQUEST[id]' and number='$_SESSION[ysk_number]'",$conn1)); 
if ($_POST['content']==''){
echo "<script language=\"javascript\">alert('�Բ����ף���û��д�ٱ�����Ŷ��');self.location=document.referrer;</script>";
}elseif($total!='0'){
echo "<script language=\"javascript\">alert('�Բ����ף��������ظ��ٱ�ͬһ����Ʒ��');self.location=document.referrer;</script>";
}elseif($total=='0'){	
/////////////////////////////////////////�����ϴ��ļ����
include_once('../jhs_config/upload_class.php');

$jubao=strip_tags($_POST['jubao']);
$content=strip_tags($_POST['content']);

mysql_query("insert into `goods_report` (proid,online,type,pic,number,username,content,begtime,sjcw)"."values ('$_POST[id]','$_REQUEST[online]','$jubao','$uploadname','$_SESSION[ysk_number]','$row1[username]','$content','$begtime','0')",$conn1);
}
?>
 
<center><br /><br /><img src="../Public/images/blue/08.png"><br /><br />��ϲ���ٱ��ɹ����ȴ�ϵͳ���<br /><br />
<input name="�ر�" type="button" class="button_close" id="Button2"  onClick="cl()" value="�ر�" /></center>
<?php } ?>
</div>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>