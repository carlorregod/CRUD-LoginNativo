respuesta = function(resp) {
		$('#tablaProductos').html(resp);
	};

inicio = function() {
	params ='&cmd=CargaTabla';
	method="POST";
	url="../php/sistema/mainCommand.php";
	ajaxCallback(params, url, method, respuesta);
	return;
};

$(document).ready(inicio);