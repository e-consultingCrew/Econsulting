<?php
unset($CFG);

global $CFG;
$CFG = new stdClass;

//=========================================================================
// 1. Base de datos
//=========================================================================

$CFG->hostdb    = 'localhost';
//$CFG->hostdb    = 'localhost';
$CFG->nombredb    = 'test';
//$CFG->nombredb    = '';
$CFG->usuariodb    = 'root';
//$CFG->usuariodb    = 'root';
$CFG->passworddb    = '';
$CFG->puertodb = '3306';
//=========================================================================
// 2. Localizacion del sitio Web
//===================================== ====================================

$CFG->wwwroot   = 'http://localhost';
$CFG->cssroot =  $CFG->wwwroot . '/css';
$CFG->jsroot = $CFG->wwwroot . '/js';

//=========================================================================
// 2.1 Localizacion de la administración
//===================================== ====================================

$CFG->wwwadmin = $CFG->wwwroot . '/admin';
$CFG->admincss =  $CFG->wwwadmin . '/css';
$CFG->adminjs = $CFG->wwwadmin . '/js';

//=========================================================================
// 3. Localizacon de archivos
//=========================================================================

$CFG->dirroot   = '/public_html';
$CFG->fullpath  = '/home/{NOMBRE DE USUARIO}/public_html';
// $CFG->fullpath  = 'C:/wamp/www';


//=========================================================================
// 4. Localicacion del directorio de imagenes
//=========================================================================

$CFG->tipodirectorio = "unix";
$CFG->wwwimagenes = $CFG->wwwroot . "/img";

//=========================================================================
// 5. Configuracion de SMTP
//=========================================================================

$CFG->hostsmtp = "mail.dominio.com";
$CFG->puertosmtp = "2525";
$CFG->usuariosmtp = "noreply@dominio.com";
$CFG->contrasenasmtp = ""; 

//========================================================================
// 6. Prueba de conexion a base de datos
//========================================================================

$bdconn = 
$link	=	mysql_connect($CFG->hostdb,$CFG->usuariodb,$CFG->passworddb);

if($link)
	mysql_select_db($CFG->nombredb);
else{
	echo "Error, no se pudo conectar a la base de datos. contacte al administrador del sistema.<br>";
	echo $CFG->nombredb.'<br>';
		echo $CFG->usuariodb.'<br>';
	echo $CFG->passworddb.'<br>';	
	exit;
}
mysql_query("SET NAMES utf8");
	
?>