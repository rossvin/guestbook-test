<?php
	session_start();
	$string = "";
	for ($i = 0; $i < 4; $i++)
		$string .= chr(rand(97, 122));
	
	$_SESSION['rand_code'] = $string;


	$image = imagecreatetruecolor(70, 30);
	$black = imagecolorallocate($image, 0, 0, 0);
	$color = imagecolorallocate($image, 200, 100, 90);
	$white = imagecolorallocate($image, 255, 255, 255);

	imagefilledrectangle($image,0,0,399,99,$white);



imagestring($image,5, 10, 5, $_SESSION['rand_code'], $color);
	header("Content-type: image/png");
	imagepng($image);



?>