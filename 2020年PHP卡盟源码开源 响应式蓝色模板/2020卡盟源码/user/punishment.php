<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
$StartYear=$_REQUEST['StartYear'];           ///////��ʼ���
$StartMonth=$_REQUEST['StartMonth'];         ///////��ʼ�·�
$StartDay=$_REQUEST['StartDay'];             ///////��ʼ����
$StartHour=$_REQUEST['StartHour'];           ///////��ʼСʱ
$StartMinute=$_REQUEST['StartMinute'];       ///////��ʼ����
$EndYear=$_REQUEST['EndYear'];               ///////�������
$EndMonth=$_REQUEST['EndMonth'];             ///////�����·�
$EndDay=$_REQUEST['EndDay'];                 ///////��������
$EndHour=$_REQUEST['EndHour'];               ///////����Сʱ
$EndMinute=$_REQUEST['EndMinute'];           ///////��������
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
?>
<div id="right">
<div class="new_qie">
<div class="new_qie2" style="padding-top:4px;">
<h2>Υ�洦��</h2>
</div>
</div>
<form action="" method="post">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">

<tr>
<td height="32" class="td_left">
��ѯʱ��Σ�</td>
<td class="left"><?php include_once('../jhs_config/time.php');?></td>
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

<table cellspacing="1" cellpadding="0" class="table1" style=" margin-top:10px;">
<tr>
<th width="30%">Υ������</th>
<th width="57%">Υ������</th>
<th width="13%">�۳�����</th>
</tr>
<?php
$search="where number='$_SESSION[ysk_number]' "; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=$muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `punishment_list`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from punishment_list  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="left" style="text-align:left"><?=$row['title']?></td>
<td><?=$row['deduct']?> ��</td>
</tr>
<?php
$deduct=$deduct+$row['deduct'];
}
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right" style="text-align:right">��ҳ�ϼƣ�</td>
<td><b style="color:red"><?php if ($deduct==''){echo 0;}else{echo $deduct;}?> ��</b></td>

</tr>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right"  style="text-align:right">�ܹ��ϼƣ�</td>
<td><?php
$res=mysql_query("SELECT sum(deduct)    FROM `punishment_list`  $search  ",$conn1);
$sum=mysql_result($res,0);
?><b style="color:red"><?php if ($sum==''){echo 0;}else{echo $sum;}?> ��</b></td>


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