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
</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
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
$keywords=$_REQUEST['keywords'];  
$seey=$_REQUEST['seey'];          
$state=$_REQUEST['state'];  
$Action=$_REQUEST['Action'];?>

<div class="Menubox" >
<ul>
<li class="hover"><a href="DHandleSave.php?yy=1">SUP���� (<?=mysql_num_rows(mysql_query("select  sid from  product_order  where trading=0 and sid<>0 ",$conn1));?>)</a></li>

</ul>
</div>


<div style="padding:10px 0px;">


<form action="" method="post">
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
<td width="39%" class="table_top">��Ʒ</td>
<td width="12%" class="table_top">��ֵ�˻�</td>
<td width="7%" class="table_top">����</td>
<td width="15%" class="table_top">����ͻ�</td>
<td width="15%" class="table_top">�ύʱ�� </td>
<td width="12%" class="table_top">״̬��ϸ</td>
</tr>
<?php
$search="where sid<>0 "; 
if ($StartYear!='' ) $search.=" and time >=$muyou1 and time <=  $muyou2 "; 
if ($keywords!='') $search.="   and $seey like '%$keywords%' "; 
if ($state!='')    $search.="   and trading = '$state' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_order`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from product_order  $search order by time desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="32" align="left"><?=$row['title']?></td>
<td height="32" align="center"><?=$row['content1']?></td>
<td><?=$row['nums']?></td>
<td> <span style="color:#666"><?=$row['number']?></span></td>
<td style="text-align:center"><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><a  href="#art1" onClick="art.dialog.open('user/order.php?id=<?=$row['orderid']?>&check=chk',{title:'������ϸ��¼',width:900,height:500,lock:true, fixed:true});">
<?php if      ($row['trading']=='0' || $row['trading']=='1' ) {?>
<span class="complaint0">�ȴ�����</span>
<?php }elseif ($row['trading']=='2') {?>
<span class="complaint1">���׳ɹ�</span>
<?php }elseif ($row['trading']=='3') {?>
<span class="complaint3">ȡ����ֵ</span>
<?php }?></a></td>
</tr>
<?php
}
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center"><?php if ($total!=0){?><?=$page->paging();?><?php } ?></td>
</tr>
</table>
</form>
</div>

</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>