
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
////////��Ӽ�¼
if ($Action=="Addsave"){
$bank_type=strip_tags($_POST['bank_type']);     //��������
$bankaccount=strip_tags($_POST['bankaccount']); //�����˻�
$accountname=strip_tags($_POST['accountname']); //�ֿ�������
$bankcity=strip_tags($_POST['bankcity']);       //��������

ysk_date_log(6,$_SESSION['ysk_username'],'������һ�� "'.$bank_type.'" �տ����� '.$accountname.' �Ļ���˻���');
mysql_query("insert into `rem_account` (bank_type,bankaccount,accountname,bankcity,time) "."values ('$bank_type','$bankaccount','$accountname','$bankcity','$begtime')",$conn1);
echo "<br><br><br><br><center><input id='btnAll' type='button' value='��ӳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}

////////�޸ļ�¼
If ($Action=="editsave") {
$y1=strip_tags($_POST['y1']);
$y2=strip_tags($_POST['y2']);
$y3=strip_tags($_POST['y3']);
$y4=strip_tags($_POST['y4']);
$bank_type=strip_tags($_POST['bank_type']);    //��������
$bankaccount=strip_tags($_POST['bankaccount']);//�����˻�
$accountname=strip_tags($_POST['accountname']);//�ֿ�������
$bankcity=strip_tags($_POST['bankcity']);      //��������
if ($y1<>$bank_type){ysk_date_log(6,$_SESSION['ysk_username'],'�ѻ���˻� ��������"'.$y1.'" �޸ĳ� '.$bank_type.'');}
if ($y2<>$bankaccount){ysk_date_log(6,$_SESSION['ysk_username'],'�ѻ���˻� �����˻�"'.$y2.'" �޸ĳ� '.$bankaccount.'');}
if ($y3<>$bankcity){ysk_date_log(6,$_SESSION['ysk_username'],'�ѻ���˻� ��������"'.$y3.'" �޸ĳ� '.$bankcity.'');}
if ($y4<>$accountname){ysk_date_log(6,$_SESSION['ysk_username'],'�ѻ���˻� �ֿ�������"'.$y4.'" �޸ĳ� '.$accountname.'');}
$godo=mysql_query("update rem_account set bank_type='$bank_type',bankaccount='$bankaccount',accountname='$accountname',bankcity='$bankcity'  where id='$_POST[Id]'",$conn1); 
echo "<script>alert('�޸ĳɹ�!');;window.location='?Action=List';</script>";

}

////////ɾ������¼
If ($Action=="del") {
$sql=mysql_query("select * from rem_account  where id ='$_REQUEST[Id]'",$conn1);
$row=mysql_fetch_array($sql);
ysk_date_log(3,$_SESSION['ysk_username'],'ɾ����һ�� "'.$row['bank_type'].'" �տ����� '.$row['accountname'].' �Ļ���˻���');
mysql_query("delete from rem_account where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='?Action=List';</script>";
}

?>
<script>
function cl()
{ 
var win = art.dialog.open.origin;//��Դҳ��
// �����ҳ�����ػ��߹ر����ӶԻ���ȫ����ر�
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
</head>
<body>
<?php if($Action=="List" or $Action==""){?>

<div class="gn">
<input id="add" type="button" value="����˻�" class="tijiao_input" onclick="$.dialog.open('?Action=add', {title: '����˻����', width: 600, height: 300,lock: true,fixed:true});" />
</div>


<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="19%" height="32" class="table_top">��������</td>
<td width="23%" class="table_top">�����˺�</td>
<td width="22%" class="table_top">�ֿ�������</td>
<td width="24%" class="table_top">��������</td>
<td width="6%" class="table_top">�޸�</td>
<td width="6%" class="table_top">ɾ��</td>
</tr>
<?php
$Rss="SELECT * FROM rem_account  order by time desc,id desc";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
<tr onmouseover="this.style.backgroundColor='#f1f1f1';" onmouseout="this.style.backgroundColor='';">
<td height="24"><?=$Orzx['bank_type']?></td>
<td><?=$Orzx['bankaccount']?></td>
<td><?=$Orzx['accountname']?></td>
<td height="24"><?=$Orzx['bankcity']?></td>
<td><a class="a edit" href="?Action=edit&Id=<?=$Orzx['id']?>"></a> </td>
<td><a class="a delete" onclick="return confirm('ȷ��ɾ����');"  href="?Action=del&Id=<?=$Orzx['id']?>"></a></td>
</tr>
<?php 
} }?>

</table>
</div>
<?php }elseif($Action=="add"){  ?>
<form name="add" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">�������ͣ�</td>
<td><select name="bank_type" id="bank_type">
<option value="" selected="selected">��ѡ������</option>
<option value="ũҵ����">ũҵ����</option>
<option value="��������">��������</option>
<option value="��������">��������</option>
<option value="֧����">֧����</option>
<option value="�ַ�����">�ַ�����</option>
<option value="��ͨ����">��ͨ����</option>
<option value="��������">��������</option>
<option value="�й�����">�й�����</option>
<option value="��ҵ����">��ҵ����</option>
<option value="��������">��������</option>
<option value="��������">��������</option>
<option value="��������">��������</option>
<option value="��ҵ����">��ҵ����</option>
<option value="�㷢����">�㷢����</option>
<option value="�����">�����</option>
<option value="�������">�������</option>
<option value="��������">��������</option>
<option value="��������">��������</option>
<option value="�Ϻ�����">�Ϻ�����</option>
<option value="��������">��������</option>
<option value="��������">��������</option>
<option value="������">������</option>
<option value="�Ƹ�ͨ">�Ƹ�ͨ</option>
<option value="��������">��������</option>
<option value="�ɶ�����">�ɶ�����</option>
<option value="���ɹ�����">���ɹ�����</option>
<option value="ƽ������">ƽ������</option>
<option value="ʢ��ͨ">ʢ��ͨ</option>
<option value="������">������</option>
<option value="�ֻ�֧��">�ֻ�֧��</option>

</select></td>
</tr>
<tr>
<td  class="td_left"> �����˺� ��</td>
<td><input name="bankaccount" type="text" class="biankuan" style="width:350px;"  placeholder="���п���" /></td>
</tr>
<tr>
<td  class="td_left">����������</td>
<td><input name="bankcity" type="text" class="biankuan" style="width:250px;"    placeholder="ĳʡĳ��"/></td>
</tr>
<tr>
<td  class="td_left">�ֿ���������</td>
<td><input name="accountname" type="text" class="biankuan" style="width:150px;"  placeholder="4����������"/></td>
</tr>

<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�����"  id="btnSubmit" class="tijiao_input" />
</td>
</tr>
</table>
</form>

<?php }elseif($Action=="edit"){  
$sql="select * from rem_account where id='$_REQUEST[Id]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input id="y1" name="y1" type="hidden" value="<?=$row['bank_type']?>">
<input id="y2" name="y2" type="hidden" value="<?=$row['bankaccount']?>">
<input id="y3" name="y3" type="hidden" value="<?=$row['bankcity']?>">
<input id="y4" name="y4" type="hidden" value="<?=$row['accountname']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td  class="td_left">�������ͣ�</td>
<td><select name="bank_type" id="bank_type">
<option value="" >��ѡ������</option>
<option value="ũҵ����" <?php if ($row['bank_type']=='ũҵ����'){?>selected="selected"<?php } ?>>ũҵ����</option>
<option value="��������" <?php if ($row['bank_type']=='��������'){?>selected="selected"<?php } ?>>��������</option>
<option value="��������" <?php if ($row['bank_type']=='��������'){?>selected="selected"<?php } ?>>��������</option>
<option value="֧����"   <?php if ($row['bank_type']=='֧����')  {?>selected="selected"<?php } ?>>֧����</option>
<option value="�ַ�����"  <?php if ($row['bank_type']=='�ַ�����'){?>selected="selected"<?php } ?>>�ַ�����</option>
<option value="��ͨ����" <?php if ($row['bank_type']=='��ͨ����'){?>selected="selected"<?php } ?>>��ͨ����</option>
<option value="��������" <?php if ($row['bank_type']=='��������'){?>selected="selected"<?php } ?>>��������</option>
<option value="�й�����" <?php if ($row['bank_type']=='�й�����'){?>selected="selected"<?php } ?>>�й�����</option>
<option value="��ҵ����" <?php if ($row['bank_type']=='��ҵ����'){?>selected="selected"<?php } ?>>��ҵ����</option>
<option value="��������" <?php if ($row['bank_type']=='��������'){?>selected="selected"<?php } ?>>��������</option>
<option value="��������" <?php if ($row['bank_type']=='��������'){?>selected="selected"<?php } ?>>��������</option>
<option value="��������" <?php if ($row['bank_type']=='��������'){?>selected="selected"<?php } ?>>��������</option>
<option value="��ҵ����" <?php if ($row['bank_type']=='��ҵ����'){?>selected="selected"<?php } ?>>��ҵ����</option>
<option value="�㷢����" <?php if ($row['bank_type']=='�㷢����'){?>selected="selected"<?php } ?>>�㷢����</option>
<option value="�����" <?php if ($row['bank_type']=='�����'){?>selected="selected"<?php } ?>>�����</option>
<option value="�������" <?php if ($row['bank_type']=='�������'){?>selected="selected"<?php } ?>>�������</option>
<option value="��������" <?php if ($row['bank_type']=='��������'){?>selected="selected"<?php } ?>>��������</option>
<option value="��������" <?php if ($row['bank_type']=='��������'){?>selected="selected"<?php } ?>>��������</option>
<option value="�Ϻ�����" <?php if ($row['bank_type']=='�Ϻ�����'){?>selected="selected"<?php } ?>>�Ϻ�����</option>
<option value="��������" <?php if ($row['bank_type']=='��������'){?>selected="selected"<?php } ?>>��������</option>
<option value="��������" <?php if ($row['bank_type']=='��������'){?>selected="selected"<?php } ?>>��������</option>
<option value="������"   <?php if ($row['bank_type']=='������'){?>selected="selected"<?php } ?>>������</option>
<option value="�Ƹ�ͨ"   <?php if ($row['bank_type']=='�Ƹ�ͨ'){?>selected="selected"<?php } ?>>�Ƹ�ͨ</option>
<option value="��������" <?php if ($row['bank_type']=='��������'){?>selected="selected"<?php } ?>>��������</option>
<option value="�ɶ�����" <?php if ($row['bank_type']=='�ɶ�����'){?>selected="selected"<?php } ?>>�ɶ�����</option>
<option value="���ɹ�����"<?php if ($row['bank_type']=='���ɹ�����'){?>selected="selected"<?php } ?>>���ɹ�����</option>
<option value="ƽ������"  <?php if ($row['bank_type']=='ƽ������'){?>selected="selected"<?php } ?>>ƽ������</option>
<option value="ʢ��ͨ"    <?php if ($row['bank_type']=='ʢ��ͨ'){?>selected="selected"<?php } ?>>ʢ��ͨ</option>
<option value="������"    <?php if ($row['bank_type']=='������'){?>selected="selected"<?php } ?>>������</option>
<option value="�ֻ�֧��"  <?php if ($row['bank_type']=='�ֻ�֧��'){?>selected="selected"<?php } ?>>�ֻ�֧��</option>

</select></td>
</tr>
<tr>
<td  class="td_left"> �����˺� ��</td>
<td><input name="bankaccount" type="text" class="biankuan" style="width:350px;" value="<?=$row['bankaccount']?>"  placeholder="���п���" /></td>
</tr>
<tr>
<td  class="td_left">����������</td>
<td><input name="bankcity" type="text" class="biankuan" style="width:250px;"  value="<?=$row['bankcity']?>"   placeholder="ĳʡĳ��"/></td>
</tr>
<tr>
<td  class="td_left">�ֿ���������</td>
<td><input name="accountname" type="text" class="biankuan" style="width:150px;"   value="<?=$row['accountname']?>"  placeholder="4����������"/></td>
</tr>

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
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>