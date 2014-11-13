<!DOCTYPE html>
<!--No comentar antes del Doctype-->
<!--[if lt IE 7]><html class="lt-ie10 lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]>   <html class="lt-ie10 lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]>   <html class="lt-ie10 lt-ie9"><![endif]-->
<!--[if IE 9 ]>  <html class="lt-ie10"><![endif]-->
<!--[if gt IE 9]><!--> <html lang="" class=""><!--<![endif]-->
<head>
	<?php
		tags($page,'');
		$fechaClima = clima();
	?>
	<meta property="og:image" content="<?=$CFG->wwwroot?>/img_fbshare_econsulting.png"/>
	<meta property="og:url" content="<?=$CFG->wwwroot?>"/>

	<!-- Normalize.css -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$CFG->wwwroot?>/js/jQuery-eConsShare/econs-share.css" />
	<link rel="stylesheet" type="text/css" href="<?=$CFG->wwwroot?>/css/style.css" />
	<link rel="shortcut icon" href="<?=$CFG->wwwroot?>/img/icono/icono.ico" />

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>
		/* Si no se cargó jQuery del CDN, cargar la versión local de respaldo */
		if(typeof window.jQuery == 'undefined')
			document.write("<script src='<?=$CFG->wwwroot?>/js/jquery-1.10.2.min.js'><\/script>");
	</script>

	<!-- Plugin para compartir de E Consulting -->
	<script src="<?=$CFG->wwwroot?>/js/jQuery-eConsShare/jQuery.eConsShare.js"></script>
	<!-- Atributo placeholder en inputs y textarea para navegadores que no lo soportan -->
	<script src="<?=$CFG->wwwroot?>/js/Placeholder/jquery.placeholder.min.js"></script>

	<!-- Para usar selectores CSS3 como :first-child y :nth-child en navegadores que no lo soportan -->
	<script src="<?=$CFG->wwwroot?>/js/Selectivizr/selectivizr-min.js"></script>

	<!--
		Para tener más efectos en las transiciones de jQuery:
		http://gsgd.co.uk/sandbox/jquery/easing/ http://easings.net/es
	-->
	<script src="<?=$CFG->wwwroot?>/js/jQueryEasing/jquery.easing.min.js"></script>
	
	<!-- Mete aquí el JS que vayas a escribir -->
	<script src="<?=$CFG->wwwroot?>/js/scripts.js"></script>
</head>
<body>
	<div id="ppal">
		<div id="header">
			<div id="relojFechaClima" class="">
				<span id="reloj">
					<span id="hora"></span><!-- Hack
				 --><span id="dPuntos">:</span><!--Hack
				 --><span id="minutos"></span>
					<span id="AMPM"></span>
				</span>
				<span id="fecha"> - <?=$fechaClima["dia"]." de ".$fechaClima["mes"]." de ".$fechaClima["anio"]?></span>
				<span id="clima"> - <?= $fechaClima["temp"] ?> &deg;C</span>
			</div>
			<nav id="navigation">
				<a href="<?=$CFG->wwwroot?>/">Inicio</a>
				<a href="<?=$CFG->wwwroot?>/nosotros">Nosotros</a>
				<a href="<?=$CFG->wwwroot?>/productos">Productos</a>
				<a href="<?=$CFG->wwwroot?>/contacto">Contacto</a>
			</nav>
		</div><!-- fin div header-->