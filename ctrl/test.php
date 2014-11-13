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
		<ul class="testList">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li>
				<h2>Plugin: jScrollPane.</h2>
				<p>
					Este plugin tiene problemas con el @font-face. Darle un retraso de 500ms
					para que dé tiempo de cargar el @font-face y calcule bien la altura.

					<code>
						window.setTimeout(cargarjScrollPane, 500)
						function cargarjScrollPane()
						{
							$("#elemento").jScrollPane();
						}
					</code>
					<div class="sandbox">
						
					</div>
				</p>
			</li>
		</ul>
	</div>
	<?php
}
?>
