<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
$Action=$_REQUEST['Action'];
$id=inject_check($_REQUEST[id]);
$result=mysql_query("select * from product_order where id='$id'",$conn1);
$order=mysql_fetch_array($result);

///---------------------��������

if ($Action=='save'){

if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}

$buy_pl=inject_check($_POST['buy_pl']);

mysql_query("update `product_order`  set buy_pl='$buy_pl'  where id='$id'",$conn1); ///////���¶����������

if ($order['username']!='' && $order['sid']==0){
//************************************************��վ����
if      ($buy_pl=='1'){
mysql_query("update members set praise1=praise1+1  where number='$order[username]'",$conn1); 
}elseif ($buy_pl=='2'){
mysql_query("update members set praise2=praise2+1 where number='$order[username]'",$conn1); 
}elseif ($buy_pl=='3'){
mysql_query("update members set praise3=praise3+1 where number='$order[username]'",$conn1);  
}
//************************************************Sup
}elseif ($order['username']!='' && $order['sid']!=0){
mysql_query("update `sup_product_order` set buy_pl='$buy_pl'  where orderid='$order[orderid]'",$conn2); 
if      ($_REQUEST['buy_pl']=='1'){
mysql_query("update sup_members set praise1=praise1+1  where number='$order[username]'",$conn2); 
}elseif ($_REQUEST['buy_pl']=='2'){
mysql_query("update sup_members set praise2=praise2+1 where number='$order[username]'",$conn2); 
}elseif ($_REQUEST['buy_pl']=='3'){
mysql_query("update sup_members set praise3=praise3+1 where number='$order[username]'",$conn2); 
}
}
echo "<br><br><br><center><input id='btnAll' type='button' value='���۳ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";


}elseif ($Action=='editsave'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}
$buy_pl=inject_check($_POST['buy_pl']);
mysql_query("update `product_order`  set buy_pl='$buy_pl',eeval='1'  where id='$_REQUEST[id]'",$conn1); ///////���¶����������

if ($order['username']!='' && $order['sid']==0){	
if      ($buy_pl=='1'){
mysql_query("update members set praise1=praise1+1  where number='$order[username]'",$conn1); 
}elseif ($buy_pl=='2'){
mysql_query("update members set praise2=praise2+1 where number='$order[username]'",$conn1); 
}elseif ($buy_pl=='3'){
mysql_query("update members set praise3=praise3+1 where number='$order[username]'",$conn1); 
}
}elseif ($order['username']!='' && $order['sid']!=0){
mysql_query("update `sup_product_order` set buy_pl='$buy_pl'  where orderid='$order[orderid]'",$conn2); 
if      ($_REQUEST['buy_pl']=='1'){
mysql_query("update sup_members set praise1=praise1+1  where number='$order[username]'",$conn2); 
}elseif ($_REQUEST['buy_pl']=='2'){
mysql_query("update sup_members set praise2=praise2+1 where number='$order[username]'",$conn2); 
}elseif ($_REQUEST['buy_pl']=='3'){
mysql_query("update sup_members set praise3=praise3+1 where number='$order[username]'",$conn2); 
}
}
echo "<br><br><br><center><input id='btnAll' type='button' value='�ύ�ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}
?>

</head>
<body bottommargin="0" leftmargin="0" rightmargin="0" topmargin="0" style="overflow:hidden;">
<?php if ($Action==''){?>
<form action="?Action=save" method="post">
<input name="id" type="hidden" value="<?=$_REQUEST['id']?>" />
<input name="sid" type="hidden" value="<?=$order['id']?>" />
<input name="Token" type="hidden" value="<?=genToken()?>">
<table width="13%" align="center" cellpadding="0" cellspacing="1" class="page_table4">
<tr>
<td align="center" ><table width="120" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="40" align="center"><img src="../Public/images/01.png" alt="����" width="17" height="16" /></td>
<td width="40" align="center"><img src="../Public/images/02.png" width="17" height="16" /></td>
<td width="40" align="center"><img src="../Public/images/03.png" width="17" height="16" /></td>
</tr>
<tr>
<td align="center"><input name="buy_pl" type="radio" value="1" checked="checked" /></td>
<td align="center"><input type="radio" name="buy_pl" value="2" /></td>
<td align="center"><input name="buy_pl" type="radio" value="3"  /></td>
</tr>
</table><input type="submit" name="btn_edit" value="�ύ����" id="btn_edit" class="tijiao_input" />
</td>
</tr>
<tr>
<td align="center" >
<img src="../Public/images/01.png" style="vertical-align:middle" /> ������1��
<img src="../Public/images/02.png" style="vertical-align:middle" /> �������ӷ�
<img src="../Public/images/03.png" style="vertical-align:middle" /> ������1��<br>
�������ݱ��ν��ף�������ʵ�����ĵ����ۣ�����������뼰ʱ��ϵ�����̴����ۺ����
</td>
</tr>
</table>
</form>
<?php }elseif($Action=='edit'){?>
<form action="?Action=editsave" method="post">
<input name="id" type="hidden" value="<?=$_REQUEST['id']?>" />
<input name="sid" type="hidden" value="<?=$order['id']?>" />
<input name="Token" type="hidden" value="<?=genToken()?>">
<table width="13%" align="center" cellpadding="0" cellspacing="1" class="page_table4">
<tr>
<td align="center" ><table width="120" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="40" align="center"><img src="../Public/images/01.png" alt="����" width="17" height="16" /></td>
<td width="40" align="center"><img src="../Public/images/02.png" width="17" height="16" /></td>
<td width="40" align="center"><img src="../Public/images/03.png" width="17" height="16" /></td>
</tr>
<tr>
<td align="center"><input name="buy_pl" type="radio" value="1" checked="checked" /></td>
<td align="center"><input type="radio" name="buy_pl" value="2" /></td>
<td align="center"><input name="buy_pl" type="radio" value="3"  /></td>
</tr>
</table><input type="submit" name="btn_edit" value="�ύ����" id="btn_edit" class="tijiao_input" />
</td>
</tr>
<tr>
<td align="center" >
<img src="../Public/images/01.png" style="vertical-align:middle" /> ������1��
<img src="../Public/images/02.png" style="vertical-align:middle" /> �������ӷ�
<img src="../Public/images/03.png" style="vertical-align:middle" /> ������1��<br>
�ύ�󲻿��޸ģ���л����֧�֣�
</td>
</tr>
</table>
</form>
<?php } ?>

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