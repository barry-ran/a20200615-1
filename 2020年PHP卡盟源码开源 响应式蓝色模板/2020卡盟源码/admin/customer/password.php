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
$id=inject_check($_GET['id']);
mysql_query("delete from password_lock where id ='$id'",$conn1);
echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='ɾ��'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from password_lock where id in ($ID_Dele)",$conn1);
echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
}

?>
<div class="Menubox" >
<ul>
<li class="hover"><a href="password.php">�����б�</a></li>

</ul>
</div>

<?php if  ($Action=="List" or $Action==""){?>
<form name="add" method="post" action="password.php" >
<input id="ClassID" name="ClassID" type="hidden" value="">
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
<td width="9%" height="31" class="table_top">ID</td>
<td width="18%" class="table_top">�ͻ���</td>
<td width="19%" class="table_top">������IP</td>
<td width="20%" class="table_top">����ʱ��</td>
<td width="19%" class="table_top">ɾ��</td>
</tr>
<?php
$pagesize=100;
$keyword=strip_tags($_POST['keyword']);
$keywords=strip_tags($_POST['keywords']);
$search="where 1=1  "; 
if ($keywords!='') $search.=" and $keywords like '%$keyword%' "; 
$total=mysql_num_rows(mysql_query("select * from `password_lock`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from password_lock $search    order by begtime desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){?>
<tr>
<td height="28"><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td><?=$row['username']?></td>
<td><?=$row['yourip']?></td>
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td><a href="?Action=del&id=<?=$row['id']?>">ɾ��</a></td>
</tr>
<?php }?>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="left" style="padding:15px 0px;"><input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="ɾ��" class="x3_input" onclick="return CheckSelect();"></td> 
<td align="center" style="padding:15px 0px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?> </td> 
</tr>
</table>
</form>
<?php }?>
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
