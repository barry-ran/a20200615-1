
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ۺ���</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
</head>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=strip_tags($_GET['Action']);
$id=inject_check($_REQUEST['id']);
$sql=mysql_query("select * from members where id='$id'",$conn1);
$user=mysql_fetch_array($sql);
$asql=mysql_query("select * from administrator where username='$_SESSION[ysk_username]'",$conn1);
$admin=mysql_fetch_array($asql);?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
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
<script>
function cl()
{ 
var win = art.dialog.open.origin;//��Դҳ��
// �����ҳ�����ػ��߹ر����ӶԻ���ȫ����ر�
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<?php if ($Action=='close'){unset($_SESSION['yDel']);?>
<form action="?Action=close_save" method="post" name="add" onsubmit="return CheckPost();">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td class="td_left">��ֹԭ��</td>
<td class="td_right"><textarea name="ban" cols="50" rows="6" id="ban" class="biankuan"></textarea></td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=='close_save'){
foreach($_SESSION['allArray']as $value){
$back_result=mysql_query("select * from members  where id='$value'",$conn1);
$back=mysql_fetch_array($back_result);
$ban=strip_tags($_POST['ban']);

ysk_date_log(4,$_SESSION['ysk_username'],'�ѻ�Ա"'.$back['number'].'" �ĵ�¼������ ԭ����'.$ban);
mysql_query("update members set locks='1',ban_reason='$ban' where id='$value'",$conn1); }
echo "<br><center><br><br><input id='btnAll' type='button' value='�ύ�ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}elseif ($Action=='frozen'){?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo(){
if(checkspace(document.add.frozen_kuan.value) || document.add.frozen_kuan.value <=0)  {
document.add.frozen_kuan.focus();
alert("�Բ��𣬲�������Ϊ�㣡");
return false;
}
if(checkspace(document.add.papa.value)) {
document.add.papa.focus();
alert("�Բ�������û���������Ĳ��������أ�");
return false;
}
}
function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</script>
<form name="add" method="post" action="?Action=save1&id=<?=$user['id']?>">
<input name="y1" type="hidden" value="<?=$user['number']?>" />
<input name="y2" type="hidden" value="<?=$user['type']?>" />
<input name="y3" type="hidden" value="<?=$user['frozen_kuan']?>" />
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td class="td_left">��Ա��ţ�</td>
<td class="td_right"><?=$user['number']?></td>
</tr>
<tr>
<td class="td_left">��Ա��</td>
<td class="td_right"><?=number_format($user['kuan'],3);?> Ԫ</td>
</tr>
<tr>
<td class="td_left">�����</td>
<td class="td_right"><?=number_format($user['frozen_kuan'],3);?> Ԫ</td>
</tr>
<tr>
<td class="td_left">��׼��</td>
<td class="td_right"><?=number_format($user['max_amount'],3);?> Ԫ
</td>
</tr>

<tr>
<td class="td_left">��ͱ�����</td>
<td class="td_right"><?=number_format($user['min_amount'],3);?> Ԫ
</td>
</tr>
<tr>
<td class="td_left">�������ͣ�</td>
<td class="td_right"><select name="type" id="type">
<option value="1">����</option>
<option value="0">�ⶳ</option>
</select>
</td>
</tr>
<tr>
<td class="td_left">��</td>
<td class="td_right"><input name="frozen_kuan" type="text" class="biankuan" onkeyup="clearNoNum(this)" /> Ԫ
</td>
</tr>
<tr>
<td class="td_left">�������룺</td>
<td class="td_right"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" />
</td>
</tr>
<tr>
<td class="td_left">&nbsp;

</td>
<td class="td_right">
<input type="submit" name="btnSubmit" value="ȷ���޸�" id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();" >
<input type="button" value="�ر�" class="fanhui_input" onClick="cl()"  /> 
</td>
</tr>
</table>
</form>
<?php }elseif ($Action=='jiakuan'){?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo(){
if(checkspace(document.add.price.value) || document.add.price.value <=0)  {
document.add.price.focus();
alert("�Բ��𣬲�������Ϊ�㣡");
return false;
}
if(checkspace(document.add.papa.value)) {
document.add.papa.focus();
alert("�Բ�������û���������Ĳ��������أ�");
return false;
}
}
function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</script>
<form name="add" method="post" action="?Action=save9&id=<?=$user['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td width="38%" class="td_left">��Ա��ţ�</td>
<td width="62%" class="td_right"><?=$user['number']?></td>
</tr>
<tr>
<td class="td_left">��Ա��</td>
<td class="td_right"><?=number_format($user['kuan'],3);?> Ԫ</td>
</tr>
<tr>
<td class="td_left"> ����ǰ�ʻ���</td>
<td class="left"><span class="red"><?=$admin['amount']?></span>&nbsp;Ԫ</td>
</tr>
<tr>
<td class="td_left">ȷ�ϼӿ</td>
<td class="td_right"><input name="price" type="text" class="biankuan" id="price" onkeyup="clearNoNum(this)" /> 
Ԫ
</td>
</tr>
<tr>
<td class="td_left">�������룺</td>
<td class="td_right"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" />
</td>
</tr>
<tr>
<td class="td_left">&nbsp;

</td>
<td class="td_right">
<input type="submit" name="btnSubmit" value="ȷ���޸�" id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();"/>
<input type="button" value="�ر�" class="fanhui_input" onClick="cl()"  /> 
</td>
</tr>
</table>
</form>
<?php }elseif ($Action=='save9'){
$price=get_check_price($_POST['price']);
if ($admin['amount']<$price){
echo "<script language=\"javascript\">alert('�Բ��������˻�������');history.go(-1);</script>";
exit();
}else{
$yuer=$admin['amount']-$price;
mysql_query("update administrator set amount='$yuer'  where username='$_SESSION[ysk_username]'",$conn1); 
$kuan=$price+$user['kuan'];
$content="�� $user[number] ��Ա�ӿ� $price Ԫ";
mysql_query("insert into `details_funds` set title='�ӿ�',incomes='$price',befores='$user[kuan]',afters='$kuan',number='$user[number]',begtime='$begtime'",$conn1);
mysql_query("update members set kuan='$kuan'  where number='$user[number]'",$conn1); 

ysk_date_log(3,$_SESSION['ysk_username'],$content);
}
echo "<center><br><br><br><br><input id='btnAll' type='button' value='�޸ĳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";

}elseif ($Action=='save1'){
$y1=$_POST['y1'];
$y2=$_POST['y2'];
$y3=$_POST['y3'];
$frozen_kuan=get_check_price($_POST['frozen_kuan']);
if ($_POST['type']=='1'){##�����ʽ�
if ($user['kuan']<$frozen_kuan){
echo "<script>alert('�Բ��𣬸��û�����!');;self.location=document.referrer;</script>";
exit();
}

$price1=get_check_price($user['frozen_kuan']+$frozen_kuan);
$price2=get_check_price($user['kuan']-$frozen_kuan);
if ($frozen_kuan!='') {
mysql_query("insert into `details_funds` set title='���ת�����',spendings='$frozen_kuan',befores='$user[kuan]',afters='$price2',number='$user[number]',begtime='$begtime'",$conn1);
}
ysk_date_log(3,$_SESSION['ysk_username'],'���� ��Ա��� "'.$y1.'" ����� "'.$frozen_kuan.'" Ԫ');
mysql_query("update `members`  set frozen_kuan='$price1',kuan='$price2'  where id='$_REQUEST[id]'",$conn1); 
echo "<center><br><br><br><br><input id='btnAll' type='button' value='�޸ĳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";

}else{
########�ⶳ

if ($user['frozen_kuan']<$frozen_kuan){
echo "<script>alert('�Բ��𣬸��û�������!');;self.location=document.referrer;</script>";
exit();


}
if ($frozen_kuan!='') {
$price1=get_check_price($user['kuan']+$frozen_kuan);
$price2=get_check_price($user['frozen_kuan']-$frozen_kuan);

mysql_query("insert into `details_funds` set title='�����ת���',incomes='$frozen_kuan',befores='$user[kuan]',afters='$price1',number='$user[number]',begtime='$begtime'",$conn1);
mysql_query("update `members`  set frozen_kuan='$price2',kuan='$price1'  where id='$_REQUEST[id]'",$conn1); 
}
ysk_date_log(3,$_SESSION['ysk_username'],'�ⶳ ��Ա��� "'.$y1.'" ��Ѻ�� "'.$frozen_kuan.'" Ԫ');
echo "<center><br><br><br><br><input id='btnAll' type='button' value='�޸ĳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}
}
?>
<?php if ($Action=='locks'){?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{



if(checkspace(document.add.papa.value)) {
document.add.papa.focus();
alert("�Բ�������û���������Ĳ��������أ�");
return false;
}

}
function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</script>
<form name="add" method="post" action="?Action=save2" >
<input name="id" type="hidden" value="<?=$user['id']?>" />
<input name="y1" type="hidden" value="<?=$user['number']?>" />
<input name="y2" type="hidden" value="<?=$user['locks']?>" />
<input name="y3" type="hidden" value="<?=$user['ban_reason']?>" />
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td class="td_left">��Ա��ţ�</td>
<td class="td_right"><?=$user['number']?></td>
</tr>
<tr>
<td class="td_left">��Ա��</td>
<td class="td_right"><?=number_format($user['kuan'],3);?> Ԫ</td>
</tr>
<tr>
<td class="td_left">�Ƿ��ֹ��</td>
<td class="td_right">
<input name="jinzhi" type="radio" value="0" <?php if ($user['locks']=='0'){?>checked="checked" <?php }?>>  ��ͨ  
<input name="jinzhi" type="radio" value="1" <?php if ($user['locks']=='1'){?>checked="checked" <?php }?>> ��ֹ </td>
</tr>
<tr>
<td class="td_left">��ֹԭ��</td>
<td class="td_right"><textarea name="ban" cols="50" rows="6" id="ban" class="biankuan"><?=$user['ban_reason']?></textarea></td>
</tr>
<tr>
<td class="td_left">�������룺</td>
<td class="td_right"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" />
</td>
</tr>
<tr>
<td class="td_left">&nbsp;

</td>
<td class="td_right">
<input type="submit" name="btnSubmit" value="ȷ���޸�" id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();"/>
<input type="button" value="�ر�" class="fanhui_input" onClick="cl()"  /> 
</td>
</tr>
</table>
</form>
<?php }elseif ($Action=='tongdao'){?>
<form name="add" method="post" action="?Action=save3" onSubmit="return check_feedback(this)">
<input name="y1" type="hidden" value="<?=$user['number']?>" />
<input name="id" type="hidden" value="<?=$_REQUEST['id']?>" />
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td class="td_left">��Ա��ţ�</td>
<td class="td_right"><?=$user['number']?></td>
</tr>
<?php if  ($user['zongren']!='') {?>
<tr>
<td class="td_left">ͨ���룺</td>
<td class="td_right"><?=$user['zongren']?></td>
</tr>
<?php } ?>
<tr>
<td class="td_left">������ͨ���룺</td>
<td class="td_right"><input name="zongren" type="text" id="zongren"  class="biankuan" value="<?=md5(date("Y-m-d H:i:s"))?>" style="width:240px;"> Ҫ��������ЧŶ</td>
</tr>
<tr>
<td class="td_left">&nbsp;

</td>
<td class="td_right">
<input type="submit" name="btnSubmit" value="ȷ���ύ" id="btnSubmit" class="tijiao_input" />
<input type="button" value="�ر�" class="fanhui_input" onClick="cl()"  /> 
</td>
</tr>
</table>
</form>
<?php }elseif ($Action=='save2'){
$id=inject_check($_POST['id']); 
$y1=strip_tags($_POST['y1']);
$y2=strip_tags($_POST['y2']);
$y3=strip_tags($_POST['y3']);
$jinzhi=strip_tags($_POST['jinzhi']);
$ban=strip_tags($_POST['ban']);
if ($y2<>$jinzhi){
if ($jinzhi==1){$diary=' ��ֹ'.$y1.'�û���¼ԭ���� '.$ban;}elseif ($jinzhi==0){$diary=' ������'.$y1.'��Ա��¼Ȩ��';}	
ysk_date_log(4,$_SESSION['ysk_username'],$diary);
}
mysql_query("update `members`  set ban_reason='$ban',locks='$jinzhi'  where id='$id'",$conn1); 

echo "<center><br><br><br><br><input id='btnAll' type='button' value='�޸ĳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}elseif ($Action=='save3'){
$id=inject_check($_POST['id']); 
$zongren=strip_tags($_POST['zongren']);
$y1=strip_tags($_POST['y1']);
ysk_date_log(2,$_SESSION['ysk_username'],'�޸Ļ������ ��Ա��� "'.$y1.'" ������ͨ����');
$godo=mysql_query("update `members`  set zongren='$zongren' where id='$id'",$conn1); 
echo "<center><br><br><br><br><input id='btnAll' type='button' value='�ύ�ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}
?>

</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
