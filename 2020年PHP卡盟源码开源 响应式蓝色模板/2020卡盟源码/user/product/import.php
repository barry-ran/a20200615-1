<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/user_check.php');
include_once('../../jhs_config/error.php');
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php 
$Action=strip_tags($_GET['Action']);
$id=strip_tags($_GET['id']);
$id=inject_check($id);

$total=mysql_num_rows(mysql_query("select * from `product` where id='$id' and  username='$_SESSION[ysk_number]' ",$conn1));
if ($total==0){
echo "<br><br><br><br><br><br><br><center>�Բ��𣬲���ʧ��,ԭ�򣺷Ƿ�������</center>";
exit();
}
if ($Action==''){
$result=mysql_query("select * from product where id='$id'",$conn1);
$row=mysql_fetch_array($result);	
?>
<form action="?Action=save&id=<?=$id?>" method="post" name="add">
<input name="Token" type="hidden" value="<?=genToken()?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td width="10%" class="td_left"><?=$row['modl']?>�鿴��</td>
<td width="90%" class="left">
<a href="#art1" onClick="art.dialog.open('/user/Product/view.php?id=<?=$row['id']?>',{title:'<?=$row['modl']?>��ϸ��Ϣ',width:600,height:400,lock:true, fixed:true});">�鿴</a></td>
</tr>
<tr>
<td width="10%" class="td_left">���뿨�ܣ�</td>
<td width="90%" class="left"><textarea name="content1" cols="70" rows="6" class="biankuan" id="content1"></textarea>
��ʽΪ �˻� ����<font color="#FF0000">��ע���˻������м��и��ո�</font> һ��һ��</td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input"   onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
<?php }elseif ($Action=='save'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}
$content1=strip_tags($_POST['content1']);
if ($content1){
$allArray=(explode("\n", $content1));
foreach($allArray as $value){
$allArray1=(explode(' ',$value));
$card=trim($allArray1[0]);
$password=trim($allArray1[1]);
mysql_query("insert into import_goods set pid='$id',locks=0,card='$card',password='$password',time='$begtime'",$conn1);
}
echo "<script>alert('�ύ�ɹ�!');window.location='index.php';</script>";
exit();
}else{
echo "<script>alert('�Բ�������û�е������ϣ�');;self.location=document.referrer;</script>";
exit();		
}

}?>


</div>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>