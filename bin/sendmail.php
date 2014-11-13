<?php
	session_start();

	//error_reporting(E_ALL);
		$nombre =    $_POST['nombre'];
		$tel =       $_POST['telefono'];
		$email =     $_POST['email'];
		$mensaje =   $_POST['comentarios'];
		$code = trim($_POST['code']);
		$lang =      $_POST['lang'];

		$asunto = "";

		if($lang == "es")
			$asunto = "Contacto <NOMBRE DE LA PÁGINA>";
		else
			$asunto = "Contact <NAME OF PAGE>";


	$to = "";

	if($code != $_SESSION['key'] )
		echo "-1"; //Código CAPTCHA erróneo
	else
	{
		//New Lines to <br>
		$contenido = nl2br($mensaje);
		
		if($lang)
			$contenido .= "<br><br>".$nombre."<br>Teléfono: ".$tel."<br>E-mail: ".$email;
		else
			$contenido .= "<br><br>".$nombre."<br>Phone: ".$tel."<br>E-mail: ".$email;

		$cabeceras .= "Reply-To: noreply@DOMINIO_AQUÍ\r\n";
		$cabeceras = "Content-type: text/html\r\n";
		$cabeceras .= "From:  <noreply@DOMINIO_AQUÍ>\r\n";
		$cabeceras .= "X-Mailer: PHP".phpversion();

		if(mail($to, $asunto, $contenido, $cabeceras))
			echo "1"; //Envío exitoso
		else
			echo "0"; //Fallo de envío
	}
?>