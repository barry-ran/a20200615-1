
<?php 
include_once('../jhs_config/function.php');
$begtime=$_POST['begtime'];       //ʱ��
$Method=$_POST['Method'];
$username=$_POST['customerName'];//�û���
$password=md5($_POST['password']);//��¼����
$passwords=md5($_POST['tradePassword']);//��������
$province=mb_convert_encoding($_POST['province'],"gb2312","UTF-8");//ʡ��
$city=mb_convert_encoding($_POST['city'],"gb2312","UTF-8");//����
$company=mb_convert_encoding($_POST['company'],"gb2312","UTF-8");//��˾
$rname=mb_convert_encoding($_POST['rname'],"gb2312","UTF-8");//��ʵ����
$card=$_POST['card'];//���֤����
$qq=$_POST['qq'];    //QQ����
$phone=$_POST['phone'];//�绰����
$address=mb_convert_encoding($_POST['address'],"gb2312","UTF-8");//��ַ
$agent=$_POST['agent'];//����
$network=ysk_network(Local_Ip());

///////////////////////////////////////////////////////////////////////////��ȫ��֤
if ($username=='' || $password=='' || $passwords=='' || $province=='' || $city=='' || $company=='' || $rname=='' || $card=='' || $begtime=='' || $qq=='' ||$phone==''){
echo "3";
exit();
}
///////////////////////////////////////////////////////////////////////////��ȫ��֤����

if      ($agent!='' and $site_agent==$agent){
$site_leve=$site_leve;
}elseif ($agent=='' and $site_agent!='' ){
$site_leve=$site_leve;
}else{
$site_leve='1';
}

if  ($agent!=''){
$agent=$agent;
}else{
$agent=$site_agent;
}


////�������
$Local_Ip=Local_Ip();
$dates ="&".$username;
$dates.="&".$password;
$dates.="&".$passwords;
$dates.="&".$province;
$dates.="&".$city;
$dates.="&".$company;
$dates.="&".$rname;
$dates.="&".$card;
$dates.="&".$qq;
$dates.="&".$phone;
$dates.="&".$address;
$dates.="&".$agent;
$dates.="&".$network;
$dates.="&".$Local_Ip;
$dates.="&".$site_leve;
$dates.="&".$begtime;

$check=md5("{$dingdanhao}ɧ���ƽ�ing");
//file_put_contents("d:/mylog.txt",$dates,FILE_APPEND);



if($Method=="Check_Reg_email"){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "405";
exit();
}
////////////////////////////////////����IP��֤3Сʱ���޷���ע��


$regresult=mysql_query("select * from  check_reg  where youip='$Local_Ip' order by begtime desc,id desc limit 0,1",$conn1);
$regrow=mysql_fetch_array($regresult);
$checktime=$begtime+$regrow['begtime'];//ע����ڵ��ڵ�ǰʱ���ȥע��ʱ��

if($regrow['begtime']!='' && $checktime<0){  //���ע��ʱ��С��3Сʱ���޷�ע��
echo "404";
exit();
}else{



////////////////////////////////////////////////////////////////////////////////////////�����ʼ�����
////////�������
require 'smtp.php'; 
########################################## 
$smtpserver =$smtp_email;//SMTP������ 
$smtpserverport = 25;//SMTP�������˿� 
$smtpusermail =$send_email;//SMTP���������û����� 
$smtpemailto =$username;//���͸�˭ 
$smtpuser =$send_email;//SMTP���������û��ʺ� 
$smtppass =encrypt($send_email_password,'D','nowamagic'); ;//SMTP���������û����� 
$mailsubject = "����ѻ����һ��".$site_name."�˻���";//�ʼ����� 
$mailbody = "�װ����û�����<br><br>���ո���ѻ����һ��".$site_name."�˻�<br>��¼����Ҫ����ȫ������Ϣ������ģ�������Ϣ����ȫ���ܵġ�<br>������������".$site_url."/check.php?m=reg&u=".$check;//�ʼ����� 
$mailtype = "HTML";//�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ� 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤. 
$smtp->debug =false;//�Ƿ���ʾ���͵ĵ�����Ϣ 
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); 

////////////////////////////////////////////////////////////////////////////////////////�������ϵĸ���
mysql_query("insert into `check_reg` set checkcode='$check',content='$dates',begtime='1529759140',locks=0,youip='$Local_Ip'",$conn1); 
echo "1";
exit();
}




}
?>
