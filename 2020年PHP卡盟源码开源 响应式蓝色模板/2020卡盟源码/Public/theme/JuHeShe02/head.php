<div class="navBox">
				<div class="logo left">
					<img src="<?=$site_logo?>" alt="" draggable="false">
				</div>
				<div class="navBox_right right">
					<ul class="nav left">
						
												<li class="left"><a href="/" >��վ��ҳ</a></li>
												<?php if ($site_menu!='') {
$allArray=(explode("\n",$site_menu));    ////�� explode �� �س� �����ݸ���������
foreach($allArray as $value) 
{
$allArray1=(explode('��',$value));       ////�� explode �� �� �����ݸ���������
?>
<li class="left"><a href="<?=$allArray1[1]?>" target="_blank"><?=$allArray1[0]?></a></li>
<?php
} 
} ?>
											</ul>
					<a class="btn_common login left active" href="/reg.php">ע��</a>
				</div>
			</div>