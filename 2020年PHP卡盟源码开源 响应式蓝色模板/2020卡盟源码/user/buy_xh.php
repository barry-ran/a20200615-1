<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />
<body>
<script language="javascript">
function checkuserinfo()
{
if(checkspace(document.userinfo.passwords.value)) {
document.userinfo.passwords.focus();
alert("����ʧ�ܣ������뽻�����룡");
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
<?php
header("Content-Type: text/html; charset=gb2312");
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/error.php');
include_once('../jhs_config/Share_out_as.php');
$begtime=$_POST['begtime'];       
$proid=check_input($_GET[id]);
$Action=strip_tags($_GET['Action']); 
//-------��ȡ��վ�ƶ�
$supd_result=mysql_query("select * from sup_members_site where number='$sup_number' ",$conn2); 
$supdoc=mysql_fetch_array($supd_result);
//------��ȡ��Ʒ
$pro_result=mysql_query("select * from product where id='$proid'",$conn1);
$pro=mysql_fetch_array($pro_result);
if ($pro['id']==''){
echo "<br><br><br><br><center>�ܱ�Ǹ�����������Ʒ������!<br><br><input id='btnAll' type='button' value='����ر�'  onClick='cl()' class='tijiao_input' /></center>";
exit();
}

//--------------------------------------------------��ȡ���ʼ���������
//******************************************��������
if    ($pro['sid']==0 && $pro['pid']==0){
$fl_result=mysql_query("select *  from product_class where NumberID='$pro[directory2]'",$conn1);
$fl=mysql_fetch_array($fl_result);
$feilv=$fl['feilv']/100;
$yx_row_result=mysql_query("select * from buy_modl  where  id='$pro[buy_md]'",$conn1);
$yx_row=mysql_fetch_array($yx_row_result);	
$import_goods='import_goods';
$pid=$pro['id'];
$datas="conn1";
//******************************************Sup����
}elseif($pro['sid']!=0 && $pro['pid']==0){
$pid=$pro['sid'];
$import_goods='sup_import_goods';
$datas="conn2";
$sup_result=mysql_query("select * from sup_members where number='$sup_number' ",$conn2); 
$sup=mysql_fetch_array($sup_result);
$directory4=substr($pro[directory4],0,7);
$yx_row_result=mysql_query("select * from sup_buy_modl  where  id='$pro[buy_md]'",$conn2);##����ģ��
$yx_row=mysql_fetch_array($yx_row_result);	
$fl_result=mysql_query("select *  from sup_product_class where NumberID='$directory4'",$conn2);##��ȡ����
$fl=mysql_fetch_array($fl_result);
$feilv=$fl['feilv']/100;

//******************************************ƽ̨�Խ�����
}elseif($pro['sid']==0 && $pro['pid']!=0){
$import_goods='import_goods';
$pid=$pro['pid'];
$datas='conn3';
$sresult=mysql_query("select * from docking_platform where id='$pro[docking]' ",$conn1);
$sus=mysql_fetch_array($sresult);
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
//��ȡ���ݿ�����
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'"); 
//��ȡ��Ա����
$yx_row_result=mysql_query("select * from buy_modl  where  id='$pro[buy_md]'",$conn3);
$yx_row=mysql_fetch_array($yx_row_result);	
$doc_result=mysql_query("select * from members where number='$sus[username]' ",$conn3);
$doc_us=mysql_fetch_array($doc_result);
$directory4=substr($pro[directory4],0,7);
$fl_result=mysql_query("select *  from product_class where NumberID='$directory4'",$conn3);##��ȡ����
$fl=mysql_fetch_array($fl_result);
$feilv=$fl['feilv']/100;
//��֤ƽ̨��Ʒ״̬ �����Ƿ�۸��쳣
$doc_pro_result=mysql_query("select * from product where id='$pro[pid]'",$conn3);
$doc_pro=mysql_fetch_array($doc_pro_result);
//-------��֤��Ʒ�Ƿ����
if($doc_pro==''){
mysql_query("delete from product where id ='$proid'",$conn1);
echo "<br><br><br><br><center>����ʧ�ܣ����������Ʒ�ղű�ɾ����!<br><br><input id='btnAll' type='button' value='����ر�'  onClick='cl()' class='tijiao_input' /></center>";
exit();	
}
//-------��֤�۸�
if ($pro['price']<>$doc_pro['price2']){
$price2=ysk_buy_Price($yx_us['level'],$doc_pro['price2'],$doc_pro['pricing'],$doc_pro['rate']);
//-------�۸����ģ��
mysql_query("update product set price2='$price2',price='$doc_pro[price2]' where id='$pro[id]'",$conn1);
echo "<script language=JavaScript>location.replace(location.href);</script>";
exit();
}
//-------��֤���״̬
if ($doc_pro['locks']!=2){
echo "<br><br><br><br><center>����ʧ�ܣ����������Ʒ�쳣!";
exit();
}
//-------��֤״̬
if ($doc_pro['state']==1){
echo "<br><br><br><br><center>����ʧ�ܣ��ò�Ʒ����ͣ����!";
exit();
}

if ($doc_pro['state']==2){
echo "<br><br><br><br><center>����ʧ�ܣ��ò�Ʒ�ѽ�������!";
exit();
}

if ($doc_pro['state']==4){
echo "<br><br><br><br><center>����ʧ�ܣ��ò�Ʒ���¼�!";
exit();
}
}

if(strstr($pro['modl'],"ѡ��")==false ){
echo "�Բ���,ϵͳ�쳣��";
exit();
}

//------��ȫ��֤
ysk_buy_error($pro['state']);                                                          #######״̬�쳣
ysk_buy_area($pro['provinces'],$yx_us['province'],$pro['citys'],$yx_us['city']);       #######�����쳣

if ($Action=='') {?>
<form action="?Action=buy_one&id=<?=$pro['id']?>" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table2" >
<tr><td height="32" class="td_left">��Ʒ���ƣ�</td><td><?=$pro['title']?> </td></tr>
<tr><td height="32" class="td_left">��Ʒ���ͣ�</td><td><?=$pro['modl']?></td></tr>
<tr><td height="32" class="td_left">ѡ����룺</td><td><?php
$sql=mysql_query("select * from $import_goods  where  pid='$pid' and locks='0'",$$datas);
while($row=mysql_fetch_array($sql)){?>
<div style="width:200px; float:left;"><input name="buyhao" type="radio" value="<?=$row['id']?>"> <?=$row['card']?></div>
<?php } ?></td></tr>
<tr><td height="32" class="td_left">��������</td>
<td>
<input name="buyaction" type="radio" value="0" checked="checked" style="vertical-align:middle"> ������ʾ����Ļ��
<input name="buyaction" type="radio" value="1" style="vertical-align:middle">  �ݲ���ʾ�������� </td>
</tr>
<tr><td height="32" class="td_left">��Ʒ��ֵ��</td><td><?=number_format($pro['price1'],3)?> <?=$moneytype?></td></tr>
<tr><td height="32" class="td_left">���򵥼ۣ�</td><td style="color:#FF0000; font-weight:bold"><?=number_format(ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate']),3)?> <?=$moneytype?></td></tr>
<tr><td class="td_left"> ����ע��</td><td><textarea name="txtComment" rows="5" cols="40" id="txtComment"  class="biankuan"></textarea></td></tr>
</table>
<div id="BuyNext" class="tijiao">
<input name="�ύ" type="submit" class="button_buy" id="btnBuyNext" onClick="confimbuy()" onMouseOver="this.className='button_mouseover1'" onMouseOut="this.className='button_buy'" value="��һ��" />
<input name="����" type="reset" class="button_close" id="Button2"  value="����" />
</div>
</form>
<?php }elseif ($Action=='buy_one') {
	
if ($_POST['buyhao']==''){
echo "<script>alert('�Բ�����û��ѡ����룡');history.go(-1);</script>";exit();
}

if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}

inject_check($_POST['buyhao']);
$id=inject_check($_GET['id']);
?>
<form action="?Action=buy_two&id=<?=$id?>" method="post" name="userinfo">
<input name="id"         type="hidden" value="<?=$_REQUEST['id']?>"/>
<input name="txtComment" type="hidden" value="<?=strip_tags($_POST['txtComment'])?>"/>
<input name="buyaction"  type="hidden" value="<?=$_POST['buyaction']?>"/>
<input name="buyhao"   type="hidden" value="<?=$_POST['buyhao']?>"/>
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr><td height="32" class="td_left">��Ʒ���ƣ�</td><td><?=$pro['title']?></td></tr>
<tr><td height="32" class="td_left">���������</td><td>
<?php if ($_REQUEST['buyaction']=='0') {?>������ʾ����Ļ��<?php }else{?>�ݲ���ʾ��������<?php } ?>
</td></tr>
<tr><td height="32" class="td_left">��Ʒ���ͣ�</td> <td><?=$pro['modl']?></td> </tr>
<tr><td height="32" class="td_left">��Ʒ��ֵ��</td><td><?=number_format($pro['price1'],3)?> <?=$moneytype?></td></tr>
<tr><td height="32" class="td_left">���򵥼ۣ�</td><td><?=number_format(ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate']),3)?><?=$moneytype?></td> </tr>
<tr><td height="32" class="td_left">Ӧ�ս�</td><td><?=number_format(ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate']),3)?> <?=$moneytype?></td> </tr>
<tr><td class="td_left"> ����ע��</td><td><?=$_REQUEST['txtComment']?></td></tr>
<tr><td class="td_left"> �������룺</td><td><input name="passwords" type="password" class="biankuan" id="passwords" placeholder="���������Ľ�������" />
</td>
</tr>
<input name="begtime" type="password" value="<?php $now=mktime(); echo $now;?>" class="begtime" id="begtime" />
</table>
<div id="BuyNext" class="tijiao">
<input name="�ύ" type="submit" class="button_buy" id="btnBuyNext" onClick="return checkuserinfo();" value="ȷ�Ϲ���" />

</div>
</form>
<?php }if ($Action=='buy_two') {
$buyprice=number_format(ysk_buy_Price($yx_us['level'],$pro['price2'],$pro['pricing'],$pro['rate']),3);
$buyaction=$_POST['buyaction']; 
$amount=$buyprice;
$afters=$yx_us['kuan']-$buyprice;
$txtcomment=strip_tags($_POST['txtComment']); 
$Local_Ip=Local_Ip();
$nums=1;
inject_check($_POST['id']);
$buyhao=inject_check($_POST['buyhao']);

if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}
if ($_POST['passwords']==''){
echo "<br><br><br><br><center>�ܱ�Ǹ�������������ֵ�����²���!</center>";
exit();
}

if (md5($_POST['passwords'])!=$yx_us['passwords']){
echo "<script>alert('�Բ��𣬽����������!');window.location='buy_km.php?id=$proid';</script>";
exit();
}

if ($buyprice<0){
echo "<br><br><br><br><center>�ܱ�Ǹ�������������ֵ�����²���!</center>";
exit();
}

if ($yx_us['kuan']<0 || $yx_us['kuan']-$buyprice<0){
echo "<br><br><br><br><center>�ܱ�Ǹ�������������ֵ�����²���!</center>";
exit();
}


//*******************************************************************���ĺڿ��޸�ģ��
get_check_price($buyprice);
get_check_price($yx_us['kuan']);
get_check_price(($yx_us['kuan']-$buyprice));
//*******************************************************************���ĺڿ��޸�ģ�� The End


$network=ysk_network(Local_Ip());


////////////////////////////////////////////����ģ�黮��
if ($pro['sid']==0    && $pro['pid']==0){
###############---------------------------------------------------------------------------������
$zongas=Share_out_as($yx_us['agent'],$site_as,$nums,$pro['id'],$dingdanhao,$_SESSION['ysk_number']);
###############---------------------------------------------------------------------------������ The End

###############---------------------------------------------------------------------------�Ƿ񹩻���
if($pro['username']!=''){
$yx_gh_result=mysql_query("select * from members where number='$pro[username]' ",$conn1);
$yx_gh=mysql_fetch_array($yx_gh_result);
$feilv=$buyprice*$feilv;
$buyprice=$buyprice-$feilv-$zongas;
$goods_kuan=$yx_gh['goods_kuan']+$buyprice;
mysql_query("insert into `goods_details` set title='��Ʒ����',orderid='$dingdanhao',incomes='$buyprice',befores='$yx_gh[goods_kuan]',afters='$goods_kuan',number='$pro[username]',begtime='$begtime',feilv='$feilv'",$conn1);
mysql_query("update members set goods_kuan='$goods_kuan' where number='$pro[username]'",$conn1); 
}


////////////////////////////////////////////��վ����The End
}elseif($pro['sid']!=0 && $pro['pid']==0){
//----------------------------------------Sup�������ʽ�
if ($pro['Api']==''){
$result1=mysql_query("select * from sup_members where number='$pro[username]' ",$conn2);
$gh=mysql_fetch_array($result1);
$sup_kou=$pro['price']*$nums;
$kuan_s=$yx_sup[kuan]-$sup_kou;
$poundage=$pro['price']*$nums*$feilv;
$sup_buyprice=$pro['price']*$nums-$poundage;
$afters=$gh['kuan']+$sup_buyprice;
mysql_query("insert into `sup_details_funds` set title='��Ʒ����',orderid='$dingdanhao',incomes='$sup_buyprice',befores='$gh[kuan]',afters='$afters',number='$pro[username]',begtime='$begtime',feilv='$poundage'",$conn2);
mysql_query("update sup_members set kuan='$afters' where number='$pro[username]'",$conn2);
}
//--------------------------------���¹������ʽ�
mysql_query("insert into `sup_details_funds` set title='��Ʒ����',orderid='$dingdanhao',spendings='$sup_kou',befores='$yx_sup[kuan]',afters='$kuan_s',number='$yx_sup[number]',begtime='$begtime'",$conn2);
mysql_query("update sup_members set kuan='$kuan_s',zong_kuan=zong_kuan+$sup_kou where number='$yx_sup[number]'",$conn2); 
mysql_query("insert into `sup_product_order` set orderid='$dingdanhao',pid='$pro[sid]',buyaction='$buyaction',trading='2',type='$pro[modl]',price='$pro[price1]',buyprice='sup_buyprice',nums='$nums',zongprice='$sup_kou',zongas='$poundage',feilv='$poundage',docking='$docking',txtcomment='$txtcomment',number='$yx_sup[number]',username='$pro[username]',network='$network',youip='$Local_Ip',time='$begtime',begtime='$begtime',title='$pro[title]',url='$pro[url]',Api='$pro[Api]',Api_id='$pro[Api_id]',passwords='$passwords',overdue='$pro[overdue]',directory='$pro[directory3]'",$conn2);
////////////////////////////////////////////Sup����The End
}elseif($pro['sid']==0 && $pro['pid']!=0){
//******************************************ƽ̨���ϻ�ȡ	
$doc_zong=$nums*$pro['price2'];
$doc_kuan=$doc_us['kuan']-$doc_zong;
if ($doc_us['kuan']<$doc_zong){
echo "<br><br><br><br><center>����ʧ�ܣ�ƽ̨�ʽ��㣬����ϵ��վ�ͷ�!";
exit();
}
//******************************************���¿���������	
mysql_query("update product set kucun=kucun-$nums,sales=sales+$nums where id='$pro[pid]'",$conn3);
###############---------------------------------------------------------------------------���¹����Ա���ʽ���ϸ
mysql_query("insert into `details_funds` set title='��Ʒ����',orderid='$dingdanhao',spendings='$doc_zong',befores='$doc_us[kuan]',afters='$doc_kuan',number='$sus[username]',begtime='$begtime'",$conn3);
mysql_query("update members set kuan=$doc_kuan,zong_kuan=zong_kuan+$doc_zong where number='$sus[username]'",$conn3); 

if($pro['username']!=''){
$yx_gh_result=mysql_query("select * from members where number='$pro[username]' ",$conn3);
$yx_gh=mysql_fetch_array($yx_gh_result);
$feilv=$doc_zong*$feilv;
$buyprice=$buyprice-$feilv-$zongas;
$goods_kuan=$yx_gh['goods_kuan']+$buyprice;
mysql_query("insert into `goods_details` set title='��Ʒ����',orderid='$dingdanhao',incomes='$buyprice',befores='$yx_gh[goods_kuan]',afters='$goods_kuan',number='$pro[username]',begtime='$begtime',feilv='$feilv'",$conn3);
mysql_query("update members set goods_kuan='$goods_kuan' where number='$pro[username]'",$conn3); 
}


###############---------------------------------------------------------------------------��������
mysql_query("insert into `product_order` set locks='$supdoc[id]',Api='$pro[Api]',Api_id='$pro[Api_id]',title='$pro[title]',orderid='$dingdanhao',pid='$pro[pid]',sid='$pro[sid]',buyaction='$buyaction',trading='2',type='$pro[modl]',price='$pro[price1]',buyprice='$pro[price2]',nums='$nums',zongprice='$doc_zong',zongas='$zongas',feilv='$feilv',txtcomment='$txtComment',number='$sus[username]',username='$pro[username]',network='$network',youip='$Local_Ip',time='$begtime',begtime='$begtime',custom1='$custom1',content1='$content1',custom2='$custom2',content2='$content2',custom3='$custom3',content3='$content3',custom4='$custom4',content4='$content4',custom5='$custom5',content5='$content5',custom6='$custom6',content6='$content6',custom7='$custom7',content7='$content7',custom8='$custom8',content8='$content8',url='$pro[url]',overdue='$pro[overdue]',directory='$pro[directory4]',passwords='$passwords'",$conn3);
###############---------------------------------------------------------------------------�������� The End
}



mysql_query("update  product set kucun=kucun-$nums,sales=sales+1 where id='$proid'",$conn1);      ##���¿���������
mysql_query("update  $import_goods  set locks='1',orderid='$dingdanhao' where id='$buyhao'",$$datas); 


###############---------------------------------------------------------------------------���¹����Ա���ʽ���ϸ
mysql_query("insert into `details_funds` set title='��Ʒ����',orderid='$dingdanhao',spendings='$buyprice',befores='$yx_us[kuan]',afters='$afters',number='$_SESSION[ysk_number]',begtime='$begtime'",$conn1);
mysql_query("update members set kuan='$afters',zong_kuan=zong_kuan+$buyprice where number='$_SESSION[ysk_number]'",$conn1); 
###############---------------------------------------------------------------------------���¹����Ա���ʽ���ϸ The End

###############---------------------------------------------------------------------------��������
mysql_query("insert into `product_order` set locks='$supdoc[id]',docking='$pro[docking]',docid='$pro[pid]',Api='$pro[Api]',Api_id='$pro[Api_id]',title='$pro[title]',orderid='$dingdanhao',pid='$pro[id]',sid='$pro[sid]',buyaction='$buyaction',trading='2',type='$pro[modl]',price='$pro[price1]',buyprice='$amount',nums='$nums',zongprice='$buyprice',zongas='$zongas',feilv='$feilv',txtcomment='$txtComment',number='$_SESSION[ysk_number]',username='$pro[username]',network='$network',youip='$Local_Ip',time='$begtime',begtime='$begtime',custom1='$custom1',content1='$content1',custom2='$custom2',content2='$content2',custom3='$custom3',content3='$content3',custom4='$custom4',content4='$content4',custom5='$custom5',content5='$content5',custom6='$custom6',content6='$content6',custom7='$custom7',content7='$content7',custom8='$custom8',content8='$content8',url='$pro[url]',overdue='$pro[overdue]',directory='$pro[directory4]'",$conn1);
###############---------------------------------------------------------------------------�������� The End


?>
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr><td width="14%" height="32" class="td_left">��Ʒ���ƣ�</td><td width="86%"><?=$pro['title']?></td></tr>
<?php if($buyaction==0 ) {
$kpresul=mysql_query("select * from $import_goods where orderid='$dingdanhao' and  locks='1' ",$$datas);
while($kpr=mysql_fetch_array($kpresul)){?>
<tr><td height="32" class="td_left">���ţ�</td><td><?=$kpr['card']?></td></tr>
<tr><td height="32" class="td_left">���룺</td><td><?=$kpr['password']?></td></tr>
<tr><td height="32" colspan="2" class="td_left">&nbsp;</td></tr>
<?php }?>
<?php }?>
</table>
<center><br /><input name="�ر�" type="button" class="button_close" id="Button2"  onClick="cl()" value="�ر�" /></center>
<?php }?>
</body>
</Html>
