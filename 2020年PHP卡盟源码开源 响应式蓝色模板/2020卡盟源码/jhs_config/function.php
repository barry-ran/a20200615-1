
<?php
session_start();
include_once('conn.php');
include_once('520sfconn.php');
include_once('config.php');
include_once('yx_safe.php');
date_default_timezone_set('PRC');        ######����ʱ��Ϊ����ʱ��
$mytime=date("Y-m-d G:i:s");
$begtime=strtotime(date("Y-m-d G:i:s"));

////////////////////////////��ȡ����IP��ַ
function Local_Ip() {  
if($_SERVER['HTTP_CLIENT_IP']){  
$LocalIp=$_SERVER['HTTP_CLIENT_IP'];  
}elseif($_SERVER['HTTP_X_FORWARDED_FOR']){  
$LocalIp=$_SERVER['HTTP_X_FORWARDED_FOR'];  
}else{  
$LocalIp=$_SERVER['REMOTE_ADDR'];  
}  
return $LocalIp;  
}  
////////////////////////////��ȡ����IP��ַ The End


if (strtotime($Exp_time)-$begtime=0) {
header('location:/404.php?error=401');
}elseif($Exp_sup_open=='1'){ 
header('location:/404.php?error=409');
}


function cnsubstr($str,$start,$len) { 
$strlen=$start+$len; 
for($i=0;$i<$strlen;$i++) { 
if(ord(substr($str,$i,1))>0xa0) { 
$tmpstr.=substr($str,$i,2); 
$i++; 
} 
else 
$tmpstr.=substr($str,$i,1); 
} 
return $tmpstr; 
} 
$dingdanhao = date("Y-m-dH-i-s");
$dingdanhao = str_replace("-","",$dingdanhao);
$dingdanhao .= rand(1000,2000);

function shanchu($str){
$str = trim($str);
$str = preg_replace('/\n/', '', $str);
$str = preg_replace('/\r/', '', $str);
return $str;
}

//������֤���������������ʽ
function gtel($gtel){
$check="/^(\d{3}-)(\d{8})$|^(\d{4}-)(\d{7})$|^(\d{4}-)(\d{8})$/";   
$bool=preg_match($check,$gtel,$counts); 
return $bool;
}

//������֤�ֻ������������ʽ
function mtel($mtel){
$check="/^13(\d{9})$|^15(\d{9})$|^189(\d{8})$/";        
$bool=preg_match($check,$mtel,$counts);    
return $bool;
}

//������֤email��������ʽ
function email($email){
$check="/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";    
$bool=preg_match($check,$email,$counts);
return $bool;
}



########################################### �Զ����ȡ��Ӱ����
function yx_product_class($val){
global $conn1;
$mysql=mysql_query("select * from `product_class`  where NumberID='$val'",$conn1);
$row=mysql_fetch_array($mysql);
if  ($row['NumberID']!=''){
echo $row['7'];
}else{
}
}

function ysk_network($var){
$url='http://www.ip138.com/ips138.asp?ip='.$var.'&action=2';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec($ch);
curl_close($ch);
preg_match('/��վ�����ݣ�(?<mess>(.*))��(.*)<\/li><li>/',$content,$arr);
if(strripos($arr['mess'],"ʡ")>0)
return substr($arr['mess'],strripos($arr['mess'],"ʡ")+2,100);
else
return $arr['mess'];
}
#########################################################################��Ʒ�Զ�������

##########################��Ʒʱ��
function ysk_overdue($var){
switch ($var) { 
case   "0": 
return $result="����"; 
break; 
default: 
return $result=$var." ��"; 
break; 
}
}

##########################���� �����˿�
function Ysk_Single_back($var,$var1,$var2,$var3){    //����ʱ��  ��������  �˵����� ������� 
if ($var==0){
///////////////////////////////////��������Ʒ��ȫ��
$price=$var3;
}else{
$time=$var2-$var1;
$days=$var-($time/86400); 
$price=($var3/$var)*$days;
if ($price>$var3){
$price=$var3;
}else{
$price=$price;
}

}
return $price;
}
##########################���� �����˿�����
function Ysk_Single_days($var,$var1,$var2){    //����ʱ��  ��ǰ����  �˵����� 
if ($var==0){
$days=999;
}else{
$time=$var2-$var1;
$days=$var-($time/86400); 
}
return $days;
}
##########################��Ʒ״̬
function ysk_state($var){
switch ($var) { 
case   "1": 
return $result="<font color=\"#1d1dff\">��ͣ</font>"; 
break; 
case   "2": 
return $result="<font color=\"red\">����</font>"; 
break;
case   "3": 
return $result="<font color=\"#009900\">����</font>"; 
break; 
case   "4": 
return $result="<font color=\"#666\" style=\"TEXT-DECORATION: line-through\">���¼�</font>"; 
break; 
case   "-1": 
return $result="<font color=\"#009900\">SUP��Ʒ���۵���</font>"; 
break; 
case   "-2": 
return $result="<font color=\"#009900\">SUP��Ʒ���۵���</font>"; 
break; 
case   "-3": 
return $result="<font color=\"#009900\">������Ϊ������</font>"; 
break; 
case   "-4": 
return $result="<font color=\"#009900\">SUP��Ʒδ�ϼ�</font>"; 
break; 
case   "-5": 
return $result="<font color=\"#009900\">SUP��Ʒδͨ�����</font>"; 
break;
case   "-6": 
return $result="<font color=\"#009900\">SUP��ƷΪ������</font>"; 
break; 
case   "-7": 
return $result="<font color=\"#009900\">SUP��Ʒ��ɾ��</font>"; 
break; 
default: 
return $result="<font color=\"#009900\">����</font>"; 
break; 
}
}

##########################��Ʒ����
function ysk_locks($var,$var1){
switch ($var) { 
case   "0": 
return $result="<font color=\"#1d1dff\">�����</font> - "; 
break; 
case   "1": 
return $result="<font color=\"red\">���ʧ��</font> - ԭ��".$var1." - "; 
break;
default: 
return $result="<font color=\"#009900\">�����</font> - "; 
break; 
}
}


##��Ʒ����
class area{
function region($var,$var1){
if ($var=='ȫ��'){
return "ȫ��";	
}else{
return	$var.'-'.$var1;
}
}
}

//�������
function youxi_gg_url($id){
global $conn1;
$result=mysql_query("select * from advertising where id='$id'",$conn1);
$row=mysql_fetch_array($result);
return $row['url'];
mysql_free_result($result);
}

//���ͼƬ��ַ
function youxi_gg_ad($id){
global $conn1;
$result=mysql_query("select * from advertising where id='$id'",$conn1);
$row=mysql_fetch_array($result);
return $row['address'];
mysql_free_result($result);
}


##########################�Զ�������б�
function ysk_error($var,$var1){
switch ($var) { 
case   "401": 
echo "<script>alert('��¼ʧ�ܣ�����ԭ����û�������˻�������!');self.location=document.referrer;</script>";exit();
break; 
case   "402": 
echo "<script>alert('��¼ʧ�ܣ�����ԭ�����������Ѷ���������,����������ϵ�ͷ���Ա������');self.location=document.referrer;</script>";exit();
break;
case   "403": 
echo "<script>alert('��¼ʧ�ܣ�����ԭ�������ʺ��Ѿ��������ˣ�ԭ��$var1');self.location=document.referrer;</script>";exit();
break; 
case   "404": 
echo "<script>alert('��¼ʧ�ܣ�����ԭ��Υ�涳�ᣡ$var1 Сʱ��ſ��Ե�¼��');self.location=document.referrer;</script>";exit();
break; 
case   "405": 
echo "<script>alert('��¼ʧ�ܣ�����ԭ��������󣬻�ʣ $var1 �ν���������');self.location=document.referrer;</script>";exit();
break; 
case   "406": 
return $error="����ʧ�ܣ�����ԭ�򣺸���Ʒֻ���� ".$var1." �����û���"; 
break; 
case   "407": 
echo "<script>alert('��¼ʧ�ܣ�����ԭ����Ϊ����Υ�棬����ֹ��¼���ⶳʱ��".$var1." ��');self.location=document.referrer;</script>";exit();
break; 
case   "409": 
echo "<script>alert('��¼ʧ�ܣ�����ԭ��û���ҵ����û�ѽ!');self.location=document.referrer;</script>";exit();
break; 
default: 
return $error="��¼�ɹ���"; 
break; 
}
}

function ysk_buy_Sup($var,$var1,$var2,$var3){
if ($var!=0){
$var4=$var2*$var3;
if ($var1<$var4){
echo   "<center><br><br>����ʧ�ܣ�����ԭ��SUP���㣡</center>"; 
exit();
}
}
}

function ysk_buy_Price($var,$var1,$var2,$var3){//�ȼ� �ۼ� ���۷�ʽ ���۽��
#�Ȼ�ȡ�ȼ�����
global $conn1;
$total=mysql_num_rows(mysql_query("SELECT * FROM `level`",$conn1));
if     ($var==1){
$level=$total;
}elseif($var>=2){
$level=$total-$var+1;
}
if ($var2=='1'){
return round($var1+($var1*$level*$var3/100),3);	

}else{
return round($var1+($level*$var3),3);	
}


}


function ysk_buy_error($var){
switch ($var) { 
case   "1": 
echo   "<center><br><br>����ʧ�ܣ�����ԭ�򣺸���Ʒ�Ѿ���ͣ���ۣ�</center>"; 
exit();
break; 
case   "2": 
echo   "<center><br><br>����ʧ�ܣ�����ԭ�򣺸���Ʒ�Ѿ���ֹ���ۣ�</center>"; 
exit();
case   "-1": 
echo   "<center><br><br>����ʧ�ܣ�����ԭ����Ʒ�۸��쳣��</center>"; 
exit();
case   "-2": 
echo   "<center><br><br>����ʧ�ܣ�����ԭ�򣺽�����Ϊ��������</center>"; 
exit();
case   "-3": 
echo   "<center><br><br>����ʧ�ܣ�����ԭ�򣺸���Ʒδ�ϼܣ�</center>"; 
exit();
case   "-4": 
echo   "<center><br><br>����ʧ�ܣ�����ԭ�򣺸���Ʒδͨ����ˣ�</center>"; 
exit();
case   "-5": 
echo   "<center><br><br>����ʧ�ܣ�����ԭ�򣺸���Ʒ��ɾ����</center>"; 
exit();
case   "-6": 
echo   "<center><br><br>����ʧ�ܣ�����ԭ�򣺸���Ʒ��ɾ����</center>"; 
exit();
}
}

///////��װ��

##������
class oo_order{
##����ѯ
function yordeal($var){
if ($var==0){
return "<b style='color:#0000ff'>�ȴ�����</b>";
}elseif($var==2){
return "<b style='color:#FF0000'>���׳ɹ�</b>";
}elseif($var==3){
return "<b style='color:#CCCCCC'>ȡ����ֵ</b>";
}elseif($var==4){
return "<s style='color:#CCCCCC'>�Ѿ��˵�</s>";
}	
}
}

##������
class integral{
//////���һ���
function seller_integral($num){
if($num==''){
return "0 ��";
}elseif($num<'50'){
return $num." ��";
}elseif($num>='50' and $num<='200'){
return "<img src='/Public/images/credit/b1.gif' style='vertical-align:middle'>";
}elseif($num>='201' and $num<='1000'){
return "<img src='/Public/images/credit/b2.gif' style='vertical-align:middle'>";
}elseif($num>='1001' and $num<='5000'){
return "<img src='/Public/images/credit/b3.gif' style='vertical-align:middle'>";
}elseif($num>='5001' and $num<='10000'){
return "<img src='/Public/images/credit/b4.gif' style='vertical-align:middle'>";
}elseif($num>='10001' and $num<='20000'){
return "<img src='/Public/images/credit/b5.gif' style='vertical-align:middle'>";
}elseif($num>='20001' and $num<='40000'){
return "<img src='/Public/images/credit/b6.gif' style='vertical-align:middle'>";
}elseif($num>='40001' and $num<='80000'){
return "<img src='/Public/images/credit/b7.gif' style='vertical-align:middle'>";
}elseif($num>='80001' and $num<='160000'){
return "<img src='/Public/images/credit/b8.gif' style='vertical-align:middle'>";
}elseif($num>='160001' and $num<='260000'){
return "<img src='/Public/images/credit/b9.gif' style='vertical-align:middle'>";
}elseif($num>='260001' and $num<='700000'){
return "<img src='/Public/images/credit/b10.gif' style='vertical-align:middle'>";
}elseif($num>='700001' and $num<='1200000'){
return "<img src='/Public/images/credit/b11.gif' style='vertical-align:middle'>";
}elseif($num>='1200001' and $num<='2000000'){
return "<img src='/Public/images/credit/b12.gif' style='vertical-align:middle'>";
}elseif($num>='2000001' and $num<='5000000'){
return "<img src='/Public/images/credit/b13.gif' style='vertical-align:middle'>";
}elseif($num>='5000001' and $num<='10000000'){
return "<img src='/Public/images/credit/b14.gif' style='vertical-align:middle'>";
}elseif($num>='10000001'){
return "<img src='/Public/images/credit/b15.gif' style='vertical-align:middle'>";
}
}
//////��һ���
function Buyers_integral($num){
if($num==''){
return "0 ��";
}elseif($num<'4'){
return $num."��";
}elseif($num>='4' and $num<='10'){
return "<img src='/Public/images/credit/m1.gif' style='vertical-align:middle'>";
}elseif($num>='11' and $num<='50'){
return "<img src='/Public/images/credit/m2.gif' style='vertical-align:middle'>";
}elseif($num>='51' and $num<='100'){
return "<img src='/Public/images/credit/m3.gif' style='vertical-align:middle'>";
}elseif($num>='101' and $num<='200'){
return "<img src='/Public/images/credit/m4.gif' style='vertical-align:middle'>";
}elseif($num>='201' and $num<='400'){
return "<img src='/Public/images/credit/m5.gif' style='vertical-align:middle'>";
}elseif($num>='401' and $num<='800'){
return "<img src='/Public/images/credit/m6.gif' style='vertical-align:middle'>";
}elseif($num>='801' and $num<='1600'){
return "<img src='/Public/images/credit/m7.gif' style='vertical-align:middle'>";
}elseif($num>='1601' and $num<='3200'){
return "<img src='/Public/images/credit/m8.gif' style='vertical-align:middle'>";
}elseif($num>='3201' and $num<='6400'){
return "<img src='/Public/images/credit/m9.gif' style='vertical-align:middle'>";
}elseif($num>='6401' and $num<='12800'){
return "<img src='/Public/images/credit/m10.gif' style='vertical-align:middle'>";
}elseif($num>='12801' and $num<='58000'){
return "<img src='/Public/images/credit/m11.gif' style='vertical-align:middle'>";
}elseif($num>='58001' and $num<='158000'){
return "<img src='/Public/images/credit/m12.gif' style='vertical-align:middle'>";
}elseif($num>='158001' and $num<='458000'){
return "<img src='/Public/images/credit/m13.gif' style='vertical-align:middle'>";
}elseif($num>='458001' and $num<='1580000'){
return "<img src='/Public/images/credit/m14.gif' style='vertical-align:middle'>";
}elseif($num>='1580001'){
return "<img src='/Public/images/credit/m15.gif' style='vertical-align:middle'>";
}
}
}

##��Ʒ��
class goods{
##����ѯ
function inventory($var){
if($var<=0){
return "<span style='color:#ff0000'>ȱ��</span>";
}elseif($var>1){
return "<span style='color:#0000ff'>�������</span>";
}	
}


//��� ����  status��ֵ  ��Ʒ����  matters��ֵ  ��ƷID  ��� supid
function buy_button($var,$var1,$var2,$var3,$var4,$var5,$var6,$var7){
if ($var3=='����' || $var3=='����ֱ��'  || $var3=='����'){
$varz="<button class='layui-btn layui-btn-xs layui-btn-danger'>������</button>";
}elseif ($var3=='ѡ��'){
$varz="<button class='layui-btn layui-btn-xs layui-btn-warm'>ѡ�Ź���</button>";
}elseif ($var3=='�˹�����' ){
$varz="<button class='layui-btn layui-btn-xs layui-btn-normal'>������ֵ</button>";
}else{
$varz="<button class='layui-btn layui-btn-xs layui-btn-normal'>�ٷ�ֱ��</button>";
}
if ($var==$var1 && $var7==0){
return "������Ʒ";
}elseif($var6<=0){
return "<a href=\"#art1\" onClick=\"Javascript:return confirm('����ʧ�ܣ�����Ʒ��ʱȱ����');\">{$varz}</a>";
}elseif($var2!=0){
return "<a href=\"#art1\" onClick=\"art.dialog.open('/user/product.php?id={$var5}&Action=a',{title:'��Ϣ˵��',width: 800,lock:true,fixed:true});\">{$varz}</a>";
}elseif($var4!=''){
return "<a href=\"#art1\" onClick=\"art.dialog.open('/user/product.php?id={$var5}&Action=b',{title:'�����Ʒ',width: 800,lock:true,fixed:true});\">{$varz}</a>";
}elseif($var3=='����' || $var3=='����ֱ��' || $var3=='����'){
return "<a href=\"#art1\" onClick=\"art.dialog.open('/user/buy_km.php?id={$var5}',{title:'�����ܲ�Ʒ',width:700,height:450,lock:true,fixed:true});\">{$varz}</a>";
}elseif($var3=='ѡ��'){
return "<a href=\"#art1\" onClick=\"art.dialog.open('/user/buy_xh.php?id={$var5}',{title:'����ѡ�Ų�Ʒ',width:700,height:450,lock:true,fixed:true});\">{$varz}</a>";
}else{
return "<a href=\"#art1\" onClick=\"art.dialog.open('/user/buy.php?id={$var5}',{title:'�����Ʒ',width:700,height:450,lock:true,fixed:true});\">{$varz}</a>";
}
}


//��� ����  status��ֵ  ��Ʒ����  matters��ֵ  ��ƷID  ��� supid
function buy_home_button($var,$var1,$var2,$var3,$var4,$var5,$var6,$var7){

if ($var==$var1 && $var7==0){
return "onClick=\"Javascript:return confirm('����ʧ�ܣ������ܹ����Լ�����Ʒ��');\"";
}elseif($var==''){
return "onClick=\"Javascript:return confirm('����ʧ�ܣ��ù���ֻ�Ի�Ա���ţ�');\"";
}elseif($var6<=0){
return "onClick=\"Javascript:return confirm('����ʧ�ܣ�����Ʒ��ʱȱ����');\"";
}elseif($var2!=0){
return "onClick=\"$.dialog.open('/user/product.php?id={$var5}&Action=a',{title:'��Ϣ˵��',width: 800,lock:true,fixed:true});\"";
}elseif($var4!=''){
return "onClick=\"$.dialog.open('/user/product.php?id={$var5}&Action=b',{title:'�����Ʒ',width: 800,lock:true,fixed:true});\"";
}elseif($var3=='����' || $var3=='����ֱ��' || $var3=='����'){
return "onClick=\"$.dialog.open('/user/buy_km.php?id={$var5}',{title:'�����ܲ�Ʒ',width:700,height:450,lock:true,fixed:true});\"";
}elseif($var3=='ѡ��'){
return "onClick=\"$.dialog.open('/user/buy_xh.php?id={$var5}',{title:'����ѡ�Ų�Ʒ',width:700,height:450,lock:true,fixed:true});\"";
}else{
return "onClick=\"$.dialog.open('/user/buy.php?id={$var5}',{title:'�����Ʒ',width:700,height:450,lock:true,fixed:true});\"";
}
}
}

function ysk_buy_Api($var,$var1,$var2,$var3,$var4,$var5,$var6,$var7){## APi��Դ  ����  APIid  ��ƷId  ���򵥼� �������� ������ ��ֵ����
global $api_ofpay_u,$api_ofpay_p,$conn1,$conn2;
if ($var=='ŷ��'){
if ($var1=='���'){
$doc = new DOMDocument();
$doc->load( 'http://api2.ofpay.com/queryleftcardnum.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p.'&cardid='.$var2.'&version=6.0' );
$books = $doc->getElementsByTagName( "card" );
foreach( $books as $book ){
$innum = $book->getElementsByTagName( "innum" );
$innum = $innum->item(0)->nodeValue; 
}
if ($innum<=0){echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ�򣺿�治�㣡</center>"; exit();}
}elseif($var1=='����'){
$doc = new DOMDocument();
$doc->load( 'http://api2.ofpay.com/querycardinfo.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p.'&cardid='.$var2.'&version=6.0');
$books = $doc->getElementsByTagName( "card" );
foreach( $books as $book ){
$inprice = $book->getElementsByTagName( "inprice" );
$inprice = $inprice->item(0)->nodeValue; 
}
$pro_result=mysql_query("select * from sup_product where id='$var3' and price<'$inprice'",$conn2);
$pro=mysql_fetch_array($pro_result);
$price=$pro['price2']-$pro['price'];  #####�õ�ԭ�е�����
$xprice=$inprice+$price;              #####�õ����е�����
mysql_query("update sup_product set price='$inprice',price2='$xprice' where id='$pro[id]'",$conn2); 
if ($pro){echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ����Ʒ�۸��쳣,�����¹���</center>"; exit();}

}elseif($var1=='����'){
$mianzhi=$var4*$var5;
$youxitime=date("Ymdhis");
$of_md5_str=strtoupper(md5($api_ofpay_u.$api_ofpay_p.$var2.$var5.$var6.$youxitime.'OFCARD'));
$post_data = array();
$post_data['cardid']        =$var2;                       ##��Ʒ�ı���
$post_data['cardnum']       =$var5;                       ##��������
$post_data['sporder_id']    =$var6;                       ##�������
$post_data['sporder_time']  =$youxitime;                  ##����ʱ��
$post_data['md5_str']       =$of_md5_str;                 ##MD5����
$post_data['version']       ='6.0';                       ##�̶�ֵ
$url='http://api2.ofpay.com/order.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p;
foreach ($post_data as $k=>$v){
$o.="$k=".urlencode($v).'&';
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //�����Ҫ�����ֱ�ӷ��ص�������Ǽ�����䡣
$result = curl_exec($ch);
$sxe = new SimpleXMLElement($result);
$sxe->asXML('kami/'.$var6.'.xml');
if(strstr($result,"�˻�����")!=false){
echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ��404�쳣������ϵ�ͷ���</center>"; exit();
}elseif(strstr($result,"����Ʒ�ݲ�����")!=false){
echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ����Ʒ�쳣��</center>"; exit();
}
}elseif($var1=='����' && $var7==1){
//---------------------------------------------------------------------------------------------------------------------------------�ֻ��ж��Ƿ���Գ�ֵ
$mianzhi=$var4*$var5;
$handle = fopen ("http://api2.ofpay.com/telcheck.do?phoneno=$var6&price=$mianzhi&userid=$api_ofpay_u", "rb"); 
$contents = ""; 
while (!feof($handle)) { 
$contents.= fread($handle, 8192); 
} 
fclose($handle); 

if (strstr($contents,"�ɹ�")==false){
echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ����Ʒ�Ѷϻ����������ֻ������޷���ֵ��</center>"; exit();
}//---------------------------------------------------------------------------------------------------------------�ֻ��ж��Ƿ���Գ�ֵ The End
}elseif($var1=='����' && $var7==2){
//----------------------------------------------------------------------------------------------------------------�̻��ж��Ƿ���Ի��ѳ�ֵ
$mianzhi=$var4*$var5;
if ($var3=='����'){$ovar3='1';}else{$ovar3='2';}
$handle = fopen ("http://api2.ofpay.com/fixtelquery.do?userid=$api_ofpay_u&userpws=$api_ofpay_p&teltype=$ovar3&phoneno=$var6&pervalue=$mianzhi&version=6.0", "rb"); 
$contents = ""; 
while (!feof($handle)) { 
$contents .= fread($handle, 8192); 
} 
fclose($handle); 
if (strstr($contents,"�ɹ�")==false ){
echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ����Ʒ�Ѷϻ��������Ĺ̻��޷���ֵ��</center>"; exit();
}//---------------------------------------------------------------------------------------------------------------�̻��ж��Ƿ���Ի��ѳ�ֵ The End
}elseif($var1=='ֱ��' && $var7==1){//---------------------------------------------------------------�ֻ�����ֱ��
$mianzhi=$var4*$var5;
$youxitime=date("Ymdhis");
$caourl=$site_url.'/MyApi/oufei/phone_back.php';
$of_md5_str=strtoupper(md5($api_ofpay_u.$api_ofpay_p.'140101'.$mianzhi.$var2.$youxitime.$var6.'OFCARD'));
$post_data = array();
$post_data['cardid']        ='140101';                    ##��� ���� ��䣺140101�����䣺170101(ֻ֧���ƶ�)
$post_data['cardnum']       =$mianzhi;                    ##��ֵ
$post_data['sporder_id']    =$var2;                       ##�������
$post_data['sporder_time']  =$youxitime;                  ##����ʱ��
$post_data['game_userid']   =$var6;                       ##�ֻ�����
$post_data['md5_str']       =$of_md5_str;                 ##MD5����
$post_data['ret_url']       =$caourl;                     ##����ҳ��
$post_data['version']       ='6.0';                       ##�̶�ֵ
$url='http://api2.ofpay.com/onlineorder.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p;
foreach ($post_data as $k=>$v){
$o.="$k=".urlencode($v).'&';
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //�����Ҫ�����ֱ�ӷ��ص�������Ǽ�����䡣
$result = curl_exec($ch);
if(strstr($result,"����")!==false){
echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ��404�쳣������ϵ�ͷ���</center>"; exit();
}

}elseif($var1=='ֱ��' && $var7==2){//---------------------------------------------------------------�̻�����ֱ��
if ($var3=='����'){$ovar3='1';}else{$ovar3='2';}
$mianzhi=$var4*$var5;
$youxitime=date("Ymdhis");
$caourl=$site_url.'/MyApi/oufei/phone_back.php';
$of_md5_str=strtoupper(md5($api_ofpay_u.$api_ofpay_p.$mianzhi.$var2.$youxitime.$var6.'OFCARD'));
$post_data = array();
$post_data['teltype']       =$ovar3;                      ##��Ӫ�� 1������ 2����ͨ
$post_data['cardnum']       =$mianzhi;                    ##��ֵ
$post_data['sporder_id']    =$var2;                       ##�������
$post_data['sporder_time']  =$youxitime;                  ##����ʱ��
$post_data['game_userid']   =$var6;                       ##�̻�����
$post_data['md5_str']       =$of_md5_str;                 ##MD5����
$post_data['ret_url']       =$caourl;                     ##����ҳ��
$post_data['version']       ='6.0';                       ##�̶�ֵ
$url='http://api2.ofpay.com/fixtelorder.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p;
foreach ($post_data as $k=>$v){
$o.="$k=".urlencode($v).'&';
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //�����Ҫ�����ֱ�ӷ��ص�������Ǽ�����䡣
$result = curl_exec($ch);
if(strstr($result,"����")!==false){
echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ��404�쳣������ϵ�ͷ���</center>"; exit();
}
}elseif($var1=='ֱ��' && $var7==3){//---------------------------------------------------------------��Ϸֱ��
$youxitime=date("Ymdhis");
$caourl=$site_url.'/MyApi/oufei/phone_back.php';
$of_md5_str=strtoupper(md5($api_ofpay_u.$api_ofpay_p.$var4.$var5.$var2.$youxitime.$var6.'OFCARD'));
$post_data = array();
$post_data['cardid']        =$var4;                           ##��Ʒ���
$post_data['cardnum']       =$var5;                           ##����
$post_data['sporder_id']    =$var2;                           ##�������
$post_data['sporder_time']  =$youxitime;                      ##����ʱ��
$post_data['game_userid']    =urlencode($var6);               ##��Ϸ�˻�
$post_data['game_userpsw']   ='';      ##��Ϸ����
$post_data['game_area']      ='';      ##��Ϸ����
$post_data['game_srv']       ='';      ##��Ϸ���ڷ�������
$post_data['md5_str']       =$of_md5_str;                 ##MD5����
$post_data['ret_url']       =$caourl;                     ##����ҳ��
$post_data['version']       ='6.0';                       ##�̶�ֵ
$url='http://api2.ofpay.com/onlineorder.do?userid='.$api_ofpay_u.'&userpws='.$api_ofpay_p;
foreach ($post_data as $k=>$v){
$o.="$k=".urlencode($v).'&';
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //�����Ҫ�����ֱ�ӷ��ص�������Ǽ�����䡣
$result = curl_exec($ch);
if(strstr($result,"����")!==false){
echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ��404�쳣������ϵ�ͷ���</center>"; exit();
}elseif(strstr($result,"ȱ�ٱ������")!==false){
echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ��ȱ�ٱ��������</center>"; exit();
}elseif(strstr($result,"����Ʒ�ݲ�����")!==false){
echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ�򣺴���Ʒ�ݲ����ã�</center>"; exit();
}elseif(strstr($result,"MD5����֤����")!==false){
echo "<center><br><br><br><br><br><br><br><br>����ʧ�ܣ�����ԭ��MD5����֤����</center>"; exit();
}




}
##########################ŷ�� The End
}	
}

function sortArray($array,$choice){
$values = array_values($array);//����һ����������������
$ch=$choice==0?min:max;//����$choiceΪ0����С�������У�����������Ĭ��Ϊ���Ӵ�С
do {
$val = $ch($values);//�ҳ�������Сֵ
$key = array_search($val,$values);//ȡ�����ֵ�ļ���
$result[$key] = $val;//�����ֵ����������
unset($values[$key]);
}while (count($values)>0);
return $result;
}


/*********************************************************************
��������:encrypt
��������:���ܽ����ַ���
ʹ�÷���:
����     :encrypt('str','E','nowamagic');
����     :encrypt('�����ܹ����ַ���','D','nowamagic');
����˵��:
$string   :��Ҫ���ܽ��ܵ��ַ���
$operation:�ж��Ǽ��ܻ��ǽ���:E:����   D:����
$key      :���ܵ�Կ��(�ܳ�);
*********************************************************************/
function encrypt($string,$operation,$key='')
{
$key=md5($key);
$key_length=strlen($key);
$string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
$string_length=strlen($string);
$rndkey=$box=array();
$result='';
for($i=0;$i<=255;$i++)
{
$rndkey[$i]=ord($key[$i%$key_length]);
$box[$i]=$i;
}
for($j=$i=0;$i<256;$i++)
{
$j=($j+$box[$i]+$rndkey[$i])%256;
$tmp=$box[$i];
$box[$i]=$box[$j];
$box[$j]=$tmp;
}
for($a=$j=$i=0;$i<$string_length;$i++)
{
$a=($a+1)%256;
$j=($j+$box[$a])%256;
$tmp=$box[$a];
$box[$a]=$box[$j];
$box[$j]=$tmp;
$result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
}
if($operation=='D')
{
if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8))
{
return substr($result,8);
}
else
{
return'';
}
}
else
{
return str_replace('=','',base64_encode($result));
}
}

//============================================��½�ռ�
function ysk_date_log($var,$var1,$var2,$var3=0){
global $conn1,$begtime;
$network=ysk_network(Local_Ip());
if ($network==''){
$network='-';
}else{
$network=$network;
}
$Local_Ip=Local_Ip();
mysql_query("insert into `diary` (type,username,content,begtime,youip,area,sid)"."values ('$var','$var1','$var2','$begtime','$Local_Ip','$network','$var3')",$conn1);
}

?>