<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�����һ�</title>
</head>
<style>
ul{list-style-type:none}
body,form{margin:0;padding:0;font-size:12px;line-height:180%;}
/* ----------�ύ���---------- */
.page_table2 {border:0;width:100%;font-size:12px;background:#A5A5A5;}
.page_table2 table td{padding:0;margin:0;}
.page_table2 th{padding:4px;background:#fff;text-align:left;font-size:12px;border-left:1px solid #000;border-top:1px solid #000}
.page_table2 td{padding:5px;background:#fff;}
.page_table2 .td_left{text-align:right;width:28%;color:#5e3d00;}
.page_table2 .zs {color:#bbb;padding-left:5px;font-size:12px}
.page_table2 .red {color:red}
.page_table2 .blue {color:#6241ff}
.page_table2 .mibao {color:#f52554;font-size:14px;padding-left:5px;font-weight:bold}
.tijiao_input,.chaxun_input,.fanhui_input {width:75px;height:27px;line-height:27px;border:0;color:#00557d;background:url(user/images/pop_input2.png) no-repeat 0 -56px;font-weight:bold;font-size:12px;margin-right:5px;cursor:pointer; vertical-align:middle}
.input_error,.button_buy,.button_mouseover1,.button_close,.button_mouseover2,.button_other,.button_other_on,.tishi{ background-color:#6ABDEE;}
.button_buy,.button_mouseover1,.button_close,.button_mouseover2,.button_other,.button_other_on{background-color: #ffb043 ;background-position: 0 0;border:0;margin:0;padding:0;font-size:14px;font-weight:bold;cursor:pointer}
.button_buy,.button_mouseover1{color:#fff;width:108px;height:36px;margin-right:8px;background-color:#6ABDEE;}
.button_close,.button_mouseover2 {background-position: -112px 0;width:70px;height:36px;color:#666}
.tijiao {margin:10px 5px 20px 3px;padding-left:28%;}
.tijiao span{background:url(/user/images/loading1.gif) no-repeat 0 50%;padding-left:20px;color:#43ab00;display:block;height:36px;line-height:36px;}
</style>
<body>
<?php 
include('jhs_config/function.php');
$Action=$_REQUEST['Action'];
function RenNum(){
srand((double)microtime()*1000000);
$randname=rand(!$j ? 1: 1,2);
return $randname;
}
if ($Action=='save2'){
$password=md5($_REQUEST[password]);
$godo=mysql_query("update members set password='$password' where username='$_SESSION[mymnumber]'",$conn1); 
echo "<br><br><br><br><center>�����޸ĳɹ���</center>";
}
?>

<?php if ($Action==''){?>

<form action="?Action=my1" method="post">
<table cellpadding="0" cellspacing="1" bordercolor="#000000" class="page_table2">
<tr>
<td width="14%" height="32" class="td_left">�һ�;����</td>
<td width="86%"><select name="type"><option value="1" selected="selected">�ܱ�����</option><option value="2">�����һ�</option><option value="3">�����һ�</option></select></td>
</tr>
<tr>
<td width="14%" height="32" class="td_left">�û��˻���</td>
<td width="86%"><input name="number" type="text" id="number"  style="border:1px #CCCCCC solid; padding:3px;"></td>
</tr>
<tr><td width="14%" height="32" class="td_left">��֤�룺</td><td width="86%"><input name="Code" type="text" maxlength="4" id="Code" class="input" style="width:46px"  value="">

<img src="/jhs_config/getcode.php" id="checkImg" style="vertical-align:middle">  </td>
</tr>

<tr><td width="14%" height="32" class="td_left"></td><td width="86%"><input name="�ύ" type="submit" value="��һ��"  class="button_buy" /></td></tr>
</table></form>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>
<td height="60"><img src="Public/images/f1.jpg" width="695" height="36" /></td>
</tr>
</table>


<?php }elseif($Action=='my1'){
$Code=$_POST['Code'];  //// ��֤��
if(strtoupper($Code)!=strtoupper($_SESSION['checkCode']))  {
echo "<script>alert('��֤���������������');;self.location=document.referrer;</script>";
exit();
}

if ($_REQUEST['number']!=''){
$_SESSION['mymnumber']=$_REQUEST['number'];    
}

if ($_REQUEST['type']!=''){
$_SESSION['mymtype']=$_REQUEST['type'];    
}

$total=mysql_num_rows(mysql_query("SELECT * FROM `members` where  username='$_SESSION[mymnumber]'   ",$conn1));
if ($total=='0'){
echo "<script>alert('�Բ��𣬲���ʧ�� û���ҵ����û���');;self.location=document.referrer;</script>";
}



?>
<?php if ($_SESSION['mymtype']=='1') {

$totalz=mysql_num_rows(mysql_query("SELECT * FROM `encrypted_problem` where  username='$_SESSION[mymnumber]' ",$conn1));
if ($totalz=='0'){
echo "<script>alert('�Բ��𣬲���ʧ�� ���˻�δ�����ܱ����⣡');;self.location=document.referrer;</script>";
exit();
}

$sql="select * from encrypted_problem where username='$_SESSION[mymnumber]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
$k[1]=$row['question1'];
$k[2]=$row['question2'];
?><form action="?Action=save1" method="post"><table cellspacing="1" cellpadding="0" class="page_table2"><tr><td width="14%" height="32" class="td_left">�ܱ����⣺</td><td width="86%"><input name="question" type="text" value="<?=$k[RenNum()];?>" style="border:none;" readonly></td></tr><tr><td width="14%" height="32" class="td_left">����ش�</td><td width="86%"><input name="answer" type="text" id="answer"  style="border:1px #CCCCCC solid; padding:3px;"></td></tr><tr><td width="14%" height="32" class="td_left"></td><td width="86%"><input name="�ύ" type="submit" value="ȷ���ύ"  class="button_buy" /></td></tr></table></form><?php } ?>
<?php if ($_SESSION['mymtype']=='3') {
echo "�ù�����δ���ţ�";
exit();
}
?>
<?php if ($_SESSION['mymtype']=='2') {
$sql="select * from members where username='$_SESSION[mymnumber]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
//���õ�¼����
$password=rand(100000,999999);
$passwords=md5($password);
mysql_query("update members set password='$passwords' where username='$_SESSION[mymnumber]'",$conn1); 
ini_set("magic_quotes_runtime",0); 
require 'public/phpmailer/class.phpmailer.php'; 
try { 
$mail = new PHPMailer(true); 
$mail->IsSMTP(); 
$mail->CharSet='gb2312'; //�����ʼ����ַ����룬�����Ҫ����Ȼ�������� 
$mail->SMTPAuth = true; //������֤ 
$mail->Port = 25; 
$mail->Host =     $smtp_email; 
$mail->Username = $send_email; 
$mail->Password = encrypt($send_email_password,'D','nowamagic'); 
//$mail->IsSendmail(); //���û��sendmail�����ע�͵���������֡�Could not execute: /var/qmail/bin/sendmail ���Ĵ�����ʾ 
$mail->AddReplyTo($send_email,"mckee");//�ظ���ַ 
$mail->From =     $send_email; 
$mail->FromName = $site_name; 
$to = $row['email'];     ####�ռ��� 
$mail->AddAddress($to); 
$mail->Subject = $site_name."�����һ�"; 
$mail->Body = "�װ����û�����<br><br>�����µ�¼������".$password." ������¼�󾡿��޸ģ�"; 
$mail->AltBody = "лл����֧��"; //���ʼ���֧��htmlʱ������ʾ������ʡ�� 
$mail->WordWrap = 80; // ����ÿ���ַ����ĳ��� 
//$mail->AddAttachment("f:/test.png"); //������Ӹ��� 
$mail->IsHTML(true); 
$mail->Send(); 
}
catch (phpmailerException $e) { 
}

echo "<br><br><br><br><center>���������������䷢����һ�������һ��ʼ�����ǰ�����ţ���������һء�</center>";


} ?>
<?php }elseif($Action=='save1'){
$sql="select * from encrypted_problem where username='$_SESSION[mymnumber]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);

if ($row['question1']==$_REQUEST['question']){
if ($row['answer1']!=$_REQUEST['answer']){
echo "<script>alert('�Բ����ܱ�����ش����');window.location='forget.php';</script>";
exit();
}
}

if ($row['question2']==$_REQUEST['question']){
if ($row['answer2']!=$_REQUEST['answer']){
echo "<script>alert('�Բ����ܱ�����ش����');window.location='forget.php';</script>";
exit();
}
}

?><form action="?Action=save2" method="post" name="userinfo"><table cellspacing="1" cellpadding="0" class="page_table2"><tr><td width="14%" height="32" class="td_left">���������룺</td><td width="86%"><input name="password" type="password" id="password"  style="border:1px #CCCCCC solid; padding:3px;"></td></tr><tr><td width="14%" height="32" class="td_left">ȷ�������룺</td><td width="86%"><input name="qrpassword" type="password" id="qrpassword"  style="border:1px #CCCCCC solid; padding:3px;"></td></tr><tr><td width="14%" height="32" class="td_left"></td><td width="86%"><input name="�ύ" type="submit" value="ȷ���ύ"  class="button_buy" / onClick="return checkuserinfo();" ></td></tr></table></form><?php } ?>
</body>
</Html>
<SCRIPT LANGUAGE="JavaScript">function checkuserinfo()
{

if(checkspace(document.userinfo.password.value) || document.userinfo.password.value.length < 6 || document.userinfo.password.value.length >16) {
document.userinfo.password.focus();
alert("���볤�Ȳ���Ϊ�գ���6λ��16λ֮�䣬���������룡");
return false;
}
if(document.userinfo.password.value != document.userinfo.qrpassword.value) {
document.userinfo.password.focus();
document.userinfo.password.value = '';
document.userinfo.qrpassword.value = '';
alert("������������벻ͬ�����������룡");
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
