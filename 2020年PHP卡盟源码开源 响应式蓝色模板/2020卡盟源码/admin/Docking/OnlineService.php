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
$keywords=strip_tags($_GET['keywords']);
$yy=strip_tags($_GET['yy']);
$recent=strip_tags($_GET['recent']);
$state=strip_tags($_GET['state']);
$seey=strip_tags($_GET['seey']);
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


</head>
<body>

<div class="Menubox" >
<ul>

<li class="hover"><a href="#">����Ͷ��(<?=mysql_num_rows(mysql_query("select  clouds from  Complaints_feedback  where audit='0' and clouds<>0 ",$conn1));?>)</a></li>
</ul>
</div>


<?php if ($Action==''){?>

<form action="OnlineService.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">

<tr>
<td height="32" class="td_left">
�ͻ���ţ�</td>
<td class="left">
<input name="keywords" type="text" maxlength="20" id="keywords" /> <select name="seey" id="seey">
<option value="number" selected="selected">�ͻ����</option>
<option value="orerno">�������</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯ������</td>
<td class="left">
<select name="state" id="state">
<option selected="selected" value="">ȫ��</option>
<option value="0">��δ����</option>
<option value="1">�Ѿ�����</option>
<option value="3">�޷�����</option>
<option value="2">�������</option>
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
<td width="7%" height="32" class="table_top">ID</td>
<td width="15%" class="table_top">Ͷ��ʱ��</td>
<td width="11%" class="table_top">Ͷ�߿ͻ� </td>
<td width="39%" class="table_top">Ͷ������</td>
<td width="17%" class="table_top"> ������ </td>
<td width="11%" class="table_top">����״̬</td>
</tr>
<?php


$search="where clouds!=0"; 
if ($keywords!='')  $search.=" and $seey like '%$keywords%' "; 
if ($state!='')     $search.=" and audit = '$state' "; 
if ($StartYear!='') $search.=" and time >=$muyou1 and time <=  $muyou2 "; 

$total=mysql_num_rows(mysql_query("SELECT * FROM `Complaints_feedback`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from Complaints_feedback  $search order by time desc,id desc {$page->limit}"; 


$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><?=$row['id']?></td>
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td><?=$row['number']?></td>
<td><?=$row['title']?></td>
<td style="text-align:center"><a  href="#art1" onclick="art.dialog.open('user/order.php?id=<?=$row[orerno]?>&check=chk',{title:'ֱ��ƽ̨������ϸ��¼',width:800, height:400,lock:true,fixed:true});"><?=$row['orerno']?></a></td>
<td><a href="?Action=edit&Id=<?=$row['id']?>">

<?php        if ($row['audit']=='0') {?>
<span class='complaint0'>��δ����</span>
<?php    }elseif($row['audit']=='1') {?>
<span class='complaint1'>����Ͷ��</span>
<?php    }elseif($row['audit']=='2') {?>
<span class='complaint3'>�޷�����</span>
<?php    }elseif($row['audit']=='3') {?>
<span class='complaint2'>����ɴ���</span>
<?php } ?></a>
</td>
</tr>
<?php
}
?>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>

<td align="center"><?php if ($total!=0){?><?=$page->paging();?><?php }?></td>
</tr>
</table>
</form>
<?php }elseif($Action=="edit"){  
$Id=inject_check($_GET['Id']);
$sql="select * from Complaints_feedback where id='$Id'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>
<table class="page_table4" cellpadding="0" cellspacing="1" style="margin-top:10px;">
<tr>
<td height="32" colspan="3" align="left" class="table_top">��Ϣ����</td>
</tr>
<tr><td width="18%" class="td_left">���ͣ�</td><td colspan="2"><?=$row['type']?></td></tr>
<tr><td class="td_left">Ͷ�߿ͻ���</td><td colspan="2"><?=$row['number']?></td></tr>
<tr><td class="td_left">Ͷ��ʱ�䣺</td><td colspan="2"><?=date("Y-m-d G:i:s",$row['time'])?></td></tr>
<tr><td class="td_left">Ͷ�����⣺</td><td colspan="2"><?=$row['title']?></td></tr>

<tr><td class="td_left">Ͷ�߶�����</td><td colspan="2">
<a  href="#art1" onclick="art.dialog.open('user/order.php?id=<?=$row[orerno]?>&check=chk', { title: 'ֱ��ƽ̨������ϸ��¼', width:900, height: 400, lock: true, fixed:true,closeFn: function () {location.reload();}});"><?=$row['orerno']?></a></td></tr>

<tr><td class="td_left">Ͷ�����ݣ�</td><td colspan="2"><?=$row['content']?></td></tr>
<tr><td class="td_left">�ظ����ݣ�</td><td colspan="2"><?=$row['reply']?></td></tr>


</table>
<?php }?>
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