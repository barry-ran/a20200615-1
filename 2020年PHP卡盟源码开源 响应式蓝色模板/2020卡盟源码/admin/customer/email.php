<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
$Action=strip_tags($_GET['Action']);
$keyword=strip_tags($_GET['keyword']);
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



if ($Action=="Addsave") {
require '../../public/smtp.php'; 
$online=strip_tags($_POST['online']);       //��������
$title=strip_tags($_POST['title']);         //���ű���
$username=strip_tags($_POST['username']);   //������
$username1=strip_tags($_POST['username1']); //������
$content=strip_tags($_POST['content']); //����
$allArray=(explode('|',$username));
echo "<br><br><center><img src='/Public/images/loding.gif'></center>";
ob_end_flush();
if     ($online=='0'){
foreach($allArray as $value){
echo str_pad(" ",256);
$yx_us_result=mysql_query("select * from members where number='$value' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
$smtpserver =$smtp_email;//SMTP������ 
$smtpserverport = 25;//SMTP�������˿� 
$smtpusermail =$send_email;//SMTP���������û����� 
$smtpemailto =$yx_us[email];//���͸�˭ 
$smtpuser =$send_email;//SMTP���������û��ʺ� 
$smtppass =encrypt($send_email_password,'D','nowamagic'); ;//SMTP���������û����� 
$mailsubject =$title;//�ʼ����� 
$mailbody = $content;//�ʼ����� 
$mailtype = "HTML";//�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ� 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤. 
$smtp->debug =false;//�Ƿ���ʾ���͵ĵ�����Ϣ 

if($smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype)){
mysql_query("insert into `send_email` set title='$title',content='$content',username='$value',email='$yx_us[email]',begtime='$begtime'",$conn1);
echo $yx_us[email]."�ʼ����ͳɹ���<br>";
}else{
echo $yx_us[email]."�ʼ�����ʧ�ܣ�<br>";
}
ob_flush();
flush();  
sleep(5);

////////////////////////////////////////////////////////////////////////////////////////�����ʼ�����
}





}elseif ($online=='1'){
	
$result=mysql_query("select * from members where level='$username1'",$conn1);
if ($result){
while($user=mysql_fetch_array($result)){
echo str_pad(" ",256);
$smtpserver =$smtp_email;//SMTP������ 
$smtpserverport = 25;//SMTP�������˿� 
$smtpusermail =$send_email;//SMTP���������û����� 
$smtpemailto =$user[email];//���͸�˭ 
$smtpuser =$send_email;//SMTP���������û��ʺ� 
$smtppass =encrypt($send_email_password,'D','nowamagic'); ;//SMTP���������û����� 
$mailsubject =$title;//�ʼ����� 
$mailbody = $content;//�ʼ����� 
$mailtype = "HTML";//�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ� 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤. 
$smtp->debug =false;//�Ƿ���ʾ���͵ĵ�����Ϣ 

if($smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype)){
mysql_query("insert into `send_email` set title='$title',content='$content',username='$user[number]',email='$user[email]',begtime='$begtime'",$conn1);
echo $user[email]."�ʼ����ͳɹ���<br>";
}else{
echo $user[email]."�ʼ�����ʧ�ܣ�<br>";
}
ob_flush();
flush();  
sleep(5);
}
}
}elseif ($online=='2'){
$result=mysql_query("select * from members ",$conn1);
if ($result){
while($user=mysql_fetch_array($result)){
echo str_pad(" ",256);
$smtpserver =$smtp_email;//SMTP������ 
$smtpserverport = 25;//SMTP�������˿� 
$smtpusermail =$send_email;//SMTP���������û����� 
$smtpemailto =$user[email];//���͸�˭ 
$smtpuser =$send_email;//SMTP���������û��ʺ� 
$smtppass =encrypt($send_email_password,'D','nowamagic'); ;//SMTP���������û����� 
$mailsubject =$title;//�ʼ����� 
$mailbody = $content;//�ʼ����� 
$mailtype = "HTML";//�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ� 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤. 
$smtp->debug =false;//�Ƿ���ʾ���͵ĵ�����Ϣ 

if($smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype)){
mysql_query("insert into `send_email` set title='$title',content='$content',username='$user[number]',email='$user[email]',begtime='$begtime'",$conn1);
echo $user[email]."�ʼ����ͳɹ���<br>";
}else{
echo $user[email]."�ʼ�����ʧ�ܣ�<br>";
}
ob_flush();
flush();  
sleep(5);

}
}
}
echo "<script>alert('���ͳɹ�!');self.location=document.referrer;</script>";
}
if ($Action=="del") {
mysql_query("delete from send_email where id ='$_REQUEST[id]'",$conn1);
echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='ɾ��'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
mysql_query("delete from send_email where id in ($ID_Dele)",$conn1);
echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
}

?>

<?php if  ($Action=="List" or $Action==""){?>

<div class="Menubox" >
<ul>
<li class="hover"><a href="email.php">Ⱥ���ʼ�</a></li>
</ul>
</div>

<form name="add" method="get" action="email.php" >
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin-top:10px;">
<tr>
<td height="32" class="td_left">
�ؼ������룺</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="" />
</td>
</tr>
<tr>
<td height="32" class="td_left">����ʱ�䣺</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="ȷ�ϲ�ѯ"  class="chaxun_input" />
</td>
</tr>
</table></form>
<form name="form1" method="post" action="">
<table cellspacing="1" cellpadding="0" class="page_table" style="margin-top:10px;">
<tr>
<td width="6%" class="table_top">ID</td>
<td width="13%" class="table_top">���</td>
<td width="20%" class="table_top">�����ַ</td>
<td width="31%" class="table_top">�������</td>
<td width="17%" class="table_top">����ʱ��</td>
<td width="13%" class="table_top">����</td>
</tr>
<?php

$search="where 1=1 ";
if ($keyword!='') $search.=" and title like '%$keyword%' "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `send_email`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from send_email $search    order by begtime desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
while ($row=mysql_fetch_array($zyc)){
?>
<tr>
<td height="28"><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td height="28"><?=$row['username']?></td>
<td><?=$row['email']?></td>
<td align="left">
<a href="#art1" onclick="art.dialog.open('email.php?Action=edit&Id=<?=$row['id']?>',{title: '<?=$row['title']?>', width: 600,lock: true, fixed:true});"><span style="color:#38af38; text-decoration:underline">
<?=$row['title']?>
</span>
</a>
</td>
<td><?=date("Y-m-d G:i:s",$row['begtime'])?></td>
<td><a href="?Action=del&id=<?=$row['id']?>">ɾ��</a></td>
</tr>
<?php
}
?>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="left" style="padding:15px 0px;"><input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="ɾ��" class="x3_input" onclick="return CheckSelect();"></td> 
<td align="center" style="padding:15px 0px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?> </td> 
</tr>
</table>
</form>
<?php }elseif($Action=="add"){?>
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
<div class="tishi1" style="margin-top:0px;">
1���ʼ�Ⱥ���ٶ�ȡ�������������ٶ��Լ������͵Ŀͻ�������<br />
2��������ȫ�������������������ճɿ���״̬��Ȼ������Ļ�Ա������Ļ����Ժ��ԣ�<br />
3���ʼ�Ⱥ�����ǰٷְٷ��ͳɹ��ģ�<br />
4������Է������ʼ�����ȷ�Ļ��ǽ��ղ��������͵��ʼ��ģ�<br />
</div>
<form name="userinfo" method="post" action="?Action=Addsave" >
<input name="Token" type="hidden" value="<?=genToken()?>">
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
<td width="10%" class="td_left">�ʼ����⣺</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="" class="biankuan" /></td>
</tr>
<tr>
<td width="10%" class="td_left">�ʼ����ݣ�</td>
<td width="90%" class="left"><textarea name="content" cols="70" rows="6" class="biankuan"></textarea></td>
</tr>

<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�����"  id="btnSubmit" class="tijiao_input"  onClick="return checkuserinfo();"/>
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="edit"){
$Id=inject_check($_GET['Id']);
$result=mysql_query("select * from send_email where id='$Id'",$conn1);
$row=mysql_fetch_array($result);	
echo $row['content'];
 } ?>
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


<script language="javascript">
function checkuserinfo()
{

if(checkspace(document.userinfo.title.value)) {
document.userinfo.title.focus();
alert("�ύʧ�ܣ���Ϣ���ⲻ��Ϊ�գ�");
return false;
}

if(checkspace(document.userinfo.content.value)) {
document.userinfo.content.focus();
alert("�ύʧ�ܣ���Ϣ��������Ϊ�գ�");
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
function cl(){ 
var win = art.dialog.open.origin;
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>