<?php
//echo '̰��㿨���ܽ�վ��ȫ��Դ����ϵͳ ������أ�www.kycard.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
if(is_uploaded_file($_FILES['upfile']['tmp_name'])){ 
$upfile=$_FILES["upfile"]; 
//-------------------------------------------------��ȡ���������ֵ 
$name=$upfile["name"];//�ϴ��ļ����ļ��� 
$extension=".".get_extension($name);//��ȡ�ϴ��ļ���չ��
$extension=$dingdanhao.$extension; //�����µ��ļ�������
$uploadnames="/upload/".$extension;
$uploadname=str_replace('\site','',$_SERVER['DOCUMENT_ROOT'])."/upload/".$extension;
$type=$upfile["type"];//�ϴ��ļ������� 
$size=$upfile["size"];//�ϴ��ļ��Ĵ�С 
$tmp_name=$upfile["tmp_name"];//�ϴ��ļ�����ʱ���·�� 
//�ж��Ƿ�ΪͼƬ 
switch ($type){ 
case 'image/pjpeg':$okType=true; 
break; 
case 'image/jpeg':$okType=true; 
break; 
case 'image/gif':$okType=true; 
break; 
case 'image/png':$okType=true; 
break; 
} 

if($okType){ 
/** 
* 0:�ļ��ϴ��ɹ�<br/> 
* 1���������ļ���С����php.ini�ļ�������<br/> 
* 2���������ļ��Ĵ�СMAX_FILE_SIZEѡ��ָ����ֵ<br/> 
* 3���ļ�ֻ�в��ֱ��ϴ�<br/> 
* 4��û���ļ����ϴ�<br/> 
* 5���ϴ��ļ���СΪ0 
*/ 
$error=$upfile["error"];//�ϴ���ϵͳ���ص�ֵ 
//$extension �ϴ��ļ�����
//$type      �ϴ��ļ�����
//$size      �ϴ��ļ���С
//$error     �ϴ���ϵͳ���ص�ֵ
//$tmp_name  �ϴ��ļ�����ʱ���·��
//���ϴ�����ʱ�ļ��ƶ���upĿ¼����
move_uploaded_file($tmp_name,$uploadname); 
$upload_results=checkfile($uploadname);//��ȫ����ļ��Ƿ�����
if ($upload_results<>""){
echo "<script language=\"javascript\">alert('����ʧ�ܣ��ϴ��ļ��쳣��');history.go(-1);</script>";
exit();
}elseif($error==0){ 

}elseif ($error==1){ 
echo "<script language=\"javascript\">alert('����ʧ�ܣ��������ļ���С��');history.go(-1);</script>";
exit();
}elseif ($error==2){ 
echo "<script language=\"javascript\">alert('����ʧ�ܣ��������ļ���С��');history.go(-1);</script>";
exit();
}elseif ($error==3){ 
echo "<script language=\"javascript\">alert('����ʧ�ܣ��ļ�ֻ�в��ֱ��ϴ���');history.go(-1);</script>";
exit();
}elseif ($error==4){ 
echo "<script language=\"javascript\">alert('����ʧ�ܣ��ϴ�û���ļ���');history.go(-1);</script>";
exit();
}else{
echo "<script language=\"javascript\">alert('����ʧ�ܣ��ϴ��ļ���СΪ0��');history.go(-1);</script>";
exit();
} 
}else{ 
echo "<script language=\"javascript\">alert('����ʧ�ܣ����ϴ�jpg,gif,png�ȸ�ʽ��ͼƬ��');history.go(-1);</script>";
exit();
} 
} 

?>