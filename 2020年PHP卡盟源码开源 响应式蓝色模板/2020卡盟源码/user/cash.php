
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<!-- ���Ԫ�� ��ʼ -->
<link href="css/rightload.css" type="text/css" rel="stylesheet">
<!-- ���Ԫ�� ���� -->

<!-- jQueryԪ�� ��ʼ -->
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQueryԪ�� ���� -->

<!-- ����Ԫ�� ��ʼ -->
<link href="css/style.css" rel="stylesheet" type="text/css">
<!-- ����Ԫ�� ���� -->

<!-- ��ЧԪ�� ��ʼ -->
<script src="css/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<!-- ��ЧԪ�� ���� -->

<!-- ����Ԫ�� ��ʼ -->
<script type="text/javascript" src="css/util/RSA.js"></script>  
<script type="text/javascript" src="css/BigInt.js"></script>  
<script type="text/javascript" src="css/Barrett.js"></script>
<!-- ����Ԫ�� ���� -->

<!-- ����Ԫ�� ��ʼ -->
<script src="css/layer.js"></script><link rel="stylesheet" href="css/layer.css?v=3.0.3303" id="layuicss-skinlayercss">
<!-- ����Ԫ�� ���� -->
<style type="text/css">
	.red_money_parent{display:none; width: 100%; height: 100%; position: fixed; z-index: 2; top: 0px; left: 0px; overflow: hidden;}
</style>
<script type="text/javascript">
	window.onscroll = function(){ 
		var t = document.documentElement.scrollTop || document.body.scrollTop;  
		if(window.frames["right"].document.getElementById("input_top")!=null){
			window.frames["right"].document.getElementById("input_top").value = t;
		}
		
	};
</script>
<link href="images/right.css" rel="stylesheet" type="text/css" />
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
<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
include_once('../jhs_config/error.php');
$StartYear=strip_tags($_GET['StartYear']);
$StartMonth=strip_tags($_GET['StartMonth']);
$StartDay=strip_tags($_GET['StartDay']);
$StartHour=strip_tags($_GET['StartHour']);
$StartMinute=strip_tags($_GET['StartMinute']);
$EndYear=strip_tags($_GET['EndYear']);
$EndMonth=strip_tags($_GET['EndMonth']);
$begtime=strip_tags($_POST['begtime']);         //ʱ��
$EndDay=strip_tags($_GET['EndDay']);
$EndHour=strip_tags($_GET['EndHour']);
$EndMinute=strip_tags($_GET['EndMinute']);
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
?>
<div class="ifra-right_con">
		<h3 class="column-title">
			<b id="title">��������</b>
			<span class="col-t-g">
				<input id="tab" value="1" type="hidden">
				<input tab="1" name="clickTitle"  onclick="window.location = 'AccountMoneyHistory.php'" type="button" value="���ּ�¼" class="spl-btn">
			</span>
		</h3>
		<div id="rechargeBox">

<?php if ($_REQUEST['Go']=='1') {?>
<form action="?Action=save" method="post" name="add">
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<table cellspacing="1" cellpadding="2" class="table1" style="margin: 0">
<tr>
<td class="table1_left">��</td>
<td class="tdleft"><span class="red"><?=$yx_us['kuan']?></span> <?=$moneytype?> </td>
</tr>

<tr>
<td class="table1_left"> ���ֽ� </td>
<td class="tdleft"><input name="Amount" type="text" id="Amount" class="biankuan" onKeyUp="clearNoNum(this)"  v/>
&nbsp;Ԫ  </td>
</tr>
<tr>
<td class="table1_left">�˻����ͣ� </td>
<td class="tdleft"><select name="type" id="type">
<option value="֧����">֧����</option>
<option value="�Ƹ�ͨ">�Ƹ�ͨ</option>
</select>
</td>
</tr>
<tr>
<td class="table1_left">�տ��˻��� </td>
<td class="tdleft"><input name="account" type="text" id="account" class="biankuan"/>
</td>
</tr>
<tr>
<td class="table1_left">�տ������� </td>
<td class="tdleft"><input name="rname" type="text" id="rname" class="biankuan"/>
</td>
</tr>
<tr>
<td class="table1_left">�������룺 </td>
<td class="tdleft"><input name="passwords" type="password" class="biankuan" id="passwords" placeholder="���������Ľ�������" /></td>
</tr>
<tr>
<td class="table1_left">&nbsp;</td>
<td class="tdleft">
<input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();">
<input name="button" type="button" class="fanhui_input" id="button" onClick="history.go(-1);" value="����" />
</td>
</tr>
</table>
</form>
<?php }elseif ($_REQUEST['Action']=='save') {


if (md5($_POST['passwords'])!=$yx_us['passwords']){
echo "<script language=\"javascript\">alert('����ʧ�ܣ������������');history.go(-1);</script>";
exit();
}

if (!$_POST['account']) {
echo "<script language=\"javascript\">alert('�Բ����տ��˻�����Ϊ�գ�');history.go(-1);</script>";
exit();
}

if (!$_POST['rname']) {
echo "<script language=\"javascript\">alert('�Բ����տ���������Ϊ�գ�');history.go(-1);</script>";
exit();
}


############��ȡ������
if      ($_POST['Amount']<'1000'){
$poundage=$site_charge1;
}elseif ($_POST['Amount']<'5000'){
$poundage=$site_charge2;
}elseif ($_POST['Amount']<'10000'){
$poundage=$site_charge3;
}elseif ($_POST['Amount']<'10000000'){
$poundage=$site_charge4;
}

$zong=$poundage+$_POST['Amount'];
///// �ж�����Ƿ�ת�� Ȼ�����ж��Ƿ��и��տ��˵ı��

if ($_POST['Amount']<0){
echo "<script>alert('�Բ��𣬽���쳣����Ϊ�գ�');history.go(-1);</script>";exit();
}

if ($yx_us['kuan']<0){
echo "<script>alert('�Բ��𣬽���쳣����Ϊ�գ�');history.go(-1);</script>";exit();
}


if ($yx_us['kuan']<$zong) {
echo "<script language=\"javascript\">alert('�Բ��������˻�������');history.go(-1);</script>";
exit();
}

if ($_POST['Amount']<0) {
echo "<script language=\"javascript\">alert('�Բ������ֽ��ܵ���0��');history.go(-1);</script>";
exit();
}

//*******************************************************************���ĺڿ��޸�ģ��
get_check_price($_POST['Amount']);
get_check_price(($yx_us['kuan']-$zong));
get_check_price($yx_us['kuan']);
//*******************************************************************���ĺڿ��޸�ģ�� The End

$type=strip_tags($_POST['type']);
$account=strip_tags($_POST['account']);
$rname=strip_tags($_POST['rname']);
$Amount=strip_tags($_POST['Amount']);
/////��¼������Ϣ
mysql_query("insert into `balance_cash` (number,type,account,rname,price,audit,begtime) " .
"values ('$_SESSION[ysk_number]','$type','$account','$rname','$Amount','0','$begtime')",$conn1);



/////��¼��Ա�ʽ���ϸ
$title="�������";
$before=$yx_us['kuan'];
$after=$yx_us['kuan']-$Amount;
$after10=$yx_us['kuan']-$Amount-$poundage;
$before10=$yx_us['kuan']-$Amount;
mysql_query("insert into `details_funds` (title,incomes,spendings,befores,afters,number,begtime)"."values ('$title','0','$_REQUEST[Amount]','$before','$after','$_SESSION[ysk_number]','$begtime')",$conn1);
mysql_query("insert into `details_funds` (title,incomes,spendings,befores,afters,number,begtime)"."values ('����������','0','$poundage','$before10','$after10','$_SESSION[ysk_number]','$begtime')",$conn1);
mysql_query("update members set kuan='$after10'   where number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
exit();

}?>

<?php if ($_REQUEST['Go']=='2') {?>
<form action="Cash.php?Go=2" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2" >
<tr>
<td height="32" class="td_left">��ѯʱ��Σ�</td>
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
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table4" width="100%">
<tr>

<td width="18%" align="center" class="table_top">��������</td>
<td width="12%" align="center" class="table_top">��������</td>
<td width="24%" align="center" class="table_top">�˻��˻�</td>
<td width="14%" align="center" class="table_top">�տ�����</td>
<td width="15%" align="center" class="table_top">���ֽ��</td>
<td width="17%" align="center" class="table_top">״̬</td>
</tr>
<?php
$search="where  number='$_SESSION[ysk_number]'"; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=$muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `balance_cash`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from balance_cash $search order by begtime desc,id desc {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center"><?=$row['type']?></td>
<td align="center"><?=$row['account']?></td>
<td align="center"><?=$row['rname']?> </td>
<td align="center"><?=$row['price']?></td>
<td align="center">
<?php if ($row['audit']=='0'){?>
<font color="red">�ȴ�����</font>
<?php }else{?>
�ѻ������
<?php }?>
</td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td style="text-align:center; padding-top:10px;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?> </td>
</tr>
</table>
</form>

<?php } ?>

</div>
</div>
</body>
</Html>