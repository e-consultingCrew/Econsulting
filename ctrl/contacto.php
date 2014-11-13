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
		<div id="forma">
			<label for="nombre">Nombre</label>
			<input type="text" name="telefono" id="nombre" placeholder="Nombre">
			<br>
			<label for="telefono">Teléfono</label>
			<input type="text" name="telefono" id="telefono" placeholder="Teléfono">
			<br>
			<label for="">E-Mail</label>
			<input type="text" name="email" id="email" placeholder="E-Mail">
			<br>
			<label for="">Ingresa el código que ves en la imagen</label>
			<br>
			<img src="<?=$CFG->wwwroot?>/vendors/captcha/captcha.php" alt="" class="captchaImg">
			<input type="text" name="code" id="code" placeholder="Captcha">
			<br>
			<label for="comentarios"></label>
			<textarea name="comentarios" id="comentarios" placeholder="comentarios"></textarea>
			<br>
			<!-- Usar es para español y en para inglés-->
			<img src="" alt="" class="sendBtn button" onclick="enviar('es')">
		</div>
	</div>
	<?php
}
?>
