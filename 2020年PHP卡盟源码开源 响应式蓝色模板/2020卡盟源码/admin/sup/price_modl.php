
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
////////��Ӽ�¼
if ($Action=="Addsave") {
$total=mysql_num_rows(mysql_query("select * from `price_modl` where username='admin' ",$conn1));
if ($total>=10){echo "<br><br><br><br><center>�Բ��𣬲���ʧ�ܣ����ֻ�ܼ�10��Ŷ��</center>";exit();}

$title=strip_tags($_POST['title']);
$type=get_check_price($_POST['type']);
$price=get_check_price($_POST['price']);
mysql_query("insert into `price_modl`(title,type,price,username,begtime) " ."values ('$title','$type','$price','admin','$begtime')",$conn1);
echo "<br><br><br><br><center><input id='btnAll' type='button' value='��ӳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}

////////�޸ļ�¼
if ($Action=="editsave") {
$title=strip_tags($_POST['title']);
$type=get_check_price($_POST['type']);
$price=get_check_price($_POST['price']);
$Id=get_check_price($_POST['Id']);
mysql_query("update price_modl set title='$title',type='$type',price='$price'  where id='$Id'",$conn1); 
echo "<script>alert('�޸ĳɹ�!');;window.location='?Action=List';</script>";
exit();
}

////////ɾ������¼
if ($Action=="del") {
mysql_query("delete from price_modl where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='?Action=List';</script>";
exit();
}

////////����ɾ��
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from price_modl where id in ($ID_Dele)",$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='?Action=List';</script>";
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
<input id="add" type="button" value="�������" class="tijiao_input" onclick="$.dialog.open('sup/price_modl.php?Action=add',{title:'ģ�����',width: 600,height: 300,lock:true,fixed:true});" />
</div>

<div class="tishi1">

1�����������Ӱٷֱȣ���������۸���1000Ԫ ������������롰1��������ǡ�1%��  Ҳ����ÿ������10Ԫ<br />
2�����������ӹ̶�ֵ����������۸���1000Ԫ ������������롰1��������ǡ�1Ԫ�� Ҳ����ÿ������1Ԫ<br />
</div>
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="32%" class="table_top">ģ������</td>
<td width="23%" class="table_top">
����
</td>
<td width="16%" class="table_top">
����
</td>
<td width="20%" class="table_top">����ʱ��</td>
<td width="9%" class="table_top">
�޸�
</td>

</tr>
<?php
$Rss="SELECT * FROM price_modl   where username='admin' order by begtime desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><?=$Orzx['title']?></td>
<td><?php if ($Orzx['type']==1){echo "�����Ӱٷֱ�";}else{echo "�����ӹ̶�ֵ";}?></td>
<td><?=$Orzx['price']?></td>
<td><?=date("Y-m-d G:i:s",$Orzx['begtime'])?></td>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a class="a edit" href="?Action=edit&Id=<?=$Orzx['id']?>"></a></td>
    <td><a class="a delete" href="?Action=del&Id=<?=$Orzx['id']?>"></a></td>
  </tr>
</table>


 </td>

</tr>
<?php 
} }?>

</table>
<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td width="27%"  class="td_left">ģ�����ƣ�</td>
<td width="73%"><input name="title" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left">ģ�����ͣ�</td>
<td>
<select name="type" id="type">
<option value="1">�����Ӱٷֱ�</option>
<option value="2">�����ӹ̶�ֵ</option>
</select>
</td>
</tr>
<tr>
<td  class="td_left">���������</td>
<td><input name="price" type="text" class="biankuan" style="width:50px;"> ��������Ҫ���۵����� </td>
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
$sql="select * from price_modl where id='$_REQUEST[Id]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input name="Id" type="hidden" value="<?=$_REQUEST['Id']?>" />

<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">ģ�����ƣ�</td>
<td><input name="title" type="text" class="biankuan" style="width:150px;"  value="<?=$row['title']?>"/></td>
</tr>
<tr>
<td  class="td_left">ģ�����ͣ�</td>
<td>
<select name="type" id="type">
<option value="1" <?php if ($row['type']==1){?> selected="selected"<?php } ?>>�����Ӱٷֱ�</option>
<option value="2" <?php if ($row['type']==2){?> selected="selected"<?php } ?>>�����ӹ̶�ֵ</option>
</select>
</td>
</tr>


<tr>
<td  class="td_left">���������</td>
<td><input name="price" type="text" class="biankuan" style="width:50px;"  value="<?=$row['price']?>"/></td>
</tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���޸�"  id="btnSubmit" class="tijiao_input" />
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