<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/user_check.php');
include('../../jhs_config/error.php');
$Action=$_REQUEST['Action'];
$total=mysql_num_rows(mysql_query("select * from `Store_class` where username='$_SESSION[ysk_number]' ",$conn1));
////////��Ӽ�¼
if ($Action=="del"){
$Id=inject_check($_GET['Id']);
mysql_query("delete from Store_class where id ='$Id' and  username='$_SESSION[ysk_number]'",$conn1);
mysql_query("update `product` set `Store_class`='0' where username='$_SESSION[ysk_number]'  and Store_class in ($Id)",$conn1);
echo "<script>alert('ɾ���ɹ�!');self.location=document.referrer;</script>";
}



if ($Action=="Addsave") {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}


if ($total>=$yx_us['erdu1']){echo "<br><br><br><center>�Բ��𣬲���ʧ�ܣ����ֻ�ܼ�{$yx_us['erdu1']}��Ŷ��</center>";exit();}
$title=strip_tags($_POST['title']);
mysql_query("insert into `Store_class`(title,username) " ."values ('$title','$_SESSION[ysk_number]')",$conn1);
echo "<br><br><br><center><input id='btnAll' type='button' value='��ӳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}

////////�޸ļ�¼
If ($Action=="editsave") {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}
$title=strip_tags($_POST['title']);
mysql_query("update Store_class set title='$title'  where id='$_POST[Id]' and username='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('�޸ĳɹ�!');;window.location='?Action=List';</script>";
exit();
}

if ($Action=="buysave") {
$erdu=pot_check_price($_POST['erdu']);
$price=pot_check_price($site_price_1*$erdu);

/*�жϻ�Ա����Ƿ��㹻*/
if ($yx_us['kuan']-$price<0){
echo "<script>alert('����ʧ�ܣ��������㣡');;self.location=document.referrer;</script>";
exit();	
}

mysql_query("insert into `details_funds` set title='����{$erdu}��������Ŀ���',spendings='$price',befores='$yx_us[kuan]',afters='$price',number='$_SESSION[ysk_number]',begtime='$begtime'",$conn1);
mysql_query("update members set kuan=kuan-$price,erdu1=erdu1+$erdu where number='$_SESSION[ysk_number]'",$conn1); 

echo "<br><br><br><center><input id='btnAll' type='button' value='����ɹ�!'  onClick='cl()' class='tijiao_input' /></center>";


}

?>
<script>
function cl()
{ 
var win = art.dialog.open.origin;//��Դҳ��
// �����ҳ�����ػ��߹ر����ӶԻ���ȫ����ر�
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
</head>
<body>
<?php if ($Action=="List" or $Action==""){?>
<div class="gn">
<input type="button" value="��ӷ���" class="tijiao_input" onclick="$.dialog.open('product/Store_class.php?Action=add',{title:'�������',width: 600,lock:true,fixed:true});" />

<input  type="button" value="��ȹ���" class="tijiao_input" onclick="$.dialog.open('product/Store_class.php?Action=buy',{title:'��ȹ���',width: 600,lock:true,fixed:true});" />


���ö�ȣ�<span style="color: #0a0;"><?=$yx_us['erdu1']-$total?></span> ��

</div>



<table cellspacing="1" cellpadding="0" class="page_table"  style="margin-top:10px;">
<tr>
<td align="left" class="table_top">��������</td>
<td width="10%" class="table_top">
  �޸�
</td>

</tr>
<?php
$Rss="SELECT * FROM Store_class   where username='$_SESSION[ysk_number]' order by id desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24" align="left"><?=$Orzx['title']?></td>
<td>
<a href="?Action=edit&Id=<?=$Orzx[id]?>">�޸�</a>
<a href="?Action=del&Id=<?=$Orzx[id]?>" onclick="Javascript:return confirm('ȷ��Ҫɾ����');">ɾ��</a> 
</td>

</tr>
<?php 
} }?>

</table>
<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td width="27%"  class="td_left">�������ƣ�</td>
<td width="73%"><input name="title" type="text" class="biankuan" style="width:150px;" maxlength="10" /> 10��������</td>
</tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�����"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>

<?php }elseif($Action=="edit"){  
$Id=inject_check($_GET['Id']);
$sql="select * from Store_class where id='$Id' and username='$_SESSION[ysk_number]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input name="Id" type="hidden" value="<?=$_REQUEST['Id']?>" />
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">�������ƣ�</td>
<td><input name="title" type="text" class="biankuan" style="width:150px;"  value="<?=$row['title']?>"/>
  10��������</td>
</tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���޸�"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="buy"){  ?>
<form name="add" method="post" action="?Action=buysave" >
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">��ȹ���</td>
<td><select name="erdu" id="erdu">
<option value="1" selected="selected">1�� <?=number_format($site_price_1,3)?> <?=$moneytype?></option>
<option value="2">2�� <?=number_format($site_price_1*2,3)?> <?=$moneytype?></option>
<option value="3">3�� <?=number_format($site_price_1*3,3)?> <?=$moneytype?></option>
<option value="4">4�� <?=number_format($site_price_1*4,3)?> <?=$moneytype?></option>
<option value="5">5�� <?=number_format($site_price_1*5,3)?> <?=$moneytype?></option>
<option value="6">6�� <?=number_format($site_price_1*6,3)?> <?=$moneytype?></option>
<option value="7">7�� <?=number_format($site_price_1*7,3)?> <?=$moneytype?></option>
<option value="8">8�� <?=number_format($site_price_1*8,3)?> <?=$moneytype?></option>
<option value="9">9�� <?=number_format($site_price_1*9,3)?> <?=$moneytype?></option>
<option value="10">10�� <?=number_format($site_price_1*10,3)?> <?=$moneytype?></option>
</select></td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�Ϲ���"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>

<?php } ?>
</body>
</Html>
<script>
function CheckAll(value,obj)  {
var form=document.getElementsByTagName("form")
for(var i=0;i<form.length;i++){
for (var j=0;j<form[i].elements.length;j++){
if(form[i].elements[j].type=="checkbox"){ 
var e = form[i].elements[j]; 
if (value=="selectAll"){e.checked=obj.checked}     
else{e.checked=!e.checked;} 
}
}
}
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>