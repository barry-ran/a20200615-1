
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');


$Action=$_REQUEST['Action'];
////////��Ӽ�¼
if ($Action=="Addsave") {
$title=$_POST['title'];
$address=$_POST['address'];
$begtime=$_POST['begtime'];
$url=$_POST['url'];
$menu=$_POST['menu'];
ysk_date_log(6,$_SESSION['ysk_username'],'����������Ϊ"'.$title.'" ���ֲ�ͼƬ');
mysql_query("insert into `shuffling` (title,address,url,menu,begtime)"."values ('$title','$address','$url','$menu','$begtime')",$conn1);
echo "<script>alert('��ӳɹ�!');window.location='?Action=add';</script>";
}

////////�޸ļ�¼
if ($Action=="editsave") {
$title=$_POST['title'];
$address=$_POST['address'];
$url=$_POST['url'];
$menu=$_POST['menu'];
$y1=$_POST['y1'];
$y2=$_POST['y2'];
$y3=$_POST['y3'];
$y4=$_POST['y4'];

if ($y1<>$menu){ysk_date_log(6,$_SESSION['ysk_username'],'�޸����ֲ�ͼƬ "'.$y3.'" ��������Ŀ');}
if ($y2<>$address){ysk_date_log(6,$_SESSION['ysk_username'],'�޸����ֲ�ͼƬ "'.$y3.'" ��ͼƬ��ַ');}
if ($y3<>$title){ysk_date_log(6,$_SESSION['ysk_username'],'�޸����ֲ�ͼƬ "'.$y3.'" ��ͼƬ����');}
if ($y4<>$url){ysk_date_log(6,$_SESSION['ysk_username'],'�޸����ֲ�ͼƬ "'.$y3.'" �����ӵ�ַ');}

mysql_query("update shuffling set title='$title',address='$address',url='$url',menu='$menu'  where id='$_POST[Id]'",$conn1); 
echo "<script>alert('�޸ĳɹ�!');window.location='?Action=List';</script>";

}

////////ɾ������¼
If ($Action=="del") {
ysk_date_log(6,$_SESSION['ysk_username'],'ɾ����һ���ֲ�ͼƬ');
mysql_query("delete from shuffling where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='?Action=List';</script>";
}

////////����ɾ��
If ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
ysk_date_log(6,$_SESSION['ysk_username'],'ɾ����һЩ�ֲ�ͼƬ');
$sql="delete from shuffling where id in ($ID_Dele)";
mysql_query($sql,$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='?Action=List';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link rel="stylesheet" href="../css/layui.css" media="all">
<link rel="stylesheet" href="../css/admin.css" media="all">
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
<link href="/Public/yoxi_editor/themes/default/default.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="/Public/yoxi_editor/kindeditor.js"></script>
<script charset="utf-8" src="/Public/yoxi_editor/lang/zh_CN.js"></script>
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
<?php if($Action=="List" or $Action==""){?>
<div class="layui-fluid">
<form name="form1" method="post" action="">
    <div class="layui-card">
      <div class="layui-card-header">�ֲ����������� - Powered by <a href="http://www.juheshe.cn" target="_blank">�ۺ���</a></div>
	  <div class="layui-card-body" style="padding: 15px;">
<div style="padding-bottom: 10px;">
		  <input type="button" value="ȫѡ" onClick="CheckAll()" class="layui-btn layui-btn-sm" />
<input type="submit" name="Del" id="Del" value="ɾ��" onclick="test()" class="layui-btn layui-btn-danger layui-btn-sm" >  &nbsp;  &nbsp;  <a href="?Action=add" class="layui-btn layui-btn-sm layui-btn-normal">�����ֲ�</a>
		  </div>
		  <table class="layui-table admin-table">
<div class="layui-table-header"><thead>
                <tr>
                    <th width="50px" style="text-align:center">ѡ��</th>
					<th width="50px" style="text-align:center">���</th>
                    <th width="500px" style="text-align:center">ͼƬ����</th>
                    <th width="500px" style="text-align:center">���ӵ�ַ</th>
                    <th width="200px" style="text-align:center">��Ŀ</th>
                    <th width="200px" style="text-align:center">ʱ��</th>
                    <th width="210px" style="text-align:center">����</th>
                </tr>
            </thead>
			</div></div>
<?php

$total=mysql_num_rows(mysql_query("SELECT * FROM `shuffling`  ",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from shuffling  order by begtime desc,id desc  {$page->limit}"; 

$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></td>
<td align="center"><?=$row[id]?></td>
<td align="center"><?=$row[1]?></td>
<td align="center"><?=$row[3]?></td>
<td align="center"><?=$row[4]?></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center"><a href="?Action=edit&Id=<?=$row[id]?>" class='layui-btn layui-btn-xs layui-btn-normal'>�༭</a> <a href="?Action=del&Id=<?=$row[id]?>" onclick="Javascript:return confirm('ȷ��Ҫɾ����');"  class="layui-btn layui-btn-xs layui-btn-danger" onclick="Javascript:return confirm('ȷ��Ҫɾ����');">ɾ��</a> </td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="83%" style="text-align:center;">
<?=$page->paging();?>  </td>
</tr>
</table>
</form>

<?php }elseif($Action=="add"){  ?>
<div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header">����ͼƬ - Powered by <a href="http://www.juheshe.cn" target="_blank">�ۺ���</a></div>
	  <div class="layui-card-body" style="padding: 15px;">
<form name="add" method="post" action="?Action=Addsave" >
			            <div class="layui-form-item">
            <label class="layui-form-label">������Ŀ��</label>
<select name="menu" id="menu">
<option value="��ҳ��ͼ"  selected="selected">�ֲ�ͼƬ</option>
<option value="��ҳ�ͷ�" >��ά��</option>
</select>
          </div>
		  		  		  	<div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                  ����ʱ�䣺
              </label>
              <div class="layui-input-inline">
                  <input name="begtime" type="text" value="<?php $now=mktime(); echo $now;?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
			  <div class="layui-form-mid layui-word-aux">
                  �����޸ķ���ʱ�䣬��ˣ�<a href="http://tool.chinaz.com/Tools/unixtime.aspx" target="_blank">Unixʱ���</a>������ת��
              </div>
          </div>
		  			            <div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                  ͼƬ��ַ��
              </label>
              <div class="layui-input-inline">
                  <input name="address" type="text" id="url3" type="text" value="" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
			  <div class="layui-form-mid layui-word-aux">
                 <a type="button" id="image3" class="layui-btn layui-btn-xs layui-btn-normal">�ϴ�ͼƬ</a> 
              </div>
          </div>

		  		  			            <div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                  ͼƬ���ƣ�
              </label>
              <div class="layui-input-inline">
                  <input name="title" type="text" type="text" value="" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
		  		  		  			            <div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                  ���ӵ�ַ��
              </label>
              <div class="layui-input-inline">
                  <input name="url" type="text" type="text" value="" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
			  			  <div class="layui-form-mid layui-word-aux">
                  ���HTTP://
              </div>
          </div>
		  		  <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" id="btnSubmit" onClick="return checkuserinfo();"lay-submit="" lay-filter="component-form-element">�ύ���</button>
				  <button onclick="history.go(-1);return false;" class="layui-btn layui-btn-primary layui-btn-sm">����</button>
                </div>
              </div>
</form>
    </div>
              </div>    </div>
              </div>
<?php }elseif($Action=="edit"){  
$sql="select * from shuffling where id='$_REQUEST[Id]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>

<form action="?Action=editsave" method="post" name="add" onsubmit="return CheckPost();">
<input id="Id" name="Id" type="hidden" value="<?=$row[id]?>">
<input name="y1" type="hidden" value="<?=$row['menu']?>">
<input name="y2" type="hidden" value="<?=$row['address']?>">
<input name="y3" type="hidden" value="<?=$row['title']?>">
<input name="y4" type="hidden" value="<?=$row['url']?>">
<div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header">����޸� - Powered by <a href="http://www.juheshe.cn" target="_blank">�ۺ���</a></div><br/>
			            <div class="layui-form-item">
            <label class="layui-form-label">������Ŀ��</label>
<select name="menu" id="menu">
<option value="��ҳ��ͼ"  selected="selected">�ֲ�ͼƬ</option>
<option value="��ҳ�ͷ�" >�ͷ���ά��</option>
</select>
          </div>
		  		  		  	<div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                  ����ʱ�䣺
              </label>
              <div class="layui-input-inline">
                  <input name="begtime" type="text" value="<?php $now=mktime(); echo $now;?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
			  <div class="layui-form-mid layui-word-aux">
                  �����޸ķ���ʱ�䣬��ˣ�<a href="http://tool.chinaz.com/Tools/unixtime.aspx" target="_blank">Unixʱ���</a>������ת��
              </div>
          </div>
		  			            <div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                  ͼƬ��ַ��
              </label>
              <div class="layui-input-inline">
                  <input name="address" type="text" id="url3" type="text" value="<?=$row['address']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
			  <div class="layui-form-mid layui-word-aux">
                 <a type="button" id="image3" class="layui-btn layui-btn-xs layui-btn-normal">�ϴ�ͼƬ</a> 
              </div>
          </div>

		  		  			            <div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                  ͼƬ���ƣ�
              </label>
              <div class="layui-input-inline">
                  <input name="title" type="text" type="text" value="<?=$row['title']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
		  		  		  			            <div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                  ���ӵ�ַ��
              </label>
              <div class="layui-input-inline">
                  <input name="url" type="text" type="text" value="<?=$row['url']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
			  			  <div class="layui-form-mid layui-word-aux">
                  ���HTTP://
              </div>
          </div>
		  		  <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" id="btnSubmit" onClick="return checkuserinfo();"lay-submit="" lay-filter="component-form-element">�ύ���</button>
				  <button onclick="history.go(-1);return false;" class="layui-btn layui-btn-primary layui-btn-sm">����</button>
				  <br/><br/>
                </div>
              </div>
</form>
<?php } ?>    </div>
              </div>
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