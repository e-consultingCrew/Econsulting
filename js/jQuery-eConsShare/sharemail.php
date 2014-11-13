<?php
	// Expresión regular para validar direcciones de correo electrónico.
	$mailRegex = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";

	$fromName = isset($_POST["fromName"]) ? trim($_POST["fromName"]) : "";
	// $from     = isset($_POST["from"])     ? trim($_POST["from"])     : "";
	$lang     = isset($_POST["lang"])     ? trim($_POST["lang"])     : "";
	$to       = isset($_POST["to"])       ? trim($_POST["to"])       : "";

	// Separar correos de destino
	$to = explode(", ", $to);
	// var_dump($to);
	// exit();

	// Agrega las URL del cliente
	$espURL = "URL DEL CLIENTE";
	$engURL = "URL DEL CLIENTE";

	if($lang == "es")
		$asunto = "Visita DOMINIODELCLIENTE_ESPAÑOL";
	else if($lang == "en")
		$asunto = "Visit DOMINIODELCLIENTE_INGLÉS";
	else
		exit("-1"); // Error en alguno de los datos

	// Validar nombre
		if(trim($fromName) == "")
			exit("-1");
	// Validar correo
		// if(!preg_match($mailRegex, $from))
		// 	exit("-1");
	// Validar destinatarios
		$validTo = array();
		for($i = 0; $i < count($to); $i++)
		{
			if(preg_match($mailRegex, $to[$i]))
				$validTo[] = $to[$i];
		}
		if(!count($validTo))
			exit("-1");
		$to = implode(", ", $validTo);

	if($lang == "es")
		$mensaje = "
			<body style='font-family: sans-serif;'>
				<h1>Visita NOMBRE_DEL_CLIENTE</h1>
				<p>
					<b>¡Hola!</b><br>
					Tu amigo/a $fromName te ha invitado a visitar
					nuestra página web.<br>
					Tan sólo tienes que seguir este enlace: <a href='$espURL'>$espURL</a>.
					<br>
					---- • ---- • ---- • ---- • ----<br>
					<b>NOMBRE DE LA EMPRESA</b><br>
					Dirección: DIRECCIÓN<br>
					Tel: TELÉFONOS<br>
					CIUDAD, ESTADO, PAÍS
				</p>
			</body>";
	else if($lang == "en")
		$mensaje = "
			<body>
				<h1>Visit NOMBRE_DEL_CLIENTE</h1>
				<p>
					<b>Hello!</b><br>
					Your friend $fromName has invited you to visit our webpage.<br>
					You just have to follow this link: <a href='$engURL'>$engURL</a>.
					<br>
					---- • ---- • ---- • ---- • ----<br>
					<b>NOMBRE DE LA EMPRESA</b><br>
					Dirección: DIRECCIÓN<br>
					Tel: TELÉFONOS<br>
					CIUDAD, ESTADO, PAÍS
				</p>
			</body>";

	$cabeceras .= "Reply-To:\r\n";
	$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
	$cabeceras .= "From:  <noreply@DOMINIO_DEL_CLIENTE>\r\n";
	$cabeceras .= "MIME-Version: 1.0\r\n";
	$cabeceras .= "X-Mailer: PHP".phpversion();

	if(!mail($to, $asunto, $mensaje, $cabeceras))
		exit("0");
	exit("1");
?>