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


////////�޸Ļ����¼
If ($Action=="djsave"){
if ($admin['passwords']!=$papa){
echo "<script>alert('�Բ������Ĳ�����������!');self.location=document.referrer;</script>";
exit();
}

$price=get_check_price($_POST['frozen_kuan']);
$biao_kuan=get_check_price($_POST['biao_kuan']);
$di_kuan=get_check_price($_POST['di_kuan']);
$id=inject_check($_GET['Id']);
$sql="select * from members where id='$id'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
if ($row['kuan']<$price) {
echo "<script language=\"javascript\">alert('�Բ��𣬸û�Ա����ת�����Ǯ��');history.go(-1);</script>";
exit();
}
$zzkuan1=$row['kuan']-$price;
$zzkuan2=$row['frozen_kuan']+$price;
$zzkuan3=$row['biao_kuan']+$biao_kuan;
$zzkuan4=$row['di_kuan']+$di_kuan;
if ($price!='0' or $price!='' ){
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime) " .
"values ('���ת�����','$price','$row[kuan]','$zzkuan1','$row[number]','$begtime')",$conn1);

}
mysql_query("update members set max_amount='$zzkuan3',min_amount='$zzkuan4',kuan='$zzkuan1',frozen_kuan='$zzkuan2' where id='$id'",$conn1); 
echo "<script>alert('�ύ�ɹ�!');;window.location='?Action=List';</script>";
}
////////�޸Ļ����¼
If ($Action=="hksave") {
	if ($admin['passwords']!=$papa){
echo "<script>alert('�Բ������Ĳ�����������!');self.location=document.referrer;</script>";
exit();
}
$price=get_check_price($_POST['price']);
$id=inject_check($_POST['Id']);
$sql="select * from members where id='$id'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
if ($row['goods_kuan']<$price) {
echo "<script language=\"javascript\">alert('�Բ��𣬸û�Ա�����ת����Ǯ��');history.go(-1);</script>";
exit();
}
$zzgoods_kuan=$row['goods_kuan']-$price;
$zzkuan=$row['kuan']+$price;
mysql_query("insert into `details_funds` (title,incomes,befores,afters,number,begtime)"."values ('������ת���','$price','$row[kuan]','$zzkuan','$row[number]','$begtime')",$conn1);

mysql_query("update members set goods_kuan='$zzgoods_kuan',kuan='$zzkuan' where id='$id'",$conn1); 
echo "<script>alert('�ύ�ɹ�!');;window.location='?Action=List';</script>";
}


?>
<?php if ($Action=="List" or $Action==""){ ?>

<form name="add" method="get" action="customerbalance.php" >
<table cellspacing="1" cellpadding="0" class="page_table2">
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
<select name="keywords" id="keywords">
<option selected="selected" value="number">�ͻ����</option>
<option value="username">�û���</option>
<option value="rname">��ϵ������</option>
<option value="qq">QQ����</option>
<option value="phone">�ֻ�����</option>
</select>

<select name="level" id="level">
<option selected="selected" value="">ȫ������</option>
<?php
$Rss="SELECT * FROM level  order by time desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<option value="<?=$Orzx['id']?>"><?=$Orzx['title']?></option>
<?php 
} }?>
</select>


<select name="locks" id="locks">
<option selected="selected" value="">ȫ��״̬</option>
<option value="0">��ͨ</option>
<option value="1">��ֹ</option>
</select>

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
<table cellspacing="1" cellpadding="0" class="page_table">
<tr>
<td width="12%" class="table_top">
<?php if ($_REQUEST['a']=='desc'){?>
<a href="?paixu=number&a=asc&abcd=<?=$_REQUEST['abcd']?>">���</a>
<?php }else{ ?>
<a href="?paixu=number&a=desc&abcd=<?=$_REQUEST['abcd']?>">���</a>
<?php }?></td>
<td width="13%" class="table_top">�û���</td>
<td width="12%" class="table_top">��˾����</td>
<td width="12%" class="table_top">�ͻ�����</td>

<td width="8%" class="table_top">
<?php if ($_REQUEST['b']=='desc'){?>
<a href="?paixu=kuan&b=asc&abcd=<?=$_REQUEST['abcd']?>">���</a>
<?php }else{ ?>
<a href="?paixu=kuan&b=desc&abcd=<?=$_REQUEST['abcd']?>">���</a>
<?php }?></td>
<td width="8%" class="table_top"><?php if ($_REQUEST['c']=='desc'){?>
<a href="?paixu=goods_kuan&c=asc&abcd=<?=$_REQUEST['abcd']?>">����</a>
  <?php }else{ ?>
  <a href="?paixu=goods_kuan&c=desc&abcd=<?=$_REQUEST['abcd']?>">����</a>
  <?php }?></td>
<td width="8%" class="table_top">
������</td>
<td width="10%" class="table_top">������</td>
</tr>
<?php
$keyword=strip_tags($_GET['keyword']);    //�����ؼ���
$keywords=strip_tags($_GET['keywords']);  //��ѯ����
$level=strip_tags($_GET['level']);        //��ѯ�ȼ�
$locks=strip_tags($_GET['locks']);        //�Ƿ��ֹ
$paixu=strip_tags($_GET['paixu']);        //��������
$abcd=strip_tags($_GET['abcd']);          //�¼�����
$search="where 1=1 "; 
if ($keywords!='') $search.=" and $keywords like '%$keyword%' "; 
if ($level!='')    $search.=" and level ='$level'"; 
if ($locks!='')    $search.=" and locks ='$locks'"; 
if ($abcd!='')     $search.=" and agent ='$abcd'"; 
$sorting="";
if ($paixu!='' and $_REQUEST['a']!='' ) $sorting.=" order by  $paixu $_REQUEST[a],id desc "; 
if ($paixu!='' and $_REQUEST['b']!='' ) $sorting.=" order by  $paixu $_REQUEST[b],id desc "; 
if ($paixu!='' and $_REQUEST['c']!='' ) $sorting.=" order by  $paixu $_REQUEST[c],id desc "; 
if ($paixu=='') $sorting.=" order by  number desc "; 
$total=mysql_num_rows(mysql_query("SELECT id,level,username,number,company,kuan,goods_kuan,frozen_kuan,zong_kuan FROM `members`  $search ",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);

$sql="select id,level,username,number,company,kuan,goods_kuan,frozen_kuan,zong_kuan  from members $search $sorting  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr>
<td height="28"><?=$row['number']?></td>
<td><?=$row['username']?></td>
<td><?=$row['company']?></td>
<td><?php
$sql1="select * from level where id='$row[level]'";   //��ȡ���ݱ�
$zyc1=mysql_query($sql1,$conn1);  //ִ�и�SQl���
$row1=mysql_fetch_array($zyc1);
?><?=$row1['title']?></td>
<td><?=number_format($row['kuan'],3);?></td>
<td><a href="?Action=hk&id=<?=$row['id']?>"><span style="color:#009933; text-decoration:underline"><?=number_format($row['goods_kuan'],3);?></span></a></td>
<td><a href="?Action=dj&id=<?=$row['id']?>"><span style="color:#009933; text-decoration:underline"><?=number_format($row['frozen_kuan'],3);?></span>   </a>  </td>
	<td><?=number_format($row['zong_kuan'],3);?></td>
</tr>
<?php
$myprice1=$myprice1+$row['kuan'];
$myprice2=$myprice2+$row['goods_kuan'];
$myprice3=$myprice3+$row['frozen_kuan'];
$myprice4=$myprice4+$row['zong_kuan'];
}
?>
<tr>
<td height="28">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>��ҳ�ϼƣ�</td>
<td><b style="color:red"><?=number_format($myprice1,3)?>Ԫ</b></td>
<td><b style="color:red"><?=number_format($myprice2,3)?>Ԫ</b></td>
<td><b style="color:red"><?=number_format($myprice3,3)?>Ԫ</b></td>
<td><b style="color:red"><?=number_format($myprice4,3)?>Ԫ</b></td>
</tr>

<tr>
<td height="28">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>�ܹ��ϼƣ�</td>
<td><?php
$res=mysql_query("SELECT sum(kuan)    from members $search  ",$conn1);
$sum=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum,3);?>Ԫ</b></td>
<td><?php
$res=mysql_query("SELECT sum(goods_kuan)    from members $search  ",$conn1);
$sum1=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum1,3);?>Ԫ</b>
</td>
<td><?php
$res=mysql_query("SELECT sum(frozen_kuan)    from members $search  ",$conn1);
$sum2=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum2,3);?>Ԫ</b>
</td>
<td><?php
$res=mysql_query("SELECT sum(zong_kuan)    from members $search  ",$conn1);
$sum3=mysql_result($res,0);
?><b style="color:red"><?=number_format($sum3,3);?>Ԫ</b>
</td>
</tr>
<tr style="">
<td colspan="8">
<?php if ($total!=0){?><?=$page->paging();?><?php }?>     
</td>
</tr>
</table>
</form>
</div>
<?php }elseif($Action=="dj"){  
$sql="select * from members where id='$_REQUEST[id]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=djsave" method="post" name="add">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">�������޸�</td>
</tr>
<tr>
<td class="td_left">��Ա��ţ�</td>
<td class="td_right"><?=$row['number']?></td>
</tr>
<tr>
<td class="td_left">��Ա��</td>
<td class="td_right"><?=number_format($row['kuan'],3);?> Ԫ</td>
</tr>
<tr>
<td class="td_left">�����</td>
<td class="td_right"><?=number_format($row['frozen_kuan'],3);?> Ԫ</td>
</tr>
<tr>
<td class="td_left">��׼��</td>
<td class="td_right"><?=number_format($row['max_amount'],3);?> Ԫ
</td>
</tr>

<tr>
<td class="td_left">��ͱ�����</td>
<td class="td_right"><?=number_format($row['min_amount'],3);?> Ԫ
</td>
</tr>
<tr>
<td class="td_left">��ӱ�׼��</td>
<td class="td_right"><input name="biao_kuan" type="text" class="biankuan" onkeyup="clearNoNum(this)" /> Ԫ
</td>
</tr>
<tr>
<td class="td_left">�����ͱ�����</td>
<td class="td_right"><input name="di_kuan" type="text" class="biankuan" onkeyup="clearNoNum(this)" /> Ԫ
</td>
</tr>
<tr>
<td class="td_left">ȷ�϶���ӿ</td>
<td class="td_right"><input name="frozen_kuan" type="text" class="biankuan" onkeyup="clearNoNum(this)" /> Ԫ
</td>
</tr>
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��ȫ��֤</td>
</tr>
<tr>
<td width="10%" class="td_left">���������Ĳ������룺</td>
<td width="90%" class="left"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" /> </td>
</tr>
<tr>
<td class="td_left">&nbsp;

</td>
<td class="td_right">
<input type="submit" name="btnSubmit" value="ȷ���޸�" id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();"/>
<input type="button" value="�ر�" class="fanhui_input" onClick="cl()"  /> 
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="hk"){  
$sql="select * from members where id='$_REQUEST[id]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>
<form action="?Action=hksave" method="post" name="add" >
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">������Ʒ����ת���</td>
</tr>
<tr>
<td width="10%" class="td_left"> �ͻ���� ��</td>
<td width="90%" class="left"><?=$row['number']?>
</td>
</tr>
<tr>
<td width="10%" class="td_left"> δת���� ��</td>
<td width="90%" class="left"><?=$row['goods_kuan']?> Ԫ</td>
</tr>

<tr>
<td width="10%" class="td_left"> ת���Ľ�� ��</td>
<td width="90%" class="left">
<input name="price" type="text" class="biankuan" onkeyup="clearNoNum(this)" /> Ԫ
</td>
</tr>
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��ȫ��֤</td>
</tr>
<tr>
<td width="10%" class="td_left">���������Ĳ������룺</td>
<td width="90%" class="left"><input name="papa" type="password" style="width:150px;" value="" class="biankuan" id="papa" /> </td>
</tr>

<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���޸�"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();"/>
</td>
</tr>
</table>
</form>
<?php } ?>

</body>
</Html>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo(){



if(checkspace(document.add.papa.value)) {
document.add.papa.focus();
alert("�Բ�������û���������Ĳ��������أ�");
return false;
}

}
function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</script>