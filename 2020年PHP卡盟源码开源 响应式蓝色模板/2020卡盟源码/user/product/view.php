<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<body>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/page_class.php');
$Action=strip_tags($_GET['Action']);

if ($Action==''){
$id=strip_tags($_GET['id']);
$ooxx=strip_tags($_GET['ooxx']);
if ($ooxx!=''){
	$_SESSION['ooxx']=$ooxx;
}
$id=inject_check($id);
if($ooxx==''){
$total=mysql_num_rows(mysql_query("select * from `product` where id='$id' and  username='$_SESSION[ysk_number]' ",$conn1));
if ($total==0){
echo "<br><br><br><br><br><br><br><center>�Բ��𣬲���ʧ��,ԭ�򣺷Ƿ�������</center>";
exit();
}
}	
?>
<form action="view.php?Action=save" method="post">
<input name="pid" type="hidden" value="<?=$id?>">

<table cellspacing="1" cellpadding="0" class="table1" >
<tr>
<th width="24%">��������</th>
<th width="35%">����</th>
<th width="41%">����</th>
</tr>
<?php
$search="where  pid='$_REQUEST[id]' and locks=0"; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `import_goods`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="15";
$page=new page($total,$num);
$sql="select * from import_goods $search order by time desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr onMouseOver="this.style.backgroundColor='#f1f1f1';" onMouseOut="this.style.backgroundColor='';">
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td style="text-align:left"><?=substr($row['card'],0,5);?>*****</td>
<td style="text-align:left"><?=substr($row['password'],0,5);?>*****</td>
</tr>
<?php }?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="9%"><input type="submit" name="Del" id="Del" value="���" class="x3_input" onClick="Javascript:return confirm('ȷ��Ҫɾ����');" ></td>
<td width="91%" align="center" style="padding-top:15px; padding-bottom:15px;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?> </td>
</tr>
</table>
</form>
<?php }elseif ($Action=='save'){
	
$pid=strip_tags($_POST['pid']);
$pid=inject_check($pid);

if ($_SESSION['ooxx']!=''){
$total=mysql_num_rows(mysql_query("select * from `product` where id='$pid' and locks=0  ",$conn1));
}else{
$total=mysql_num_rows(mysql_query("select * from `product` where id='$pid' and  username='$_SESSION[ysk_number]' ",$conn1));
}

if ($total==0){
echo "<br><br><br><br><br><br><br><center>�Բ��𣬲���ʧ��,ԭ�򣺷Ƿ�������</center>";
exit();
}else{
mysql_query("delete from import_goods where locks=0 and pid in ($pid)",$conn1);

}
?>
<center><br><br><br><br>����ɹ���</center>
<?php }?>
</body>
</Html>
<script>
function cl(){ 
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>