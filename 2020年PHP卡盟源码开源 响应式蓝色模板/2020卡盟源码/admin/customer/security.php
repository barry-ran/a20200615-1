<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
////////�����û����߿���
if ($Action=="locks") {
$back_result=mysql_query("select * from members  where id='$_REQUEST[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($_REQUEST['id']==1){
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$back['number'].'" �ĵ�¼״̬�ر���');
}else{
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$back['number'].'" �ĵ�¼״̬������');
}

mysql_query("update members set locks='$_REQUEST[id]' where id='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
exit();
}
////////IP��
if ($Action=="power1") {
$back_result=mysql_query("select * from members  where id='$_REQUEST[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($_REQUEST['id']==0){
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$back['number'].'" ��IP��״̬�ر���');
}else{
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$back['number'].'" ��IP��״̬������');
}

mysql_query("update members set power1='$_REQUEST[id]' where id='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('�ύ�ɹ�!');self.location=document.referrer;</script>";
exit();
}

////////�ܱ���
if ($Action=="power2") {
$back_result=mysql_query("select * from members  where id='$_REQUEST[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($_REQUEST['id']==0){
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$back['number'].'" ���ܱ���״̬�ر���');
}else{
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$back['number'].'" ���ܱ���״̬������');
}

mysql_query("update members set power2='$_REQUEST[id]' where id='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('�ύ�ɹ�!');self.location=document.referrer;</script>";
exit();
}
////////ҳ���¼
if ($Action=="power3") {
$back_result=mysql_query("select * from members  where id='$_REQUEST[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($_REQUEST['id']==1){
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$back['number'].'" ��ҳ���¼״̬�ر���');
}else{
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$back['number'].'" ��ҳ���¼״̬������');
}

mysql_query("update members set power3='$_REQUEST[id]' where id='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('�ύ�ɹ�!');self.location=document.referrer;</script>";
exit();
}

////////��������
if ($Action=="power4") {
$back_result=mysql_query("select * from members  where id='$_REQUEST[sid]'",$conn1);
$back=mysql_fetch_array($back_result);
if ($_REQUEST['id']==0){
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$back['number'].'" �Ķ�������״̬�ر���');
}else{
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$back['number'].'" �Ķ�������״̬������');
}
mysql_query("update members set power4='$_REQUEST[id]' where id='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('�ύ�ɹ�!');self.location=document.referrer;</script>";
exit();
}
////////�����û�����
if ($Action=="password") {
$password=rand(100000,999999);
$passwords=md5($password);
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$_REQUEST['sid'].'" �ĵ�¼��������Ϊ "'.$password.'"');
mysql_query("update members set password='$passwords' where number='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('�ͻ���� $_REQUEST[sid] ��¼�������óɹ���������Ϊ$password');;self.location=document.referrer;</script>";
exit();
}

if ($Action=="passwords") {
$passwords=rand(100000,999999);
$password=md5($passwords);
ysk_date_log(2,$_SESSION['ysk_username'],'�� "'.$_REQUEST['sid'].'" �Ľ�����������Ϊ "'.$passwords.'"');
mysql_query("update members set passwords='$password' where number='$_REQUEST[sid]'",$conn1); 
echo "<script>alert('�ͻ���� $_REQUEST[sid] �����������óɹ���������Ϊ$passwords');;self.location=document.referrer;</script>";
exit();
}

?>
<div class="Menubox" >
<ul>
<li class="hover"><a href="security.php">��ȫ����</a></li>
</ul>
</div>

<?php if ($Action=="List" or $Action==""){?>
<form name="add" method="post" action="security.php" >
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
�ؼ������룺</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯ������</td>
<td class="left">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10%"><select name="keywords" id="keywords">
<option selected="selected" value="number">�ͻ����</option>
<option value="username">�ͻ�����</option>
</select></td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="ȷ�ϲ�ѯ"  class="chaxun_input" />
</td>
</tr>
</table></form>
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="11%" class="table_top">���</td>
<td width="10%" class="table_top">�ͻ���</td>
<td width="7%" class="table_top">״̬</td>
<td width="40%" class="table_top">��ȫ�󶨷���</td>
<td width="17%" class="table_top">��������</td>
<td width="15%" class="table_top">��¼��ʽ</td>
</tr>
<?php

$keyword=strip_tags($_POST['keyword']);
$keywords=strip_tags($_POST['keywords']);
$search="where 1=1  "; 
if ($keywords!='') $search.=" and $keywords like '%$keyword%' "; 
$total=mysql_num_rows(mysql_query("select * from `members`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from members  $search   order by id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){?>
<tr>
<td height="28"><?=$row['number']?></td>
<td><?=$row['username']?></td>
<td>
<?php if($row['locks']=='0'){?>
<a href="?Action=locks&id=1&sid=<?=$row['id']?>" class="a open"></a>
<?php }else{?>
<a href="?Action=locks&id=0&sid=<?=$row['id']?>" class="a open close"></a>
<?php }?>
</td>
<td>
IP�󶨣�

<?php if($row['power1']=='0'){?>
<a href="?Action=power1&id=1&sid=<?=$row['id']?>">δ��</a>
<?php }else{?>
<a href="?Action=power1&id=0&sid=<?=$row['id']?>"><span style="color:#006ab8">����</span></a>
<?php }?>

�ۺ��

<?php if($row['power4']=='0'){?>
<a href="?Action=power4&id=1&sid=<?=$row['id']?>">δ��</a>
<?php }else{?>
<a href="?Action=power4&id=0&sid=<?=$row['id']?>"><span style="color:#006ab8">����</span></a>
<?php }?>

�ܱ�����
<?php if($row['power2']=='0'){?>
<a href="?Action=power2&id=1&sid=<?=$row['id']?>">δ��</a>
<?php }else{?>
<a href="?Action=power2&id=0&sid=<?=$row['id']?>"><span style="color:#006ab8">����</span></a>
<?php }?>

</td>
<td>
<a onclick="if (confirm('ȷ�����ã�<?=$row['number']?> �ͻ��ĵ�¼���룿')) {return true;} else {return false;};" href="?Action=password&sid=<?=$row['number']?>">��¼����</a>
<a onclick="if (confirm('ȷ�����ã�<?=$row['number']?> �ͻ��Ľ������룿')) {return true;} else {return false;};" href="?Action=passwords&sid=<?=$row['number']?>">��������</a>
</td>
<td>
ҳ�棺
<?php if($row['power3']=='0'){?>
<a href="?Action=power3&id=1&sid=<?=$row['id']?>"><span style="color:#006ab8">����</span></a>
<?php }else{?>
<a href="?Action=power3&id=0&sid=<?=$row['id']?>">��ֹ</a>
<?php }?>
</td>
</tr>
<?php }?>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="center" style="padding:15px 0px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?>        </td> 
</tr>
</table>
</form>
<?php }?>
</body>
</Html>