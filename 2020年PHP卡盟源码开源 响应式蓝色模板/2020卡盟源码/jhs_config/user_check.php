<?php
//echo '̰��㿨���ܽ�վ��ȫ��Դ����ϵͳ ������أ�www.kycard.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}
if($_SESSION['ysk_number']=='' || !isset($_SESSION['ysk_number'])  ){
echo "<script language=\"javascript\">alert('�Ƿ��������˹���ֻ�Ի�Ա���ţ�');window.location.href='/index.php';</script>";
exit();
}
?>