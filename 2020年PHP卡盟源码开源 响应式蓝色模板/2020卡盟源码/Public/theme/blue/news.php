<?php
inject_check($_REQUEST['page']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="X-UA-Compatible" content="IE=7;IE=9;IE=8">
<title>ƽ̨��̬-<?=$site_name?>-<?=$site_title?> - Powered by �ۺ���</title>
<meta content="<?=$site_keywords?>" name="keywords">
<meta content="<?=$site_description?>" name="description">
<link rel="shortcut icon" type="image/x-icon" href="http://www.nitiangou.cn/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="/templatecss/blue/hcjane.css" />
<link href="/templatecss/blue/global.css" rel="stylesheet" type="text/css" />
<link href="/templatecss/blue/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/templatecss/blue/jquery.js"></script>
<script type="text/javascript" src="/templatecss/blue/hcjane.js"></script>
<script type="text/javascript" src="/templatecss/blue/reg.js"></script>
<script type="text/javascript" src="/templatecss/blue/login.js"></script>
</head>
<body id="nav_btn01">
      <?php include('head.php');?>
    <!--end����-->
    <div class="clear_div2 i_center_bj">
        <div class="clear_div d_center">
            <div class="d_left">
                <ul class="clear_div th left_nav">
                    <li class="light"><a>ƽ̨��̬</a></li>
                </ul>
            </div>
            <!--end���-->
            <div class="d_right">
                <div class="site_th">
                    <dl>
                        <dt>
                            <a href="/">��ҳ</a>
                            <a href="/news.php">ƽ̨��̬</a>
                                                    </dt>
                    </dl>
                </div>
                <!--endλ�ñ���-->
                <ul class="clear_div i_news">
				<?php
if ($_REQUEST['type']!=""){
$total=mysql_num_rows(mysql_query("SELECT * FROM `article` where  menu='$ytitle' and hiddens='1'",$conn1));  //��ѯ�ܼ�¼��
}else{
$total=mysql_num_rows(mysql_query("SELECT * FROM `article`  where hiddens='1' ",$conn1));  //��ѯ�ܼ�¼��
}
$num="11";
$page=new page($total,$num);
if ($_REQUEST['type']!=""){
$return=mysql_query("SELECT *  FROM `article` where menu='$ytitle' and hiddens='1' order by id desc {$page->limit}",$conn1);
}else{
$return=mysql_query("SELECT * FROM `article` where hiddens='1' order by id desc {$page->limit}",$conn1);
}
while($row=mysql_fetch_array($return)){
?>
                   <li style="text-align:left;padding-top:10px">
                            <span class="date" style="float:right; "><?=date("Y-m-d",$row['begtime'])?></span>
                            <span style="margin-left:10px;">
                                <a style="color:<?=$row['color']?>;" href="/Info.php?id=<?=$row['id']?>" title="<?=$row['title']?>">   <?=$row['title']?>  </a>
                                <span></span>
                            </span>
                        </li>
						
			<?php }?>
                </ul>
                <div class="clear_div page">
<?=$page->paging();?>
</div>
            </div>
        </div>
<?php include('foot.php');?>

</body>
</html>
<script type="text/javascript">
 $(document).ready(function(){
        //��ҳ
        $('.num').click(function () {
           window.location.href = '/../Art?p='+$(this).attr('name')+'&type='+$('#type').val();
        });
 });
</script>
</body>
</html>