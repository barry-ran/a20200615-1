<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?=$site_name?>-<?=$site_title?> - Powered by �ۺ���</title>
<meta content="<?=$site_keywords?>" name="keywords">
<meta content="<?=$site_describe?>" name="description">
<link rel="stylesheet" type="text/css" href="/templatecss/blue/HcJane.css" />
<link href="/templatecss/blue/global.css" rel="stylesheet" type="text/css" />
<link href="/templatecss/blue/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/templatecss/blue/jquery.js"></script>
<script type="text/javascript" src="/templatecss/blue/Hcjane.js"></script>
<script type="text/javascript" src="/templatecss/blue/reg.js"></script>
</head>
<body id="nav_btn01">
   <?php include('head.php');?>
<link href="/templatecss/blue/login.css" rel="stylesheet" type="text/css" />
<div class="banner_bj">
    <div class="banner_bj_c">
        <div class="banner_c">
	<script type="text/javascript" src="/Public/theme/003/js/jquery.1.7.2.min.js" ></script>
	<script type="text/javascript" src="/Public/theme/003/js/jquery.easing.min.js"></script>
	<script type="text/javascript" src="/Public/theme/003/js/jquery.yx_rotaion.js"></script>
            <div class="tab h_flash">
			<?php
$Rss="SELECT * FROM shuffling  where menu='��ҳ��ͼ' order by begtime desc,id desc limit 0,9 ";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
                <ul>
                    <li style="display:list-item;"><a href='<?=$Orzx['url']?>' target='_blank'><img src='<?=$Orzx['address']?>' width='705' height='270' /></a></li> 
<?php
}
}?>		</ul>		
            </div>
   
				<div class="h_login">
                    <div class="login-wrap">
                        <div class="login-top">
                            <div class="input-wrap">
				<form action="/login_check.php" method="post" >
							<input name="Token" type="hidden" value="<?=genToken()?>">
                        <dl class="clear_div h_login">
                           <input class="login-username" type="text" placeholder="����������" name="username"
                                    id="userlogin" />
                            </div>
                            <div class="input-wrap">
                                <input class="login-password" type="password" value="" placeholder="����������" name="password"
                                    id="passlogin" />
                            </div>
                            <div class="input-wrap login-btn">
                                <button type="submit"  class="login_btn1 logins" tabindex="3" id="inside">������¼</button>
									
									
                                <ul class="clear">
									<a href="/reg.php"><li>����ע��</li></a>
                                </ul>
                            </div>
                        </div>
                    </div>

            
                <!--end��ǩ����-->
            </div>
            <!--end��¼-->
        </div>
        <!--end�����͵�¼-->
    </div>
    <!--end��ɫ������-->
</div>
<div id="box" style="display: none;">
</div>
<!-- ��֤������ end -->
<!--end��ɫ����-->
<div class="clear_div h_center">
    <div class="clear_div h_one">
        <!-- �� -->
        <div class="">
            <div class="">
                <dl class="blue_th">
                    <dd class="th">
                        ƽ̨��̬
                    </dd>
                    <dt>
                        <a href="/news.php" class="china">���� &gt;&gt;</a>
                    </dt>
                </dl>

                <div class="blue_border">
	
                    <ul class="clear_div h_ann">
											<?php
$result=mysql_query("select * from  article  where menu='ƽ̨����' and hiddens<>'0' order by begtime desc,id desc limit 0,8 ",$conn1);
while($row=mysql_fetch_array($result)){ 
?>
                        <li title="<?=$row['title']?>"><span class="date"><?=date("Y-m-d",$row['begtime'])?></span><a style="color:<?=$row['color']?>;" href="Info.php?id=<?=$row['id']?>"><?=$row['title']?></a></li>
				<?php
}
?>					</ul>
                </div>
                <!--end�߿�-->
            </div>

                   
                <div class="clear_div h_contact">
                    <dl class="blue_th">
                        <dd class="th">
                            ��ϵ��ʽ
                        </dd>
                    </dl>

                    <div class="blue_border">
                        <ul class="clear_div th h_contact">
                            <li>
                                <dl>
                                    <dt>
                                        <img src="/templatecss/blue/qq.png" alt="������ѯʱ��" width="31" height="31">
                                    </dt> <dd>
                                          �ͷ�QQ:<span class="tel"><?=$qq1?></span>
                                        <p>ҵ��QQ:<span class="tel"><?=$qq2?></span></p>
                                        <p>�ӿ�QQ:<span class="tel"><?=$qq3?></span></p>
                                    </dd>
                                </dl>
                            </li>

                            <li>
                                <dl>
                                    <dt>
                                        <img src="/templatecss/blue/tel.png" alt="�绰" width="31" height="31">
                                    </dt>
                                    <dd>
                                        �ͷ��绰:<span class="tel"><?=$phoe1?></span>
                                        <p>ҵ��ͷ�:<span class="tel"><?=$phoe2?></span></p>
                                        <p>�ӿ�ͷ�:<span class="tel"><?=$phoe3?></span></p>
                                    </dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <!--end�߿�-->
                </div>
                <!--end��ϵ����-->
            </div>
        </div>

      

    <script type="text/javascript" src="/templatecss/blue/global.js"></script>
    <script src="/templatecss/blue/browsercompatible.js" type="text/javascript"></script>
    <script src="/templatecss/blue/jquery-webox.js" type="text/javascript"></script>

    <dl class="h_link_th">
        <dd class="th">
            ��������
        </dd>
    </dl>
    <ul class="clear_div h_link">
        <?php
$Rss="SELECT * FROM bobo_links  order by begtime desc,id desc limit 0,16 ";
$Orz=mysql_query($Rss,$conn1);
$aa=mysql_num_rows($Orz);
if($aa!=0){
while($Orzx=mysql_fetch_array($Orz)){?>
        <li><a target="_blank" href="<?=$Orzx['url']?>" rel="nofollow"><?=$Orzx['title']?></a></li>				<?php
}
}?>   </ul>
</div>
<?php include('foot.php');?>

</body>
</html>