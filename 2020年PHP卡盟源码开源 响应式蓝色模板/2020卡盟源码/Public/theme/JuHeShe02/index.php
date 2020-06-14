<!DOCTYPE html>
<?php 
include_once('/jhs_config/function.php');
?>
<html>
	<head>
    <meta charset="gb2312">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$site_name?>-<?=$site_title?> - Powered by �ۺ���</title>
    <meta name="keywords" content="<?=$site_keywords?>" />
    <meta name="description" content="<?=$site_describe?>" />
		<script> 
	var DEFAULT_VERSION = 8.0;  
    var ua = navigator.userAgent.toLowerCase();  
    var isIE = ua.indexOf("msie")>-1;  
    var safariVersion;  
    if(isIE){  
    safariVersion =  ua.match(/msie ([\d.]+)/)[1];  
    }  
    if(safariVersion <= DEFAULT_VERSION ){  
 alert("����IE������汾̫�Ϳ����޷�����������ҳ���������IE9��֧�ּ���ģʽ���������лл������ϣ�");
    }; 
  

</script>
		<link rel="icon" href="http://www.juheshe.cn/ico.png" type="image/png">
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/default.css" />
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/animate.css" />
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/aos.css" />
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/header_common.css"/>
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/index_main.css"/>
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/common_contact.css"/>
		<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/media.css" />
 			<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/util.css"> 
	<link rel="stylesheet" type="text/css" href="/templatecss/JuHeShe02/main.css">
		<script src="/templatecss/JuHeShe02/jquery-1.11.3.min.js"></script>
		<script src="/templatecss/JuHeShe02/aos.js"></script>
		<script src="/templatecss/JuHeShe02/xs.js"></script>
		<script src="/templatecss/JuHeShe02/common_js.js"></script>
		<script src="/templatecss/JuHeShe02/index_main.js"></script>
		
	</head>
	<body aos-easing="ease-out-back" aos-duration="1000" aos-delay="0">
		<!--ͷ-->
     <header class="index_header">
			<!--����-->
			<?php include('head.php');?>
			<div class="center">
				<div class="banner">
					<div class="banner_left left">
						<div class="text1 animated bounceInLeft"><?=$bluewhite1?></div>
						<div class="text1_line animated bounceInLeft"></div>
						<p aos="fade-right" class="banner_p animated bounceInRight aos-init aos-animate"><?=$bluewhite2?></p>
						<p aos="fade-right" class="banner_p animated bounceInRight aos-init aos-animate"><?=$bluewhite3?></p>
					</div>
<div class="wrap-login100 p-l-50 p-r-50 p-t-50 p-b-50">
				<form action="/login_check.php" method="post" >
				
					<span class="login100-form-title p-b-30">��¼</span>
					<input name="Token" type="hidden" value="<?=genToken()?>">
					<div class="wrap-input100 validate-input m-b-23" data-validate="�������û���">
						<span class="label-input100"></span>
						<input class="input100" type="text" name="username" placeholder="�������û���" autocomplete="off">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="����������">
						<span class="label-input100"></span>
						<input class="input100" type="password" name="password" placeholder="����������">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="text-right p-t-8 p-b-31">
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">�� ¼</button>
						</div>
					</div>
					<div class="flex-col-c p-t-25">
						<a href="/reg.php" class="txt2">����ע��</a>
					</div>
				</form>
				</div>
			</div>
					</div>
				</div>
			</div>
		</header>
		<div class="about">
			<div class="center">
				<div aos="zoom-in" class="about_main aos-init aos-animate">
					<span class="title_common about_title pingFang"><?=$bluewhite4?></span>
					<span class="about_line right"></span>
					<div class="about_txt">
						<p class="pingFang"><?=$bluewhite5?></p>
					</div>
					<a href="/reg.php" target="_blank" class="about_more pingFang">ע��</a>
				</div>
			</div>
			<div class="about_right">
				<div class="about_rightMain">
					<img aos="fade-up-right" class="about_rightImg1 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightimg1.png" alt="" draggable="false" />
					<div class="about_rightCenter">
						<img aos="fade-down-left" class="rightCenter_com rightCenter_1 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightcenter1.png" alt="" draggable="false" />
						<img aos="fade-down-left" class="rightCenter_com rightCenter_2 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightcenter2.png" alt="" draggable="false" />
						<img aos="fade-down-left" class="rightCenter_com rightCenter_3 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightcenter3.png" alt="" draggable="false" />
						<img aos="fade-down-left" class="rightCenter_com rightCenter_4 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightcenter4.png" alt="" draggable="false" />
					</div>
					<img aos="fade-up-left" class="about_rightImg2 aos-init aos-animate" src="/templatecss/JuHeShe02/about_rightimg2.png" alt="" draggable="false" />
				</div>
			</div>
		</div>
		<!--�Զ�����-����-->
		<div aos="zoom-in" class="process aos-init aos-animate">
			<div class="center">
				<div class="process_main">
					<span class="title_common process_title pingFang animated slideInUp">��Ϊ<?=$site_name?>�̻�����6��</span>
					<span class="process_line animated zoomIn"></span>
					<span class="process_h4 pingFang animated slideInDown"><?=$site_name?>��������������</span>
					<ul class="process_ul">
						<li class="left animated bounceInLeft">
							<img src="/templatecss/JuHeShe02/process_1.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">ע���˻�</span>
							<span class="process_txt2 pingFang">60�����ע��</span>
						</li>
						<li class="left animated bounceInLeft">
							<img src="/templatecss/JuHeShe02/process_2.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">��ͨ����</span>
							<span class="process_txt2 pingFang"><?=$site_name?>���㿪ͨר������</span>
						</li>
						<li class="left animated bounceInLeft">
							<img src="/templatecss/JuHeShe02/process_3.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">������Ʒ</span>
							<span class="process_txt2 pingFang">����һ��������Ʒ</span>
						</li>
						<li class="left animated bounceInRight">
							<img src="/templatecss/JuHeShe02/process_5.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">ƽ̨���</span>
							<span class="process_txt2 pingFang">���ͨ������ʱ�ϼ�</span>
						</li>
						<li class="left animated bounceInRight">
							<img src="/templatecss/JuHeShe02/process_4.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">������</span>
							<span class="process_txt2 pingFang">��ɶ��������Զ�����</span>
						</li>
						<li class="left animated bounceInRight">
							<img src="/templatecss/JuHeShe02/process_6.png" alt="" draggable="false" />
							<span class="process_txt1 pingFang">���ֽ���</span>
							<span class="process_txt2 pingFang">�������ǳ�ֱ���</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!--Ʒ������-->
		<div class="advantage" id="advantage">
			<div class="advantage_topBox">
				<div aos="fade-up-right" class="leftImg_common1 rightImg_common2 advantage_topL aos-init aos-animate"></div>
				<div class="center centerRe">
					<div aos="flip-left" class="advantage_topMain aos-init aos-animate">
						<span class="advantage_common advantage_title pingFang">Ʒ������</span>
						<span class="advantage_line"></span>
						<span class="advantage_common advantage_txt pingFang">�����<?=$site_name?>Ч�ʣ�һ�ж���Ϊ����</span>
					</div>
				</div>
				<div aos="fade-up-left" class="rightImg_common1 leftImg_common2 advantage_topR aos-init aos-animate"></div>
			</div>
			<div class="center">
				<ul class="advantage_botMain">
					<li class="left">
						<img aos="zoom-in-up" class="aos-init aos-animate" src="<?=$bluewhite6?>" alt="" draggable="false" />
						<span aos="flip-up" class="advantage_botTxt pingFang aos-init aos-animate"><?=$bluewhite10?></span>
						<p aos="flip-up" class="advantage_botP pingFang aos-init aos-animate"><?=$bluewhite14?></p>
					</li>
					<li class="left li_margin">
						<img aos="zoom-in-up" class="aos-init aos-animate" src="<?=$bluewhite7?>" alt="" draggable="false" />
						<span aos="flip-up" class="advantage_botTxt pingFang aos-init aos-animate"><?=$bluewhite11?></span>
						<p aos="flip-up" class="advantage_botP pingFang aos-init aos-animate"><?=$bluewhite15?></p>
					</li>
					<li class="left li_margin">
						<img aos="zoom-in-up" class="aos-init aos-animate" src="<?=$bluewhite8?>" alt="" draggable="false" />
						<span aos="flip-up" class="advantage_botTxt pingFang aos-init aos-animate"><?=$bluewhite12?></span>
						<p aos="flip-up" class="advantage_botP pingFang aos-init aos-animate"><?=$bluewhite16?></p>
					</li>
					<li class="left">
						<img aos="zoom-in-up" class="aos-init aos-animate" src="<?=$bluewhite9?>" alt="" draggable="false" />
						<span aos="flip-up" class="advantage_botTxt pingFang aos-init aos-animate"><?=$bluewhite13?></span>
						<p aos="flip-up" class="advantage_botP pingFang aos-init aos-animate"><?=$bluewhite17?></p>
					</li>
				</ul>
			</div>
		</div>
		<!--��ϵ����-->
		<div class="contact_comBox contact_box" id="contact_box">
			<div class="contactUs_index contactUs">
				<div class="center">
					<p aos="zoom-out-down" class="contactUs_indexTitle contactUs_title pingFang aos-init aos-animate">��ϵ����</p>
					<p aos="zoom-out-down" class="contactUs_line aos-init aos-animate"></p>
					<ul aos="zoom-in-up" class="contactUs_main aos-init aos-animate">
						<li class="left contactUs_liMargin1">
							<span class="contactUs_icon contactUs_icon1"></span>
							<span class="contactUs_mainTit pingFang_bold">��˾��ַ</span>
							<span class="contactUs_mainLine"></span>
							<span class="contactUs_mainTxt pingFang"><?=$address?></span>
							<span class="contactUs_mainBot"></span>
						</li>
						<li class="left contactUs_liMargin2">
							<span class="contactUs_icon contactUs_icon2"></span>
							<span class="contactUs_mainTit pingFang_bold">��ϵQQ</span>
							<span class="contactUs_mainLine"></span>
							
								<a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$qq1?>&site=qq&menu=yes" target="_blank" class="contactUs_mainTxt pingFang"><?=$qq1?></a>
							<span class="contactUs_mainBot"></span>
						</li>
						<li class="left contactUs_liMargin1">
							<span class="contactUs_icon contactUs_icon3"></span>
							<span class="contactUs_mainTit pingFang_bold">��������</span>
							<span class="contactUs_mainLine"></span>
							<span class="contactUs_mainTxt pingFang"><?=$bluewhite18?></span>
							<span class="contactUs_mainBot"></span>
						</li>
					</ul>
				</div>
			</div>
			<div class="contact_bot">
				<div aos="fade-up-right" class="leftImg_common1 leftImg_common2 contact_botL aos-init aos-animate"></div>
				<div class="center centerRe">
					<div aos="fade-left" class="contact_botMain pingFang aos-init aos-animate">
						<div class="contact_botMainTxt"><?=$bluewhite19?></div>
						<a href="/reg.php" class="contact_botMainBtn" style="float: left;">����ע��</a>
					</div>
				</div>
				<div aos="fade-up-left" class="rightImg_common1 rightImg_common2 contact_botR aos-init aos-animate"></div>
			</div>
		</div>
		<footer>
			<div class="footer_top">
			</div>
			<div class="footer_bottom pingFang"> <?= str_replace("\n","<p>",$site_copyright)?><?=$javascript?>
						</div>
						</footer>
	</body>
</html>
