
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>welcome</title>
</head>
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<link href="css/style1.css" rel="stylesheet" type="text/css" />

<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
$Action=strip_tags($_GET['Action']); 
$content=strip_tags($_POST['content']); 
$begtime=strip_tags($_POST['begtime']);   
$supd_result=mysql_query("select * from sup_members_site where number='$sup_number' ",$conn2); 
$supdoc=mysql_fetch_array($supd_result);
if ($sup_rules_module=='0'){
if ($nlegal_open=='0') {
if(preg_match("/$nlegal_b_3/i",$content)){
mysql_query("insert into  `punishment_list`  set title='����Ͷ�߳������д���',number='$_SESSION[ysk_number]',deduct='$nlegal_b_2',begtime='$begtime'",$conn1); 
mysql_query("update `members`  set bad_grades1=bad_grades1+$nlegal_b_2 where number='$_SESSION[ysk_number]'",$conn1); 
echo "<script>alert('�Բ������ݺ��к��������ַ������������۵� $nlegal_b_2 �֣�');self.location=document.referrer;</script>";
exit();
}
}
}
?>
<div id="right">
<div class="ifra-right_con">
		<h3 class="column-title">
			<b>Ͷ���뽨��</b>
			<span class="col-t-g">
				<input onclick="window.location = 'Complaint.php'" type="button" value="����Ͷ���б�" class="spl-btn"/>
			</span>
		</h3>

<?php if ($Action=='') {?>
<div class="self-run-con">
			<dl>
				<dt>���ⶩ���ࣺ</dt>
				<dd>������ֵ�����ʵ����⣬��ѡ�������</dd>
			</dl>
			<dl>
				<dt>����Ͷ���ࣺ</dt>
				<dd>�����ǵķ��񼰽���Ͷ�ߵȣ���ѡ�������</dd>
			</dl>
			<dl class="save-return">
				<input type="button" onclick="window.location = 'AddComplain.php?Action=ad1'" value="���ⶩ����" class="save-btn" />
				<input type="button" onclick="window.location = 'javascript:(0)'" value="����Ͷ����" class="save-btn" />
			</dl>
		</div>
	</div>
<?php }elseif ($Action=='ad1'){
$id=strip_tags($_GET['id']); 	
?>

<form action="?Action=save1" method="post">
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<input name="Token" type="hidden" value="<?=genToken()?>">
<div class="ifra-right_con">
		<div class="self-run-con">
				<dl>
					<dt>�������ͣ�</dt>
					<dd>ֱ��������</dd>
				</dl>
				<dl>
					<dt>�����ţ�</dt>
					<dd>
						<input type="text" name="orerno" type="text" maxlength="50" id="orerno" value="<?=$id?>" style="width: 250px;" />
						<span class="warning">����������޷��鵽��ض���</span>
					</dd>
				</dl>
				<dl>
					<dt>Ͷ�����⣺</dt>
					<dd>
						<select name="title" id="title">
<option value="�����ˣ��벹��" selected="selected">�����ˣ��벹��</option>
<option  value="��ֵû����">��ֵû����</option>
<option value="���Ż������д���">���Ż������д���</option>
<option value="�����">�����</option>
<option value="��ѯ����ʹ�����">��ѯ����ʹ�����</option>
<option value="��ѯֱ�䵽�����">��ѯֱ�䵽�����</option>
<option value="��������">��������</option>

</select>
					</dd>
				</dl>
				<dl class="se-g-intro">
					<dt>Ͷ�����ݣ�</dt>
					<dd>
						<textarea name="content" rows="8" cols="50" id="content" class="biankuan" placeholder="����������Ͷ������"></textarea>
						<br/><label>�������1000���ַ�</label>
					</dd>
				</dl>
				<dl class="save-return">
				<input type="submit" name="Submit" value="ȷ���ύ" id="Submit" class="save-btn" />
					<input type="button" name="backpage" id="backpage" value="�����б�" class="return-btn"/>
				</dl>
			</form>
		</div>
	</div>

</table>
</form>
<?php
}elseif ($Action=='save1'){
$type=strip_tags($_POST['type']);
$title=strip_tags($_POST['title']);
$orerno=strip_tags($_POST['orerno']);
$content=strip_tags($_POST['content']);
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}
//--��ȡ������Ϣ--//
$result=mysql_query("select * from product_order where orderid='$orerno' and number='$_SESSION[ysk_number]'",$conn1);
$order=mysql_fetch_array($result);

if($order['orderid']==''){ 
echo "<script>alert('�Բ����Ҳ����ö����ţ�');self.location=document.referrer;</script>";
exit();
}

if ($order['docking']!=0){
	$clouds=1;
	}else{
	$clouds=0;	
	}
	
if ($order['docking']!=0){
$sresult=mysql_query("select * from docking_platform where id='$order[docking]' ",$conn1);
$sus=mysql_fetch_array($sresult);
$sup_result=mysql_query("select * from sup_members_site where domain_name='$sus[uid]' ",$conn2);
$sup=mysql_fetch_array($sup_result);
$passwords=encrypt($sup['passwords'],'D','nowamagic');
$conn3 = mysql_connect('localhost',$sup['username'],$passwords,true);
mysql_select_db($sup['mydatabase'], $conn3);
mysql_query("set names 'GBK'");
}
//��֤�Ƿ��ύ��Ͷ��
$total=mysql_num_rows(mysql_query("select * from `complaints_feedback` where orerno='$orerno' ",$conn1));
if ($total==0){
$content=$mytime.' ��'.$content;
mysql_query("insert into complaints_feedback set number='$_SESSION[ysk_number]',username='$order[username]',type='$type',title='$title',orerno='$order[orderid]',content='$content',time='$begtime',sid='$order[sid]',clouds='$clouds'",$conn1);

if ($order['docking']!=0){
mysql_query("insert into complaints_feedback set docking='$supdoc[id]',number='$sus[username]',username='$order[username]',type='$type',title='$title',orerno='$order[orderid]',content='$content',time='$begtime',sid='$order[sid]'",$conn3);
}

//------------------------------------------------------------Sup����Ͷ��
if ($order['sid']!=0){
mysql_query("insert into sup_complaints_feedback set number='$_SESSION[ysk_number]',username='$order[username]',type='$type',title='$title',orerno='$order[orderid]',content='$content',time='$begtime'",$conn2);
}

echo "<script>alert('�ύ�ɹ���');window.location='Complaint.php';</script>";
exit();
}else{
echo "<script>alert('�ύʧ�ܣ������ظ��ύ');window.location='Complaint.php';</script>";
exit();	
}
}elseif ($Action=='ad2') {?>
<form action="?Action=save2" method="post">
<input name="Token" type="hidden" value="<?=genToken()?>">
<div class="ifra-right_con">
		<div class="self-run-con">
<table>
<tr>
<td width="30%" class="table1_left">�������ͣ�</td>
<td class="tdleft"><input name="type" type="hidden" value="����Ͷ����" />����Ͷ����</td>
</tr>
<tr>
<td class="table1_left">Ͷ�����⣺</td>
<td class="tdleft"><input name="title" type="text" maxlength="50" id="title" class="biankuan" placeholder="���������Ľ���"/></td>
</tr>
<tr>
<td class="table1_left">
Ͷ�����ݣ�</td>
<td class="tdleft">
<textarea name="content" rows="8" cols="50" id="content" class="biankuan" placeholder="���������Ľ�������" style="width: 500px; height: 130px"></textarea></td>
</tr>
<tr>
<td>
</td>
<td class="tdleft">
<input type="submit" name="Submit" value="ȷ���ύ" id="Submit" class="tijiao_input" />
<input id="Button2" type="button" value="����" class="fanhui_input" onClick="history.go(-1);" />
</td>
</tr>
</table>
</form>
<?php }elseif ($Action=='save2'){
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}
$content=date("Y-m-d H:i:s").' ��'.strip_tags($_POST['content']);
$type=strip_tags($_POST['type']);
$title=strip_tags($_POST['title']);
$orerno=strip_tags($_POST['orerno']);
mysql_query("insert into complaints_feedback set number='$_SESSION[ysk_number]',username='$order[username]',type='$type',title='$title',orerno='$orerno',content='$content',time='$begtime',sid='$order[sid]'",$conn1);
echo "<script>alert('�ύ�ɹ�����л����֧�֣�');;window.location='Complaint.php';</script>";
exit();
} ?>
</div>

</body>
</Html>