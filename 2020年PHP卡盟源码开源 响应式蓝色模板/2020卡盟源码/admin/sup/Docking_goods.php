<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=strip_tags($_GET['Action']);
$keyword=strip_tags($_GET['keyword']);

////////�޸ļ�¼
if ($Action=="save"){
$ClassID=strip_tags($_POST['ClassID']);
$title=strip_tags($_POST['title']);
$color=strip_tags($_POST['color']);
$content=strip_tags($_POST['content']);
$focus=strip_tags($_POST['focus']);
$pricing=strip_tags($_POST['pricing']);
$rate=strip_tags($_POST['rate']);
$directory1=strip_tags(substr($ClassID,0,4));
$directory2=strip_tags(substr($ClassID,0,7));
mysql_query("update product set title='$title',color='$color',content='$content',focus='$focus',directory1='$directory1',directory2='$directory2',directory3='$ClassID',pricing='$pricing',rate='$rate'  where id='$_POST[Id]'",$conn1); 
echo "<script>alert('�޸ĳɹ�!');window.location='Docking_goods.php';</script>";
exit();
}

////////ɾ������¼
if ($Action=="del") {
mysql_query("delete from product where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='Docking_goods.php';</script>";
exit();
}


##############�ö�
if ($Action=="move1"){
$id=$_REQUEST['id'];     
#######��ȡ�ʼID
$sql1="select * from product  $search order by paixu asc limit 1";   
$zyc1=mysql_query($sql1,$conn1);  
$row1=mysql_fetch_array($zyc1);
$godo=mysql_query("update product set paixu='$row1[paixu]' where id='$id'",$conn1); 
$godo=mysql_query("update product set paixu=paixu+1 where id<>'$id'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}
##############��β
if ($Action=="move4"){
$id=$_REQUEST['id'];     
#######��ȡ�ʼID
$sql1="select * from product  $search order by paixu desc limit 1";   
$zyc1=mysql_query($sql1,$conn1);  
$row1=mysql_fetch_array($zyc1);
$godo=mysql_query("update product set paixu='$row1[paixu]' where id='$id'",$conn1); 
$godo=mysql_query("update product set paixu=paixu-1 where id<>'$id'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}
##############����һ��
If ($Action=="move2"){
$paixu=$_REQUEST['paixu'];     //��ǰ����
$sql="select * from product  where `paixu` < '$paixu'  order by `paixu` desc limit 1 ";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
$num= mysql_num_rows($zyc);
if ($num!=0){
$godo=mysql_query("update product set paixu='$row[paixu]' where paixu='$paixu'",$conn1); 
$godo=mysql_query("update product set paixu='$paixu'      where id='$row[id]'",$conn1); 
}else{
echo "<script>alert('�Բ������һ�������ˣ�');;self.location=document.referrer;</script>";
exit();
}
echo "<script>self.location=document.referrer;</script>";
exit();
}
##############����һ��
If ($Action=="move3"){
$paixu=$_REQUEST['paixu'];     //��ǰ����
$sql="select * from product  where `paixu` > '$paixu'  order by `paixu` asc limit 1 ";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
$num= mysql_num_rows($zyc);
if ($num!=0){
$godo=mysql_query("update product set paixu='$row[paixu]' where paixu='$paixu'",$conn1); 
$godo=mysql_query("update product set paixu='$paixu'      where id='$row[id]'",$conn1); 
}else{
echo "<script>alert('�Բ������һ�������ˣ�');;self.location=document.referrer;</script>";
exit();
}
echo "<script>self.location=document.referrer;</script>";
exit();
}

if ($Action=='mylove'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));    ////�� explode �� | �����ݸ���������


###��Ʒ��ͣ
if ($_REQUEST['Del']=='��ͣ'){
$_SESSION['yDel']='��ͣ';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}

###��Ʒ�������۸�
if ($_REQUEST['Del']=='��������'){
$_SESSION['yDel']='��������';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}


if ($_REQUEST['Del']=='ɾ��'){
mysql_query("delete from product where id in ($ID_Dele)",$conn1);
echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
}



if ($_REQUEST['Del']=='����'){
foreach($allArray as $value){
mysql_query("update product set state='0',reason='' where id=$value",$conn1); }
echo "<script>alert('�ύ�ɹ�!');self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='����'){
foreach($allArray as $value) { 
mysql_query("update product set state='2',reason='$_REQUEST[info]' where id='$value'",$conn1); 
}
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="/Public/yoxi_editor/kindeditor.js"></script>
<script charset="utf-8" src="/Public/yoxi_editor/lang/zh_CN.js"></script>
<script charset="utf-8" src="/Public/yoxi_editor/kindeditor-min.js"></script>
<script>
KindEditor.ready(function(K) {
var colorpicker;
K('#colorpicker').bind('click', function(e) {
e.stopPropagation();
if (colorpicker) {
colorpicker.remove();
colorpicker = null;
return;
}
var colorpickerPos = K('#colorpicker').pos();
colorpicker = K.colorpicker({
x : colorpickerPos.x,
y : colorpickerPos.y + K('#colorpicker').height(),
z : 19811214,
selectedColor : 'default',
noColor : '����ɫ',
click : function(color) {
K('#color').val(color);
colorpicker.remove();
colorpicker = null;
}
});
});
K(document).click(function() {
if (colorpicker) {
colorpicker.remove();
colorpicker = null;
}
});
});
</script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#editor_id');
});

</script>
</head>
<script type="text/javascript" src="/Public/js/jquery.min.js"></script>
<?php if ($_SESSION['yDel']=='��ͣ'){?>
<script language="javascript">
$(window).load(function(){
art.dialog.open('product/deal_with.php?Action=stop&isno=<?=$_SESSION['allArray']?>',{lock:true,fixed:true,title:'��ͣ',width:500,height:180});
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
<body >
<?php if ($Action==""){?>
<form action="Docking_goods.php" method="get">
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
<option selected="selected" value="">ȫ��״̬</option>
<option value="0">����</option>
<option value="1">��ͣ</option>
<option value="2">����</option>
</select>
</td>
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
<table cellspacing="1" cellpadding="0" class="page_table4" width="100%">
<tr>
<td width="4%" height="32" align="center" class="table_top">ѡ��</td>
<td width="4%" align="center" class="table_top">���</td>
<td width="32%" align="center" class="table_top">��Ʒ����</td>
<td width="8%" align="center" class="table_top"> ����/ģ�� </td>
<td width="6%" align="center" class="table_top"> ��ֵ </td>

<td width="6%" align="center" class="table_top"> ���� </td>
<td width="7%" align="center" class="table_top">״̬</td>
<td width="9%" align="center" class="table_top">����</td>
<td width="13%" align="center" class="table_top">����ʱ��</td>
<td width="7%" align="center" class="table_top">����</td>
</tr>
<?php
$state=$_REQUEST['state'];                  //��Ʒ״̬
$modl=$_REQUEST['modl'];                     //��Ʒģ��
$type=$_REQUEST['type'];                     //��������
$keywords=$_REQUEST['keywords'];             //�����ؼ���
$search="where sid!=0  and state>=0"; 
if ($keywords!='') $search.=" and $type like '%$keywords%' "; 
if ($modl!='')     $search.=" and modl='$modl'"; 
if ($state!='')    $search.=" and state='$state'"; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from product  $search order by paixu asc,id desc {$page->limit}"; 


$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
#######��ȡ�ʼID
$sql1="select * from product  $search order by paixu asc limit 1";   
$zyc1=mysql_query($sql1,$conn1);  
$row1=mysql_fetch_array($zyc1);
#######��ȡ���ID
$sql2="select * from product  $search order by paixu desc limit 1";   
$zyc2=mysql_query($sql2,$conn1);  
$row2=mysql_fetch_array($zyc2);
while ($row=mysql_fetch_array($zyc)){


?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td align="center"><?=$row['id']?></td>
<td align="left"><?=$row['title']?></td>
<td align="center"><?=$row['modl']?></td>
<td align="center"><?=$row['price1']?></td>
<td align="center"><?=$row['price2']?></td>
<td align="center"><?=ysk_state($row['state'])?></td>
<td align="center"><div class="dirction">
<?php if ($row1['id']==$row['id']) {?>
<a  title="�ƶ������" class="move top1"></a>
<?php }else{?>
<a href="?Action=move1&id=<?=$row['id']?>" title="�ƶ������" class="move top"></a>
<?php } ?>
<?php if ($row1['id']==$row['id']) {?>
<a  title="������һ��"   class="move up1"></a>
<?php }else{?>
<a href="?Action=move2&paixu=<?=$row['paixu']?>" title="������һ��"   class="move up"></a>
<?php } ?>

<?php if ($row2['id']==$row['id']) {?>
<a  title="������һ��"   class="move down1"></a>
<?php }else{?>
<a href="?Action=move3&paixu=<?=$row['paixu']?>" title="������һ��"   class="move down"></a>
<?php } ?>

<?php if ($row2['id']==$row['id']) {?>
<a   title="�ƶ�����ײ�" class="move bottom1"></a>
<?php }else{?>
<a href="?Action=move4&id=<?=$row['id']?>" title="�ƶ�����ײ�" class="move bottom"></a>
<?php } ?>

</div>        </td>
<td align="center"><?=date("Y-m-d G:i:s",$row['time'])?></td>

<td align="center"><a href="?Action=edit&Id=<?=$row[id]?>">�޸�</a> <a href="?Action=del&Id=<?=$row[id]?>" onclick="Javascript:return confirm('ȷ��Ҫɾ����');">ɾ��</a> </td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="44%" align="left" style="padding:15px 0px;">
<input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="ɾ��" class="x3_input" onclick="Javascript:return confirm('ȷ��Ҫɾ����');" >
<input type="submit" name="Del" value="�ƶ���Ʒ"  onclick="return CheckSelect();" id="Del" class="x6_input" style="display:none">
<input type="submit" name="Del" id="Del" value="����"  onclick="return CheckSelect();" class="x2_input">
<input type="submit" name="Del" id="Del" value="��ͣ"  onclick="return CheckSelect();" class="x2_input">
<input type="submit" name="Del" id="Del" value="����"  onclick="return CheckSelect();" class="x2_input">
<input type="submit" name="Del" id="Del" value="��������"  onclick="return CheckSelect();" class="x4_input">
</td>
<td align="left"><?php if ($total!=0){?><?=$page->paging();?><?php }?></td>
</tr>

</table>
</form>

<?php }elseif($Action=="edit"){  
$Id=inject_check($_GET['Id']);
$presult=mysql_query("select * from product where  id='$Id'",$conn1);
$pro=mysql_fetch_array($presult);?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{
if(checkspace(document.add.rate.value)) {
document.add.rate.focus();
alert("�Բ�����Ʒ�ۼ۲���Ϊ�գ�");
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
<form action="?Action=save" method="post" name="add" onsubmit="return CheckPost();">
<input id="ClassID" name="ClassID" type="hidden" value="">
<input id="Id" name="Id" type="hidden" value="<?=$pro['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��Ϣ�޸�</td>
</tr>
<tr>
<td class="td_left">��Ʒʱ�ޣ�</td>
<td class="left"> <?php if ($pro['overdue']=='0'){echo"������";}else{echo$pro['overdue']."��";}?>
</td>
</tr>

<tr>
<td width="10%" class="td_left"> ��Ʒ���ƣ�</td>
<td width="90%" class="left">
<input name="title" type="text" style="width:350px;" value="<?=$pro['title']?>" class="biankuan" />
<input name="color" type="text" id="color" value="<?=$pro['color']?>" size="7" class="biankuan" /> 
<input type="button" id="colorpicker" value="��ȡɫ��" class="tijiao_input"/></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��Ʒ��棺</td>
<td width="90%" class="left"><?=$pro['kucun']?>
  <?=$pro['punit']?></td>
</tr>

<tr>
<td width="10%" class="td_left">��Ϣ���ࣺ</td>
<td width="90%" class="left"><iframe frameborder=0 id=FrmRight name=right src="../product/Class.Php?NumberID=<?=$pro['directory3']?>" style="HEIGHT:30px; VISIBILITY: inherit; WIDTH: 100%; Z-INDEX: 1"></iframe></td>
</tr>
<tr>
<td width="10%" class="td_left">��Ʒ��ֵ��</td>
<td width="90%" class="left"><?=$pro['price1']?> Ԫ</td>
</tr>
<tr>
<td width="10%" class="td_left">�����۸�</td>
<td width="90%" class="left"><?=$pro['price2']?> Ԫ <select name="pricing" id="pricing">
<option value="1" <?php if ($pro['pricing']==1){?>selected="selected"<?php } ?>>�����Ӱٷֱ�</option>
<option value="2" <?php if ($pro['pricing']==2){?>selected="selected"<?php } ?>>�����ӹ̶�ֵ</option>
</select>
<input name="rate" type="text" style="width:60px;" onkeyup="clearNoNum(this)" value="<?=$pro['rate']?>"/>  
��������۸�100 ���ٷֱ����� ����д�� 1��ʱ�� ����1% Ҳ����ÿ������1Ԫ
 </td>
</tr>
<tr>
<td class="td_left">
��Ʒ��飺</td>
<td class="left">
<textarea name="content" rows="2" cols="20" id="content" class="biankuan" style="width: 350px; height: 100px"><?=$pro['content']?></textarea></td>
</tr>
<tr>
<td class="td_left">
ע�����</td>
<td class="left">
<textarea name="focus" rows="2" cols="20" id="focus" class="biankuan" style="width: 350px; height: 100px"><?=$pro['focus']?></textarea>          </td>
</tr>
<tr>
<td width="10%" class="td_left"> ��ֵ��ַ��</td>
<td width="90%" class="left"><?=$pro['url']?></td>
</tr>
<tr>
<td width="10%" class="td_left"> �ͷ���ϵ��ʽ��</td>
<td width="90%" class="left"><?=$pro['service']?></td>
</tr>

<tr>


<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�����"  id="btnSubmit" class="tijiao_input" onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
</div>
<?php } ?>
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
