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
If ($Action=="editsave") {
$godo=mysql_query("update goods_yuer set online='1' where id='$_REQUEST[Id]'",$conn1); 
$sqlzz="select * from goods_yuer where id='$_REQUEST[Id]'";   //��ȡ���ݱ�
$zyczz=mysql_query($sqlzz,$conn1);  //ִ�и�SQl���
$rowzz=mysql_fetch_array($zyczz);
$number=$rowzz['number'];               //��Ա
$sql="select * from members  where number='$number'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
$kuan=$rowzz['price']+$row['kuan'];                   //���
$title='����ת���';
$before=$row['kuan'];
$after=$rowzz['price']+$row['kuan'];
//////��¼��Ա�ʽ���ϸ
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " . "values ('$title','$rowzz[price]','$before','$after','$number','$begtime')",$conn1);
//////���»�Ա�ʽ�
mysql_query("update members set kuan='$kuan' where number='$number'",$conn1);

ysk_date_log(3,$_SESSION['ysk_username'],'������һ�� �ͻ����"'.$number.'" ת�˽�� '.$rowzz['price'].' Ԫ �Ļ���ת����¼��'); 
echo "<script>alert('����ɹ�!');;self.location=document.referrer;</script>";
}
////////ɾ������¼
If ($Action=="del") {
$sql1="select * from goods_yuer where id ='$_REQUEST[Id]'";
$zyc1=mysql_query($sql1,$conn1);
$row1=mysql_fetch_array($zyc1);
if ($row1['online']=='0'){
$sql2="select * from members where number='$row1[number]' "; 
$zyc2=mysql_query($sql2,$conn1); 
$row2=mysql_fetch_array($zyc2);
$after=$row2[goods_kuan]+$row1[price];
mysql_query("insert into `goods_details` (title,incomes,befores,afters,number,begtime) " .
"values ('ת���ʧ�ܣ��������˻����˻���','$row1[price]','$row2[goods_kuan]','$after','$row1[number]','$begtime')",$conn1);
ysk_date_log(3,$_SESSION['ysk_username'],'�����һ�� �ͻ����"'.$row1[number].'" ת�˽�� '.$row1['price'].' Ԫ �Ļ���ת����¼��'); 
mysql_query("update members set goods_kuan='$after' where number='$row1[number]'",$conn1); 
}
mysql_query("delete from goods_yuer where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='?Action=List';</script>";
}
?>

</head>
<body>

<?php if ($Action=="List" or $Action==""){?>
<form action="huokuanyuer.php" method="get">
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
״̬��</td>
<td class="left">
<select name="state" id="state">
<option selected="selected" value="">ȫ��״̬</option>
<option value="0">�ȴ�����</option>
<option value="1">�Ѿ�����</option>

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
<form name="form1" method="post" action="">

<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="19%" height="32" class="table_top">�ύʱ��</td>
<td width="23%" class="table_top">�ͻ����</td>
<td width="22%" class="table_top">ת����</td>
<td width="14%" class="table_top">����/��ϸ</td>
<td width="6%" class="table_top">ɾ��</td>
</tr>
<?php
$search="where 1=1 "; 
if ($StartYear!='' ) $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
if ($keywords!='') $search.=" and number like '%$keywords%' "; 
if ($keywords!='') $search.=" and online = '$state' "; 

$total=mysql_num_rows(mysql_query("SELECT * FROM `goods_yuer`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from goods_yuer  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><?=date("Y-m-d G:i:s",$row['begtime'])?> </td>
<td><?=$row['number']?></td>
<td><?=$row['price']?></td>
<td style="text-align:center">
<?php if ($row['online']=='0') {?>
<a onclick="return confirm('ȷ������');"  href="?Action=editsave&Id=<?=$row['id']?>">�ȴ�����</a>
<?php }else{?>
�Ѵ���
<?php }?>
 </td>
<td><a class="a delete" onclick="Javascript:return confirm('ȷ��Ҫɾ������Ϣ�� ���δ����ĵ��ӻ�ѻ����˵��Է��˻��ϣ�');"  href="?Action=del&Id=<?=$row['id']?>"></a></td>
</tr>
<?php
}
?>

</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding:15px 0px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?>  </td>
</tr>
</table>
</form>
</div>

<?php } ?>
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