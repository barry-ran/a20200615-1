<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/Share_out_as.php');
$id=inject_check($_GET['id']);
$Action=strip_tags($_GET['Action']);
$od_sql=mysql_query("select * from product_order where orderid='$id' ",$conn1);        ####����
$ord=mysql_fetch_array($od_sql);

if ($ord['id']==''){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ�û���ҵ��ö���ѽ!";
exit();
}

if ($ord['docking']!=0){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ�û���ҵ��ö���ѽ!";
exit();
}


if ($ord['sid']!=0){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ�û���ҵ��ö���ѽ!";
exit();
}


$return=mysql_query("select * from members where number='$ord[username]'",$conn1);               ####������
$yx_gh=mysql_fetch_array($return);

$greturn=mysql_query("select * from members where number='$ord[number]'",$conn1);                ####������
$yx_us=mysql_fetch_array($greturn);

if ($ord['locks']!=0){
//��ȡ�Խ�ƽ̨����
$sup_result=mysql_query("select * from sup_members_site where id='$ord[locks]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//��ȡ���ݿ�����
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'");
$doc_sql=mysql_query("select * from product_order where orderid='$id' ",$conn3);        
$doc=mysql_fetch_array($doc_sql);

}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
</head>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php if ($Action=='') {?>
<form action="?Action=save&id=<?=$_REQUEST['id']?>" method="post">
<table cellspacing="1" cellpadding="3" class="table4">
<tr><th colspan="4" align="left">������ϸ</th></tr>
<tr>
<td width="14%" height="32"  class="tdleri">������ţ�</td>
<td width="32%" align="left" class="tdleft"><?=$ord['orderid']?></td>
<td width="16%" class="tdleri">�ύʱ��/����ʱ�䣺</td>
<td width="38%" class="tdleft"><?=date("Y-m-d G:i:s",$ord['time'])?> / <?php if ($ord['begtime']!=''){?><?=date("Y-m-d G:i:s",$ord['begtime'])?><?php } ?></td>
</tr>
<tr>
<td width="14%" height="32"  class="tdleri">����״̬��</td><td colspan="3"class="tdleft">
<?php
$yordeal=new oo_order();  
echo $yordeal->yordeal($ord['trading'])?>
</td>
</tr>
<?php if ($ord['custom1']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$ord['custom1']?>��</td><td colspan="3"class="tdleft"><?=$ord['content1']?></td></tr>
<?php }?>
<?php if ($ord['custom2']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$ord['custom2']?>��</td><td colspan="3"class="tdleft"><?=$ord['content2']?></td></tr>
<?php }?>
<?php if ($ord['custom3']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$ord['custom3']?>��</td><td colspan="3"class="tdleft"><?=$ord['content3']?></td></tr>
<?php }?>
<?php if ($ord['custom4']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$ord['custom4']?>��</td><td colspan="3"class="tdleft"><?=$ord['content4']?></td></tr>
<?php }?>
<?php if ($ord['custom5']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$ord['custom5']?>��</td><td colspan="3"class="tdleft"><?=$ord['content5']?></td></tr>
<?php }?>
<?php if ($ord['custom6']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$ord['custom6']?>��</td><td colspan="3"class="tdleft"><?=$ord['content6']?></td></tr>
<?php }?>
<?php if ($ord['custom7']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$ord['custom7']?>��</td><td colspan="3"class="tdleft"><?=$ord['content7']?></td></tr>
<?php }?>
<?php if ($ord['custom8']!=''){?>
<tr><td width="14%" height="32"  class="tdleri"><?=$ord['custom8']?>��</td><td colspan="3"class="tdleft"><?=$ord['content8']?></td></tr>
<?php }?>
<tr><th colspan="4" align="left">��Ʒ��Ϣ</th></tr>
<tr>
<td width="14%" height="32" class="tdleri">��Ʒ���ƣ�</td>
<td width="32%" align="left" class="tdleft"><?=$ord['title']?></td>
<td width="16%" class="tdleri">������</td>
<td width="38%" class="tdleft">
<?=$yx_gh['company']?> [<?=$ord['username']?>]
������<?php
$yx_pingjia=new integral();  
echo $yx_pingjia->seller_integral(($yx_gh['praise1']-$yx_gh['praise3']))?> </td>
</tr>

<tr>
<td width="14%" height="32" class="tdleri">����|����|�ܼۣ�</td>
<td colspan="3" align="left" class="tdleft"><?=$ord['zongprice']/$ord['nums']?> Ԫ | <?=$ord['nums']?> �� | <?=$ord['zongprice']?> Ԫ</td>
</tr>
<tr><th colspan="4" align="left">�ͻ���Ϣ</th></tr>
<tr>
<td width="14%" height="32" class="tdleri">����ͻ���</td>
<td width="32%" align="left" class="tdleft">
<?=$yx_us['company']?>  [<?=$yx_us['number']?>]
������<?php
echo $yx_pingjia->Buyers_integral(($yx_us['praise4']-$yx_us['praise5']))?></td>
<td width="16%" class="tdleri">����IP</td>
<td width="38%" class="tdleft"><?=$ord['youip']?>-<?=$ord['network']?></td>
</tr>
<tr><th colspan="4" align="left">�ֹ���ֵ������</th></tr>
<tr>
<td width="14%" height="32" class="tdleri">����ʽ��</td><td colspan="3"  class="tdleft">
<span style="font-weight: bold; color: #3b7dc2">
<input name="online" type="radio" id="online"  onclick="Permissions(this)" value="���ڴ����У�"<?php if($ord['trading']=='0'){?> checked="checked" <?php }?> >
������
</span>
<span style="font-weight: bold; color: #00a000">
<input id="online" type="radio" name="online" value="��ֵ�ɹ���" onClick="Permissions(this)"<?php if ($ord['trading']=='2'){?> checked="checked" <?php }?>>
��ֵ�ɹ�
</span>
<span style="font-weight: bold; color:red">
<input id="online" type="radio" name="online" value="δ��ֵ�����˿"  onclick="Permissions(this)" <?php if($ord['trading']=='3'){?> checked="checked" <?php }?>/>
ȡ����ֵ
</span>

</td></tr>
<tr>
<td width="14%" height="32" class="tdleri">��������ۣ�</td><td colspan="3"  class="tdleft">
<span style="font-weight: bold; color: #3b7dc2">
<input name="sell_pl" type="radio" id="sell_pl" value="1" <?php if ($ord['sell_pl']=='1' or $ord['sell_pl']=='0') {?> checked="checked" <?php }?> >
����
</span>
<span style="font-weight: bold; color: #00a000">
<input id="sell_pl" type="radio" name="sell_pl" value="2"  <?php if ($ord['sell_pl']=='2'){?> checked="checked" <?php }?>>
����
</span>
<span style="font-weight: bold; color:red">
<input id="sell_pl" type="radio" name="sell_pl" value="3" <?php if ($ord['sell_pl']=='3'){?> checked="checked" <?php }?>/>
����
</span>

</td></tr>
<tr>
<td width="14%" height="32" class="tdleri">��ֵ������Ϣ��</td><td colspan="3"  class="tdleft">
<input name="text"  id="text" type="text"  class="biankuan"  style="width:320px;" value="<?=$ord['reply']?>"/>
</td></tr>
<tr>
<td height="62" colspan="4" align="center" >
<?php if ($ord['trading']>'0') {?>
�ö����Ѿ�������ˣ�
<?php }else{?>
<input name="�ύ" type="submit" class="chaxun_input"  value="ȷ�ϴ���"/>
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
$Rss="SELECT * FROM details_funds  where orderid like '%$ord[orderid]%'   order by begtime desc,id asc ";
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
<?php } ?>
<?php if ($Action=='save' and $ord['trading']==0) {
$online=strip_tags($_POST['online']); 
$sell_pl=inject_check($_POST['sell_pl']);
$text=strip_tags($_POST['text']); 

if     ($online=='���ڴ����У�'){
$yonline='0';
}elseif($online=='��ֵ�ɹ���'){
ysk_date_log(7,$_SESSION['ysk_username'],'�������ű�� "'.$ord['orderid'].'" �Ķ���״̬����Ϊ��ֵ�ɹ���');
$yonline='2';

###############---------------------------------------------------------------------------������
$zongas=Share_out_as($yx_us['agent'],$site_as,$ord['nums'],$ord['pid'],$ord['orderid'],$ord['number']);
###############---------------------------------------------------------------------------������ The End

###############---------------------------------------------------------------------------���¹�����Ա���ʽ���ϸ
$buyprice=$ord['zongprice']-$ord['feilv']-$zongas;
$goods_kuan=$yx_gh['goods_kuan']+$buyprice;
mysql_query("insert into `goods_details` set title='��Ʒ����',orderid='$ord[orderid]',incomes='$buyprice',befores='$yx_gh[goods_kuan]',afters='$goods_kuan',number='$ord[username]',begtime='$begtime',feilv='$ord[feilv]'",$conn1);
mysql_query("update members set goods_kuan='$goods_kuan' where number='$ord[username]'",$conn1); 
###############---------------------------------------------------------------------------���¹�����Ա���ʽ���ϸ The End 
}elseif($online=='δ��ֵ�����˿'){
ysk_date_log(7,$_SESSION['ysk_username'],'�������ű�� "'.$ord['orderid'].'" �Ķ���״̬����Ϊδ��ֵ�����˿');
$yonline='3';
$jia_kuan=$yx_us['kuan']+$ord['zongprice'];
mysql_query("insert into `details_funds`(title,orderid,incomes,spendings,befores,afters,number,begtime) " . "values ('�����˿�','$id','$ord[zongprice]','0','$yx_us[kuan]','$jia_kuan','$ord[number]','$begtime')",$conn1);
mysql_query("update `members`  set kuan='$jia_kuan'  where number='$ord[number]'",$conn1); 

//----------------------------------�Խ�ƽ̨�˿�
if ($ord['locks']!=0){
$greturn1=mysql_query("select * from members where number='$doc[number]'",$conn3); 
$doc_us=mysql_fetch_array($greturn1);
$doc_kuan=$doc_us['kuan']+$doc['zongprice'];
mysql_query("insert into `details_funds`(title,orderid,incomes,spendings,befores,afters,number,begtime) " . "values ('�����˿�','$id','$doc[zongprice]','0','$doc_us[kuan]','$doc_kuan','$doc[number]','$begtime')",$conn3);
mysql_query("update `members`  set kuan='$doc_kuan'  where number='$doc[number]'",$conn3); 
}
//----------------------------------�Խ�ƽ̨�˿�

}

if      ($sell_pl=='1'){
mysql_query("update members set praise4=praise4+1 where number='$yx_us[number]'",$conn1); 
if ($ord['locks']!=0){mysql_query("update members set praise4=praise4+1 where number='$doc[number]'",$conn3); }
}elseif ($sell_pl=='2'){
mysql_query("update members set praise5=praise5+1 where number='$yx_us[number]'",$conn1); 
if ($ord['locks']!=0){mysql_query("update members set praise5=praise5+1 where number='$doc[number]'",$conn3); }
}elseif ($sell_pl=='3'){
mysql_query("update members set praise6=praise6+1 where number='$yx_us[number]'",$conn1); 
if ($ord['locks']!=0){mysql_query("update members set praise6=praise6+1 where number='$doc[number]'",$conn3); }
}

///////���¶���״̬
mysql_query("update `product_order`  set begtime='$begtime',reply='$text',trading='$yonline',sell_pl='$sell_pl',zongas='$zongas' where orderid='$id'",$conn1); 

if ($ord['locks']!=0){
mysql_query("update `product_order` set begtime='$begtime',reply='$text',trading='$yonline',sell_pl='$sell_pl',zongas='$zongas' where orderid='$id'",$conn3); 
}


echo "<br><br><br><br><center><input id='btnAll' type='button' value='����ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}
?>
</body>
</Html>
<script type="text/javascript"> 
function Permissions(obj)
{
var radioss= obj.value;
//window.self.document.form1.text.value = radioss;
window.self.document.getElementById("text").value=radioss;
} 
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