<?php
# llamamos al header de la web
$err="";
if(!@include("views/header.php"))
		$err.="<p>No existe el header</p>";
# llamamos al controlador 

if(!@include("ctrl/".$page.".php"))
	$err.="<p align='center'>P&aacute;gina en Construcci&oacute;n $page</p>";

# llamamos al contenido de la web

if(!@include("views/pages/inicio.php")) {
	$err.="<p align='center'><img src=\"../img/img_bajo_construccion.png\" width=\"213\" height=\"255\" /><br/>P&aacute;gina $page En Construcci&oacute;n</p>";}

#imprimimos los errores

if(isset($err)&&$err<>"") {
	echo "<div class='diverror'>$err</div>";}
	
# llamamos al footer de la web
include("views/footer.php");?>