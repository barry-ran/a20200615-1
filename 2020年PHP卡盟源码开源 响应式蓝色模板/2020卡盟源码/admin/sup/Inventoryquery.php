<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];

if ($_POST['Del']=='ɾ��') {
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from product where id in ($ID_Dele)",$conn1);
echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
exit();
}

if ($_POST['Del']=='ͬ������') {
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));    ////�� explode �� | �����ݸ���������

foreach($allArray as $value) {
$presult=mysql_query("select * from product where id='$value'",$conn1);
$pro=mysql_fetch_array($presult);
$uresult=mysql_query("select * from sup_product where id='$pro[sid]'",$conn2);
$uro=mysql_fetch_array($uresult);
////////////////-------------�ж�Sup��Ʒ�Ƿ����
if ($uro){
mysql_query("update product set price='$uro[price]',price1='$uro[price1]',price2='$uro[price2]',state='$uro[state]' where id='$value'",$conn1); 
}
}
echo "<script>alert('�����ɹ�!');;self.location=document.referrer;</script>";
exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Welcome</title>
<link rel="stylesheet" href="images/sup1.css" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php include('head.php');?>
<form name="add" method="post" action="Inventoryquery.php?y=3" >
<table cellspacing="1" cellpadding="0" class="page_table2">
<tr>
<td height="32" class="td_left">
�ؼ������룺</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="" />
<select name="keywords" id="keywords">
<option selected="selected" value="supid">��ƷID</option>
<option value="title">��Ʒ����</option>
</select></td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯ���ͣ�</td>
<td class="left">
<select name="modl" id="modl">
<option selected="selected" value="">ȫ������</option>
<option value="����">����</option>
<option value="����">����</option>
<option value="ѡ��">ѡ��</option>
<option value="�˹�����">�˹�����</option>
<option value="�˺�ֱ��">�˺�ֱ��</option>
<option value="����ֱ��">����ֱ��</option>
<option value="�ӿ�ֱ��">�ӿ�ֱ��</option>
</select>
<select name="state" id="state">
<option selected="selected" value="">ȫ������״̬</option>
<option value="-1">SUP��Ʒ���۵���</option>
<option value="-2">SUP��Ʒ���۵���</option>
<option value="-3">������Ϊ������</option>
<option value="-4">SUP��Ʒδ�ϼ�</option>
<option value="-5">SUP��Ʒδͨ�����</option>
<option value="-6">SUP��ƷΪ������</option>
<option value="-7">SUP��Ʒ��ɾ��</option>
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
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td class="table_top" width="4%">ѡ��</td>
<td width="41%" height="32" class="table_top">��Ʒ����</td>
<td class="table_top" width="9%">����</td>
<td class="table_top" width="8%"> ��ֵ </td>
<td class="table_top" width="9%"> ���� </td>
<td class="table_top" width="9%"> ״̬ </td>
<td class="table_top" width="20%"> SUP��ƷID|����|����״̬ </td>
</tr>
<?php
$keyword=$_REQUEST['keyword'];        //�����ؼ���
$keywords=$_REQUEST['keywords'];      //��ѯ����
$modl=$_REQUEST['modl'];      //��ѯ����
$state=$_REQUEST['state'];    //�Ƿ�״̬
$search="where 1=1 and modl<>'' and sid<>0"; 
if ($keyword!='')  $search.="  and $keywords like '%$keyword%' "; 
if ($template!='') $search.="  and modl ='$modl'"; 
if ($state!='' and $state!='0' )    $search.=" and state ='$state'"; 
if ($state=='0' )  $search.=" and state <0"; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from product  $search order by id desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
$presult=mysql_query("select * from sup_product where id='$row[sid]'",$conn2);
$pro=mysql_fetch_array($presult);
?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="32" ><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row['id']?>"></td>
<td height="28" class="left">&nbsp;<?=$row['title']?></td>
<td height="28" align="center"><?=$row['modl']?></td>
<td height="28"><?=number_format($row['price1'],3)?></td>
<td height="28"><?=number_format($row['price2'],3)?></td>
<td><?=ysk_state($row['state'])?></td>
<td style="color:#006fee; text-decoration:underline;">
<?=$row['sid']?> | 
<?=number_format($row['price2'],3)?> | <?=ysk_state($row['state'])?></td>
</tr>
<?php } ?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="32" colspan="7" class="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input" />
<input type="submit" name="Del" id="Del" value="ɾ��" onclick="Javascript:return confirm('ȷ��Ҫɾ����');" class="x3_input" >
<input type="submit" name="Del" id="Del" value="ͬ������" class="x6_input" onclick="Javascript:return confirm('ȷ��Ҫͬ��������ͬ�������������Ǻ���ǰһ������������Ҫ�ı����Լ���������Ŷ��');" >
</td>
<td><?php if ($total!=0){?><?=$page->paging();?><?php }?></td>
</tr>
</table></td>
</tr>
</table>	
</form>	
</body>
</Html>
<script charset="utf-8" src="/plug/artDialog/artDialog.source.js?skin=aero"></script>
<script charset="utf-8"  src="/plug/artDialog/plugins/iframeTools.source.js"></script>
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
