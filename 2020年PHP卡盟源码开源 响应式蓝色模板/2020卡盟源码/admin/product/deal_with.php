<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
$_SESSION['yDel']='';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
if ($Action=='movesave') {
$nid=$_REQUEST['nid'];
$type=$_REQUEST['type'];
$tend=end($_SESSION['allArray']);
$kaishi=$_SESSION['allArray'][0];
$result=mysql_query("select  * from product where id='$nid'",$conn1);
$start=mysql_fetch_array($result);//--------------------------------------------------��ȡ�ο�Ŀ�������ֵ
$result9=mysql_query("select * from product where id='$tend'",$conn1);
$kai=mysql_fetch_array($result9);//---------------------------------------------------��ȡ�ƶ�Ŀ�������ֵ
if (!$start){
echo "<script>alert('�Բ���û���ҵ��ñ��!');self.location=document.referrer;</script>";
exit();
}
//--------------------------------------------------------------------------------------------���ݼ���
if ($kai['paixu']>$start['paixu']){
$result1=mysql_query("select * from product where id='$tend'",$conn1);
$end=mysql_fetch_array($result1);
$search="where paixu>='$start[paixu]' and  paixu<='$end[paixu]'  order by paixu asc"; 
}elseif ($kai['paixu']<$start['paixu']){
$result1=mysql_query("select * from product where id='$kaishi'",$conn1);
$end=mysql_fetch_array($result1);
$search="where paixu<'$start[paixu]' and  paixu>='$end[paixu]'  order by paixu desc"; 
}elseif ($kai['paixu']=$start['paixu']){
echo "<script>alert('����ʧ�ܣ�����쳣!');self.location=document.referrer;</script>";
exit();
}
//--------------------------------------------------------------------------------------------���ݼ��� The End
$result2=mysql_query("select * from product $search",$conn1);
while ($row=mysql_fetch_array($result2)){
$paixu.=$row['paixu'].',';
$sid.=$row['id'].',';
}
$paixu=substr($paixu,0,strlen($paixu)-1); 
$sid=substr($sid,0,strlen($sid)-1); 
$paixu=(explode(',',$paixu));
$sid=(explode(',',$sid));

$cards=array_merge($_SESSION['allArray'],$sid);//�ϲ�2������
$cards=array_unique($cards);//ɾ����ͬ����

$i=0;
foreach($cards as $value){
if ($paixu[$i]<>''){
mysql_query("update product set paixu='$paixu[$i]' where id='$value'",$conn1); 
}
$i++;
}





echo "<br><br><br><center><input id='btnAll' type='button' value='����ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}

if ($Action=='stopsave'){
foreach($_SESSION['allArray'] as $value){
$hsql=mysql_query("select * from product where id='$value'",$conn1);
$hi=mysql_fetch_array($hsql);
ysk_date_log(5,$_SESSION['ysk_username'],'�� "'.$hi['title'].'" ��Ʒ״̬�ĳ���ͣ ԭ���� :'.$_REQUEST['content']);
mysql_query("update product set state='1',reason='$_REQUEST[content]' where id='$value'",$conn1);
}
echo "<br><br><br><center><input id='btnAll' type='button' value='����ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";

}elseif ($Action=='nosave'){
ysk_date_log(5,$_SESSION['ysk_username'],'�� "'.$hi['title'].'" ��Ʒ���� ԭ���� :'.$_REQUEST['content']);
foreach($_SESSION['allArray'] as $value){mysql_query("update product set locks='1',whys='$_REQUEST[content]' where id='$value'",$conn1);}
echo "<br><br><br><center><input id='btnAll' type='button' value='����ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
///////////////////////////////////////////////////////////��Ʒ����
}elseif ($Action=='pricingsave'){
$pricing=$_REQUEST['pricing'];

////-----------------------------�ж��Ƿ��쳣
$total=mysql_num_rows(mysql_query("select * from `price_modl` where username='admin' and id='$pricing'",$conn1));

if ($total==0){
echo "<script>alert('�Բ�����û��ѡ��۸�ģ�壡');self.location=document.referrer;</script>";
exit();	
}

//-------------------------------��ȡ����
$sql=mysql_query("select * from price_modl where username='admin' and id='$pricing' ",$conn1);
$row=mysql_fetch_array($sql);
foreach($_SESSION['allArray'] as $value){
mysql_query("update product set pricing='$row[type]',rate='$row[price]' where id='$value'",$conn1);
}

echo "<br><br><br><center><input id='btnAll' type='button' value='����ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}







?>

<?php if ($Action=='move') {?>
<form action="?Action=movesave" method="post" name="move">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td class="td_left">�ο���Ʒ��ţ�</td>
<td class="left"><input name="nid" type="text" /></td>
</tr>
<tr>
<td class="td_left">λ�ã�</td>
<td class="left"><input name="type" type="radio" value="1" checked="checked" > ֮ǰ </td>
</tr>
<tr>
<td class="td_left"></td>
<td class="left"><input type="submit" name="btnSubmit" value="ȷ���޸�"  id="btnSubmit" class="tijiao_input"  onClick="return checkmove();"  />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=='stop') {?>
<form action="?Action=stopsave" method="post" name="userinfo">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td class="td_left">��ͣԭ��</td>
<td class="left"><textarea name="content" cols="40" rows="5" id="content" class="biankuan"></textarea>
</td>
</tr>
<tr>
<td class="td_left"></td>
<td class="left"><input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();"  /></td>
</tr>
</table>
</form>
<?php }elseif ($Action=='no') {?>
<form action="?Action=nosave" method="post" name="userinfo">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td class="td_left">���ԭ��</td>
<td class="left"><textarea name="content" cols="40" rows="5" id="content" class="biankuan"></textarea>
</td>
</tr>
<tr>
<td class="td_left"></td>
<td class="left"><input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();"  /></td>
</tr>
</table>
</form>
<?php }elseif($Action=='pricing'){?>
<form action="?Action=pricingsave" method="post" name="userinfo">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td width="26%" class="td_left">ѡ�񶨼�ģ�壺</td>
<td width="74%" class="left">
<select name="pricing" id="pricing">
<?php 
$results=mysql_query("select * from price_modl where username='admin'  order by id desc",$conn1);
while($type=mysql_fetch_array($results)){?>
<option value="<?=$type['id']?>"><?=$type['title']?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td class="td_left"></td>
<td class="left"><input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();"  /></td>
</tr>
</table>
</form>
<?php } ?>
</body>
</Html>
<SCRIPT LANGUAGE="JavaScript">
function cl(){
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
function checkmove(){
if(checkspace(document.move.nid.value)) {
document.move.nid.focus();
alert("�Բ��𣬲ο���Ʒ��Ų���Ϊ�գ�");
return false;
}
}

function checkuserinfo(){
if(checkspace(document.userinfo.content.value)) {
document.userinfo.content.focus();
alert("�Բ���ԭ����Ϊ�գ�");
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