var customerName = ""; //��¼����

//�����û����Ƿ����
function chkNameIsExist() {
var name = $("#customerName").attr("value");
var result = name.match(/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/);
if ($.trim(name) == "") {
customerName = "<font color=red>���û�������Ϊ��</font>";
}
else if (result == null) {
customerName = "<font color=red>����ȷ��ʹ�ø����䣿</font>";
}
else {
var datas = "Method=checkCustomerName&customerName=" + name;
$.ajax({
url: "/ajax.php",
type: "post",
data: datas,
dataType:"json",
success: function (result) {

if (result== "1") {
customerName = "<font color=red>���������Ѿ�����</font>";
}else {
customerName = "OK";
}
},
error: function (ex) {
alert(ex);
},
cache: false,
async: false
});
}
}

/////////////////////////////////////////��֤�ϼ�����
function check_agent() {
var agent = $("#agent").attr("value");
if ($.trim(agent)=="" && document.getElementById("checkbox").checked == false) {
agentid = "OK";
}else{
var datas = "Method=checkagent&agent=" + agent;
$.ajax({
url: "/ajax.php",
type: "post",
data: datas,
dataType:"json",
success: function (result) {
if (result== "2") {
agentid = "<font color=red>���Ҳ������ϼ�</font>";
}else{
agentid = "OK";
}
},
error: function (ex) {
alert(ex);
},
cache: false,
async: false
});
}

}



////////////////////////////////////////////////�����ʽ�Ƿ���ȷ
function check_pwd() {
var pwd = $("#password").val();
var result = pwd.match(/^([a-z]|[A-Z]|[0-9]){6,18}$/);
if (result == null) {
password = "<font color=red>��������6-30λ�����ֻ���ĸ</font>";
return false;
} else {
password = "OK";
return true;
}
}
////////////////////////////////////////////////��������ĵ�¼�����Ƿ�һ��
function pwdIsSame() {
var pwd = $("#password").val();
var conFirmPwd = $("#qrpassword").val();
var result = conFirmPwd.match(/^([a-z]|[A-Z]|[0-9]){6,30}$/);
if (pwd == conFirmPwd && conFirmPwd != "" && result != null) {
confirmPassword = "OK";
return true;
}
else {
confirmPassword = "<font color=red>�����벻һ�»��ʽ����ȷ</font>";
return false;
}
}



////////////////////////////////////////////////���������ʽ�Ƿ���ȷ
function checkTradePwd() {
var pwd = $("#tradePassword").val();
var result = pwd.match(/^([a-z]|[A-Z]|[0-9]){6,30}$/);
if (result == null) {
tradePassword = "<font color=red>��������6-30λ�����ֻ���ĸ</font>";
return false;
} else {
tradePassword = "OK";
return true;
}
}

//�������뽻�������Ƿ����
function TradePwdIsSame() {
var tradePwd = $("#tradePassword").val();
var tradeConFirmPwd = $("#qrtradePassword").val();
var result = tradeConFirmPwd.match(/^([a-z]|[A-Z]|[0-9]){6,30}$/);
if (tradePwd == tradeConFirmPwd && tradeConFirmPwd != "" && result != null) {
tradePassword = "OK";
return true;
}
else {
tradePassword = "<font color=red>���������벻һ�»��ʽ����ȷ<font>";
return false;
}
}





//��֤��˾����
function checkcompany() {
var company = $("#company").val();
if (company != "") {
var result = company.match(/^([\u4E00-\u9FA5]){2,20}$/);
if (result == null) {
contactcompany = "<font color=red>����˾��ʽ���Ϸ�,������2����������</font>";
return false;
}
else {
contactcompany = "OK";
return true;
}
}
else {
contactcompany = "<font color=red>����˾���Ʋ���Ϊ�գ�</font>";
return false;
}
}

//��֤��������
function checkChiName() {
var chiName = $("#rname").val();
if (chiName != "") {
var result = chiName.match(/^([\u4E00-\u9FA5]){2,4}$/);
if (result == null) {
contactName = "<font color=red>��������ʽ���Ϸ�,������2-4������</font>";
return false;
}
else {
contactName = "OK";
return true;
}
}
else {
contactName = "<font color=red>����������Ϊ�գ�</font>";
return false;
}
}


//��֤���֤
function checkPCard() {
var pCard = $("#card").val();
if (pCard != "") {
var result = pCard.match(/^(\d{14}|\d{17})(\d|[xX])$/);
if (result == null) {
identityCard = "<font color=red>�����֤��ʽ���Ϸ�,������15��18λ���֣�</font>";
return false;
}
else {
identityCard = "OK";
return true;
}
}
else {
identityCard = "<font color=red>�����֤����Ϊ�գ�</font>";
return false;
}
}

//��֤QQ
function checkQQ() {
var qq = $("#qq").val();
var result = qq.match(/^\d{5,}$/);
if (result == null) {
myQQ = "<font color=red>��������Ч��QQ����</font>";
return false;
}
else {
myQQ = "OK";
return true;
}
}

//��֤11λ�绰����
function checkMobile() {
var mobile = $("#phone").val();
/*�й��ƶ�ӵ�к����Ϊ:139,138,137,136,135,134,159,158,157(3G),151,152,150,188(3G),183,187(3G),188;15���Ŷ�
�й���ͨӵ�к����Ϊ:130,131,132,155,156(3G),186(3G),185(3G);7���Ŷ�
�й�����ӵ�к����Ϊ:133,153,189(3G),180(3G);4�������*/
var result = mobile.match(/^1(([3][456789])|([5][012789])|([8][2378]))[0-9]{8}$/);
result = result || mobile.match(/^1(([3][012])|([5][56])|([8][56]))[0-9]{8}$/);
result = result || mobile.match(/^1(([3][3])|([5][3])|([8][09]))[0-9]{8}$/);
if (result == null) {
myMobile = "<font color=red>���ֻ������ʽ���Ϸ�</font>";
return false;
}
else {
myMobile = "OK";
return true;
}
}


function check_area() {
if ($("#province").val() =="") {
Salesarea="<font color=red>����ѡ��<font>";
return false;
}else {
Salesarea = "OK";
return true;
}
}

//--------------ע��Э�鸴ѡ��״̬���---------------------//
function check_agreement(){
if (document.userinfo.Agreed.checked==false){
registration="<font color=red>�빴ѡ<font>";
return false;
}else if(document.userinfo.Agreed.checked==true){
registration = "OK";
return true;
}
}


$(function () {
////////////////////////////////////////////////////////////////////////////////////////////////////////��֤�û���
//-------------------------------------------ѡ��״̬
$("#customerName").focus(function(){
if ($(this).val() =="") {
chk_use.innerHTML="<font color=green>����д���ĵ�¼����</font>";
}else{
chk_use.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#customerName").blur(function(){
chkNameIsExist();
if (customerName == "OK") {
chk_use.innerHTML="<font color=green>��</font>";
} else {
chk_use.innerHTML=customerName;
}
});		

////////////////////////////////////////////////////////////////////////////////////////////////////////��֤�û��� The End

////////////////////////////////////////////////////////////////////////////////////////////////////////��֤��Ա���� The Start
$("#password").focus(function(){
if ($(this).val() =="") {
chk_pwd.innerHTML="<font color=green>����������</font>";
}else{
chk_pwd.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#password").blur(function(){
check_pwd();
if (password == "OK") {
chk_pwd.innerHTML="<font color=green>��</font>";
} else {
chk_pwd.innerHTML=password;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////��֤��Ա���� The End


////////////////////////////////////////////////////////////////////////////////////////////////////////ȷ�ϻ�Ա���� The Start
$("#qrpassword").focus(function(){
if ($(this).val() =="") {
chk_qrpwd.innerHTML="<font color=green>���ٴ���������</font>";
}else{
chk_qrpwd.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#qrpassword").blur(function(){
pwdIsSame();
if (confirmPassword == "OK") {
chk_qrpwd.innerHTML="<font color=green>��</font>";
} else {
chk_qrpwd.innerHTML=confirmPassword;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////ȷ�ϻ�Ա���� The End


////////////////////////////////////////////////////////////////////////////////////////////////////////��֤��Ա�������� The Start
$("#tradePassword").focus(function(){
if ($(this).val() =="") {
chk_tdpwd.innerHTML="<font color=green>����������</font>";
}else{
chk_tdpwd.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#tradePassword").blur(function(){
checkTradePwd();
if (tradePassword == "OK") {
chk_tdpwd.innerHTML="<font color=green>��</font>";
} else {
chk_tdpwd.innerHTML=tradePassword;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////��֤��Ա�������� The End


////////////////////////////////////////////////////////////////////////////////////////////////////////ȷ�ϻ�Ա���� The Start
$("#qrtradePassword").focus(function(){
if ($(this).val() =="") {
chk_qrtdpwd.innerHTML="<font color=green>���ٴ���������</font>";
}else{
chk_qrtdpwd.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#qrtradePassword").blur(function(){
TradePwdIsSame();
if (tradePassword == "OK") {
chk_qrtdpwd.innerHTML="<font color=green>��</font>";
} else {
chk_qrtdpwd.innerHTML=tradePassword;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////ȷ�ϻ�Ա���� The End


////////////////////////////////////////////////////////////////////////////////////////////////////////ѡ���������� The Start
$("#province").focus(function(){
if ($(this).val() =="") {
chk_area.innerHTML="<font color=green>��ѡ����������</font>";
}else{
chk_area.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#province").blur(function(){
if ($(this).val() =="") {
chk_area.innerHTML="<font color=red>����ѡ����������</font>";
}else{
chk_area.innerHTML="<font color=green>��</font>";	
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////ѡ���������� The End

////////////////////////////////////////////////////////////////////////////////////////////////////////��֤��˾���� The Start
$("#company").focus(function(){
if ($(this).val() =="") {
chk_company.innerHTML="<font color=green>�����빫˾����</font>";
}else{
chk_company.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#company").blur(function(){
checkcompany();
if (contactcompany == "OK") {
chk_company.innerHTML="<font color=green>��</font>";
} else {
chk_company.innerHTML=contactcompany;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////��֤��˾���� The End

////////////////////////////////////////////////////////////////////////////////////////////////////////��֤�������� The Start
$("#rname").focus(function(){
if ($(this).val() =="") {
chk_rname.innerHTML="<font color=green>�����뱾����ʵ����</font>";
}else{
chk_rname.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#rname").blur(function(){
checkChiName();
if (contactName == "OK") {
chk_rname.innerHTML="<font color=green>��</font>";
} else {
chk_rname.innerHTML=contactName;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////��֤�������� The End

////////////////////////////////////////////////////////////////////////////////////////////////////////��֤���֤ The Start
$("#card").focus(function(){
if ($(this).val() =="") {
chk_card.innerHTML="<font color=green>�����뱾����ʵ���֤����</font>";
}else{
chk_card.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#card").blur(function(){
checkPCard();
if (identityCard == "OK") {
chk_card.innerHTML="<font color=green>��</font>";
} else {
chk_card.innerHTML=identityCard;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////��֤���֤ The End

////////////////////////////////////////////////////////////////////////////////////////////////////////��֤QQ The Start
$("#qq").focus(function(){
if ($(this).val() =="") {
chk_qicq.innerHTML="<font color=green>��������ʵQQ����</font>";
}else{
chk_qicq.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#qq").blur(function(){
checkQQ();
if (myQQ  == "OK") {
chk_qicq.innerHTML="<font color=green>��</font>";
} else {
chk_qicq.innerHTML=myQQ;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////��֤QQ The End


////////////////////////////////////////////////////////////////////////////////////////////////////////��֤�ֻ� The Start
$("#phone").focus(function(){
if ($(this).val() =="") {
chk_phone.innerHTML="<font color=green>������д���Ժ�������ȡ����ϵ���ֻ�����</font>";
}else{
chk_phone.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#phone").blur(function(){
checkMobile();
if (myMobile  == "OK") {
chk_phone.innerHTML="<font color=green>��</font>";
} else {
chk_phone.innerHTML=myMobile;
}
});	
////////////////////////////////////////////////////////////////////////////////////////////////////////��֤�ֻ� The End

////////////////////////////////////////////////////////////////////////////////////////////////////////��֤���� The Start
//-------------------------------------------ѡ��״̬
$("#agent").focus(function(){
if ($(this).val() =="") {
chk_age.innerHTML="<font color=green>����д�����ϼ����</font>";
}else{
chk_age.innerHTML="<font color=green>��Ҫ������д��</font>";	
}
});
//-------------------------------------------�뿪״̬
$("#agent").blur(function(){
check_agent();
if (agentid == "OK") {
chk_age.innerHTML="<font color=green>�� </font>";
} else {
chk_age.innerHTML=agentid;
}
});		

////////////////////////////////////////////////////////////////////////////////////////////////////////��֤���� The End




});




//�ύ����֤
function checkAll() {
if (customerName == "OK" && check_pwd() && pwdIsSame() && checkTradePwd() && TradePwdIsSame() && check_area() && checkcompany() && checkChiName() && checkPCard() && checkQQ() && checkMobile() && check_agreement()  && agentid=="OK" ) {
return true;
}else {
return false;
}
}

function Register(style) {
chkNameIsExist();
if (customerName != "OK")
chk_use.innerHTML=customerName;

check_pwd();
if (password !="OK")
chk_pwd.innerHTML=password;

pwdIsSame();
if (confirmPassword != "OK")
chk_qrpwd.innerHTML=confirmPassword;

checkTradePwd();
if (tradePassword != "OK")
chk_tdpwd.innerHTML=tradePassword;

TradePwdIsSame();
if (tradePassword != "OK")
chk_qrtdpwd.innerHTML=tradePassword;

check_area();
if (Salesarea != "OK")
chk_area.innerHTML="<font color=red>����ѡ����������</font>";

checkcompany();
if (contactcompany != "OK")
chk_company.innerHTML=contactcompany;

checkChiName();
if (contactName != "OK")
chk_rname.innerHTML=contactName;

checkPCard();
if (identityCard != "OK")
chk_card.innerHTML=identityCard;

checkQQ();
if (myQQ != "OK")
chk_qicq.innerHTML=myQQ;



checkMobile();
if (myMobile != "OK")
chk_phone.innerHTML=myMobile;

check_agreement();
if (registration != "OK")
chk_agr.innerHTML=registration;

check_agent();
if (agentid!="OK")
chk_age.innerHTML=agentid;


if (checkAll() == false) {
return;
}


document.getElementById("register_btn").style.display = "none";
document.getElementById("rewrite_btn").style.display = "none";
document.getElementById("loading").style.display = "inline";

var datas = "Method=Check_Reg_email&customerName=" + $("#customerName").attr("value") + "&password=" + $("#password").attr("value") + "&tradePassword=" + $("#tradePassword").attr("value")  + "&province=" + $("#province").attr("value") + "&city=" + $("#city").attr("value") + "&company=" + encodeURIComponent($("#company").attr("value")) + "&rname=" + encodeURIComponent($("#rname").attr("value")) + "&card=" + $("#card").attr("value") + "&qq=" + $("#qq").attr("value") + "&phone=" + $("#phone").attr("value") + "&address=" + $("#address").attr("value") + "&agent=" + $("#agent").attr("value") + "&begtime=" + $("#begtime").attr("value") + "&Token=" + $("#Token").attr("value");
$.ajax({
url: "/Public/youxi_ajax.php",
type: "post",
data: datas,
dataType: "json",
success: function (result) {
if        (result == "1") {
location.href = "regok.php?msg="+ $("#customerName").attr("value");
}else if (result == "2"){
alert('����ʧ�ܣ��ʼ�����ʧ��!�������������Ƿ���ȷ!');window.location='reg.php';
}else if (result == "3"){
alert('����ʧ�ܣ����е�����û����ȷ��д!');window.location='reg.php';
}else if (result == "404"){
alert('����ʧ�ܣ��������ظ�ע��!');window.location='reg.php';
}else if (result == "405"){
alert('����ʧ�ܣ���֤����!');window.location='reg.php';
} 

},
error: function (ex) {
console.log(ex);
},
cache: false
});
}