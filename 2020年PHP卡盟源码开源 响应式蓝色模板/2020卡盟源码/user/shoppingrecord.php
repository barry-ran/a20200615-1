
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ۺ���</title>

<meta http-equiv="Content-Type" content="text/html;">


<!-- ����Ԫ�� ��ʼ -->
<link href="css/style.css" rel="stylesheet" type="text/css">
<!-- ����Ԫ�� ���� -->

<!-- ��Ԫ�� ��ʼ -->
<script src="css/jquery.form.js" type="text/javascript"></script>
<!-- ��Ԫ�� ���� -->

<!-- ��ѡԪ�� ��ʼ -->
<script src="CheckBoxUtil.js" type="text/javascript"></script>
<!-- ��ѡԪ�� ���� -->

<!-- ����Ԫ�� ��ʼ -->
<link rel="stylesheet" href="css/cool.css?4.1.6"><script type="text/javascript" src="css/jquery.artDialog.js"></script>
<!-- ����Ԫ�� ���� -->
</head>
<link href="images/right.css" rel="stylesheet" type="text/css" />

<body>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
include_once('../jhs_config/page_class.php');
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
$Action=strip_tags($_GET['Action']);
$muyou1=strtotime($StartYear."-".$StartMonth."-".$StartDay." ".$StartHour.":".$StartMinute);
$muyou2=strtotime($EndYear."-".$EndMonth."-".$EndDay." ".$EndHour.":".$EndMinute);
if ($Action=='') {?>
<div class="right">
<div class="" style="display: none; position: absolute;"><div class="aui_outer"><table class="aui_border"><tbody><tr><td class="aui_nw"></td><td class="aui_n"></td><td class="aui_ne"></td></tr><tr><td class="aui_w"></td><td class="aui_c"><div class="aui_inner"><table class="aui_dialog"><tbody><tr><td colspan="2" class="aui_header"><div class="aui_titleBar"><div class="aui_title" style="cursor: move;"></div><a class="aui_close" href="javascript:/*artDialog*/;">��</a></div></td></tr><tr><td class="aui_icon" style="display: none;"><div class="aui_iconBg" style="background: none;"></div></td><td class="aui_main" style="width: auto; height: auto;"><div class="aui_content" style="padding: 20px 25px;"></div></td></tr><tr><td colspan="2" class="aui_footer"><div class="aui_buttons" style="display: none;"></div></td></tr></tbody></table></div></td><td class="aui_e"></td></tr><tr><td class="aui_sw"></td><td class="aui_s"></td><td class="aui_se" style="cursor: se-resize;"></td></tr></tbody></table></div></div>
	<div class="ifra-right_con">
		<h3 class="column-title">
			<b>�����¼��ѯ</b>
		</h3>
			<div id="box" class="capi-tbl capital">
			<form name="saleForm" id="saleForm" method="get" action="Shoppingrecord.php">
        <div class="capi-search">
           
            <dl class="period">
                <dt>��ѯʱ��</dt>
                <dd>
                   <script language="JavaScript" type="text/javascript" src="js/SelectDate.js"></script>
<span style="display: inline-block;vertical-align: middle;">
<?php include_once('../jhs_config/time.php');?>
	</span>
</dd>
            </dl>
            <dl class="opear">
                <dt>

                </dt>
                <dd>
					<input type="submit" name="btnQuery" value="��  ѯ" id="btnQuery" class="btn1" />
                </dd>
            </dl>
        </div>
    </form>

<table >
<thead>
<tr>
<th width="13%">��������</th>
<th width="40%">��Ʒ����</th>
<th width="10%">����</th>
<th width="5%">����</th>
<th width="8%">����</th>
<th width="8%">��ֵ</th>
<th width="6%">Ͷ��</th>
<th width="8%">״̬</th>
</tr>
</thead>
<?php
$search="where number='$_SESSION[ysk_number]'"; 
if ($StartYear!='') $search.=" and time >=$muyou1 and time <=$muyou2 "; 
$total=mysql_num_rows(mysql_query("SELECT * FROM `product_order`  $search",$conn1));  //��ѯ�ܼ�¼��
$num="30";
$page=new page($total,$num);
$sql="select * from product_order $search order by time desc,id desc  {$page->limit}"; 
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_num_rows($zyc);
if($row == 0){
?>

<?php 
} ?><?php
while ($row=mysql_fetch_array($zyc)){
?>

<tbody id="contentDiv">
<tr>
<td><?=date("Y-m-d G:i:s",$row['time'])?></td>
<td>
<span style="color:<?=$row['color']?>"><?=$row['title']?></span></td>
<td><?=$row['type']?></td>
<td class="tp"><?=$row['nums']?></td>
<td><?=number_format($row['buyprice'],3)?> <?=$moneytype?></td>
<td><?=number_format($row['price'],3)?> <?=$moneytype?></td>

<td align="center" style="color:Black;">
<a style=" color:#999999; text-decoration:none"  href="AddComplain.php?Action=ad1&id=<?=$row['orderid']?>">Ͷ�߶���</a>
</td>
<td><?php if      ($row['trading']=='0' || $row['trading']=='1' ) {?>
<a style="text-decoration:none" class="status3"  href="javascript:" onClick="art.dialog.open('/user/order.php?id=<?=$row['orderid']?>', {title:'������ϸ��Ϣ',width:800,lock:true,fixed:true});">
�ȴ�����
<?php }elseif ($row['trading']=='2') {?>
<a style="text-decoration:none" class="status1"  href="javascript:" onClick="art.dialog.open('/user/order.php?id=<?=$row['orderid']?>', {title:'������ϸ��Ϣ',width:800,lock:true,fixed:true});">
���׳ɹ�</a>
<?php }elseif ($row['trading']=='3') {?>
<a style="text-decoration:none" class="status2"  href="javascript:" onClick="art.dialog.open('/user/order.php?id=<?=$row['orderid']?>', {title:'������ϸ��Ϣ',width:800,lock:true,fixed:true});">
ȡ����ֵ
<?php }?>
</a></td>

</tr>
</tbody>
<?php
}
?>


<?php } ?>
<tr align="center" style="color:Black;">
                    <td colspan="3">�ܺϼ�</td>
                    <td><?php
$res=mysql_query("SELECT sum(nums) FROM `product_order` $search",$conn1);
$sum=mysql_result($res,0);
?>
<?=$sum?> ��</td>
                    <td><?php
$res=mysql_query("SELECT sum(buyprice) FROM `product_order` $search",$conn1);
$sumz=mysql_result($res,0);
?><?=number_format($sumz,3)?> <?=$moneytype?></td>
                    <td colspan="3">&nbsp;</td>
                </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" style="padding-top:15px; padding-bottom:15px;">
<?php if ($total!='0'){?><?=$page->paging();?>	<?php } ?> </td>
</tr>
</table>
</div>
</div>
</body>
</Html>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>