fn_callback_respuesta=function(respuesta) {
	if(respuesta == 'salidaExitosa')
	{	
		alert('Salida del sistema exitoso');
		location.href='../index.php';
	}
	else
	{
		alert('Ocurrió un error. Intentar más tarde');
	}
		
};


function salida() {
	parametros='';
	method="POST";
	url="../php/login_js/logout.php";
	ajaxCallback(parametros, url, method, fn_callback_respuesta);
	return;
}