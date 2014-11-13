<?php
function tags($page)
{
	// Palabras clave para toda la página
	$keywords = "";

	switch($page)
	{
		default:
			$titulo = "";
			$descripcion = "";
			break;
	}
	?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=1024">
	<meta name="ROBOTS" content="INDEX,FOLLOW">
	<meta name="description" content="<?=$descripcion?>">
	<meta name="keywords" content="<?=$keywords?>">
	<meta name="author" content="http:\/\/e-consulting.com.mx">
	<meta name="rating" content="General">
	<title><?=$titulo?></title>
	<?php
}
function clima()
{
	global $CFG;
	require($CFG->wwwroot."/vendors/clima/simplepie.inc");
	require($CFG->wwwroot."/vendors/clima/simplepie_yahoo_weather.inc");

	//Juarez
	$code = "MXCA0026";
	//El Paso
	//$code = "";
	//Chihuahua
	//$code = "";

	//cambiar u=c para centigrados, u=f para farenheit
	$path = "http://weather.yahooapis.com/forecastrss?u=c&p=";
	$feed = new SimplePie();
	$feed->set_feed_url($path.$code);
	$feed->set_item_class("SimplePie_Item_YWeather");
	$feed->set_cache_location($_SERVER["DOCUMENT_ROOT"] . "/cache");
	$feed->set_cache_duration(600);
	if($feed->init())
    {
       $weather = $feed->get_item(0);
      $temp = $weather->get_temperature();
    }
    else
      $temp = "--";
	$fecha = getdate();
	$anio = $fecha["year"];
	$mes = $fecha["mon"];
	//Descomentar si se necesita el año de 2 digitos
	//$anio = $anio%100;
	$lista_meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$mes = $lista_meses[$mes-1];

	$dia = $fecha["mday"];
	if($dia<10)
	$dia = "0".$dia;

	return array("anio" => $anio, "mes" => $mes, "dia" => $dia, "temp" => $temp);
}
?>