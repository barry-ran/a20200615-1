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
<?php if ($Action==""){?>
<div class="Menubox" >
<ul>
<li class="hover"><a href="detail.php">�ʽ���ϸ</a></li>
</ul>
</div>
<div style="padding:10px 0px;">
<form action="detail.php" method="get">
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
<form name="form1" method="post" action="?Action=mylove">

<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<th width="15%" height="32" class="table_top" style="padding:2px 0px;">��������</th>
<th width="25%" class="table_top">��������</th>
<th width="15%" class="table_top">����(Ԫ)</th>
<th width="15%" class="table_top">֧��(Ԫ)</th>
<th width="15%" class="table_top">�仯ǰ(Ԫ)</th>
<th width="15%" class="table_top">�仯��(Ԫ)</th>
</tr>
<?php
$search="where 1=1 and number='$sup_number'"; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `sup_details_funds`  $search",$conn2));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from sup_details_funds  $search order by begtime desc,id desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn2);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="32"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td style="text-align:left; padding-left:10px;">
<?php if ($row['title']=='�����˿�' or $row['title']=='��Ʒ����') {?>
<a  href="#art1" onclick="art.dialog.open('user/order.php?id=<?=$row['orderid']?>&check=chk', { title: '������ϸ��Ϣ', width: 800, height:500, lock: true, fixed:true});"><?=$row['orderid']?></a>
<?php }else{?>
<?=$row['orderid']?> 
<?php }?>
<?=$row['title']?></td>
<td><?=number_format($row['incomes'],3);?> Ԫ</td>
<td><?=number_format($row['spendings'],3);?>  Ԫ</td>
<td><?=number_format($row['befores'],3);?> Ԫ</td>
<td><?=number_format($row['afters'],3);?>Ԫ</td>
</tr>
<?php
$incomes=$incomes+ $row['incomes'];
$spendings=$spendings+ $row['spendings'];
}
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
  <td height="24" colspan="2" align="right" style="text-align:right">��ҳ�ϼƣ�</td>
  <td><b style="color:red"><?=number_format($incomes,3);?> Ԫ</b></td>
  <td height="24" align="center" ><b style="color:red"><?=number_format($spendings,3);?> Ԫ</b></td>
    

  <td height="24" align="right" style="text-align:right">&nbsp;</td>
  <td style="color:red">&nbsp;</td>
</tr>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
  <td height="24" colspan="2" align="right"  style="text-align:right">�ܹ��ϼƣ�</td>
  <td><?php
$res=mysql_query("SELECT sum(incomes)    FROM `sup_details_funds` $search ",$conn2);
$sum=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum,3);?> Ԫ</b></td>
  <td align="center"><?php
$res1=mysql_query("SELECT sum(spendings) FROM `sup_details_funds` $search  ",$conn2);
$sum1=mysql_result($res1,0);
?><b style="color:red"><?=number_format($sum1,3);?>  Ԫ</b></td>
  <td align="right">&nbsp;</td>
  <td style="color:red">&nbsp;</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>

<td align="center" ><?php if ($total!=0){?><?=$page->paging();?><?php }?></td>
</tr>
</table>
</form>
</div>
</div>
<?php
} ?>

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