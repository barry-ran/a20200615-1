<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');

$states=strip_tags($_GET['states']);
$keywords=strip_tags($_GET['keywords']);
$keyword=strip_tags($_GET['keyword']);

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php if ($Action=="List" or $Action==""){?>
<form name="add" method="get" action="list.php" >
<table cellspacing="1" cellpadding="0" class="page_table2" >
<tr>
<td height="32" class="td_left">
�ؼ������룺</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯ������</td>
<td class="left">
<select name="keywords" id="keywords">
<option selected="selected" value="account">����</option>
<option value="username">ʹ����</option>
<option value="price">���Ž��</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
��ֵ��״̬��</td>
<td class="left">
<select name="states" id="states">
<option selected="selected" value="">ȫ��</option>
<option value="1">�Ѽ���</option>
<option value="0">δ����</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
����ʱ�䣺</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="ȷ�ϲ�ѯ"  class="chaxun_input" />
</td>
</tr>
</table></form>
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="23%" class="table_top">����</td>
<td width="11%" class="table_top">״̬</td>
<td width="17%" class="table_top">����ʱ��</td>
<td width="17%" class="table_top">ʹ��ʱ��</td>
<td width="17%" class="table_top">ʹ����</td>
<td width="15%" class="table_top">���</td>
</tr>
<?php

$search="where 1=1"; 

if ($keyword!='')  $search.=" and $keywords = '$keyword' "; 
if ($states!='')   $search.=" and states ='$states'"; 
if ($StartYear!='' ) $search.=" and time >=$muyou1 and time <=  $muyou2 "; 

$total=mysql_num_rows(mysql_query("select * from `one_cartoon`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from one_cartoon  $search order by id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){

?>
<tr>
<td height="28" style="text-align:left"><?=$row['account']?></td>
<td><?php if ($row['states']=='0') {?><span style="color:#009900">δ����</span><?php }else{?><font color="red">�Ѽ���</font><?php } ?></td>
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><?php if ($row['begtime']) {?><?=date("Y-m-d G:i:s",$row['begtime'])?> <?php } ?></td>
<td><?=$row['username']?></td>
<td><?=$row['price']?> Ԫ
</td>

</tr>
<?php
}
?>
</table>

<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td  align="center" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?></td>
</tr>
</table>
</form>

<?php }?>
</div>
</body>
</Html>