
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
$state=strip_tags($_GET['state']);
$keywords=strip_tags($_GET['keywords']);
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
////////�޸ļ�¼
if ($Action=="editsave") {
$audit=$_POST['audit'];
if ($audit==1){
$sql="select * from balance_cash where id='$_POST[Id]' ";
$zyc=mysql_query($sql,$conn1); 
$row=mysql_fetch_array($zyc);
ysk_date_log(3,$_SESSION['ysk_username'],'����Ա��� "'.$row['number'].'" ��һ�ʽ��Ϊ '.$row['price'].' Ԫ�����ִ���ɹ���');
}

mysql_query("update balance_cash set audit='$audit' where id='$_POST[Id]'",$conn1); 
echo "<br><br><br><br><center><input id='btnAll' type='button' value='����ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}

If ($Action=="mylove") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));    ////�� explode �� | �����ݸ���������

foreach($allArray as $value) 
{
$sql="select * from balance_cash where id='$value' and audit='0'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);

if ($row['audit']=='0'){
$sql1="select * from members where number='$row[number]' ";   //��ȡ���ݱ�
$zyc1=mysql_query($sql1,$conn1);  //ִ�и�SQl���
$row1=mysql_fetch_array($zyc1);
$after=$row1[kuan]+$row[price];

if      ($row[price]<'1000'){
$poundage=$site_charge1;
}elseif ($row[price]<'5000'){
$poundage=$site_charge2;
}elseif ($row[price]<'10000'){
$poundage=$site_charge3;
}elseif ($row[price]<'10000000'){
$poundage=$site_charge4;
}
$after10=$row1[kuan]+$row[price]+$poundage;
$after11=$after+$poundage;

mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " .
"values ('����ʧ�ܣ����ֽ�����˻����˻���','$row[price]','$row1[kuan]','$after','$row[number]','$begtime')",$conn1);
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " .
"values ('����ʧ�ܣ��������������˻����˻���','$poundage','$after','$after11','$row[number]','$begtime')",$conn1);
mysql_query("update members set kuan='$after10' where number='$row[number]'",$conn1); 
ysk_date_log(3,$_SESSION['ysk_username'],'����Ա��� "'.$row['number'].'" ��һ�ʽ��Ϊ '.$row['price'].' Ԫ�����ֲ��أ�');
}
$sql="delete from balance_cash where  id='$value' ";
mysql_query($sql,$conn1);
}
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
exit();

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
<?php if ($Action=="List" or $Action==""){?>


<form action="withdrawal.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">

<tr>
<td height="32" class="td_left">
�ͻ���ţ�</td>
<td class="left">
<input name="keywords" type="text" maxlength="20" id="keywords" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
����״̬��</td>
<td class="left">
<select name="state" id="state">
<option selected="selected" value="">ȫ��</option>
<option value="0">�ȴ�����</option>
<option value="1">�Ѿ����</option>

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
<input type="submit" value="ȷ�ϲ�ѯ"  class="chaxun_input" />
</td>
</tr>
</table>
</form>
<form name="form1" method="post" action="?Action=mylove">

<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="4%" height="32" class="table_top">ѡ��</td>
<td width="16%" height="32" class="table_top">��������</td>
<td width="14%" class="table_top">�ͻ����</td>
<td width="10%" class="table_top">�˻�����</td>
<td width="23%" class="table_top">�����˻�</td>
<td width="10%" class="table_top">�տ�����</td>
<td width="8%" class="table_top">���ֽ��</td>
<td width="15%" class="table_top">����/��ϸ</td>
</tr>
<?php
$search="where 1=1 "; 
if ($StartYear!='' ) $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
if ($keywords!='')   $search.=" and number like '%$keywords%' "; 
if ($state!='')      $search.=" and audit = '$state' "; 


$total=mysql_num_rows(mysql_query("SELECT * FROM `balance_cash`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from balance_cash  $search order by begtime desc,id desc  {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td><?=$row['number']?></td>
<td><?=$row['type']?></td>
<td height="24"><?=$row['account']?></td>
<td height="24"><?=$row['rname']?></td>
<td height="24"><?=$row['price']?> Ԫ</td>
<td style="text-align:center"><a href="#art1" onclick="art.dialog.open('withdrawal.php?Action=edit&Id=<?=$row['id']?>', { title: '���ֹ���', width: 700, height: 400, lock: true, fixed:true,closeFn: function () {location.reload();}});">
<?php     if ($row['audit']=='0') {?><div class="swcl">�ȴ�����</div>
<?php }elseif ($row['audit']=='1') {?><div class="yjcl">�ѻ��</div>
<?php }?>
</a> </td>
</tr>
<?php
}
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" style="padding:15px 0px;"><input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="ɾ��" class="x3_input" onclick="Javascript:return confirm('ȷ��Ҫɾ�������ֵ��� ���δ����ĵ��ӻ��Ǯ�˵��Է��˻��ϣ�');" ></td>
<td align="center" style="padding:15px 0px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?>  </td>
</tr>
</table>
</form>


<?php }elseif($Action=="edit"){  
$sql="select * from balance_cash where id='$_REQUEST[Id]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">

<tr><td class="td_left">�ύʱ�䣺</td><td><?=date("Y-m-d G:i:s",$row['begtime'])?></td></tr>
<tr><td class="td_left">���ֽ�</td><td><?=$row['price']?> Ԫ</td></tr>
<tr><td class="td_left">�˻����ͣ�</td><td><?=$row['type']?></td></tr>
<tr><td class="td_left">�����˻���</td><td><?=$row['account']?></td></tr>
<tr><td class="td_left">�տ�������</td><td><?=$row['rname']?></td></tr>
<tr>
<td  class="td_left">״̬����</td>
<td><select name="audit" id="audit">
<option value="0" <?php if ($row['audit']=='0') {?> selected="selected"<?php } ?>>�ȴ�����</option>
<option value="1" <?php if ($row['audit']=='1') {?> selected="selected"<?php } ?>>�ѻ������</option>
</select></td>
</tr>
<tr>
<td >&nbsp;</td>
<td><input type="submit" name="btn_edit" value="ȷ���ύ" id="btn_edit" class="tijiao_input" /></td>
</tr>



</table>
</form>
<?php } ?>
</div>
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
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>