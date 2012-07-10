<?php
//Esta función se utiliza para pintar líneas punteadas, dada una imagen, coordenadas de inicio y final, la separación entre puntos y el color
	function imagelinedotted ($im, $x1, $y1, $x2, $y2, $dist, $col) {
	    $transp = imagecolortransparent ($im);
	   
	    $style = array ($col);
	   
	    for ($i=0; $i<$dist; $i++) {
		array_push($style, $transp);        // Generate style array - loop needed for customisable distance between the dots
	    }
	   
	    imagesetstyle ($im, $style);
	    return (integer) imageline ($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);
	    imagesetstyle ($im, array($col));        // Reset style - just in case...
	}

//Recuperación de las variables del formulario
	for ($i=0; $i < count($_POST['item']); $i++){
		$item[$i]  = $_POST['item'][$i];
		$amount[$i]= $_POST['amount'][$i];
		$color[$i] = $_POST['color'][$i];
	}

//Crear la imagen con un alto proporcional a la cantidad de objetos
	$image    = imagecreatetruecolor(300, 300+count($item)*15);

//Asignar colores en la paleta
	for ($i = 0; $i < count($item); $i++) {
		if (strlen($color[$i])==7)	{ $color[$i] = imagecolorallocate($image, hexdec(substr($color[$i],1,2)), hexdec(substr($color[$i],3,2)), hexdec(substr($color[$i],5,2))); }
		else				{ $color[$i] = imagecolorallocate($image, hexdec(substr($color[$i],0,2)), hexdec(substr($color[$i],2,2)), hexdec(substr($color[$i],4,2))); }
	}
	$blanco   = imagecolorallocate($image, 255, 255, 255);

//Gráfico:
	//$max = max ($amount[0], $amount[1]);
	$max = max ($amount);
	$ancho = 230/count($item);
//Crear barras
	for ($i = 0; $i < count($item); $i++) {
		imagefilledrectangle($image, ($ancho*$i)+40, 250-((230/$max)*$amount[$i]), ($ancho*($i+1))+39, 250, $color[$i]);
	}

//Pintar los números del eje y las líneas continuas y discontinuas
	imagestring ($image, 3, 12, 15, $max, $blanco);
	imagestring ($image, 3, 12, 73, round($max*.75), $blanco);
	imagestring ($image, 3, 12, 130, round($max*.5), $blanco);
	imagestring ($image, 3, 12, 188, round($max*.25), $blanco);
	imagestring ($image, 3, 12, 245, "0", $blanco);
	imageline   ($image, 38,20, 271,20, $blanco);
	imageline   ($image, 38,78, 271,78, $blanco);
	imageline   ($image, 38,135,271,135, $blanco);
	imageline   ($image, 38,193,271,193, $blanco);
	imageline   ($image, 38,250,271,250, $blanco);
	for ($i = 20; $i <= 250; $i += 230/16) {
		imagelinedotted ($image, 38, round($i), 271, round($i), 2, $blanco);
	}

//Leyenda
	for ($i = 0; $i < count($item); $i++) {
		imagerectangle($image, 10, 293+$i*15, 20, 303+$i*15, $blanco);
		imagefilledrectangle($image, 11, 294+$i*15, 19, 302+$i*15, $color[$i]);
		imagestring($image, 5, 22, 290+$i*15, $item[$i], $blanco);
	}

//El siguiente código se utiliza para que, al llamar este fichero desde otra página, se devuelva una imagen y no datos en crudo. Para ello creamos un objeto con ob_start y lo obtenemos con ob_get_clean. Del manual de PHP:
//This function will turn output buffering on. While output buffering is active no output is sent from the script (other than headers), instead the output is stored in an internal buffer.
//The contents of this internal buffer may be copied into a string variable using ob_get_contents(). To output what is stored in the internal buffer, use ob_end_flush(). Alternatively, ob_end_clean() will silently discard the buffer contents. 
	ob_start();
	$res=imagepng($image);
	$image_str = ob_get_clean();
	?>
<!-- La siguiente línea coge los datos en crudo que hemos almacenado en el búfer y los convertimos a base64, un formato que se puede mostrar directamente en el navegador usando el parámetro adecuado en el src de la etiqueta img de html. -->
<img src="data:image/png;base64,<?php echo base64_encode($image_str); ?>" />
<?php
	imagedestroy($image);
?>
