<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb2312" /><title>
�ۺ���
</title><link href="css/levelall.css" rel="stylesheet" type="text/css" /><link href="css/levelstyle.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="css/leveljquery.js"></script>
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/error.php');
$Action=strip_tags($_GET['Action']);
$level=inject_check($_POST['level']);
$yx_sup_result=mysql_query("select * from sup_members where number='$sup_number' ",$conn2);
$yx_sup=mysql_fetch_array($yx_sup_result);
if ($yx_us['agent']!=''){
$aglt=mysql_query("select * from members where number='$yx_us[agent]'",$conn1);
$agent=mysql_fetch_array($aglt);
}?>
<div class="yright">
<?php if ($Action==''){
$total=mysql_num_rows(mysql_query("select * from `level` where id>'$yx_us[level]' ",$conn1));	
?>

 <div class="contbox">
            <div class="pd_t10">
                <table width="100%" cellpadding="0" cellspacing="1" class="table01">
<form action="?Action=ok" method="post">
<input name="Token" id="Token" type="hidden" value="<?=genToken()?>">
<tr>
<td width="17%" class="table1_left">ѡ��ȼ���</td>
<td width="83%" class="tdleft">
<select  name="level" id="level">  
<option  value="" selected="selected">
<?php if ($total>0){echo"��ѡ��";}else{echo "��������߼�����";}?>
</option> 
<?php
$result=mysql_query("select * from level where id>'$yx_us[level]' order by id desc",$conn1);
while($level=mysql_fetch_array($result)){?>
<option value="<?=$level['id']?>"><?=$level['title']?> (�۸�<?=$level['price']?> <?=$moneytype?>)</option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td class="table1_left">&nbsp;
</td>
<td class="tdleft">
<input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php }elseif ($Action=='ok') {

if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
} 

if ($level==''){
echo "<script>alert('�Բ�����û��ѡ��Ҫ���ļ���');history.go(-1);</script>";
exit();
}

$result1=mysql_query("select * from level where id='$level'",$conn1);
$p1=mysql_fetch_array($result1);
if ($p1['id']==''){
echo "<script>alert('�Բ�����û��ѡ��Ҫ���ļ���');history.go(-1);</script>";
exit();
}
$result2=mysql_query("select * from level where id='$yx_us[level]'",$conn1);
$p2=mysql_fetch_array($result2);
/////////////////////////////////////////////////////////��ȡ������ۺ�SUP�ۼ�
$zonger=$p1['price']-$p2['price'];
$price=$zonger*0;
$_SESSION['level_price']=$price;
$_SESSION['level_zonger']=$zonger;
$_SESSION['level_level']=$level;
$_SESSION['level_title']=$p1['title'];
/////////////////////////////////////////////////////////
if (($yx_us['kuan']-$zonger)<=0) {
echo "<script language=\"javascript\">alert('�Բ��������޷�������');history.go(-1);</script>";
exit();
}
if (($yx_sup['kuan']-$price)<0){
echo "<script language=\"javascript\">alert('�Բ���SUP�����޷�������');history.go(-1);</script>";
exit();
}

//*******************************************************************���ĺڿ��޸�ģ��
get_check_price(($yx_sup['kuan']-$price));
get_check_price(($yx_us['kuan']-$zonger));
get_check_price($zonger);
get_check_price($price);
//*******************************************************************���ĺڿ��޸�ģ�� The End
?>

<form action="?Action=save" method="post">
<input name="Token" id="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="2" class="table1" style=" margin-top:10px;">
<tr>
<td class="table1_left">��������</td>
<td class="tdleft"><?=$p1['title']?>
</td>
</tr>
<tr>
<td class="table1_left">�������ã�</td>
<td class="tdleft"><?=$zonger?> <?=$moneytype?>
</td>
</tr>
<?php if ($yx_us['agent']!=0 && $level>=$agent['level']){?>
<tr>
<td class="table1_left">������¼���ϵ��</td>
<td class="tdleft" style="color:#FF0000">�������ĵȼ����������ڵ��ϼ����� ȷ�������󽫽�����¼���ϵ��
</td>
</tr>
<?php } ?>
<tr>
<td class="table1_left">�������룺</td>
<td class="tdleft"><input name="passwords" type="password" class="biankuan" id="passwords" placeholder="���������Ľ�������" />
</td>
</tr>
<tr>
<td class="table1_left">&nbsp;
</td>
<td class="tdleft">
<input type="submit" name="btnSubmit" value="ȷ������"  id="btnSubmit" class="tijiao_input" />
<input id="Button1" type="button" value="����" class="fanhui_input" onClick="history.go(-1);" />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=='save') {

if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
} 

if (md5($_POST['passwords'])==''){
echo "<script>alert('�Բ��𣬽������벻��Ϊ�գ�');window.location='level.php';</script>";
exit();
}
if (md5($_POST['passwords'])!=$yx_us['passwords']){
echo "<script>alert('�Բ��𣬽����������!');window.location='level.php';</script>";
exit();
}

$title='������ '.$_SESSION['level_title'];
$zonger=$_SESSION['level_zonger'];
$price=$_SESSION['level_price'];
$Dagent=$yx_us['agent'];
$level=$_SESSION['level_level'];



$afters=$yx_us['kuan']-$zonger;
if (($yx_us['kuan']-$zonger)<=0) {
echo "<script language=\"javascript\">alert('�Բ��������޷�������');history.go(-1);</script>";
exit();
}

if (($yx_sup['kuan']-$price)<0){
echo "<script language=\"javascript\">alert('���������');history.go(-1);</script>";
exit();
}
//*******************************************************************���ĺڿ��޸�ģ��
get_check_price(($yx_sup['kuan']-$price));
get_check_price(($yx_us['kuan']-$zonger));
get_check_price($zonger);
get_check_price($price);
//*******************************************************************���ĺڿ��޸�ģ�� The End

$total=mysql_num_rows(mysql_query("SELECT * FROM `details_funds` where  number='$_SESSION[ysk_number]' and title='$title'",$conn1));
if ($total=='0'){
#---------------------------------------------------------------------------------------------------------��վ�۷�
if ($price>'0'){
$sup_kuan=$yx_sup['kuan']-$price;
mysql_query("insert into `sup_details_funds` (title,spendings,befores,afters,number,begtime)"."values ('��Ա�����ۿ�','$price','$yx_sup[kuan]','$sup_kuan','$sup_number','$begtime')",$conn2);
mysql_query("update sup_members set kuan='$sup_kuan',zong_kuan=zong_kuan+$price where number='$sup_number'",$conn2); 
#---------------------------------------------------------------------------------------------------------��վ�۷� The End
}

if ($zonger>'0'){
#---------------------------------------------------------------------------------------------------------��վ��Ա�۷�
mysql_query("insert into `details_funds` (title,spendings,befores,afters,number,begtime)"."values ('$title','$zonger','$yx_us[kuan]','$afters','$_SESSION[ysk_number]','$begtime')",$conn1);
}

if ($yx_us['agent']!=0 && $zonger>0){
#---------------------------------------------------------------------------------------------------------�ϼ���Ա���
$price1=$zonger*0.35;
$afters1=$agent['kuan']+$price1;
$begtime=$begtime+1;
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " .
"values ('�¼� $title','$price1','$agent[kuan]','$afters1','$yx_us[agent]','$begtime')",$conn1);
mysql_query("update members set kuan='$afters1' where number='$yx_us[agent]'",$conn1); 
if ($agent['agent']!=0){
$agl=mysql_query("select * from members where number='$agent[agent]'",$conn1);
$ag=mysql_fetch_array($agl);
#---------------------------------------------------------------------------------------------------------���ϼ���Ա���
$price1=$zonger*0.1;
$afters1=$ag['kuan']+$price1;
$begtime=$begtime+1;
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " .
"values ('���¼� $title','$price1','$ag[kuan]','$afters1','$agent[agent]','$begtime')",$conn1);
mysql_query("update members set kuan='$afters1' where number='$agent[agent]'",$conn1); 
}
#---------------------------------------------------------------------------------------------------------�ϼ���Ա���  The End
}
#---------------------------------------------------------------------------------------------------------��վ��Ա�۷� The End

mysql_query("update members set kuan='$afters',level='$level' where number='$_SESSION[ysk_number]'",$conn1); 

if ($Dagent!='' && $_SESSION['level_level']>=$agent['level']){
mysql_query("update members set agent=''         where number='$_SESSION[ysk_number]'",$conn1); 
mysql_query("update members set xlevel=xlevel-1  where number='$Dagent'",$conn1); 
}
}
unset($_SESSION['level_price']);
unset($_SESSION['level_zonger']);
unset($_SESSION['level_level']);
unset($_SESSION['level_title']);
echo "<script>alert('�����ɹ�!');window.location='/user/level.php';</script>";
exit();
}
?>

</div>
</body>
</Html>