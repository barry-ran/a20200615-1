<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php  
// ���� PHPmailer�� �ļ� 
error_reporting(E_ERROR); 
require_once("Public/phpmailer/class.phpmailer.php"); 
// д�뷢�ͽ������ 
function info_write($filename,$info_log) 
{ 
$info.= $info_log; 
$info.="\r\n"; 
$fp = fopen ($filename,'a'); 
fwrite($fp,$info); 
fclose($fp); 
} 
//����Email���� 
function smtp_mail ( $sendto_email, $subject, $body, $extra_hdrs, $user_name,$senderListConf,$sender=0) {  
$batch_no = date("Y_m_d_H"); 
$mail = new PHPMailer();   
$mail->IsSMTP(); 
$sender_info = $senderListConf[$sender]; 
if(!$sender_info) 'die �����ʺų�����..............';   // send via SMTP   
$mail->Host = $sender_info['Host'];                       // SMTP servers   
$mail->SMTPAuth = true;                             // turn on SMTP authentication   
$mail->Username = $sender_info['Username'];                          // SMTP username     ע�⣺��ͨ�ʼ���֤����Ҫ�� @����  
$mail->Password = $sender_info['Password'];                         // SMTP password   
$mail->From = $sender_info['Username'];                      // ����������  
$mail->FromName = "�Ա��Ƽ�---TaoBao";                 //   ������ ,���� �й��ʽ������ 
$mail->CharSet = "gb2312";                          // ����ָ���ַ�����  
$mail->Encoding = "base64";   
$mail->AddAddress($sendto_email,$user_name);        // �ռ������������  
$mail->AddReplyTo("ken@cscsws.com","�Ա��Ƽ�");   

//$mail->WordWrap = 50; // set word wrap   
//$mail->AddAttachment("/var/tmp/file.tar.gz");                                                    // attachment  ����1 
//$mail->AddAttachment("/home/www/images/zhuanti/qiujibushui/qiujibushui_attache.jpg", "new.jpg");                                         //����2 
$mail->IsHTML(true);                               // send as HTML   
$mail->Subject = $subject;                         

// �ʼ�����      ����ֱ�ӷ���html�ļ� 
$mail->Body = $body; 
$mail->AltBody ="text/html";   
if($mail->Send())   
{   
info_write("ok.txt","$user_name ���ͳɹ�"); 
}   
else 
{  
info_write("falied.txt","$user_name ʧ��,�����˺�".$sender_info['Username'].",������Ϣ$mail->ErrorInfo"); 
if($senderListConf[$sender+1]) 
{ 
$sender = smtp_mail ( $sendto_email, $subject, $body, $extra_hdrs, $user_name,$senderListConf,($sender+1)); 
} 
} 
return $sender;  
}  ?>