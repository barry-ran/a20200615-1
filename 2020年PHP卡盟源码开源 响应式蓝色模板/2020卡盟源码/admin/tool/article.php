
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=strip_tags($_GET['Action']);
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
$keywords=strip_tags($_GET['keywords']);

////////��Ӽ�¼
if ($Action=="Addsave") {
$title=$_POST['title'];             //��Ϣ����
$color=$_POST['color'];             //������ɫ
$content=$_POST['content'];         //��Ϣ����
$menu=$_POST['menu'];               //��Ϣ��Ŀ
$begtime=$_POST['begtime'];       //��������
$source=$_SESSION['ysk_username'];       //��Դ
$hiddens=$_POST['hiddens'];       //��Դ
ysk_date_log(6,$_SESSION['ysk_username'],'����������Ϊ"'.$title.'" ��������Ϣ');
mysql_query("insert into article (title,color,menu,source,content,begtime,hiddens) " . "values ('$title','$color','$menu','$source','$content','$begtime','$hiddens')",$conn1);
echo "<script>alert('��ӳɹ�!');self.location=document.referrer;</script>";
}


if ($Action=='hiddens'){
mysql_query("update article set hiddens='$_REQUEST[sid]' where id='$_REQUEST[Id]'",$conn1); 
echo "<script>alert('�����ɹ�!');self.location=document.referrer;</script>";
}

////////�޸ļ�¼
if ($Action=="editsave") {
$title=$_POST['title'];             //��Ϣ����
$color=$_POST['color'];             //������ɫ
$content=$_POST['content'];         //��Ϣ����
$source=$_SESSION['ysk_username'];  //��Դ
$menu=$_POST['menu'];               //��Ϣ��Ŀ
$hiddens=$_POST['hiddens'];         //��Ϣ����
$begtime=$_POST['begtime'];         //��Ϣʱ��

$y1=$_POST['y1'];
$y2=$_POST['y2'];
$y3=$_POST['y3'];
$y4=$_POST['y4'];
$y5=$_POST['y5'];
if ($y1<>$title){ysk_date_log(6,$_SESSION['ysk_username'],'�޸���������Ϣ "'.$y1.'" �ı���');}
if ($y2<>$color){ysk_date_log(6,$_SESSION['ysk_username'],'�޸���������Ϣ "'.$y1.'" �ı�����ɫ');}
if ($y3<>$menu){ysk_date_log(6,$_SESSION['ysk_username'],'�޸���������Ϣ "'.$y1.'" ����Ϣ����');}
if ($y4<>$content){ysk_date_log(6,$_SESSION['ysk_username'],'�޸���������Ϣ "'.$y1.'" ����Ϣ����');}
if ($y5<>$begtime){ysk_date_log(6,$_SESSION['ysk_username'],'�޸���������Ϣ "'.$y1.'" ����Ϣ����');}

mysql_query("update article set title='$title',color='$color',content='$content',menu='$menu',hiddens='$hiddens' where id='$_POST[Id]'",$conn1); 
echo "<script>alert('�޸ĳɹ�!');;window.location='?Action=List';</script>";

}

////////ɾ������¼
if ($Action=="del") {
ysk_date_log(6,$_SESSION['ysk_username'],'ɾ����һ��������Ϣ');
mysql_query("delete from article where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');self.location=document.referrer;</script>";
}

////////����ɾ��
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
ysk_date_log(6,$_SESSION['ysk_username'],'ɾ����һЩ������Ϣ');
mysql_query("delete from article where id in ($ID_Dele)",$conn1);
echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
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
<script charset="utf-8" src="/Public/yoxi_editor/kindeditor.js"></script>
<script charset="utf-8" src="/Public/yoxi_editor/lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#editor_id');
});

</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image3').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url3').val(),
clickFn : function(url, title, width, height, border, align) {
K('#url3').val(url);
editor.hideDialog();
}
});
});
});
});
</script>
</head>
<body>


<?php if ($Action=="List" or $Action==""){?>
<a href="?Action=add"><input type="submit" name="btnQuery" value="�������" id="btnQuery" class="chaxun_input" /></a>

<form name="form1" method="post" action="">

<table cellspacing="1" cellpadding="0" class="page_table4" width="100%">
<tr>
<td width="4%" height="32" align="center" class="table_top">ID</td>
<td width="37%" align="center" class="table_top">��Ϣ����</td>
<td width="18%" align="center" class="table_top">�������</td>
<td width="14%" align="center" class="table_top">��Ϣ��Դ</td>
<td width="14%" align="center" class="table_top">����ʱ��</td>
<td width="13%" align="center" class="table_top">����</td>
</tr>
<?php
$search="where 1=1 "; 

if ($keywords!='')  $search.=" and title like '%$keywords%' "; 
if ($StartYear!='') $search.=" and begtime >=$muyou1 and begtime <=  $muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `article`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from article  $search order by begtime desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></td>
<td align="left"><span style="color:<?=$row['color']?>"><?=$row['title']?></span></td>
<td align="center"><?=$row['menu']?></td>
<td align="center"><?=$row['source']?></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center">
<?php if ($row['hiddens']=='1' or $row['hiddens']=='') {?>
<a href="?Action=hiddens&Id=<?=$row['id']?>&sid=0">��ʾ</a>
<?php }else{?>
<a href="?Action=hiddens&Id=<?=$row['id']?>&sid=1"><span style="color:#FF0000">����</span></a>
<?php }?>


<a href="?Action=edit&Id=<?=$row[id]?>">�޸�</a> <a href="?Action=del&Id=<?=$row[id]?>" onclick="Javascript:return confirm('ȷ��Ҫɾ����');">ɾ��</a> </td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="17%" align="left" style="padding-top:15px; padding-bottom:15px;">
<input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input" />
<input type="submit" name="Del" id="Del" value="ɾ��" onclick="test()" class="x3_input" >

</td>
<td width="83%" style="text-align:center;"><?php if ($total!=0){?><?=$page->paging();?><?php }?>  </td>
</tr>
</table>
</form>
<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��Ϣ���</td>
</tr>
<tr>
<td width="10%" class="td_left">��Ϣ���⣺</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="" class="biankuan" />             <input name="color" type="text" id="color" value="" size="7" class="biankuan" /> 
 <input type="button" id="colorpicker" value="��ȡɫ��" class="tijiao_input"/></td>
</tr>
<tr>
<td width="10%" class="td_left">����ʱ�䣺</td>
<td width="90%" class="left"><input name="begtime" type="text" style="width:350px;" value="<?php $now=mktime(); echo $now;?>" class="biankuan" /></td>
<tr>
<td width="10%" class="td_left"></td>
<td width="90%" class="left">Unixʱ�����ѯ��ַ��http://tool.chinaz.com/Tools/unixtime.aspx</td>
</tr>
</tr>
<tr>
<td width="10%" class="td_left">��Ϣ���ࣺ</td>
<td width="90%" class="left"><select name="menu" id="menu">
<option value="ƽ̨����">ƽ̨����</option>
<option value="������Ϣ">������Ϣ</option>
<option value="��ҵ��̬">��ҵ��̬</option>
<option value="��Ʒ�����۹���">��Ʒ�����۹���</option>
</select></td>
</tr>
<tr>
<td width="10%" class="td_left">��Ϣ״̬��</td>
<td width="90%" class="left"><select name="hiddens" id="hiddens">
<option value="1" selected="selected">��ʾ</option>
<option value="0">����</option>
</select></td>
</tr>
<tr>
<td width="10%" class="td_left">����������</td>
<td width="90%" class="left"><textarea id="editor_id" name="content" style="width:700px;height:300px;"></textarea></td>
</tr>	
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�����"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>

<?php }elseif($Action=="edit"){  
$sql="select * from article where id='$_REQUEST[Id]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input name="y1" type="hidden" value="<?=$row['title']?>">
<input name="y2" type="hidden" value="<?=$row['color']?>">
<input name="y3" type="hidden" value="<?=$row['menu']?>">
<textarea name="y4" style=" display:none"><?=$row['content']?>
</textarea>
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��Ϣ�޸�</td>
</tr>

<tr>
<td width="10%" class="td_left">��Ϣ���⣺</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="<?=$row['title']?>" class="biankuan" /> 
 <input name="color" type="text" id="color" value="<?=$row['color']?>" size="7" class="biankuan" /> 
   <input type="button" id="colorpicker" value="��ȡɫ��" class="tijiao_input"/></td>
</tr>
<tr>
<tr>
<td width="10%" class="td_left">��Ϣ���ࣺ</td>
<td width="90%" class="left"><select name="menu" id="menu">
<option value="ƽ̨����" <?php if ($row['menu']=='ƽ̨����'){?> selected="selected" <?php } ?>>ƽ̨����</option>
<option value="������Ϣ" <?php if ($row['menu']=='������Ϣ'){?> selected="selected" <?php } ?>>������Ϣ</option>
<option value="��ҵ��̬" <?php if ($row['menu']=='��ҵ��̬'){?> selected="selected" <?php } ?>>��ҵ��̬</option>
<option value="��Ʒ�����۹���" <?php if ($row['menu']=='��Ʒ�����۹���'){?> selected="selected" <?php } ?>>��Ʒ�����۹���</option>

</select></td>
</tr>
<tr>
<td width="10%" class="td_left">��Ϣ״̬��</td>
<td width="90%" class="left"><select name="hiddens" id="hiddens">
<option value="1" <?php if ($row['hiddens']=='1'){?> selected="selected" <?php } ?>>��ʾ</option>
<option value="0" <?php if ($row['hiddens']=='0'){?> selected="selected" <?php } ?>>����</option>
</select></td>
</tr>
<tr>
<td width="10%" class="td_left">����������</td>
<td width="90%" class="left"><textarea id="editor_id" name="content" style="width:700px;height:300px;"><?=$row['content']?></textarea></td>
</tr>	


<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�����"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>
<?php } ?>
</body>
</html>
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
