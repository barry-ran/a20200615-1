<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<script>
function hideDiv()
{
document.getElementById("div2").style.display = "block";
document.getElementById("div3").style.display = "block";
}
function hideDiv1()
{
document.getElementById("div2").style.display = "none";
document.getElementById("div3").style.display = "none";
}
</script>
<script language="javascript">
function chg(obj)
{
if(obj.options[obj.selectedIndex].value =="-1")
document.getElementById("overday").style.display="";
else
document.getElementById("overday").style.display="none";
}

function chg1(obj)
{
if(obj.options[obj.selectedIndex].value =="1")
document.getElementById("price").style.display="";
else
document.getElementById("price").style.display="none";
}
</script>

<script language="JavaScript" type="text/javascript">
function clearNoNum(obj)
{
//�Ȱѷ����ֵĶ��滻�����������ֺ�.
obj.value = obj.value.replace(/[^\d.]/g,"");
//���뱣֤��һ��Ϊ���ֶ�����.
obj.value = obj.value.replace(/^\./g,"");
//��ֻ֤�г���һ��.��û�ж��.
obj.value = obj.value.replace(/\.{2,}/g,".");
//��֤.ֻ����һ�Σ������ܳ�����������
obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
}
</script>
</head>
<body>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/user_check.php');
$Action=$_REQUEST['Action'];
$NumberID=str_replace("H","S",$_POST['NumberID']);
////////��Ӽ�¼
If ($Action=="Addsave"){
include('../../jhs_config/upload_class.php');
$Store_icon=$uploadnames;
$overdue=strip_tags($_POST['overdue']);
$overday=strip_tags($_POST['overday']);
$hot=strip_tags($_POST['hot']);
$PartID=strip_tags($_POST['PartID']);
$LagID=strip_tags($_POST['LagID']);
$Classorder=strip_tags($_POST['Classorder']);
$yClass=strip_tags($_POST['Class']);
$Store_title=strip_tags($_POST['Store_title']);
$feilv=strip_tags($_POST['feilv']);
$isno1=strip_tags($_POST['isno1']);
$isno2=strip_tags($_POST['isno2']);
$price=strip_tags($_POST['price']);
$qicq=strip_tags($_POST['qicq']);


if ($hot==''){
$hot=0;
}
if ($overday==''){
$overday=$overdue;
}
if ($hot==1){
$begtime=strtotime("+".$overday." days", time());
}

get_check_price($overday);

$sql="select * from product_class where NumberID='$NumberID'  and number='$_SESSION[ysk_number]' and isno3='1' ";   //��ȡ���ݱ�
$login=mysql_query($sql,$conn1);               //ִ�и�SQl���
if ($row = mysql_fetch_row($login))
{echo "<script language=\"javascript\">alert('ʶ���� $NumberID �����ظ�����������ӣ�');javascript:history.go(-1);</script>";
}else{
$yoy=substr(str_replace("S","H",$_POST['RootID']),0,4);
mysql_query("insert into product_class set hot='$hot',locks=0,NumberID='$NumberID',RootID='$yoy',PartID='$PartID',LagID='$LagID',Classorder='$Classorder',class='$yClass',Store_icon='$Store_icon',Store_title='$Store_title',feilv='$sub_price',number='$_SESSION[ysk_number]',overdue='$overdue',overday='$overday',time='$begtime',price='$price',isno1='$isno1',isno2='$isno2',isno3='1',qicq='$qicq'",$conn1);
echo "<script>alert('��ӳɹ�!');self.location=document.referrer;</script>";
}
}

////////�޸ļ�¼
If ($Action=="editsave") {

include('../../jhs_config/upload_class.php');
$Store_icon=$uploadnames;
$mytime=$_POST['mytime'];
$overdue=strip_tags($_POST['overdue']);
$overday=strip_tags($_POST['overday']);
$hot=strip_tags($_POST['hot']);
$PartID=strip_tags($_POST['PartID']);
$LagID=strip_tags($_POST['LagID']);
$Classorder=strip_tags($_POST['Classorder']);
$yClass=strip_tags($_POST['Class']);
$Store_title=strip_tags($_POST['Store_title']);
$feilv=strip_tags($_POST['feilv']);
$isno1=strip_tags($_POST['isno1']);
$isno2=strip_tags($_POST['isno2']);
$price=strip_tags($_POST['price']);
$number=strip_tags($_POST['number']);
$qicq=strip_tags($_POST['qicq']);
if ($overdue==''){
$begtime1=$mytime;
}elseif($overday!=''){
$begtime1=strtotime('+'.$overday.' day',time()); ####����ʱ��
}else{
$begtime1=strtotime('+'.$overdue.' day',time()); ####����ʱ��
}
$begtime1=$begtime1+($mytime-$begtime);
if ($hot==''){
$hot=0;
}


mysql_query("update product_class set hot='$hot',Classorder='$Classorder',class='$yClass',Store_icon='$Store_icon',Store_title='$Store_title',overdue='$overdue',overday='$overday',time='$begtime1',price='$price',isno1='$isno1',isno2='$isno2',qicq='$qicq'  where id='$_POST[id]' and number='$_SESSION[ysk_number]'",$conn1);

echo "<script>alert('�޸ĳɹ�!');window.location='info_class.php';</script>";
}

////////ɾ������¼
If ($Action=="del") {
$sql1="delete from product_class where NumberID ='$_REQUEST[Id]'  and number='$_SESSION[ysk_number]'  and isno3='1'";
mysql_query($sql1,$conn1);   //////  ɾ��С���

echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
}

////////����ɾ��
If ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
$sql="delete from product_class where id in ($ID_Dele)";
mysql_query($sql,$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='?Action=List';</script>";
}
?>
<?php
If  ($Action=="") {
$len=strlen($_REQUEST['Id']);
$Id=str_replace("H","S",$_REQUEST['Id']);
if ($len==4){
###################����Ŀ¼
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_class` where LagID=1 and PartID='$Id'  and number='$_SESSION[ysk_number]' and isno3='1'",$conn1)); 
if ($total!='0'){
$mysql="select * from product_class  where LagID=1 and PartID='$Id'  and number='$_SESSION[ysk_number]' and isno3='1'  order by id desc  limit 1"; 
$myzyc=mysql_query($mysql,$conn1);
$myrow=mysql_fetch_array($myzyc);
$MJ=substr($myrow['NumberID'],4,20);
$J=$MJ+1;
}else{
$J=0+1;
} 
$RootID="$_REQUEST[Id]";
$PartID=str_replace("H","S",$_REQUEST['Id']);
$LagID=1;
}elseif ($len==7){
###################����Ŀ¼
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_class` where LagID=2 and PartID='$Id'  and number='$_SESSION[ysk_number]' and isno3='1' ",$conn1)); 
if ($total!='0'){
$mysql="select * from product_class  where LagID=2 and PartID='$Id'  and number='$_SESSION[ysk_number]' and isno3='1'  order by id desc  limit 1"; 
$myzyc=mysql_query($mysql,$conn1);
$myrow=mysql_fetch_array($myzyc);
$MJ=substr($myrow['NumberID'],7,20);
$J=$MJ+1;
}else{
$J=0+1;
} 
$RootID="$_REQUEST[Id]";
$PartID=str_replace("H","S",$_REQUEST['Id']);
$LagID=2;
}
$lmyen=strlen($J);
If ($lmyen==1){
$JJ=str_replace("H","S",$_REQUEST['Id'])."00$J";
}elseif ($lmyen==2){
$JJ=str_replace("H","S",$_REQUEST['Id'])."0$J";
}
elseif ($lmyen==3){
$JJ=str_replace("H","S",$_REQUEST['Id'])."$J";
}




?>
<form action="?Action=Addsave" method="post" name="myform" enctype="multipart/form-data">
<table cellspacing="1" cellpadding="0" class="page_table4">
<tr> 
<td height="35" colspan="2" align="left"  class="table_top"><strong class="tit">�����Ŀ</strong></td>
</tr>
<tr >
<td width="7%" height="35" align="right" class="td_left">ʶ��ţ�</td>
<td width="93%"><input name="NumberID" type="text" id="NumberID"  value="<?php echo $JJ ?>" class="biankuan"/>  </td>
</tr>
<tr>
<td height="35" align="right" class="td_left">��Ŀ���ƣ�</td>
<td><input name="Class" type="text" id="Class"  class="biankuan"/> 

<input name="RootID" type="hidden" id="RootID" value="<?php echo $RootID ?>" />
<input name="PartID" type="hidden" id="PartID" value="<?php echo $PartID ?>" />
<input name="LagID"  type="hidden" id="LagID" value="<?php echo $LagID ?>" /> </td>
</tr>

<?php If ($len==7){?>
<tr>
<td width="7%" height="35" align="right" class="td_left">   QQ���߿ͷ�   ��</td>
<td width="93%"><input name="qicq" type="text" id="qicq"  value="" class="biankuan"/></td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left"> �������� ��</td>
<td width="93%"><input name="Store_title" type="text" id="Store_title"  value="" class="biankuan"/> 
</td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left"> ����logo ��</td>
<td width="93%"> <input name="upfile" type="file" id="upfile" ></td>
</tr>


<tr>
<td width="7%" height="35" align="right" class="td_left"> �Ƿ����ţ�</td>
<td width="93%" valign="top" style="padding-top:15px;"><div style="float:left; padding-left:2px;"><input name="hot" id="hot" type="checkbox" onClick="on_hide();" value="1"> 
</div>
<div style="float:left; padding-left:10px;">
<select style="display:none;" name="overdue" id="overdue" onchange="chg(this)">
<option value="7">һ��</option>
<option value="30">һ����</option>
<option value="90">������</option>
<option value="0">����</option>
<option value="-1">����</option>
</select>
</div>
<div style="float:left; padding-left:10px;">
<input id="overday" name="overday" style="width:30px;display:none" value=""   onkeyup="value=value.replace(/[^\d]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" > 
</div>
<script>
function on_hide(){
document.getElementById("overdue").style.display = (document.getElementById("hot").checked == true) ? "block" : "none";
}
</script>
</td>
</tr>
<?php } ?>



<tr>
<td height="35" align="right" class="td_left">����</td>
<td><input name="Classorder" type="text" id="Classorder" value="<?php echo $J ?>" class="biankuan"  onKeyPress	= "return regInput(this, /^[0-9]*$/, String.fromCharCode(event.keyCode))"> </td>
</tr>
<tr>
<td height="35" align="right">&nbsp;</td>
<td>
<input type="submit" name="Submit" value="�ύ"  class="tijiao_input"/>
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="edit"){  
$Id=inject_check($_GET['Id']);
$sql="select * from product_class where id='$Id' and number='$_SESSION[ysk_number]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);

if ($row['id']==''){
echo "<script>alert('����ʧ�ܣ�û���ҵ���Ŀ¼!');self.location=document.referrer;</script>";
exit();
}

?>

<form action="?Action=editsave" method="post" name="myform" enctype="multipart/form-data">
<input name="mytime" type="hidden" id="mytime"   value="<?=$row['time']?>"/>
<table cellspacing="1" cellpadding="0" class="page_table4">
<tr> 
<td height="35" colspan="2" align="left"  class="table_top"><strong class="tit">�޸���Ŀ</strong></td>
</tr>
<tr>
<td width="7%" height="35" align="right"  class="td_left">��Ŀ���ƣ�</td>
<td width="93%"><input name="id" type="hidden" id="id"   value="<?=$row['id']?>"/>
<input class="biankuan" name="Class" type="text" id="Class"  value="<?=$row[7]?>"/></td>
</tr>

<?php if (strlen($row['NumberID'])=='10') {?>
<tr>
<td width="7%" height="35" align="right" class="td_left">   QQ���߿ͷ�   ��</td>
<td width="93%"><input name="qicq" type="text" id="qicq"  value="<?=$row['qicq']?>" class="biankuan"/>����м���|����</td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left"> �������� ��</td>
<td width="93%"><input name="Store_title" type="text" id="Store_title"  value="<?=$row['Store_title']?>" class="biankuan"/> 
</td>
</tr>
<tr>
<td width="7%" height="35" align="right" class="td_left"> ����logo ��</td>
<td width="93%"><input name="Store_icon" type="hidden" value="<?=$row['Store_icon']?>"> 
<input name="upfile" type="file" id="upfile" ></td>
</tr>


<tr>
<td width="7%" height="35" align="right" class="td_left"> �Ƿ����ţ�</td>
<td width="93%">
<input name="hot" type="checkbox" id="hot" value="1" <?php if ($row['hot']=='1') {?>checked="checked"<?php } ?> >
</td>
</tr>
<?php if  ($row['hot']=='1') {?>
<tr>
<td width="21%" height="35" align="right" class="td_left">����ʱ�䣺</td>
<td width="79%">
<?php if ($row['overdue']==0){?>
����
<?php }else{?>
<?php echo $time=date("Y-m-d",$row['time']);   // ��ʽ������?>
<?php } ?>
</td>
</tr>
<?php } ?> 
<tr>
<td width="21%" height="35" align="right" class="td_left">�Ƿ����ѣ�</td>
<td width="79%"><div style="float:left;">
<select  name="overdue" id="overdue" onchange="chg(this)">
<option value="" selected="selected">��ѡ��</option>
<option value="7">һ��</option>
<option value="30">һ����</option>
<option value="90">������</option>
<option value="0">����</option>
<option value="-1">����</option>
</select>
</div>
<div style="float:left; padding-left:10px;">
<input id="overday" name="overday" style="width:30px;display:none" value=""   onkeyup="value=value.replace(/[^\d]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" > 
</div>

</td>
</tr>






<?php } ?>
<tr>
<td height="35" align="right"  class="td_left"> ����</td>
<td><input name="Classorder" type="text" id="Classorder"  value="<?=$row[Classorder]?>" class="biankuan" onKeyPress	= "return regInput(this, /^[0-9]*$/, String.fromCharCode(event.keyCode))"></td>
</tr>
<tr>
<td height="35" align="right">&nbsp;</td>
<td>
<input type="submit" name="Submit" value="�޸�" class="tijiao_input" /></td>
</tr>
</table>
</form>
<?php } ?>
</body>
</Html>