<?php
//echo '΢�Ź�ע���ۺϽ�վ  | ȫ��Դ����ϵͳ ������أ�www.juheshe.cn  2018��9��14�� Se7en QQ:94170844';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ܱ�������</title>
</head>
<body>
<link href="../images/right.css" rel="stylesheet" type="text/css" />
<?php include('../../jhs_config/function.php');?>
<?php
//���뿨
$m=secretCode();
//var_dump($m);
function secretCode($row=8,$col=10){
$width=$col*50+100;
$height=$row*20+100;
//���ɻ�����������ɫ
$img=imagecreate($width,$height);
$bg=imagecolorallocate($img,0x99,0x66,0x00);
$text=imagecolorallocate($img,0,0,0);

//���ɱ��
$src=bianhao();
imagestring($img,4,20,20,$src,$text);
imagettftext($img,18,0,250,30,$text,'hua.ttf','�����');//�������
//����x������
$string='ABCDEFGHIJ';

for($i=0;$i<$col;$i++){
$str=$string[$i];
$x=50+50*$i+25; 
$y=35;
imagechar($img,4,$x,$y,$str,$text);

}

//����y������
for($i=0;$i<$row;$i++){
$x=38;
$y=53+$i*20;
imagechar($img,4,$x,$y,($i+1),$text);


}
//���������������
$array_code=array();
while(count($array_code)<$col*$row){

$int1=mt_rand(0,9);

$int2=mt_rand(0,9);

$int3=mt_rand(0,9);

if($int1!=$int2 or $int2!=$int3 or $int3!=$int1){   

$code=strval($int1.$int2.$int3);
}
array_push($array_code,$code);  //����ѹ��������
array_unique($array_code);  //ɾ���ظ�ֵ,��bug���һ����ֵ���������ж�
}



//ѭ����������
for($i=0;$i<count($array_code);$i++){ 
$intx=$i%10;
if($i%10==0){
$inty=$i/10;
}
$x1=50+50*$intx;
$x2=50+50*($intx+1);
$x3=$x1+15;  
$y1=50+20*$inty;
$y2=50+20*($inty+1);
$y3=$y1+3;
imagerectangle($img,$x1,$y1,$x2,$y2,$text);//���������ο�
imagestring($img,3,$x3,$y3,$array_code[$i],$text);//д������ 
}
//����ͼ�����
$yyy= uniqid("code_").'.png';
$_SESSION['mylo']=$yyy;  

imagepng($img,$yyy);
echo '<img src='.$yyy.'>'; #######���ͼƬ
imagedestroy($img);

//��x��yһ��ѭ�������һ����Ϊ������±꣬�Ա�ȡ��ʹ��

for($j=0;$j<$row;$j++){   //��ѭ��
for($i=0;$i<$col;$i++){  //��ѭ��


$key.=$string[$i].($j+1).'/';//stringΪ���
//// $string[$i].($j+1);      #####��ȡ��ĸ���� ����A1  B1 

}
}
rtrim($key,'/');//�����ַ������#,��������
$key=explode('/',$key);
array_pop($key);//�����Ԫ��
$pwd=array_combine($key,$array_code);
$ClassID= implode(",",$pwd);
$allArray=(explode(',',$ClassID));   
 
for ($i = 0; $i <= 79; $i++) { 
$_SESSION['ch'.$i]=   $allArray[$i];
} 
}

#########��ȡ�ܱ������� �жϸ��û��Ƿ�󶨹��ܱ���

$total=mysql_num_rows(mysql_query("SELECT * FROM `Encrypted_card` where  username='$_SESSION[ysk_number]' ",$conn1));
if ($total!='0'){
########����������滻֮ǰ���ܱ��� ��ɾ�� ֮ǰ�ܱ���ͼƬ
$sql="select * from Encrypted_card where username='$_SESSION[ysk_number]'";   //��ȡ���ݱ�
$zyc=mysql_query($sql,$conn1);  //ִ�и�SQl���
$row=mysql_fetch_array($zyc);
unlink($row['url']); //ɾ��ͼƬ�ļ�
 
$godo=mysql_query("update Encrypted_card set url='$_SESSION[mylo]',A1='$_SESSION[ch0]',B1='$_SESSION[ch1]',C1='$_SESSION[ch2]',D1='$_SESSION[ch3]',E1='$_SESSION[ch4]',F1='$_SESSION[ch5]',G1='$_SESSION[ch6]',H1='$_SESSION[ch7]',I1='$_SESSION[ch8]',J1='$_SESSION[ch9]',A2='$_SESSION[ch10]',B2='$_SESSION[ch11]',C2='$_SESSION[ch12]',D2='$_SESSION[ch13]',E2='$_SESSION[ch14]',F2='$_SESSION[ch15]',G2='$_SESSION[ch16]',H2='$_SESSION[ch17]',I2='$_SESSION[ch18]',J2='$_SESSION[ch19]',A3='$_SESSION[ch20]',B3='$_SESSION[ch21]',C3='$_SESSION[ch22]',D3='$_SESSION[ch23]',E3='$_SESSION[ch24]',F3='$_SESSION[ch25]',G3='$_SESSION[ch26]',H3='$_SESSION[ch27]',I3='$_SESSION[ch28]',J3='$_SESSION[ch29]',A4='$_SESSION[ch30]',B4='$_SESSION[ch31]',C4='$_SESSION[ch32]',D4='$_SESSION[ch33]',E4='$_SESSION[ch34]',F4='$_SESSION[ch35]',G4='$_SESSION[ch36]',H4='$_SESSION[ch37]',I4='$_SESSION[ch38]',J4='$_SESSION[ch39]',A5='$_SESSION[ch40]',B5='$_SESSION[ch41]',C5='$_SESSION[ch42]',D5='$_SESSION[ch43]',E5='$_SESSION[ch44]',F5='$_SESSION[ch45]',G5='$_SESSION[ch46]',H5='$_SESSION[ch47]',I5='$_SESSION[ch48]',J5='$_SESSION[ch49]',A6='$_SESSION[ch50]',B6='$_SESSION[ch51]',C6='$_SESSION[ch52]',D6='$_SESSION[ch53]',E6='$_SESSION[ch54]',F6='$_SESSION[ch55]',G6='$_SESSION[ch56]',H6='$_SESSION[ch57]',I6='$_SESSION[ch58]',J6='$_SESSION[ch59]',A7='$_SESSION[ch60]',B7='$_SESSION[ch61]',C7='$_SESSION[ch62]',D7='$_SESSION[ch63]',E7='$_SESSION[ch64]',F7='$_SESSION[ch65]',G7='$_SESSION[ch66]',H7='$_SESSION[ch67]',I7='$_SESSION[ch68]',J7='$_SESSION[ch69]',A8='$_SESSION[ch70]',B8='$_SESSION[ch71]',C8='$_SESSION[ch72]',D8='$_SESSION[ch73]',E8='$_SESSION[ch74]',F8='$_SESSION[ch75]',G8='$_SESSION[ch76]',H8='$_SESSION[ch77]',I8='$_SESSION[ch78]',J8='$_SESSION[ch79]'  where username='$_SESSION[ysk_number]'",$conn1); 

########��������������һ������
}else{
$mysql="insert into Encrypted_card (id,username,url,A1,B1,C1,D1,E1,F1,G1,H1,I1,J1,A2,B2,C2,D2,E2,F2,G2,H2,I2,J2,A3,B3,C3,D3,E3,F3,G3,H3,I3,J3,A4,B4,C4,D4,E4,F4,G4,H4,I4,J4,A5,B5,C5,D5,E5,F5,G5,H5,I5,J5,A6,B6,C6,D6,E6,F6,G6,H6,I6,J6,A7,B7,C7,D7,E7,F7,G7,H7,I7,J7,A8,B8,C8,D8,E8,F8,G8,H8,I8,J8,time) " . "values ('','$_SESSION[ysk_number]','$_SESSION[mylo]','$_SESSION[ch0]','$_SESSION[ch1]','$_SESSION[ch2]','$_SESSION[ch3]','$_SESSION[ch4]','$_SESSION[ch5]','$_SESSION[ch6]','$_SESSION[ch7]','$_SESSION[ch8]','$_SESSION[ch9]','$_SESSION[ch10]','$_SESSION[ch11]','$_SESSION[ch12]','$_SESSION[ch13]','$_SESSION[ch14]','$_SESSION[ch15]','$_SESSION[ch16]','$_SESSION[ch17]','$_SESSION[ch18]','$_SESSION[ch19]','$_SESSION[ch20]','$_SESSION[ch21]','$_SESSION[ch22]','$_SESSION[ch23]','$_SESSION[ch24]','$_SESSION[ch25]','$_SESSION[ch26]','$_SESSION[ch27]','$_SESSION[ch28]','$_SESSION[ch29]','$_SESSION[ch30]','$_SESSION[ch31]','$_SESSION[ch32]','$_SESSION[ch33]','$_SESSION[ch34]','$_SESSION[ch35]','$_SESSION[ch36]','$_SESSION[ch37]','$_SESSION[ch38]','$_SESSION[ch39]','$_SESSION[ch40]','$_SESSION[ch41]','$_SESSION[ch42]','$_SESSION[ch43]','$_SESSION[ch44]','$_SESSION[ch45]','$_SESSION[ch46]','$_SESSION[ch47]','$_SESSION[ch48]','$_SESSION[ch49]','$_SESSION[ch50]','$_SESSION[ch51]','$_SESSION[ch52]','$_SESSION[ch53]','$_SESSION[ch54]','$_SESSION[ch55]','$_SESSION[ch56]','$_SESSION[ch57]','$_SESSION[ch58]','$_SESSION[ch59]','$_SESSION[ch60]','$_SESSION[ch61]','$_SESSION[ch62]','$_SESSION[ch63]','$_SESSION[ch64]','$_SESSION[ch65]','$_SESSION[ch66]','$_SESSION[ch67]','$_SESSION[ch68]','$_SESSION[ch69]','$_SESSION[ch70]','$_SESSION[ch71]','$_SESSION[ch72]','$_SESSION[ch73]','$_SESSION[ch74]','$_SESSION[ch75]','$_SESSION[ch76]','$_SESSION[ch77]','$_SESSION[ch78]','$_SESSION[ch79]',now())";
}
mysql_query($mysql,$conn1);
mysql_query("update members set power2='1' where number='$_SESSION[ysk_number]'",$conn1); 
function bianhao(){
static $t=17754;
$t++;
}

echo "<br><center><b style='line-height:240%;'>���ֶ����ܱ���ͼƬ���������������������ⶪʧ��</b><br><input id='btnAll' type='button' value='����ر�!'  onClick='cl()' class='tijiao_input' /></center>";
?>

</body>
</Html>

<script>
function cl()
{ 
var win = art.dialog.open.origin;//��Դҳ��
// �����ҳ�����ػ��߹ر����ӶԻ���ȫ����ر�
win.location.reload();
return false; 
window.close(); 
art.dialog.close(); 
}
</script>
<script charset="utf-8" src="/Public/js/artDialog/artDialog.source.js?skin=blue"></script>
<script charset="utf-8"  src="/Public/js/artDialog/plugins/iframeTools.source.js"></script>