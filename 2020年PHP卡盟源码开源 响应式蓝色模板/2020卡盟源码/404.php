<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
<style>
body, h1, h2, p,dl,dd,dt{margin: 0;padding: 0;font: 12px/1.5 ΢���ź�,tahoma,arial;}
body{background:#efefef;}
h1, h2, h3, h4, h5, h6 {font-size:14px;cursor:default; line-height:240%;}
ul, ol {list-style: none outside none;}
a {text-decoration: none;color:#447BC4}
a:hover {text-decoration: underline;}
.ip-attack{width:600px; margin:200px auto 0;}
.ip-attack dl{ background:#fff; padding:30px; border-radius:10px;border: 1px solid #CDCDCD;-webkit-box-shadow: 0 0 8px #CDCDCD;-moz-box-shadow: 0 0 8px #cdcdcd;box-shadow: 0 0 8px #CDCDCD;}
.ip-attack dt{text-align:center;}
.ip-attack dd{font-size:16px; color:#333; text-align:center;}
.tips{text-align:center; font-size:14px; line-height:50px; color:#999;}
</style>
</head>
<body>
<?php
include_once('jhs_config/conn.php');
include_once('jhs_config/520sfconn.php');
include_once('jhs_config/config.php');
$error=$_REQUEST['error'];

function ysk_error_msg($var){
switch ($var) { 
case   "401": 
echo   "���ã�������վ�Ѿ����ڣ��ܱ�Ǹ,������վ����ϵͳ�Զ��ر�! Ϊ�˲�Ӱ��������ʹ��,�뾡��̷�! �������������,����ϵ���ǵĿͷ�,������£�"; 
break; 
case   "402": 
echo   "����ʧ�ܣ��㲻������3��Сʱ���ظ�ע�ᣡ"; 
break; 
case   "403": 
echo   "����ʧ�ܣ�����ע����Ϣ�ظ��ˣ�"; 
break; 
case   "404": 
echo   "����ʧ�ܣ���֤��Ϣ����ȷ��"; 
break; 
case   "409": 
echo   $Exp_sup_why; 
break; 
case   "ok": 
echo   "��ϲ��������ɹ���"; 
break; 

default:
echo   "�Բ��𣬷Ƿ�������"; 
}
}
?>
<div class="ip-attack">
<dl>
<dt><h1><?=ysk_error_msg($error)?></h1></dt>
<dt><a href="/">������ҳ</a></dt>
</dl>
</div>
</body>
</Html>