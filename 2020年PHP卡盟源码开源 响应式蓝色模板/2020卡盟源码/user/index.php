
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; " />


<?php 
header("Content-type: text/html; charset=gb2312"); 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
$Action=strip_tags($_GET['Action']);
$layout=strip_tags($_GET['layout']); 
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);

if     ($layout=='1'  && $yx_us['power5']==1){
$yourl='product/DHandleSave.php';
}elseif($layout=='1'  && $yx_us['power5']!=1){
$yourl='sorry.php';
}elseif($layout=='2' ){
$yourl='dealers/CustomerList.php';
}else{
$yourl='juheshe.php?NumberID=H001';
}


if ($_SESSION['Platform_announcement']=='1' and $login_prompt!=''){
$_SESSION['my_gg_id']=1;
}
###########��ȡǿ���Ķ��Ķ���
$result=mysql_query("select * from sms where username='$_SESSION[ysk_number]' and locks='1' order by begtime desc,id desc limit 0,1",$conn1);
$row=mysql_fetch_array($result);
if($row['id']!=''){
$_SESSION['my_lock_id']=$row['id'];
}
mysql_free_result($result);
?>
<title><?=$site_name?>  - Powered by �ۺ���</title>
<!-- ���Ԫ�� ��ʼ -->
<link href="css/rightload.css" type="text/css" rel="stylesheet" />
<link rel="icon" href="http://www.juheshe.cn/ico.png" type="image/png">
<!-- ���Ԫ�� ���� -->

<!-- jQueryԪ�� ��ʼ -->
<script src="css/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQueryԪ�� ���� -->

<!-- ����Ԫ�� ��ʼ -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<!-- ����Ԫ�� ���� -->

<!-- ��ЧԪ�� ��ʼ -->
<script src="css/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<!-- ��ЧԪ�� ���� -->

<!-- ������Ԫ�� ��ʼ -->
<script src="css/dialog.js" type="text/javascript"></script>
<link href="css/dialog.css" rel="stylesheet" type="text/css" />
<!-- ������Ԫ�� ���� -->

<!-- ����Ԫ�� ��ʼ -->
<script type="text/javascript" src="css/RSA.js"></script>  
<script type="text/javascript" src="css/BigInt.js"></script>  
<script type="text/javascript" src="css/Barrett.js"></script>
<!-- ����Ԫ�� ���� -->

<!-- ����Ԫ�� ��ʼ -->
<script src="css/layer.js"></script>
<!-- ����Ԫ�� ���� -->
<style type="text/css">
	.red_money_parent{display:none; width: 100%; height: 100%; position: fixed; z-index: 2; top: 0px; left: 0px; overflow: hidden;}
</style>

</head>
<body>


<div class="topbar">
	<span class="welcome fl pl20">
		
	</span>
	<div class="top">
		<ul class="quick_list">
            <li>���� ��<?=$yx_us['rname']?></li>
            <li><a name="loginOut" href="/logout.php">[�˳�]</a>&nbsp;&nbsp;ح</li>
            <li><a target="right" href="my.php">�ҵ�����</a>&nbsp;&nbsp;ح</li>
			<li><a target="right" href="wallet.php">�ҵ�Ǯ��</a>&nbsp;&nbsp;ح</li>
            <li><a target="right" href="Messenger.php">վ����<em>(<?=mysql_num_rows(mysql_query("SELECT * FROM `sms` where username='$_SESSION[ysk_number]' and state=0 ",$conn1));?>)</em></a>&nbsp;&nbsp;ح</li>
            <li class="service dropdown">
                <span class="outline"></span>
                <span class="blank"></span>
                <a href="javascript:void(0);">ϵͳ�л�<b></b></a>
                <div class="dropdown-menu">
                    <ol>
                        <li><a href="/user">����ϵͳ</a></li>
						<li><a href="/merchant">�̻���̨</a></li>
							<li><a href="/">ƽ̨��ҳ</a></li>
                    </ol>
                </div>
            </li>
            
        </ul>
		<input value="inter" type="hidden" id="typee">
	</div>
	
	
</div>
<div class="header">
<a href="/" class="logo"><img width="140" height="40" src="<?=$site_logo?>" width="" height=""></a>
	
	<ul class="h-nav">
		
			<li class="active"><a target="right" href="juheshe.php?NumberID=H001" class="hvr-outline-out" name="menushow">������Ʒ</a></li>
			<li><a id="topGoodAdvertRecommend" href="javascript:void(0);" class="hvr-outline-out nav-other">��Ʒ�Ƽ�</a></li>
			<li><a target="right" href="shoppingrecord.php" class="hvr-outline-out nav-other" name="menushow">�����¼</a></li>
			<li><a target="right" href="accountMoneyHistory.php" class="hvr-outline-out nav-other" name="menushow">�ʽ���ϸ</a></li>
			<li><a target="right" href="customerService.php" class="hvr-outline-out nav-other" name="menushow">��ϵ�ͷ�</a></li>
			<li><a target="right" href="complaint.php" class="hvr-outline-out nav-other" name="menushow">Ͷ�߷���</a></li>
			
			
	</ul>
	
<script type="text/javascript">
$(document).ready(function(){
	$("a[name='menushow']").click(function(){
		
		$("a[name='menushow']").attr("class","hvr-outline-out nav-other");
		$("a[name='menushow']").parent().removeClass();
	
		$(this).attr("class","hvr-outline-out");
		$(this).parent().attr("class","active");
	});
});
</script>
</div>
<script type="text/javascript">
$(document).ready(function(){
 $('.dropdown').hover(function () {
        $(this).toggleClass('hover');
    });
 
 	$("#topGoodAdvertRecommend").click(function(){
		parent.Dialog.win({
			title:"��Ʒ�Ƽ�",
			iframe:{src:"recommend.php"},
			width:900,
			height:550
		});

	});
	

  	//�˳�
  	$("a[name='loginOut']").click(function(){
  		var flag = window.confirm("��Ҫ�˳�ϵͳ?");
  		if(flag){
  			window.parent.parent.location.href="/logout.php";
  		}
  	});
	
	$.ajax({
		url:"getTopScoll.htm",
		type:"post",
		success:function(data){
			if(data.scollText.length>0){
				$("#scollDiv").show();
				for(var i=0;i<data.scollText.length;i++){
					var targets=data.scollText[i]["isWeb"];
					var band=data.scollText[i]["isBold"];
					var bolds="bold";
					var targ="right";
					if(targets!=1){
						targ="_blank";
					}
					if(band!=1){
						bolds="";
					}
					var content=data.scollText[i]["content"];
					if(content.length>26){
						content=content.substring(0,28);
					}
					$("#div"+i).attr("style","height:27px;");
					$("#a"+i).html(content);
					$("#a"+i).attr("href",data.scollText[i]["linkUrl"]);
					$("#a"+i).attr("target",targ);
					$("#a"+i).attr("style","color:"+data.scollText[i]["color"]+";font-size:"+data.scollText[i]["fontSize"]+"px;font-weight:"+bolds+";");
				}
				
				for(var i=data.scollText.length;i<8;i++){
					$("#div"+i).remove();
				}
				
				$(".m_wnews").slide({
					mainCell : "#miniNewsRegion",
					effect : "topLoop",
					autoPlay : true
				});
				
			}
		}
	});
});
</script>
	<div class="card-center fix">
		<div class="side-menu">
			
<script language="javascript"> 
var xmlHttp; 
function createXMLHttpRequest(){ 
if(window.ActiveXObject){ 
xmlHttp = new ActiveXObject("microsoft.XMLHTTP"); 
} 
else if(window.XMLHttpRequest){ 
xmlHttp = new XMLHttpRequest(); 
} 
else{ 
alert("��������ʧ��"); 
} 
} 
function getmoney(){ 
createXMLHttpRequest(); 
url = "ajax.php?Action=money"; 
xmlHttp.onreadystatechange = callback; 
xmlHttp.open('GET',url,true); 
xmlHttp.send(null); 
} 
function callback(){ 
if(xmlHttp.readyState ==4){ 
if(xmlHttp.status == 200){ 
document.getElementById("juheshemoney").innerHTML = xmlHttp.responseText; 
} 
} 
} 
setInterval(getmoney,3000); //ÿ3�뷢��һ������
</script> 


<div class="acc-capital">
	<div class="ac-tab-hd">
		<ul class="ac-tab-nav">
			<li class="on"><a target="right" href="juheshe.php?NumberID=H001">������Ʒ</a></li>
			<li class="on"><a id="cardpay" href="javascript:void(0);">�˻���ֵ</a></li>
		</ul>
	</div>
	<div class="ac-tab-bd">
		<div class="tab-pal">
			�� �ţ�	<?=$yx_us['number']?><br />
				�� �	<span id="juheshemoney"><?=number_format($yx_us['kuan'],2);?></span><?=$moneytype?>
				<br />
				 �� �ѣ�	<span id="juheshemoney"><?=number_format($yx_us['zong_kuan'],2);?></span>	<?=$moneytype?><br />
				 �� ��	<?php
$levelresult=mysql_query("select * from level where id='$yx_us[level]'",$conn1);
$level=mysql_fetch_array($levelresult);
echo $level['title'];?>		<?=$yx_us['title'];?>		</a><br />

		</div>
	</div>
</div>
<script type="text/javascript">
 $(document).ready(function(){
 	var currentLevel = "";
  	$("a[name='selfLevel']").click(function(){
		window.Dialog.win({
			title:"��������",
			iframe:{src:"level.php"+currentLevel},
			width:500,
			height:160
		});
	});
	
	  	$("a[id='cardpay']").click(function(){
		window.Dialog.win({
			title:"�˻���ֵ",
			iframe:{src:"cardpay.php"+currentLevel},
			width:1000,
			height:730
		});
	});
	
		  	$("a[name='topGoodAdvertRecommend']").click(function(){
		window.Dialog.win({
			title:"��Ʒ�Ƽ�",
			iframe:{src:"recommend.php"+currentLevel},
			width:900,
			height:550
		});
	});
	

		
 });
</script>
			


<div class="menu">
	<ul class="pt15 bgfff">
			
			<li class="active li01"><a target="right" href="juheshe.php?NumberID=H001">������ҳ</a></li>
			<li class="li04"><a name="topGoodAdvertRecommend" href="javascript:void(0);">��Ʒ�Ƽ�</a></li>
			<li class="li02"><a target="right" href="goodsfavorite.php">�ղؼ�</a></li>
		<li class="li02"><a target="right" href="complaint.php">Ͷ�߷���</a></li>
		<li class="li03"><a target="right" href="Messenger.php">վ�ڶ���</a></li>
		<li class="li03"><a target="right" href="getcard.php">�����ȡ����</a></li>
		<li class="li02"><a target="right" href="shoppingrecord.php">�����¼</a></li>
		<li class="li02"><a target="right" href="accountMoneyHistory.php">�ʽ���ϸ</a></li>
		<li class="li03"><a target="right" href="customerService.php">�ͷ�����</a></li>
		<li class="li05"><a target="right" href="wallet.php">�ҵ�Ǯ��</a></li>
		<li class="li06"><a target="right" href="javascript:void(0);" name="selfLevel">��������</a></li>
	</ul>
</div>



		</div>
		 <script type="text/javascript">
                    function autoResize() {
                        try {
                            document.getElementById("right").style.height = (parseInt($(window.frames["right"].document.body).height()) + 0) + "px";
                        }
                        catch (e) {

                        }
                    }
                </script>

		<div class="main-con ha-oh">
			<iframe scrolling="no" id="right" name="right" src="juheshe.php?NumberID=H001" frameborder="0" onload="autoResize()" style="margin: 0px; height:50%; visibility: inherit; width: 100%; z-index: 1;">
</iframe>
		</div>
		
		 
		
		

	</div>
	<div class="footer">
		<div class="copyright">
			<img src="images/user-center_footer.jpg" alt="" /><br />
			<span>
				<?= str_replace("\n","<p>",$site_copyright)?>
			</span>
		</div>
		<div class="qrcode">
		 <?php
$Rss="SELECT * FROM shuffling  where menu='��ҳ�ͷ�' order by begtime desc, id desc limit 0,2 ";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
			<img width="100" height="100" src="<?=$Orzx['address']?>">
			
			<?php
}
}?>
		</div>
	</div>
	<div class="index-rightBox" id="index-rightBox"></div>
    <div id="red_money_box" class="red_money_parent"></div>
  

</body>
 
</Html>
