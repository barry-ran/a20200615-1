
<!DOCTYPE HTML>
<html>
<?php 
include_once('../../jhs_config/function.php');
include_once('../../jhs_config/admin_check.php');
include_once('../../jhs_config/page_class.php');
include_once('../../jhs_config/sorting.php');
$Action=strip_tags($_GET['Action']);
$sid=strip_tags($_GET['sid']);
$locks=strip_tags($_GET['locks']);
$keywords=strip_tags($_GET['keywords']);
$status=strip_tags($_GET['status']);
$template=strip_tags($_GET['template']);
$type=strip_tags($_GET['type']);
$keywords=strip_tags($_GET['keywords']);
$ply=strip_tags($_GET['ply']);
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

if ($ply<>''){
$_SESSION['ply']=$ply;
}

$search="where sid=0 and pid=0"; 
if ($keywords!='') $search.=" and $type like '%$keywords%' "; 
if ($template!='') $search.=" and modl='$template'"; 
if ($status!='')   $search.=" and state='$status'"; 
if ($_SESSION['ply']=='1')$search.=" and username<>''"; 
if ($_SESSION['ply']=='0')$search.=" and username is  Null"; 
if ($_REQUEST['sid']!='') $search.=" and directory3='$_REQUEST[sid]'"; 
if ($StartYear!='') $search.=" and time >=$muyou1 and time <=  $muyou2 "; 
if ($locks!='') $search.=" and locks=0"; 
if ($locks=='') $search.=" and locks=2"; 

############################------------------------�������ʼ��
$id=$_REQUEST['id'];
if     ($Action=="move1"){//******************************************************************************************************************�ö�
#######��ȡ�ʼID
$sql=mysql_query("select * from product  $search order by paixu asc limit 1",$conn1);
$row=mysql_fetch_array($sql);                          
$sorting=$row['paixu']-0.5;
mysql_query("update product set paixu='$sorting' where id='$id'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}elseif($Action=="move2"){
//******************************************************************************************************************����
$sql=mysql_query("select * from product  where id='$id'",$conn1);
$row=mysql_fetch_array($sql);    
$sql1=mysql_query("select * from product $search and paixu<'$row[paixu]'  order by `paixu` desc limit 1 ",$conn1);
$row1=mysql_fetch_array($sql1);   
mysql_query("update product set paixu='$row1[paixu]' where id='$row[id]'",$conn1); 
mysql_query("update product set paixu='$row[paixu]'  where id='$row1[id]'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}elseif($Action=="move3"){//******************************************************************************************************************����
$sql=mysql_query("select * from product  where id='$id'",$conn1);
$row=mysql_fetch_array($sql);    
$sql1=mysql_query("select * from product $search and paixu>'$row[paixu]'  order by `paixu` asc limit 1 ",$conn1);
$row1=mysql_fetch_array($sql1);   
mysql_query("update product set paixu='$row1[paixu]' where id='$row[id]'",$conn1); 
mysql_query("update product set paixu='$row[paixu]'  where id='$row1[id]'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}elseif($Action=="move4"){//******************************************************************************************************************βҳ
#######��ȡ���ID
$sql=mysql_query("select * from product  $search order by paixu desc limit 1",$conn1);
$row=mysql_fetch_array($sql);
$sorting=$row['paixu']+0.5;
mysql_query("update product set paixu='$sorting' where id='$id'",$conn1); 
echo "<script>self.location=document.referrer;</script>";
exit();
}



if ($Action=='addsave'){
$ClassID=$_POST['ClassID'];         //��ƷĿ¼
$title=$_POST['title'];             //��Ʒ����
$color=$_POST['color'];             //������ɫ
$kucun=$_POST['kucun'];             //��Ʒ���
$price1=$_POST['price1'];           //��Ʒ��ֵ
$price2=$_POST['price2'];           //��Ʒ�ۼ�
$pricing=$_POST['pricing'];         //����ģ��
$rate=$_POST['rate'];               //�ۼ�ģ��
$modl=$_POST['modl'];               //��ֵģ��
$focus=$_POST['focus'];             //ע������
$punit=$_POST['punit'];             //��Ʒ��λ
$content=$_POST['content'];         //��Ʒ���
$service=$_POST['service'];         //��ϵ�ͷ�
$url=$_POST['url'];                 //��ֵ��ַ
$overdue=$_POST['overdue'];         //��������
$overday=$_POST['overday'];         //��������
$province=$_POST['province'];       //����ʡ��
$city=$_POST['city'];               //�������
$password=$_POST['password'];       //��������
$content1=$_POST['content1'];       //���ܡ�ѡ��
$buy_md=$_POST['buy_md'];           //��ֵģ��

$allArray=(explode(',',$ClassID));

if ($overday==''){$overday=$overdue;}
if ($ClassID==''){echo "<script>alert('�Բ�����û��ѡ�񷢲�����Ŀ��');;self.location=document.referrer;</script>";exit();}
if ($modl=='�˹�����' && $buy_md==''){
echo "<script>alert('����ʧ�ܣ�û��ѡ���ֵģ��ѽ��');;self.location=document.referrer;</script>";
exit();
}
foreach($allArray as $value) { 
$directory1=substr($value,0,4);
$directory2=substr($value,0,7);

ysk_date_log(5,$_SESSION['ysk_username'],'�����һ�� "'.$title.'" ��Ʒ��Ϣ');

mysql_query("insert into product set pricing='$pricing',rate='$rate',kucun='$kucun',overdue='$overday',title='$title',color='$color',directory1='$directory1',directory2='$directory2',directory3='$value',directory4='$value',punit='$punit',modl='$modl',buy_md='$buy_md',price='$price2',price1='$price1',price2='$price2',url='$url',content='$content',focus='$focus',service='$service',time='$begtime',provinces='$province',citys='$city',locks=2",$conn1);
$myid=mysql_insert_id($conn1);
mysql_query("update product set paixu='$myid' where id='$myid'",$conn1); 
//-----------------------------------------------------------------------------------------------------------------------------���뿨�� ���� ѡ��
if      ($modl=='����'){
mysql_query("insert into cloud_key set pid='$myid',password='$password',begtime='$begtime'",$conn1);
}elseif ($modl=='����' || $modl=='ѡ��'){
if ($content1){
$allArray=(explode("\n", $content1));
foreach($allArray as $value){
$allArray1=(explode(' ',$value));
$card=trim($allArray1[0]);
$password=trim($allArray1[1]);
mysql_query("insert into import_goods set pid='$myid',locks=0,card='$card',password='$password',time='$begtime'",$conn1);
}
}
}
//-------------------------------------------------------------------------------------------------------------------���뿨�� ���� ѡ�� The End
}

echo "<script>alert('��ӳɹ�!');window.location='?Action=add';</script>";
exit();
}


if ($Action=='editsave'){
$Id=inject_check($_POST['Id']);
$ClassID=$_POST['ClassID'];         //��Ʒ���
$title=$_POST['title'];             //��Ʒ����
$color=$_POST['color'];             //������ɫ
$kucun=$_POST['kucun'];             //��Ʒ���
$price1=$_POST['price1'];           //��Ʒ��ֵ
$price2=$_POST['price2'];           //��Ʒ�ۼ�
$pricing=$_POST['pricing'];         //����ģ��
$rate=$_POST['rate'];               //�ۼ�ģ��
$modl=$_POST['modl'];               //��ֵģ��
$focus=$_POST['focus'];             //ע������
$punit=$_POST['punit'];             //��Ʒ��λ
$content=$_POST['content'];         //��Ʒ���
$service=$_POST['service'];         //��ϵ�ͷ�
$url=$_POST['url'];                 //��ֵ��ַ
$password=$_POST['password'];       //��������
$content1=$_POST['content1'];       //���ܡ�ѡ��
$buy_md=$_POST['buy_md'];           //��ֵģ��
$overdue=$_POST['overdue'];         //��������
$overday=$_POST['overday'];         //��������
$province=$_POST['province'];       //����ʡ��
$city=$_POST['city'];               //�������
$directory1=substr($ClassID,0,4);
$directory2=substr($ClassID,0,7);

if ($overdue=='-1'){$overdue=$overday;}

if ($directory1==''){
echo "<script>alert('����ʧ�ܣ�ϵͳδ֪���������������û������ʲô��');;self.location=document.referrer;</script>";
exit();
}

if ($directory2==''){
echo "<script>alert('����ʧ�ܣ�ϵͳδ֪���������������û������ʲô��');;self.location=document.referrer;</script>";
exit();
}

if ($modl=='�˹�����' && $buy_md==''){
echo "<script>alert('����ʧ�ܣ�û��ѡ���ֵģ��ѽ��');;self.location=document.referrer;</script>";
exit();
}


$back_result=mysql_query("select * from product where id='$Id' and sid=0 and pid=0",$conn1);
$back=mysql_fetch_array($back_result);
############################################################��ȫ��֤
if ($back['id']==''){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ�û���ҵ�����Ʒ!";
exit();
}
############################################################��ȫ��֤ The End

if($title<>$back['title']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" �����޸ĳ��� "'.$title.'"',$_POST['Id']);
}
if($punit<>$back['punit']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" ��Ʒ��λ'.$back['punit'].'�޸ĳ��� "'.$punit.'"',$_POST['Id']);
}
if($color<>$back['color']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" ��ɫ�޸���',$_POST['Id']);
}
if($kucun<>$back['kucun']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" ����޸���',$_POST['Id']);
}
if($price1<>$back['price1']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" ��ֵ'.$back['price1'].'Ԫ �޸ĳ��� '.$price1.'Ԫ',$_POST['Id']);
}
if($price2<>$back['price2']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" �ۼ�'.$back['price2'].'Ԫ �޸ĳ��� '.$price2.'Ԫ',$_POST['Id']);
}
if($pricing<>$back['pricing']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" ���ۼ�ģ���޸���',$_POST['Id']);
}
if($rate<>$back['rate']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" ��Ա���۽��'.$back['rate'].'Ԫ �޸ĳ��� '.$rate.'Ԫ',$_POST['Id']);
}
if($directory2<>$back['directory2']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" ��ʾĿ¼'.$back['directory2'].' �޸ĳ��� '.$directory2.'',$_POST['Id']);
}
if($content<>$back['content']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" ����Ʒ����޸���',$_POST['Id']);
}
if($focus<>$back['focus']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" ����Ʒע�������޸���',$_POST['Id']);
}
if($url<>$back['url']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" �ĳ�ֵ��ַ�޸���',$_POST['Id']);
}
if($service<>$back['service']){
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ "'.$back['title'].'" �Ŀͷ�QQ�޸���',$_POST['Id']);
}

//---------�ж��Ƿ��и�����Ʒ��������з�վ���Ÿ��û�  locks ״̬Ϊ0 ���޸�
if ($title<>$ytitle){
mysql_query("insert into Goods_change set title='$title',uid='$Id',locks='0'",$conn1);
}
//---------�жϽ���

//---------------------------------------------����Ʒ���ϱ��ݿ�ʼ��
$total=mysql_num_rows(mysql_query("select * from `product_back` where pid='$_POST[Id]'",$conn1));
if($total==0){
mysql_query("insert into product_back set pid='$back[id]',sid='$back[sid]',pricing='$back[pricing]',rate='$back[rate]',locks='$back[locks]',kucun='$back[kucun]',paixu='$back[paixu]',sales='$back[sales]',overdue='$back[overdue]',title='$back[title]',color='$back[color]',directory1='$back[directory1]',directory2='$back[directory2]',directory3='$back[directory3]',directory4='$back[directory4]',punit='$back[punit]',modl='$back[modl]',buy_md='$back[buy_md]',price='$back[price]',price1='$back[price1]',price2='$back[price2]',url='$back[url]',content='$back[content]',focus='$back[focus]',service='$back[service]',username='$back[username]',reason='$back[reason]',time='$back[time]',provinces='$back[provinces]',citys='$back[citys]',Api='$back[Api]',Api_id='$back[Api_id]',Api_buy_num='$back[Api_buy_num]',Api_buy_type='$back[Api_buy_type]',state='$back[state]',whys='$back[whys]',docking='$back[docking]',uid='$back[pid]',Store_class='$back[Store_class]',begtime='$back[begtime]'",$conn1);
}else{
mysql_query("update  product_back set sid='$back[sid]',pricing='$back[pricing]',rate='$back[rate]',locks='$back[locks]',kucun='$back[kucun]',paixu='$back[paixu]',sales='$back[sales]',overdue='$back[overdue]',title='$back[title]',color='$back[color]',directory1='$back[directory1]',directory2='$back[directory2]',directory3='$back[directory3]',directory4='$back[directory4]',punit='$back[punit]',modl='$back[modl]',buy_md='$back[buy_md]',price='$back[price]',price1='$back[price1]',price2='$back[price2]',url='$back[url]',content='$back[content]',focus='$back[focus]',service='$back[service]',username='$back[username]',reason='$back[reason]',time='$back[time]',provinces='$back[provinces]',citys='$back[citys]',Api='$back[Api]',Api_id='$back[Api_id]',Api_buy_num='$back[Api_buy_num]',Api_buy_type='$back[Api_buy_type]',state='$back[state]',whys='$back[whys]',docking='$back[docking]',uid='$back[pid]',Store_class='$back[Store_class]',begtime='$back[begtime]' where pid='$_POST[Id]'",$conn1);	
}
//---------------------------------------------����Ʒ���ϱ��ݽ�����

mysql_query("update product set pricing='$pricing',rate='$rate',kucun='$kucun',title='$title',color='$color',directory1='$directory1',directory2='$directory2',directory3='$ClassID',directory4='$ClassID',punit='$punit',buy_md='$buy_md',price='$price2',price1='$price1',price2='$price2',url='$url',content='$content',focus='$focus',service='$service',time='$begtime',modl='$modl',overdue='$overdue',provinces='$province',citys='$city' where id='$_POST[Id]'",$conn1);

//-----------------------------------------------------------------------------------------------------------------------------���뿨�� ���� ѡ��
if      ($modl=='����'){
mysql_query("update cloud_key set password='$password'  where pid='$_POST[Id]'",$conn1);
}elseif ($modl=='����' || $modl=='ѡ��'){
if ($content1){
$allArray=(explode("\n", $content1));
foreach($allArray as $value){
$allArray1=(explode(' ',$value));
$card=trim($allArray1[0]);
$password=trim($allArray1[1]);
mysql_query("insert into import_goods set pid='$_POST[Id]',locks=0,card='$card',password='$password',time='$begtime'",$conn1);
}
}

}
//-------------------------------------------------------------------------------------------------------------------���뿨�� ���� ѡ�� The End


echo "<script>alert('�޸ĳɹ�!');window.location='index.php';</script>";
exit();
}

////////ɾ������¼
if ($Action=="del") {
$Id=inject_check($_GET['Id']);
//---------������Ʒ������¼ �Ա㷢��վ����
mysql_query("insert into Goods_change set uid='$Id',locks=1",$conn1);
//---------�жϽ���
//---------------------------------------------����Ʒ���ϱ��ݿ�ʼ��
$total=mysql_num_rows(mysql_query("select * from `product_back` where pid='$Id'",$conn1));
$back_result=mysql_query("select * from product  where id='$Id'",$conn1);
$back=mysql_fetch_array($back_result);
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ '.$back['title'].' ɾ����',$back['id']);
if($total==0){
mysql_query("insert into product_back set pid='$back[id]',sid='$back[sid]',pricing='$back[pricing]',rate='$back[rate]',locks='$back[locks]',kucun='$back[kucun]',paixu='$back[paixu]',sales='$back[sales]',overdue='$back[overdue]',title='$back[title]',color='$back[color]',directory1='$back[directory1]',directory2='$back[directory2]',directory3='$back[directory3]',directory4='$back[directory4]',punit='$back[punit]',modl='$back[modl]',buy_md='$back[buy_md]',price='$back[price]',price1='$back[price1]',price2='$back[price2]',url='$back[url]',content='$back[content]',focus='$back[focus]',service='$back[service]',username='$back[username]',reason='$back[reason]',time='$back[time]',provinces='$back[provinces]',citys='$back[citys]',Api='$back[Api]',Api_id='$back[Api_id]',Api_buy_num='$back[Api_buy_num]',Api_buy_type='$back[Api_buy_type]',state='$back[state]',whys='$back[whys]',docking='$back[docking]',uid='$back[pid]',Store_class='$back[Store_class]',begtime='$back[begtime]'",$conn1);
}else{
mysql_query("update  product_back set sid='$back[sid]',pricing='$back[pricing]',rate='$back[rate]',locks='$back[locks]',kucun='$back[kucun]',paixu='$back[paixu]',sales='$back[sales]',overdue='$back[overdue]',title='$back[title]',color='$back[color]',directory1='$back[directory1]',directory2='$back[directory2]',directory3='$back[directory3]',directory4='$back[directory4]',punit='$back[punit]',modl='$back[modl]',buy_md='$back[buy_md]',price='$back[price]',price1='$back[price1]',price2='$back[price2]',url='$back[url]',content='$back[content]',focus='$back[focus]',service='$back[service]',username='$back[username]',reason='$back[reason]',time='$back[time]',provinces='$back[provinces]',citys='$back[citys]',Api='$back[Api]',Api_id='$back[Api_id]',Api_buy_num='$back[Api_buy_num]',Api_buy_type='$back[Api_buy_type]',state='$back[state]',whys='$back[whys]',docking='$back[docking]',uid='$back[pid]',Store_class='$back[Store_class]',begtime='$back[begtime]' where pid='$Id'",$conn1);	
}
//---------------------------------------------����Ʒ���ϱ��ݽ�����


mysql_query("delete from product where id ='$Id'",$conn1);
echo "<script>alert('ɾ���ɹ�!');self.location=document.referrer;</script>";
}


if ($Action=='mylove'){
$ID_Dele= implode(",",$_POST['ID_Dele']);
$allArray=(explode(',',$ID_Dele));
###��Ʒ��ͣ
if ($_REQUEST['Del']=='��ͣ'){
$_SESSION['yDel']='��ͣ';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='�ƶ���Ʒ'){
$_SESSION['yDel']='�ƶ���Ʒ';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}


if ($_REQUEST['Del']=='ɾ��'){
foreach($allArray as $value){

//---------������Ʒ������¼ �Ա㷢��վ����
mysql_query("insert into Goods_change set uid='$value',locks=1",$conn1);
//---------�жϽ���

//---------------------------------------------����Ʒ���ϱ��ݿ�ʼ��
$total=mysql_num_rows(mysql_query("select * from `product_back` where pid='$value'",$conn1));
$back_result=mysql_query("select * from product  where id='$value'",$conn1);
$back=mysql_fetch_array($back_result);
ysk_date_log(5,$_SESSION['ysk_username'],'����Ʒ '.$back['title'].' ɾ����',$back['id']);
if($total==0){
mysql_query("insert into product_back set pid='$back[id]',sid='$back[sid]',pricing='$back[pricing]',rate='$back[rate]',locks='$back[locks]',kucun='$back[kucun]',paixu='$back[paixu]',sales='$back[sales]',overdue='$back[overdue]',title='$back[title]',color='$back[color]',directory1='$back[directory1]',directory2='$back[directory2]',directory3='$back[directory3]',directory4='$back[directory4]',punit='$back[punit]',modl='$back[modl]',buy_md='$back[buy_md]',price='$back[price]',price1='$back[price1]',price2='$back[price2]',url='$back[url]',content='$back[content]',focus='$back[focus]',service='$back[service]',username='$back[username]',reason='$back[reason]',time='$back[time]',provinces='$back[provinces]',citys='$back[citys]',Api='$back[Api]',Api_id='$back[Api_id]',Api_buy_num='$back[Api_buy_num]',Api_buy_type='$back[Api_buy_type]',state='$back[state]',whys='$back[whys]',docking='$back[docking]',uid='$back[pid]',Store_class='$back[Store_class]',begtime='$back[begtime]'",$conn1);
}else{
mysql_query("update  product_back set sid='$back[sid]',pricing='$back[pricing]',rate='$back[rate]',locks='$back[locks]',kucun='$back[kucun]',paixu='$back[paixu]',sales='$back[sales]',overdue='$back[overdue]',title='$back[title]',color='$back[color]',directory1='$back[directory1]',directory2='$back[directory2]',directory3='$back[directory3]',directory4='$back[directory4]',punit='$back[punit]',modl='$back[modl]',buy_md='$back[buy_md]',price='$back[price]',price1='$back[price1]',price2='$back[price2]',url='$back[url]',content='$back[content]',focus='$back[focus]',service='$back[service]',username='$back[username]',reason='$back[reason]',time='$back[time]',provinces='$back[provinces]',citys='$back[citys]',Api='$back[Api]',Api_id='$back[Api_id]',Api_buy_num='$back[Api_buy_num]',Api_buy_type='$back[Api_buy_type]',state='$back[state]',whys='$back[whys]',docking='$back[docking]',uid='$back[pid]',Store_class='$back[Store_class]',begtime='$back[begtime]' where pid='$value'",$conn1);	
}
//---------------------------------------------����Ʒ���ϱ��ݽ�����

mysql_query("delete from product where id ='$value'",$conn1);
}
echo "<script>alert('ɾ���ɹ�!');;self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='����'){
foreach($allArray as $value){
$hsql=mysql_query("select * from product where id='$value'",$conn1);
$hi=mysql_fetch_array($hsql);
ysk_date_log(5,$_SESSION['ysk_username'],'�� "'.$hi['title'].'" ��Ʒ״̬�ĳ����� ');		
mysql_query("update product set state='0',reason='' where id=$value",$conn1);}
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='ͨ��'){
foreach($allArray as $value){
$hsql=mysql_query("select * from product where id='$value'",$conn1);
$hi=mysql_fetch_array($hsql);
ysk_date_log(5,$_SESSION['ysk_username'],'�� "'.$hi['title'].'" ��Ʒ���ͨ�� ');	
mysql_query("update product set locks='2'  where id=$value",$conn1);}
echo "<script>alert('�ύ�ɹ�!');self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='���'){
$_SESSION['yDel']='���';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}


if ($_REQUEST['Del']=='����'){
$hsql=mysql_query("select * from product where id='$value'",$conn1);
$hi=mysql_fetch_array($hsql);
ysk_date_log(5,$_SESSION['ysk_username'],'�� "'.$hi['title'].'" ��Ʒ״̬�ĳɽ����� ');	
foreach($allArray as $value){mysql_query("update product set state='2'   where id=$value",$conn1);}
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
}

if ($_REQUEST['Del']=='�¼�'){
foreach($allArray as $value){
$hsql=mysql_query("select * from product where id='$value'",$conn1);
$hi=mysql_fetch_array($hsql);
ysk_date_log(5,$_SESSION['ysk_username'],'�� "'.$hi['title'].'" ��Ʒ״̬�ĳ��¼��� ');	
mysql_query("update product set state='4'   where id='$value'",$conn1);}
echo "<script>alert('�ύ�ɹ�!');;self.location=document.referrer;</script>";
}

###��Ʒ�������۸�
if ($_REQUEST['Del']=='��������'){
$_SESSION['yDel']='��������';  
$_SESSION['ID_Dele']=$ID_Dele;  
$_SESSION['allArray']=$allArray;  
echo "<script>self.location=document.referrer;</script>";
}


}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?=$site_name?></title>
<link href="../images/index.css" rel="stylesheet" type="text/css" />
<link href="/Public/images/page.css" rel="stylesheet" type="text/css" />
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
<script language="javascript">
function chg(obj)
{
if(obj.options[obj.selectedIndex].value =="-1")
document.getElementById("overday").style.display="";
else
document.getElementById("overday").style.display="none";
}
</script>
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
<script language="javascript" type="text/javascript" src="/Public/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="/Public/js/city.js"></script>
<?php      if($_SESSION['yDel']=='��ͣ'){?>
<script language="javascript">
$(window).load(function(){
art.dialog.open('product/deal_with.php?Action=stop&isno=<?=$_SESSION['allArray']?>',{lock:true,fixed:true,title:'��ͣ',width:500,height:180});
});
</script>
<?php }elseif($_SESSION['yDel']=='���'){?>
<script language="javascript">
$(window).load(function(){
art.dialog.open('product/deal_with.php?Action=no&isno=<?=$_SESSION['allArray']?>',{lock:true,fixed:true,title:'���',width:500,height:180});
});
</script>
<?php }elseif($_SESSION['yDel']=='�ƶ���Ʒ'){?>
<script language="javascript">
$(window).load(function(){
art.dialog.open('product/deal_with.php?Action=move&isno=<?=$_SESSION['allArray']?>',{lock:true,fixed:true,title:'���',width:500,height:180});
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
<body onload = "MyTest()">
<?php if ($Action==""){?>
<div class="right">

<form action="index.php" method="get">
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
<option value="username">�����̱��</option>
</select>
<select name="template" id="template">
<option selected="selected" value="">ȫ������</option>
<option value="����">����</option>
<option value="����">����</option>
<option value="ѡ��">ѡ��</option>
<option value="�˹�����">�˹�����</option>
</select>
<select name="status" id="status">
<option selected="selected" value="">ȫ��״̬</option>
<option value="0">����</option>
<option value="1">��ͣ</option>
<option value="2">����</option>
</select></td>
</tr>
<tr>
<td height="32" class="td_left">
��ѯʱ��Σ�</td>
<td class="left"><?php include_once('../../jhs_config/time.php');?></td>
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
<table cellspacing="1" cellpadding="0" class="table4" style=" margin-top:10px;">
<tr>
<td width="5%" height="32" align="center" class="table_top">ѡ��</td>
<td width="5%" height="32" align="center" class="table_top">���</td>
<td width="36%" align="center" class="table_top">��Ʒ����</td>
<td width="8%" align="center" class="table_top">�����̱��</td>
<td width="7%" align="center" class="table_top"> ����/ģ�� </td>
<td width="7%" align="center" class="table_top"> ��ֵ </td>
<td width="6%" align="center" class="table_top">״̬</td>
<td width="8%" align="center" class="table_top">����</td>
<td width="12%" align="center" class="table_top">����ʱ��</td>
<td width="6%" align="center" class="table_top">����</td>
</tr>
<?php
$total=mysql_num_rows(mysql_query("select * from `product`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from product  $search order by paixu asc,id desc,begtime desc {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
#######��ȡ�ʼID
$result1=mysql_query("select * from product  $search order by paixu asc,begtime desc limit 1",$conn1);
$row1=mysql_fetch_array($result1);
#######��ȡ���ID
$result2=mysql_query("select * from product  $search order by paixu desc,begtime desc limit 1",$conn1);
$row2=mysql_fetch_array($result2);

while ($row=mysql_fetch_array($zyc)){
?>

<tr bgcolor="ffffff" onMouseOut="this.style.backgroundColor=''" onMouseOver="this.style.backgroundColor='#F5F5F5'">
<td height="24" align="center" ><span group="1"><input name="ID_Dele[]" type="checkbox" id="ID_Dele[]" value="<?=$row[id]?>"></span></td>
<td align="center"><?=$row[id]?></td>
<td align="left" style=" text-align:left; line-height:200%;">
<?=$row['title']?>
<?php if ($row['directory3']!='' && $row['username']!=''){?>
<br><span style="color:#F00"><?=yx_product_class($row['directory3'])?></span> <?php } ?></td>
<td align="center"><?=$row['username']?></td>
<td align="center" style="color:#0000ff">
<?php if ($row['modl']=='����' || $row['modl']=='ѡ��'){?>
<a href="import.php?id=<?=$row['id']?>" style="color:#0000ff"><?=$row['modl']?>(����)</a>
<?php }else{?>
<?=$row['modl']?>
<?php }?>
</td>
<td align="center"><?=$row['price1']?></td>
<td align="center"><?=ysk_state($row['state'])?></td>
<td align="center">
<div class="dirction">
<?=sorting('top',$row1['id'],$row['id'],1,1)?>
<?=sorting('up',$row1['id'],$row['id'],1,1)?>
<?=sorting('down',$row2['id'],$row['id'],1,1)?>
<?=sorting('bottom',$row2['id'],$row['id'],1,1)?>
</div></td>
<td align="center"><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td align="center"><a href="?Action=edit&Id=<?=$row[id]?>">�޸�</a> <a href="?Action=del&Id=<?=$row['id']?>" onClick="Javascript:return confirm('ȷ��Ҫɾ����');">ɾ��</a> </td>
</tr><?php
}
?>

</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td  align="left" style="padding-top:15px; padding-bottom:15px;">

<input type="button" value="ȫѡ" onClick="CheckAll()" class="x_input">
<input type="submit" name="Del" id="Del" value="ɾ��" class="x3_input" onClick="Javascript:return confirm('ȷ��Ҫɾ����');" >
<input type="submit" name="Del" id="Del" value="��������" class="x4_input" onClick="Javascript:return confirm('ȷ��Ҫ���¶�����');" >
<input type="submit" name="Del" value="�ƶ���Ʒ"  onclick="return CheckSelect();" id="Del" class="x6_input">
<input type="submit" name="Del" id="Del" value="����"  onclick="return CheckSelect();" class="x2_input">
<input type="submit" name="Del" id="Del" value="��ͣ"  onclick="return CheckSelect();" class="x2_input">
<input type="submit" name="Del" id="Del" value="����"  onclick="return CheckSelect();" class="x2_input">
<input type="submit" name="Del" id="Del" value="�¼�"  onclick="return CheckSelect();" class="x2_input">

<?php if ($locks!='') {?>
<input type="submit" name="Del" id="Del" value="ͨ��" class="x4_input">
<input type="submit" name="Del" id="Del" value="���" class="x4_input">
<?php } ?>
</td>
<td  align="left" style="padding-top:15px; padding-bottom:15px;"><?php if ($total!=0){?><?=$page->paging();?><?php }?></td>
</tr>
</table>
</form>
</div>

<?php }elseif($Action=="add"){  ?>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.add.title.value)) {
document.add.title.focus();
alert("����ʧ�ܣ���Ʒ���Ʋ���Ϊ�գ�");
return false;
}   

if(checkspace(document.add.kucun.value)) {
document.add.kucun.focus();
alert("����ʧ�ܣ���治��Ϊ�գ�");
return false;
}

if(checkspace(document.add.punit.value)) {
document.add.punit.focus();
alert("����ʧ�ܣ���Ʒ��λ����Ϊ�գ�");
return false;
}

if(checkspace(document.add.price1.value)) {
document.add.price1.focus();
alert("����ʧ�ܣ���Ʒ��ֵ����Ϊ�գ�");
return false;
}


if(checkspace(document.add.price2.value)) {
document.add.price2.focus();
alert("����ʧ�ܣ������۸���Ϊ�գ�");
return false;
}

if(checkspace(document.add.rate.value)) {
document.add.rate.focus();
alert("����ʧ�ܣ��ۼ۲���Ϊ�գ�");
return false;
}

if(checkspace(document.add.modl.value)) {
document.add.modl.focus();
alert("����ʧ�ܣ���ֵģ�治��Ϊ�գ�");
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
<form name="add" method="post" action="?Action=add1" >
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��Ϣ���</td>
</tr>
<tr>
<td class="td_left">�������ޣ�</td>
<td class="left"><div style="float:left;"><select  name="overdue" id="overdue" onChange="chg(this)">
<option value="7">7��</option>
<option value="15">15��</option>
<option value="26">26��</option>
<option value="30">30��</option>
<option value="45">45��</option>
<option value="60">60��</option>
<option value="0" selected="selected">����</option>
<option value="-1">����</option>
</select>
</div><div id="overday" style="float:left; padding-left:10px;display:none">
<input id="overday" name="overday" style="width:30px;" value=""   onkeyup="value=value.replace(/[^\d]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" > ��</div> �����磺QQ��Աһ���£�����Ʒʱ��Ϊ��30�죩

</td>
</tr>


<tr>
<td width="10%" class="td_left"> ��Ʒ���ƣ�</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="" class="biankuan" /> <input name="color" type="text" id="color" value="" size="7" class="biankuan" /> 
<input type="button" id="colorpicker" value="��ȡɫ��" class="tijiao_input"/></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��������</td>
<td width="90%" class="left" style="color:#999999">
<select id="province" name="province" onchange = "test()">
<option value="ȫ��" selected="selected">--ȫ������--</option>
</select>
&nbsp;
<select id="city" name="city">
<option value="" selected="selected">--����--</option>
</select>
ȷ���󲻿��޸ģ���ע��ѡ�� </td>
</tr>
<tr>
<td width="10%" class="td_left"> ��Ʒ��棺</td>
<td width="90%" class="left"><input name="kucun" type="text" value="0" style="width:60px;"class="biankuan"  onkeyup="clearNoNum(this)"/></td>
</tr>

<tr>
<td width="10%" class="td_left"> ��Ʒ��λ��</td>
<td width="90%" class="left"><input name="punit" type="text" class="biankuan" value="��"  id="punit" style="width:60px;" value="" /></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��Ʒ��ֵ��</td>
<td width="90%" class="left"><input name="price1" type="text" style="width:60px;"  value="1000"  class="biankuan"  onkeyup="clearNoNum(this)"/></td>
</tr>
<tr>
<td width="10%" class="td_left">�����۸�</td>
<td width="90%" class="left" style="color:#666"><input name="price2" type="text"  value="0" style="width:60px;"  onkeyup="clearNoNum(this)"/> <select name="pricing" id="pricing">
<option value="1">�����Ӱٷֱ�</option>
<option value="2">�����ӹ̶�ֵ</option>
</select>
<input name="rate" type="text" style="width:60px;" value="0" onKeyUp="clearNoNum(this)"/>
<div style="padding-top:6px;">
��������۸�100 ���ٷֱ����� ����д�� 1��ʱ�� ����1% Ҳ����ÿ������1Ԫ��
 �����������100 ���̶�ֵ���� ����д1��ʱ�����1Ԫ��Ҳ����ÿ������1Ԫ��</div></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��ֵ���ͣ�</td>
<td width="90%" class="left">
<select name="modl" id="modl">
<option value="" selected>��ѡ�����...</option>
<option value="����">����</option>
<option value="����">����</option>
<option value="ѡ��">ѡ��</option>
<option value="�˹�����">�˹�����</option>
</select></td>
</tr>

<tr>
<td width="10%" class="td_left">��Ϣ���ࣺ</td>
<td width="90%" class="left"><div style="width: 350px; height:200px; overflow: auto; border:1px #CCC solid; padding:4px;">
<?php
$presult=mysql_query("select * from  product_class  where LagID=1 and isno3=0 order by Classorder asc,id desc",$conn1);
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

<td class="td_left">
��Ʒ��飺</td>
<td class="left">
<textarea name="content" rows="2" cols="20" id="content" class="biankuan" style="width: 350px; height: 100px"  placeholder="��Ʒ��ϸ����"></textarea></td>
</tr>
<tr>
<td class="td_left">
ע�����</td>
<td class="left">
<textarea name="focus" rows="2" cols="20" id="focus" class="biankuan" style="width: 350px; height: 100px" placeholder="�ͻ�����ʱ����ڵ�һ����ʾ���ɲ��"></textarea>          </td>
</tr>
<tr>
<td width="10%" class="td_left"> ��ֵ��ַ��</td>
<td width="90%" class="left"><input name="url" type="text" style="width:350px;" value="" class="biankuan"  placeholder="�俨����ַ���ǿ�������Ʒ�ɲ���" /> </td>
</tr>
<tr>
<td width="10%" class="td_left"> �ͷ�QQ��</td>
<td width="90%" class="left"  style="color:#666"><input name="service" type="text" style="width:350px;" value="" class="biankuan"  placeholder="������QQ����" /> 
  ����м���|����</td>
</tr>

<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ�����"  id="btnSubmit" class="tijiao_input"   onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="add1"){
$modl=$_POST['modl'];
$ClassID=implode(",",$_POST['ClassID']);
if ($_POST['ClassID']==''){echo "<script>alert('�Բ�����û��ѡ�񷢲�����Ŀ��');self.location=document.referrer;</script>";exit();}

?>

<form name="add" method="post" action="?Action=addsave" >
<input name="overdue" type="hidden" value="<?=$_POST['overdue']?>">
<input name="overday" type="hidden" value="<?=$_POST['overday']?>">
<input name="title" type="hidden" value="<?=$_POST['title']?>">
<input name="color" type="hidden" value="<?=$_POST['color']?>">
<input name="province" type="hidden" value="<?=$_POST['province']?>">
<input name="city" type="hidden" value="<?=$_POST['city']?>">
<input name="kucun" type="hidden" value="<?=$_POST['kucun']?>">
<input name="punit" type="hidden" value="<?=$_POST['punit']?>">
<input name="price1" type="hidden" value="<?=$_POST['price1']?>">
<input name="price2" type="hidden" value="<?=$_POST['price2']?>">
<input name="pricing" type="hidden" value="<?=$_POST['pricing']?>">
<input name="rate" type="hidden" value="<?=$_POST['rate']?>">
<input name="modl" type="hidden" value="<?=$_POST['modl']?>">
<input name="ClassID" type="hidden" value="<?=$ClassID?>">
<input name="content" type="hidden" value="<?=$_POST['content']?>">
<input name="focus" type="hidden" value="<?=$_POST['focus']?>">
<input name="url" type="hidden" value="<?=$_POST['url']?>">
<input name="service" type="hidden" value="<?=$_POST['service']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��ֵģ��</td>
</tr>
<?php if ($modl=='����'){?>
<tr>
<td width="10%" class="td_left">�������룺</td>
<td width="90%" class="left"><input name="password" type="text" style="width:350px;" value="" class="biankuan" /></td>
</tr>
<?php }elseif ($modl=='����'){?>
<tr>
<td width="10%" class="td_left">���뿨�ܣ�</td>
<td width="90%" class="left"><textarea name="content1" cols="70" rows="6" class="biankuan" id="content1"></textarea>
��ʽΪ �˻� ����<font color="#FF0000">��ע���˻������м��и��ո�</font> һ��һ��</td>
</tr>
<?php }elseif ($modl=='ѡ��'){?>
<tr>
<td width="10%" class="td_left">���뿨�ţ�</td>
<td width="90%" class="left"><textarea name="content1" cols="70" rows="6" class="biankuan" id="content1"></textarea>
��ʽΪ �˻� ����<font color="#FF0000">��ע���˻������м��и��ո�</font> һ��һ��</td>
</tr>
<?php }elseif ($modl=='�˹�����'){?>
<tr>
<td width="10%" class="td_left">��ֵģ�壺</td>
<td width="90%" class="left"><select name="buy_md" id="buy_md">
<?php
$resultm=mysql_query("select * from  buy_modl  order by time desc,id desc  ",$conn1);
while($modl=mysql_fetch_array($resultm)){ ?>
<option value="<?=$modl['id']?>"><?=$modl['title']?></option>
<?php } ?>
</select></td>
</tr>
<?php }?>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input"   onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
<?php }elseif($Action=="edit"){
$Id=inject_check($_GET['Id']);
$result=mysql_query("select * from product where id='$Id' and sid=0 and pid=0",$conn1);
$row=mysql_fetch_array($result);
############################################################��ȫ��֤
if ($row['id']==''){
echo "<br><br><br><br><br><br><br><br><br><br><br><br><center>����ʧ�ܣ�û���ҵ�����Ʒ!";
exit();
}
############################################################��ȫ��֤ The End
?>
<div class="right">
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo()
{

if(checkspace(document.add.title.value)) {
document.add.title.focus();
alert("�Բ�����Ʒ���Ʋ���Ϊ�գ�");
return false;
}   

if(checkspace(document.add.kucun.value)) {
document.add.kucun.focus();
alert("�Բ��𣬿�治��Ϊ�գ�");
return false;
}

if(checkspace(document.add.punit.value)) {
document.add.punit.focus();
alert("�Բ�����Ʒ��λ����Ϊ�գ�");
return false;
}

if(checkspace(document.add.price1.value)) {
document.add.price1.focus();
alert("�Բ�����Ʒ��ֵ����Ϊ�գ�");
return false;
}


if(checkspace(document.add.price2.value)) {
document.add.price2.focus();
alert("�Բ�����Ʒ�ۼ۲���Ϊ�գ�");
return false;
}

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
<form name="add" method="post" action="?Action=edit_next" >
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input name="ytitle" type="hidden" value="<?=$row['title']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��Ϣ�޸�</td>
</tr>
<tr>
<td class="td_left">�������ޣ�</td>
<td class="left">
<div style="float:left;"><select  name="overdue" id="overdue" onChange="chg(this)">
<option value="7"  <?php if ($row['overdue']==7){?> selected="selected"<?php } ?>>7��</option>
<option value="15" <?php if ($row['overdue']==15){?> selected="selected"<?php } ?>>15��</option>
<option value="26" <?php if ($row['overdue']==26){?> selected="selected"<?php } ?>>26��</option>
<option value="30" <?php if ($row['overdue']==30){?> selected="selected"<?php } ?>>30��</option>
<option value="45" <?php if ($row['overdue']==45){?> selected="selected"<?php } ?>>45��</option>
<option value="60" <?php if ($row['overdue']==60){?> selected="selected"<?php } ?>>60��</option>
<option value="0"  <?php if ($row['overdue']==0){?> selected="selected"<?php } ?>>����</option>
<option value="-1" <?php if ($row['overdue']!=0 && $row['overdue']!=7 && $row['overdue']!=15 && $row['overdue']!=26 && $row['overdue']!=30 && $row['overdue']!=45 && $row['overdue']!=60){?> selected="selected"<?php } ?>>����</option>
</select>
</div>
<div id="overday" style="float:left; padding-left:10px;display:none">

<input id="overday" name="overday" style="width:30px;" value="<?=$row['overdue']?>"   onkeyup="value=value.replace(/[^\d]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" > ��</div> �����磺QQ��Աһ���£�����Ʒʱ��Ϊ��30�죩


</td>
</tr>


<tr>
<td width="10%" class="td_left"> ��Ʒ���ƣ�</td>
<td width="90%" class="left"><input name="title" type="text" style="width:350px;" value="<?=$row['title']?>" class="biankuan" /> 
<input name="color" type="text" id="color" value="<?=$row['color']?>" size="7" class="biankuan" /> 
<input type="button" id="colorpicker" value="��ȡɫ��" class="tijiao_input"/></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��������</td>
<td width="90%" class="left" style="color:#999999">
<select id="province" name="province" onchange = "test()">
<option value="ȫ��">ȫ������</option>
<option value="<?=$row['provinces']?>" selected="selected"><?=$row['provinces']?></option>
</select>
&nbsp;
<select id="city" name="city">
<option value="<?=$row['citys']?>" selected="selected"><?=$row['citys']?></option>
</select></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��Ʒ��棺</td>
<td width="90%" class="left"><input name="kucun" type="text" style="width:60px;"class="biankuan"  onkeyup="clearNoNum(this)" value="<?=$row['kucun']?>" /></td>
</tr>

<tr>
<td width="10%" class="td_left"> ��Ʒ��λ��</td>
<td width="90%" class="left"><input name="punit" type="text" class="biankuan" id="punit" style="width:60px;" value="<?=$row['punit']?>" /></td>
</tr>
<tr>
<td width="10%" class="td_left"> ��Ʒ��ֵ��</td>
<td width="90%" class="left"><input name="price1" type="text" style="width:60px;" value="<?=$row['price1']?>" class="biankuan" onKeyUp="clearNoNum(this)"/></td>
</tr>
<tr>
<td width="10%" class="td_left">�����۸�</td>
<td width="90%" class="left" style="color:#666"><input name="price2" type="text" style="width:60px;"  value="<?=$row['price2']?>" onKeyUp="clearNoNum(this)"/> <select name="pricing" id="pricing">
<option value="1" <?php if ($row['pricing']==1) {?> selected<?php } ?>>�����Ӱٷֱ�</option>
<option value="2" <?php if ($row['pricing']==2) {?> selected<?php } ?>>�����ӹ̶�ֵ</option>
</select>
<input name="rate" type="text" style="width:60px;" onKeyUp="clearNoNum(this)" value="<?=$row['rate']?>"/>  
<div style="padding-top:6px;">
��������۸�100 ���ٷֱ����� ����д�� 1��ʱ�� ����1% Ҳ����ÿ������1Ԫ��
 �����������100 ���̶�ֵ���� ����д1��ʱ�����1Ԫ��Ҳ����ÿ������1Ԫ��</div>
 </td>
</tr>


<tr>
<td width="10%" class="td_left">��Ϣ���ࣺ</td>
<td width="90%" class="left"><select name="ClassID" id="ClassID">
<?php
$results=mysql_query("select * from product_class where LagID=2 order by id desc",$conn1);
while($type=mysql_fetch_array($results)){?>
<option value="<?=$type['NumberID']?>" <?php if($type['NumberID']==$row['directory3']){ ?> selected="selected"<?php }?>><?=$type['7']?></option>
<?php } ?>
</select>


</td>
</tr>
<tr>
<td width="10%" class="td_left"> ��ֵ���ͣ�</td>
<td width="90%" class="left">
<select name="modl" id="modl">
<option value="" selected>��ѡ�����...</option>
<option value="����" <?php if ($row['modl']=='����') {?> selected<?php } ?>>����</option>
<option value="����" <?php if ($row['modl']=='����') {?> selected<?php } ?>>����</option>
<option value="ѡ��" <?php if ($row['modl']=='ѡ��') {?> selected<?php } ?>>ѡ��</option>
<option value="�˹�����" <?php if ($row['modl']=='�˹�����') {?> selected<?php } ?>>�˹�����</option>
</select>
</td>
</tr>
<tr>
<td class="td_left">
��Ʒ��飺</td>
<td class="left">
<textarea name="content" rows="2" cols="20" id="content" class="biankuan" style="width: 350px; height: 100px"  placeholder="��Ʒ��ϸ����">
<?=$row['content']?>
</textarea></td>
</tr>
<tr>
<td class="td_left">
ע�����</td>
<td class="left">
<textarea name="focus" rows="2" cols="20" id="focus" class="biankuan" style="width: 350px; height: 100px" placeholder="�ͻ�����ʱ����ڵ�һ����ʾ���ɲ��"><?=$row['focus']?></textarea>          </td>
</tr>
<tr>
<td width="10%" class="td_left"> ��ֵ��ַ��</td>
<td width="90%" class="left"><input name="url" type="text" style="width:350px;" value="<?=$row['url']?>" class="biankuan"  placeholder="�俨����ַ���ǿ�������Ʒ�ɲ���" /> </td>
</tr>
<tr>
<td width="10%" class="td_left"> �ͷ�QQ��</td>
<td width="90%" class="left"  style="color:#666"><input name="service" type="text" style="width:350px;" value="<?=$row['service']?>" class="biankuan"  placeholder="������QQ����" /> 
  ����м���|����</td>
</tr>


<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���޸�"  id="btnSubmit" class="tijiao_input"   onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
</div>

<?php }elseif($Action=="edit_next"){
if ($_REQUEST['Id']){
$_SESSION['lid']=$_REQUEST['Id'];
}
$result=mysql_query("select * from product where id='$_SESSION[lid]'",$conn1);
$row=mysql_fetch_array($result);
?>

<form name="add" method="post" action="?Action=editsave">
<input id="Id" name="Id" type="hidden" value="<?=$row['id']?>">
<input name="title" type="hidden" value="<?=$_POST['title']?>">
<input name="ytitle" type="hidden" value="<?=$_POST['ytitle']?>">
<input name="color" type="hidden" value="<?=$_POST['color']?>">
<input name="kucun" type="hidden" value="<?=$_POST['kucun']?>">
<input name="punit" type="hidden" value="<?=$_POST['punit']?>">
<input name="price1" type="hidden" value="<?=$_POST['price1']?>">
<input name="price2" type="hidden" value="<?=$_POST['price2']?>">
<input name="pricing" type="hidden" value="<?=$_POST['pricing']?>">
<input name="rate" type="hidden" value="<?=$_POST['rate']?>">
<input name="modl" type="hidden" value="<?=$_POST['modl']?>">
<input name="ClassID" type="hidden" value="<?=$_POST['ClassID']?>">
<input name="content" type="hidden" value="<?=$_POST['content']?>">
<input name="focus" type="hidden" value="<?=$_POST['focus']?>">
<input name="url" type="hidden" value="<?=$_POST['url']?>">
<input name="service" type="hidden" value="<?=$_POST['service']?>">
<input name="overdue" type="hidden" value="<?=$_POST['overdue']?>">
<input name="overday" type="hidden" value="<?=$_POST['overday']?>">
<input name="province" type="hidden" value="<?=$_POST['province']?>">
<input name="city" type="hidden" value="<?=$_POST['city']?>">
<table class="page_table4" cellpadding="0" cellspacing="1">
<tr>
<td colspan="2" class="table_top" style="text-align: left;">��ֵģ��</td>
</tr>
<?php if($_POST['modl']=='����' || $_POST['modl']=='ѡ��'){?>
<tr>
<td width="10%" class="td_left"><?=$_POST['modl']?>�鿴��</td>
<td width="90%" class="left"><a  href="#art1" onClick="art.dialog.open('user/Product/view.php?id=<?=$row['id']?>&ooxx=1', {title:'<?=$row['modl']?>��ϸ��Ϣ',width:600,height:400,lock:true, fixed:true});">�鿴</a></td>
</tr>
<?php } ?>
<?php if ($_POST['modl']=='����'){
$k_result=mysql_query("select * from cloud_key  where  pid='$row[id]' ",$conn1);
$yx_k=mysql_fetch_array($k_result)
?>
<tr>
<td width="10%" class="td_left">�������룺</td>
<td width="90%" class="left"><input name="password" type="text" style="width:350px;" value="<?=$yx_k['password']?>" class="biankuan" /></td>
</tr>


<?php }elseif($_POST['modl']=='����'){?>
<tr>
<td width="10%" class="td_left">���뿨�ܣ�</td>
<td width="90%" class="left"><textarea name="content1" cols="70" rows="6" class="biankuan" id="content1"></textarea>
��ʽΪ �˻� ����<font color="#FF0000">��ע���˻������м��и��ո�</font> һ��һ��</td>
</tr>
<?php }elseif($_POST['modl']=='ѡ��'){?>
<tr>
<td width="10%" class="td_left">���뿨�ţ�</td>
<td width="90%" class="left"><textarea name="content1" cols="70" rows="6" class="biankuan" id="content1"></textarea>
��ʽΪ �˻� ����<font color="#FF0000">��ע���˻������м��и��ո�</font> һ��һ��</td>
</tr>
<?php }elseif ($_POST['modl']=='�˹�����'){?>
<tr>
<td width="10%" class="td_left">��ֵģ�壺</td>
<td width="90%" class="left"><select name="buy_md" id="buy_md">
<?php
$resultm=mysql_query("select * from  buy_modl  order by time desc,id desc  ",$conn1);
while($modl=mysql_fetch_array($resultm)){ ?>
<option value="<?=$modl['id']?>" <?php if ($row['buy_md']==$modl['id']){?> selected<?php } ?>><?=$modl['title']?></option>
<?php } ?>
</select></td>
</tr>
<?php }?>
<tr>
<td>
</td>
<td>
<input type="submit" name="btnSubmit" value="ȷ���ύ"  id="btnSubmit" class="tijiao_input"   onClick="return checkuserinfo();" />
</td>
</tr>
</table>
</form>
<?php }?>
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