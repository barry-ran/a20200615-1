<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Welcome</title>
<link rel="stylesheet" href="images/sup1.css" type="text/css" />
</head>
<body>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$id=inject_check($_REQUEST['id']);
$sqlc="select * from sup_product where id='$id'";   //��ȡ���ݱ�
$zycc=mysql_query($sqlc,$conn2);  //ִ�и�SQl���
$rowc=mysql_fetch_array($zycc);
$sql="select * from sup_members where number='$rowc[username]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn2);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>
<table cellspacing="1" cellpadding="0" class="table2 notd" >
<tr class="tr1">
<td height="32" style="background: #f7fcfe">��Ʒ���ƣ�</td>
<td align="left"><?=$rowc['title']?></td>
</tr>
<?php if ($pss_sjxy_open=='0') {?>
<tr class="tr1">
<td height="32" style="background: #f7fcfe">�̼�������</td>
<td align="left"><?php
$yx_pingjia=new integral();  
echo $yx_pingjia->seller_integral(($row['praise1']-$row['praise3']))?>

</td>
</tr>
<?php } ?>
<tr class="tr1">
<td height="32" style="background: #f7fcfe">��Ʒ��ֵ��</td>
<td align="left"><b style="color:red"><?=number_format($rowc['price1'],3);?>Ԫ </b></td>
</tr>

<tr class="tr1">
<td height="32" style="background: #f7fcfe">��Ʒ�ۼۣ�</td>
<td align="left"><?=number_format($rowc['price2'],3);?> Ԫ</td>
</tr>

<tr class="tr1">
<td height="32" style="background: #f7fcfe">�� �� �̣�</td>
<td align="left">
<?php if ($rowc['username']=='') {?>���ѿ�<?php }else{?><?=$row['company']?><?php } ?>
(<?=$rowc['username']?>)</td>
</tr>


<tr class="tr1">
<td height="32" style="background: #f7fcfe">ʮ��ϻ���</td>
<td align="left">0 ��</td>
</tr>
<tr class="tr1">
<td height="32" style="background: #f7fcfe">����ʱ�䣺</td>
<td align="left"><?=date("Y-m-d G:i:s",$rowc['time'])?></td>
</tr>


</table>

</body>
</Html>