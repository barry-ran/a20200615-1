
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�˻���ֵ</title>
<meta name="keywords" content="�ۺ��� - �˼�" />
</head>

	<link href="images/right.css" rel="stylesheet" type="text/css" />
    <link href="css/pay/base-utf8.css" type="text/css" rel="stylesheet" />
    <link href="css/pay/common-utf8.css" type="text/css" rel="stylesheet" />
    <link href="css/pay/layout-utf8.css" type="text/css" rel="stylesheet" />
    <link href="css/pay/ui-utf8.css" type="text/css" rel="stylesheet" />
	<link href="css/pay/style.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="css/pay/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="css/pay/base-utf8.js" charset="UTF-8"></script>
    <script type="text/javascript" src="css/pay/common.min-utf8.js" charset="UTF-8"></script>
    <script type="text/javascript" src="css/pay/qa-utf8.js "></script>

    <script type="text/javascript" src="css/pay/BaseUse.js"></script>
    <script type="text/javascript" src="css/pay/CheckUse.js"></script>   
    <script type="text/javascript" src="css/pay/TcCardPay.js" charset="UTF-8"></script>

<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
$Action=$_REQUEST['Action'];
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
$begtime=strip_tags($_POST['begtime']);         //ʱ��
$pay=$_REQUEST['pay'];
if ($pay=='' or $pay=='1'){
$payurl='../payment/alipay/alipayapi.php';
$payck='1';
}else{
$payurl='../payment/tenpay/tenpay.php';
$payck='2';
}
?>
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



<div class="right">

<?php if ($_REQUEST['Go']=='' && $Action=='') {?>
<br><br><br>


<form action="?Action=save1" method="post">
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<div class="main">
        <div class="layout_top">
            <div class="layout_top"><ul class="clearfix"><li class="lineNo" id="SRUserPay"><a href="pay.php" >���߳�ֵ<em>�Ƽ�</em></a></li>
			
			<li id="SRTcCardPay"><a href="cardpay.php" class="on">��ֵ����ֵ</a></li>
			
			<li id="SRTcCardPay"><a href="javascript:alert('δ�������')">���ѿ���ֵ</a></li>
			</ul> </div>
        
        </div>
       <!-- content:start -->
<div class="content pt25">
    <table class="conTable">
	<input name="Token" type="hidden" value="<?=genToken()?>">
        <tbody>
		<center><div class="card_title"><i></i><span>��ֵ�������ַ��<a href="<?=$cardpay_url?>" target="_blank"><?=$cardpay_url?></a>&nbsp;&nbsp;(������Ӵ��´��ڴ�)</span></div></center>
		<tr>
            <th>
                �û���ţ�
            </th>
            <td>
                <input type="text" class="inputTxt account" id="UserId" name="UserId"disabled="disabled"  value="<?=$yx_us['number']?>">
            </td>
        </tr>
        <tr>
            <th>
                ��ֵ�����ţ�
            </th>
            <td>
                <input type="text" class="inputTxt account" placeholder="�������ֵ������" id="account" name="account">
            </td>
        </tr>
        <tr>
            <th>
                ��ֵ�����룺
            </th>
            <td>
                <input type="password" class="inputTxt account" placeholder="�������ֵ������" id="password" name="password"><br/>
                
            </td>
        </tr>
        <tr>
            <th>
            </th>
			</form>
            <td class="btnBox">
			
			<input type="submit" name="btnSubmit" value="ȷ�ϳ�ֵ" id="btnSubmit" class="btn" />
               
            </td>
        </tr>
    </tbody></table>
    <div class="tips">
        <p class="title">
            ��������</p>
        <ul class="tipList">
            <li class="">
               <font size="3"> <i>+</i><a href="javascript:;">ʲô��ƽ̨��ֵ����</a>  </font>  
                <p>
                    ��1����������ƽ̨���еĵ��Ӵ�ֵ���������������˻����г�ֵ<br>
                    ��2����ֵ��ֻ���ڱ�ƽ̨ע���û���ֵʹ��<br>
                    ��3����ֵ���ġ����š��͡����롱���д�Сд��ĸ�Լ��������<br>
                </p>   
            </li>
			 <li class="">
                <font size="3"><i>+</i><a href="javascript:;">��������������ֵ����</a>    </font>  
                <p>
                    ��1���������Ϸ��Ĺ�����������<br>
                </p>   
            </li>
        </ul>
    </div>
</div>
    </div>





<?php }elseif ($Action=='save'){
	
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}

if (!$_REQUEST['price']){
echo "<script>alert('������Ϊ��!');window.history.back(-1);</script>";
exit();
}
if (!$_REQUEST['time']){
echo "<script>alert('���ʱ�䲻��Ϊ��!');window.history.back(-1);</script>";
exit();
}
if (!$_REQUEST['note']){
echo "<script>alert('��ע����Ϊ��!');window.history.back(-1);</script>";
exit();
}

//--------------------------------����ʽ�ȫ
get_check_price($_POST['price']);
//--------------------------------����ʽ�ȫ End

$type=strip_tags($_POST['type']);
$note=strip_tags($_POST['note']);
inject_check($_POST['type']);
inject_check($_POST['price']);

$result=mysql_query("select * from rem_account   where id='$type'",$conn1);
$yx=mysql_fetch_array($result);
if (!$yx){
echo "<script>alert('������в���Ϊ��!');window.history.back(-1);</script>";
exit();
}

$price=$_POST['price'];             //�����
$time=$_POST['time'];               //���ʱ��
$bank_type=$yx['bank_type'];     //�������
mysql_query("insert into `money_order` (bank_type,kuan,htime,content,number,begtime) " . "values ('$bank_type','$price','$time','$note','$_SESSION[ysk_number]','$begtime')",$conn1);
echo "<script>alert('�ύ�ɹ�!');self.location=document.referrer;</script>";
exit();
	
}elseif ($Action=='save1') {
if ($_SESSION['yx_token']!=$_POST['Token']){
echo "<script>alert('�Բ��𣬷Ƿ�������');;self.location=document.referrer;</script>";
exit();	
}

$result=mysql_query("select * from one_cartoon  where account='$_REQUEST[account]' and password='$_REQUEST[password]' ",$conn1);
$yx_cz=mysql_fetch_array($result);
if ($yx_cz){
if ($yx_cz['states']=='1'){
echo "<script language=\"javascript\">alert('�Բ��𣬳�ֵ���ѱ����');window.history.back(-1);</script>";  
exit(); 
}
$czkuan=$yx_us[kuan]+$yx_cz[price];
mysql_query("update one_cartoon set states='1',username='$_SESSION[ysk_number]',begtime='$begtime' where id='$yx_cz[id]' ",$conn1); 
mysql_query("insert into `details_funds` (title,incomes,spendings,befores,afters,number,begtime) " .
"values ('��ֵ��$_REQUEST[account]��ֵ','$yx_cz[price]','0','$yx_us[kuan]','$czkuan','$_SESSION[ysk_number]','$begtime')",$conn1);
mysql_query("update members set kuan=kuan+$yx_cz[price]  where number='$_SESSION[ysk_number]' ",$conn1); 
echo "<script>alert('��ֵ�ɹ�!');self.location=document.referrer;</script>";
}else{
echo "<script language=\"javascript\">alert('�Բ��𣬳�ֵ���˻����������');window.history.back(-1);</script>";  
exit(); 
}

}?>
</div>
</body>
</Html>