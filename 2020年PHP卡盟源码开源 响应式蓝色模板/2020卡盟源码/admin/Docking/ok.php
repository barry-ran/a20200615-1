<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
include_once('../../jhs_config/sorting.php');
$Action=strip_tags($_GET['Action']);
$sid=strip_tags($_GET['sid']);
$locks=strip_tags($_GET['locks']);
$keyword=strip_tags($_GET['keyword']);
$status=strip_tags($_GET['status']);
$template=strip_tags($_GET['template']);
$type=strip_tags($_GET['type']);
$keywords=strip_tags($_GET['keywords']);
$ply=strip_tags($_GET['ply']);
$StartYear=strip_tags($_GET['StartYear']);
$StartMonth=strip_tags($_GET['StartMonth']);
$StartDay=strip_tags($_GET['StartDay']);
$StartHour=strip_tags($_GET['StartHour']);
$StartMinute=strip_tags($_GET['StartMinute']);
$EndYear=strip_tags($_GET['EndYear']);
$EndMonth=strip_tags($_GET['EndMonth']);
$EndDay=strip_tags($_GET['EndDay']);
$EndHour=strip_tags($_GET['EndHour']);
$EndMinute=strip_tags($_GET['EndMinute']);
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
$search="where sid=0 and pid<>0 and docking<>0"; 
if ($keywords!='') $search.=" and $type like '%$keywords%' "; 
if ($template!='') $search.=" and modl='$template'"; 
if ($status!='')   $search.=" and state='$status'"; 

if ($StartYear!='') $search.=" and time >=$muyou1 and time <=  $muyou2 "; 
if ($locks!='') $search.=" and locks=0"; 
if ($locks=='') $search.=" and locks=2"; 

############################------------------------�������ʼ��
$id=$_REQUEST['id'];
if     ($Action=="move1"){//******************************************************************************************************************�ö�
#######��ȡ�ʼID
$sql=mysql_query("select * from product  $search order by paixu asc limit 1",$conn1);
$row=mysql_fetch_array($sql);                          
$sorting=$row['paixu']-0.5;
mysql_query("update product set paixu='$sorting' where id='$id'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}elseif($Action=="move2"){
//******************************************************************************************************************����
$sql=mysql_query("select * from product  where id='$id'",$conn1);
$row=mysql_fetch_array($sql);    
$sql1=mysql_query("select * from product $search and paixu<'$row[paixu]'  order by `paixu` desc limit 1 ",$conn1);
$row1=mysql_fetch_array($sql1);   
mysql_query("update product set paixu='$row1[paixu]' where id='$row[id]'",$conn1); 
mysql_query("update product set paixu='$row[paixu]'  where id='$row1[id]'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}elseif($Action=="move3"){//******************************************************************************************************************����
$sql=mysql_query("select * from product  where id='$id'",$conn1);
$row=mysql_fetch_array($sql);    
$sql1=mysql_query("select * from product $search and paixu>'$row[paixu]'  order by `paixu` asc limit 1 ",$conn1);
$row1=mysql_fetch_array($sql1);   
mysql_query("update product set paixu='$row1[paixu]' where id='$row[id]'",$conn1); 
mysql_query("update product set paixu='$row[paixu]'  where id='$row1[id]'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}elseif($Action=="move4"){//******************************************************************************************************************βҳ
#######��ȡ���ID
$sql=mysql_query("select * from product  $search order by paixu desc limit 1",$conn1);
$row=mysql_fetch_array($sql);
$sorting=$row['paixu']+0.5;
mysql_query("update product set paixu='$sorting' where id='$id'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}





////////ɾ������¼
if ($Action=="del") {
$Id=inject_check($_GET['Id']);
//---------������Ʒ������¼ �Ա㷢��վ����
mysql_query("insert into Goods_change set uid='$Id',locks=1",$conn1);
mysql_query("delete from product where id ='$Id'",$conn1);
echo "<script>alert('ɾ���ɹ�!');self.location=document.referrer;</script>";
}


if ($Action=='mylove'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));
###��Ʒ��ͣ
if ($_REQUEST['Del']=='��ͣ'){
$_SESSION['yDel']='��ͣ';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='�ƶ���Ʒ'){
$_SESSION['yDel']='�ƶ���Ʒ';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}


if ($_REQUEST['Del']=='ɾ��'){
foreach($allArray as $value){

//---------������Ʒ������¼ �Ա㷢��վ����
mysql_query("insert into Goods_change set uid='$value',locks=1",$conn1);
mysql_query("delete from product where id ='$value'",$conn1);
}
echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='����'){
foreach($allArray as $value){
$hsql=mysql_query("select * from product where id='$value'",$conn1);
$hi=mysql_fetch_array($hsql);
ysk_date_log(5,$_SESSION['ysk_username'],'�� "'.$hi['title'].'" ��Ʒ״̬�ĳ����� ');		
mysql_query("update product set state='0',reason='' where id=$value",$conn1);}
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='ͨ��'){
foreach($allArray as $value){
$hsql=mysql_query("select * from product where id='$value'",$conn1);
$hi=mysql_fetch_array($hsql);
ysk_date_log(5,$_SESSION['ysk_username'],'�� "'.$hi['title'].'" ��Ʒ���ͨ�� ');	
mysql_query("update product set locks='2'  where id=$value",$conn1);}
echo "<script>alert('�ύ�ɹ�!');self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='���'){
$_SESSION['yDel']='���';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}


if ($_REQUEST['Del']=='����'){
$hsql=mysql_query("select * from product where id='$value'",$conn1);
$hi=mysql_fetch_array($hsql);
ysk_date_log(5,$_SESSION['ysk_username'],'�� "'.$hi['title'].'" ��Ʒ״̬�ĳɽ����� ');	
foreach($allArray as $value){mysql_query("update product set state='2'   where id=$value",$conn1);}
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='�¼�'){
foreach($allArray as $value){
$hsql=mysql_query("select * from product where id='$value'",$conn1);
$hi=mysql_fetch_array($hsql);
ysk_date_log(5,$_SESSION['ysk_username'],'�� "'.$hi['title'].'" ��Ʒ״̬�ĳ��¼��� ');	
mysql_query("update product set state='4'   where id='$value'",$conn1);}
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
}

###��Ʒ�������۸�
if ($_REQUEST['Del']=='��������'){
$_SESSION['yDel']='��������';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}


}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />


<script language="javascript" type="text/javascript" src="/Public/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="/Public/js/city.js"></script>
<?php      if($_SESSION['yDel']=='��ͣ'){?>
<script language="javascript">
$(window).load(function(){
art.dialog.open('product/deal_with.php?Action=stop&isno=<?=$_SESSION['allArray']?>',{lock:true,fixed:true,title:'��ͣ',width:500,height:180});
});
</script>
<?php }elseif($_SESSION['yDel']=='���'){?>
<script language="javascript">
$(window).load(function(){
art.dialog.open('product/deal_with.php?Action=no&isno=<?=$_SESSION['allArray']?>',{lock:true,fixed:true,title:'���',width:500,height:180});
});
</script>
<?php }elseif($_SESSION['yDel']=='�ƶ���Ʒ'){?>
<script language="javascript">
$(window).load(function(){
art.dialog.open('product/deal_with.php?Action=move&isno=<?=$_SESSION['allArray']?>',{lock:true,fixed:true,title:'���',width:500,height:180});
});
</script>

<?php }elseif($_SESSION['yDel']=='��������'){?>
<script language="javascript">
$(window).load(function(){
art.dialog.open('product/deal_with.php?Action=pricing&isno=<?=$_SESSION['allArray']?>',{lock:true,fixed:true,title:'��������',width:600,height:180});
});
</script>
<?php } ?>
</head>
<body onload = "MyTest()">
<?php if ($Action==""){?>
<div class="right">

<form action="ok.php" method="get">
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
�ؼ������룺            </td>
<td class="left">
<input name="keywords" type="text" maxlength="300" id="keywords"  class="biankuan" placeholder="�����������ؼ���">
</td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯ������            </td>
<td class="left">
<select name="type" id="type">
<option selected="selected" value="title">��Ʒ����</option>
<option value="id">��Ʒ���</option>
<option value="price">��Ʒ��ֵ</option>
</select>
<select name="template" id="template">
<option selected="selected" value="">ȫ������</option>
<option value="����">����</option>
<option value="����">����</option>
<option value="ѡ��">ѡ��</option>
<option value="�˹�����">�˹�����</option>
</select>
<select name="status" id="status">
<option selected="selected" value="">ȫ��״̬</option>
<option value="0">����</option>
<option value="1">��ͣ</option>
<option value="2">����</option>
</select></td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯʱ��Σ�</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
</tr>
<tr>
<td class="td_left">
</td>
<td class="left">
<input type="submit" name="btnQuery" value="ȷ�ϲ�ѯ" id="btnQuery" class="chaxun_input" />

</td>
</tr>
</table>
</form>

<form name="form1" method="post" action="?Action=mylove">
<table cellspacing="1" cellpadding="0" class="table4" style=" margin-top:10px;">
<tr>
<td width="5%" height="32" align="center" class="table_top">ѡ��</td>
<td width="5%" height="32" align="center" class="table_top">���</td>
<td width="36%" align="center" class="table_top">��Ʒ����</td>
<td width="8%" align="center" class="table_top">�����̱��</td>
<td width="7%" align="center" class="table_top"> ����/ģ�� </td>
<td width="7%" align="center" class="table_top"> ��ֵ </td>
<td width="6%" align="center" class="table_top">״̬</td>
<td width="8%" align="center" class="table_top">����</td>
<td width="12%" align="center" class="table_top">����ʱ��</td>
<td width="6%" align="center" class="table_top">����</td>
</tr>
<?php
$total=mysql_num_rows(mysql_query("select * from `product`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from product  $search order by paixu asc,id desc,begtime desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
#######��ȡ�ʼID
$result1=mysql_query("select * from product  $search order by paixu asc,begtime desc limit 1",$conn1);
$row1=mysql_fetch_array($result1);
#######��ȡ���ID
$result2=mysql_query("select * from product  $search order by paixu desc,begtime desc limit 1",$conn1);
$row2=mysql_fetch_array($result2);

while ($row=mysql_fetch_array($zyc)){
?>

<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td align="center"><?=$row[id]?></td>
<td align="left" style=" text-align:left; line-height:200%;">
<?=$row['title']?>
<?php if ($row['directory3']!='' && $row['username']!=''){?>
<br><span style="color:#F00"><?=yx_product_class($row['directory3'])?></span> <?php } ?></td>
<td align="center"><?=$row['username']?></td>
<td align="center" style="color:#0000ff"><?=$row['modl']?></td>
<td align="center"><?=$row['price1']?></td>
<td align="center"><?=ysk_state($row['state'])?></td>
<td align="center">
<div class="dirction">
<?=sorting('top',$row1['id'],$row['id'],1,1)?>
<?=sorting('up',$row1['id'],$row['id'],1,1)?>
<?=sorting('down',$row2['id'],$row['id'],1,1)?>
<?=sorting('bottom',$row2['id'],$row['id'],1,1)?>
</div></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td align="center"><a href="?Action=del&Id=<?=$row['id']?>" onClick="Javascript:return confirm('ȷ��Ҫɾ����');">ɾ��</a> </td>
</tr><?php
}
?>

</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td  align="left" style="padding-top:15px; padding-bottom:15px;">

<input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="ɾ��" class="x3_input" onClick="Javascript:return confirm('ȷ��Ҫɾ����');" >
<input type="submit" name="Del" id="Del" value="��������" class="x4_input" onClick="Javascript:return confirm('ȷ��Ҫ���¶�����');" >
<input type="submit" name="Del" id="Del" value="����"  onclick="return CheckSelect();" class="x2_input">
<input type="submit" name="Del" id="Del" value="��ͣ"  onclick="return CheckSelect();" class="x2_input">
<input type="submit" name="Del" id="Del" value="����"  onclick="return CheckSelect();" class="x2_input">
<input type="submit" name="Del" id="Del" value="�¼�"  onclick="return CheckSelect();" class="x2_input">

</td>
<td  align="left" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?></td>
</tr>
</table>
</form>
</div>


<?php }?>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>
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