<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
$y=$_REQUEST['y'];
?>
<div class="qie2">
<ul>
<li><a href="../right.php">SUP��ҳ</a></li>
<li <?php if ($y=='1') {?>class="on"<?php } ?>><a href="CategoryList.php?y=1&NumberID=H001">Ŀ¼�б�</a></li>
<li <?php if ($y=='3') {?>class="on"<?php } ?>><a href="InventoryQuery.php?y=3">�Խ���</a></li>
<li <?php if ($y=='4') {?>class="on"<?php } ?>><a href="DHandleSave.php">��ֵ��</a></li>
<li <?php if ($y=='5') {?>class="on"<?php } ?>><a href="InventoryQuery1.php?y=5">�쳣����</a></li>
<li class="right">
<div class="sousuo">
<form action="search.php" method="post">
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td width="78%" align="right" ></td>
<td width="16%" align="right"><input id="keywords" name="keywords" class="ss2" type="text" maxlength="20" /></td>
<td width="6%" align="left"><input type="image" src="images/go.jpg"  ></td>
</tr>
</table>
</form>
</div>
</li>
</ul>
</div>