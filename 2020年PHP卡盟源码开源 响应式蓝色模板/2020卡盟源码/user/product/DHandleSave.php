<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/user_check.php');
include_once('../../jhs_config/error.php');
include_once('../../jhs_config/page_class.php');
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
$state=strip_tags($_GET['state']);
$Action=strip_tags($_GET['Action']);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="right">
<?php if ($Action=="List" or $Action==""){?>


<form action="DHandleSave.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
�����ؼ��ʣ�</td>
<td class="left">
<input name="keywords" type="text" maxlength="20" id="keywords" /> <select name="seey" id="seey">
<option value="number" selected="selected">�ͻ����</option>
<option value="orderid">�������</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯ������</td>
<td class="left">
<select name="state" id="state">
<option selected="selected" value="">ȫ��</option>
<option value="0">�ȴ�����</option>
<option value="1">��ֵ�ɹ�</option>
<option value="2">ȡ����ֵ</option>
<option value="3">�Ѿ��˵�</option>
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
<td width="29%" class="table_top">��Ʒ</td>
<td width="14%" class="table_top">�������</td>
<td width="9%" class="table_top">��ֵ�˻�</td>
<td width="3%" class="table_top">����</td>
<td width="12%" class="table_top">����ͻ�</td>
<td width="12%" class="table_top">����ʱ�� </td>
<td width="9%" class="table_top">״̬��ϸ</td>
<td width="6%" class="table_top">�ͻ�����</td>
<td width="6%" class="table_top">�ͻ�QQ</td>
</tr>
<?php
$search="where username='$_SESSION[ysk_number]'  and refund!=1   and sid='0' and docking=0"; 
if ($StartYear!='' ) $search.=" and time >=$muyou1 and time <=  $muyou2 "; 
if ($keywords!='') $search.="   and $seey like '%$keywords%' "; 
if ($state!='')    $search.="   and trading = '$state' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_order`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from product_order  $search order by time desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){

$Uresult=mysql_query("select * from  `members`  where number='$row[number]'",$conn1);
$User=mysql_fetch_array($Uresult);
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="32" align="left"><?=$row['title']?></td>
<td height="33" align="center"><?=$row['orderid']?></td>
<td height="32" align="center"><?=$row['content1']?></td>
<td><?=$row['nums']?></td>
<td><?=$yx_us['rname']?> <span style="color:#666">[<?=$row['number']?>]</span></td>
<td style="text-align:center"><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><a  href="#art1" onClick="art.dialog.open('/user/product/checkorder.php?id=<?=$row[orderid]?>',{title:'������ϸ��¼',width:900,height:500,lock:true, fixed:true});">
<?php if      ($row['trading']=='0' || $row['trading']=='1' ) {?>
<span class="complaint0">�ȴ�����</span>
<?php }elseif ($row['trading']=='2') {?>
<span class="complaint1">���׳ɹ�</span>
<?php }elseif ($row['trading']=='3') {?>
<span class="complaint3">ȡ����ֵ</span>
<?php }?></a></td>
<td>
<?php if ($row['buy_pl']!=0){?>
<img src="/Public/images/0<?=$row['buy_pl']?>.png">
<?php }?>
</td>
<td>
<?php if ($User['qq']!=''){?>
<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$User['qq']?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?=$User['qq']?>:52" alt="���������ҷ���Ϣ" title="���������ҷ���Ϣ"/></a>
<?php }?>
</td>
</tr>
<?php
}
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?>  </td>
</tr>
</table>
</form>
<?php } ?>
</div>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>