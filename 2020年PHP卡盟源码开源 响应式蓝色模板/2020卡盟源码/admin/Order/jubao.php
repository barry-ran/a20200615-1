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
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=strip_tags($_GET['Action']);
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
$keywords=strip_tags($_GET['keywords']);
$seey=strip_tags($_GET['seey']);
if ($_REQUEST['Del']=='ɾ��'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from goods_report where id in ($ID_Dele)",$conn1);
echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
exit();
}

?>
<script type="text/javascript"> 
function Permissions(obj){
var radioss= obj.value;
window.self.document.getElementById("text").value=radioss;
} 
</script> 
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
<div class="Menubox" >
<ul>
<li<?php if ($yy==''or $yy=='1'){?> class="hover"<?php } ?>>
<a href="jubao.php?yy=1">��Ʒ�ٱ� (<?=mysql_num_rows(mysql_query("select * from `goods_report` where  online=0",$conn1));?>)</a></li>
</ul>
</div>
<div style="padding:10px 0px;">
<form action="jubao.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">

<tr>
<td height="32" class="td_left">
�����ؼ��ʣ�</td>
<td class="left">
<input name="keywords" type="text" maxlength="20" id="keywords" /> <select name="seey" id="seey">
<option value="number" selected="selected">�ͻ����</option>
<option value="username">�����̱��</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯ������</td>
<td class="left">
<select name="state" id="state">
<option selected="selected" value="">ȫ��</option>
<option value="�����Ʒ">�����Ʒ</option>
<option value="������Ʒ">������Ʒ</option>
<option value="Υ����Ʒ">Υ����Ʒ</option>
</select>
</td>
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
</td>
</tr>
</table>
</form>
<form name="form1" method="post" action="?Action=mylove">

<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="3%" height="32" class="table_top">ѡ��</td>
<td width="37%" class="table_top">��Ʒ</td>
<td width="12%" class="table_top">�ٱ�����</td>
<td width="10%" class="table_top">��Ա���</td>
<td width="13%" class="table_top">�̼ұ��</td>
<td width="14%" class="table_top">�ύʱ�� </td>
<td width="11%" class="table_top">״̬��ϸ</td>
</tr>
<?php
$search="where 1=1 "; 
if ($StartYear!='' ) $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
if ($keywords!='') $search.=" and $seey like '%$keywords%' "; 
if ($state!='')    $search.=" and type = '$state' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `goods_report`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from goods_report  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
$sql1="select * from product where id='$row[proid]'";   //��ȡ���ݱ�
$zyc1=mysql_query($sql1,$conn1);  //ִ�и�SQl���
$row1=mysql_fetch_array($zyc1);
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28"><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td align="left"><?=$row1['title']?></td>
<td align="center"><?=$row['type']?></td>
<td><?=$row['number']?></td>
<td><?=$row['username']?></td>
<td style="text-align:center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td><a href="jubao.php?Action=edit&Id=<?=$row[id]?>">
<?php if ($row['online']=='0') {?>
<b style=" color:#FF0000">�ȴ�����</b>
<?php }else{?>
�������
<?php }?>
</a></td>
</tr>
<?php
}
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="21%" align="left" style="padding-top:15px; padding-bottom:15px;">
<input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input" />
<input type="submit" name="Del" id="Del" value="ɾ��" class="x2_input" onclick="return CheckSelect();" ></td>
<td width="79%" align="center" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?>    </td>
</tr>
</table>
</form>
</div>
</div>
<?php }elseif($Action=="edit"){  
$sql="select * from goods_report where id='$_REQUEST[Id]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);

$sql1="select * from product where id='$row[proid]'";   //��ȡ���ݱ�
$zyc1=mysql_query($sql1,$conn1);  //ִ�и�SQl���
$row1=mysql_fetch_array($zyc1);
?>
<form action="?Action=editsave" method="post"  id="form1" name="form1">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input id="type" name="type" type="hidden" value="<?=$row['type']?>">
<input id="title" name="title" type="hidden" value="<?=$row1['title']?>">
<input id="username" name="username" type="hidden" value="<?=$row1['username']?>">
<input id="number" name="number" type="hidden" value="<?=$row['number']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td height="32" colspan="3" align="left" class="table_top">��Ϣ����</td>
</tr>
<tr><td width="18%" class="td_left">�ٱ����ͣ�</td><td colspan="2"><?=$row['type']?></td></tr>
<tr><td width="18%" class="td_left">�ٱ��̼ң�</td><td colspan="2"><?=$row['username']?></td></tr>
<tr><td class="td_left">Ͷ�߿ͻ���</td><td colspan="2"><?=$row['number']?></td></tr>
<tr><td class="td_left">Ͷ��ʱ�䣺</td><td colspan="2"><?=date("Y-m-d G:i:s",$row['begtime'])?></td></tr>
<tr><td class="td_left">Ͷ�����ݣ�</td><td colspan="2"><?=$row['content']?></td></tr>
<tr><td class="td_left">�ϴ���ͼ��</td><td colspan="2"><?php if($row['pic']=='') {?>��<?php }else{?>
<a href="<?=$row['pic']?>" target="_blank">���Ԥ��</a>
<?php }?>

</td></tr>
<tr>
<td  class="td_left">״̬����</td>
<td colspan="2"><table id="TreatStatus" border="0">
<tr>
<td><input id="online" type="radio" name="online" value="1" <?php if ($row['online']=='1') {?> checked="checked"<?php } ?>>  ����Ͷ��</td>
<td><input id="online" type="radio" name="online" value="2" <?php if ($row['online']=='2') {?> checked="checked"<?php } ?>> <span style="color:#767474">������</span></td>
</tr>
</table></td>
</tr>
<tr>
<td  class="td_left">�̼Ҵ���</td>
<td colspan="2"><table id="TreatStatus" border="0">
<tr>
<td><input id="sjcw" type="radio" name="sjcw" value="1" <?php if ($row['sjcw']=='1') {?> checked="checked"<?php } ?>>  ��</td>
<td><input id="sjcw" type="radio" name="sjcw" value="2" <?php if ($row['sjcw']=='2') {?> checked="checked"<?php } ?>>   ��</td>
</tr>
</table></td>
</tr>
<tr>
<td >&nbsp;</td>
<td colspan="2">
<?php if ($row['online']=='1' or $row['online']=='2' or $row['sjcw']=='1' or $row['sjcw']=='2' ) {?> 

<?php }else {?>
<input type="submit" name="btn_edit" value="ȷ���ύ" id="btn_edit" class="tijiao_input" />
<?php }?>
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="editsave"){ 

if      ($_REQUEST['sjcw']=='1'){
if      ($_REQUEST['type']=='�����Ʒ') {
$kou=$nlegal_m_5;
}elseif ($_REQUEST['type']=='������Ʒ') {
$kou=$nlegal_m_6;
}elseif ($_REQUEST['type']=='Υ����Ʒ') {
$kou=$nlegal_m_7;
}

if ($_REQUEST['username']!=''){
mysql_query("insert into  `punishment_list`  set title='$_REQUEST[title]���ٱ�$_REQUEST[type]',number='$_REQUEST[username]',deduct='$kou',begtime='$begtime'",$conn1); 
mysql_query("update `members`  set bad_grades=bad_grades+$kou where number='$_REQUEST[username]'",$conn1); 
}
}elseif($_REQUEST['sjcw']=='2'){
//------------------------------��Ҵ���

mysql_query("insert into  `punishment_list`  set title='$_REQUEST[title]�ٱ�$_REQUEST[type]  ����ʵ�Ǵ����',number='$_REQUEST[number]',deduct='$nlegal_b_1',begtime='$begtime'",$conn1); 
mysql_query("update `members`  set bad_grades1=bad_grades1+$nlegal_b_1 where number='$_REQUEST[number]'",$conn1); 	
}

mysql_query("update `goods_report`  set sjcw='$_REQUEST[sjcw]',online='$_REQUEST[online]' where id=$_REQUEST[Id]",$conn1); 
echo "<script>alert('�ύ�ɹ�!');self.location=document.referrer;</script>";
} ?>

</body>
</Html>

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