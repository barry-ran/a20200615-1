<?php
//echo '̰��㿨���ܽ�վ��ȫ��Դ����ϵͳ ������أ�www.kycard.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}

function sorting($var,$var1,$var2,$var3,$var4){ //--����  �ö��õ�Id  ����Id  ��Ŀ¼  �ϼ����
     if($var3==1){
$url='&mid=1';
}elseif($var3==2){
$url='&mid=2&nav='.$var4;
}
if ($var=='top'){
if ($var1==$var2){
echo "<a title='�ƶ������' class='move top1'></a>";
}else{
echo "<a title='�ƶ������' class='move top' href='?Action=move1&id=$var2$url'></a>";
}
//////////////////////////////////////////////////////////////////////////////////////////�����ö�
}elseif ($var=='up'){
if ($var1==$var2){
echo "<a title='������һ��' class='move up1'></a>";
}else{
echo "<a title='������һ��' class='move up' href='?Action=move2&id=$var2$url'></a>";
}
//////////////////////////////////////////////////////////////////////////////////////////��������һ��
}elseif ($var=='down'){
if ($var1==$var2){
echo "<a title='������һ��' class='move down1'></a>";
}else{
echo "<a title='������һ��' class='move down' href='?Action=move3&id=$var2$url'></a>";
}
//////////////////////////////////////////////////////////////////////////////////////////��������һ��
}elseif ($var=='bottom'){
if ($var1==$var2){
echo "<a title='������һ��' class='move bottom1'></a>";
}else{
echo "<a title='������һ��' class='move bottom' href='?Action=move4&id=$var2$url'></a>";
}
//////////////////////////////////////////////////////////////////////////////////////////��������һ��
}

}
?>