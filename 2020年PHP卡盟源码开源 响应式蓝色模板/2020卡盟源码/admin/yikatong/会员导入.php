<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/css.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="../editor/kindeditor.js"></script>
<script charset="utf-8" src="../editor/lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#editor_id');
});

</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image3').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url3').val(),
clickFn : function(url, title, width, height, border, align) {
K('#url3').val(url);
editor.hideDialog();
}
});
});
});
});
</script>
</head>
<?php
include('../../jhs_config/conn.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
////////�޸ļ�¼
If ($Action=="save") {
$price=$_POST['price'];     //// ���
$time=date("Y-m-d h:i:s");  ///   ʱ��

$rs=file($_FILES ['file'] ['tmp_name']);
foreach($rs as $k=>$v){
$rs1=explode('	',$v);

$Rss="select * from members order  by id desc limit 1 ";        //��ȡ���ݱ�
$Orz=mysql_query($Rss,$conn1);
$Orzx=mysql_fetch_array($Orz);
$youid=$Orzx['id']+2;
 //var_dump($rs1);exit;
 
if ($rs1[3]=="ע���û���V1�� "){
 $site_level='1';
}elseif ($rs1[3]=="�׽��û���V2�� "){
 $site_level='2';
}elseif ($rs1[3]=="��ʯ�û���V3�� "){
 $site_level='3';
}elseif ($rs1[3]=="�߼������̣�V4�� "){
 $site_level='4';
}elseif ($rs1[3]=="�ؼ������̣�V5�� "){
 $site_level='5';
}elseif ($rs1[3]=="�������̣�V6�� "){
 $site_level='6';
}elseif ($rs1[3]=="��Ӣ�ܴ���V7�� "){
 $site_level='7';
}elseif ($rs1[3]=="�ʹ��ܴ���V8�� "){
 $site_level='8';
}
 $Local_Ip=Local_Ip();
$sql="insert into members (id,type,level,username,password,passwords,number,agent,company,rname,card,qq,email,phone,address,kuan,goods_kuan,frozen_kuan,zong_kuan,biao_kuan,di_kuan,integral,buy_fen,mai_fen,chengfa1,chengfa2,fabegtime,fahits,buyer_credit,seller_credit,power1,power2,power3,power4,power5,power6,power7,power8,power9,power10,power11,power12,power13,power14,power15,power16,power17,power18,power19,power20,power21,power22,power23,power24,power25,power26,power27,power28,power29,power30,locks,time,lost_time,login_time,lost_ip,login_ip,lost_dz,login_dz,ban,pingjia0,pingjia1,pingjia2,pingjia3,pingjia4,pingjia5,pingjia6,pingjia7,begtime,qiandaojf,giftjf,vipedu,diyici) " .
"values ('','','$site_level','$rs1[1]','password','$passwords','$rs1[0]','$rs1[4]','$rs1[2]','$rname','$rs1[7]','$rs1[6]','$rs1[8]','$rs1[5]','$address','0','0','0','$rs1[10]','0','0','0','0','0','0','0','','','0','0','0','0','0','0','0','1','0','0','0','1','0','0','1','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',now(),now(),now(),'$Local_Ip','$Local_Ip','$yydz','$yydz','','0','0','0','0','0','0','0','0','$begtime','0','0','0','0')";
mysql_query($sql,$conn1);
}



echo "<script>alert('����ɹ�!');;self.location=document.referrer;</script>";
}

?>
<body>
<?php if ($Action=='') {?>
<div style="padding:10px;">
<script>
function import_check(){
var f_content = document.getElementById('file').value;
var fileext=f_content.substring(f_content.lastIndexOf("."),f_content.length)
fileext=fileext.toLowerCase()
if ( fileext !='.txt') {
alert("�Բ��𣬵������ݸ�ʽ������.txt��ʽ�ļ�Ŷ������������ʽ�������ϴ���лл ��");            
return false;
}
}
</script>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="?Action=save" onsubmit="return import_check();">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr><td colspan="2" class="table_top" style="text-align: left;">��ֵ������</td></tr>

<tr>
<td class="td_left">�����ļ�</td>
<td>
<input name="file" type="file" id="file" size="40" /></td>
</tr>
<tr>
<td class="td_left">һ��ͨ��ֵ��</td>
<td class="left"><select name="price" id="price">
<option value="1" selected="selected">1Ԫ</option>

<option value="5">5Ԫ</option>
<option value="10">10Ԫ</option>
<option value="50">50Ԫ</option>
<option value="100">100Ԫ</option>
<option value="300">300Ԫ</option>
<option value="1000">1000Ԫ</option>
<option value="5000">5000Ԫ</option>
</select></td>
</tr>


<tr>
<td></td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�ϵ���"  id="btnSubmit" class="tijiao_input" /></td>
</tr>
</table>
</form>

</div>
<?php } ?>
</body>
</Html>
