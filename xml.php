<img src="xml.png" alt="XML logo" \><br>

<?php
//Recuperación de las variables del formulario
	for ($i=0; $i < count($_POST['item']); $i++){
		$item[$i]  = $_POST['item'][$i];
		$amount[$i]= $_POST['amount'][$i];
		$color[$i] = $_POST['color'][$i];
	}

//Crear un fichero .xml con un nombre que refleje la fecha y hora de creación
	if ($xml = fopen("graphs/graph-".date("YmdHis").".xml", "a")) {
		fputs($xml, "<graph type=\"pie\">\n");
//Para cada objeto, crear una línea con su elemento y atributos, teniendo en cuenta el bug de la longitud de la cadena del color.
		for ($i=0; $i<count($item); $i++) {
			if (strlen($color[$i])==7) 	{ fputs($xml, "\t<element item=\"".$item[$i]."\" amount=\"".$amount[$i]."\" color=\"".$color[$i]."\" />\n"); }
			else				{ fputs($xml, "\t<element item=\"".$item[$i]."\" amount=\"".$amount[$i]."\" color=\"#".$color[$i]."\" />\n"); }
		}
		fputs($xml, "</graph>");
		if (fclose($xml)) { echo "XML graph representation is ready: <a href=graphs/graph-".date("YmdHis").".xml>grab it here.</a>"; } //Si salió bien, mostrar el enlace al fichero.
		else { echo "Something failed and the XML could not be properly closed. Please contact Alex or Juan."; } //Si no, mostrar el error.
	}
	else echo "Something failed and I could not even create the file. Please contact Alex or Juan."; //Esto sale si el fichero ni siquiera se puedo crear.
?>

