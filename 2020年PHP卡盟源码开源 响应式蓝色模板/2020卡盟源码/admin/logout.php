
<?php
session_start();
unset($_SESSION['ysk_username']);
unset($_SESSION['ysk_flag']);
unset($_SESSION['ysk_founder']);
echo "<script language=\"javascript\">alert('���ѳɹ��˳���');window.location.href='login.php';</script>";
?>
