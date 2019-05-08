ajaxCallback = function(parametros, url, method, callback, asynchr=true) {
	$.ajax({
		'type':method,
		'url':url,
		'data':parametros,
		'asynchr':asynchr
	})
	.done(function(respuesta) {
		callback(respuesta);
	})
	.fail(function(error) {
		console.log('Ha ocurrido un error: '+error);
	});
};

//Ingreso nombre más apellido
function soloNombreApellido(e)
{
   //Sólo aceptará letras, espacio en blanco y números positivos y decimales
	tecla = (document.all) ? e.keyCode : e.which; 
	if (tecla==8) return true; 
	patron =/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]$/; 
	te = String.fromCharCode(tecla); 
	return patron.test(te);
}
//Ingreso formulario email
function soloEmail(e)
{
   //Sólo aceptará letras, espacio en blanco y números positivos y decimales
	tecla = (document.all) ? e.keyCode : e.which; 
	if (tecla==8) return true; 
	patron =/^[a-zA-Z0-9@._-]$/; 
	te = String.fromCharCode(tecla); 
	return patron.test(te);
}
//Ingreso formulario email
function soloNombre(e)
{
   //Sólo aceptará letras, espacio en blanco y números positivos y decimales
	tecla = (document.all) ? e.keyCode : e.which; 
	if (tecla==8) return true; 
	patron =/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]$/; 
	te = String.fromCharCode(tecla); 
	return patron.test(te);
}

revisaEmail = function(email)
{
	//Variable regex permitirá almacenar criterio de validación: nombre1@ejemplo.com.
    var regex = /^([a-zA-Z])([a-zA-Z0-9_.-])+\@(([a-zA-Z0-9\-])+([\.]){1})([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
};

revisaUser = function(user)
{
    //Consultar si el caracter tiene dígitos
    var regex_num = /\d+/;
    //Consultar si el caracter tiene letras
    var regex_txt= /([a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ])+/;
    if(user.search(regex_num) == -1 || user.search(regex_txt) == -1)
    {
        alert("Alias del usuario debe poseer al menos, una letra y/o un número. Vuelva a ingresar.")
        return false;
    }
    //Consulta si la cadena posee al menos, 5 líneas de extensión
    if(user.length<=5)
    {
        alert("Alias del usuario debe poseer más de 5 caracteres. Número y letras obligatorio.")
        return false;
    }
    //Caso de éxito retornará un verdadero...
    return true;
};

revisaNombreApellido = function(nombre)
{
    //Variable regex permitirá almacenar criterio de validación: Hola Mundo.
    var regex = /^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+[\ ]{1}([a-zA-ZñÑáéíóúÁÉÍÓÚ])+/;
    return regex.test(nombre) ? true : false;
};

revisaPassword = function(pw)
{
    //Consultar si el caracter tiene dígitos
    var regex_num = /\d+/;
    //Consultar si el caracter tiene letras
    var regex_txt= /([a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ])+/;
    if(pw.search(regex_num) == -1 || pw.search(regex_txt) == -1)
    {
        alert("Contraseña debe poseer al menos, una letra y/o un número. Vuelva a ingresar.")
        return false;
    }
    //Consulta si la cadena posee al menos, 5 líneas de extensión
    if(pw.length<=5)
    {
        alert("Contraseña debe poseer más de 5 caracteres. Número y letras obligatorio.")
        return false;
    }
    //Caso de éxito retornará un verdadero...
    return true;
};
