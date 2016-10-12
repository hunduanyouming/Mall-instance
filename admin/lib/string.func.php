<?php
function buildRandomString($image){
	$se_code='';
	for($i=0;$i<4;$i++){
		$size=6;
		$fontcolor=imagecolorallocate($image, rand(0,100), rand(0,100), rand(0,100));
		$date=join(array_merge(range('a','z'),range('A','Z'),range(0,9)));
		$font=substr($date, rand(0,strlen($date)),1);
		$se_code .= $font;
		$x =($i * 80 / 4)+rand(5,10);
		$y = rand ( 1, 5 );
		imagestring ( $image, $size, $x, $y, $font, $fontcolor );
	}
	return $_SESSION ['autocode'] = $se_code;
};

