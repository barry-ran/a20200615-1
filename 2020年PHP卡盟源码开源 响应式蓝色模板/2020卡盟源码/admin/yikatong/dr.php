<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
</head>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
////////�޸ļ�¼
If ($Action=="save") {
$price=get_check_price($_POST['price']);
if ($price<0){
echo "<script language=\"javascript\">alert('�Բ��𣬽���쳣��');history.go(-1);</script>";
exit();
}

$rs=file($_FILES ['file'] ['tmp_name']);
$num=count($rs);
$money=$num*$price;
ysk_date_log(6,$_SESSION['ysk_username'],'���� '.$num.' �żӿ ��ֵΪ "'.$price.'" �ܹ�������Ϊ "'.$money.'" Ԫ');
foreach($rs as $k=>$v){
$rs1=explode(' ',$v);
$yx1=trim(strip_tags($rs1[0]));
$yx2=trim(strip_tags($rs1[1]));
 //var_dump($rs1);exit;
$total=mysql_num_rows(mysql_query("SELECT * FROM `one_cartoon` where  account='$yx1' ",$conn1));
if ($total==0){
mysql_query("insert into one_cartoon (price,account,password,time)"."values ('$price','$yx1','$yx2','$begtime')",$conn1);
}
}



echo "<script>alert('����ɹ�!');self.location=document.referrer;</script>";
}

?>
<body>
<?php if ($Action=='') {?>
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
<tr><td colspan="2" class="table_top" style="text-align: left;">�ӿ����</td></tr>
<tr>
<td class="td_left">����˵��</td>
<td>�˻���������ĸ��ͷ ��ʽΪ.txt �ļ� �˻��ո�����1��1��</td>
</tr>
<tr>
<td class="td_left">�����ļ�</td>
<td>
<input name="file" type="file" id="file" size="40" /></td>
</tr>
<tr>
<td class="td_left">�ӿ��ֵ��</td>
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

<?php } ?>
</body>
</Html>
