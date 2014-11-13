<?php
	session_start();
	$src = "images/captcha.png";

	//Imagen origen
	$srcimage = imagecreatefrompng($src);
	imagealphablending($srcimage, true);
	imagesavealpha($srcimage, true);

	$_SESSION['key'] = randomText(6);
	$captcha = imagecreatefrompng("images/captcha.png");
	$colText = imagecolorallocate($srcimage, 249, 239, 128);
	imagestring($srcimage, 5, 45, 7, $_SESSION['key'], $colText);
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