
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
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
</head>
<body>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
$Local_Ip=Local_Ip();
////////�޸ļ�¼
if ($Action=="save"){
$customerid=strip_tags($_POST['customerid']);//��Ա�˻�
$type=strip_tags($_POST['type']);            //�ӿ�/�ۿ�
$price=get_check_price($_POST['price']);;    //�������
$comment=strip_tags($_POST['comment']);       //�������
$papa=md5($_POST['papa']);
if ($admin['passwords']!=$papa){
echo "<script>alert('�Բ������Ĳ�����������!');self.location=document.referrer;</script>";
exit();
}


$sqlb="select * from administrator where username='$_SESSION[ysk_username]'";   //��ȡ���ݱ�
$zycb=mysql_query($sqlb,$conn1);  //ִ�и�SQl���
$rowb=mysql_fetch_array($zycb);
$ykuan=$rowb['amount'];
$amount=$ykuan-$price;
if ($ykuan<$price){
echo "<script language=\"javascript\">alert('�Բ��������˻�������');history.go(-1);</script>";
exit();
}

if ($price<0){
echo "<script language=\"javascript\">alert('�Բ��𣬽���쳣��');history.go(-1);</script>";
exit();
}

$result = mysql_query("SELECT * FROM members where number='$customerid'",$conn1);
if  ($row = mysql_fetch_array($result)){
/////����Ǽӿ�
if  ($type=='�ӿ�'){
$kuan=$price+$row['kuan'];
$content="�� $customerid ��Ա�ӿ� $price Ԫ $comment";
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " ."values ('�ӿ�','$price','$row[kuan]','$kuan','$customerid','$begtime')",$conn1);
mysql_query("update members set kuan='$kuan'  where number='$customerid'",$conn1); 
mysql_query("insert into `diary` (username,content,begtime,youip)"."values ('$_SESSION[ysk_username]','$content','$begtime','$Local_Ip')",$conn1);
mysql_query("update administrator set amount='$amount'  where username='$_SESSION[ysk_username]'",$conn1);

ysk_date_log(3,$_SESSION['ysk_username'],'�����Ϊ "'.$customerid.'" �Ļ�Ա���� '.$price.'Ԫ');
echo "<script>alert('�ӿ�ɹ�!');;self.location=document.referrer;</script>";
exit();
}else{
/////����ǿۿ�
$amount=$row['kuan']-$price;
if ($amount<0 ){
echo "<script language=\"javascript\">alert('�Բ��𣬸û�Ա�˻����㣡');history.go(-1);</script>";
exit();
}
$content="�� $customerid ��Ա�ۿ� $price Ԫ $comment";
mysql_query("insert into `details_funds` (title,spendings,befores,afters,number,begtime) " ."values ('�ۿ�','$price','$row[kuan]','$amount','$customerid','$begtime')",$conn1);
mysql_query("update members set kuan='$amount'  where number='$customerid'",$conn1); 

mysql_query("insert into `diary` (username,content,begtime,youip)"."values ('$_SESSION[ysk_username]','$content','$begtime','$Local_Ip')",$conn1);
ysk_date_log(3,$_SESSION['ysk_username'],'�����Ϊ "'.$customerid.'" �Ļ�Ա���� '.$price.'Ԫ');
echo "<script>alert('�ۿ�ɹ�!');;self.location=document.referrer;</script>";
exit();
}
}else{
echo "<script language=\"javascript\">alert('û���ҵ��û�ԱŶ��');history.go(-1);</script>";
exit();
}
}
?>
<?php
If  ($Action=="List" or $Action==""){
$sql="select * from administrator where username='$_SESSION[ysk_username]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=save" method="post" name="add">
<table cellspacing="1" cellpadding="0" class="page_table4">
<tr>
<td colspan="2" class="table_top" style="text-align: left">
����ӿ����Ա</td>
</tr>
<tr>
<td class="td_left">
�ͻ���ţ�
</td>
<td class="left">

<input name="customerid" type="text" maxlength="20" id="customerid" style="width:100px;" />

<a href="#art1" onclick="$.dialog.open('../customer/CustomerList.php', {title: '�ͻ�ѡ���б�', width:1000, height:600, lock: true, fixed:true});"><img src="../images/icon_sousuo.gif" alt="�����ѯ�ͻ�" /></a>
</td>
</tr>
<tr>
<td class="td_left"> ����ǰ�ʻ���</td>
<td class="left"><span class="red"><?=$row['amount']?></span>&nbsp;Ԫ</td>
</tr>
<tr>
<td class="td_left">
������
</td>
<td class="left">
<input name="price" type="text" maxlength="12" id="price" style="width:80px;" onkeyup="clearNoNum(this)"/>&nbsp;Ԫ
</td>
</tr>

<tr>
<td class="td_left">
�������ͣ�
</td>
<td class="left">
<select name="type"  id="type">
<option selected="selected" value="�ӿ�">�ӿ�</option>
<option value="�ۿ�">�ۿ�</option>
</select>
</td>
</tr>
<tr>
<td class="td_left">
��ر�ע��
</td>
<td class="left">
<textarea name="comment" rows="2" cols="20" id="comment" style="height:50px;width:200px;"></textarea>
</td>
</tr>
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��ȫ��֤</td>
</tr>
<tr>
<td width="10%" class="td_left">���������Ĳ������룺</td>
<td width="90%" class="left"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" /> </td>
</tr>
<tr>
<td class="td_left">&nbsp;
</td>
<td class="left">
<input type="submit" name="Button1" value="ȷ���ύ" id="Button1" class="tijiao_input" onClick="return checkuserinfo();">
</td>
</tr>
</table>
</form>
<?php } ?>
</body>
</Html>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo(){

if(checkspace(document.add.customerid.value)) {
document.add.customerid.focus();
alert("�Բ��𣬿ͻ���Ų���Ϊ�գ�");
return false;
}

if(checkspace(document.add.price.value) || document.add.price.value <=0) {
document.add.price.focus();
alert("�Բ��𣬲�������Ϊ�գ�");
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
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>