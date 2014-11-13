(function($)
{
	// Expresión regular para validar correos electrónicos
	var mailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var compartidorHTML =
		'<div class="eConsShare">\
			<div class="eConsShare-bar">\
				<div class="eConsShare-bar-title"></div>\
				<ul class="eConsShare-bar-links">\
					<li>\
						<a href="javascript:void(0)" class="eCS-link eCS-mail-link">\
							<img\
								src="img-share/correo.png"\
								alt=""\
								class="eConsShare-bar-icon eCS-mail"\
								width="27"\
								height="22">\
						</a>\
					</li>\
					<li>\
						<a href="http://www.twitter.com/share?url=" class="eCS-link eCS-tw-link" target="_blank">\
							<img\
								src="img-share/twitter.png"\
								alt=""\
								class="eConsShare-bar-icon eCS-twitter"\
								width="22"\
								height="22">\
						</a>\
					</li>\
					<li>\
						<a href="https://www.facebook.com/sharer/sharer.php?u=" class="eCS-link eCS-fb-link" target="_blank">\
							<img\
								src="img-share/facebook.png"\
								alt=""\
								class="eConsShare-bar-icon eCS-facebook"\
								width="22"\
								height="22">\
						</a>\
					</li>\
				</ul>\
			</div>\
			<div class="eConsShare-icon"></div>\
		</div>';
	
	$.fn.eConsShare = function(opciones)
	{
		// Opciones
		var o = $.extend(
		{
			direccion: "right", // top|left|right|bottom
			idioma: "es", // es|en
			pluginFolder: document.location.protocol+"//"+document.location.hostname+"/js/jQuery-eConsShare/"
		}, opciones);

		if(!/top|left|right|bottom/.test(o.direccion))
			throw new Error("Error: Dirección no válida.");
		if(!/es|en/.test(o.idioma))
			throw new Error("Error: Idioma no implementado.");

		return this.each(function()
		{
			var $compartidor = $(this);
			$compartidor.html(compartidorHTML);

			$compartidor.find(".eCS-tw-link, .eCS-fb-link").each(function()
			{
				this.href += document.location.protocol+"//"+document.location.hostname;
			});
			$compartidor.find(".eConsShare-bar-icon").each(function()
			{
				var src = $(this).attr("src");
				this.src = o.pluginFolder + src;
			});
			$compartidor.find(".eConsShare-bar-title").text(o.idioma == "es" ? "Compartir" : "Share");

			if(o.direccion == "left" || o.direccion == "right")
				$compartidor.children(".eConsShare").addClass("eCS-horiz");
			if(o.direccion == "top" || o.direccion == "bottom")
				$compartidor.children(".eConsShare").addClass("eCS-verti");

			$compartidor.children(".eConsShare").addClass("eCS-"+o.direccion);

			$compartidor.find(".eCS-mail-link").click(function()
			{
				var validDestinatarios = [];
				var invalidDestinatarios = [];

				// Pedir lista de destinatarios
				while(!validDestinatarios.length || invalidDestinatarios.length)
				{
					var destinatario = invalidDestinatarios;
					if(!invalidDestinatarios.length)
					{
						switch(o.idioma)
						{
							case "es":
								destinatario = prompt("Paso 1 de 2\nIngresa el correo electrónico de las personas a las que quieres compartirles esta página.\nSepáralos con comas", "");
								break;
							case "en":
								destinatario = prompt("Step 1 of 2\nEnter a comma-separated list of e-mail addresses you want to share this page with.", "");
								break;
							default:
								break;
						}
					}
					else
					{
						switch(o.idioma)
						{
							case "es":
								destinatario = prompt("Paso 1 de 2\nLas siguientes direcciones no son válidas.\nCorrígelas o deja la caja de texto en blanco:", invalidDestinatarios.join(", "));
								break;
							case "en":
								destinatario = prompt("Step 1 of 2\nThe following are not valid e-mail addresses.\nPlease fix them or leave in blank:", invalidDestinatarios.join(", "));
								break;
							default:
								break;
						}
					}

					/*  Validación  */
					invalidDestinatarios = [];

					if(destinatario === null)
					{
						if(confirm("¿Cancelar el envío del mensaje?"))
							return;
					}

					if(!destinatario)
						destinatario = "";
					var dest = destinatario.split(/,\s*/);

					for(var i = 0; i < dest.length; i++)
					{
						var mail = $.trim(dest[i]);

						if(mailRegex.test(mail))
							validDestinatarios.push(mail);
						else if(mail !== "")
							invalidDestinatarios.push(mail);
					}
				}

				// Preguntar correo y nombre del usuario.
				// var correoUsuario = "";

				// while(correoUsuario == "")
				// {
				// 	switch(o.idioma)
				// 	{
				// 		case "es":
				// 			correoUsuario = prompt("Ingresa tu dirección de correo.");
				// 			break;
				// 		case "en":
				// 			correoUsuario = prompt("Enter your e-mail address.");
				// 			break;
				// 		default:
				// 			break;
				// 	}
				// }

				var nombreUsuario = "";

				while(nombreUsuario == "")
				{
					switch(o.idioma)
					{
						case "es":
							nombreUsuario = prompt("Paso 2 de 2\nIngresa tu nombre.", "");
							break;
						case "en":
							nombreUsuario = prompt("Step 2 of 2\nEnter your name.", "");
							break;
						default:
							break;
					}
				}

				$.post(o.pluginFolder+"sharemail.php",
					{
						lang: o.idioma,
						to: validDestinatarios.join(", "),
						// from: correoUsuario,
						fromName: nombreUsuario
					},
					function(respuesta)
					{
						// Error en alguno de los datos
						if(respuesta == "-1")
						{
							switch(o.idioma)
							{
								case "es":
									alert("Uno o más de los datos enviados es inválido.\nIntenta nuevamente.");
									break;
								case "en":
									alert("Some of the data sent not valid.\nPlease try again.");
									break;
								default:
									break;
							}
							return;
						}

						// Error al enviar el correo
						if(respuesta == "0")
						{
							switch(o.idioma)
							{
								case "es":
									alert("Ocurrió un error al enviar el correo.\nIntenta nuevamente.");
									break;
								case "en":
									alert("There was an error sending the e-mail.\nPlease try again.");
									break;
								default:
									break;
							}
							return;
						}

						// Éxito al enviar el correo
						if(respuesta == "1")
						{
							switch(o.idioma)
							{
								case "es":
									alert("El correo se ha enviado exitosamente.\nGracias por compartir nuestra página web.");
									break;
								case "en":
									alert("The e-mail has been sent successfully.\nThanks for sharing our webpage.");
									break;
								default:
									break;
							}
							return;
						}
					});
			});

			$compartidor.find(".eConsShare-icon").click(function()
			{
				$(this).parent().toggleClass("eConsShare-open");
			});
		});
	};
}(jQuery));