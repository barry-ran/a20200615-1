<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Welcome</title>
<link rel="stylesheet" href="images/sup1.css" type="text/css" />
<script charset="utf-8" src="/Public/yoxi_editor/kindeditor.js"></script>
<script charset="utf-8" src="/Public/yoxi_editor/zh_CN.js"></script>
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
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
$Action=$_REQUEST['Action'];
$presult=mysql_query("select * from sup_product where id='$_REQUEST[id]'",$conn2);
$pro=mysql_fetch_array($presult);
$uresult=mysql_query("select * from sup_members where number='$pro[username]'",$conn2);
$user=mysql_fetch_array($uresult);?>
<?php if ($Action==''){?>
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
<form name="add" method="post" action="?Action=save&id=<?=$_REQUEST['id']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">  
<tr>
<td class="td_left"><span style="padding: 0pt 5px; color: red;">*</span>��Ʒ���ƣ�</td>
<td class="left">
<input name="title" type="text" style="width:350px;" value="<?=$pro['title']?>" class="biankuan" />
<input name="color" type="text" id="color" value="<?=$pro['color']?>" size="7" class="biankuan" /> 
<input type="button" id="colorpicker" value="��ȡɫ��" class="tijiao_input"/>         </td>
</tr>
<tr>
<td height="32" class="td_left">
<span style="padding: 0pt 5px; color: red;">*</span>��Ʒʱ�ޣ�</td>
<td class="left">
<?php if ($pro['overdue']=='0'){echo"������";}else{echo$pro['overdue']."��";}?>
</td>
</tr>
<tr>
<td height="32" class="td_left">
��������</td>
<td class="left"><?php
$yx_area=new area();  
echo $yx_area->region($pro['provinces'],$pro['citys'])?>
</td>
</tr>
<tr>
<td class="td_left">
<span style="padding: 0pt 5px; color: red;">*</span>������ƷĿ¼��</td>
<td class="left">
<div style="width: 350px; height:200px; overflow: auto; border:1px #CCC solid; padding:4px;">
<?php
$presult=mysql_query("select * from  product_class  where LagID=1  and isno3=0 order by Classorder asc,id desc",$conn1);
while($prow=mysql_fetch_array($presult)){?>
<input name="ClassID[]" type="checkbox" value="<?=$prow['NumberID']?>"  disabled="disabled"> <?=$prow['7']?> <br />
<?php
$zresult=mysql_query("select * from  product_class where  LagID=2 and  PartID='$prow[NumberID]' order by Classorder asc,id desc",$conn1);
while($pr=mysql_fetch_array($zresult)){?>
----<input name="ClassID[]" type="checkbox" value="<?=$pr['NumberID']?>"> <?=$pr['7']?><br />
<?php
}
} 
?>
</div>
</td>
</tr>
<tr>
<td width="10%" class="td_left">��Ʒ��ֵ��</td>
<td width="90%" class="left"><?=$pro['price1']?> Ԫ</td>
</tr>
<tr>
<td width="10%" class="td_left">�����۸�</td>
<td width="90%" class="left"><?=$pro['price2']?> Ԫ <select name="pricing" id="pricing">
<option value="1">�����Ӱٷֱ�</option>
<option value="2">�����ӹ̶�ֵ</option>
</select>
<input name="rate" type="text" style="width:60px;" onkeyup="clearNoNum(this)"/>  
��������۸�100 ���ٷֱ����� ����д�� 1��ʱ�� ����1% Ҳ����ÿ������1Ԫ
 </td>
</tr>
<tr>
<td width="10%" class="td_left">��Ʒ��λ��</td>
<td width="90%" class="left"><?=$pro['punit']?></td>
</tr>
<tr>
<td class="td_left">
��Ʒ��飺</td>
<td class="left">
<textarea name="content" rows="2" cols="20" id="content" class="biankuan" style="width: 350px; height: 100px" ><?=$pro['content']?></textarea></td>
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
<td>                </td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�ϱ���" id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();" /><input type="button" value="����ǰҳ" class="fanhui_input" onclick="history.go(-1);" />                </td>
</tr>
</table>
</form>
<?php } ?>
<?php if ($Action=='save') {
$ClassID= implode(",",$_POST['ClassID']);
$allArray=(explode(',',$ClassID));    ////�� explode �� , �����ݸ���������
$title=$_POST['title'];             //��Ʒ����
$color=$_POST['color'];             //������ɫ
$content=$_POST['content'];         //��Ʒ���
$focus=$_POST['focus'];             //ע������
$rate=$_POST['rate'];
$pricing=$_POST['pricing'];
foreach($allArray as $value) { 
$directory1=substr($value,0,4);
$directory2=substr($value,0,7);

mysql_query("insert into product set pricing='$pricing',rate='$rate',kucun='$pro[kucun]',overdue='$pro[overdue]',title='$title',color='$color',directory1='$directory1',directory2='$directory2',directory3='$value',directory4='$pro[directory3]',punit='$pro[punit]',modl='$pro[modl]',buy_md='$pro[buy_md]',price='$pro[price]',price1='$pro[price1]',price2='$pro[price2]',url='$pro[url]',content='$content',focus='$focus',service='$pro[service]',time='$begtime',provinces='$pro[provinces]',citys='$pro[citys]',sid='$pro[id]',Api='$pro[Api]',Api_id='$pro[Api_id]',Api_buy_num='$pro[Api_buy_num]',Api_buy_type='$pro[Api_buy_type]',username='$pro[username]',locks=2",$conn1);
$myid=mysql_insert_id($conn1);
mysql_query("update product set paixu='$myid' where id='$myid'",$conn1); 
}



echo "<br><br><br><br><br><br><br><center><input id='btnAll' type='button' value='�Խӳɹ�!'  onClick='cl()' class='tijiao_input' /></center>";
}?>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>