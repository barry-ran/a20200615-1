<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/error.php');
$Action=strip_tags($_GET['Action']);


$sql=mysql_query("select * from vip_site  where vip_number='$_SESSION[ysk_number]'",$conn1);
$row=mysql_fetch_array($sql);

if ($Action=="save"){
$appid=strip_tags($_POST['appid']); 
$appkey=strip_tags($_POST['appkey']); 
$api_qq=strip_tags($_POST['api_qq']);
$smtp_email=strip_tags($_POST['smtp_email']);
$send_email=strip_tags($_POST['send_email']);
$send_email_password=strip_tags($_POST['send_email_password']);
$qqchat=strip_tags($_POST['qqchat']);
$qqaccount=strip_tags($_POST['qqaccount']);
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}
if ($send_email_password!=''){
$send_email_password=encrypt($send_email_password,'E','nowamagic');
}else{
$send_email_password=$row['send_email_password'];
}

if ($smtp_email!=''){
$smtp_email=$smtp_email;
}else{
$smtp_email=$row['smtp_email'];
}

if ($send_email!=''){
$send_email=$send_email;
}else{
$send_email=$row['send_email'];
}

if ($appkey==''){
$appkey=$row['appkey'];
}
if ($appid==''){
$appid=$row['appid'];
}

mysql_query("update vip_site set smtp_email='$smtp_email',send_email='$send_email',send_email_password='$send_email_password',qqreg='$api_qq',appkey='$appkey',appid='$appid',qqchat='$qqchat',qqaccount='$qqaccount' where vip_number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('�޸ĳɹ�!');self.location=document.referrer;</script>";
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="images/right.css" rel="stylesheet" type="text/css" />
</head>
<body>

<form name="add" method="post" action="?Action=save" >
<input name="Token" id="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">

<tr><td colspan="2" class="table_top" style="text-align: left;">QQ��¼��Ϣ����</td></tr>
<tr>
<td width="10%" class="td_left">API��֤��</td>
<td width="90%" class="left"><input name="api_qq" type="text" style="width:350px;" value="<?=$row['qqreg']?>" class="biankuan" />  </td>
</tr>
<tr>
<td width="10%" class="td_left">APP ID��</td>
<td width="90%" class="left"><input name="appid" type="text" style="width:350px;" value="<?=$row['appid']?>" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left">APP KEY��</td>
<td width="90%" class="left"><input name="appkey" type="text" style="width:350px;" value="" class="biankuan" /> ���޸�������</td>
</tr>	
<tr><td colspan="6" class="table_top" style="text-align: left;">����������</td></tr>
<tr>
<td width="19%" class="td_left">SMTP����</td>
<td colspan="5" class="left" style="color:#666;"><input name="smtp_email" type="text" class="biankuan" id="smtp_email" style="width:200px;" value="<?=$row['smtp_email']?>" /> �磺������ smtp.163.com ��Ѷ�� smtp.qq.com</td>
</tr>	
<tr>
<td width="19%" class="td_left">�������䣺</td>
<td colspan="5" class="left" style="color:#666;"><input name="send_email" type="text" style="width:200px;" value="<?=$row['send_email']?>" class="biankuan" /> �磺10086@qq.com</td>
</tr>	
<tr>
<td width="19%" class="td_left">�������룺</td>
<td colspan="5" class="left" style="color:#666;"><span class="left" style="color:#666;">
<input name="send_email_password" type="password" style="width:200px;" value="" class="biankuan" />
</span> �����޸�������</td>
</tr>	
<tr>
  <td colspan="2" class="table_top" style="text-align: left;">QQ����ϵͳ</td></tr>
<tr>
<td width="10%" height="28" class="td_left">QQ���죺</td>
<td width="90%" class="left"><select name="qqchat" id="qqchat">
<option value="1" <?php if($row['qqchat']=='1'){?> selected<?php } ?>>����</option>
<option value="0" <?php if($row['qqchat']=='0'){?> selected<?php } ?>>�ر�</option>
</select></td>
</tr>
<tr>
<td width="10%" height="28" class="td_left">��д˵����</td>
<td width="90%" class="left">����ո����� 1��1�������������ʾQQδ��������<a href="http://shang.qq.com" target="_blank">shang.qq.com</a>���м����</td>
</tr>
<tr>
<td width="10%" class="td_left">QQ�˻�/������</td>
<td width="90%" class="left"><textarea name="qqaccount" cols="50" rows="7" class="biankuan" id="qqaccount"><?=$row['qqaccount']?></textarea></td>
</tr>	


<tr>
<td></td>
<td colspan="5">
<input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input" /></td>
</tr>
</table>
</form>
</body>
</Html>