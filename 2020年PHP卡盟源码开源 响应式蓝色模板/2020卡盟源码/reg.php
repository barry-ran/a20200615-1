
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
include_once('jhs_config/function.php');
?>


<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��Աע��-<?=$site_name?></title>
<meta name="keywords" content="<?=$site_keywords?>">
<meta name="description" content="<?=$site_describe?>">
<link rel="icon" href="http://www.juheshe.cn/ico.png" type="image/png">

    <link href="/templatecss/reg/regstyle/zch_css.css" rel="stylesheet" type="text/css" />
    <script src="/templatecss/reg/regstyle/load.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/js/youxi.reg.js"></script>
	</head>
	<body>
<header class="register-header">
    <div class="wrap clear">
        <ul class="left-logo clear">
            <li><div id="AgentLogo"><a href="/"><img src="<?=$site_logo?>" /></a></div></li>
            <li class="welcome-reg">��ӭע��</li>
        </ul>
        <div class="right-login">
            <p>�����˺�?<a href="/">������¼</a></p>
        </div>
    </div>
</header>
<body class="mainbg" onload = "MyTest()">

<div class="register-content">
	
    <div class="ing">
	        	<form name="userinfo" method="post" runat="server">
<input name="Token" id="Token" type="hidden" value="<?=genToken()?>">

	
        <div class="input-groups">
            <div class="label-groups">
                <label class="left-name">��¼����<span>*</span></label>
                <label class="input-right">
                    <input value="" id="customerName"  name="customerName" type="text" tabindex="1" autocomplete="off" class="Rg_name" type="text" placeholder="��ʹ�������õ��������ע��"  id="txtUsername"/>
                </label>
            </div>
            <div class="register-biref">
                <span class="icoBg biref-x"></span>
                <p>���������Ϊ�գ�</p>
            </div>
</div>
        <div class="input-groups">
            <div class="label-groups">
                <label class="left-name">��¼����<span>*</span></label>
                <label class="input-right">
                    <input value="" id="password"  name="password"  type="text" tabindex="1" autocomplete="off" class="Rg_name" type="text" placeholder="������6-18λӢ��(���ִ�Сд)�����ֵ����"  id="txtUsername"/>
                </label>
            </div>
</div>
       <div class="input-groups">
            <div class="label-groups">
                <label class="left-name">ȷ������<span>*</span></label>
                <label class="input-right">
                    <input value="" id="qrpassword" name="qrpassword" type="text" tabindex="1" autocomplete="off" class="Rg_name" type="text" placeholder="���ٴ�ȷ�ϵ�¼����"  id="txtUsername"/>
                </label>
            </div>
</div>
       <div class="input-groups">
            <div class="label-groups">
                <label class="left-name">��ϵQ Q <span>*</span></label>
                <label class="input-right">
                    <input value="" id="qq"name="qq" type="text" tabindex="1" autocomplete="off" class="Rg_name" type="text" placeholder="������������QQ����"  id="txtUsername"/>
                </label>
            </div>
</div>

				<input id="tradePassword" name="tradePassword" type="hidden"  value="123456"  />
				<input id="qrtradePassword" name="qrtradePassword"  type="hidden"  value="123456" />
				<input id="province" name="province" type="hidden"  value="�л����񹲺͹�" />
				<input id="card" name="card" type="hidden"  value="370280000910000" />
				<input id="company" name="company" type="hidden"  value="ע���û�" />
				<input id="rname" name="rname"  type="hidden"  value="ע���û�" />
				<input id="begtime" name="begtime" type="hidden" value="<?php $now=mktime(); echo $now;?>"/>
				<input id="phone" name="phone"  type="hidden"  value="13777777777" />
				<input id="address" name="address"  type="hidden"  value="δ����" />
			<!--	<input style="width: 20px; border: none;" id="Theme1_Radio_No" type="radio" name="Theme1$ParentID" checked="checked" onClick="ParentIDCheck();">
					<label style="width: 20px;border: none;" for="Theme1_Radio_No">��</label>&nbsp;&nbsp;&nbsp;&nbsp;
					
				<input style="width: 20px; border: none;" id="Theme1_Radio_Yes" type="radio" name="Theme1$ParentID" onClick="ParentIDCheck();">
					<label style="width: 20px;border: none;" for="Theme1_Radio_Yes">��</label>
					
                    
                    <input style="width: 138px;border-color:oranger; border-width:2px;display: none;" type="text" id="agent"  name="agent" value="<?=$_SESSION['youxi']?>"/><span id="chk_agr"> 
					</span>-->
					<input type="hidden" style=" width:auto"  name="checkbox" id="checkbox" onClick="on_hide();" >
<input type="hidden" id="agent" name="agent" style="width: 100px;border-color:oranger; border-width:2px;display: none;" value="<?=$_SESSION['youxi']?>"/><span id="chk_agr"></span>
<script>
function on_hide(){
document.getElementById("agent").style.display = (document.getElementById("checkbox").checked == true) ? "" : "none";
}
</script>
        </div>
        <div class="checkbox-wrap">
            <label><input type="checkbox" checked class="Re_checkbox" checked="checked" id="Agreed" value="0">�Ķ���ͬ��<a href="#art1"  onClick="art.dialog.open('/xy.php', { title: '��Աע��Э��', width: 800, height:500, lock: true, fixed:true,closeFn: function () {location.reload();}});" >��<?=$site_name?> ��վ����Э�顷</a></label>
        </div>
        <div class="register-btn">
            <input id="register_btn" value="����ע��" type="button" class="registerNow btn-yellow" onClick="Register('black')" style=" width:100%; height:45px"></input>
           <div class='loading' id="loading" style="display: none">
<img src='/Public/images/loading.gif' /><span>���Ժ�...</span>
</div>
        </div>
				 
				         <div class="party">
            <p><span class="left"></span>��������½<span class="right"></span></p>
            <ul class="clear">
                <li class="QQ"><a><i class="icon-qq"></i></a></li>
                <li class="WX"><a><i class="icon-weixin"></i></a></li>
            </ul>
        </div>
<input type="hidden" id="register_btn" class="blue_btn" style=" width:124px; height:37px" value="����ע��" onClick="Register('black')" />
<input type="hidden" id="rewrite_btn" class="blue_btn" style=" width:124px; height:37px" value="������д" onClick="regReset()" />

</div>
            </form>
 
   <script>
 function ParentIDCheck(){
if(document.getElementById("Theme1_Radio_No").checked)
{
	document.getElementById("agent").style.display="none";
}
else
{
	document.getElementById("agent").style.display="";
}
}

</script>
 
 
 
 

</div>

 
</body>
</html>
<script language = "javascript">
//��������ʡ���µĳ�������
var cityArr = new Array();
cityArr["����"] = new Array("������");
cityArr["���"] = new Array("�����");
cityArr["�Ϻ�"] = new Array("�Ϻ���");
cityArr["����"] = new Array("������");
cityArr["�ӱ�"] = new Array("ʯ��ׯ��","������","������","�ػʵ���","�żҿ���","��ɽ��","�е���","�ȷ���","������","��ˮ��","��̨��");
cityArr["ɽ��"] = new Array("̫ԭ��","�ٷ���","��ͬ��","�˳���","������","������","������","��Ȫ��","������","������","˷����","�����","������");
cityArr["���ɹ�"] = new Array("���ͺ���","��ͷ","���","������˹","ͨ��","���ױ���","�����׶���","�����첼","���ֹ�����","�˰���","�ں�","��������","������");
cityArr["����"] = new Array("����","����","��ɽ","����","��˳","Ӫ��","�̽�","����","����","����","��Ϫ","��«��","����","����","ׯ��","�߷���");
cityArr["����"] = new Array("����","����","��ƽ","�ӱ�","��ԭ","�׳�","ͨ��","��ɽ","��Դ");
cityArr["������"] = new Array("������","����","�������","ĵ����","�绯","��ľ˹","����","˫Ѽɽ","�׸�","�ں�","����","��̨��","���˰���");
cityArr["����"] = new Array("����","�Ͼ�","����","����","����","��ͨ","����","�γ�","����","���Ƹ�","̩��","��Ǩ","��","����","���");
cityArr["�㽭"] = new Array("����","����","����","��","����","̨��","����","����","��ˮ","����","��ɽ","����","��","����");
cityArr["����"] = new Array("�Ϸ�","�ߺ�","����","����","����","����","����","����","����","����","��ɽ","ͭ��","����","����","��ɽ","����","����","����","����","ͩ��");
cityArr["����"] = new Array("����","����","Ȫ��","����","����","����","����","��ƽ","����","����ɽ");
cityArr["����"] = new Array("�ϲ�","����","�Ž�","�˴�","����","����","Ƽ��","����","������","����","ӥ̶","����");
cityArr["ɽ��"] = new Array("�ൺ","����","��̨","Ϋ��","����","�Ͳ�","����","̩��","�ĳ�","����","��ׯ","����","����","��Ӫ","����","����","����","����","����","���");
cityArr["����"] = new Array("֣��","����","����","����","���","ƽ��ɽ","����","����","����","����","���","�ܿ�","����","פ���","���","����Ͽ","�ױ�","��Դ","����","۳��","����","����");
cityArr["����"] = new Array("�人","�˲�","����","����","ʮ��","��ʯ","Т��","�Ƹ�","��ʩ","����","����","����","����","Ǳ��","����","����","��ũ��");
cityArr["����"] = new Array("��ɳ","����","����","����","����","��̶","����","����","����","����","����","¦��","����","�żҽ�");
cityArr["�㶫"] = new Array("����","����","��ݸ","��ɽ","��ɽ","�麣","����","����","��ͷ","տ��","����","ï��","����","÷��","��Զ","����","�ع�","��Դ","�Ƹ�","��β","����","̨ɽ","����","˳��");
cityArr["����"] = new Array("����","����","����","����","����","����","���","����","��ɫ","�ӳ�","����","����","���Ǹ�","����");
cityArr["����"] = new Array("����","��ָɽ","��","�Ĳ�","����","����","����","�Ͳ�","����","�ٸ�","��ɳ","����","�ֶ�","��ˮ","��ͤ","����","��ɳ","��ɳ","��ɳ","����","����");
cityArr["�Ĵ�"] = new Array("�ɶ�","����","����","�ϳ�","�˱�","�Թ�","��ɽ","����","����","�ڽ�","����","��֦��","üɽ","�㰲","����","��ɽ","��Ԫ","�Ű�","����","����","����");
cityArr["����"] = new Array("����","����","ǭ����","ǭ��","����ˮ","�Ͻ�","ͭ��","��˳","ǭ����");
cityArr["����"] = new Array("����","����","����","���","��Ϫ","����","��ɽ","����","��˫����","��ͨ","�º�","�ն�","��ɽ","�ٲ�","����","ŭ��");
cityArr["����"] = new Array("����","�տ���","ɽ��","��֥","����","����","����");
cityArr["����"] = new Array("����","����","����","μ��","����","����","�Ӱ�","����","����","ͭ��");
cityArr["����"] = new Array("����","��ˮ","����","����","ƽ��","��Ȫ","��Ҵ","����","����","���","¤��","����","������","����");
cityArr["�ຣ"] = new Array("����","����","����","����","����","����","����","����");
cityArr["����"] = new Array("����","����","ʯ��ɽ","����","��ԭ");
cityArr["�½�"] = new Array("��³ľ��","��������","��³��","����","����","����","������","��ʲ","��������","�¶�����","��������","��������","����","������","����","����̩","�����","ʯ����","������","ͼľ���","�����");
cityArr["��������"] = new Array("���","����","̨��");

//дһ����ѯ��Ŀ�꺯��
function test(){
//�ҵ���Ӧ��ʡ�ݺͳ���
var provinces = document.getElementById("province");
var citys = document.getElementById("city");
//���
citys.length = 0;
//ʹ��Ƕ��ѭ���ҵ�ʡ��˵��Ӧ�ĳ���
for(var i in cityArr){
//ѭ��ʡ�����������value����
if(i==provinces.value){
//���ȷ���Ǹ�ʡ���µĳ��У���ôѭ������
for(var j in cityArr[i]){
//
citys.add(new Option(cityArr[i][j],cityArr[i][j]));
}
}
}
}
//дһ�������������
function MyTest(){
//�ҵ�������������ID
var province = document.getElementById("province");
for(var i in cityArr){
province.add(new Option(i,i));
}
}
</script>

<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>