
<?php 
include_once('jhs_config/function.php');
$m=$_GET['m'];
$u=trim($_GET['u']);
if ($m=='reg'){
//////////////////////////////////////////////��֤���ݵĺϷ���
$codesql=mysql_query("select * from  check_reg  where locks=0 and  checkcode='$u' ",$conn1);
$code=mysql_fetch_array($codesql);
if($code){
//////////////////////////////////////////////�����������
$allArray=(explode("&", $code['content']));
$username=$allArray[1];
$password=$allArray[2];
$passwords=$allArray[3];
$province=$allArray[4];
$city=$allArray[5];
$company=$allArray[6];
$rname=$allArray[7];
$card=$allArray[8];
$qq=$allArray[9];
$phone=$allArray[10];
$address=$allArray[11];
$agent=$allArray[12];
$network=$allArray[13];
$Local_Ip=$allArray[14];
$site_leve=$allArray[15];
$begtime=$allArray[16];
if ($site_leve=='' || $site_leve==0){
$site_leve=0;
}
///////////////////////////////////////////////////////////////////////////��ȫ��֤
if ($username=='' || $password=='' || $passwords=='' || $province=='' || $city=='' || $company=='' || $rname=='' || $card=='' || $qq=='' || $phone==''){
header('location:/404.php');
exit();
}
///////////////////////////////////////////////////////////////////////////��ȫ��֤����

///////////////////////////////////////////////////////////////////////////ɧ������ע����Ϣ�Ѿ�������
$zong=mysql_num_rows(mysql_query("select * from `members` where  username='$username' or email='$username'",$conn1));
if ($zong==0){
///////////////////////////////////////////////////////////////////////////������ż�¼
$bh_result=mysql_query("select * from  bianhao_list",$conn1);
while($bh=mysql_fetch_array($bh_result)){
$strid.=$bh['title'].',';
}
$strid=substr($strid,0,strlen($strid)-1);//�����id�ַ���
///////////////////////////////////////////////////////////////////////////��ѯ��¼���������б��һ����¼
if ($strid!=''){
$us_result=mysql_query("select * from members where  number NOT IN($strid) order by number desc limit 1 ",$conn1);
}else{
$us_result=mysql_query("select * from members  order by number desc limit 1 ",$conn1);
}
$user=mysql_fetch_array($us_result);
$Uid=$user['number']+1;

///////////////////////////////////////////////////////////////////////////���������֤�Ƿ��ظ�

$total=mysql_num_rows(mysql_query("select * from `members` where  number='$Uid' order by number desc ",$conn1));
if ($total==0){
$Uid=$Uid;
}else{
$Uid=$Uid+1;
}
$total=mysql_num_rows(mysql_query("select * from `bianhao_list` where  title='$Uid'",$conn1));
if ($total==0){
$Uid=$Uid;
}else{
$zong=mysql_num_rows(mysql_query("select * from `bianhao_list` where  title>'$Uid'",$conn1));
for($i=1;$i<=$zong;$i++){
$result=mysql_query("select * from  bianhao_list  where title='$Uid' ",$conn1);
$row=mysql_fetch_array($result);
if ($row){
$Uid=$Uid+1;
}
}
}
///////////////////////////////////////////////////////////////////////////���������֤�Ƿ��ظ� THE End
mysql_query("insert into `members` set level='$site_leve',agent='$agent',number='$Uid',username='$username',password='$password',passwords='$passwords',company='$company',rname='$rname',card='$card',qq='$qq',email='$username',phone='$phone',address='$address',begtime='$begtime',province='$province',city='$city',time='$begtime',lost_time='$begtime',log_time='$begtime',lost_ip='$Local_Ip',log_ip='$Local_Ip',lost_dz='$network',log_dz='$network'  ",$conn1); 

//--------------------------------------------------------------------------�������ݸ��µ�SUP

mysql_query("insert into sup_username_reg set username='$username',password='$password',passwords='$passwords',company='$company',rname='$rname',card='$card',qq='$qq',email='$username',phone='$phone',address='$address',province='$province',city='$city',begtime='$begtime'",$conn2);

//--------------------------------------------------------------------------�������ݸ��µ�SUP The End

if ($agent!=''){mysql_query("update members set xlevel=xlevel+1 where number='$agent'",$conn1); }
mysql_query("update check_reg set locks=1 where checkcode='$u'",$conn1);//������֤״̬
header('location:/404.php?error=ok');
exit();
}else{
header('location:/404.php?error=403');
exit();
}

}else{
header('location:/404.php?error=404');
exit();
}

//////////////////////////////////////////��ֵ�Ƿ�Email
}else{
header('location:/404.php?error=404');
exit();
}




?>