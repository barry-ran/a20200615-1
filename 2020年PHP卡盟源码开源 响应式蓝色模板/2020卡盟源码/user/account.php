
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ۺ���</title>

<!-- �ر�Ԫ�� ��ʼ -->
<script src="css/dialog.close.js" type="text/javascript"></script>
<!-- �ر�Ԫ�� ���� -->

<!-- jQueryԪ�� ��ʼ -->
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQueryԪ�� ���� -->

<!-- ����Ԫ�� ��ʼ -->
<link href="css/my/style.css" rel="stylesheet" type="text/css" />
<!-- ����Ԫ�� ���� -->

<!-- ��Ԫ�� ��ʼ -->
<script src="css/jquery.form.js" type="text/javascript"></script>
<!-- ��Ԫ�� ���� -->

<!-- ����֤Ԫ�� ��ʼ -->
<script src="css/my/jquery.validate.js" type="text/javascript"></script>
<!-- ����֤Ԫ�� ���� -->
<link href="css/css.css" rel="stylesheet" type="text/css">
<!--[if IE]>
		<script src="js/html5.js"></script>
		<![endif]-->
</head>
 
<body>
<?php
$Action=$_REQUEST['Action'];
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
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
<?php
if ($Action=='zlsave'){

if ($_SESSION['yx_token']!=$_POST['Token']){header('location:/404.php');exit();}

$address=strip_tags(inject_check($_POST['address']));
$rname=strip_tags(inject_check($_POST['rname']));
$qq=strip_tags(inject_check($_POST['qq']));
$phone=strip_tags(inject_check($_POST['phone']));
$email=strip_tags(inject_check($_POST['email']));
$txtPayPwd = strip_tags(inject_check($_POST['txtPayPwd']));

if(md5($txtPayPwd) == $yx_us['passwords']){
mysql_query("update members set qq='$qq',rname='$rname',address='$address',phone='$phone',email='$email'   where number='$_SESSION[ysk_number]'",$conn1); 

echo "<br><center><img src='/../Public/images/biaoqing/007.png' /><br><br><input id='btnAll' type='button' value='�޸ĳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}else{ echo "<script>alert('�Բ������Ľ������벻��ȷ��');;self.location=document.referrer;</script>";}
}
if ($Action=='pssave') {
	
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}

if ($yx_us['password']!=md5($_POST['password'])) {
echo "<script>alert('�Բ��������˻����벻��ȷ��');;self.location=document.referrer;</script>";
exit();
}
$passwords=md5($_REQUEST['password1']);

mysql_query("update members set password='$passwords'  where number='$_SESSION[ysk_number]'",$conn1); 
echo "<br><center><img src='/../Public/images/biaoqing/007.png' /><br><input id='btnAll' type='button' value='�޸ĳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";

}

if ($Action=='jysave') {

if ($yx_us['passwords']!=md5($_REQUEST['password'])) {
echo "<script>alert('�Բ������Ľ������벻��ȷ��');;self.location=document.referrer;</script>";
exit();
}
$passwords=md5($_REQUEST['password1']);
mysql_query("update members set passwords='$passwords'  where number='$_SESSION[ysk_number]'",$conn1); 
echo "<br><center><img src='/../Public/images/biaoqing/007.png' /><br><input id='btnAll' type='button' value='�޸ĳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";

}
?>


<?php if ($Action=='jymm') {?>
<script language="JavaScript">
<!--
function checkuserinfo()
{
if(checkspace(document.userinfo.password.value)) {
document.userinfo.password.focus();
alert("�Բ���ԭ���벻��Ϊ�գ�");
return false;
} 
if(checkspace(document.userinfo.password1.value) || document.userinfo.password1.value.length < 6 || document.userinfo.password1.value.length >20) {
document.userinfo.password1.focus();
alert("���볤�Ȳ���Ϊ�գ���6λ��20λ֮�䣬���������룡");
return false;
}
if(document.userinfo.password1.value != document.userinfo.password2.value) {
document.userinfo.password1.focus();
document.userinfo.password1.value = '';
document.userinfo.password2.value = '';
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
<form name="userinfo" method="post" action="?Action=jysave">
<input name="Token" type="hidden" value="<?=genToken()?>">
<div class="page-edit-box">

<table class="page-edit">
<tbody>
<tr>
                <td class="td-left" style="width: 25%">
                    ��ǰ״̬��
                </td>
                <td class="td-right">
                    �����ý�������
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
<tr>
                <td class="td-left" style="width: 25%">
                    ԭ�������룺
                </td>
                <td class="td-right">
                    <input name="password" type="password"  id="password" class="input0" style="width: 150px;">
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td class="td-left">
                    �½������룺
                </td>
                <td class="td-right">
                    <input name="password1" type="password"   id="password1" class="input0" style="width: 150px;">
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td class="td-left">
                    ȷ���µ�¼���룺
                </td>
                <td class="td-right">
                    <input name="password2" type="password"   id="password2" class="input0" style="width: 150px;">
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
        
                    <input type="hidden" id="mm" type="radio" name="mm" value="1" checked="checked" />
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td class="td-left">
                    
                </td>
                <td class="td-right">
                    <input type="submit" name="btnSubmit" onClick="return checkuserinfo();" value="ȷ���޸�" id="btnSubmit" class="btn-submit"> 
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
        </tbody></table>
 
</div>  
</form>
<?php } ?>
<?php if ($Action=='zl') {?>
<script language="JavaScript">
<!--
function check_feedback(form1){
if (add.phone.value=="") {alert("��ϵ�绰����Ϊ��");add.phone.focus();return false;}
if (add.rname.value=="") {alert("��ʵ��������Ϊ��");add.rname.focus();return false;}
if (add.email.value=="") {alert("���䲻��Ϊ��");add.email.focus();return false;}
if (add.qq.value=="") {alert("QQ����Ϊ��");add.qq.focus();return false;}
if (add.address.value=="") {alert("��ַ����Ϊ��");add.address.focus();return false;}

if(add.email.value.length!=0)
{
if (add.email.value.charAt(0)=="." ||        
add.email.value.charAt(0)=="@"||       
add.email.value.indexOf('@', 0) == -1 || 
add.email.value.indexOf('.', 0) == -1 || 
add.email.value.lastIndexOf("@")==add.email.value.length-1 || 
add.email.value.lastIndexOf(".")==add.email.value.length-1)
{
alert("Email��ַ��ʽ����ȷ��");
add.email.focus();
return false;
}
}
else
{
alert("Email��ַ����Ϊ�գ�");
add.email.focus();
return false;
}
}
//-->
</script>
<form name="add" method="post" action="?Action=zlsave" onSubmit="return check_feedback(this)">
<input name="Token" type="hidden" value="<?=genToken()?>">
<div class="content ui-switchable" id="J-trend-tabs" data-tair-key="PERSONAL_USERINFO_HIDDEN" data-behavior-key="trendTabPosition" data-widget-cid="widget-1">
<div class="page-edit-box">
<table class="page-edit" >
<tbody><tr>
                <td class="td-left" style="width: 25%">
                    �ֻ����룺
                </td>
                <td class="td-right">
                    <input name="phone" type="text" value="<?=$yx_us['phone']?>" id="phone" class="btn-text">
                    
                </td>
            </tr>
			<tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            <tr>
                <td class="td-left">
                    �������䣺
                </td>
                <td class="td-right">
                    <input name="email" type="text" value="<?=$yx_us['email']?>" id="email" class="btn-text">
                     
                </td>
            </tr>
			<tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            <tr>
                <td class="td-left">
                    ��ʵ������
                </td>
                <td class="td-right">
                    <input name="rname" type="text" value="<?=$yx_us['rname']?>" maxlength="50" id="name" class="btn-text" >
                    
                </td>
            </tr>
			<tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            <tr>
                <td class="td-left">
                    ��ϵQQ��
                </td>
                <td class="td-right">
                    <input name="qq" type="text" value="<?=$yx_us['qq']?>" maxlength="12" id="qq" class="btn-text">
                </td>
            </tr>
			<tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            <tr>
                <td class="td-left">
                    ��ϵ��ַ��
                </td>
                <td class="td-right">
                    <input name="address" type="text" value="<?=$yx_us['address']?>" maxlength="100" id="address" class="btn-text">
                    
                </td>
            </tr>
			<tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            
                <tr>
                    <td class="td-left">
                        <span>���뽻�����룺</span>
                    </td>
                    <td class="td-right">
                        <input name="txtPayPwd" type="password" id="txtPayPwd" class="btn-text" style="width: 150px;">
                       
                    </td>
                </tr>
            <tr>
					<td class="td-line"></td>
					<td></td>
				</tr>
            <tr>
                <td  class="td-left">
                </td>
                <td class="td-right">
                    <input type="Submit" name="btnSubmit" value="ȷ���޸�" id="btnSubmit" class="btn-submit">
                    
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
        </tbody></table>
	
		
	
</div></form>
<?php } ?>
<?php if ($Action=='password') {?>
<script language="JavaScript">
<!--
function checkuserinfo()
{

if(checkspace(document.userinfo.password.value)) {
document.userinfo.password.focus();
alert("�Բ���ԭ���벻��Ϊ�գ�");
return false;
} 
if(checkspace(document.userinfo.password1.value) || document.userinfo.password1.value.length < 6 || document.userinfo.password1.value.length >20) {
document.userinfo.password1.focus();
alert("���볤�Ȳ���Ϊ�գ���6λ��20λ֮�䣬���������룡");
return false;
}
if(document.userinfo.password1.value != document.userinfo.password2.value) {
document.userinfo.password1.focus();
document.userinfo.password1.value = '';
document.userinfo.password2.value = '';
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
<form name="userinfo" method="post" action="?Action=pssave">
<input name="Token" type="hidden" value="<?=genToken()?>">
<div class="page-edit-box">

<table class="page-edit">
<tbody><tr>
                <td class="td-left" style="width: 25%">
                    ԭ��¼���룺
                </td>
                <td class="td-right">
                    <input name="password" type="password"  id="password" class="btn-text" style="width: 150px;">
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td class="td-left">
                    �µ�¼���룺
                </td>
                <td class="td-right">
                    <input name="password1" type="password"   id="password1" class="btn-text" style="width: 150px;">
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td class="td-left">
                    ȷ���µ�¼���룺
                </td>
                <td class="td-right">
                    <input name="password2" type="password"   id="password2" class="btn-text" style="width: 150px;">
                </td>
            </tr>
            <tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
            <tr>
                <td  class="td-left">
                </td>
                <td class="tdleft">
                    <input type="submit" name="btnSubmit" value="ȷ���޸�" id="btnSubmit" onClick="return checkuserinfo();" class="btn-submit" > 
                </td>
            </tr>
			<tr>
			<td class="td-line"></td>
			<td></td>
		</tr>
        </tbody></table>
</div>
</form>
<?php } ?>

</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>