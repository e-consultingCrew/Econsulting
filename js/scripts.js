//$(document).ready(...)
jQuery(function($)
{
	mueveReloj();
	$("input:text, input:password, textarea").placeholder();
	$("#"+path[0]).trigger("mouseenter").addClass("selected");
});

//----------------------------------------------------------Algunas variables útiles----------------------------------------------------------
/* No suele ser necesario modificar esto.
	Excepto pathname. Si es una página en inglés, cambiar "inicio" por "home"
*/

// Si la url es "http://example.com/example1/example2",
// pathname será "/example1/example2"
var pathname = document.location.pathname == "/" ? "inicio" : document.location.pathname;
//Y path sería un arreglo: ["example1", "example2"].
var path = pathname.replace("/", "").split("/");

// Para saber el dominio. Ejemplo: "//example.com".
var root = "//"+document.hostname;

//----------------------------------------------------------Eventos----------------------------------------------------------
// Checkbox personalizado
$(document).on('click ', '.checkbox', function()
{
	if($(this).hasClass("disabled"))
		return;

	$(this).toggleClass("checked");

	if(this.tagName == "IMG")
	{
		var source = $(this).attr("src");
		/*Si el botón no está ON*/
		if(source.indexOf("btnON_") == -1)
			source = source.replace("btn_", "btnON_");
		else
			source = source.replace("btnON_", "btn_");
		$(this).attr("src", source);
	}
});

// Radio button personalizado
$(document).on("click", ".radio", function()
{
	var $this = $(this);
	if($this.hasClass("checked"))
		return;
	var radioFamily = $this.attr("data-radio-family");

	// Obtener el .radio.checked actual
	var $checked = $(".radio.checked[data-radio-family='"+radioFamily+"']");

	// Intercambiar clases
	$checked.removeClass("checked");
	$this.addClass("checked");

	// Si es imagen, intercambiar los
	if(this.tagName == "IMG")
	{
		// Apagar los otros .radio
		$checked.each(function()
		{
			this.src = this.src.replace("btnON_", "btn_");
		});

		// Encender este .radio
		this.src = this.src.replace("btn_", "btnON_");
	}
});

// Botones
$(document).on(
{
	mouseenter: function()
	{
		if($(this).hasClass("selected"))
			return;

		$(this).addClass("hover");

		var src = $(this).attr("src");
		src = src.replace("btn_", "btnON_");
		$(this).attr("src", src);
	},
	mouseleave: function()
	{
		if($(this).hasClass("selected"))
			return;

		$(this).removeClass("hover");

		var src = $(this).attr("src");
		src = src.replace("btnON_", "btn_");
		$(this).attr("src", src);
	}
}, ".button");

//----------------------------------------------------------Retrocompatibilidad----------------------------------------------------------
//Para que String.trim() funcione en IE < 9 y navegadores que no lo soportan
if(!String.prototype.trim)
{
	String.prototype.trim = function()
	{
		return this.replace(/^\s+|\s+$/g, '');
	};
}

//para que Array.filter() funcione en IE < 9 y navegadores que no lo soportan
if(!Array.prototype.filter)
{
	Array.prototype.filter = function(fun /*, thisp*/)
	{
		var len = this.length;
		if (typeof fun != "function")
			throw new TypeError();
		var res = new Array();
		var thisp = arguments[1];
		for (var i = 0; i < len; i++)
		{
			if (i in this)
			{
				var val = this[i]; // in case fun mutates this
				if (fun.call(thisp, val, i, this))
				res.push(val);
			}
		}
		return res;
	};
}

//Para que Array.indexOf() funcione en IE < 9 y navegadores que no lo soportan
if(!Array.prototype.indexOf)
{
	Array.prototype.indexOf = function(elt /*, from*/)
	{
		var len = this.length >>> 0;

		var from = Number(arguments[1]) || 0;
		from = (from < 0) ? Math.ceil(from) : Math.floor(from);
		if (from < 0)
			from += len;

		for(; from < len; from++)
		{
			if (from in this && this[from] === elt)
				return from;
		}
		return -1;
	};
}
// Para que Array.forEach() funcione en IE < 9
if(!Array.prototype.forEach)
{
	Array.prototype.forEach = function(fn, scope)
	{
		'use strict';
		var i, len;
		for (i = 0, len = this.length; i < len; ++i)
		{
			if (i in this)
				fn.call(scope, this[i], i, this);
		}
	};
}

// HTML5 elements for IE<9
(function()
{
	function HtmlClassList()
	{
		classList = document.documentElement.className
			.replace(/^\s+|\s+$/g, '')
			.replace(/\s{2,}/g, " ")
			.split(/\s/);
		document.documentElement.className = classList.join(" ");
		return classList;
	};
	if(HtmlClassList().indexOf("lt-ie9") != -1)
	{
		var elements = ("abbr,article,aside,audio,canvas,datalist,details,figure,footer,header,hgroup,mark,menu,meter,nav,output,progress,section,time,video").split(",");
		for(var i = 0; i < elements.length; i++)
			document.createElement(elements[i]);
	}
}());

/*----------------------------------------------------------!!! Sólo usar User Agent Sniffing como !!! última opción. (Es mala práctica)----------------------------------------------------------*/
var isMobile =
{
	Android: function()
	{
		return navigator.userAgent.match(/Android/i);
	},
	BlackBerry: function()
	{
		return navigator.userAgent.match(/BlackBerry|BB10; Touch/i);
	},
	iOS: function()
	{
		return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	},
	Opera: function()
	{
		return navigator.userAgent.match(/Opera Mini|Opera Mobi/i);
	},
	NetFront: function()
	{
		return navigator.userAgent.match(/NetFront/i);
	},
	Windows: function()
	{
		return navigator.userAgent.match(/IEMobile/i);
	},
	any: function()
	{
		return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.NetFront() || isMobile.Windows());
	}
};
if(isMobile.any())
{
	$("html").addClass("mobile");
}

/*----------------------------------------------------------RELOJ----------------------------------------------------------*/
function mueveReloj()
{
	var momentoActual = new Date();
	var hora = momentoActual.getHours();
	var minuto = momentoActual.getMinutes();
	var segundo = momentoActual.getSeconds();
	var am_pm = "AM";

	if(hora > 11)
		am_pm= "PM";

	if(hora > 12)
		hora -= 12;

	if(segundo < 10)
		segundo = "0" + segundo;

	if(minuto < 10)
		minuto = "0" + minuto;

	if(hora < 10)
		hora = "0" + hora;

	document.getElementById("hora").innerHTML = hora;
	document.getElementById("minutos").innerHTML = minuto;
	document.getElementById("AMPM").innerHTML = am_pm;

	visibleDPuntos = segundo % 2; // 0 ó 1

	//Se puede animar agregando una transición con CSS3
	$("#dPuntos").css("opacity", visibleDPuntos);

	setTimeout(mueveReloj, 1000);
}

//Descomentar cuando ya este agregada la navegación
/*function prendido(pagina)
{
	var source = $('#'+pagina).attr('src');
	source = source.replace('btn','btnON');
	$('#'+pagina).attr('src',source);
	$('#'+pagina).addClass('selected');
}*/


/*----------------------------------------------------------Forma de Contacto----------------------------------------------------------*/
//Regex para validar e-mails
var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

function validarNombre()
{
	if($("#nombre").val().trim() == "")
		return false;
	return true;
}
function validarTelefono()
{
	if($("#telefono").val().trim() == "")
		return false;
	return true;
}
function validarEmail()
{
	if($("#email").val().trim() == "" ||
		!regex.test($("#email").val()))
		return false;
	return true;
}
function validarMensaje()
{
	if($("#comentarios").val().trim() == "")
		return false;
	return true;
}

function enviar(lang)
{
	if(!validarNombre())
	{
		if(lang == "es") alert("El campo de Nombre es necesario");
		if(lang == "en") alert("Name is required.");
		return;
	}
	if(!validarTelefono())
	{
		if(lang == "es") alert("El campo de Teléfono es necesario");
		if(lang == "en") alert("Phone Number required.");
		return;
	}
	if(!validarEmail())
	{
		if(lang == "es") alert("El campo de Correo Electrónico es necesario");
		if(lang == "en") alert("E-mail required.");
		return;
	}
	if($("#code").val().trim() == "")
	{
		if(lang == "es") alert("Ingresa los caracteres que ves en la imagen.");
		if(lang == "en") alert("Enter the characters in the picture");
		return;
	}
	if(!validarMensaje())
	{
		if(lang == "es")
		{
			if(!confirm("¿Deseas enviar este mensaje en blanco?"))
				return; //Si no desea enviar el mensaje en blanco, sale de la función
		}
		if(lang == "en")
		{
			if(!confirm("Do you really want to send a blank message?"))
				return; //Si no desea enviar el mensaje en blanco, sale de la función
		}
	}

	$.post("../bin/sendmail.php",
		{
			a: 'sendmail',
			nombre:      $("#nombre").val().trim(),
			telefono:    $("#telefono").val().trim(),
			email:       $("#email").val().trim(),
			code:        $("#code").val().trim(),
			comentarios: $("#comentarios").val().trim(),
			lang: lang
		},
		function(mensaje)
		{
			if(lang == "es")
			{
				switch(parseInt(mensaje))
				{
					case -1: //Código incorrecto
						alert("Código erróneo. Intenta nuevamente.");
						break;
					case 0: //Problema al enviar el correo
						alert("Hubo un problema al enviar el correo. Intenta de nuevo más tarde.");
						break;
					case 1: //Envío exitoso
						alert("Gracias por comunicarte con nosotros. En breve nos pondremos en contacto contigo.");
						emptyfields();
						break;
					default: //Hay que revisar qué pasó
						console.log(mensaje);
						break;
				}
			}

			else
			{
				switch(parseInt(mensaje))
				{
					case -1: //Código incorrecto
						alert("Wrong code. Please try again.");
						break;
					case 0: //Problema al enviar el correo
						alert("There was a problem sending the mail. Please try again later.");
						break;
					case 1: //Envío exitoso
						alert("Thanks for contacting us. We will contact you soon.");
						emptyfields();
						break;
					default: //Hay que revisar qué pasó
						console.log(mensaje);
						break;
				}
			}
		});
}

function emptyfields()
{
	$("#nombre, #telefono, #email, #comentarios, #code").val("");
}