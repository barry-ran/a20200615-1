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

////////����ɾ��
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));
foreach($allArray as $value){
$back_result=mysql_query("select * from details_funds  where id='$value'",$conn1);
$back=mysql_fetch_array($back_result);
ysk_date_log(3,$_SESSION['ysk_username'],'ɾ����һ�� "'.$back['number'].'" ��Ա���ʽ���ϸ ��������Ϊ��'.$back['title'].'',$value);
$total=mysql_num_rows(mysql_query("select * from `details_funds_back` where uid='$value'",$conn1));
if($total==0){
mysql_query("insert into details_funds_back set pid='$back[id]',orderid='$back[orderid]',title='$back[title]',incomes='$back[incomes]',spendings='$back[spendings]',befores='$back[befores]',afters='$back[afters]',number='$back[number]',feilv='$back[feilv]',begtime='$back[begtime]'",$conn1);
}else{
mysql_query("update details_funds_back set  orderid='$back[orderid]',title='$back[title]',incomes='$back[incomes]',spendings='$back[spendings]',befores='$back[befores]',afters='$back[afters]',number='$back[number]',feilv='$back[feilv]',begtime='$back[begtime]' where pid='$value'",$conn1);
}
mysql_query("delete from details_funds where id ='$value'",$conn1);
}
echo "<script>alert('ɾ���ɹ�!');window.location='?Action=List';</script>";
exit();
}
?>
<?php if  ($Action=="List" or $Action==""){?>
<form action="DetailsFunds.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td class="td_left">
�ͻ���ţ�</td>
<td class="left" colspan="2">
<input name="keywords" type="text" maxlength="25" id="keywords"  class="biankuan"/>
</td>
</tr>
<tr>
<td height="32" class="td_left">
�������ͣ�</td>
<td class="left" colspan="2">
<select name="title" id="title">
<option value="" selected="selected">ȫ������</option>
<option value="����">�����ۿ�</option>
<option value="����">��������</option>
<option value="�˿�">�����˿�</option>
<option value="�ӿ�">�ӿ�/����</option>
<option value="��ֵ">�����ۿ�</option>
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
<table cellspacing="1" cellpadding="0" class="page_table4" width="100%">
<tr>
<td width="3%" height="32" align="center" class="table_top">ID</td>
<td width="10%" align="center" class="table_top"> �ͻ� </td>
<td width="27%" align="center" class="table_top"> �������� </td>
<td  width="6%" align="center" class="table_top"> �䶯���� </td>
<td  width="11%" align="center" class="table_top"> ���׽�� </td>
<td  width="12%" align="center" class="table_top"> �仯ǰ(Ԫ) </td>
<td  width="16%" align="center" class="table_top"> �仯��(Ԫ) </td>
<td width="15%" align="center" class="table_top"> �������� </td>
</tr>
<?php
$keywords=$_REQUEST['keywords'];             //�����ؼ���
$recent=$_REQUEST['recent'];                 //��������
$title=$_REQUEST['title'];                   //��������
$search="where 1=1 "; 
if ($StartYear!='' ) $search.="and begtime >=$muyou1 and begtime <=  $muyou2 "; 
if ($keywords!='') $search.="and number like '%$keywords%' "; 
if ($title!='') $search.="and title like '%$title%'"; 
$total=mysql_num_rows(mysql_query("select * from `details_funds` $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from `details_funds` $search order by begtime desc,id asc {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></td>
<td align="center">
<?=$row['number']?></td>
<td align="left"><?=$row['orderid']?> <?=$row['title']?></td>
<td align="center">
<?php if ($row['incomes']==0 && $row['spendings']==0  ) {?>
-
<?php }elseif ($row['afters'] > $row['befores']) {?>
<font color="#0000FF">����</font>
<?php }else{?>
<font color="#ff0000">����</font>
<?php }?>

</td>
<td align="center">
<?php if ($row['afters'] > $row['befores']) {?>
<?=number_format($row['incomes'],3);?> Ԫ
<?php }else{?>
<?=number_format($row['spendings'],3);?> Ԫ
<?php }?>
</td>
<td align="center"><?=number_format($row['befores'],3);?> Ԫ</td>
<td align="center"><?=number_format($row['afters'],3);?> Ԫ</td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="17%" align="left" style="padding-top:15px; padding-bottom:15px;">
<input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input" />
<input type="submit" name="Del" id="Del" value="ɾ��" onclick="Javascript:return confirm('ȷ��Ҫɾ����');" class="x3_input" >
</td>
<td width="83%" style="text-align:center;">
<?php if ($total!=0){?><?=$page->paging();?><?php }?>    </td>
</tr>
</table>
</form>
</div>

<?php } ?>
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