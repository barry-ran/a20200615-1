
<!DOCTYPE HTML>
<html>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/user_check.php');
include_once('../../jhs_config/page_class.php');
include_once('../../jhs_config/error.php');

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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">
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
</script>
</head>
<body>
<div class="right">

<form action="History.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
��ѯʱ��Σ�</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit"  value="ȷ�ϲ�ѯ" class="chaxun_input" />
</td>
</tr>
</table>
</form>
<table cellspacing="1" cellpadding="0" class="table1" style=" margin-top:10px;">
<tr>
<th width="15%">��������</th>
<th width="18%">��������</th>
<th width="11%">���򵥼�</th>
<th width="7%">��������</th>
<th width="7%">�ͻ�����</th>
<th width="13%">�����ܶ�</th>
<th width="8%">������</th>
<th width="8%">������</th>
<th width="8%">ʵ������</th>
</tr>
<?php
$search="where username='$_SESSION[ysk_number]' and trading=2 and docking=0"; 
if ($StartYear!='') $search.=" and time >=$muyou1 and time <=  $muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_order`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from product_order  $search order by time desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
$sqlh="select * from product where id='$row[productid]'";   //��ȡ���ݱ�
$zych=mysql_query($sqlh,$conn1);  //ִ�и�SQl���
$rowh=mysql_fetch_array($zych);
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td style="text-align:left">

<a  href="#art1" onClick="art.dialog.open('checkorder.php?id=<?=$row['orderid']?>&Token=<?=genToken()?>', {title: '������ϸ��Ϣ',width:800,height:500,lock: true, fixed:true});"><?=$row['orderid']?></a></td>
<td><?=number_format($row['zongprice']/$row['nums'],3);?> <?=$moneytype?></td>
<td><?=$row['nums']?></td>
<td><?php if ($row['buy_pl']!=0){?>
<img src="/Public/images/0<?=$row['buy_pl']?>.png">
<?php }?></td>
<td><?=number_format($row['zongprice'],3);?> <?=$moneytype?></td>
<td><?=number_format($row['zongas'],3);?><?=$moneytype?></td>
<td><?=number_format($row['feilv'],3);?><?=$moneytype?></td>
<td><?=number_format($row['zongprice']-$row['zongas']-$row['feilv'],3);?><?=$moneytype?></td>
</tr>
<?php
$incomes=$incomes+ $row['zongprice'];
$zongas=$zongas+ $row['zongas'];
$feilv=$feilv+ $row['feilv'];
}
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
  <td height="24" colspan="5" align="right" style="text-align:right">��ҳ�ϼƣ�</td>
  <td height="24" align="center" ><b style="color:red"><?=number_format($incomes,3);?><?=$moneytype?></b></td>
  <td height="24" align="center" ><b style="color:red"><?=number_format($zongas,3);?><?=$moneytype?></b></td>
    <td height="24" align="center" ><b style="color:red"><?=number_format($feilv,3);?><?=$moneytype?></b></td>
   <td height="24" align="center" ><b style="color:red"><?=number_format($incomes-$zongas-$feilv,3);?><?=$moneytype?></b></td>
  </tr>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
  <td height="24" colspan="5" align="right"  style="text-align:right">�ܹ��ϼƣ�</td>
  <td align="right"><?php
$res=mysql_query("SELECT sum(zongprice)    FROM `product_order` $search  ",$conn1);
$sum=mysql_result($res,0);
?>
<b style="color:red">
<?=number_format($sum,3);?>
<?=$moneytype?></b></td>
  <td align="right"><?php
$res=mysql_query("SELECT sum(zongas)    FROM `product_order` $search ",$conn1);
$sum2=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum2,3);?><?=$moneytype?></b></td>
  <td align="right"><?php
$res=mysql_query("SELECT sum(feilv)    FROM `product_order` $search ",$conn1);
$sum3=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum3,3);?><?=$moneytype?></b></td>
 <td align="right"><?php
$res=mysql_query("SELECT sum(zongprice-zongas-feilv)    FROM `product_order` $search ",$conn1);
$sum4=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum4,3);?><?=$moneytype?></b></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px; padding-bottom:15px;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?> </td>
</tr>
</table>
</div>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>