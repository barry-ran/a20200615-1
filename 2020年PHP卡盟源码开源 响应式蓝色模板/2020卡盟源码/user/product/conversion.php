<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
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
$Action=strip_tags($_GET['Action']);
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
if ($_POST['passwords']!='' && md5($_POST['passwords'])!=$yx_us['passwords']){
echo "<script language=\"javascript\">alert('�Բ��𣬽����������');history.go(-1);</script>";
exit();
}
?>
<body>

<div class="new_qie">
<ul style="float:right; padding-top:4px;">
<li><a href="conversion.php"           <?php if ($_REQUEST['Action']=='') {?>class="on"<?php } ?>>����ת���</a></li>
<li><a href="conversion.php?Action=g2" <?php if ($_REQUEST['Action']=='g2') {?>class="on"<?php } ?>>������ϸ</a></li>
<li><a href="conversion.php?Action=g3" <?php if ($_REQUEST['Action']=='g3') {?>class="on"<?php } ?>>��¼��ѯ</a></li>
</ul>
<div class="new_qie2" style="padding-top:4px;">
<h2><?php if ($Action==''){echo "����ת���";}elseif($Action=='g2'){"������ϸ";}elseif($Action=='g3'){"��¼��ѯ";} ?></h2>
</div>
</div>
<?php if ($Action==''){?>
<form action="?Action=save" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="2" class="table1" style=" margin-top:10px;">
<tr>
<td class="table1_left">������</td>
<td class="tdleft"><span class="red"><?=$yx_us['goods_kuan']?></span> <?=$moneytype?> </td>
</tr>
<tr>
<td class="table1_left"> ת��� </td>
<td class="tdleft"><input name="Amount" type="text" id="Amount" class="biankuan" onKeyUp="clearNoNum(this)" />
&nbsp;<?=$moneytype?>  </td>
</tr>
<tr><td class="table1_left"> �������룺</td><td class="tdleft"><input name="passwords" type="password" class="biankuan" id="passwords" placeholder="���������Ľ�������" />
</td>
</tr>
<tr>
<td class="table1_left">&nbsp;</td>
<td class="tdleft"><input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input" />
<input name="button" type="button" class="fanhui_input" id="button" onClick="history.go(-1);" value="����" />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=='save'){

if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}
if ($_POST['passwords']==''){echo "<script>alert('�Բ��𣬽������벻��Ϊ�գ�');history.go(-1);</script>";exit();}
$Amount=get_check_price($_POST['Amount']);


if ($Amount<0){
echo "<script>alert('�Բ��𣬽���쳣����Ϊ�գ�');history.go(-1);</script>";exit();
}

if ($yx_us['kuan']<0){
echo "<script>alert('�Բ��𣬽���쳣����Ϊ�գ�');history.go(-1);</script>";exit();
}

if (($yx_us['goods_kuan']-$Amount)<0) {
echo "<script language=\"javascript\">alert('�Բ��𣬻�����㣡');history.go(-1);</script>";
exit();
}

$price=get_check_price($yx_us['goods_kuan']-$Amount);

////////���µ�������ϸ����
mysql_query("insert into `goods_details` (title,orderid,spendings,befores,afters,number,begtime) " . "values ('����ת���','$pro_orderid','$Amount','$yx_us[goods_kuan]','$price','$_SESSION[ysk_number]','$begtime')",$conn1);
/////////////��¼ת���
mysql_query("insert into `goods_yuer` (title,price,number,begtime) " . "values ('����ת���','$Amount','$_SESSION[ysk_number]','$begtime')",$conn1);
############���¹����̵Ľ��
mysql_query("update members set goods_kuan='$price' where number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('�ύ�ɹ����ȴ��ͷ����!');window.location='conversion.php?Action=g3';</script>";
exit();
}elseif ($_GET['Action']=='g2') {?>
<form action="conversion.php" method="get">
<input name="Action" type="hidden" value="g2">
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
<input type="submit" value="ȷ�ϲ�ѯ" class="chaxun_input" />
</td>
</tr>
</table>
</form>
<form name="form1" method="post" action="">

<table cellspacing="1" cellpadding="0" class="table1" style=" margin-top:10px;">
<tr>
<th width="14%">��������</th>
<th width="20%">��������</th>
<th width="14%">����(<?=$moneytype?>)</th>
<th width="14%">֧��(<?=$moneytype?>)</th>
<th width="14%">�仯ǰ(<?=$moneytype?>)</th>
<th width="14%">�仯��(<?=$moneytype?>)</th>
</tr>
<?php
$search="where number='$_SESSION[ysk_number]' "; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `goods_details`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from goods_details  $search order by begtime desc,id desc  {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td style="text-align:left">
<?php if ($row['title']=='(�����˿�)' or $row['title']=='(��Ʒ����)') {?>
<a  href="#art1" onClick="art.dialog.open('/user/order.php?id=<?=$row['orderid']?>&Token=<?=genToken()?>', { title: '������ϸ��Ϣ', width: 800, height: 600, lock: true, fixed:true});"><?=$row['orderid']?></a>
<?php }else{?>
<?=$row['orderid']?> 
<?php }?>
<?=$row['title']?></td>
<td><?=number_format($row['incomes'],3);?> <?=$moneytype?></td>
<td><?=number_format($row['spendings'],3);?>  <?=$moneytype?></td>
<td><?=number_format($row['befores'],3);?> <?=$moneytype?></td>
<td><?=number_format($row['afters'],3);?><?=$moneytype?></td>
</tr>
<?php
$incomes=$incomes+ $row['incomes'];
$spendings=$spendings+ $row['spendings'];
}
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right" style="text-align:right">��ҳ�ϼƣ�</td>
<td><b style="color:red"><?=number_format($incomes,3);?> <?=$moneytype?></b></td>
<td height="24" align="center" ><b style="color:red"><?=number_format($spendings,3);?> <?=$moneytype?></b></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right"  style="text-align:right">�ܹ��ϼƣ�</td>
<td><?php
$res=mysql_query("SELECT sum(incomes)    FROM `goods_details` where number='$_SESSION[ysk_number]'  ",$conn1);
$sum=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum,3);?> <?=$moneytype?></b></td>
<td align="right"><?php
$res1=mysql_query("SELECT sum(spendings) FROM `goods_details` where number='$_SESSION[ysk_number]'   ",$conn1);
$sum1=mysql_result($res1,0);
?><b style="color:red"><?=number_format($sum1,3);?>  <?=$moneytype?></b></td>

<td style="color:red">&nbsp;</td>
<td style="color:red">&nbsp;</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td style="text-align:center; "><?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?></td>
</tr>
</table>
</form>

<?php }elseif ($Action='g3') {?>
<form action="conversion.php" method="get">
<input name="Action" type="hidden" value="g3">
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
<input type="submit" value="ȷ�ϲ�ѯ" class="chaxun_input" />
</td>
</tr>
</table>
</form>
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="table1" style=" margin-top:10px;">
<tr>
<th width="21%">��������</th>
<th width="57%">��������</th>
<th width="14%">���(<?=$moneytype?>)</th>
<th width="8%">״̬</th>
</tr>
<?php

$search="where  number='$_SESSION[ysk_number]' "; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `goods_yuer`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from goods_yuer  $search order by begtime desc,id desc  {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td style="text-align:left">������ת���</td>
<td><?=number_format($row['price'],3)?> <?=$moneytype?></td>
<td><?php if ($row['online']=='0') {?>�ȴ����<?php }else{?><b style="color:#FF0000">�Ѵ���</b><?php } ?></td>
</tr>
<?php
$incomes=$incomes+ $row['price'];
}
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right" style="text-align:right">��ҳ�ϼƣ�</td>
<td><b style="color:red"><?=number_format($incomes,3)?> <?=$moneytype?></b></td>
<td height="24" align="center" >&nbsp;</td>
</tr>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="24" colspan="2" align="right"  style="text-align:right">�ܹ��ϼƣ�</td>
<td><?php
$res=mysql_query("SELECT sum(price)    FROM `goods_yuer`   $search  ",$conn1);
$sum=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum,3)?> <?=$moneytype?></b></td>
<td align="right">&nbsp;</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td style="text-align:center;"><?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?></td>
</tr>
</table>
</form>

<?php } ?>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>