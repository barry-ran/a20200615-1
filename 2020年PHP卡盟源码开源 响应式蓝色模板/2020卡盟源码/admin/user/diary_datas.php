<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
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
$type=strip_tags($_GET['type']);

if ($_REQUEST['username']!=''){
$_SESSION['check_number']=$_REQUEST['username'];
}
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

<form action="diary_datas.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">
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
<option selected="selected" value="">ȫ������</option>
<option value="1">�ͻ��������</option>
<option value="2">�ͻ����ϲ���</option>
<option value="3">�ͻ��ʽ����</option>
<option value="4">�ͻ�Ȩ�޲���</option>
<option value="5">��Ʒ��Ϣ����</option>
<option value="6">ϵͳ����</option>
<option value="7">�������ݲ���</option>
<option value="0">����</option>
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
<input type="submit"  value="ȷ�ϲ�ѯ" class="chaxun_input" />

</td>
</tr>
</table>
</form>
<table cellspacing="1" cellpadding="0" class="page_table4" width="100%">
<tr>
<td width="11%" align="center" class="table_top">������Ա</td>
<td width="11%" align="center" class="table_top">��������</td>
<td width="38%" align="center" class="table_top">�¼�����</td>

<td width="10%" align="center" class="table_top">����IP</td>
<td width="8%" align="center" class="table_top">��������</td>
<td width="15%" align="center" class="table_top">����ʱ��</td>
<td width="7%" align="center" class="table_top">��������</td>
</tr>
<?php
$search="where username='$_SESSION[check_number]'"; 
if ($keywords!='')$search.=" and content like '%$keywords%'"; 
if ($type!='')$search.=" and type='$type'"; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `diary` $search  ",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);

$sql="select * from diary  $search  order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td align="left"><?=$row['username']?></td>
<td align="center">
<?php
if    ($row['type']=='0') {
echo "����";
}elseif($row['type']=='1') {
echo "�ͻ��������";
}elseif($row['type']=='2') {
echo "�ͻ����ϲ���";
}elseif($row['type']=='3') {
echo "�ͻ��ʽ����";
}elseif($row['type']=='4') {
echo "�ͻ�Ȩ�޲���";
}elseif($row['type']=='5') {
echo "��Ʒ��Ϣ����";
}elseif($row['type']=='6') {
echo "ϵͳ����";
}elseif($row['type']=='7') {
echo "�������ݲ���";
}
?>
</td>
<td align="left"> <?=$row['content']?></td>

<td align="center"><?=$row['youip']?></td>
<td align="center"><?=$row['area']?></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center">
<?php if ($row['sid']<>0){?>
<a href="Data_recovery.php?id=<?=$row['id']?>">�ָ�</a>
<?php }else{?>
-
<?php }?>
</td>
</tr>
<?php
 }
 ?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px;">
<?php if ($total!=0){?><?=$page->paging();?><?php }?>
</td>
</tr>
</table>
</body>
</Html>