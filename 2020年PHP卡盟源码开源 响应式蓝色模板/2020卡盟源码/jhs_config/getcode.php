<?php
//echo '̰��㿨���ܽ�վ��ȫ��Դ����ϵͳ ������أ�www.kycard.cn  2018��9��14�� Se7en QQ:94170844';
?>
<?php
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}
session_start();               //Ϊ�˽���֤���ֵ������$_SESSION��
	//ͼ���
	$height="21";
	//ͼ���
	$width="60";
	
	//����·��
	$font_name = "arial.ttf";
	//���ִ�С
	$font_size = 14;
	$font_angle = rand(-2,2) ;
	
	//������֤��
    $str = "abcdehkmnsuvwxz2345689";
    $code = '';
    for ($i = 0; $i < 4; $i++) {
        $code .= $str[mt_rand(0, strlen($str)-1)]."|";
    }
	$text=explode("|",$code);
	$code=implode("",$text);
	
	//���ּ��
	$font_spacing = 3;
	// X������
	$position_x = 6;
	//Y������
	$position_y = 19;
	$font_shade_spacing_x = 1;
	$font_shade_spacing_y = 1;
	
	
    // ��ͼ��
	$im = imagecreatetruecolor($width, $height);
    // ����Ҫ�õ�����ɫ
	$back_color = imagecolorallocate($im, 246, 251, 254);
    $boer_color = imagecolorallocatealpha($im, 0, 0, 0, 127);
    $text_color = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120)); 
    // ������
	imagefilledrectangle($im, 0, 0, $width, $height, $back_color); 

	// �����ŵ�
    for($i = 0;$i < 60;$i++) {
        $font_color = imagecolorallocate($im, 227, 231, 230);
        imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $font_color);
    }

	// ȡ��ÿһ���ַ���Weight
	$font_coordinate = imagettfbbox ( $font_size, $font_angle, $font_name, $text[0] );
	$font_weight = $font_coordinate[2] - $font_coordinate[0];
	$font_height = abs($font_coordinate[5]) - $font_coordinate[3];


	// ����֤��
	for($count = 0  ; $count<=count($text) ; $count++){
		imagettftext($im, $font_size, rand(-3,4) , $position_x-$font_shade_spacing_x , $position_y-$font_shade_spacing_y, $text_color, 'arial.ttf', $text[$count]);
		$position_x = $position_x + $font_weight + $font_spacing;
		if($position_x>=50){
			$position_x=48;
		};
	};
	
	
	//������
	$j1=rand(4,8);
	$y2=rand(2,3);
	$y3=rand(9,11);
	for($j=rand(-20,0);$j<80;$j+=1){
    	$x1 = $j/$j1;
    	$y1 = sin($x1);
    	$y1 = $y3 + $y2*$y1;
    	imagesetpixel($im,$j,$y1,$text_color);
	}	

	
	header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
	header("Content-type: image/png;charset=utf-8");
	imagepng($im);
	imagedestroy($im);
	
	$_SESSION['checkCode']=$code; 
?>