<?php
# Configuracion de variable de direccion.\
if(isset($_GET['url'])){
 $arurl = explode('/', $_GET['url']);
 
  $page=$arurl[0];
 if(isset($arurl[1]))
 	$action=$arurl[1];
 if(isset($arurl[2]))
 	$param[1]=$arurl[2];
 if(isset($arurl[3]))
 	$param[2]=$arurl[3];
 if(isset($arurl[4]))
 	$param[3]=$arurl[4];
}
else{
	
	$page="inicio";
}

# cargamos la libreria del sistema
if(!include("bin/lib.php"))
	exit;
# cargamos configuracion del sitio
if(!include("config.php"))
	exit;
	
?>