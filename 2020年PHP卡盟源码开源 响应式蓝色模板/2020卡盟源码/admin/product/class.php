
<link href="../images/index.css" type=text/css rel=stylesheet>
<?php
include('../../jhs_config/function.php');
include('../../jhs_config/admin_check.php');
?>
<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
<tr>
<td valign="middle"> 
<?php 
$NumberIDStr=$_REQUEST['NumberID'];
$orz1="select * from product_class  where LagID=0 order by Classorder asc";   //��ȡ���ݱ�
$Rss1=mysql_query($orz1,$conn1);                  //ִ�и�SQl���
$num=mysql_num_rows($Rss1);
$NumberID1 = substr ("$NumberIDStr", 0,4);    //��ȡ����ӵ�1λ�ÿ�ʼ��ȡ3���� PHP�� 0�����ʼ��λ��
if($num!=0){     

?>
<select name="ClassID" class="box4" onChange="var jmpURL=this.options[this.selectedIndex].value ; if(jmpURL!='') {window.location=jmpURL;} else {this.selectedIndex=0 ;}" >
<option value="" selected>��ѡ�����...</option>
<?php while($row=mysql_fetch_array($Rss1)){ ?>
<option value="Class.Php?NumberID=<?=$row[NumberID]?>" <?php if ($NumberID1==$row[NumberID]) {?> selected <?php } ?>><?=$row[7]?></option>
<?php } ?>
</select>
<?php } 
?>


<?php 
$orz1="select * from product_class  where PartID='$NumberID1' order by Classorder asc";   //��ȡ���ݱ�
$Rss1=mysql_query($orz1,$conn1);                     //ִ�и�SQl���
$num=mysql_num_rows($Rss1);
$NumberID2 = substr ("$NumberIDStr", 0,7);    //��ȡ����ӵ�1λ�ÿ�ʼ��ȡ3���� PHP�� 0�����ʼ��λ��
if($num!=0){ ?>
<select name="ClassID" class="box4" onChange="var jmpURL=this.options[this.selectedIndex].value ; if(jmpURL!='') {window.location=jmpURL;} else {this.selectedIndex=0 ;}" >
<option value="" selected>��ѡ�����...</option>
<?php while($row=mysql_fetch_array($Rss1)){ ?>
<option value="Class.Php?NumberID=<?=$row[NumberID]?>" <?php if ($NumberID2==$row[NumberID]) {?> selected <?php } ?>><?=$row[7]?></option>
<?php } ?>
</select>
<?php }?>

<?php 
$len=strlen($NumberIDStr);
if ($len>=7) {?>
<?php 
$orz1="select * from product_class  where PartID='$NumberID2' order by Classorder asc";   //��ȡ���ݱ�
$Rss1=mysql_query($orz1,$conn1);                  //ִ�и�SQl���
$num=mysql_num_rows($Rss1);
$NumberID3 = substr ("$NumberIDStr", 0,10);    //��ȡ����ӵ�1λ�ÿ�ʼ��ȡ3���� PHP�� 0�����ʼ��λ��
if($num!=0){ ?>
<select name="ClassID" class="box4" onChange="var jmpURL=this.options[this.selectedIndex].value ; if(jmpURL!='') {window.location=jmpURL;} else {this.selectedIndex=0 ;}" >
<option value="" selected>��ѡ�����...</option>
<?php while($row=mysql_fetch_array($Rss1)){ ?>
<option value="Class.Php?NumberID=<?=$row[NumberID]?>" <?php if ($NumberID3==$row[NumberID]) {?> selected <?php } ?>><?=$row[7]?></option>
<?php } ?>
</select>
<?php } 
}
mysql_close(); 
?>

</td>
</tr>
</table>

<script language="JavaScript">
var id = '<?=$NumberIDStr?>';
//window.parent.document.myform.Class.value = id;			
window.parent.document.getElementById("ClassID").value=id;

</script>
