<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
/**
* <a href="http://www.jbxue.com/article/4087.html" target="_blank" class="infotextkey">PHPMailer</a>Ⱥ���ʼ�������
* Edit www.jbxue.com
*/
require("../../Public/phpmailer/class.phpmailer.php");//����phpmailer
function smtp_mail ($sendto_email,$subject,$body,$user_name,$host,$mailname,$mailpass,$text,$mail_table) {
$mail = new PHPMailer();
$mail->IsSMTP();                // send via SMTP
$mail->Host = $host; // SMTP servers
$mail->SMTPAuth = true;         // turn on SMTP authentication
$mail->Username =$mailname;   // SMTP username  ע�⣺��ͨ�ʼ���֤����Ҫ�� @<a href="http://www.jbxue.com/tags/yuming.html" target="_blank" class="infotextkey">����</a>
$mail->Password =$mailpass;        // SMTP password
$mail->From = $mailname;      // ����������
$mail->FromName =  "wangkan";  // ������
$mail->CharSet = "gb2312";            // ����ָ���ַ�����
$mail->Encoding = "base64";
$mail->AddAddress($sendto_email,"hello");  // �ռ������������
//$mail->AddBCC("����", "ff");
//$mail->AddBCC("����", "ff");��Щ���԰���
//$mail->AddReplyTo("test@jbxue.com","aaa.com");
//$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/qita/htestv2.rar"); // ����
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");
$mail->IsHTML(true);  // send as HTML
// �ʼ�����
$mail->Subject = $subject;
// �ʼ�����
$mail->Body =$text;
													
$mail->AltBody ="text/html";
if(!$mail->Send())
{
$error=$mail->ErrorInfo;
/*if($error=="smtpnot")//�Զ������û�����ӵ�smtp�������������������������������·���
{
sleep(2);
$song=<a href="http://www.jbxue.com/shouce/php5/function.explode.html" target="_blank" class="infotextkey">explode</a>("@",$sendto_email);
$img="<img height='0' width='0' src='http://www.jbxue.com/email.php?act=img&mail=".$sendto_email."&table=".$mail_table."' />";
smtp_mail($sendto_email,"����".$song[0].$biaoti, 'NULL', 'abc',$sendto_email,$host,$mailname,$mailpass,
$img."����".$song[0].$con,'$mail_table');//�����ʼ�
}*/
//����ʧ�ܰѴ����¼��������
}
else {
if($mailname=="aaa@jbxue.com")
{
echo ""; //�������󣬿���ȥ��
}
else
{
echo "$user_name �ʼ����ͳɹ�!���������ȷ�ϣ�<br />";//���ͳɹ�
}
}
}
?>

<?php

sleep(3);
smtp_mail($mail,"����".$song[0].$biaoti, 'NULL', 'abc',$mail,$host,$mailname,$mailpass,$img."����".$song[0].$con,$mail_table);//�����ʼ�

?>