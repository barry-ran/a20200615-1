<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Welcome</title>
<link rel="stylesheet" href="images/sup1.css" type="text/css" />
<link rel="stylesheet" href="/public/images/page.css" type="text/css" />
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php if ($Action=='') {?>
<?php include('head.php');?>
<div class="Nowcate">
<span class="Nowcatedt">��ǰĿ¼</span><em>&raquo;</em><a href="CategoryList.php?y=1&NumberID=<?=substr($_REQUEST['id'],0,4);?>">��ƷĿ¼</a>
<em>&raquo;</em>
<?php
$sqlfl="select * from sup_product_class where NumberID='$_REQUEST[id]'";   //��ȡ���ݱ�
$zycfl=mysql_query($sqlfl,$conn2);  //ִ�и�SQl���
$rowfl=mysql_fetch_array($zycfl);
?>
<a href="ProductList.php?y=1&NumberID=<?=$rowfl['NumberID']?>"><?=$rowfl['7']?></a>
</div>

<div class="Sort"></div>
<div class="gongqiu">
<form name="form1" method="post" action="search.php?Action=mylove">
<table cellspacing="0" cellpadding="0" class="table2 table22">
<tr>
<th width="4%">ѡ��</th>
<th width="54%">��Ʒ����</th>
<th width="12%">��Ʒ����</th>
<th width="10%">��ֵ</th>
<th width="10%">����</th>
<th width="10%">�Խ�״̬</th>
</tr>
<?php
$id=$_REQUEST['id'];    //�����ؼ���
$search="where locks='2' "; 
if ($id!='') $search.=" and directory3 = '$id' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `sup_product`  $search",$conn2));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from sup_product $search  order by time desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn2);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){

$sqlzz="select * from sup_members where number='$row[username]'";   //��ȡ���ݱ�
$zyczz=mysql_query($sqlzz,$conn2);  //ִ�и�SQl���
$rowzz=mysql_fetch_array($zyczz);
$total=mysql_num_rows(mysql_query("SELECT * FROM `product` where sid='$row[id]' ",$conn1));
?>
<tr class="tr1 trevent">
<td>
<?php if($total==0){?> 
<input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>">
<?php } ?>

</td>
<td class="shangpin1">
 <a  href="#art1" onclick="art.dialog.open('sup/show.php?id=<?=$row['id']?>&y=<?=$_REQUEST['y']?>',{title:'��Ʒ����',width:800,lock:true, fixed:true});"  class="product">
<span><?=$row['title']?></span></a>
<br>
��Ʒ״̬��<?=ysk_state($row['state'])?>
<br />
<span class="ashanghu">
��������<?php
$yx_area=new area();  
echo $yx_area->region($row['provinces'],$row['citys'])?>
<br />
�����̣�<?php if ($row['username']=='') {?>���ѿ�<?php }else{?><?=$rowzz['company']?><?php } ?>
(<?=$row['username']?>)</span><span class="ashijian">����ʱ�䣺<?=date("Y-m-d G:i:s",$row['time'])?></span></td>
<td><?=$row['modl']?>
</td>
<td><?=number_format($row['price1'],3);?>Ԫ </td>
<td><?=number_format($row['price2'],3);?>Ԫ </td>
<td>
<?php if($total!=0){?> 
<a  href="#"  class="a_fabu a_fabu2">�ѶԽ�</a>
<?php }else{?>
<a  href="#art1" onclick="art.dialog.open('sup/docking.php?id=<?=$row['id']?>',{title: '������ƽ̨',width:960,height:600,lock:true,fixed:true});" class="a_fabu a_fabu1">δ�Խ�</a>
<?php } ?>

</td>
</tr>
<?php
}
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td style="padding-top:10px;"><input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="�����Խ�" class="x4_input" onclick="Javascript:return confirm('ȷ��Ҫ�����Խ���');" ></td>
<td ><?=$page->paging();?></td>
</tr>
</table>
</form>
</div>
</div>
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