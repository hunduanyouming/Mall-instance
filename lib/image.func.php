<?php
session_start ();
require_once 'string.func.php';
//创建画布
$width=80;
$height=28;
$image=imagecreatetruecolor($width, $height);
//创建白色
$color=imagecolorallocate($image, 255, 255, 255);
//输出随机数
imagefill ( $image, 0, 0, $color );
//输出随机数
buildRandomString($image);
//增加点干扰
for($i = 0; $i < 150; $i ++) {
	$pointcolor = imagecolorallocate ( $image, rand ( 80, 220 ), rand ( 80, 220 ), rand ( 80, 220 ) );
	imagesetpixel ( $image, rand ( 1, 99 ), rand ( 1, 29 ), $pointcolor );
}
// 添加干扰线
for($i = 0; $i < 3; $i ++) {
	$linecolor = imagecolorallocate ( $image, rand ( 110, 240 ), rand ( 110, 240 ), rand ( 110, 240 ) );
	imageline ( $image, rand ( 1, 99 ), rand ( 1, 29 ), rand ( 1, 99 ), rand ( 1, 29 ), $linecolor );
};
// 输出的是一个什么文件
header ( "content-type:image/png" );
// 输出
imagepng ( $image );
// 销毁内存中的图片
imagedestroy ( $image );

