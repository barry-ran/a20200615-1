<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
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
$keywords=strip_tags($_GET['keywords']);
$state=strip_tags($_GET['state']);
$seey=strip_tags($_GET['seey']);
$Action=strip_tags($_GET['Action']);
$Del=strip_tags($_GET['Del']);
if ($Action=='mylove'){
$orderid=$_POST['ID_Dele'];
for($i=0;$i<count($orderid);$i++){ 
//��ȡ����
$oresult=mysql_query("select * from product_order  where id='$orderid[$i]' and username='$_SESSION[ysk_number]'",$conn1);
$order=mysql_fetch_array($oresult);
//----------------------------------û�в�ѯ������
if ($order['id']==''){
echo "<script>alert('����ʧ�ܶ����쳣!');;self.location=document.referrer;</script>";
exit();
}
$total=mysql_num_rows(mysql_query("select * from `details_funds` where orderid='$orderid[$i]' and   title='�����˿�' ",$conn1));
//-------------------Ԥ������˿�
if ($total!=0){
echo "<script>alert('����ʧ�ܣ��ö��������쳣����');;self.location=document.referrer;</script>";
exit();
}
$zongas=number_format($order['zongas'],3);
if ($order['locks']!=0){
$sup_result=mysql_query("select * from sup_members_site where id='$order[locks]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'");
$doc_sql=mysql_query("select * from product_order where orderid='$order[orderid]' ",$conn3);        
$doc=mysql_fetch_array($doc_sql);
}
//������֤�Ƿ�ö����˿��
$total=mysql_num_rows(mysql_query("select * from `details_funds` where orderid='$order[orderid]' and   title='�����˿�' ",$conn1));
if ($total==0 && $doc['refund']==1){
$uresult=mysql_query("select * from members  where number='$order[number]'",$conn1);
$user=mysql_fetch_array($uresult);

if ($Del=='ȫ���˿�'){
$zongprice=number_format($order['zongprice'],3);
$jia_kuan=$user['kuan']+$zongprice;  

mysql_query("insert into `details_funds` (title,orderid,incomes,befores,afters,number,begtime) " . "values ('�����˿�','$order[orderid]','$zongprice','$user[kuan]','$jia_kuan','$order[number]','$begtime')",$conn1);
mysql_query("update `members`       set kuan='$jia_kuan'  where number='$order[number]'",$conn1); 
mysql_query("update `product_order` set trading='3',refund='4' where orderid='$order[orderid]'",$conn1); 
if ($order['locks']!=0){
$greturn1=mysql_query("select * from members where number='$doc[number]'",$conn3); 
$doc_us=mysql_fetch_array($greturn1);
$doc_luan=$doc['zongprice']+$doc_us['kuan'];
mysql_query("insert into `details_funds` (title,orderid,incomes,spendings,befores,afters,number,begtime) " . "values ('�����˿�','$order[orderid]','$doc[zongprice]','0','$doc_us[kuan]','$doc_luan','$doc[number]','$begtime')",$conn3);
mysql_query("update `members`        set kuan='$doc_luan'  where number='$doc[number]'",$conn3); 
mysql_query("update `product_order` set trading='3',refund='4' where orderid='$order[orderid]'",$conn3); 
}
}else{
//////==�����˿�
$Single_days=Ysk_Single_days($order['overdue'],$order['begtime'],$order['refundtime']);
if ($Single_days>0){
$zong=Ysk_Single_back($order['overdue'],$order['begtime'],$order['refundtime'],$order['zongprice']);    
if ($order['locks']!=0){
$doczong=Ysk_Single_back($order['overdue'],$order['begtime'],$dates,$doc['zongprice']);
}  
$jia_kuan=$user['kuan']+$zong;  

mysql_query("insert into `details_funds` (title,orderid,incomes,befores,afters,number,begtime) " . "values ('�����˿�','$order[orderid]','$zong','$user[kuan]','$jia_kuan','$order[number]','$begtime')",$conn1);
mysql_query("update `members`       set kuan='$jia_kuan'  where number='$order[number]'",$conn1); 
mysql_query("update `product_order` set trading='3',refund='4' where orderid='$order[orderid]'",$conn1); 

//------------------------------------------------------------------------------////ƽ̨��Ա�ʽ���ϸ
if ($order['locks']!=0){
$greturn1=mysql_query("select * from members where number='$doc[number]'",$conn3); 
$doc_us=mysql_fetch_array($greturn1);
$doc_luan=$doc['zongprice']+$doc_us['kuan'];
mysql_query("insert into `details_funds` (title,orderid,incomes,spendings,befores,afters,number,begtime) " . "values ('�����˿�','$order[orderid]','$doczong','0','$doc_us[kuan]','$doc_luan','$doc[number]','$begtime')",$conn3);
mysql_query("update `members`        set kuan='$doc_luan'  where number='$doc[number]'",$conn3); 
mysql_query("update `product_order` set trading='3',refund='4' where orderid='$order[orderid]'",$conn3); 
}
//------------------------------------------------------------------------------////ƽ̨��Ա�ʽ���ϸ
}
}
}
}
echo "<script>alert('����ɹ�!');;self.location=document.referrer;</script>";
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="right">

<form action="tuikuan.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2" >
<tr>
<td height="32" class="td_left">
�����ؼ��ʣ�</td>
<td class="left">
<input name="keywords" type="text" maxlength="20" id="keywords" /> <select name="seey" id="seey">
<option value="number" selected="selected">�ͻ����</option>
<option value="orderid">�������</option>
<option value="content1">��ֵ�˺�</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯ������</td>
<td class="left">
<select name="state" id="state">
<option selected="selected" value="">ȫ��</option>
<option value="1">�����˿�</option>
<option value="2">ȡ���˿�</option>
<option value="3">�˿�ʧ��</option>
<option value="4">�˿�ɹ�</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">��ѯʱ��Σ�</td><td class="left"><?php include_once('../../jhs_config/time.php');?></td>
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
<td width="4%" height="32" class="table_top">ѡ��</td>
<td width="34%" class="table_top">��Ʒ</td>
<td width="14%" class="table_top">�������</td>
<td width="10%" align="center" class="table_top">��ֵ�˻�</td>
<td width="4%" class="table_top">����</td>
<td width="7%" class="table_top">�ͻ����</td>
<td width="7%" class="table_top">�����̱��</td>
<td width="12%" class="table_top">�ύʱ�� </td>
<td width="8%" class="table_top">״̬��ϸ</td>
</tr>
<?php
$search="where  refund=1 and sid=0  "; 
if ($StartYear!='' and $EndYear!='') $search.=" and time >=$muyou1 and time <=  $muyou2 "; 
if ($keywords!='') $search.=" and $seey like '%$keywords%' "; 
if ($state!='')    $search.=" and refund = '$state' "; 
$total=mysql_num_rows(mysql_query("select * from `product_order`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql=mysql_query("select * from product_order  $search order by time desc,id desc  {$page->limit}",$conn1);
while ($row=mysql_fetch_array($sql)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td height="28"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></td>
<td align="left"><?=$row['title']?><br><span style="color:#F00"><?=yx_product_class($row['directory'])?></span></td>
<td ><?=$row['orderid']?></td>
<td align="left"><?=$row['content1']?></td>
<td><?=$row['nums']?></td>
<td> <span style="color:#666"><?=$row['number']?></span></td>
<td> <span style="color:#666"><?=$row['username']?></span></td>
<td style="text-align:center"><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td>
<a  href="#art1" onClick="art.dialog.open('Order/myorder.php?id=<?=$row[orderid]?>',{ title:'ֱ��ƽ̨������ϸ��¼',width:900,height:400,lock: true,fixed:true});">
<?php        if ($row['refund']=='1') {?>
<span class='complaint0'>�����˿�</span>
<?php    }elseif($row['refund']=='2') {?>
<span class='complaint3'>ȡ���˿�</span>
<?php    }elseif($row['refund']=='3') {?>
<span class='complaint1'>�˿�ʧ��</span>
<?php    }elseif($row['refund']=='4') {?>
<span class='complaint2'>�˿�ɹ�</span>
<?php } ?></a></td>
</tr>
<?php
}
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="21%" align="left" style="padding-top:15px; padding-bottom:15px;">
<input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input" />
<?php if ($sup_order_refund=='0') {?>
<input type="submit" name="Del" id="Del" value="�˿�" class="x2_input">
<input type="submit" name="Del" id="Del" value="ȫ���˿�" class="x4_input">
<?php } ?>
</td>
<td width="79%" align="center" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?>  </td>
</tr>
</table>
</form>

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