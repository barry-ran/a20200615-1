<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Welcome</title>
<link href="images/sup1.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];?>
<?php include('head.php');?>
<?php if ($Action==''){?>
<div id="biankuan5y"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="57%" height="32" valign="middle" style="padding-top:8px;">
<?php if($_REQUEST['p']==1) { ?>
<a href="search.php?p=1&hq=<?=$_REQUEST['hq']?>" class="theme0_1">Ĭ������</a>
<?php }else{?>
<a href="search.php?p=1&hq=<?=$_REQUEST['hq']?>" class="theme0_2">Ĭ������</a>
<?php } ?>
<?php if($_REQUEST['p']==2) { ?>
<a href="search.php?hq=<?=$_REQUEST['hq']?>" class="theme1_2">��������</a>
<?php }else{?>
<a href="search.php?p=2&hq=<?=$_REQUEST['hq']?>" class="theme1_1">��������</a>
<?php } ?>

</td>
<td width="9%" align="center" style="padding-top:8px;">
<?php if($_REQUEST['p']==3) { ?>
<a href="search.php?p=4&hq=<?=$_REQUEST['hq']?>" class="theme2_2">�۸�</a>
<?php }elseif($_REQUEST['p']==4) { ?>
<a href="search.php?p=3&hq=<?=$_REQUEST['hq']?>" class="theme2_3">�۸�</a>
<?php }else{?>
<a href="search.php?p=3&hq=<?=$_REQUEST['hq']?>" class="theme2_1">�۸�</a>
<?php } ?>
</td>
<td width="7%" align="center">���</td>
<td width="9%" align="center">����������</td>
<td width="11%" align="center">��ŵ��ֵʱ��</td>
<td width="7%" align="center">�Խ�</td>
</tr>
</table>
</div>
<div id="biankuan6y">
<form name="form1" method="post" action="?Action=mylove">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table22">
<?php
$p=$_REQUEST['p'];                 //��ѯ����
if ($_REQUEST['keywords']!=''){
$keywords=$_REQUEST['keywords'];                 //��ѯ����
$_SESSION['mykeywords']=$_REQUEST['keywords'];      
}else{
$keywords=$_SESSION['mykeywords'];
}
####����
$search="and H.modl<>'δ��' and H.locks='2' "; 
if ($keywords!='') $search.=" and H.title like '%$keywords%' "; 
if ($p=='')$sorting=" order by H.time desc,H.id desc"; 
if ($p==2) $sorting=" order by P.praise1 desc,H.id desc"; 
if ($p==3) $sorting=" order by H.price2  asc,H.id desc"; 
if ($p==4) $sorting=" order by H.price2  desc,H.id desc"; 
$total=mysql_num_rows(mysql_query("SELECT * from sup_product AS H LEFT JOIN sup_members AS P ON H.username=P.number where H.locks='2' $search  $sorting",$conn2));
$num="30";
$page=new page($total,$num);
$sql="select H.id,H.title,H.price1,H.price2,H.kucun,H.directory3,H.username,H.state,H.provinces,H.citys,P.praise1 from sup_product AS H LEFT JOIN sup_members AS P ON H.username = P.number  where H.locks='2'  $search  $sorting  {$page->limit}"; 
$zyc=mysql_query($sql,$conn2);
while ($row=mysql_fetch_array($zyc)){
$result1=mysql_query("select * from sup_product_class where NumberID='$row[directory3]'",$conn2);
$menu=mysql_fetch_array($result1);

$result2=mysql_query("select * from sup_product_class where NumberID='$menu[PartID]'",$conn2);
$menu1=mysql_fetch_array($result2);

$total=mysql_num_rows(mysql_query("SELECT * FROM `product` where sid='$row[id]' ",$conn1));
?>
<tr>
<td width="57%" height="40" valign="top">
<dl>
<?php if($total==0){?> 
<input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>">
<?php } ?>
<img src="../style/m6.jpg" />
<img src="../style/m7.jpg" /> 
<a  href="#art1" onclick="art.dialog.open('sup/show.php?id=<?=$row['id']?>',{title:'��Ʒ����',width: 800,lock:true,fixed:true});"  class="product">
<b style="color:#0066cc"><?=$row['title']?></b></a>
</dl>
<dl>�������ã�<?php
$yx_pingjia=new integral();  
echo $yx_pingjia->seller_integral($row['praise1'])?>

</dl>
<dl>��������<?php
$yx_area=new area();  
echo $yx_area->region($row['provinces'],$row['citys'])?>
</dl>
<dl>��Ʒ״̬��<?=ysk_state($row['state'])?></dl>

<dl>��Ʒ���ࣺ<?=$menu1['7']?>-<?=$menu['7']?></dl>
<dl>��Ϸ/��ֵ��<?=number_format($row['price2'],3);?> Ԫ</dl></td>
<td width="9%" align="center" valign="top" style="color:#ff6600; font-weight:bold; font-family:Arial, Helvetica, sans-serif; padding-top:15px;"><?=number_format($row['price2'],3);?> Ԫ</td>
<td width="7%" align="center" valign="top" style="padding-top:15px;">
<?php
if  ($row['modl']=='����' || $row['modl']=='ѡ��'){
$kucun_total=mysql_num_rows(mysql_query("SELECT * FROM `sup_import_goods` where  pid='$yx_pro[sid]' and locks=0 ",$conn2));
$kucun=$kucun_total;
}elseif($row['modl']=='����'){
$kucun="999";
}else{
$kucun=	$row['kucun'];
}
$yx_inventory=new goods();  
echo $yx_inventory->inventory($kucun)?> </td>
<td width="9%" align="center" valign="top"  style="padding-top:15px;">
<img src="../style/m4.jpg" /> ��ʱ�⸶
<dl><img src="../style/m5.jpg" /> �޻��⸶</dl>	</td>
<td width="11%" align="center" valign="top"  style="padding-top:15px;">��ֵʱ�䣺8����</td>
<td width="7%" align="center" valign="top"  style="padding-top:15px;">

<?php if($total!=0){?> 
<a  href="#"  class="a_fabu a_fabu2">�ѶԽ�</a>
<?php }else{?>
<a  href="#art1" onclick="art.dialog.open('sup/docking.php?id=<?=$row['id']?>',{title: '������ƽ̨',width:960,height:600,lock:true,fixed:true});" class="a_fabu a_fabu1">δ�Խ�</a>
<?php } ?></td>
</tr>

<?php
}
?>
<tr>
<td><input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="�����Խ�" class="x6_input" onclick="Javascript:return confirm('ȷ��Ҫ�����Խ���');" ></td>
<td colspan="5"><?=$page->paging();?></td></td>
</tr>
</table>
</form>
</div>
<?php }elseif($Action=='mylove'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));    ////�� explode �� , �����ݸ���������	
?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{
if(checkspace(document.add.rate.value)) {
document.add.rate.focus();
alert("�Բ�����Ʒ�ۼ۲���Ϊ�գ�");
return false;
}

}

function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</script>
<form name="add" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">�����Խ�</td>
</tr>
<?php foreach($allArray as $value){ 
$presult=mysql_query("select * from sup_product where id='$value'",$conn2);
$pro=mysql_fetch_array($presult);?>
<tr>
<td width="10%" class="td_left"> ��Ʒ���ƣ�</td>
<td width="90%" class="left">
<input name="ID_Dele[]" type="hidden" value="<?=$value?>" />
<input name="title[]" type="text" style="width:350px;" value="<?=$pro['title']?>" class="biankuan" /> </td>
</tr>
<?php } ?>
<tr>
<td width="10%" class="td_left"> ��Ʒ�ۼۣ�</td>
<td width="90%" class="left"><select name="pricing" id="pricing">
<option value="1">�����Ӱٷֱ�</option>
<option value="2">�����ӹ̶�ֵ</option>
</select>
<input name="rate" type="text" style="width:60px;" onkeyup="clearNoNum(this)"/>  
��������۸�100 ���ٷֱ����� ����д�� 1��ʱ�� ����1% Ҳ����ÿ������1Ԫ

</tr>
<tr>
<td width="10%" class="td_left">��Ϣ���ࣺ</td>
<td width="90%" class="left">
<div style="width: 350px; height:200px; overflow: auto; border:1px #CCC solid; padding:4px;">
<?php
$presult=mysql_query("select * from  product_class  where LagID=1 and isno3=0 order by Classorder asc,id desc",$conn1);
while($prow=mysql_fetch_array($presult)){?>
<input name="ClassID[]" type="checkbox" value="<?=$prow['NumberID']?>"  disabled="disabled"> <?=$prow['7']?> <br />
<?php
$zresult=mysql_query("select * from  product_class where  LagID=2 and  PartID='$prow[NumberID]' order by Classorder asc,id desc",$conn1);
while($pr=mysql_fetch_array($zresult)){?>
----<input name="ClassID[]" type="checkbox" value="<?=$pr['NumberID']?>"> <?=$pr['7']?><br />
<?php
}
} 
?>

</div></td>
</tr>


<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�����"  id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();"  />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=='Addsave'){
if ($_REQUEST['ClassID']==''){
echo "<script language=\"javascript\">alert('�Բ�����û��ѡ����Ʒ��ĿŶ��');history.go(-1);</script>";
exit();
}
$orderid=$_POST['ID_Dele'];
$title=$_POST['title'];
$rate=$_POST['rate'];
$pricing=$_POST['pricing'];
$ClassID= implode(",",$_POST['ClassID']);
$allArray=(explode(',',$ClassID));    ////�� explode �� , �����ݸ���������
foreach($allArray as $value) { 
$directory1=substr($value,0,4);
$directory2=substr($value,0,7);
for($i=0;$i<count($orderid);$i++){//�����������м�����Ŀ��ѭ�����θ��¡�
$presult=mysql_query("select * from sup_product where id='$orderid[$i]'",$conn2);
$pro=mysql_fetch_array($presult);

mysql_query("insert into product set pricing='$pricing',rate='$rate',kucun='$pro[kucun]',overdue='$pro[overdue]',title='$title[$i]',color='$pro[color]',directory1='$directory1',directory2='$directory2',directory3='$value',directory4='$pro[directory3]',punit='$pro[punit]',modl='$pro[modl]',buy_md='$pro[buy_md]',price='$pro[price]',price1='$pro[price1]',price2='$pro[price2]',url='$pro[url]',content='$pro[content]',focus='$pro[focus]',service='$pro[service]',time='$begtime',provinces='$pro[provinces]',citys='$pro[citys]',sid='$pro[id]',Api='$pro[Api]',Api_id='$pro[Api_id]',Api_buy_num='$pro[Api_buy_num]',Api_buy_type='$pro[Api_buy_type]',username='$pro[username]',locks=2",$conn1);
$myid=mysql_insert_id($conn1);
mysql_query("update product set paixu='$myid' where id='$myid'",$conn1); 
}
}	
echo "<script>alert('�Խӳɹ�!');;window.location='../right.php';</script>";
}?>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
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
