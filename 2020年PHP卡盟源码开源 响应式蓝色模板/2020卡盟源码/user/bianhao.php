<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
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
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
<?php 
include('../jhs_config/function.php');
include('../jhs_config/user_check.php');
include('../jhs_config/error.php');
$Action=strip_tags($_GET['Action']); 
$proid=check_input($_GET['id']);

$result=mysql_query("select * from bianhao_list where id='$proid'",$conn1);
$row=mysql_fetch_array($result);

//---��֤�Ƿ��и�����

if($row['type']==1 || $row['type']==''){
	header('location:/user/sorry.php?err=1');
	exit();
}

$yx_sup_result=mysql_query("select * from sup_members where number='$sup_number' ",$conn2);       ###��ȡSup����
$yx_sup=mysql_fetch_array($yx_sup_result);
?>
</head>
<body>
<?php if ($Action=='') {?>
<form action="?Action=save&id=<?=$proid?>" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">�����ţ�</td>
<td><?=$row['title']?></td>
</tr>
<tr>
<td height="32" class="td_left">��ż۸�</td>
<td><?=$row['price']?> Ԫ</td>
</tr>
<tr>
<td height="32" class="td_left">ע�����</td>
<td style="color:#FF0000; font-weight:bold">�����ź���������ǰ�ı�����ݽ������,����ȷ�����ж�����������ɺ���</td>
</tr>
<tr>
<td height="32" colspan="2" align="center" >
<input name="�ύ" type="submit" class="button_buy"  value="��һ��"  onclick="Javascript:return confirm('��ȷ������ñ�ţ�������������ݶ������,����ȷ�����ж�����������ɺ���');"></td>
</tr>
</table>
</form>
<?php }elseif($Action=='save'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}

$afters=$yx_us['kuan']-$row['price'];

if ($afters<0){
echo "<br><br><br><br><center>�ܱ�Ǹ�������������ֵ�����²���!<br><br><input id='btnAll' type='button' value='����ر�'  onClick='cl()' class='tijiao_input' /></center>";
exit();
}

if ($row['price']<0){
echo "<br><br><br><br><center>�ܱ�Ǹ�������������ֵ�����²���!<br><br><input id='btnAll' type='button' value='����ر�'  onClick='cl()' class='tijiao_input' /></center>";
exit();
}

$price=($row['price']*0.05);//������ Sup���5%
if (($yx_sup['kuan']-$price)<0) {
echo "<br><br><br><br><center>�ܱ�Ǹ��SUP�����޷�����!<br><br><input id='btnAll' type='button' value='����ر�'  onClick='cl()' class='tijiao_input' /></center>";
exit();
}
$kuan_s=$yx_sup['kuan']-$price;

//*******************************************************************���ĺڿ��޸�ģ��
get_check_price($kuan_s);
get_check_price($afters);
//*******************************************************************���ĺڿ��޸�ģ�� The End


///-------------------------------------------����sup �ʽ���ϸ
mysql_query("insert into `sup_details_funds` set title='�¼�������',spendings='$price',befores='$yx_sup[kuan]',afters='$kuan_s',number='$yx_sup[number]',begtime='$begtime'",$conn2);
mysql_query("update sup_members set kuan='$kuan_s',zong_kuan=zong_kuan+$price where number='$yx_sup[number]'",$conn2); 
///-------------------------------------------����sup �ʽ���ϸ The End
mysql_query("insert into `details_funds` set title='�����ţ�$row[title]',spendings='$row[price]',befores='$yx_us[kuan]',afters='$afters',number='$row[title]',begtime='$begtime'",$conn1);


mysql_query("update members set agent='$row[title]' where agent in ($_SESSION[ysk_number])",$conn1);///////�����¼���Ա�Ĵ�����
///////���µ����ղؼ�
mysql_query("update shops_favorites   set username='$row[title]' where username in ($_SESSION[ysk_number])",$conn1);
///////���²�Ʒ�ղؼ�
mysql_query("update product_favorites set number='$row[title]' where number in ($_SESSION[ysk_number])",$conn1);
///////���µ��̷���
mysql_query("update store_class set username='$row[title]' where username in ($_SESSION[ysk_number])",$conn1);
mysql_query("delete from encrypted_card     where username ='$_SESSION[ysk_number]'",$conn1);///////����ܱ���
mysql_query("delete from encrypted_problem  where members ='$_SESSION[ysk_number]'",$conn1);///////����ܱ�����
mysql_query("delete from punishment_list where number ='$_SESSION[ysk_number]'",$conn1);///////���Υ���б�
mysql_query("delete from sign_in         where number ='$_SESSION[ysk_number]'",$conn1);///////���ǩ���б�
mysql_query("delete from pay_record      where number ='$_SESSION[ysk_number]'",$conn1);///////��ճ�ֵ�б�
mysql_query("delete from password_lock   where number ='$_SESSION[ysk_number]'",$conn1);///////������������б�
mysql_query("delete from complaints_feedback   where number='$_SESSION[ysk_number]'",$conn1);///////��ջ�ԱͶ����ҷ���
mysql_query("delete from complaints_feedback   where username='$_SESSION[ysk_number]'",$conn1);///////��ջ�ԱͶ�����ҷ���
mysql_query("delete from balance_cash          where number='$_SESSION[ysk_number]'",$conn1);///////��ջ�Ա�������
mysql_query("delete from transfer_detail       where number='$_SESSION[ysk_number]'",$conn1);///////��ջ�Աת����ϸ
mysql_query("delete from details_funds         where number='$_SESSION[ysk_number]'",$conn1);///////��Ա�ʽ���ϸ
mysql_query("delete from money_order           where number='$_SESSION[ysk_number]'",$conn1);///////���֪ͨ��
mysql_query("delete from product_order         where `sid`=0 and `docking`=0 and  username='$_SESSION[ysk_number]'",$conn1);///////��Ʒ��������
mysql_query("delete from product_order         where number='$_SESSION[ysk_number]'",$conn1);///////��Ʒ�������
mysql_query("delete from product               where `sid`=0 and `docking`=0 and  username='$_SESSION[ysk_number]'",$conn1);///////��Ʒ
mysql_query("delete from sms                   where username='$_SESSION[ysk_number]'",$conn1);///////������Ϣ������
mysql_query("delete from sms                   where sendname='$_SESSION[ysk_number]'",$conn1);///////������Ϣ������
mysql_query("delete from supplier_refund       where username='$_SESSION[ysk_number]'",$conn1);///////�������˿���ϸ
mysql_query("delete from goods_details         where number='$_SESSION[ysk_number]'",$conn1);  ///////�����̹�����ϸ
mysql_query("delete from goods_yuer            where number='$_SESSION[ysk_number]'",$conn1);///////�����̻���ת�����ϸ

mysql_query("update members set kuan='$afters',number='$row[title]',bad_grades=0,bad_grades1=0,praise1=0,praise2=0,praise3=0,praise4=0,praise5=0,praise6=0,power2=0 where number='$_SESSION[ysk_number]'",$conn1); /////�۵���ԱǮ �� �󶨱��
$_SESSION['account']=$yx_us['username'];     //�洢��Ա��
$_SESSION['ysk_number']=$row[title]; //�洢��Ա����
mysql_query("update bianhao_list set type='1',begtime='$begtime' where id='$_REQUEST[id]'",$conn1); 
echo "<br><br><br><center><input id='btnAll' type='button' value='����ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}?>
</body>
</Html>
