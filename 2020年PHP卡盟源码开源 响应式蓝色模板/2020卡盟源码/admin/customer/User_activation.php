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
$keywords=strip_tags($_POST['content']);
$keyword=strip_tags($_POST['content']);
$agent=strip_tags($_POST['agent']);
?>
<div class="Menubox" >
<ul>
<li class="hover"><a href="User_activation.php">�û�����</a></li>
</ul>
</div>

<form name="add" method="post" action="User_activation.php?Action=save">
<table cellspacing="1" cellpadding="0" class="page_table2" style="margin:10px 0px;">
<tr>
<td height="32" class="td_left">
�ؼ������룺</td>
<td class="left">
<input name="keyword" type="text" maxlength="25" id="keyword" value="<?=$keyword?>" />
</td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯ������</td>
<td class="left">
<select name="keywords" id="keywords">
<option <?php if ($keywords=='content'){?>selected="selected"<?php } ?> value="username">�û���</option>
<option <?php if ($keywords=='content'){?>selected="selected"<?php } ?> value="email">��������</option>
</select>
</td>
</tr>
<tr>
<td height="32" class="td_left">
�ϼ���ţ�</td>
<td class="left">
<input name="agent" type="text" maxlength="25" id="agent" value="<?=$agent?>" /> 
��������
</td>
</tr>
<tr>
<td height="32" class="td_left"></td>
<td class="left">
<input type="submit" name="btnQuery" value="ȷ�ϼ���"  class="chaxun_input" />
</td>
</tr>
</table>
</form>


<?php if($Action=="save"){

if ($agent!=''){
//-------------�ж��Ƿ��и��ϼ�
$zong=mysql_num_rows(mysql_query("select * from `members` where number='$agent' ",$conn1));
if ($zong==0){
echo "�Բ��𼤻�ʧ�ܣ�û���ҵ����ϼ���";
exit();	
}
}


//------------��֤��վ�Ƿ��и��û���
$total=mysql_num_rows(mysql_query("select * from `members` where $keywords='$keyword' ",$conn1));
if ($total>0){
echo "�Բ��𼤻�ʧ�ܣ����û��Ѿ�������ѽ��";
exit();	
}

//------------��֤�ƶ��Ƿ��и��û�����

$total=mysql_num_rows(mysql_query("select * from `check_reg` where $keywords='$keyword' ",$conn2));
if ($total==0){
echo "�Բ��𼤻�ʧ�ܣ�û���ҵ����û�ѽ��";
exit();	
}else{
	
//------------��ѯ�����ݽ��и��Ƹ���

$result=mysql_query("select * from check_reg where $keywords='$keyword' ",$conn2);
$row=mysql_fetch_array($result);
	
///////////////////////////////////////////////////////////////////////////������ż�¼
$bh_result=mysql_query("select * from  bianhao_list",$conn1);
while($bh=mysql_fetch_array($bh_result)){
$strid.=$bh['title'].',';
}
$strid=substr($strid,0,strlen($strid)-1);//�����id�ַ���
///////////////////////////////////////////////////////////////////////////��ѯ��¼���������б��һ����¼
if ($strid!=''){
$us_result=mysql_query("select * from members where  number NOT IN($strid) order by number desc limit 1 ",$conn1);
}else{
$us_result=mysql_query("select * from members  order by number desc limit 1 ",$conn1);
}
$user=mysql_fetch_array($us_result);
$Uid=$user['number']+1;
///////////////////////////////////////////////////////////////////////////���������֤�Ƿ��ظ�

$total=mysql_num_rows(mysql_query("select * from `members` where  number='$Uid' order by number desc ",$conn1));
if ($total==0){
$Uid=$Uid;
}else{
$Uid=$Uid+1;
}
$total=mysql_num_rows(mysql_query("select * from `bianhao_list` where  title='$Uid'",$conn1));
if ($total==0){
$Uid=$Uid;
}else{
$zong=mysql_num_rows(mysql_query("select * from `bianhao_list` where  title>'$Uid'",$conn1));
for($i=1;$i<=$zong;$i++){
$result=mysql_query("select * from  bianhao_list  where title='$Uid' ",$conn1);
$row=mysql_fetch_array($result);
if ($row){
$Uid=$Uid+1;
}
}
}
///////////////////////////////////////////////////////////////////////////���������֤�Ƿ��ظ� THE End


////////////////////////////////////////////////////////////////////////////���м�¼�ĸ���
$network=ysk_network(Local_Ip());
$Local_Ip=Local_Ip();
if      ($agent!='' and $site_agent==$agent){
$site_leve=$site_leve;
}elseif ($agent=='' and $site_agent!='' ){
$site_leve=$site_leve;
}else{
$site_leve='1';
}

mysql_query("insert into `members` set level='$site_leve',agent='$agent',number='$Uid',username='$row[username]',password='$row[password]',passwords='$row[passwords]',company='$row[company]',rname='$row[rname]',card='$row[card]',qq='$row[qq]',email='$row[email]',phone='$row[phone]',address='$row[address]',begtime='$begtime',province='$row[province]',city='$row[city]',time='$begtime',lost_time='$begtime',log_time='$begtime',lost_ip='$Local_Ip',log_ip='$Local_Ip',lost_dz='$network',log_dz='$network'  ",$conn1);
if ($agent!=''){
mysql_query("update members set xlevel=xlevel+1 where number='$agent'",$conn1); 
}

echo "����ɹ���";
exit();	
}

} ?>
</body>
</Html>
