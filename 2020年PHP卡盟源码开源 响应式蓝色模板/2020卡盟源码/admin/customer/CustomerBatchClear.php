<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php if ($Action=="List" or $Action==""){?>

<div class="Menubox" >
<ul>
<li <?php if ($_REQUEST['y']=='')  {?>class="hover" <?php } ?>><a href="CustomerBatchClear.php">��������</a></li>
<li <?php if ($_REQUEST['y']=='1') {?>class="hover" <?php } ?>><a href="CustomerBatchClear.php?y=1">�����ۿ�</a></li>
<li <?php if ($_REQUEST['y']=='2') {?>class="hover" <?php } ?>><a href="CustomerBatchClear.php?y=2">����ɾ��</a></li>
</ul>
</div>
<div style="padding:10px 0px;">

<?php if ($_REQUEST['y']=='')  {?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.userinfo.Login_type.value)) {
document.userinfo.Login_type.focus();
alert("�Բ��𣬵�¼���Ͳ���Ϊ�գ�");
return false;
}   

if(checkspace(document.userinfo.balance_type.value)) {
document.userinfo.balance_type.focus();
alert("�Բ���������Ͳ���Ϊ�գ�");
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
</SCRIPT>
<form action="?Action=save1" method="post" name="userinfo" >
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
ѡ���¼���ͣ�</td>
<td class="left"> <select name="Login_type" id="Login_type">
<option value="" selected="selected">ѡ���¼����</option>
<option value="0">��δ��¼��ƽ̨��</option>
<option value="1">����һ����δ��¼ƽ̨��</option>
<option value="2">����������δ��¼ƽ̨��</option>
<option value="3">����������δ��¼ƽ̨��</option>
<option value="4">����һ��δ��¼ƽ̨��</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
ѡ��������ͣ�</td>
<td class="left"><select name="balance_type" id="balance_type">
<option value="" selected="selected">ѡ���������</option>
<option value="0">���Ϊ0Ԫ��</option>
<option value="1">���Ϊ����0С��1Ԫ��</option>
<option value="2">���Ϊ����0С��5Ԫ��</option>
<option value="3">���Ϊ����0С��10Ԫ��</option>
<option value="4">���Ϊ����0С��50Ԫ��</option>
<option value="5">���Ϊ����0С��100Ԫ��</option>

</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
ѡ��ͻ����ͣ�</td>
<td class="left"> <select name="customer_type" id="customer_type">
<option value="" selected="selected">ѡ��ͻ�����</option>
<option value="0">����ƽ̨�ͻ�(��һ��ͨ�ͻ�)</option>
<option value="2">����ƽ̨�ͻ�(����һ��ͨ�ͻ�)</option>
<option value="1">����ƽ̨�ͻ�</option>

</select></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="btnQuery" value="ȷ�Ͻ���" id="btnQuery" class="chaxun_input" onClick="return checkuserinfo();">
</td>
</tr>
</table>
</form>
<?php } ?>

<?php if ($_REQUEST['y']=='1') {?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.userinfo.balance_type.value)) {
document.userinfo.balance_type.focus();
alert("�Բ���������Ͳ���Ϊ�գ�");
return false;
}  

if(checkspace(document.userinfo.customer_type.value)) {
document.userinfo.customer_type.focus();
alert("�Բ��𣬿ͻ����Ͳ���Ϊ�գ�");
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
</SCRIPT>
<form action="?Action=save2" method="post" name="userinfo" >
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
ѡ��������ͣ�</td>
<td class="left"><select name="balance_type" id="balance_type">
<option value="" selected="selected">ѡ���������</option>
<option value="0">���Ϊ0Ԫ��</option>
<option value="1">���Ϊ����0С��1Ԫ��</option>
<option value="2">���Ϊ����0С��5Ԫ��</option>
<option value="3">���Ϊ����0С��10Ԫ��</option>
<option value="4">���Ϊ����0С��50Ԫ��</option>
<option value="5">���Ϊ����0С��100Ԫ��</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
�˻�״̬���ͣ�</td>
<td class="left"> <select name="Login_type" id="Login_type">
<option value="" selected="selected">�˻�������</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
ѡ��ͻ����ͣ�</td>
<td class="left"> <select name="customer_type" id="customer_type">
<option value="" selected="selected">ѡ��ͻ�����</option>
<option value="0">����ƽ̨�ͻ�</option>
<option value="1">����ƽ̨�ͻ�</option>

</select></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="btnQuery" value="ȷ�Ͽۿ�" id="btnQuery" class="chaxun_input" onClick="return checkuserinfo();">
</td>
</tr>
</table>
</form>
<?php } ?>


<?php if ($_REQUEST['y']=='2') {?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.userinfo.balance_type.value)) {
document.userinfo.balance_type.focus();
alert("�Բ���ע��ʱ�䲻��Ϊ�գ�");
return false;
}  

if(checkspace(document.userinfo.customer_type.value)) {
document.userinfo.customer_type.focus();
alert("�Բ��𣬿ͻ����Ͳ���Ϊ�գ�");
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
</SCRIPT>
<form action="?Action=save3" method="post" name="userinfo" >
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
ѡ��ע��ʱ�䣺</td>
<td class="left"><select name="balance_type" id="balance_type">
<option value="" selected="selected">ѡ��ע��ʱ��</option>
<option value="0">һ������ǰ</option>
<option value="1">һ����ǰ</option>
<option value="2">������ǰ</option>
<option value="3">������ǰ</option>
<option value="4">һ��ǰ</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
�˻�״̬���ͣ�</td>
<td class="left"> <select name="Login_type" id="Login_type">
<option value="" selected="selected">�˻������ã������Ϊ0��</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
ѡ��ͻ����ͣ�</td>
<td class="left"> <select name="customer_type" id="customer_type">
<option value="" selected="selected">ѡ��ͻ�����</option>
<option value="0">����ƽ̨�ͻ�</option>
<option value="1">����ƽ̨�ͻ�</option>

</select></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="btnQuery" value="ȷ�Ͽۿ�" id="btnQuery" class="chaxun_input" onClick="return checkuserinfo();">
</td>
</tr>
</table>
</form>
<?php } ?>

</div>
<?php }elseif($Action=="save1"){  
$Login_type=$_REQUEST['Login_type'];       #######��¼����
$balance_type=$_REQUEST['balance_type'];   #######�������
$customer_type=$_REQUEST['customer_type']; #######�ͻ�����
$yu1=strtotime('-1 month', time());              // 1����
$yu2=strtotime('-3 month', time());              // 3����
$yu3=strtotime('-6 month', time());              // 6����
$yu4=strtotime('-12 month', time());             // 12����
$search="where 1=1  "; 

###############��¼���Ͳ�Ϊ��
if ($Login_type!='' and $Login_type=='0') $search.=" and logins='0' "; 
if ($Login_type!='' and $Login_type=='1') $search.=" and lost_time<=$yu1"; 
if ($Login_type!='' and $Login_type=='2') $search.=" and lost_time<=$yu2"; 
if ($Login_type!='' and $Login_type=='3') $search.=" and lost_time<=$yu3"; 
if ($Login_type!='' and $Login_type=='4') $search.=" and lost_time<=$yu4"; 

###############������Ͳ�Ϊ��

if ($balance_type!='' and $balance_type=='0') $search.=" and kuan=0 "; 
if ($balance_type!='' and $balance_type=='1') $search.=" and kuan>=0 and kuan<1 "; 
if ($balance_type!='' and $balance_type=='2') $search.=" and kuan>=0 and kuan<5 "; 
if ($balance_type!='' and $balance_type=='3') $search.=" and kuan>=0 and kuan<10 "; 
if ($balance_type!='' and $balance_type=='4') $search.=" and kuan>=0 and kuan<50 "; 
if ($balance_type!='' and $balance_type=='5') $search.=" and kuan>=0 and kuan<100 "; 



$pro_sql="SELECT * FROM members  $search  order by id desc";
$pro_zyc=mysql_query($pro_sql,$conn1);
$aa=mysql_num_rows($pro_zyc);
if($aa!=0){
while($pro_row=mysql_fetch_array($pro_zyc)){ 

$godo=mysql_query("update members set locks='1' where id='$pro_row[id]'",$conn1); 
}
}
echo "<script>alert('����ɹ�����Ӱ�� $aa ������!');;self.location=document.referrer;</script>";
?>

<?php }elseif($Action=="save2"){  
$Login_type=$_REQUEST['Login_type'];       #######��¼����
$balance_type=$_REQUEST['balance_type'];   #######�������
$customer_type=$_REQUEST['customer_type']; #######�ͻ�����
$search="where 1=1  and locks=1 "; 


###############������Ͳ�Ϊ��
if ($balance_type!='' and $balance_type=='0') $search.=" and kuan=0 "; 
if ($balance_type!='' and $balance_type=='1') $search.=" and kuan>=0 and kuan<1 "; 
if ($balance_type!='' and $balance_type=='2') $search.=" and kuan>=0 and kuan<5 "; 
if ($balance_type!='' and $balance_type=='3') $search.=" and kuan>=0 and kuan<10 "; 
if ($balance_type!='' and $balance_type=='4') $search.=" and kuan>=0 and kuan<50 "; 
if ($balance_type!='' and $balance_type=='5') $search.=" and kuan>=0 and kuan<100 "; 



$pro_sql="SELECT * FROM members  $search  order by id desc";
$pro_zyc=mysql_query($pro_sql,$conn1);
$aa=mysql_num_rows($pro_zyc);
if($aa!=0){
while($pro_row=mysql_fetch_array($pro_zyc)){ 

$godo=mysql_query("update members set kuan='0' where id='$pro_row[id]'",$conn1); 

}
}
echo "<script>alert('����ɹ�����Ӱ�� $aa ������!');;self.location=document.referrer;</script>";
?>

<?php }elseif($Action=="save3"){  
$Login_type=$_REQUEST['Login_type'];       #######��¼����
$balance_type=$_REQUEST['balance_type'];   #######�������
$customer_type=$_REQUEST['customer_type']; #######�ͻ�����
$yu1=strtotime('-1 week', time());              // 1����
$yu2=strtotime('-1 month', time());              // 3����
$yu3=strtotime('-3 month', time());              // 6����
$yu4=strtotime('-6 month', time());             // 12����
$yu5=strtotime('-12 month', time());             // 12����
$search="where 1=1 and logins=1 and kuan=0  "; 

###############��¼���Ͳ�Ϊ��
if ($balance_type!='' and $balance_type=='0') $search.=" and time>=$yu1 "; 
if ($balance_type!='' and $balance_type=='1') $search.=" and time>=$yu2"; 
if ($balance_type!='' and $balance_type=='2') $search.=" and time>=$yu3"; 
if ($balance_type!='' and $balance_type=='3') $search.=" and time>=$yu4"; 
if ($balance_type!='' and $balance_type=='4') $search.=" and time>=$yu5"; 

$pro_sql="SELECT * FROM members  $search  order by id desc";
$pro_zyc=mysql_query($pro_sql,$conn1);
$aa=mysql_num_rows($pro_zyc);
if($aa!=0){
while($pro_row=mysql_fetch_array($pro_zyc)){ 

$sql="delete from members where id ='$pro_row[id]'";
mysql_query($sql,$conn1);

}
}
echo "<script>alert('����ɹ�����Ӱ�� $aa ������!');;self.location=document.referrer;</script>";

}
?>
</body>
</Html>