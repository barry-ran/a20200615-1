<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script language="JavaScript" type="text/javascript">
function clearNoNum(obj)
{
//�Ȱѷ����ֵĶ��滻�����������ֺ�.
obj.value = obj.value.replace(/[^\d.]/g,"");
//���뱣֤��һ��Ϊ���ֶ�����.
obj.value = obj.value.replace(/^\./g,"");
//��ֻ֤�г���һ��.��û�ж��.
obj.value = obj.value.replace(/\.{2,}/g,".");
//��֤.ֻ����һ�Σ������ܳ�����������
obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
}
</script>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
$result=mysql_query("select * from delivery_charge where id='1'",$conn1);
$row=mysql_fetch_array($result);


if ($Action=="save"){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}

$price1=get_check_price($_POST['price1']);
$price2=get_check_price($_POST['price2']);
$price3=get_check_price($_POST['price3']);
$price4=get_check_price($_POST['price4']);

if ($row['price1']<>$price1){
ysk_date_log(6,$_SESSION['ysk_username'],'��ϵͳ����1���շ� '.$row['price1'].' Ԫ �޸ĳ��� '.$price1.' Ԫ');
}
if ($row['price2']<>$price2){
ysk_date_log(6,$_SESSION['ysk_username'],'��ϵͳ����1���շ� '.$row['price2'].' Ԫ �޸ĳ��� '.$price2.' Ԫ');
}
if ($row['price3']<>$price3){
ysk_date_log(6,$_SESSION['ysk_username'],'��ϵͳ����1���շ� '.$row['price3'].' Ԫ �޸ĳ��� '.$price3.' Ԫ');
}
if ($row['price4']<>$price4){
ysk_date_log(6,$_SESSION['ysk_username'],'��ϵͳ����1���շ� '.$row['price4'].' Ԫ �޸ĳ��� '.$price4.' Ԫ');
}


mysql_query("update delivery_charge set price1='$price1',price2='$price2',price3='$price3',price4='$price4' where id='1'",$conn1); 
echo "<script>alert('�޸ĳɹ�!');self.location=document.referrer;</script>";
}


?>
<form name="add" method="post" action="?Action=save">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">�����շ�</td>
</tr>

<tr>
<td class="td_left"><span class="left">1���շ�</span>��</td>
<td class="left">
<input name="price1" type="text" class="biankuan1" onkeyup="clearNoNum(this)" size="10" maxlength="10" value="<?=$row['price1']?>"/> Ԫ</td>
</tr>

<tr>
<td class="td_left"><span class="left">3���շ�</span>��</td>
<td class="left">
<input name="price2" type="text" class="biankuan1" onkeyup="clearNoNum(this)" size="10" maxlength="10" value="<?=$row['price2']?>"/> Ԫ</td>
</tr>

<tr>
<td class="td_left"><span class="left">5���շ�</span>��</td>
<td class="left">
<input name="price3" type="text" class="biankuan1" onkeyup="clearNoNum(this)" size="10" maxlength="10" value="<?=$row['price3']?>"/> Ԫ</td>
</tr>

<tr>
<td class="td_left"><span class="left">�����շ�</span>��</td>
<td class="left">
<input name="price4" type="text" class="biankuan1" onkeyup="clearNoNum(this)" size="10" maxlength="10" value="<?=$row['price4']?>"/> Ԫ</td>
</tr>

<tr>
<td></td>
<td><input type="submit" name="btnSubmit" value="ȷ���޸�"  id="btnSubmit" class="tijiao_input" /></td>
</tr>
</table>
</form>
</body>
</Html>
