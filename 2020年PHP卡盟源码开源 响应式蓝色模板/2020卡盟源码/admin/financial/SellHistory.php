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
<?php
If  ($Action=="List" or $Action==""){
?>


<form action="SellHistory.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">

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
<td width="14%" height="32" class="table_top">���ʱ��</td>
<td width="27%" class="table_top">���˵��</td>
<td width="4%" class="table_top">����</td>
<td width="8%" class="table_top">�¼���</td>
<td width="8%" class="table_top">�¼��ͻ�</td>
<td width="8%" class="table_top">�ϼ���</td>
<td width="8%" class="table_top">�ϼ��ͻ�</td>
<td width="9%" class="table_top">��ɽ��</td>
<td width="7%" class="table_top">�������</td>
<td width="7%" class="table_top">������ϸ</td>
</tr>
<?php
$search="where 1=1 "; 
if ($StartYear!='' ) $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 

$total=mysql_num_rows(mysql_query("SELECT * FROM `commission_record`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from commission_record  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$countnums=0;
$countprice=0;
while ($row=mysql_fetch_array($zyc)){

?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td  align="left"><?=$row['title']?></td>
<td><?=$row['nums']?></td>
<td><?=number_format($row['price1'],3);?> Ԫ</td>
<td><?=$row['customers1']?></td>
<td><?=number_format($row['price2'],3);?>  Ԫ</td>
<td><?=$row['customers2']?></td>
<td style="color:red"><?=number_format(($row['price1']-$row['price2'])*$row['nums'],3)?> Ԫ</td>
<td><a href="#" onclick="$.dialog.open('financial/SellHistory.php?orderid=<?=$row['orderid']?>&Action=edit', {title: '�������', width: 700, height: 200, lock: true, fixed:true,closeFn:function(){location.reload();}});" >����</a></td>
<td><a href="#" onclick="$.dialog.open('Order/myorder.php?id=<?=$row['orderid']?>', {title: '�����鿴', width: 900, height: 500, lock: true, fixed:true,closeFn: function () {location.reload();}});" >�鿴</a></td>
</tr>

<?php
$countnums=$countnums+ $row['nums'];
$countprice=$countprice+($row['price1']-$row['price2'])*$row['nums'];
}

?><tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
  <td height="24" colspan="2" align="right">��ҳ�ϼƣ�</td>
  <td><?=$countnums?></td>
  <td colspan="4" align="right">��ҳ�ϼƣ�</td>
  <td style="color:red"><?=number_format($countprice,3);?> Ԫ</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
  <td height="24" colspan="2" align="right">�ܹ��ϼƣ�</td>
  <td><?php
$res=mysql_query("SELECT sum(nums) FROM `commission_record` $search",$conn1);
$sum=mysql_result($res,0);
?><?=$sum?>
</td>
  <td colspan="4" align="right">�ܹ��ϼƣ�</td>
  <td style="color:red"><?php
$ress=mysql_query("SELECT sum((price1-price2)*nums) FROM `commission_record` $search",$conn1);
$sum1=mysql_result($ress,0);
?><?=number_format($sum1,3);?> Ԫ</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?> </td>
</tr>
</table>
</form>


<?php }elseif($Action=="edit"){  
?>
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td width="10%" height="32" align="center" class="table_top">��ɲ���</td>
<td width="15%" height="32" align="center" class="table_top">�¼��ͻ� </td>
<td width="13%" align="center" class="table_top">�¼��۸�</td>
<td width="15%" align="center" class="table_top">�ϼ��ͻ�</td>
<td width="13%" align="center" class="table_top">�ϼ��۸�</td>

<td width="10%" align="center" class="table_top">��������</td>
<td width="12%" align="center" class="table_top">�������</td>
<td width="12%" align="center" class="table_top">��ɽ�� </td>
</tr>
<?php
$Rss="SELECT * FROM commission_record where orderid='$_REQUEST[orderid]'  order by id asc ";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
$i=1;
while($Orzx=mysql_fetch_array($Orz)){?>
<tr><td align="center">�� <?=$i?> �� </td>
<td align="center"><?=$Orzx['customers1']?></td>
<td align="center"><?=$Orzx['price1']?> Ԫ</td>
<td align="center"><?=$Orzx['customers2']?></td>
<td align="center"><?=$Orzx['price2']?> Ԫ</td>
<td align="center"><?=$Orzx['nums']?></td>
<td align="center"><?=number_format($Orzx['price1']-$Orzx['price2'],3)?> Ԫ</td>
<td align="center"><?=number_format(($Orzx['price1']-$Orzx['price2'])*$Orzx['nums'],3)?> Ԫ</td>
</tr>

<?php 
 $i++;

} }?>

</table>
<?php } ?>
</div>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>