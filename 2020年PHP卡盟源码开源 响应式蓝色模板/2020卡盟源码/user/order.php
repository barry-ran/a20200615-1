<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />
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

function doPrint() { 
bdhtml=window.document.body.innerHTML; 
sprnstr="<!--startprint-->"; //��ʼ��ӡ��ʶ�ַ�����17���ַ�
eprnstr="<!--endprint-->"; //������ӡ��ʶ�ַ���
prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17); //�ӿ�ʼ��ӡ��ʶ֮�������
prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr)); //��ȡ��ʼ��ʶ�ͽ�����ʶ֮�������
window.document.body.innerHTML=prnhtml; //����Ҫ��ӡ��ָ�����ݸ���body.innerHTML
window.print(); //����������Ĵ�ӡ���ܴ�ӡָ������
window.document.body.innerHTML=bdhtml; // ���ԭҳ��
}
</script>
</head>
<body>
<?php 
include_once('../jhs_config/function.php');
$id=inject_check($_GET['id']);    #�������
$check=strip_tags($_GET['check']);#�Ƿ���վ�鿴�ö���
$Token=strip_tags($_GET['Token']);#�Ƿ񹩻��̲鿴�ö���
//------------------------------------------------------------------------------------��ȡ��վ�ƶ�
$supd_result=mysql_query("select * from sup_members_site where number='$sup_number'  ",$conn2); 
$supdoc=mysql_fetch_array($supd_result);
//------------------------------------------------------------------------------------��ȡ��������
$order_result=mysql_query("select * from product_order where  orderid='$id'",$conn1);
$order=mysql_fetch_array($order_result);

//====================================================================================��ȫ��֤

if ($order['id']==''){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ�û���ҵ��ö���ѽ!";
exit();
}

if ($check=='' && $Token=='' && $order['number']!=$_SESSION['ysk_number']){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ��Ƿ�����!";
exit();
}

if ($check=='' && $Token!='' && $order['username']!=$_SESSION['ysk_number']){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ��Ƿ�����!";
exit();
}

//====================================================================================��ȫ��֤����
if     ($order['sid']==0 && $order['docking']==0){
$import_goods='import_goods';
$pid=$order['pid'];
$datas="conn1";
}elseif($order['sid']!=0 && $order['docking']==0){
$pid=$order['sid'];
$import_goods='sup_import_goods';
$datas="conn2";
}elseif($order['pid']!=0 && $order['docking']!=0){
$import_goods='import_goods';
$pid=$order['pid'];
$datas="conn3";
//============��ȡ�Խ�ƽ̨����
$sresult=mysql_query("select * from docking_platform where id='$order[docking]' ",$conn1);
$sus=mysql_fetch_array($sresult);
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
}
?>
<!--startprint-->
<table cellspacing="1" cellpadding="3" class="table4">
<?php
$results=mysql_query("select * from refund_event where sid='$order[orderid]'",$conn1);
$rs=mysql_fetch_array($results);
if ($rs['id']!=''){
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
<tr><th colspan="4" align="left">��Ʒ���</th></tr>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">��Ʒ���ƣ�</td>
<td width="40%" align="left" class="tdleft"><?=$order['title']?></td>
<td width="14%"  align="right" bgcolor="#F1FAFF">��Ʒ���ͣ�</td><td width="40%" class="tdleft"><?=$order['type']?></td>
</tr>
<tr>
<td width="14%" height="32" align="right" bgcolor="#F1FAFF">��Ʒ��ֵ��</td><td class="tdleft"><?=number_format($order['price'],3)?> <?=$moneytype?></td>
<td width="14%" height="32" align="right" bgcolor="#F1FAFF">
���ң�</td>
<td class="tdleft"> <?=$order['username']?> 
<?php 
$gh_result=mysql_query("select * from members where number='$order[username]'",$conn1);
$gh_us=mysql_fetch_array($gh_result);?>
������<?php
$yx_pingjia=new integral();  
echo $yx_pingjia->seller_integral(($gh_us['praise1']-$gh_us['praise3']))?>
</td>
</tr>
<tr><th colspan="4" align="left">������ϸ</th></tr>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">�������룺</td>
<td width="40%" align="left" class="tdleft"><?=$order['orderid']?> </td>
<td width="14%"  align="right" bgcolor="#F1FAFF">����������</td><td width="40%" class="tdleft"><?=$order['nums']?></td>
</tr>

<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">�����</td>
<td width="40%" align="left" class="tdleft"><?=$order['buyprice']?> * <?=$order['nums']?> = <?=$order['zongprice']?> <?=$moneytype?></td>
<td width="14%"  align="right" bgcolor="#F1FAFF">����IP��</td><td width="40%" class="tdleft"><?=$order['youip']?>(<?=$order['network']?>)</td>
</tr>
<?php if ($order['type']=='����' || $order['type']=='����ֱ��' || $order['type']=='ѡ��' || $order['type']=='����') {?>
<?php if ($order['type']=='����' || $order['type']=='����ֱ��' || $order['type']=='ѡ��' || $order['type']=='����') {?>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">��ֵ��ַ��</td>
<td colspan="3" align="left" class="tdleft"><a href="<?=$order['url']?>" target="_blank"><?=$order['url']?></a></td>
</tr>
<?php } ?>

<?php
if ($order['Api']=='ŷ��'){
$doc = new DOMDocument();
$doc->load( 'kami/'.$order['orderid'].'.xml' );
$books = $doc->getElementsByTagName( "card" );
foreach( $books as $book ){
$cardno = $book->getElementsByTagName( "cardno" );
$cardno = $cardno->item(0)->nodeValue;
$cardpws = $book->getElementsByTagName( "cardpws" );
$cardpws = $cardpws->item(0)->nodeValue;
$expiretime = $book->getElementsByTagName( "expiretime" );
$expiretime = $expiretime->item(0)->nodeValue;
?>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">�˻���</td><td width="40%" align="left" class="tdleft"><?=$cardno?></td>
<td width="14%"  align="right" bgcolor="#F1FAFF">���룺</td><td width="40%" class="tdleft"><?=$cardpws?></td>
</tr>
<?php
}
}elseif($order['type']=='����' && $order['passwords']!=''){?>
<tr>
<td width="14%"  align="right" bgcolor="#F1FAFF">���룺</td><td colspan="3" class="tdleft"><?=$order['passwords']?>  </td>
</tr>
<?php
}elseif ($order['type']=='����' ||  $order['type']=='ѡ��'  && $order['Api']==''){
$kpresul=mysql_query("select * from $import_goods  where orderid='$order[orderid]' and  locks='1' ",$$datas);
while($kpr=mysql_fetch_array($kpresul)){?>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">���ţ�</td><td width="40%" align="left" class="tdleft"><?=$kpr['card']?></td>
<td width="14%"  align="right" bgcolor="#F1FAFF">���룺</td><td width="40%" class="tdleft"><?=$kpr['password']?></td>
</tr>
<?php
}}}
?>



<?php if ($order['custom1']!='' or $order['custom2']!='' ) {?>
<tr>
<?php if ($order['custom1']!='') {?>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF"><?=$order['custom1']?>��</td>
<td width="40%" align="left" class="tdleft"><?=$order['content1']?></td>
<?php } ?>
<?php if ($order['custom2']!='') {?>
<td width="14%"  align="right" bgcolor="#F1FAFF"><?=$order['custom2']?>��</td><td width="40%" class="tdleft"><?=$order['content2']?></td>
<?php } ?>
</tr>
<?php } ?>
<?php if ($order['custom3']!='' or $order['custom4']!='' ) {?>
<tr>
<?php if ($order['custom3']!='') {?>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF"><?=$order['custom3']?>��</td>
<td width="40%" align="left" class="tdleft"><?=$order['content3']?></td>
<?php } ?>
<?php if ($order['custom4']!='') {?>
<td width="14%"  align="right" bgcolor="#F1FAFF"><?=$order['custom4']?>��</td><td width="40%" class="tdleft"><?=$order['content4']?></td>
<?php } ?>
</tr>
<?php } ?>
<?php if ($order['custom5']!='' or $order['custom6']!='' ) {?>
<tr>
<?php if ($order['custom5']!='') {?>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF"><?=$order['custom5']?>��</td>
<td width="40%" align="left" class="tdleft"><?=$order['content5']?></td>
<?php } ?>
<?php if ($order['custom6']!='') {?>
<td width="14%"  align="right" bgcolor="#F1FAFF"><?=$order['custom6']?>��</td><td width="40%" class="tdleft"><?=$order['content6']?></td>
<?php } ?>
</tr>
<?php } ?>
<?php if ($order['custom7']!='' or $order['custom8']!='' ) {?>
<tr>
<?php if ($order['custom7']!='') {?>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF"><?=$order['custom7']?>��</td>
<td width="40%" align="left" class="tdleft"><?=$order['content7']?></td>
<?php } ?>
<?php if ($order['custom8']!='') {?>
<td width="14%"  align="right" bgcolor="#F1FAFF"><?=$order['custom8']?>��</td><td width="40%" class="tdleft"><?=$order['content8']?></td>
<?php } ?>
</tr>
<?php } ?>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">����״̬��</td>
<td colspan="3" align="left" class="tdleft"><?php
$yordeal=new oo_order();  
echo $yordeal->yordeal($order['trading'])?></td>

</tr>
<tr>
<td width="14%" height="32"  align="right" bgcolor="#F1FAFF">�����ظ���</td>
<td colspan="3" align="left" class="tdleft"> <?=$order['reply']?></td>
</tr>
<!--endprint-->
<tr>
<td colspan="4" align="center" style="height:60px;"> 
<input id="Button1" type="button" value="��ӡ����" class="xx_button1"  onClick="doPrint()" style="margin-right:30px;cursor:pointer;"/></td>
</tr>
</table>
</body>
</Html>
