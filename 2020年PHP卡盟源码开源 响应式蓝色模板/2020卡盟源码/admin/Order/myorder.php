<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
$id=inject_check($_GET['id']);
$Action=strip_tags($_GET['Action']);
$ord_sql=mysql_query("select * from product_order where orderid='$id' ",$conn1);  ####����
$order=mysql_fetch_array($ord_sql);
if ($order['id']==''){
echo "<br><br><br><br><center>����ʧ�ܣ������쳣</center>";
exit();	
}

if ($order['docking']!=0){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ�û���ҵ��ö���ѽ!";
exit();
}


if ($order['sid']!=0){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ�û���ҵ��ö���ѽ!";
exit();
}


$greturn=mysql_query("select * from members where number='$order[number]'",$conn1);       ####������
$gmz_row=mysql_fetch_array($greturn);
$preturn=mysql_query("select * from complaints_feedback where orerno='$id'",$conn1); ####��ȡ����ʱ��
$fee_row=mysql_fetch_array($preturn);
$yx_us_result=mysql_query("select * from members where number='$order[username]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);

if ($order['locks']!=0){
//��ȡ�Խ�ƽ̨����
$sup_result=mysql_query("select * from sup_members_site where id='$order[locks]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//��ȡ���ݿ�����
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'");
$doc_sql=mysql_query("select * from product_order where orderid='$id' ",$conn3);        
$doc=mysql_fetch_array($doc_sql);

}

if ($fee_row['time']){
$dates=$fee_row['time'];
}else{
$dates=$order['refundtime'];
}
?>
</head>
<body>
<?php if ($Action=='') {?>
<form action="?Action=save&id=<?=$_REQUEST['id']?>" method="post">
<table cellspacing="1" cellpadding="3" class="table4">
<?php
$results=mysql_query("select * from refund_event where sid='$order[orderid]'",$conn1);  
$rs=mysql_fetch_array($results);
$aa=mysql_num_rows($results);
if($aa!=0){
?>
<tr><th colspan="4" align="left"><span style="color:#FF0000">�˿�ԭ��</span></th></tr>
<tr>
<td width="14%" height="32" align="right" bgcolor="#F1FAFF">���⣺</td>
<td colspan="3" align="left" class="tdleft"><?=$rs['title']?></td>
</tr>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">���ݣ�</td>
<td colspan="3" align="left" class="tdleft"><?=$rs['content']?></td>
</tr>
<?php } ?>
<tr><th colspan="4" align="left">������ϸ</th></tr>
<tr>
<td width="14%" height="32"  class="tdleri">������ţ�</td>
<td width="32%" align="left" class="tdleft"><?=$order['orderid']?></td>
<td width="16%" class="tdleri">�ύʱ��/����ʱ�䣺</td>
<td width="38%" class="tdleft"><?=date("Y-m-d G:i:s",$order['time'])?> / 
<?php      if ($order['begtime']!=''){?>
<?=date("Y-m-d G:i:s",$order['begtime'])?>
<?php  }elseif($order['refundtime']!=''){?>
<?=date("Y-m-d G:i:s",$order['refundtime'])?>
<?php } ?>
</td>
</tr>
<tr>
<td width="14%" height="32"  class="tdleri">����״̬��</td><td colspan="3"class="tdleft"><?php
$yordeal=new oo_order();  
echo $yordeal->yordeal($order['trading'])?>
</td>
</tr>
<?php if ($order['custom1']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom1']?>��</td><td colspan="3"class="tdleft"><?=$order['content1']?></td></tr>
<?php }?>
<?php if ($order['custom2']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom2']?>��</td><td colspan="3"class="tdleft"><?=$order['content2']?></td></tr>
<?php }?>
<?php if ($order['custom3']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom3']?>��</td><td colspan="3"class="tdleft"><?=$order['content3']?></td></tr>
<?php }?>
<?php if ($order['custom4']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom4']?>��</td><td colspan="3"class="tdleft"><?=$order['content4']?></td></tr>
<?php }?>
<?php if ($order['custom5']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom5']?>��</td><td colspan="3"class="tdleft"><?=$order['content5']?></td></tr>
<?php }?>
<?php if ($order['custom6']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom6']?>��</td><td colspan="3"class="tdleft"><?=$order['content6']?></td></tr>
<?php }?>
<?php if ($order['custom7']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom7']?>��</td><td colspan="3"class="tdleft"><?=$order['content7']?></td></tr>
<?php }?>
<?php if ($order['custom8']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$order['custom8']?>��</td><td colspan="3"class="tdleft"><?=$order['content8']?></td></tr>
<?php }?>
<tr><th colspan="4" align="left">��Ʒ��Ϣ</th></tr>
<tr>
<td width="14%" height="32" class="tdleri">��Ʒ���ƣ�</td>
<td width="32%" align="left" class="tdleft"><?=$order['title']?></td>
<td width="16%" class="tdleri">������</td>
<td width="38%" class="tdleft"><?=$yx_us['company']?> ��<?=$order['username']?>��
������<?php
$yx_pingjia=new integral();  
echo $yx_pingjia->seller_integral(($yx_us['praise1']-$yx_us['praise3']))?> 
</td>
</tr>

<tr>
<td width="14%" height="32" class="tdleri">����|����|�ܼۣ�</td>
<td colspan="3" align="left" class="tdleft"><?=$order['buyprice']?> Ԫ | <?=$order['nums']?> �� | <?=$order['zongprice']?> Ԫ</td>
</tr>
<tr><th colspan="4" align="left">�ͻ���Ϣ</th></tr>
<tr>
<td width="14%" height="32" class="tdleri">����ͻ���</td>
<td width="32%" align="left" class="tdleft"><?=$order['number']?> 
������<?php
$yx_pingjia=new integral();  
echo $yx_pingjia->Buyers_integral(($gmz_row['praise4']-$gmz_row['praise6']))?></td>
<td width="16%" class="tdleri">����IP</td>
<td width="38%" class="tdleft"><?=$order['youip']?>-<?=$order['network']?></td>
</tr>
<tr><th colspan="4" align="left">��������</th></tr>

<tr>
<td width="14%" height="32" class="tdleri">�˿�״̬��</td>
<td colspan="3"  class="tdleft">
<?php if  ($order['refund']=='1') {?><span style="font-weight:bold;color:red">�����˿�</span><?php }?>
<?php if  ($order['refund']=='2') {?><span style="font-weight:bold;color:#999999">ȡ���˿�</span><?php }?>
<?php if  ($order['refund']=='3') {?><span style="font-weight:bold;color:red">�˿�ʧ��</span><?php }?>
<?php if  ($order['refund']=='4') {?><span style="font-weight:bold;color:#00a000">�˿�ɹ�</span><?php }?></td>
</tr>
<tr>
<td width="14%" height="32" class="tdleri">�˵���ʽ��</td>
<td colspan="3"  class="tdleft"><input name="yo3" type="radio" value="1" checked="checked" /> 
�ͻ��е������������˵�</td>
</tr>
<tr>
<td width="14%" height="32" class="tdleri"><span class="tdleft">�˿ʽ</span>��</td>
<td colspan="3"  class="tdleft"><input name="yo4" type="radio" value="1" checked="checked" /> ȫ���˿�
<input name="yo4" type="radio" value="0" /> �����˿�
<input name="yo4" type="radio" value="2" /> ���˿�
</td>
</tr>
<tr>
<td width="14%" height="32" class="tdleri"><span class="tdleft">��ע��Ϣ</span>��</td>
<td colspan="3"  class="tdleft">
<input name="reply" type="text" id="reply" class="biankuan"  style="width:400px" value="<?=$order['reply']?>"/></td>
</tr>
<tr>
<td height="62" colspan="4" align="center" >
<?php if ($order['trading']!='3' && $order['refund']!='2'  && $order['refund']!='4' ) {?>
<input name="�ύ" type="submit" class="chaxun_input"  value="ȷ�ϴ���"/>
<?php }else{ ?>
�ö����Ѿ�������ˣ�
<?php } ?>
</td>
</tr>
</table>
<table cellspacing="1" cellpadding="3" class="table4" style="margin-top:10px;">
<tr bgcolor="#ecf5ff">
<th>�ͻ�</th>
<th>��������</th>
<th>�䶯����</th>
<th>���׽��</th>
<th>��������</th>
</tr>
<?php
$Rss="SELECT * FROM details_funds  where orderid like '%$order[orderid]%'   order by begtime desc,id desc ";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){

$sqll="select * from members where number='$Orzx[number]'";   //��ȡ���ݱ�
$zycl=mysql_query($sqll,$conn1);  //ִ�и�SQl���
$rowl=mysql_fetch_array($zycl);
?>
<tr>
<td align="center"><?=$rowl['username']?><span class="cidcss">(<?=$Orzx['number']?>)</span></td>
<td align="center"><?=$Orzx['title']?></td>
<td align="center">
<?php if      ($Orzx['incomes']==0 && $Orzx['spendings']==0  ) {?>
-
<?php }elseif ($Orzx['afters'] > $Orzx['befores']) {?>
<font color="#0000FF">����</font>
<?php }else{?>
<font color="#ff0000">����</font>
<?php }?>
</td>
<td align="center">
<?php if ($Orzx['afters']-$Orzx['befores']>=0) {?>
<?=number_format($Orzx['incomes'],3)?> 
<?php }else{?>
<?=number_format($Orzx['spendings'],3)?>
<?php } ?>
</td>
<td align="center"><?=date("Y-m-d G:i:s",$Orzx['begtime'])?></td>
</tr>
<?php
 }
 }?>
</table>
</form>
<?php
//------------------------------ִ�ж�������
}elseif ($Action=='save'  && $order['trading']!='3') {
$yo4=inject_check($_POST['yo4']);
$reply=strip_tags($_POST['reply']);
$total=mysql_num_rows(mysql_query("select * from `details_funds` where orderid='$id' and   title='�����˿�' ",$conn1));
//-------------------Ԥ������˿�
if ($total!=0){
echo "<br><br><br><br><center>����ʧ�ܣ��ö��������쳣����</center>";
exit();
}

//-------------���������� ���˿����
if ($yo4=='2'){
mysql_query("update `product_order`  set refund=3  where orderid='$id' ",$conn1); ///////���¶���
if ($order['locks']!=0){
mysql_query("update `product_order`  set refund=3  where orderid='$id'",$conn3); ///////����ƽ̨����
}
//-------------�����������
}else{
$zongas=$order['zongas'];##�ܳ��
##############################################################################ȫ���˿�	
if ($yo4==1 or $order['overdue']=='0'){
$zong=$order['zongprice'];
if ($order['locks']!=0){$doczong=$doc['zongprice'];}
}else{ 
##############################################################################�����˿�  
$Single_days=Ysk_Single_days($order['overdue'],$order['begtime'],$dates);
if ($Single_days<0){
echo "<br><br><br><br><center>����ʧ�ܣ��ö����ѹ��ڣ���</center>";
exit();
}
$zong=Ysk_Single_back($order['overdue'],$order['begtime'],$dates,$order['zongprice']);
if ($order['locks']!=0){$doczong=Ysk_Single_back($order['overdue'],$order['begtime'],$dates,$doc['zongprice']);}
}
//-------��֤�Ƿ�����ɵĶ��� �������۳�������Ѻ��
if ($order['trading']!=0 and $order['username']!='') {
if (($yx_us['frozen_kuan']-$yx_us['min_amount'])-$zong<0) {
echo "<script>alert('�Բ��𣬹����̶�������޷��˵�!');self.location=document.referrer;</script>";
exit();
}
}
//-------��֤�Ƿ�����ɵĶ��� �������۳�������Ѻ�� The End
$kou_kuan=$zong;                     ////������ʵ��Ҫ�۵��Ŀ� ����۸�+��ɼ۸�
$jia_kuan=$gmz_row['kuan']+$zong;    ////�����˼ӿ�
//---------------------------------------------------------------------------------------------------------------////�����ʽ���ϸ
if ($order['trading']!=0 && $order['trading']!=1){
$kou_title='��Ѻ��'.number_format($kou_kuan,3).'Ԫ';
mysql_query("insert into `supplier_refund` (title,price1,price2,price3,content,username,begtime) " . "values ('$_REQUEST[id] �����˿�','$zong','$zongas','$zong','$kou_title','$order[username]','$begtime')",$conn1);///////////�������˿���ϸ
mysql_query("update `members`  set frozen_kuan=frozen_kuan-$kou_kuan where number='$yx_us[number]'",$conn1); 
//----------------------------------------------------------------------------------------------------------------////�����ʽ���ϸ End
}
//---------------------------------------------------------------------------------------------------------------------////��Ա�ʽ���ϸ
mysql_query("insert into `details_funds` (title,orderid,incomes,befores,afters,number,begtime) " . "values ('�����˿�','$id','$zong','$gmz_row[kuan]','$jia_kuan','$order[number]','$begtime')",$conn1);
mysql_query("update `members`        set kuan='$jia_kuan'  where number='$order[number]'",$conn1); 
//--------------------------------------------------------------------------------------------------------------------////��Ա�ʽ���ϸ End

//------------------------------------------------------------------------------////ƽ̨��Ա�ʽ���ϸ
if ($order['locks']!=0){
$greturn1=mysql_query("select * from members where number='$doc[number]'",$conn3); 
$doc_us=mysql_fetch_array($greturn1);
$doc_luan=$doczong+$doc_us['kuan'];
mysql_query("insert into `details_funds` (title,orderid,incomes,befores,afters,number,begtime) " . "values ('�����˿�','$id','$doczong','$doc_us[kuan]','$doc_luan','$doc[number]','$begtime')",$conn3);
mysql_query("update `members`  set kuan='$doc_luan'  where number='$doc[number]'",$conn3); 
///////����ƽ̨����
mysql_query("update `product_order`  set trading='3',reply='$reply',refund=4  where orderid='$id'",$conn3);
}
//------------------------------------------------------------------------------////ƽ̨��Ա�ʽ���ϸ
///////���¶���
mysql_query("update `product_order`  set trading='3',reply='$reply',refund=4  where orderid='$id'",$conn1);




//-------------����������� The End
}

echo "<br><br><br><br><center><input id='btnAll' type='button' value='����ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}
?>
</body>
</Html>
<script>
function cl(){ 
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>