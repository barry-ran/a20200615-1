<?php
//echo '�������ܽ�վ��ȫ��Դ����ϵͳ ������أ�www.kycard.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>welcome</title>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
<script language="JavaScript" type="text/javascript">
function clearNoNum(obj){
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
</head>
<?php
include_once('../jhs_config/function.php');
include_once('../jhs_config/admin_check.php');
$Action=strip_tags($_GET['Action']);
$sql=mysql_query("select * from site_config  where id='1'",$conn1);
$row=mysql_fetch_array($sql);
////////�޸ļ�¼
if ($Action=="save"){
$charge1=pot_check_price($_POST['charge1']);##���ַ���1
$charge2=pot_check_price($_POST['charge2']);##���ַ���2
$charge3=pot_check_price($_POST['charge3']);##���ַ���3
$charge4=pot_check_price($_POST['charge4']);##���ַ���4
$y21=$row['charge1'];
$y22=$row['charge2'];
$y23=$row['charge3'];
$y24=$row['charge4'];

//--------------------ִ�в�����־
if ($y1<>$version1){ysk_date_log(6,$_SESSION['ysk_username'],'�޸���ϵͳ��վ�汾һ');}
mysql_query("update site_config set charge1='$charge1',charge2='$charge2',charge3='$charge3',charge4='$charge4' where id=1",$conn1); 
echo "<script>alert('�޸ĳɹ�!');self.location=document.referrer;</script>";
}

?>
<body>

<?php
$sup_sql="select * from sup_members_site where number='$sup_number'";   //��ȡ���ݱ�
$sup_zyc=mysql_query($sup_sql,$conn2);  //ִ�и�SQl���
$sup_row=mysql_fetch_array($sup_zyc);
?>
<div class="x-body">
 <div class="layui-form-item">
<form name="add" method="post" action="?Action=save&id=1" >

          <div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                50-1000<br>�����շѣ�
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="charge1" name="charge1" value="<?=$row['charge1']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
		            <div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
               1000-5000<br>�����շѣ�
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="charge2" name="charge2" value="<?=$row['charge2']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
		          <div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                5000-10000<br>�����շѣ�
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="charge3" name="charge3" value="<?=$row['charge3']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
		       <div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                 10000+<br>�����շѣ�
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="charge4" name="charge4" value="<?=$row['charge4']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
		 &nbsp; <button class="layui-btn" id="btnSubmit" onClick="return checkuserinfo();">��������</button> 

</table>
</form>
</body>
</html>
