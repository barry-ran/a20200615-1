<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
header("Content-type: text/html; charset=gb2312"); 
include_once('../jhs_config/function.php');
$err=$_REQUEST['err'];
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="/user/css/common.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="right">
<div class="noright">
<?php if($yx_us['kuan']<0 ){?>
�ܱ�Ǹ�����������������ֵ����ܲ���!��<br />
<?php }elseif ($yx_us['frozen_kuan']<$yx_us['min_amount']){?>
�ܱ�Ǹ���������Ķ���Ѻ�����׼�����ֵ����ܲ���!��<br />
<?php }elseif($err=="1"){?>
�ܱ�Ǹ���ñ���Ѿ���������!<br />
<?php }elseif($err=="2"){?>
�ܱ�Ǹ�������������ֵ�����²���!<br />
<?php }elseif($err=="3"){?>
�ܱ�Ǹ������ȷ�������²���!<br />
<?php }else{?>
�ܱ�Ǹ����û�и�ҳ���ʹ��Ȩ��!��<br />
<?php } ?>
<a href="javascript:" onClick="history.go(-1);"><< ������һҳ</a>
</div>
</div>
</body>
</Html>