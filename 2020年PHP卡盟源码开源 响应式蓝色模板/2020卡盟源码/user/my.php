<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html;">
<title>�ۺ���</title>
<!-- jQueryԪ�� ��ʼ -->
<script src="css/my/jquery-1.9.1.js" type="text/javascript"></script>
<!-- jQueryԪ�� ���� -->

<!-- ����Ԫ�� ��ʼ -->
<link href="css/my/style.css" rel="stylesheet" type="text/css">
<!-- ����Ԫ�� ���� -->

<!-- ��Ԫ�� ��ʼ -->
<script src="css/my/jquery.form.js" type="text/javascript"></script>
<!-- ��Ԫ�� ���� -->

<!-- ����֤Ԫ�� ��ʼ -->
<script src="css/my/jquery.validate.js" type="text/javascript"></script>
<!-- ����֤Ԫ�� ���� -->
<script src="css/dialog.js" type="text/javascript"></script>
<link href="css/dialog.css" rel="stylesheet" type="text/css" />
</head>
<?php 
include_once('../jhs_config/function.php');
include_once('../jhs_config/user_check.php');
$yx_us_result=mysql_query("select * from members where number='$_SESSION[ysk_number]' ",$conn1);
$yx_us=mysql_fetch_array($yx_us_result);
?>
<body>
	<div class="ifra-right_con">
		<h3 class="column-title">
			<b>�ҵ��˻�</b>
		</h3>
		
		<div class="self-run-con">
		<div class="acc-info-list">
			<div class="basic-data">
				<h3 class="acc-info-title">�˻�����</h3>
			</div>
	   			<dl>
					<dt><i></i>�ͻ���ţ�</dt>
					<dd>
						<?=$_SESSION['ysk_number']?>
					</dd>
				</dl>
				<dl>
					<dt><i></i>�� �� ����</dt>
					<dd>
						<?=$yx_us['username']?>
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>��ʵ������</dt>
					<dd>
						<?=$yx_us['rname']?>
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>���֤�ţ�</dt>
					<dd>
						<?=substr($yx_us['card'],0,6);?>********<?=substr($yx_us['card'],14,18);?>
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>�� �䣺</dt>
					<dd>
						<?=$yx_us['username']?>
					</dd>
				</dl>
				<dl>
					<dt><i></i>��ϵQQ��</dt>
					<dd>
						***<?=substr($yx_us['qq'],3,15);?>
					</dd>
				</dl>
				<dl>
					<dt><i></i>�ֻ����룺</dt>
					<dd>
						<?=substr($yx_us['phone'],0,3);?>****<?=substr($yx_us['phone'],7,11);?>
					</dd>
				</dl>
				<dl>
					<dt><i></i>��ϵ��ַ��</dt>
					<dd>
						<?=$yx_us['address']?>
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>ע�������</dt>
					<dd>
						<?=$yx_us['province']?>
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>ע��ʱ�䣺</dt>
					<dd>
						<?=date("Y-m-d G:i:s",$yx_us['begtime'])?>
					</dd>
				</dl>
				
				<div class="basic-data">
					<h3 class="acc-info-title1">�˻�����</h3>
				</div>
				<dl>
					<dt><i></i>��ȫ����</dt>
					<dd>
							
								<a id="updateLoginPwd" href="javascript:void(0);" class="asdfddd">�޸ĵ�¼����</a>
							
							
							<a id="updateSalePwd" href="javascript:void(0);" class="asdfddd">�޸Ľ�������</a>
							
					</dd>
				</dl>
				
				<dl>
					<dt><i></i>���Ϲ���</dt>
					<dd>
							<a id="updateCustomer" href="javascript:void(0);" class="asdfddd">�޸��˻�����</a>
								
							
					</dd>
				</dl>
				
				<div class="basic-data">
					<h3 class="acc-info-title1">��������ݵ�¼����</h3>
				</div>
				<dl style="">
					<dt><i></i>Q Q��</dt>
					<dd>
						��δ����
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>΢�ţ�</dt>
					<dd>
						��δ����
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>�Ա���</dt>
					<dd>
						��δ����
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>���ˣ�</dt>
					<dd>
						��δ����
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>�ٶȣ�</dt>
					<dd>
						��δ����
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>3 6 0��</dt>
					<dd>
						��δ����
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>�й��ƶ���</dt>
					<dd>
						��δ����
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>�й���ͨ��</dt>
					<dd>
						��δ����
				            
					</dd>
				</dl>
				<dl>
					<dt><i></i>�й����ţ�</dt>
					<dd>
						��δ����
				            
					</dd>
				</dl>
		</div>
    		
		</div>
		
	
	</div>
<script type="text/javascript">
$(document).ready(function(){


	$("#updateCustomer").click(function(){
		parent.Dialog.win({
			title:"�޸��˻�����",
			iframe:{src:"account.php?Action=zl"},
			width:620,
			height:420
		});
	});
	$("#updateLoginPwd").click(function(){
		parent.Dialog.win({
			title:"�޸ĵ�¼����",
			iframe:{src:"account.php?Action=password"},
			width:500,
			height:260
		});
	});
	$("#updateSetLoginPwd").click(function(){
		parent.Dialog.win({
			title:"���õ�¼����",
			iframe:{src:"updateSetLoginPwd.php"},
			width:500,
			height:260
		});
	});
		$("#updateSalePwd").click(function(){
			parent.Dialog.win({
				title:"�޸Ľ�������",
				iframe:{src:"account.php?Action=jymm"},
				width:500,
				height:260
			});
	});
});
	
</script>
	<script type="text/javascript">
		var ifrhegiht=Math.min(window.document.documentElement.scrollHeight,window.document.body.scrollHeight);
		window.parent.parent.parent.document.getElementById("right").style.height=ifrhegiht+0+"px";
	</script>


</body></Html>