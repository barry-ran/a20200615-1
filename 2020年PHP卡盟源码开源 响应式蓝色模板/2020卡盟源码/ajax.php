<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php 
include_once('jhs_config/function.php');
$Method=$_POST['Method'];
$customerName=$_POST['customerName'];
$agent=$_POST['agent'];
//��֤���޸ô���
if    ($Method=="checkagent"){
$total=mysql_num_rows(mysql_query("select * from `members`  where  number='$agent' ",$conn1));
if ($total==0){
echo "2";
}else{
echo "1";
}
//�ж��û����Ƿ��ظ�
}elseif    ($Method=="checkCustomerName"){
$total=mysql_num_rows(mysql_query("select * from `sup_username_reg`  where username='$customerName' or email='$customerName'",$conn2));
if ($total==0){
echo "2";
}else{
echo "1";
}


}
?>