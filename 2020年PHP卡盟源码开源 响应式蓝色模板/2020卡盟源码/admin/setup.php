
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>�ۺ��翨�˺�̨����ϵͳ - Powered by �ۺ���</title>
<link rel="stylesheet" href="css/layui.css" media="all">
<link rel="stylesheet" href="css/admin.css" media="all">
<script charset="utf-8" src="/Public/yoxi_editor/kindeditor.js"></script>
<script charset="utf-8" src="/Public/yoxi_editor/lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#editor_id');
});

</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image3').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url3').val(),
clickFn : function(url, title, width, height, border, align) {
K('#url3').val(url);
editor.hideDialog();
}
});
});
});
});
</script>
<script>
KindEditor.ready(function(K) {
var editor = K.editor({
allowFileManager : true
});

K('#image4').click(function() {
editor.loadPlugin('image', function() {
editor.plugin.imageDialog({
showRemote : false,
imageUrl : K('#url4').val(),
clickFn : function(url, title, width, height, border, align) {
K('#url4').val(url);
editor.hideDialog();
}
});
});
});
});
</script>

</head>
<body layadmin-themealias="default">
<?php
include('../jhs_config/function.php');
include('../jhs_config/admin_check.php');
$Action=strip_tags($_GET['Action']);
$sql=mysql_query("select * from site_config  where id='1'",$conn1);
$row=mysql_fetch_array($sql);

$st_sql="select * from sup_members_site where number='$sup_number'";   //��ȡ���ݱ�
$st_zyc=mysql_query($st_sql,$conn2);  //ִ�и�SQl���
$st_row=mysql_fetch_array($st_zyc);
if ($Action=="save"){
$site_template=strip_tags($_POST['site_template']);
$site_agent=strip_tags($_POST['site_agent']);
$site_name=strip_tags($_POST['site_name']);
$site_title=strip_tags($_POST['site_title']);
$site_url=strip_tags($_POST['site_url']);
$cardpay_url=strip_tags($_POST['cardpay_url']);
$wap_url=strip_tags($_POST['wap_url']);
$site_logo=strip_tags($_POST['site_logo']);
$site_describe=strip_tags($_POST['site_describe']);
$site_keywords=strip_tags($_POST['site_keywords']);
$site_menu=strip_tags($_POST['site_menu']);
$begtime=$_POST['begtime'];
$site_copyright=$_POST['site_copyright'];
$moneytype=$_POST['moneytype'];
$login_reg=$_POST['login_reg'];
$api_qq=$_POST['api_qq'];
$catalogue=$_POST['catalogue'];
$ProductRecommend=$_POST['ProductRecommend'];
$themecode=$_POST['themecode'];
$themecolor=$_POST['themecolor'];
$javascript=$_POST['javascript'];

if ($row['begtime']<>$shop_sort){
ysk_date_log(6,$_SESSION['ysk_username'],'�޸�����վ��Ϣ');//--------------------ִ�в�����־
}


mysql_query("update site_config set site_template='$site_template',site_agent='$site_agent',site_name='$site_name',site_title='$site_title',site_url='$site_url',cardpay_url='$cardpay_url',wap_url='$wap_url',site_logo='$site_logo',site_describe='$site_describe',site_keywords='$site_keywords',site_menu='$site_menu',site_copyright='$site_copyright',moneytype='$moneytype',login_reg='$login_reg',catalogue='$catalogue',ProductRecommend='$ProductRecommend',javascript='$javascript' where id=1",$conn1); 

echo "<script>alert('�޸ĳɹ�!');self.location=document.referrer;</script>";
}

?>
<div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header">��վ��Ϣ����ϵͳ - Powered by <a href="http://www.juheshe.cn" target="_blank">�ۺ���</a></div>
	  <div class="layui-card-body" style="padding: 15px;">
<form class="layui-form" name="add" method="post" action="?Action=save&id=1" >
		<input hidden type="text" id="begtime" name="begtime" value="<?php $now=mktime(); echo $now;?>">
 
			            <div class="layui-form-item">
              <label for="moneytype" class="layui-form-label">
                  ���Ҹ�ʽ��
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="moneytype" name="moneytype" value="<?=$row['moneytype']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
			  
			           <div class="layui-form-item">
              <label class="layui-form-label">
                  ��վģ�棺
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="site_template" name="site_template" value="<?=$row['site_template']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
			   <div class="layui-form-mid layui-word-aux">
                  �밴������ģ�������ã���Ż��ļ�����
              </div>
          </div>
		             <div class="layui-form-item">
              <label class="layui-form-label">
                  ע���ϼ���
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="site_agent" name="site_agent" value="<?=$row['site_agent']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
			   <div class="layui-form-mid layui-word-aux">
                  ���û�ע��ʱĬ�ϵ��ϼ����
              </div>
          </div>
		       <div class="layui-form-item">
              <label class="layui-form-label">
                  ��վ���ƣ�
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="site_name" name="site_name" value="<?=$row['site_name']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
		  <div class="layui-form-item">
              <label class="layui-form-label">
                  SEO���⣺
              </label>
              <div class="layui-input-block">
                  <input type="text" id="site_title" name="site_title" value="<?=$row['site_title']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
		  		  <div class="layui-form-item">
              <label class="layui-form-label">
                  ��վ��ַ��
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="site_url" name="site_url" value="<?=$row['site_url']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
			  	<div class="layui-form-mid layui-word-aux">
                  ���û�ע��ʱ�Ὣ����ַ���͵��û����䣬���������ע�ᡰʧ�ܡ�
              </div>
          </div>
		    		  <div class="layui-form-item">
              <label class="layui-form-label">
                  ��ֵ��ַ��
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="cardpay_url" name="cardpay_url" value="<?=$row['cardpay_url']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
			  	<div class="layui-form-mid layui-word-aux">
                  ǰ̨�û���ֵ����ֵҳ�����ʾ�ĳ�ֵ��������ַ
              </div>
          </div>
		  <div class="layui-form-item">
              <label class="layui-form-label">
                  SEO������
              </label>
              <div class="layui-input-block">
                  <input type="text" id="site_describe" name="site_describe" value="<?=$row['site_describe']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
		  		  <div class="layui-form-item">
              <label class="layui-form-label">
                  �ؼ��֣�
              </label>
              <div class="layui-input-block">
                  <input type="text" id="site_keywords" name="site_keywords" value="<?=$row['site_keywords']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
		  		  		  <div class="layui-form-item">
              <label class="layui-form-label">
                  LOGO��
              </label>
              <div class="layui-col-md5">
                  <input type="text" id="url3" name="site_logo" value="<?=$row['site_logo']?>" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
			  	<div class="layui-input-inline">
                  &nbsp;  <button type="button" class="layui-btn uploadlogo"  id="image3" >�ϴ�Logo</button><input class="layui-upload-file" type="file"  id="image3" >
                </div>
          </div>
		  
		  		  		  <div class="layui-form-item">
              <label class="layui-form-label">
                ����������
              </label>
              <div class="layui-col-md4">
<textarea name="site_menu" class="layui-textarea"><?=$row['site_menu']?></textarea>
          </div>
		  <div class="layui-input-inline">
                 һ��һ�����˵�������URL֮���ö���(��)����
                </div>
		  </div>
		  	  		  <div class="layui-form-item">
              <label class="layui-form-label">
                 �ײ���Ȩ��
              </label>
              <div class="layui-col-md4">
<textarea name="site_copyright" class="layui-textarea"><?=$row['site_copyright']?></textarea>
          </div>
		  </div>
		  		  <div class="layui-form-item">
              <label class="layui-form-label">
                  ע��Э�飺
              </label>
              <div class="layui-col-md4">
<textarea name="login_reg" class="layui-textarea"><?=$row['login_reg']?></textarea>
          </div>
		  </div>
		    <div class="layui-form-item">
              <label class="layui-form-label">
                  ��Ʒ�Ƽ���
              </label>
              <div class="layui-col-md4">
<textarea id="editor_id" cols="80" rows="16" style="width:700px;height:300px;" name="ProductRecommend" class="layui-textarea"><?=$row['ProductRecommend']?></textarea>
          </div>
		  </div>
		  <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" id="btnSubmit" onClick="return checkuserinfo();"lay-submit="" lay-filter="component-form-element">�ύ����</button>
                </div>
              </div>
</form>
</div>
		  </div>
		  </div>
		  </div>
		  </div>
		  </div>
		  </div>
</body>
</Html>
<script src="https://www.layui.com/admin/std/dist/layuiadmin/layui/layui.js"></script>
<SCRIPT LANGUAGE="JavaScript">
function checkuserinfo(){
if (document.add.login_prompt.value.length>200){
alert("�Բ�������ϵͳ��¼����ʾ���ܳ���200����Ŷ!");
document.add.login_prompt.focus();
return false;
}
}
function checkspace(checkstr) {
var str = '';
for(i = 0; i < checkstr.length; i++) {
str = str + ' ';
}
return (str == checkstr);
}
//-->
</script>