
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
$total=mysql_num_rows(mysql_query("select * from `level` ",$conn1));
if ($total>=10){
echo "<br><br><br><br><center>�Բ��𣬲���ʧ�ܣ����ֻ�ܼ�10��Ŷ��</center>";
exit();
}


$title=strip_tags($_POST['title']);
$type=strip_tags($_POST['type']);
$price=get_check_price($_POST['price']);

ysk_date_log(6,$_SESSION['ysk_username'],' �����һ�������� "'.$title.'" �Ļ�Ա����');
mysql_query("insert into `level` (title,type,price,time) " ."values ('$title','$type','$price','$begtime')",$conn1);
echo "<br><br><br><br><center><input id='btnAll' type='button' value='��ӳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}

////////�޸ļ�¼
if ($Action=="editsave") {
$title=strip_tags($_POST['title']);
$type=strip_tags($_POST['type']);
$price=get_check_price($_POST['price']);
$y1=strip_tags($_POST['y1']);
$y2=get_check_price($_POST['y2']);
$Id=get_check_price($_POST['Id']);
if ($y1<>$title){
ysk_date_log(6,$_SESSION['ysk_username'],' ����Ա���������� "'.$y1.'" �޸ĳ��� "'.$title.'"');
}
if ($y2<>$price){
ysk_date_log(6,$_SESSION['ysk_username'],' ����Ա���������� "'.$title.'" �������� "'.$y2.'" Ԫ�޸ĳ��� "'.$price.'" Ԫ');
}

mysql_query("update level set title='$title',type='$type',price='$price'  where id='$Id'",$conn1); 
echo "<script>alert('�޸ĳɹ�!');;window.location='?Action=List';</script>";
exit();
}

////////ɾ������¼
if ($Action=="del") {
mysql_query("delete from level where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='?Action=List';</script>";
exit();
}

////////����ɾ��
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from level where id in ($ID_Dele)",$conn1);
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
<input id="add" type="button" value="�������" class="tijiao_input" onclick="$.dialog.open('level.php?Action=add',{title:'�ͻ��������',width: 600,height: 300,lock:true,fixed:true});" />
</div>

<div class="tishi1">
1��ƽ̨����ǰ���ȶ���ü����պ���ò�Ҫ������µļ��������Ҫ�����¼���ֻ���Ǳ�ԭ�м�����͵ļ���<br />
2��ÿ����ϵ�ļ������밴�ͼ�-->�߼���˳����ӣ�����ͼ�����Ϊע���Ĭ�ϼ��𣬱��羭����ϵ�д�һ�㾭����->�߼�������->�����ܾ����̣�ֱ����ϵ��һ��ֱ����->�߼�ֱ����->����ֱ���̣�<br />
3��ϵͳ����Խ�࣬���۹���Խ���ӣ�����������պ����������Լ����ʵ��������ɣ�<br />
4���������Ʒ���ж��ۺ�����ӵļ��𣬱���Ϊÿ����Ʒ���¶��ۣ���������Ӽ�������ۼ۸�<br />
5��ǿ�ҽ����ҽ�ÿ����ϵ�ļ��������2-4���������Ӧ��ϵ����Ҫ�༶����������Ǿ�������飬����ʹ��ģ�嶨�ۻ��ܼ۵ķ�ʽ�������۸�<br />
6��������ϵ�����󲻿�ɾ����
</div>
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="25%" class="table_top">
��������
</td>
<td width="30%" class="table_top">
��������
</td><td width="15%" class="table_top">
ͼ��
</td>
<td width="15%" class="table_top">�����۸�</td>
<td width="15%" class="table_top">
�޸�
</td>

</tr>
<?php
$Rss="SELECT * FROM level  order by time desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><?=$Orzx['title']?></td>
<td><?=$Orzx['type']?></td>
<td><img src="/Public/images/v<?=$Orzx['id']?>.png"></td>
<td><?=$Orzx['price']?></td>
<td><a class="a edit" href="?Action=edit&Id=<?=$Orzx['id']?>"></a> </td>

</tr>
<?php 
} }?>

</table>
<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td width="27%"  class="td_left">�ͻ��������ƣ�</td>
<td width="73%"><input name="title" type="text" class="biankuan" style="width:150px;" /></td>
</tr>
<tr>
<td  class="td_left">������ϵѡ��</td>
<td><select name="type" id="type">
<option value="������ϵ" selected="selected">������ϵ</option>
</select></td>
</tr>
<tr>
<td  class="td_left">�����۸�</td>
<td><input name="price" type="text" class="biankuan" style="width:150px;" /></td>
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
$sql="select * from level where id='$_REQUEST[Id]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input id="y1" name="y1" type="hidden" value="<?=$row['title']?>">
<input id="y2" name="y2" type="hidden" value="<?=$row['price']?>">

<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">�ͻ��������ƣ�</td>
<td><input name="title" type="text" class="biankuan" style="width:150px;"  value="<?=$row['title']?>"/></td>
</tr>
<tr>
<td  class="td_left">������ϵѡ��</td>
<td><select name="type" id="type">
<option value="������ϵ" <?php if ($row['type']=='������ϵ'){?> selected="selected"<?php } ?>>������ϵ</option>
</select></td>
</tr>
<tr>
<td  class="td_left">�����۸�</td>
<td><input name="price" type="text" class="biankuan" style="width:150px;"  value="<?=$row['price']?>"/></td>
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