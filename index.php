<?php
	//Quitar al poner en producción
	error_reporting(E_ALL);
	session_start();

	# llamada archivo de configuracion
	include("cfg/cfg.php");

	# llamada archivo de control
	include("ctrl/ctrl.php");
?>