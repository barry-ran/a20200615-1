<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
$send=strip_tags($_GET['send']);   //����/����
$state=strip_tags($_GET['state']); //�Ķ�״̬
$begtime=$_POST['begtime'];       //����ʱ��
if ($Action=="Addsave") {
$online=strip_tags($_POST['online']);       //��������
$title=strip_tags($_POST['title']);        //���ű���
$lock=strip_tags($_POST['lock']);         //�Ƿ�ǿ�Ʋ鿴
$username=strip_tags($_POST['username']);//������
$username1=strip_tags($_POST['username1']);
$content=strip_tags($_POST['content']); //����
$sendname='ƽ̨����Ա';             //������

ysk_date_log(6,$_SESSION['ysk_username'],'������һ�� "'.$title.'" ��վ����Ϣ');

if ($title==''){
echo "<script language=\"javascript\">alert('�Բ�����Ϣ���ⲻ��Ϊ�գ�');history.go(-1);</script>";
exit();
}
if ($content==''){
echo "<script language=\"javascript\">alert('�Բ�����Ϣ��������Ϊ�գ�');history.go(-1);</script>";
exit();
}

$allArray=(explode('|',$username));
if     ($online=='0'){
foreach($allArray as $value){ 
mysql_query("insert into `sms` set title='$title',content='$content',locks='$lock',username='$value',sendname='$sendname',begtime='$begtime'",$conn1);
}
}elseif ($online=='1'){
$result=mysql_query("select * from members where level='$username1'",$conn1);
if ($result){
while($user=mysql_fetch_array($result)){
mysql_query("insert into `sms` set title='$title',content='$content',locks='$lock',username='$user[number]',sendname='$sendname',begtime='$begtime'",$conn1);
}
}
}elseif ($online=='2'){
$result=mysql_query("select * from members ",$conn1);
if ($result){
while($user=mysql_fetch_array($result)){
mysql_query("insert into `sms` set title='$title',content='$content',locks='$lock',username='$user[number]',sendname='$sendname',begtime='$begtime'",$conn1);

}
}
}
echo "<script>alert('���ͳɹ�!');self.location=document.referrer;</script>";
}



////////ɾ������¼
if ($Action=="del") {
ysk_date_log(6,$_SESSION['ysk_username'],'ɾ����һ��վ����Ϣ');
mysql_query("delete from sms where id ='$_REQUEST[Id]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='Messages.php';</script>";
}

////////����ɾ��
if ($_POST[ID_Dele]!="") {
$ID_Dele= implode(",",$_POST['ID_Dele']);
ysk_date_log(6,$_SESSION['ysk_username'],'ɾ����һЩվ����Ϣ');
mysql_query("delete from sms where id in ($ID_Dele)",$conn1);
echo "<script>alert('ɾ���ɹ�!');window.location='Messages.php';</script>";
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
</head>
<body>
<div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header">���Ź������� - Powered by <a href="http://www.juheshe.cn" target="_blank">�ۺ���</a></div>
	   <div class="layui-card-body" style="padding: 15px;">
<div style="padding-bottom: 10px;">
		  <input type="button" value="ȫѡ" onClick="CheckAll()" class="layui-btn layui-btn-sm" /><input type="submit" name="Del" id="Del" value="ɾ��" onclick="test()" class="layui-btn layui-btn-danger layui-btn-sm" > 
&nbsp;  &nbsp;
<a href="messages.php?send=1" class="layui-btn layui-btn-sm layui-btn-normal">�ռ���</a>
<a href="messages.php?send=2" class="layui-btn layui-btn-sm layui-btn-normal">������</a>&nbsp;  &nbsp; &nbsp;  &nbsp;  <a href="?Action=add" class="layui-btn layui-btn-sm layui-btn-normal">���Ͷ���</a>
	<br/>	
	<br/>
<?php if($Action==""){?>
<form name="form1" method="post" action="">
<table class="layui-table admin-table">
<div class="layui-table-header"><thead>
                <tr>
                    <th width="50px" style="text-align:center">ѡ��</th>
					<th width="60px" style="text-align:center">״̬</th>
                    <th width="80px" style="text-align:center">������</th>
                    <th width="200px" style="text-align:center">�ռ���</th>
                    <th width="600px" style="text-align:center">���ű���</th>
                    <th width="200px" style="text-align:center">����ʱ��</th>
                    <th width="210px" style="text-align:center">����</th>
                </tr>
            </thead>
			</div></div>
<?php
$search="where 1=1 "; 
if ($send!='' and $send=='1') $search.=" and username='ƽ̨����Ա'"; 
if ($send!='' and $send!='1') $search.=" and sendname='ƽ̨����Ա'"; 
if ($state!='') $search.=" and state = '$state' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `sms`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$zyc=mysql_query("SELECT * FROM `sms` $search  order by begtime desc,id desc  {$page->limit}",$conn1); 
while ($row=mysql_fetch_array($zyc)){
?>
<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></td>
<td align="center"><?php if ($row['reply']!='') {?>
<button class="layui-btn layui-btn-normal layui-btn-xs">�Ѹ�</button>
<?php }else if ($row['state']=='0') {?>
<button class="layui-btn layui-btn-danger layui-btn-xs">δ��</button>
<?php }else if ($row['state']=='1') {?>
<button class="layui-btn layui-btn-primary layui-btn-xs">�Ѷ�</button>
<?php } ?>
</td>
<td align="center"><?=$row['sendname']?></td>
<td align="center"><?=$row['username']?></td>
<td align="center"><?=$row['title']?></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td align="center"><a href="?Action=edit&Id=<?=$row[id]?>" class="layui-btn layui-btn-xs layui-btn-normal">�鿴</a> <a href="?Action=del&Id=<?=$row[id]?>" class="layui-btn layui-btn-xs layui-btn-danger" onclick="Javascript:return confirm('ȷ��Ҫɾ����');">ɾ��</a> </td>
</tr>
<?php
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="83%"><?php if ($total!=0){?><?=$page->paging();?><?php }?> </td>
</tr>
</table>
</form>

<?php }elseif($Action=="add"){  ?>
<script type="text/javascript">
//<![CDATA[
var ss = 1;//��ǰ��ʾ��
function switchView1(vv){
document.getElementById('form1_'+ss).style.display = 'none';//������һ����ʾ��
document.getElementById('form1_'+vv).style.display = '';//��ʾѡ���.
ss = vv;
}
//]]>
</script>
<form name="add" method="post" action="?Action=Addsave" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��Ϣ���</td>
</tr>
<tr>
<td width="10%" class="td_left"> ���������ͣ�</td>
<td width="90%" class="left">	  <select name="online" id="online" onchange="switchView1(this.value)">   
<option selected="selected" value="">��ѡ��</option>
<option value="2">ȫ���û�</option>
<option value="0">ָ���û�</option>
<option value="1">ָ������</option>

</select>   </td>
</tr>

        
            
<tr  id="form1_0"  style="display:none">   
<td width="10%" class="td_left">  �����ˣ�</td>
<td width="90%" class="left"><input name="username" type="text" id="username" style="width:362px;" class="biankuan" />  ����ͻ������м��� | ����  </td>
</tr>
				
<tr  id="form1_1"  style="display:none">   
<td width="10%" class="td_left"> 
�����ˣ�</td>
<td width="90%" class="left">  <select name="username1" id="username1">  
<option  value="" selected="selected">��ѡ��</option> 
<?php
$result=mysql_query("select * from level order by id desc",$conn1);
if ($result){
while($level=mysql_fetch_array($result)){?>
<option value="<?=$level['id']?>"><?=$level['title']?></option>
<?php 
}
}?>  </select></td>
      </tr>
            
<tr>
<td width="10%" class="td_left">��Ϣ���⣺</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="" class="biankuan" /></td>
</tr>
<input name="begtime" readonly="readonly" type="hidden"  value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<tr>
<td width="10%" class="td_left">��Ϣ���ݣ�</td>
<td width="90%" class="left"><textarea name="content" cols="70" rows="6" class="biankuan" id="content"></textarea></td>
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
$sql="select * from sms where id='$_REQUEST[Id]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
?>

<table cellspacing="1" cellpadding="2" class="page_table4" style="margin: 0">
<tr>
<td class="td_left">�� �� �ˣ�</td>
<td class="left"><?=$row['sendname']?></td>
</tr>
<tr>
<td class="td_left"> ���ű��⣺</td>
<td class="left"><?=$row['title']?></td>
</tr>
<tr>
<td class="td_left">�������ݣ�</td>
<td class="left"><?=$row['content']?>
</td>
</tr>
<tr>
<td class="td_left">
�յ�ʱ�䣺</td>
<td class="left"><?=date("Y-m-d G:i:s",$row['begtime'])?>
</td>
</tr>
<tr>
<td class="td_left">�Է��ظ���</td>
<td class="left"><?=$row['reply']?>
</td>
</tr>
<tr>
<td class="td_left">&nbsp;
</td>
<td class="left">
<input id="Button1" type="button" value="����" class="tijiao_input" onclick="history.go(-1);" />
</td>
</tr>
</table>
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