<?php

	session_start();
	$src = "images/captcha.png";

	//Imagen origen
	$srcimage = imagecreatefrompng($src);
	imagealphablending($srcimage, true);
	imagesavealpha($srcimage, true);

	$_SESSION['key'] = randomText(6);
	$captcha = imagecreatefrompng("images/captcha.png");
	$colText = imagecolorallocate($srcimage, 255, 239, 128);
	//GENERARA EL CAPTCHA (imagen,font size, angulo, ubicacion en x, ubicacion en y, font, texto)
	imagettftext( $srcimage, 12, 5, 45, 25, $colText, "fonts/VeraBd.ttf",  $_SESSION['key'] );
	header("Content-type: image/png");

	imagepng($srcimage);

	function randomText($length) {
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
		for($i=0;$i<$length;$i++) {
		$key .= $pattern{rand(0,35)};
	}
	return $key;
}

?>