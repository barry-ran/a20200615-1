
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�˻���ֵ - Powered by �ۺ���</title>
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
	
	

    <style>


        .input_text {
            padding: 10px 10px;
            border: 1px solid #d5d9da;
            border-radius: 5px;
            box-shadow: 0 0 5px #e8e9eb inset;
            width: 100px;
            font-size: 1em;
            outline: 0;
        }

        .input_text:focus {
            border: 1px solid #b9d4e9;
            border-top-color: #b6d5ea;
            border-bottom-color: #b8d4ea;
            box-shadow: 0 0 5px #b9d4e9;
        }

        .button {
            color: #666;
            background-color: #EEE;
            border-color: #EEE;
            font-weight: 300;
            font-size: 16px;
            font-family: "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            text-decoration: none;
            text-align: center;
            line-height: 40px;
            height: 40px;
            padding: 0 40px;
            margin: 0;
            display: inline-block;
            appearance: none;
            cursor: pointer;
            border: none;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-duration: .3s;
            transition-duration: .3s;
        }

        .button-primary {
            background-color: #1B9AF7;
            border-color: #1B9AF7;
            color: #FFF;
        }

        .button-primary:visited:visited {
            color: #FFF;
        }

        .button-primary:hover, .button-primary:focus,
        {
            background-color: #4cb0f9;
            border-color: #4cb0f9;
            color: #FFF;
        }

        .button-pill {
            border-radius: 200px;
        }


    </style>
	
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
<input name="begtime" readonly="readonly" type="hidden" value="<?php $now=mktime(); echo $now;?>"class="biankuan" />
<div class="main">
        <div class="layout_top">
            <div class="layout_top"><ul class="clearfix"><li class="lineNo" id="SRUserPay"><a href="cardpay.php" >��ֵ����ֵ</a></li>
			
			<li id="SRTcCardPay"><a href="pay.php" class="on">���߳�ֵ<em>�Ƽ�</em></a></li>
			
			<li id="SRTcCardPay"><a href="javascript:alert('δ�������')">���ѿ���ֵ</a></li>
			</ul> </div>
        
        </div>
       <!-- content:start -->
<div class="content pt25">
	<input name="Token" type="hidden" value="<?=genToken()?>">
	
	<center><div class="card_title"><i></i><span>������ֵδ��������ϵ��վ�ͷ���</span></div></center>
        <tbody>
		<?php
/** ��ֵ����ҳ��2
 */
require_once("../codepay/codepay_config.php"); //���������ļ�

//session_start(); //����session
//$_SESSION["uuid"] = guid();//����UUID ��ӵ���ҳ�� ��ֹʹ�ò�����������ύ����
//$salt = md5($_SESSION["uuid"]);
?>
<br>
	
	<form name="form1" id="form1" method="post" action="../codepay/codepay.php">
    <div>
        <table  class="conTable">
			<tbody>
  <input type="hidden" class="inputTxt account" id="user" name="user" value="<?=$yx_us['number']?>">

  
  
  
        <tr>
            <th>
                ��ֵ��
            </th>
            <td>
                <input type="text" class="inputTxt account" placeholder="�������ֵ���" id="price" name="price">
            </td>
        </tr>
		<tr>
            <th>
                �����ѣ�
            </th>
            <td>
                <input type="text" disabled="disabled" class="inputTxt account" placeholder="0.00" id="prices" name="prices">
            </td>
        </tr>
		<br><br>
            <tr>
                <td>
                    <div align="right">֧����</div>
                </td>
                <td><label>
                            <input type="radio" name="type" value="1" checked="checked"> ֧����</input>
                        
                            <input type="radio" name="type" value="2"> QQǮ��</input>
                    </label>
                </td>
            </tr>
			
            <input type="hidden" name="salt" value="<?php echo $salt; ?>">
			
            <tr>
                <td>
                    <div align="right"></div>
                </td>
                <td><label>
                        <input type="submit" name="Submit" id="Submit" class="button button-pill button-primary"
                               value="֧����֧��">

                    </label></td>
            </tr>
            </tbody>
        </table>
    </div>
</form>
<script type="text/javascript">
    var type = document.getElementsByName('type');
    var price = document.getElementById('price');
    var money = document.getElementById('money');
    var FormSubmit = document.getElementById('Submit');
    for (var i = 0; i < type.length; i++) {
        type[i].onclick = function () {
            switch (parseInt(this.value)) {
                case 1:
                    FormSubmit.value = '֧����֧��';
                    break;
                case 2:
                    FormSubmit.value = 'QQǮ��֧��';
                    break;
                case 3:
                    FormSubmit.value = '΢��֧��';
                    break;
                default:
                    FormSubmit.value = '֧����֧��';
            }
        }
    }
    $(".w-pay-money").click(function () {
        $(".w-pay-money").removeClass('w-pay-money-selected');
        $(this).addClass('w-pay-money-selected');
        price.value = $(this).attr('data');
        money.value = $(this).attr('data');
    });

</script>
</div>
    </div>

<? }?> 


</div>
</body>
</Html>