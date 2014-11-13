<?php
function main($action,$param){
	if($action=="")
		$fcn="inicio";
	else
		$fcn=$action;

	$fcn($param);

}
function inicio($param){
	global $CFG;
	?>

	<div id="contenido">

	</div>
	<?php
}
?>
