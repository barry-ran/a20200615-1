<?php
//echo '�ۺ��翨��ϵͳ www.juheshe.cn Se7en QQ:94170844  2018��9��14�� Se7en QQ:94170844';
?>
<?php
if($_SESSION['ysk_username']==''){
echo "<script language=\"javascript\">window.location.href='login.php';</script>";
exit();
}
$osql=mysql_query("select * from `administrator`  where username='$_SESSION[ysk_username]'",$conn1);
$admin=mysql_fetch_array($osql);
//-------------------------------�٣�û��������Ҫ��ô�����أ�
if ($_POST['papa']!=''){
$papa=md5($_POST['papa']);
if ($admin['passwords']!=$papa){
echo "<script>alert('�Բ������Ĳ�����������!');self.location=document.referrer;</script>";
exit();
}
}
?>