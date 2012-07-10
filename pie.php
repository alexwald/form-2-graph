<?php
	for ($i=0; $i < count($_POST['item']); $i++){
		$item[$i]  = $_POST['item'][$i];
		$amount[$i]= $_POST['amount'][$i];
		$color[$i] = $_POST['color'][$i];
	}

	$image      = imagecreatetruecolor(300, 300+15*count($item));

	for ($i = 0; $i < count($item); $i++) {
		if (strlen($color[$i])==7)	{ 
			$colordark[$i] = imagecolorallocate($image, round(hexdec(substr($color[$i],1,2))/2), round(hexdec(substr($color[$i],3,2))/2), round(hexdec(substr($color[$i],5,2))/2));
			$color[$i] = imagecolorallocate($image, hexdec(substr($color[$i],1,2)), hexdec(substr($color[$i],3,2)), hexdec(substr($color[$i],5,2)));
		}
		else {
			$colordark[$i] = imagecolorallocate($image, round(hexdec(substr($color[$i],0,2))/2), round(hexdec(substr($color[$i],2,2))/2), round(hexdec(substr($color[$i],4,2))/2));
			$color[$i] = imagecolorallocate($image, hexdec(substr($color[$i],0,2)), hexdec(substr($color[$i],2,2)), hexdec(substr($color[$i],4,2)));
		}
	}
	$blanco     = imagecolorallocate($image, 255, 255, 255);

	$total = array_sum($amount);

	$partial = 0;
	for ($j = 170; $j > 130; $j--) {
		for ($i = 0; $i < count($item); $i++) {
			imagefilledarc($image, 150, $j, 280, 200, ($partial/$total)*360, (($partial+$amount[$i])/$total)*360, $colordark[$i], IMG_ARC_PIE);
			$partial += $amount[$i];
		}
	}

	$partial = 0;
	for ($i = 0; $i < count($item); $i++) {
		imagefilledarc($image, 150, 130, 280, 200, ($partial/$total)*360, (($partial+$amount[$i])/$total)*360, $color[$i], IMG_ARC_PIE);
		$partial += $amount[$i];
	}
	imagearc($image, 150, 130, 280, 200, 0, 360, $blanco);

	//Captions
	for ($i = 0; $i < count($item); $i++) {
		imagerectangle($image, 10, 293+$i*15, 20, 303+$i*15, $blanco);
		imagefilledrectangle($image, 11, 294+$i*15, 19, 302+$i*15, $color[$i]);
		imagestring($image, 5, 22, 290+$i*15, $item[$i], $blanco);
	}

	ob_start();
	$res=imagepng($image);
	$image_str = ob_get_clean();
	?>
<img src="data:image/png;base64,<?php echo base64_encode($image_str); ?>" />
<?php
	imagedestroy($image);
?>
