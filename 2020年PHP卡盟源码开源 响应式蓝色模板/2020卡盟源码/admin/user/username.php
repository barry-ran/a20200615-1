
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];

if ($Action=="addsave") {
$username=strip_tags($_POST['username']);
$rname=strip_tags($_POST['rname']);
$email=strip_tags($_POST['email']);
$begtime=$_POST['begtime'];       
$password=md5(strip_tags($_POST['password'])); 
$passwords=md5(strip_tags($_POST['passwords']));


$total=mysql_num_rows(mysql_query("select * from `administrator` where username='$username'",$conn1));
if ($total>0){
echo "<script language=\"javascript\">alert('�Բ����˻��Ѿ����������������룡');window.history.back(-1);</script>";
}else{  
ysk_date_log(6,$_SESSION['ysk_username'],'������һ������Ϊ "'.$username.'" ϵͳ����Ա');
mysql_query("insert into `administrator`(username,rname,password,passwords,email,begtime) "."values ('$username','$rname','$password','$passwords','$email','$begtime')",$conn1);
echo "<script>alert('��ӳɹ�!');;window.location='username.php';</script>";
}

}

////////���û�ԱȨ��
If ($Action=="locksave") {
$mudi=$_POST['lock'];
$mudi=implode(",", $mudi);
$y1=$_POST['y1'];
$y2=$_POST['y2'];
if ($y1<>$mudi){
ysk_date_log(6,$_SESSION['ysk_username'],'��ϵͳ����'.$y2.'�޸���һЩ����Ȩ��');
}
mysql_query("update administrator set flag='$mudi' where id='$_REQUEST[id]'",$conn1); 
echo "<script>alert('�޸ĳɹ�!');window.location='username.php';</script>";
}

////////�޸ļ�¼
If ($Action=="editsave") {
$rname=strip_tags($_POST['rname']);
$username=strip_tags($_POST['username']);
$password=strip_tags($_POST['password']);
$passwords=strip_tags($_POST['passwords']);
$email=strip_tags($_POST['email']);
$y1=strip_tags($_POST['y1']);
$y2=strip_tags($_POST['y2']);
$y3=strip_tags($_POST['y3']);
$y4=strip_tags($_POST['y4']);
$y5=strip_tags($_POST['y5']);
if ($y1<>$rname){ysk_date_log(6,$_SESSION['ysk_username'],'�ѱ�ע���� "'.$y1.'" �޸ĳ�"'.$rname.'"');}
if ($y2<>$username){ysk_date_log(6,$_SESSION['ysk_username'],'�ѻ�Ա�˻� "'.$y2.'" �޸ĳ�"'.$username.'"');}
if ($y5<>$email){ysk_date_log(6,$_SESSION['ysk_username'],'�Ѱ����� "'.$y5.'" �޸ĳ�"'.$email.'"');}

mysql_query("update administrator set username='$_POST[username]',rname='$_POST[rname]' where id='$_REQUEST[id]'",$conn1);
if ($password<>''){
$password1=md5($password);
if ($y3<>$password1){ysk_date_log(6,$_SESSION['ysk_username'],'�ѻ�Ա�˻� "'.$y2.'" �����޸ĳ�"'.$password.'"');}
mysql_query("update administrator set password='$password1' where id='$_REQUEST[id]'",$conn1);	
}
if ($passwords<>''){
$passwords1=md5($passwords);
if ($y4<>$passwords1){ysk_date_log(6,$_SESSION['ysk_username'],'�ѻ�Ա�˻� "'.$y2.'" ���������޸ĳ�"'.$passwords.'"');}
mysql_query("update administrator set passwords='$passwords1' where id='$_REQUEST[id]'",$conn1);	
}

echo "<script>alert('�޸ĳɹ�!');;window.location='username.php';</script>";
}

////////ɾ������¼
if ($Action=="del") {

ysk_date_log(6,$_SESSION['ysk_username'],'ɾ��һ������Ϊ "'.$_REQUEST['name'].'" ��ϵͳ����Ա');
mysql_query("delete from administrator where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='username.php';</script>";
}

////////����ɾ��
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from administrator where id in ($ID_Dele)",$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='username.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>

<link rel="stylesheet" href="../css/layui.css" media="all">
<link rel="stylesheet" href="../css/admin.css" media="all">
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script type="text/javascript">

function diag(var1,var2){

var user = window.prompt("��ȫ����","���ڴ��������Ĳ�������");
window.location.href="username.php?Action=del&Id="+var1+"&name="+var2+"&papa="+user;
}
</script>
<?php If  ($Action==""){ ?>
<div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header">�������� - Powered by <a href="http://www.juheshe.cn" target="_blank">�ۺ���</a></div>
	  <div class="layui-card-body" style="padding: 15px;">
<div style="padding-bottom: 10px;"> <a href="?Action=add" class="layui-btn layui-btn-sm layui-btn-normal">��ӹ���Ա</a>
		  </div>
		  <table class="layui-table admin-table">
<div class="layui-table-header"><thead>
                <tr>
                    <th width="80px" style="text-align:center">���</th>
					<th width="200px" style="text-align:center">��Ա�˻�</th>
					<th width="300px" style="text-align:center">��ע����</th>
                    <th width="300px" style="text-align:center">�˻����</th>
                    <th width="500px" style="text-align:center">��ͨʱ��</th>
                    <th width="200px" style="text-align:center">����Ȩ��</th>
                    <th width="200px" style="text-align:center">������־</th>
                    <th width="200px" style="text-align:center">����</th>
                </tr>
            </thead>
			</div></div>
<?php

$total=mysql_num_rows(mysql_query("SELECT * FROM `administrator`  ",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from administrator   order by begtime desc,id desc  {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><?=$row[id]?></td>
<td align="center"><?=$row['username']?></td>
<td align="center"><?=$row['rname']?></td>
<td align="center"><?=$row['amount']?></td>
<td align="center"> <?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center"><a href="?Action=lock&id=<?=$row['id']?>" class="layui-btn layui-btn-sm">Ȩ������</a></td>
<td align="center"><a href="diary_datas.php?username=<?=$row['username']?>" class="layui-btn layui-btn-sm layui-btn-normal">�鿴��־</a></td>
<td align="center"><a href="?Action=edit&id=<?=$row['id']?>" class="layui-btn layui-btn-sm layui-btn-radius">�༭</a> 
  <?php if ($_SESSION['ysk_founder']!='1') {?>
  <a href="#"  onClick="Javascript:return confirm('�Բ��������Ǵ�ʼ���޷�ɾ���û���');" class="layui-btn layui-btn-sm layui-btn-danger">ɾ��</a>
  <?php }else{?>
  <?php if ($_SESSION['ysk_username']==$row['username']){?>
  <?php }else{?>
  <a href="#"  onclick="diag(<?=$row['id']?>,'<?=$row['rname']?>')" class="layui-btn layui-btn-sm layui-btn-danger">ɾ��</a>
  <?php }?>
  <?php }?> </td>
</tr>
<?php
 }
 ?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px;">
<?=$page->paging();?>   
</td>
</tr>
</table>
<?php  }elseif ($Action=="add") { ?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{


if(checkspace(document.add.rname.value)) {
document.add.rname.focus();
alert("�Բ��𣬱�ע���Ʋ���Ϊ�գ�");
return false;
}

if(checkspace(document.add.username.value)) {
document.add.username.focus();
alert("�Բ��𣬻�Ա�˻�����Ϊ�գ�");
return false;
}

if(checkspace(document.add.password.value)) {
document.add.password.focus();
alert("�Բ��𣬻�Ա���벻��Ϊ�գ�");
return false;
}

if(checkspace(document.add.passwords.value)) {
document.add.passwords.focus();
alert("�Բ��𣬻�Ա�������벻��Ϊ�գ�");
return false;
}



if(document.add.email.value.length!=0)
{
if (document.add.email.value.charAt(0)=="." ||        
document.add.email.value.charAt(0)=="@"||       
document.add.email.value.indexOf('@', 0) == -1 || 
document.add.email.value.indexOf('.', 0) == -1 || 
document.add.email.value.lastIndexOf("@")==document.add.email.value.length-1 || 
document.add.email.value.lastIndexOf(".")==document.add.email.value.length-1)
{
alert("Email��ַ��ʽ����ȷ��");
document.add.email.focus();
return false;
}
}
else{
alert("Email��ַ����Ϊ�գ�");
document.add.email.focus();
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
<form name="add" method="post" action="?Action=addsave" >

<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��Ϣ���</td>
</tr>
<input name="begtime" readonly="readonly" type="hidden"  value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<tr>
<td width="10%" class="td_left">��ע���ƣ�</td>
<td width="90%" class="left"><input name="rname" type="text" style="width:150px;" value="" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left">��Ա�˻���</td>
<td width="90%" class="left"><input name="username" type="text" style="width:150px;" value="" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left">��¼���룺</td>
<td width="90%" class="left"><input name="password" type="text" style="width:150px;" value="" class="biankuan" /> </td>
</tr>
<tr>
<td width="10%" class="td_left">�������룺</td>
<td width="90%" class="left"><input name="passwords" type="text" style="width:150px;" value="" class="biankuan" />�����������漰��Ҫ��������������� </td>
</tr>
<tr>
<td width="10%" class="td_left">�����䣺</td>
<td width="90%" class="left"><input name="email" type="text" style="width:150px;" value="" class="biankuan" /> </td>
</tr>
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��ȫ��֤</td>
</tr>
<tr>
<td width="10%" class="td_left">���������Ĳ������룺</td>
<td width="90%" class="left"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" /> </td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�����"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
<?php  }elseif ($Action=="lock"){ 
$sql=mysql_query("select * from administrator where id='$_REQUEST[id]'",$conn1);
$row=mysql_fetch_array($sql);
$ysk_flagh=(explode(',',$row['flag']));
?>
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

<form name="add" method="post" action="?Action=locksave&id=<?=$row[id]?>" >
<input name="y1" type="hidden" value="<?=$row['flag']?>">
<input name="y2" type="hidden" value="<?=$row['rname']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">

<tr>
<td class="table_top"> ������� </td>
</tr>

<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="101" <?php if(in_array('101',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��������
<input name="lock[]" type="checkbox" id="lock[]" value="102" <?php if(in_array('102',$ysk_flagh)==true){?>checked="checked"<?php }?>> �շ�����
<input name="lock[]" type="checkbox" id="lock[]" value="103" <?php if(in_array('103',$ysk_flagh)==true){?>checked="checked"<?php }?>> �տ�����
<input name="lock[]" type="checkbox" id="lock[]" value="104" <?php if(in_array('104',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��������
<input name="lock[]" type="checkbox" id="lock[]" value="105" <?php if(in_array('105',$ysk_flagh)==true){?>checked="checked"<?php }?>> �������
<input name="lock[]" type="checkbox" id="lock[]" value="106" <?php if(in_array('106',$ysk_flagh)==true){?>checked="checked"<?php }?>> API����
<input name="lock[]" type="checkbox" id="lock[]" value="107" <?php if(in_array('107',$ysk_flagh)==true){?>checked="checked"<?php }?>> �ֲ�����
<input name="lock[]" type="checkbox" id="lock[]" value="108" <?php if(in_array('108',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��������
<input name="lock[]" type="checkbox" id="lock[]" value="109" <?php if(in_array('109',$ysk_flagh)==true){?>checked="checked"<?php }?>> ���¹���
<input name="lock[]" type="checkbox" id="lock[]" value="110" <?php if(in_array('110',$ysk_flagh)==true){?>checked="checked"<?php }?>> վ����Ϣ
<input name="lock[]" type="checkbox" id="lock[]" value="111" <?php if(in_array('111',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��ע���

</td>
</tr>

<tr>
<td  class="table_top">ϵͳ����</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="201" <?php if(in_array('201',$ysk_flagh)==true){?>checked="checked"<?php }?>> �˻�����
<?php if ($sup_number_module=='0') {?>
<input name="lock[]" type="checkbox" id="lock[]" value="202" <?php if(in_array('202',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��Ź���
<?php } ?>
<input name="lock[]" type="checkbox" id="lock[]" value="203" <?php if(in_array('203',$ysk_flagh)==true){?>checked="checked"<?php }?>> �콢�����
<?php if ($sup_rules_module=='0') {?>
<input name="lock[]" type="checkbox" id="lock[]" value="204" <?php if(in_array('204',$ysk_flagh)==true){?>checked="checked"<?php }?>> Υ�����
<?php } ?>

</td>
</tr>
<tr>
<td  class="table_top">��Ʒ����</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="301" <?php if(in_array('301',$ysk_flagh)==true){?>checked="checked"<?php }?>> Ŀ¼����
<input name="lock[]" type="checkbox" id="lock[]" value="302" <?php if(in_array('302',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��Ʒ����
<input name="lock[]" type="checkbox" id="lock[]" value="303" <?php if(in_array('303',$ysk_flagh)==true){?>checked="checked"<?php }?>> �۸�ģ�����
<input name="lock[]" type="checkbox" id="lock[]" value="304" <?php if(in_array('304',$ysk_flagh)==true){?>checked="checked"<?php }?>> ����ģ�����
<input name="lock[]" type="checkbox" id="lock[]" value="305" <?php if(in_array('305',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��������Ʒ����
<input name="lock[]" type="checkbox" id="lock[]" value="306" <?php if(in_array('306',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��������Ʒ���
<input name="lock[]" type="checkbox" id="lock[]" value="307" <?php if(in_array('307',$ysk_flagh)==true){?>checked="checked"<?php }?>> ƽ̨�Խ�
<input name="lock[]" type="checkbox" id="lock[]" value="308" <?php if(in_array('308',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��������
</td>
</tr>
<tr>
<td  class="table_top">�ͻ�����</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="401" <?php if(in_array('401',$ysk_flagh)==true){?>checked="checked"<?php }?>> �������б�
<input name="lock[]" type="checkbox" id="lock[]" value="402" <?php if(in_array('402',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��Ա��������
<input name="lock[]" type="checkbox" id="lock[]" value="403" <?php if(in_array('403',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��Ա�б�
<input name="lock[]" type="checkbox" id="lock[]" value="404" <?php if(in_array('404',$ysk_flagh)==true){?>checked="checked"<?php }?>> �ʽ���ϸ
<input name="lock[]" type="checkbox" id="lock[]" value="405" <?php if(in_array('405',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��������
<input name="lock[]" type="checkbox" id="lock[]" value="406" <?php if(in_array('406',$ysk_flagh)==true){?>checked="checked"<?php }?>> ���¼�����
<input name="lock[]" type="checkbox" id="lock[]" value="407" <?php if(in_array('407',$ysk_flagh)==true){?>checked="checked"<?php }?>> �¼�VIP��վ�б�
<input name="lock[]" type="checkbox" id="lock[]" value="408" <?php if(in_array('408',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��ȫ����
<input name="lock[]" type="checkbox" id="lock[]" value="409" <?php if(in_array('409',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��������
<input name="lock[]" type="checkbox" id="lock[]" value="410" <?php if(in_array('410',$ysk_flagh)==true){?>checked="checked"<?php }?>> 
�û�����
<input name="lock[]" type="checkbox" id="lock[]" value="411" <?php if(in_array('411',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��ʵ������֤
<input name="lock[]" type="checkbox" id="lock[]" value="412" <?php if(in_array('412',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��������
</td>
</tr>
<tr>
<td  class="table_top">SUPƽ̨��Ϣ</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="501" <?php if(in_array('501',$ysk_flagh)==true){?>checked="checked"<?php }?>> Sup��Ϣ
</td>
</tr>


<tr>
<td  class="table_top">��������</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="601" <?php if(in_array('601',$ysk_flagh)==true){?>checked="checked"<?php }?>> ����������¼
<input name="lock[]" type="checkbox" id="lock[]" value="602" <?php if(in_array('602',$ysk_flagh)==true){?>checked="checked"<?php }?>> Sup��������
<input name="lock[]" type="checkbox" id="lock[]" value="603" <?php if(in_array('603',$ysk_flagh)==true){?>checked="checked"<?php }?>> ƽ̨�ԽӶ���
</td>
</tr>


<tr>
<td  class="table_top">�������</td>
</tr>
<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="701" <?php if(in_array('701',$ysk_flagh)==true){?>checked="checked"<?php }?>> ���ֹ���
<input name="lock[]" type="checkbox" id="lock[]" value="702" <?php if(in_array('702',$ysk_flagh)==true){?>checked="checked"<?php }?>> ����ʺ�
<input name="lock[]" type="checkbox" id="lock[]" value="703" <?php if(in_array('703',$ysk_flagh)==true){?>checked="checked"<?php }?>> ���֪ͨ��
<input name="lock[]" type="checkbox" id="lock[]" value="704" <?php if(in_array('704',$ysk_flagh)==true){?>checked="checked"<?php }?>> ����ת���
<input name="lock[]" type="checkbox" id="lock[]" value="705" <?php if(in_array('705',$ysk_flagh)==true){?>checked="checked"<?php }?>> �����/�ۿ�
<input name="lock[]" type="checkbox" id="lock[]" value="706" <?php if(in_array('706',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��¼
<input name="lock[]" type="checkbox" id="lock[]" value="707" <?php if(in_array('707',$ysk_flagh)==true){?>checked="checked"<?php }?>> �ͷ���/�ۿ�
<input name="lock[]" type="checkbox" id="lock[]" value="708" <?php if(in_array('708',$ysk_flagh)==true){?>checked="checked"<?php }?>> ��¼
<input name="lock[]" type="checkbox" id="lock[]" value="709" <?php if(in_array('709',$ysk_flagh)==true){?>checked="checked"<?php }?>> �����ϸ
<input name="lock[]" type="checkbox" id="lock[]" value="710" <?php if(in_array('710',$ysk_flagh)==true){?>checked="checked"<?php }?>> �����
<input name="lock[]" type="checkbox" id="lock[]" value="711" <?php if(in_array('711',$ysk_flagh)==true){?>checked="checked"<?php }?>> ���߸�����ϸ
</td>
</tr>

<tr>
<td  class="table_top">��ֵ������</td>
</tr>


<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="lock[]" type="checkbox" id="lock[]" value="801" <?php if(in_array('801',$ysk_flagh)==true){?>checked="checked"<?php }?>>  ��ֵ������
<input name="lock[]" type="checkbox" id="lock[]" value="802" <?php if(in_array('802',$ysk_flagh)==true){?>checked="checked"<?php }?>>  ��ֵ������
</td>
</tr>

<tr>
<td  class="table_top">���������Ĳ�������</td>
</tr>


<tr>
<td  height=34 align="left" class="forumRowHighlight">
<input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" /> </td>
</tr>
<tr>
<td>
<input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();" />
</td>
</tr>


</table>
</form>
<?php  }elseif ($Action=="edit") { 
 $sql="select * from administrator where id='$_REQUEST[id]'";   //��ȡ���ݱ�
 $zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
 $row=mysql_fetch_array($zyc);
?>
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
<form name="add" method="post" action="?Action=editsave&id=<?=$row[id]?>" >
<input name="y1" type="hidden" value="<?=$row['rname']?>">
<input name="y2" type="hidden" value="<?=$row['username']?>">
<input name="y3" type="hidden" value="<?=$row['password']?>">
<input name="y4" type="hidden" value="<?=$row['passwords']?>">
<input name="y5" type="hidden" value="<?=$row['email']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��Ϣ�޸�</td>
</tr>
<tr>
<td width="10%" class="td_left">��ע���ƣ�</td>
<td width="90%" class="left"><input name="rname" type="text" style="width:150px;" value="<?=$row[rname]?>" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left">��Ա�˻���</td>
<td width="90%" class="left"><input name="username" type="text" style="width:150px;" value="<?=$row[username]?>" class="biankuan" /></td>
</tr>	
<tr>
<td width="10%" class="td_left">��¼���룺</td>
<td width="90%" class="left"><input name="password" type="password" style="width:150px;" value="" class="biankuan" /> ���޸�����</td>
</tr>
<tr>
<td width="10%" class="td_left">�������룺</td>
<td width="90%" class="left"><input name="passwords" type="password" style="width:150px;" value="" class="biankuan" /> ���޸�����</td>
</tr>
<tr>
<td width="10%" class="td_left">�����䣺</td>
<td width="90%" class="left"><input name="email" type="email" style="width:150px;" value="<?=$row[email]?>" class="biankuan" /> </td>
</tr>
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��ȫ��֤</td>
</tr>
<tr>
<td width="10%" class="td_left">���������Ĳ������룺</td>
<td width="90%" class="left"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" /> </td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���޸�"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();" />
</td>
</tr>

</table>
</form>
<?php
 }
 ?>
</body>
</Html>