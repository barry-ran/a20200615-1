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
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
$Customer1=strip_tags($_POST['Customer1']);
$Customer2=strip_tags($_POST['Customer2']);
$online=strip_tags($_POST['online']);
if ($Action=="save"){
if ($Customer1==$Customer2){
echo "<script language=\"javascript\">alert('���ܰ��Լ�ѽ��');history.go(-1);</script>";
exit();
}
if   ($online=='1') {  /////////���˻�
$sql1=mysql_query("select * from members where number='$Customer2'",$conn1);
$agent=mysql_fetch_array($sql1);
if ($agent){
$sql2=mysql_query("select * from members where number='$Customer1'",$conn1);
$user=mysql_fetch_array($sql2);
if ($user){
if ($agent['level']<$user['level']) {
echo "<script language=\"javascript\">alert('����ʧ�ܣ��ϼ����¼��ȼ���');history.go(-1);</script>";
exit();
}
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$Customer1.'" ���ϼ���������Ϊ "'.$Customer2.'"');
mysql_query("update members set xlevel=xlevel+1 where number='$Customer2'",$conn1); 
mysql_query("update members set agent='$Customer2' where number='$Customer1'",$conn1); 
echo "<script>alert('�󶨳ɹ�!');;self.location=document.referrer;</script>";
}else{
echo "<script language=\"javascript\">alert('û���ҵ����¼���ţ�');history.go(-1);</script>";
exit();	
}
}else{
echo "<script language=\"javascript\">alert('û���ҵ����ϼ���ţ�');history.go(-1);</script>";
exit();
}
}elseif($online=='0'){
$sql1=mysql_query("select * from members where number='$Customer1'",$conn1);
$agent=mysql_fetch_array($sql1);
if($agent){
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$Customer1.'" ���ϼ����� "'.$agent['agent'].'" ȡ���˰�');
mysql_query("update members set xlevel=xlevel-1 where number='$agent[agent]'",$conn1); 
mysql_query("update members set agent='' where number='$Customer1'",$conn1); 
echo "<script>alert('����ɹ�!');;self.location=document.referrer;</script>";
exit();	
}else{
echo "<script language=\"javascript\">alert('û���ҵ����¼���ţ�');history.go(-1);</script>";
exit();
}
}
}



?>
<?php if ($Action==""){?>
<form action="?Action=save" method="post">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
�¼��ͻ���ţ�</td>
<td class="left">
<input name="Customer1" type="text" id="Customer1" style="width:250px;" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
�ϼ��ͻ���ţ�</td>
<td class="left">
<div class="td_left2">
<input name="Customer2" type="text" maxlength="25" id="Customer2" /></div>
<span class="zs">(ȡ���󶨿��Բ������ϼ����)</span>
</td>
</tr>
<tr>
<td class="td_left">
�������ͣ�</td>
<td class="left">
<table id="RadioButtonList1" border="0">
<tr>
<td><input id="online" type="radio" name="online" value="1" checked="checked" />��</td><td>    <input id="online" type="radio" name="online" value="0" />ȡ����</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="Submit" value="ȷ�ϲ���" id="Submit" class="chaxun_input" />
</td>
</tr>
</table>
</form>
<?php } ?>
</body>
</Html>