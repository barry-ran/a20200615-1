<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="images/right.css" rel="stylesheet" type="text/css" />
</head>
<body leftmargin="0" bottommargin="0">
<script>
function cl()
{ 
var win = art.dialog.open.origin;//��Դҳ��
// �����ҳ�����ػ��߹ر����ӶԻ���ȫ����ر�
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
<?php 
include('../jhs_config/function.php');
include('../jhs_config/user_check.php');
include('../jhs_config/error.php');
$Action=strip_tags($_GET['Action']); 
$id=strip_tags($_GET['id']); 
$total=mysql_num_rows(mysql_query("select * from `flagship_shops` where uid='$id' ",$conn1));

if ($total>=7){?>
<center>
<br /><br><font color="red" style="font-size:24px; font-family:'΢���ź�'">�Բ��𣬸���Ŀ���콢���ѱ������ˣ�</font><br /><br>
</center>
<?php  exit();}elseif ($Action==''){?>
<form action="?Action=ok&id=<?=$id?>" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="3" class="table5">
<tr>
<td width="20%" height="32" class="tdleri" style="text-align:right">����ʱ�ޣ�</td>
<td width="80%" align="left" class="tdleft"> <select name="buy">
<option value="30">һ�� <?=$fship_price1?> <?=$moneytype?></option>
<option value="365">һ��<?=$fship_price2?> <?=$moneytype?></option>
</select></td>
</tr>
<tr>
<td width="20%" height="32" class="tdleri" style="text-align:right">ѡ����̣�</td>
<td width="80%" align="left" class="tdleft"><select name="ClassID" id="ClassID">
<?php 
$results=mysql_query("select * from product_class where number='$_SESSION[ysk_number]' and LagID=2 order by id desc",$conn1);
while($type=mysql_fetch_array($results)){?>
<option value="<?=$type['NumberID']?>"><?=$type['7']?></option>
<?php } ?>
</select></td>
</tr>
<tr>
<td width="20%" height="32" class="tdleri" style="text-align:right">�������Ѻ��</td>
<td width="80%" align="left" class="tdleft"> <?=$fship_price3?> <?=$moneytype?></td>
</tr>


<tr>
<td height="48" colspan="2"  align="center">
  <?php if ($yx_us['frozen_kuan']<$fship_price3){?>
  �Բ���������Ѻ��δ�ﵽ <?=$fship_price3?> <?=$moneytype?> �޷�������콢��
  <?php }else{?>
  <input type="submit" name="btn_edit" value="��һ��" id="btn_edit" class="tijiao_input" />
  <?php } ?></td>
</tr>
</table>
</form>
<?php }elseif ($Action=='ok'){
$Token=strip_tags($_POST['Token']); 
$ClassID=strip_tags($_POST['ClassID']); 
$buy=pot_check_price($_POST['buy']);
/////////////////////////////////////���ù�������
if($buy==30){
$price=$fship_price1;
$buy=30;
$overday=$begtime+86400*30;
}else{
$price=$fship_price2;
$buy=365;
$overday=$begtime+86400*365;
}

if ($_SESSION['yx_token']!=$Token){
echo "<script>alert('����ʧ�ܣ��Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}

if ($ClassID==''){
echo "<script>alert('����ʧ�ܣ���û��ѡ����̣�');;self.location=document.referrer;</script>";
exit();	
}

$total1=mysql_num_rows(mysql_query("select * from `flagship_shops` where uid='$id' and mid='$ClassID' ",$conn1));
if ($total1>0){
echo "<script>alert('����ʧ�ܣ����Ѿ�������ˣ�');;self.location=document.referrer;</script>";
exit();	
}

if ($yx_us['kuan']<$price){
echo "<script>alert('����ʧ�ܣ��������㣡');;self.location=document.referrer;</script>";
exit();	
}

///////��������


$zongprice=$yx_us['kuan']-$price;
mysql_query("insert into `details_funds` set title='�����콢��$id����פ',spendings='$price',befores='$yx_us[kuan]',afters='$zongprice',number='$_SESSION[ysk_number]',begtime='$begtime'",$conn1);

mysql_query("update members set kuan='$zongprice',zong_kuan=zong_kuan+$price where number='$_SESSION[ysk_number]'",$conn1); 

mysql_query("insert into flagship_shops set uid='$id',mid='$ClassID',price='$yx_us[frozen_kuan]',username='$_SESSION[ysk_number]',begtime='$begtime',overday='$overday'",$conn1);



echo "<br><br><br><center><input id='btnAll' type='button' value='����ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";


}?>
</body>
</Html>
