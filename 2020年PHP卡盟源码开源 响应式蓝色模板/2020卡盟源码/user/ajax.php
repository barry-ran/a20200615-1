<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
include('../jhs_config/function.php');
include('../jhs_config/user_check.php');
include('../jhs_config/error.php');
header("Content-Type: text/html; charset=gb2312");
$Action=$_GET['Action'];
$type=$_POST['type'];
$id=$_POST['id'];

if ($type=='Sign_in' and isset($_SESSION['ysk_number'])){
//Ϊ�˰�ȫ��֤�»�Ա�Ƿ����
$total=mysql_num_rows(mysql_query("select * from `members`  where  number='$_SESSION[ysk_number]' ",$conn1));
if ($total!=0){
//--------------------------------------�жϽ����Ƿ�ǩ����
$zong=mysql_num_rows(mysql_query("select * from `sign_in`  where number='$_SESSION[ysk_number]' and ($begtime-begtime)<86400  ",$conn1));
$qiandao=$yx_us['sign_in']+1;

if ($zong>0){
echo "{$yx_us['sign_in']}<script language=\"javascript\">alert('�Բ����������Ѿ�ǩ��������������Ŷ��')</script>";
exit();
}else{
mysql_query("insert into  sign_in (number,begtime) " . "values ('$_SESSION[ysk_number]','$begtime') ",$conn1);
mysql_query("update members set sign_in=sign_in+1   where number='$_SESSION[ysk_number]' ",$conn1); 
echo $qiandao;
}

}else{
echo "{$yx_us['sign_in']}<script language=\"javascript\">alert('�Բ��𣬲����ظ�ǩ����')</script>";		
}


//-----------------------------------------��Ʒ�ղؼ�

}elseif($type=='Product_favorites'){
	
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_favorites`where pid='$id' and  number='$_SESSION[ysk_number]'",$conn1));
if ($total!=0){
echo "�����ظ��ղ�";	
}else{
$presult=mysql_query("select * from product where id='$id' ",$conn1);
$prow=mysql_fetch_array($presult);
mysql_query("insert into product_favorites(title,pid,number,begtime)values('$prow[title]','$id','$_SESSION[ysk_number]','$begtime')",$conn1);
echo "�ղسɹ�";	
}

//-----------------------------------------�����ղؼ�

}elseif($type=='shops_favorites'){
$total=mysql_num_rows(mysql_query("SELECT * FROM `shops_favorites`where uid='$id' and  username='$_SESSION[ysk_number]'",$conn1));	
if ($total!=0){
echo "�����ظ��ղ�";	
}else{
mysql_query("insert into shops_favorites(uid,username,begtime)values('$id','$_SESSION[ysk_number]','$begtime')",$conn1);
echo "�ղسɹ�";	
}
	

}elseif($Action=='money'){
echo number_format($yx_us['kuan'],3)." ";
}



?>