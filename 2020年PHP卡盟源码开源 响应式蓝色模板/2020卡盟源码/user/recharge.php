
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
$Action=$_REQUEST['Action'];
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);

$pay=$_REQUEST['pay'];
if ($pay=='' or $pay=='1'){
$payurl='../payment/alipay/alipayapi.php';
$payck='1';
}else{
$payurl='../payment/tenpay/tenpay.php';
$payck='2';
}
?>
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
<div class="right">
<div class="new_qie">
<ul style="float:right; padding-top:4px;">
<li><a href="AccountSaving.php" <?php if ($_REQUEST['Go']=='') {?>class="on"<?php } ?>>�˻���ֵ�ӿ�</a></li>
<?php if ($yx_us['power7']=='1'){?><li><a href="AccountSaving.php?Go=2" <?php if ($_REQUEST['Go']=='2') {?>class="on"<?php } ?>>�ӿ��ֵ</a></li><?php }?>
<li><a href="AccountSaving.php?Go=3" <?php if ($_REQUEST['Go']=='3') {?>class="on"<?php } ?>>�������»��</a></li>
<li><a href="AccountSaving.php?Go=4" <?php if ($_REQUEST['Go']=='4') {?>class="on"<?php } ?>>���֪ͨ���¼</a></li>
</ul>
<div class="new_qie2" style="padding-top:4px;">
<h2><?php if ($_REQUEST['Go']=='') {?>�˻���ֵ�ӿ�
<?php }elseif($_REQUEST['Go']=='2'){?>�ӿ��ֵ
<?php }elseif($_REQUEST['Go']=='3'){?>�������»��
<?php }elseif($_REQUEST['Go']=='4'){?>���֪ͨ���¼
<?php } ?>
</h2>
</div>
</div>

<?php if ($_REQUEST['Go']=='' && $Action=='') {?>
<form action="<?=$payurl?>" method="post" target="_blank">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="4" width="100%" id="tablealipay" class="table1 tableleft" style="margin-top:10px;">
<tr>
<th colspan="6" style="text-align: left">
<input name="type" type="radio" id="Alipay" onClick="if (this.checked){window.location='?Go=<?=$_REQUEST['Go']?>&pay=1'}"   value="1"  <?php if ($payck=='' or $payck=='1') {?>checked="checked" <?php } ?>>
<a href="#"><b>֧����֧���ӿ�</b></a><span class="HandLing">�����ѣ�1-9��0.3Ԫ��10-50��0.5Ԫ��51�����ϣ�0.5%(5Ԫ�ⶥ)</span></th>
</tr>
<?php if ($payck=='' or $payck=='1') {?>
<tr>
<td colspan="2" style="text-align: center"><img src="images/yh.jpg" />  </td>
</tr>
<?php }?>
<tr>
<th colspan="6" style="text-align: left; ">
<input name="type" type="radio" id="Alipay"   onclick="if (this.checked){window.location='?Go=<?=$_REQUEST['Go']?>&pay=2'}" <?php if ($payck=='2') {?>checked="checked" <?php } ?>>
<a href="#"><b>�Ƹ�ͨ</b></a><span class="HandLing">�����ѣ�1-9��0.3Ԫ��10-50��0.5Ԫ��51�����ϣ�1%(5Ԫ�ⶥ)</span></th>
</tr>
<?php if ($payck=='2') {?>
<tr>
<td colspan="2" style="text-align: center"><img src="images/yh.jpg" />  </td>
</tr>
<?php }?>
<tr>
<td width="13%" style="text-align: center"> ��ֵ������룺</td>
<td width="87%" height="30" align="left"  style="text-align:left">
<input name="price" type="text" value="100" maxlength="11" id="price" class="input_money" onKeyUp="clearNoNum(this)"  />      </td>
</tr>
<tr>
<td height="30" style="text-align: center">&nbsp;</td>
<td>
<input type="submit" name="Pay" value="ȷ��֧��" class="tijiao_input" style="float:left;" /></td>
</tr>
</table>
</form>
<?php }elseif ($_REQUEST['Go']=='2' && $Action=='' && $yx_us['power7']=='1'){?>
<form action="?Action=save1" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="2" class="table1" style="margin-top:10px;">
<tr>
<td width="13%" class="table1_left">�ӿ���ţ�</td>
<td width="87%" class="tdleft"><input name="account" type="text" id="account" class="biankuan"></td>
</tr>
<tr>
<td class="table1_left">
�ӿ���룺
</td>
<td class="tdleft">
<input name="password" type="password" id="password"  class="biankuan" />
</td>
</tr>
<tr>
<td></td><td class="tdleft"><input type="submit" name="btnSubmit" value="ȷ�ϳ�ֵ" id="btnSubmit" class="tijiao_input" /></td>
</tr>
</table>
</form>
<?php }elseif ($_REQUEST['Go']=='3' && $Action=='') {?>
<form action="?Action=save" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="table1" cellspacing="1" cellpadding="3" style="margin-top:10px;">
<tr>
<td width="10%" >������У�</td>
<td width="90%" class="tdleft">
<table class="table1" cellspacing="1" cellpadding="0" width="90%" style="margin: 0;
text-align: center; padding: 0">
<tr>
<th width="10%">
ѡ��</th>
<th width="18%">
��������</th>
<th width="15%">
�����˺�</th>
<th width="35%">
��������</th>
<th width="22%">
��������</th>
</tr>
<?php
$result=mysql_query("select * from rem_account  order by id desc",$conn1);
while($row=mysql_fetch_array($result)){?>
<tr onMouseOver="this.style.backgroundColor='#fffdd7';" onMouseOut="this.style.backgroundColor='';">
<td>
<input id="type" type="radio" name="type" value="<?=$row['id']?>" ></td>
<td><?=$row['bank_type']?></td>
<td><?=$row['bankaccount']?></td>
<td><?=$row['accountname']?></td>
<td><?=$row['bankcity']?></td>
</tr>
<?php
}
?>
</table></td>
</tr>
<tr>
<td >
����</td>
<td class="tdleft">
<input name="price" type="text" maxlength="10" id="price" class="biankuan" style="width: 50px" onKeyUp="clearNoNum(this)" /> 
Ԫ</td>
</tr>
<tr>
<td >
���ʱ�䣺</td>
<td class="tdleft"><input name="time" type="text" id="time"  class="biankuan"/> <span style="color:#666">�磺2013��01��01������2��</span></td>
</tr>
<tr>
<td>
��ע��</td>
<td class="tdleft">
<textarea name="note" rows="3" cols="40" id="note" class="biankuan" onFocus="this.className='input01'" onBlur="this.className='input0'" style="width: 280px; height: 80px"></textarea></td>
</tr>
<tr>
<td></td>
<td class="tdleft">
<input type="submit" name="Submit" value="ȷ���ύ"  id="Submit" class="tijiao_input" />
<input id="Button1" type="button" value="����" class="fanhui_input" onClick="history.go(-1);" /></td>
</tr>
</table>
</form>
<?php }elseif ($_REQUEST['Go']=='4' && $Action=='') {?>
<table cellspacing="1" cellpadding="0" class="table1" style="margin-top:10px;">
<tr>
<th width="20%">�ύʱ��</th>
<th width="20%">�����</th>
<th width="20%">���ʱ��</th>
<th width="20%">����</th>
<th width="20%">״̬</th>
</tr>
<?php
$total=mysql_num_rows(mysql_query("SELECT * FROM `money_order` where  number='$_SESSION[ysk_number]' $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);

$Rss="SELECT * FROM money_order where  number='$_SESSION[ysk_number]'  order by id desc {$page->limit}";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<tr class="trd">
<td><?=date("Y-m-d G:i:s",$Orzx['begtime'])?></td>
<td><?=$Orzx['kuan']?> <?=$moneytype?></td>
<td><?=$Orzx['htime']?></td>
<td><?=$Orzx['bank_type']?></td>
<td>
<?php if      ($Orzx['state']=='0') {?><span style="color:#000000">��δ����</span>
<?php }elseif ($Orzx['state']=='1') {?>
<span style="color:#FF0000">��ȷ�ϴ���</span>
<?php }elseif ($Orzx['state']=='2') {?>
<span style="color:#006600">�ӿ����</span>
<?php }  ?></td>
</tr>

<?php
}
}
?><tr class="trd">
  <td colspan="5"><?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?></td>
  </tr>
</table>
<?php }elseif ($Action=='save'){
	
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}

if (!$_REQUEST['price']){
echo "<script>alert('������Ϊ��!');window.history.back(-1);</script>";
exit();
}
if (!$_REQUEST['time']){
echo "<script>alert('���ʱ�䲻��Ϊ��!');window.history.back(-1);</script>";
exit();
}
if (!$_REQUEST['note']){
echo "<script>alert('��ע����Ϊ��!');window.history.back(-1);</script>";
exit();
}

//--------------------------------����ʽ�ȫ
get_check_price($_POST['price']);
//--------------------------------����ʽ�ȫ End

$type=strip_tags($_POST['type']);
$note=strip_tags($_POST['note']);
inject_check($_POST['type']);
inject_check($_POST['price']);

$result=mysql_query("select * from rem_account   where id='$type'",$conn1);
$yx=mysql_fetch_array($result);
if (!$yx){
echo "<script>alert('������в���Ϊ��!');window.history.back(-1);</script>";
exit();
}

$price=$_POST['price'];             //�����
$time=$_POST['time'];               //���ʱ��
$bank_type=$yx['bank_type'];     //�������
mysql_query("insert into `money_order` (bank_type,kuan,htime,content,number,begtime) " . "values ('$bank_type','$price','$time','$note','$_SESSION[ysk_number]','$begtime')",$conn1);
echo "<script>alert('�ύ�ɹ�!');self.location=document.referrer;</script>";
exit();
	
}elseif ($Action=='save1') {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}

$result=mysql_query("select * from one_cartoon  where account='$_REQUEST[account]' and password='$_REQUEST[password]' ",$conn1);
$yx_cz=mysql_fetch_array($result);
if ($yx_cz){
if ($yx_cz['states']=='1'){
echo "<script language=\"javascript\">alert('�Բ��𣬳�ֵ���ѱ����');window.history.back(-1);</script>";  
exit(); 
}
$czkuan=$yx_us[kuan]+$yx_cz[price];
mysql_query("update one_cartoon set states='1',username='$_SESSION[ysk_number]',begtime='$begtime' where id='$yx_cz[id]' ",$conn1); 
mysql_query("insert into `details_funds` (title,incomes,spendings,befores,afters,number,begtime) " .
"values ('��ֵ��$_REQUEST[account]��ֵ','$yx_cz[price]','0','$yx_us[kuan]','$czkuan','$_SESSION[ysk_number]','$begtime')",$conn1);
mysql_query("update members set kuan=kuan+$yx_cz[price]  where number='$_SESSION[ysk_number]' ",$conn1); 
echo "<script>alert('��ֵ�ɹ�!');self.location=document.referrer;</script>";
}else{
echo "<script language=\"javascript\">alert('�Բ��𣬳�ֵ���˻����������');window.history.back(-1);</script>";  
exit(); 
}

}?>
</div>
</body>
</Html>