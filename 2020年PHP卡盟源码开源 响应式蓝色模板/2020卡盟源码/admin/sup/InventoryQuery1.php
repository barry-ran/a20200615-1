<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Welcome</title>
<link rel="stylesheet" href="images/sup1.css" type="text/css" />
</head>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$NumberID=$_REQUEST['NumberID']; ?>
<body>
<?php include('head.php');?>
<div class="tishi1" style="line-height: 1.5">
<b>˵����</b> ���ˡ�SUP��Ʒ���۵��� ���ģ��������жԽ��쳣����Ʒ�û����޷����򣬽������½��жԽӵ�������SUP��Ʒ���۵��� ������Ʒ�����¶��۷���ᵼ������ͳ�Ʋ�׼��
</div>
<table cellspacing="1" cellpadding="0" class="page_table">
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td class="table_top" width="70%">
�쳣����
</td>
<td class="table_top" width="15%">
�쳣����
</td>
<td class="table_top" width="15%">
�鿴����
</td>
</tr>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?y=3">���жԽ��쳣����Ʒ</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state<0 and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td>
<a href="Inventoryquery.php?y=3&state=0">�鿴�����쳣</a></td>
</tr>

<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?state=-1&y=3">SUP��Ʒ���۵���</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-1' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td><a href="Inventoryquery.php?state=-1&y=3">�鿴����</a></td>
</tr>

<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?state=-2&y=3">SUP��Ʒ���۵���</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-2' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td><a href="Inventoryquery.php?state=-2&y=3">�鿴����</a></td>
</tr>

<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a  href="Inventoryquery.php?state=-3&y=3">������Ϊ������</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-3' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td><a href="Inventoryquery.php?state=-3&y=3">�鿴����</a></td>
</tr>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?state=-4&y=3">SUP��Ʒδ�ϼ�</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-4' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td>
<a href="Inventoryquery.php?state=-4&y=3">�鿴����</a></td>
</tr>

<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?state=-5&y=3">SUP��Ʒδͨ�����</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-5' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td><a href="Inventoryquery.php?state=-5&y=3">�鿴����</a></td>
</tr>

<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a id="Repeater1_ctl07_HyperLink1" href="Inventoryquery.php?state=-6&y=3">SUP��ƷΪ������</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-6' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td>
<a href="Inventoryquery.php?state=-6&y=3">�鿴����</a></td>
</tr>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="28" class="left">
<a href="Inventoryquery.php?state=-7&y=3">SUP��Ʒ��ɾ��</a></td>
<td>
<span style="color: red; font-weight: bold">
<?=mysql_num_rows(mysql_query("select  sid from  product  where state='-7' and sid<>0 order by id desc",$conn1));?>
</span>
</td>
<td><a href="Inventoryquery.php?state=-7&y=3">�鿴����</a></td>
</tr>
</table>		
</body>
</Html>