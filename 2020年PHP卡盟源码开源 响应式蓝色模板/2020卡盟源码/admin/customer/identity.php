<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
if ($Action=="del") {
mysql_query("update members set card_pic='' where id ='$_REQUEST[id]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='ɾ��'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("update members set card_pic='' where id in ($ID_Dele)",$conn1); 
echo "<script>alert('ɾ���ɹ�!');self.location=document.referrer;</script>";
}

if ($Action=="save") {
$card_pic=strip_tags($_POST['card_pic']);
$Id=strip_tags($_POST['Id']);
$online=strip_tags($_POST['online']);
$mypage=strip_tags($_POST['mypage']);
mysql_query("update members set card_lock='$online' where id='$Id'",$conn1); 
if ($online==2){
mysql_query("update members set card_pic='' where id='$Id'",$conn1); 
$Filename='../..'.$card_pic;
if(file_exists($Filename)){
if(unlink($Filename)){
//echo "�ļ�ɾ���ɹ���";
}else{
//echo "�ļ�ɾ��ʧ�ܣ�";
}	
}else{
//echo"Ŀ���ļ�������ѽ��";
}

}
echo "<script>alert('����ɹ�!');window.location='?y=1&page=1';</script>";
}
?>
<div class="Menubox" >
<ul>
<li <?php if ($_REQUEST['y']=='') {?>class="hover"<?php }?>><a href="identity.php">�����</a></li>
<li <?php if ($_REQUEST['y']=='1') {?>class="hover"<?php }?>><a href="identity.php?y=1">δ���</a></li>
</ul>
</div>

<?php if  ($Action=="List" or $Action==""){?>
<form name="add" method="post" action="identity.php" >
<input id="ClassID" name="ClassID" type="hidden" value="">
<input id="y" name="y" type="hidden" value="<?=$_REQUEST['y']?>">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
�ؼ������룺</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯ������</td>
<td class="left">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10%"><select name="keywords" id="keywords">
<option selected="selected" value="number">�ͻ����</option>
<option value="username">�ͻ�����</option>
</select></td>
</tr>
</table>








</td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="ȷ�ϲ�ѯ"  class="chaxun_input" />
</td>
</tr>
</table></form>
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="4%" class="table_top">ID</td>
<td width="11%" class="table_top">���</td>
<td width="15%" class="table_top">�ͻ���</td>

<td width="15%" class="table_top">��ʵ����</td>
<td width="14%" class="table_top">���֤����</td>
<td width="15%" class="table_top">��ϵ�绰</td>
<td width="15%" class="table_top">�����ַ</td>
<td width="11%" class="table_top">����</td>
</tr>
<?php
$keyword=$_REQUEST['keyword'];    //�����ؼ���
$keywords=$_REQUEST['keywords'];  //��ѯ����
$search="where 1=1 and card_pic<>'' ";
if ($_REQUEST['y']=='1') $search.=" and card_lock=0 "; 
if ($_REQUEST['y']!='1') $search.=" and card_lock=1 "; 
if ($keywords!='') $search.=" and $keywords like '%$keyword%' "; 
$total=mysql_num_rows(mysql_query("select * from `members`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from members $search    order by time desc {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){


?>
<tr>
<td height="28"><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td height="28"><?=$row['number']?></td>
<td><?=$row['username']?></td>
<td><?=$row['rname']?></td>
<td><?=$row['card']?></td>
<td><?=$row['phone']?></td>
<td><?=$row['email']?></td>
<td>
<?php if ($_REQUEST['y']!='1'){?>
<a href="<?=$row['card_pic']?>" target="_blank">�鿴</a>
<?php }else{?>
<a href="?Action=edit&id=<?=$row['id']?>&y=<?=$_REQUEST['y']?>&mypage=<?=$_REQUEST['page']?>">�鿴</a>
<?php } ?>
 | <a href="?Action=del&id=<?=$row['id']?>">ɾ��</a></td>
</tr>
<?php
}
?>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="left" style="padding:15px 0px;"><input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="ɾ��" class="x3_input" onclick="return CheckSelect();"></td> 
<td align="center" style="padding:15px 0px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?> </td> 
</tr>
</table>
</form>
<?php }elseif($Action=="edit"){  
$sql="select * from members where id='$_REQUEST[id]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=save" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input id="mypage" name="mypage" type="hidden" value="<?=$_REQUEST['mypage']?>">
<input id="card_pic" name="card_pic" type="hidden" value="<?=$row['card_pic']?>">
<table class="page_table4" cellpadding="0" cellspacing="1" style="margin-top:10px;">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��Ϣ���</td>
</tr>
<tr>
<td width="10%" class="td_left">ƽ̨��ţ�</td>
<td width="90%" class="left"><?=$row['number']?></td>
</tr>
<tr>
<td width="10%" class="td_left">��Ա���ƣ�</td>
<td width="90%" class="left"><?=$row['username']?></td>
</tr>


<tr>
<td class="td_left">��ϵ��������</td>
<td class="left"><?=$row['rname']?></td>
</tr>
<tr>
<td class="td_left">���֤�ţ�</td>
<td class="left"><?=$row['card']?></td>
</tr>

<tr>
<td class="td_left">���֤���ӵ���</td>
<td class="left"><a href="<?=$row['card_pic']?>" target="_blank">����鿴</a></td>
</tr>
<tr>
<td class="td_left">���״̬��</td>
<td class="left"><select name="online" id="online">
<option value="1" selected="selected">���ͨ��</option>
<option value="2">���ʧ��</option>
</select></td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input" />
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
