
<!DOCTYPE HTML>
<html>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/user_check.php');
include_once('../../jhs_config/error.php');
include_once('../../jhs_config/page_class.php');
$sid=$_REQUEST['sid'];
$StartYear=strip_tags($_GET['StartYear']);
$StartMonth=strip_tags($_GET['StartMonth']);
$StartDay=strip_tags($_GET['StartDay']);
$StartHour=strip_tags($_GET['StartHour']);
$StartMinute=strip_tags($_GET['StartMinute']);
$EndYear=strip_tags($_GET['EndYear']);
$EndMonth=strip_tags($_GET['EndMonth']);
$EndDay=strip_tags($_GET['EndDay']);
$EndHour=strip_tags($_GET['EndHour']);
$EndMinute=strip_tags($_GET['EndMinute']);
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
$keyword=strip_tags($_GET['keyword']);
$status=strip_tags($_GET['status']);
$template=strip_tags($_GET['template']);
$keywords=strip_tags($_GET['keywords']);
$type=strip_tags($_GET['type']);
$Action=strip_tags($_GET['Action']);
$search="where  username='$_SESSION[ysk_number]'  and sid=0 and pid=0  "; 
if ($keywords!='') $search.=" and $type like '%$keywords%' "; 
if ($template!='') $search.=" and modl='$template'"; 
if ($status!='')   $search.=" and state='$status'"; 
if ($_REQUEST['sid']!='')   $search.=" and directory3='$_REQUEST[sid]'"; 
if ($StartYear!='') $search.=" and time >=$muyou1 and time <=  $muyou2 "; 
##############�ö�
If ($Action=="move1"){
$id=$_REQUEST['id'];
inject_check($_REQUEST['id']); 
#######��ȡ�ʼID
$sql1="select * from product  $search order by paixu asc limit 1";   
$zyc1=mysql_query($sql1,$conn1);  
$row1=mysql_fetch_array($zyc1);
$godo=mysql_query("update product set paixu='$row1[paixu]' where id='$id'",$conn1); 
$godo=mysql_query("update product set paixu=paixu+1 where id<>'$id'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}
##############��β
If ($Action=="move4"){
$id=$_REQUEST['id'];
inject_check($_REQUEST['id']);   
#######��ȡ�ʼID
$sql1="select * from product  $search order by paixu desc limit 1";   
$zyc1=mysql_query($sql1,$conn1);  
$row1=mysql_fetch_array($zyc1);
$godo=mysql_query("update product set paixu='$row1[paixu]' where id='$id'",$conn1); 
$godo=mysql_query("update product set paixu=paixu-1 where id<>'$id'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}
##############����һ��
If ($Action=="move2"){
$paixu=$_REQUEST['paixu'];     //��ǰ����
$sql="select * from product  where `paixu` < '$paixu'  order by `paixu` desc limit 1 ";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
$num= mysql_num_rows($zyc);
if ($num!=0){
$godo=mysql_query("update product set paixu='$row[paixu]' where paixu='$paixu'",$conn1); 
$godo=mysql_query("update product set paixu='$paixu'      where id='$row[id]'",$conn1); 
}else{
echo "<script>alert('�Բ������һ�������ˣ�');;self.location=document.referrer;</script>";
exit();
}
echo "<script>self.location=document.referrer;</script>";
exit();
}
##############����һ��
If ($Action=="move3"){
$paixu=$_REQUEST['paixu'];     //��ǰ����
$sql="select * from product  where `paixu` > '$paixu'  order by `paixu` asc limit 1 ";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
$num= mysql_num_rows($zyc);
if ($num!=0){
$godo=mysql_query("update product set paixu='$row[paixu]' where paixu='$paixu'",$conn1); 
$godo=mysql_query("update product set paixu='$paixu'      where id='$row[id]'",$conn1); 
}else{
echo "<script>alert('�Բ������һ�������ˣ�');;self.location=document.referrer;</script>";
exit();
}
echo "<script>self.location=document.referrer;</script>";
exit();
}


if ($Action=='addsave'){

$ClassID=strip_tags($_POST['ClassID']);
$title=strip_tags($_POST['title']);
$color=strip_tags($_POST['color']);
$kucun=strip_tags($_POST['kucun']);
$price1=strip_tags($_POST['price1']);
$price2=strip_tags($_POST['price2']);
$pricing=strip_tags($_POST['pricing']);
$rate=strip_tags($_POST['rate']);
$modl=strip_tags($_POST['modl']);
$focus=strip_tags($_POST['focus']);
$punit=strip_tags($_POST['punit']);
$content=strip_tags($_POST['content']);
$service=strip_tags($_POST['service']);
$url=strip_tags($_POST['url']);
$overdue=strip_tags($_POST['overdue']);
$overday=strip_tags($_POST['overday']);
$province=strip_tags($_POST['province']);
$city=strip_tags($_POST['city']);
$password=strip_tags($_POST['password']);
$content1=strip_tags($_POST['content1']);
$buy_md=strip_tags($_POST['buy_md']);
$Store_class=strip_tags($_POST['Store_class']);

$allArray=(explode(',',$ClassID));

if ($overday==''){
$overday=$overdue;
}
if ($overday<0){
echo "<script>alert('�Բ��𣬱������޴���');;self.location=document.referrer;</script>";exit();
}
get_check_price($_POST['price2']);
get_check_price($_POST['price2']);

if ($ClassID==''){echo "<script>alert('�Բ�����û��ѡ�񷢲�����Ŀ��');;self.location=document.referrer;</script>";exit();}

foreach($allArray as $value){ 
$directory1=substr($value,0,4);
$directory2=substr($value,0,7);

if ($directory1==''){
echo "<script>alert('����ʧ�ܣ�ϵͳδ֪���������������û������ʲô��');;self.location=document.referrer;</script>";
exit();
}

if ($directory2==''){
echo "<script>alert('����ʧ�ܣ�ϵͳδ֪���������������û������ʲô��');;self.location=document.referrer;</script>";
exit();
}

if ($modl=='�˹�����' && $buy_md==''){
echo "<script>alert('����ʧ�ܣ�û��ѡ���ֵģ��ѽ��');;self.location=document.referrer;</script>";
exit();
}



mysql_query("insert into product set pricing='$pricing',rate='$rate',Store_class='$Store_class',kucun='$kucun',overdue='$overday',title='$title',color='$color',directory1='$directory1',directory2='$directory2',directory3='$value',directory4='$value',punit='$punit',modl='$modl',buy_md='$buy_md',price='$price2',price1='$price1',price2='$price2',url='$url',content='$content',focus='$focus',service='$service',username='$_SESSION[ysk_number]',time='$begtime',provinces='$province',citys='$city'",$conn1);
$myid=mysql_insert_id($conn1);
mysql_query("update product set paixu='$myid' where id='$myid'",$conn1); 
//-----------------------------------------------------------------------------------------------------------------------------���뿨�� ���� ѡ��
if      ($modl=='����'){
mysql_query("insert into cloud_key set pid='$myid',password='$password',begtime='$begtime'",$conn1);
}elseif ($modl=='����' || $modl=='ѡ��'){
if ($content1){
$allArray=(explode("\n", $content1));
foreach($allArray as $value){
$allArray1=(explode(' ',$value));
$card=trim($allArray1[0]);
$password=trim($allArray1[1]);
mysql_query("insert into import_goods set pid='$myid',locks=0,card='$card',password='$password',time='$begtime'",$conn1);
}
}
}
//-------------------------------------------------------------------------------------------------------------------���뿨�� ���� ѡ�� The End
}

echo "<script>alert('��ӳɹ�!');window.location='?Action=add';</script>";
exit();
}


if ($Action=='editsave'){
$Id=inject_check($_POST['Id']);
$ClassID=strip_tags($_POST['ClassID']);
$ytitle=strip_tags($_POST['ytitle']);
$title=strip_tags($_POST['title']);
$color=strip_tags($_POST['color']);
$kucun=strip_tags($_POST['kucun']);
$price1=strip_tags($_POST['price1']);
$price2=strip_tags($_POST['price2']);
$pricing=strip_tags($_POST['pricing']);
$rate=strip_tags($_POST['rate']);
$modl=strip_tags($_POST['modl']);
$focus=strip_tags($_POST['focus']);
$punit=strip_tags($_POST['punit']);
$content=strip_tags($_POST['content']);
$service=strip_tags($_POST['service']);
$url=strip_tags($_POST['url']);
$password=strip_tags($_POST['password']);
$content1=strip_tags($_POST['content1']);
$buy_md=strip_tags($_POST['buy_md']);
$Store_class=strip_tags($_POST['Store_class']);
$directory1=substr($ClassID,0,4);
$directory2=substr($ClassID,0,7);

if ($directory1==''){
echo "<script>alert('����ʧ�ܣ�ϵͳδ֪���������������û������ʲô��');;self.location=document.referrer;</script>";
exit();
}

if ($directory2==''){
echo "<script>alert('����ʧ�ܣ�ϵͳδ֪���������������û������ʲô��');;self.location=document.referrer;</script>";
exit();
}
//---------�ж��Ƿ��и�����Ʒ��������з�վ���Ÿ��û�  locks ״̬Ϊ0 ���޸�
if ($title<>$ytitle){
mysql_query("insert into Goods_change set title='$title',uid='$Id',locks='0'",$conn1);
}
//---------�жϽ���

if ($modl=='�˹�����' && $buy_md==''){
echo "<script>alert('����ʧ�ܣ�û��ѡ���ֵģ��ѽ��');;self.location=document.referrer;</script>";
exit();
}



mysql_query("update product set pricing='$pricing',rate='$rate',kucun='$kucun',title='$title',color='$color',directory1='$directory1',directory2='$directory2',directory3='$ClassID',directory4='$ClassID',punit='$punit',buy_md='$buy_md',price='$price2',price1='$price1',price2='$price2',url='$url',content='$content',focus='$focus',service='$service',time='$begtime',Store_class='$Store_class',locks='0' where id='$Id' and  username='$_SESSION[ysk_number]' and sid=0 and pid=0",$conn1);

//-----------------------------------------------------------------------------------------------------------------------------���뿨�� ���� ѡ��
if      ($modl=='����'){
inject_check($_POST['Id']);
mysql_query("update cloud_key set password='$password'  where pid='$_POST[Id]' and  username='$_SESSION[ysk_number]'",$conn1);
}elseif ($modl=='����' || $modl=='ѡ��'){
if ($content1){
$allArray=(explode("\n", $content1));
foreach($allArray as $value){
$allArray1=(explode(' ',$value));
$card=trim($allArray1[0]);
$password=trim($allArray1[1]);
mysql_query("insert into import_goods set pid='$_POST[Id]',locks=0,card='$card',password='$password',time='$begtime'",$conn1);
}
}

}
//-------------------------------------------------------------------------------------------------------------------���뿨�� ���� ѡ�� The End


echo "<script>alert('�޸ĳɹ�!');window.location='index.php';</script>";
exit();
}

////////ɾ������¼
if ($Action=="del"){
$Id=inject_check($_GET['Id']);
//---------������Ʒ������¼ �Ա㷢��վ����
mysql_query("insert into Goods_change set uid='$Id',locks=1",$conn1);
//---------�жϽ���
	

mysql_query("delete from product where id ='$Id' and  username='$_SESSION[ysk_number]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');self.location=document.referrer;</script>";
}

if ($Action=='mylove'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));

if ($_REQUEST['Del']=='ɾ��'){
foreach($allArray as $value){
//---------������Ʒ������¼ �Ա㷢��վ����
mysql_query("insert into Goods_change set uid='$value',locks=1",$conn1);
//---------�жϽ���

mysql_query("delete from product where username='$_SESSION[ysk_number]' and id='$value'",$conn1);
}
echo "<script>alert('ɾ���ɹ�!');self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='����'){
foreach($allArray as $value){
mysql_query("update product set state='0',reason='' where id='$value'",$conn1);
}
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
}


if ($_REQUEST['Del']=='�¼�'){
foreach($allArray as $value){
mysql_query("update product set state='4',reason='' where id='$value'",$conn1);
}
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
}

###��Ʒ��ͣ
if ($_REQUEST['Del']=='��ͣ'){
$_SESSION['yDel']='��ͣ';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}

###��Ʒ�������۸�
if ($_REQUEST['Del']=='��������'){
$_SESSION['yDel']='��������';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}


}


?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="/Public/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="/Public/js/city.js"></script>
<script type="text/javascript" src="/Public/js/jquery.bigcolorpicker.js"></script>
<script language="javascript">
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

function chg(obj)
{
if(obj.options[obj.selectedIndex].value =="-1")
document.getElementById("overday").style.display="";
else
document.getElementById("overday").style.display="none";
}

$(function(){
$("#bn").bigColorpicker("f3");
$("#f333").bigColorpicker("f3","L",6);
});

</script>
<?php      if($_SESSION['yDel']=='��ͣ'){?>
<script language="javascript">
$(window).load(function(){
art.dialog.open('product/deal_with.php?Action=stop&isno=<?=$_SESSION['allArray']?>',{lock:true,fixed:true,title:'��ͣ',width:600,height:180});
});
</script>
<?php }elseif($_SESSION['yDel']=='��������'){?>
<script language="javascript">
$(window).load(function(){
art.dialog.open('product/deal_with.php?Action=pricing&isno=<?=$_SESSION['allArray']?>',{lock:true,fixed:true,title:'��������',width:600,height:180});
});
</script>
<?php } ?>
</head>
<body onload = "MyTest()">
<?php if ($Action==""){?>


<div class="right">

<form action="index.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
�ؼ������룺            </td>
<td class="left">
<input name="keywords" type="text" maxlength="300" id="keywords"  class="biankuan" placeholder="�����������ؼ���">
</td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯ������            </td>
<td class="left">
<select name="type" id="type">
<option selected="selected" value="title">��Ʒ����</option>
<option value="id">��Ʒ���</option>
<option value="price">��Ʒ��ֵ</option>
</select>
<select name="template" id="template">
<option selected="selected" value="">ȫ������</option>
<option value="����">����</option>
<option value="����">����</option>
<option value="ѡ��">ѡ��</option>
<option value="�˹�����">�˹�����</option>
</select>
<select name="status" id="status">
<option selected="selected" value="">ȫ��״̬</option>
<option value="0">����</option>
<option value="1">��ͣ</option>
<option value="2">����</option>
</select></td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯʱ��Σ�</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="btnQuery" value="ȷ�ϲ�ѯ" id="btnQuery" class="chaxun_input" />
<input name="button" type="button" class="tijiao_input" onClick="javascript:location.href='?Action=add';" value="�����Ʒ" />
</td>
</tr>
</table>
</form>

<form name="form1" method="post" action="?Action=mylove">
<table cellspacing="1" cellpadding="0" class="table1" style=" margin-top:10px;">
<tr>
<td width="4%" height="32" align="center" class="table_top">ѡ��</td>
<td width="4%" align="center" class="table_top">���</td>
<td width="38%" align="center" class="table_top">��Ʒ����</td>
<td width="8%" align="center" class="table_top"> ����/ģ�� </td>
<td width="6%" align="center" class="table_top"> ��ֵ </td>
<td width="7%" align="center" class="table_top">״̬</td>
<td width="9%" align="center" class="table_top">����</td>
<td hidden width="13%" align="center" class="table_top">����ʱ��</td>
<td width="7%" align="center" class="table_top">����</td>
</tr>
<?php

$total=mysql_num_rows(mysql_query("SELECT * FROM `product`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from product  $search order by paixu asc,id desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
#######��ȡ�ʼID
#######��ȡ�ʼID
$result1=mysql_query("select * from product  $search order by paixu asc limit 1",$conn1);
$row1=mysql_fetch_array($result1);
#######��ȡ���ID
$result2=mysql_query("select * from product  $search order by paixu desc limit 1",$conn1);
$row2=mysql_fetch_array($result2);

while ($row=mysql_fetch_array($zyc)){
?>

<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td align="center"><?=$row['id']?></td>
<td align="left" style=" text-align:left;"><?=ysk_locks($row['locks'],$row['whys'])?>
<?=$row['title']?></td>
<td align="center" style="color:#0000ff">
<?php if ($row['modl']=='����' || $row['modl']=='ѡ��'){?>
<a href="import.php?id=<?=$row['id']?>"><?=$row['modl']?>(����)</a>
<?php }else{?>
<?=$row['modl']?>
<?php }?>
</td>
<td align="center"><?=$row['price1']?></td>
<td align="center"><?=ysk_state($row['state'])?></td>
<td align="center">
<div class="dirction">
<?php if ($row1['id']==$row['id']) {?>
<a  title="�ƶ������" class="move top1"></a>
<?php }else{?>
<a href="?Action=move1&id=<?=$row['id']?>" title="�ƶ������" class="move top"></a>
<?php } ?>
<?php if ($row1['id']==$row['id']) {?>
<a  title="������һ��"   class="move up1"></a>
<?php }else{?>
<a href="?Action=move2&paixu=<?=$row['paixu']?>" title="������һ��"   class="move up"></a>
<?php } ?>

<?php if ($row2['id']==$row['id']) {?>
<a  title="������һ��"   class="move down1"></a>
<?php }else{?>
<a href="?Action=move3&paixu=<?=$row['paixu']?>" title="������һ��"   class="move down"></a>
<?php } ?>

<?php if ($row2['id']==$row['id']) {?>
<a   title="�ƶ�����ײ�" class="move bottom1"></a>
<?php }else{?>
<a href="?Action=move4&id=<?=$row['id']?>" title="�ƶ�����ײ�" class="move bottom"></a>
<?php } ?>
</div></td>
<td hidden align="center"><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td align="center"><a href="?Action=edit&Id=<?=$row[id]?>">�޸�</a> <a href="?Action=del&Id=<?=$row['id']?>" onClick="Javascript:return confirm('ȷ��Ҫɾ����');">ɾ��</a> </td>
</tr><?php
}
?>

</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td  align="left" style="padding-top:15px; padding-bottom:15px;">

<input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="ɾ��" class="x3_input" onClick="Javascript:return confirm('ȷ��Ҫɾ����');" >
<input type="submit" name="Del" id="Del" value="����"  onclick="return CheckSelect();" class="x2_input">
<input type="submit" name="Del" id="Del" value="��ͣ"  onclick="return CheckSelect();" class="x3_input">
<input type="submit" name="Del" id="Del" value="�¼�"  onclick="return CheckSelect();" class="x3_input">
<input type="submit" name="Del" id="Del" value="��������"  onclick="return CheckSelect();" class="x4_input">
</td>
<td  align="left" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?></td>
</tr>
</table>
</form>
</div>

<?php }elseif($Action=="add"){  ?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.add.title.value)) {
document.add.title.focus();
alert("����ʧ�ܣ���Ʒ���Ʋ���Ϊ�գ�");
return false;
}   

if(checkspace(document.add.kucun.value)) {
document.add.kucun.focus();
alert("����ʧ�ܣ���治��Ϊ�գ�");
return false;
}

if(checkspace(document.add.punit.value)) {
document.add.punit.focus();
alert("����ʧ�ܣ���Ʒ��λ����Ϊ�գ�");
return false;
}

if(checkspace(document.add.price1.value)) {
document.add.price1.focus();
alert("����ʧ�ܣ���Ʒ��ֵ����Ϊ�գ�");
return false;
}


if(checkspace(document.add.price2.value)) {
document.add.price2.focus();
alert("����ʧ�ܣ������۸���Ϊ�գ�");
return false;
}

if(checkspace(document.add.rate.value)) {
document.add.rate.focus();
alert("����ʧ�ܣ��ۼ۲���Ϊ�գ�");
return false;
}

if(checkspace(document.add.modl.value)) {
document.add.modl.focus();
alert("����ʧ�ܣ���ֵģ�治��Ϊ�գ�");
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
<form name="add" method="post" action="?Action=add1" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��Ϣ���</td>
</tr>
<tr>
<td class="td_left">�������ޣ�</td>
<td class="left"><div style="float:left;"><select  name="overdue" id="overdue" onChange="chg(this)">
<option value="7">7��</option>
<option value="15">15��</option>
<option value="26">26��</option>
<option value="30">30��</option>
<option value="45">45��</option>
<option value="60">60��</option>
<option value="0" selected="selected">����</option>
<option value="-1">����</option>
</select>
</div><div id="overday" style="float:left; padding-left:10px;display:none">
<input id="overday" name="overday" style="width:30px;" value=""   onkeyup="value=value.replace(/[^\d]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" > ��</div> �����磺QQ��Աһ���£�����Ʒʱ��Ϊ��30�죩
</td>
</tr>


<tr>
<td width="10%" class="td_left"> ��Ʒ���ƣ�</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="" class="biankuan" /> <input name="color" type="text" id="f3" value="" size="7" class="biankuan" /> 
<input id="bn" type="button" value="ѡɫ" class="tijiao_input"/></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��������</td>
<td width="90%" class="left" style="color:#999999">
<select id="province" name="province" onchange = "test()">
<option value="ȫ��" selected="selected">--ȫ������--</option>
</select>
&nbsp;
<select id="city" name="city">
<option value="" selected="selected">--����--</option>
</select>
ȷ���󲻿��޸ģ���ע��ѡ�� </td>
</tr>
<tr>
<td width="10%" class="td_left"> ��Ʒ��棺</td>
<td width="90%" class="left"><input name="kucun" type="text" style="width:60px;"class="biankuan"  onkeyup="clearNoNum(this)"/></td>
</tr>

<tr>
<td width="10%" class="td_left"> ��Ʒ��λ��</td>
<td width="90%" class="left"><input name="punit" type="text" class="biankuan" id="punit" style="width:60px;" value="" /></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��Ʒ��ֵ��</td>
<td width="90%" class="left"><input name="price1" type="text" style="width:60px;"  class="biankuan"  onkeyup="clearNoNum(this)"/></td>
</tr>
<tr>
<td width="10%" class="td_left">�����۸�</td>
<td width="90%" class="left" style="color:#666"><input name="price2" type="text" style="width:60px;"  onkeyup="clearNoNum(this)"/> <select name="pricing" id="pricing">
<option value="1">�����Ӱٷֱ�</option>
<option value="2">�����ӹ̶�ֵ</option>
</select>
<input name="rate" type="text" style="width:60px;" onKeyUp="clearNoNum(this)"/>  
<div style="padding-top:6px;">
��������۸�100 ���ٷֱ����� ����д�� 1��ʱ�� ����1% Ҳ����ÿ������1<?=$moneytype?>��
�����������100 ���̶�ֵ���� ����д1��ʱ�����1<?=$moneytype?>��Ҳ����ÿ������1<?=$moneytype?>��</div>
</td>
</tr>
<tr>
<td width="10%" class="td_left"> ��ֵ���ͣ�</td>
<td width="90%" class="left">
<select name="modl" id="modl">
<option value="" selected>��ѡ�����...</option>
<option value="����">����</option>
<option value="����">����</option>
<option value="ѡ��">ѡ��</option>
<option value="�˹�����">�˹�����</option>
</select></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��Ʒ���ࣺ</td>
<td width="90%" class="left">
<select name="Store_class" id="Store_class">
<option value="" selected>Ĭ�Ϸ���</option>
<?php
$sresult=mysql_query("select * from Store_class where username='$_SESSION[ysk_number]' ",$conn1);
while($srow=mysql_fetch_array($sresult)){?>
<option value="<?=$srow['id']?>"><?=$srow['title']?></option>
<?php } ?>
</select></td>
</tr>
<tr>
<td width="10%" class="td_left">���̷��ࣺ</td>
<td width="90%" class="left">
<div style="width: 350px; height: 120px; overflow: auto; border:1px #000000 solid; padding:4px;">
<?php 
$result=mysql_query("select * from product_class where number='$_SESSION[ysk_number]' and LagID=2  order by id desc",$conn1);
while($row=mysql_fetch_array($result)){?>
<input name="ClassID[]" type="checkbox" value="<?=$row['NumberID']?>"> <?=$row['7']?><br />
<?php }  ?>
</div>
</td>
</tr>


<tr>

<td class="td_left">
��Ʒ��飺</td>
<td class="left">
<textarea name="content" rows="2" cols="20" id="content" class="biankuan" style="width: 350px; height: 100px"  placeholder="��Ʒ��ϸ����"></textarea></td>
</tr>
<tr>
<td class="td_left">
ע�����</td>
<td class="left">
<textarea name="focus" rows="2" cols="20" id="focus" class="biankuan" style="width: 350px; height: 100px" placeholder="�ͻ�����ʱ����ڵ�һ����ʾ���ɲ��"></textarea>          </td>
</tr>
<tr>
<td width="10%" class="td_left"> ��ֵ��ַ��</td>
<td width="90%" class="left"><input name="url" type="text" style="width:350px;" value="" class="biankuan"  placeholder="�俨����ַ���ǿ�������Ʒ�ɲ���" /> </td>
</tr>
<tr>
<td width="10%" class="td_left"> �ͷ�QQ��</td>
<td width="90%" class="left"  style="color:#666"><input name="service" type="text" style="width:350px;" value="" class="biankuan"  placeholder="������QQ����" /> ����м���|����</td>
</tr>

<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�����"  id="btnSubmit" class="tijiao_input"   onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="add1"){
$modl=$_POST['modl'];
$ClassID=implode(",",$_POST['ClassID']);
if ($_POST['ClassID']==''){echo "<script>alert('�Բ�����û��ѡ�񷢲�����Ŀ��');self.location=document.referrer;</script>";exit();}

if ($sup_rules_module=='1'){
if ($nlegal_open=='0') {
if(preg_match("/$nlegal_m_3/i",$_REQUEST['title'])){
mysql_query("insert into  `punishment_list`  set title='�ϴ���Ʒ�������д���',number='$_SESSION[ysk_number]',deduct='$nlegal_m_7',begtime='$begtime'",$conn1); 
mysql_query("update `members`  set bad_grades=bad_grades+$nlegal_m_7 where number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('�Բ������ݺ��к��������ַ������������۵� $nlegal_m_7 �֣�');self.location=document.referrer;</script>";
exit();
}
}
}
?>

<form name="add" method="post" action="?Action=addsave" >
<input name="overdue" type="hidden" value="<?=$_POST['overdue']?>">
<input name="overday" type="hidden" value="<?=$_POST['overday']?>">
<input name="title" type="hidden" value="<?=$_POST['title']?>">
<input name="color" type="hidden" value="<?=$_POST['color']?>">
<input name="province" type="hidden" value="<?=$_POST['province']?>">
<input name="city" type="hidden" value="<?=$_POST['city']?>">
<input name="kucun" type="hidden" value="<?=$_POST['kucun']?>">
<input name="punit" type="hidden" value="<?=$_POST['punit']?>">
<input name="price1" type="hidden" value="<?=$_POST['price1']?>">
<input name="price2" type="hidden" value="<?=$_POST['price2']?>">
<input name="pricing" type="hidden" value="<?=$_POST['pricing']?>">
<input name="rate" type="hidden" value="<?=$_POST['rate']?>">
<input name="modl" type="hidden" value="<?=$_POST['modl']?>">
<input name="ClassID" type="hidden" value="<?=$ClassID?>">
<input name="content" type="hidden" value="<?=$_POST['content']?>">
<input name="focus" type="hidden" value="<?=$_POST['focus']?>">
<input name="url" type="hidden" value="<?=$_POST['url']?>">
<input name="service" type="hidden" value="<?=$_POST['service']?>">
<input name="Store_class" type="hidden" value="<?=$_POST['Store_class']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��ֵģ��</td>
</tr>
<?php if ($modl=='����'){?>
<tr>
<td width="10%" class="td_left">�������룺</td>
<td width="90%" class="left"><input name="password" type="text" style="width:350px;" value="" class="biankuan" /></td>
</tr>
<?php }elseif ($modl=='����'){?>
<tr>
<td width="10%" class="td_left">���뿨�ܣ�</td>
<td width="90%" class="left"><textarea name="content1" cols="70" rows="6" class="biankuan" id="content1"></textarea>
��ʽΪ �˻� ����<font color="#FF0000">��ע���˻������м��и��ո�</font> һ��һ��</td>
</tr>
<?php }elseif ($modl=='ѡ��'){?>
<tr>
<td width="10%" class="td_left">���뿨�ţ�</td>
<td width="90%" class="left"><textarea name="content1" cols="70" rows="6" class="biankuan" id="content1"></textarea>
��ʽΪ �˻� ����<font color="#FF0000">��ע���˻������и��ո�</font> һ��һ��</td>
</tr>
<?php }elseif ($modl=='�˹�����'){?>
<tr>
<td width="10%" class="td_left">��ֵģ�壺</td>
<td width="90%" class="left"><select name="buy_md" id="buy_md">
<?php
$resultm=mysql_query("select * from  buy_modl  order by time desc,id desc  ",$conn1);
while($modl=mysql_fetch_array($resultm)){ ?>
<option value="<?=$modl['id']?>"><?=$modl['title']?></option>
<?php } ?>
</select></td>
</tr>
<?php }?>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input"   onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="edit"){
$Id=inject_check($_GET['Id']);
$result=mysql_query("select * from product  where  username='$_SESSION[ysk_number]'and id='$Id' and sid=0 and pid=0 ",$conn1);
$row=mysql_fetch_array($result);
############################################################��ȫ��֤
if ($row['id']==''){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ�û���ҵ�����Ʒ!";
exit();
}
############################################################��ȫ��֤ The End
?>
<div class="right">
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.add.title.value)) {
document.add.title.focus();
alert("�Բ�����Ʒ���Ʋ���Ϊ�գ�");
return false;
}   

if(checkspace(document.add.kucun.value)) {
document.add.kucun.focus();
alert("�Բ��𣬿�治��Ϊ�գ�");
return false;
}

if(checkspace(document.add.punit.value)) {
document.add.punit.focus();
alert("�Բ�����Ʒ��λ����Ϊ�գ�");
return false;
}

if(checkspace(document.add.price1.value)) {
document.add.price1.focus();
alert("�Բ�����Ʒ��ֵ����Ϊ�գ�");
return false;
}


if(checkspace(document.add.price2.value)) {
document.add.price2.focus();
alert("�Բ�����Ʒ�ۼ۲���Ϊ�գ�");
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
<form name="add" method="post" action="?Action=edit_next" >
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input id="ytitle" name="ytitle" type="hidden" value="<?=$row['title']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��Ϣ�޸�</td>
</tr>
<tr>
<td class="td_left">�������ޣ�</td>
<td class="left"><?=ysk_overdue($row['overdue'])?>
</td>
</tr>


<tr>
<td width="10%" class="td_left"> ��Ʒ���ƣ�</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="<?=$row['title']?>" class="biankuan" /> 
<input name="color" type="text" id="f3" value="<?=$row['color']?>" size="7" class="biankuan" /> 
<input id="bn" type="button" value="ѡɫ" class="tijiao_input"/></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��������</td>
<td width="90%" class="left" style="color:#999999">
<?php
$yx_area=new area();  
echo $yx_area->region($row['provinces'],$row['citys'])?></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��Ʒ��棺</td>
<td width="90%" class="left"><input name="kucun" type="text" style="width:60px;"class="biankuan"  onkeyup="clearNoNum(this)" value="<?=$row['kucun']?>" /></td>
</tr>

<tr>
<td width="10%" class="td_left"> ��Ʒ��λ��</td>
<td width="90%" class="left"><input name="punit" type="text" class="biankuan" id="punit" style="width:60px;" value="<?=$row['punit']?>" /></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��Ʒ��ֵ��</td>
<td width="90%" class="left"><input name="price1" type="text" style="width:60px;" value="<?=$row['price1']?>" class="biankuan" onKeyUp="clearNoNum(this)"/></td>
</tr>
<tr>
<td width="10%" class="td_left">�����۸�</td>
<td width="90%" class="left" style="color:#666"><input name="price2" type="text" style="width:60px;"  value="<?=$row['price2']?>" onKeyUp="clearNoNum(this)"/> <select name="pricing" id="pricing">
<option value="1" <?php if ($row['pricing']==1) {?> selected<?php } ?>>�����Ӱٷֱ�</option>
<option value="2" <?php if ($row['pricing']==2) {?> selected<?php } ?>>�����ӹ̶�ֵ</option>
</select>
<input name="rate" type="text" style="width:60px;" onKeyUp="clearNoNum(this)" value="<?=$row['rate']?>"/>  
<div style="padding-top:6px;">
��������۸�100 ���ٷֱ����� ����д�� 1��ʱ�� ����1% Ҳ����ÿ������1<?=$moneytype?>��
�����������100 ���̶�ֵ���� ����д1��ʱ�����1<?=$moneytype?>��Ҳ����ÿ������1<?=$moneytype?>��</div>
</td>
</tr>
<tr>
<td width="10%" class="td_left"> ��Ʒ���ࣺ</td>
<td width="90%" class="left">
<select name="Store_class" id="Store_class">
<?php
$sresult=mysql_query("select * from Store_class where username='$_SESSION[ysk_number]' ",$conn1);
while($srow=mysql_fetch_array($sresult)){?>
<option value="<?=$srow['id']?>"  <?php if($srow['id']==$row['Store_class']){ ?> selected="selected"<?php }?>><?=$srow['title']?></option>
<?php } ?>
</select></td>
</tr>
<tr>
<td width="10%" class="td_left">���̷��ࣺ</td>
<td width="90%" class="left"><select name="ClassID" id="ClassID">
<?php 
$results=mysql_query("select * from product_class where number='$_SESSION[ysk_number]' and LagID=2 order by id desc",$conn1);
while($type=mysql_fetch_array($results)){?>
<option value="<?=$type['NumberID']?>" <?php if($type['NumberID']==$row['directory3']){ ?> selected="selected"<?php }?>><?=$type['7']?></option>
<?php } ?>
</select>


</td>
</tr>
<tr>
<td width="10%" class="td_left"> ��ֵ���ͣ�</td>
<td width="90%" class="left"><?=$row['modl']?></td>
</tr>
<tr>
<td class="td_left">
��Ʒ��飺</td>
<td class="left">
<textarea name="content" rows="2" cols="20" id="content" class="biankuan" style="width: 350px; height: 100px"  placeholder="��Ʒ��ϸ����">
<?=$row['content']?>
</textarea></td>
</tr>
<tr>
<td class="td_left">
ע�����</td>
<td class="left">
<textarea name="focus" rows="2" cols="20" id="focus" class="biankuan" style="width: 350px; height: 100px" placeholder="�ͻ�����ʱ����ڵ�һ����ʾ���ɲ��"><?=$row['focus']?></textarea>          </td>
</tr>
<tr>
<td width="10%" class="td_left"> ��ֵ��ַ��</td>
<td width="90%" class="left"><input name="url" type="text" style="width:350px;" value="<?=$row['url']?>" class="biankuan"  placeholder="�俨����ַ���ǿ�������Ʒ�ɲ���" /> </td>
</tr>
<tr>
<td width="10%" class="td_left"> �ͷ�QQ��</td>
<td width="90%" class="left"  style="color:#666"><input name="service" type="text" style="width:350px;" value="<?=$row['service']?>" class="biankuan"  placeholder="������QQ����" /> ����м���|����</td>
</tr>


<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���޸�"  id="btnSubmit" class="tijiao_input"   onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
</div>

<?php }elseif($Action=="edit_next"){
if ($_REQUEST['Id']){
$_SESSION['lid']=$_REQUEST['Id'];
}
$result=mysql_query("select * from product where id='$_SESSION[lid]'",$conn1);
$row=mysql_fetch_array($result);
?>

<form name="add" method="post" action="?Action=editsave">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input name="ytitle" type="hidden" value="<?=$_POST['ytitle']?>">
<input name="title" type="hidden" value="<?=$_POST['title']?>">
<input name="color" type="hidden" value="<?=$_POST['color']?>">
<input name="kucun" type="hidden" value="<?=$_POST['kucun']?>">
<input name="punit" type="hidden" value="<?=$_POST['punit']?>">
<input name="price1" type="hidden" value="<?=$_POST['price1']?>">
<input name="price2" type="hidden" value="<?=$_POST['price2']?>">
<input name="pricing" type="hidden" value="<?=$_POST['pricing']?>">
<input name="rate" type="hidden" value="<?=$_POST['rate']?>">
<input name="modl" type="hidden" value="<?=$row['modl']?>">
<input name="Store_class" type="hidden" value="<?=$_POST['Store_class']?>">
<input name="ClassID" type="hidden" value="<?=$_POST['ClassID']?>">
<input name="content" type="hidden" value="<?=$_POST['content']?>">
<input name="focus" type="hidden" value="<?=$_POST['focus']?>">
<input name="url" type="hidden" value="<?=$_POST['url']?>">
<input name="service" type="hidden" value="<?=$_POST['service']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��ֵģ��</td>
</tr>
<?php if($row['modl']=='����' || $row['modl']=='ѡ��'){?>
<tr>
<td width="10%" class="td_left"><?=$row['modl']?>�鿴��</td>
<td width="90%" class="left">
<a href="#art1" onClick="art.dialog.open('/Username/Product/view.php?id=<?=$row['id']?>',{title:'<?=$row['modl']?>��ϸ��Ϣ',width:600,height:400,lock:true, fixed:true});">�鿴</a></td>
</tr>
<?php } ?>
<?php if ($row['modl']=='����'){
$k_result=mysql_query("select * from cloud_key  where  pid='$row[id]' ",$conn1);
$yx_k=mysql_fetch_array($k_result)
?>
<tr>
<td width="10%" class="td_left">�������룺</td>
<td width="90%" class="left"><input name="password" type="text" style="width:350px;" value="<?=$yx_k['password']?>" class="biankuan" /></td>
</tr>


<?php }elseif($row['modl']=='����'){?>
<tr>
<td width="10%" class="td_left">���뿨�ܣ�</td>
<td width="90%" class="left"><textarea name="content1" cols="70" rows="6" class="biankuan" id="content1"></textarea>
��ʽΪ �˻� ����<font color="#FF0000">��ע���˻������и��ո�</font> һ��һ��</td>
</tr>
<?php }elseif($row['modl']=='ѡ��'){?>
<tr>
<td width="10%" class="td_left">���뿨�ţ�</td>
<td width="90%" class="left"><textarea name="content1" cols="70" rows="6" class="biankuan" id="content1"></textarea>
��ʽΪ �˻� ����<font color="#FF0000">��ע���˻������и��ո�</font> һ��һ��</td>
</tr>
<?php }else{?>
<tr>
<td width="10%" class="td_left">��ֵģ�壺</td>
<td width="90%" class="left"><select name="buy_md" id="buy_md">
<?php
$resultm=mysql_query("select * from  buy_modl  order by time desc,id desc  ",$conn1);
while($modl=mysql_fetch_array($resultm)){ ?>
<option value="<?=$modl['id']?>" <?php if ($row['buy_md']==$modl['id']){?> selected<?php } ?>><?=$modl['title']?></option>
<?php } ?>
</select></td>
</tr>
<?php }?>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input"   onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
<?php }?>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
<script>
function CheckAll(value,obj)  {
var form=document.getElementsByTagName("form")
for(var i=0;i<form.length;i++){
for (var j=0;j<form[i].elements.length;j++){
if(form[i].elements[j].type=="checkbox"){ 
var e = form[i].elements[j]; 
if (value=="selectAll"){e.checked=obj.checked}     
else{e.checked=!e.checked;} 
}
}
}
}
</script>