<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=strip_tags($_GET['Action']);
$wrresult=mysql_query("select * from sup_members_site where number='$sup_number' ",$conn2);
$wrongs=mysql_fetch_array($wrresult);


////////��Ӽ�¼
if ($Action=="Addsave"){
$appuid=encrypt($_POST['appuid'],'D','nowamagic');
$appkey=strip_tags($_POST['appkey']);
$number=strip_tags($_POST['number']);

$sup_result=mysql_query("select * from sup_members_site where domain_name='$appuid' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//**************************************************************��ȡ���ݿ�����
$conn3 = mysql_connect('127.0.0.1',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
//**************************************************************��ȡ���ݿ�����

///////------------��֤�ü�¼�Ƿ����
$total=mysql_num_rows(mysql_query("select * from `docking_platform` where uid='$appuid' and key='$appkey' and username='$number' ",$conn1));
if ($total!=0){
echo "<center><br><br><br><br>����ʧ�ܣ���ƽ̨���Ѿ��Խӹ��ˣ�</center>";
exit();
}
//////-------------��֤�Խ�ƽ̨�Ƿ�����ƶ�
$total=mysql_num_rows(mysql_query("select * from `sup_members_site` where domain_name='$appuid' ",$conn2));
if ($total==0){
echo "<center><br><br><br><br>����ʧ�ܣ�APP UID�����ڣ�</center>";
exit();
}
//////-------------��֤�Ƿ�Խ��Լ�
if ($wrongs['domain_name']==$appuid){
echo "<center><br><br><br><br>����ʧ�ܣ��������ԶԽ�����ƽ̨��</center>";
exit();
}

//////-------------��֤�������Ƿ����
$total=mysql_num_rows(mysql_query("select * from `members` where number='$number' and DocApi1='$appkey' and power13=1 ",$conn3));
if ($total==0){
echo "<center><br><br><br><br>����ʧ�ܣ�APP KEY������11��</center>";
exit();
}
//////-------------��֤�������Ƿ���� The End

/////------������϶���ȷ���������

ysk_date_log(6,$_SESSION['ysk_username'],'������һ����ַΪ "'.$appuid.'" ƽ̨�Խӣ�');
mysql_query("insert into `docking_platform` set uid='$appuid',keykey='$appkey',mydatabase='$sup[mydatabase]',username='$number',begtime='$begtime' ",$conn1); 



echo "<br><br><br><br><center><input id='btnAll' type='button' value='�Խӳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}

////////�޸ļ�¼
If ($Action=="editsave") {
$Id=inject_check($_POST['Id']);
$appkey=strip_tags($_POST['appkey']);
$number=strip_tags($_POST['number']);
$result=mysql_query("select * from docking_platform where id='$Id' ",$conn1);
$row=mysql_fetch_array($result);

//----��ȡ�ƶ�����

$sup_result=mysql_query("select * from sup_members_site where domain_name='$row[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');

//////-------------��֤�Խ�ƽ̨�Ƿ�����ƶ�
$total=mysql_num_rows(mysql_query("select * from `sup_members_site` where domain_name='$row[uid]' ",$conn2));
if ($total==0){
echo "<script language=\"javascript\">alert('����ʧ�ܣ�APP UID�����ڣ�');history.go(-1);</script>";
exit();
}

//////-------------��֤�������Ƿ����
$total=mysql_num_rows(mysql_query("select * from `members` where number='$number' and DocApi1='$appkey' and power13=1 ",$conn3));
if ($total==0){
echo "<script language=\"javascript\">alert('����ʧ�ܣ�APP KEY������22��');history.go(-1);</script>";
exit();
}
//////-------------��֤�������Ƿ���� The End
if ($number!=$row['username']){
ysk_date_log(6,$_SESSION['ysk_username'],'����ַΪ "'.$row['uid'].'" ƽ̨�Խӱ���޸ĳ���'.$number);
}

if ($appkey!=$row['keykey']){
ysk_date_log(6,$_SESSION['ysk_username'],'����ַΪ "'.$row['uid'].'" ƽ̨�Խ�APP KEY�޸ĳ���'.$appkey);
}

mysql_query("update `docking_platform` set keykey='$appkey',username='$number' where id='$Id' ",$conn1); 
echo "<script>alert('�޸ĳɹ�!');;window.location='index.php';</script>";

}

////////ɾ������¼
If ($Action=="del") {
$Id=inject_check($_GET['Id']);
$sql=mysql_query("select * from docking_platform  where id ='$Id'",$conn1);
$row=mysql_fetch_array($sql);
ysk_date_log(6,$_SESSION['ysk_username'],'ɾ����һ����ַΪ "'.$row['uid'].'" ƽ̨�Խӣ�');

mysql_query("delete from docking_platform where id ='$Id'",$conn1);
mysql_query("delete from product where docking in($Id)",$conn1);
//ɾ����Ӧ��Ʒ

echo "<script>alert('ɾ���ɹ�!');window.location='?Action=List';</script>";
}

?>
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
</head>
<body>
<?php if($Action=="List" or $Action==""){?>

<div class="gn">
<input id="add" type="button" value="��ӶԽ�" class="tijiao_input" onclick="$.dialog.open('Docking/index.php?Action=add', {title: 'ƽ̨�Խ�', width:600, height:211,lock: true,fixed:true});" />
</div>


<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="18%" height="32" class="table_top">ƽ̨����</td>
<td width="11%" class="table_top">ƽ̨���</td>
<td width="14%" class="table_top">ƽ̨�ȼ�</td>
<td width="9%" class="table_top">ƽ̨�ʽ�</td>
<td width="22%" class="table_top"> APP KEY </td>
<td width="14%" class="table_top">�Խ�ʱ��</td>
<td width="6%" class="table_top">�޸�</td>
<td width="6%" class="table_top">ɾ��</td>
</tr>
<?php
$result=mysql_query("select * from  docking_platform   order by begtime desc,id desc ",$conn1);
while($row=mysql_fetch_array($result)){

$sup_result=mysql_query("select * from sup_members_site where domain_name='$row[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//**************************************************************��ȡ���ݿ�����
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
//**************************************************************��ȡ���ݿ�����

//**************************************************************��ȡ��Ա����
$yx_us_result=mysql_query("select * from members where number='$row[username]' ",$conn3);
$yx_us=mysql_fetch_array($yx_us_result);
//**************************************************************��ȡ��Ա���� The End

?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="32"><?=$row['uid']?></td>
<td><?=$row['username']?></td>
<td><?php
$levelresult=mysql_query("select * from level where id='$yx_us[level]'",$conn3);
$level=mysql_fetch_array($levelresult);
echo $level['title'];?></td>
<td><?=number_format($yx_us['kuan'],3)?> Ԫ</td>
<td><?=$row['keykey']?></td>
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td><a class="a edit" href="?Action=edit&Id=<?=$row['id']?>"></a> </td>
<td><a class="a delete" onclick="return confirm('ȷ��ɾ����');"  href="?Action=del&Id=<?=$row['id']?>"></a></td>
</tr>
<?php }?>
</table>
</div>
<?php }elseif($Action=="add"){  ?>
<form name="userinfo" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">APP UID��</td>
<td><input name="appuid" type="text" class="biankuan" style="width:350px;"></td>
</tr>
<tr>
<td  class="td_left">APP KEY ��</td>
<td><input name="appkey" type="text" class="biankuan" style="width:350px;" ></td>
</tr>
<tr>
<td  class="td_left">ƽ̨��ţ�</td>
<td><input name="number" type="text" class="biankuan" style="width:150px;"  ></td>
</tr>
<td>
</td>
<td>
<input type="submit" value="ȷ�����" class="tijiao_input" onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>

<?php }elseif($Action=="edit"){
$Id=inject_check($_GET['Id']);
$sql="select * from docking_platform where id='$Id'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">ƽ̨������</td>
<td><?=$row['uid']?></td>
</tr>
<tr>
<td  class="td_left">ƽ̨��� ��</td>
<td><input name="number" type="text" class="biankuan" style="width:150px;" value="<?=$row['username']?>" ></td>
</tr>
<tr>
<td  class="td_left">APP KEY��</td>
<td><input name="key" type="text" class="biankuan" style="width:350px;"  value="<?=$row['keykey']?>"></td>
</tr>

<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���޸�"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php } ?>
</body>
</Html>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo(){

if(checkspace(document.userinfo.appuid.value)) {
document.userinfo.appuid.focus();
alert("����ʧ�ܣ�APP UID ����Ϊ�գ�");
return false;
}

if(checkspace(document.userinfo.appkey.value)) {
document.userinfo.appkey.focus();
alert("����ʧ�ܣ�APP KEY ����Ϊ�գ�");
return false;
}

if(checkspace(document.userinfo.number.value)) {
document.userinfo.number.focus();
alert("����ʧ�ܣ�ƽ̨��Ų���Ϊ�գ�");
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