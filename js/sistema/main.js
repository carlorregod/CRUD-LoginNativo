respuesta_inicio = function(resp) {
	$('#tablaProductos').html(resp);
};

inicio = function() {
	params ='&cmd=CargaTabla';
	method="POST";
	url="../php/sistema/mainCommand.php";
	ajaxCallback(params, url, method, respuesta_inicio);
	return;
};

resp_edicion = function(resp) {
	respuesta = JSON.parse(resp);
	$('#txtNombreProducto').val(respuesta.producto);
	$('#txtIdProducto').val(respuesta.id);
	$('#registroCustomID').html(respuesta.serie);
	$('#exampleModal').modal('show');
	return;
};

resp_actualizar = function(resp) {
	respuesta = JSON.parse(resp);
	alert('El registro '+respuesta.serie+' ha sido cambiado exitosamente');
	$('#exampleModal').modal('hide');
	inicio();
	return;
};
	

borrar = function() {
	var id = this.id;
	alert(this);
	row = $(this).parents('tr');
	params ='&cmd=BorrarRegistro'+'&id='+id; 
	method="POST";
	url="../php/sistema/mainCommand.php";
	$.ajax({
		'type': method,
		'url': url,
		'data': params,		
	})
	.done(function() {
		alert('Elemento borrado');
		row.fadeOut();
	})
	.fail(function(err) {
		console.log('Error: '+err);
	});
	return;
};

editar= function(boton) {
	var id = boton.id;
	params ='&cmd=EditarRegistro'+'&id='+id; 
	method="POST";
	url="../php/sistema/mainCommand.php";
	ajaxCallback(params, url, method, resp_edicion);
	return;
};

actualizar= function(boton) {
	var id = boton.value;
	var producto = $('#txtNombreProducto').val();
	params ='&cmd=ActualizarRegistro'		+
			'&id='					+id 	+
			'&producto='			+producto; 
	method="POST";
	url="../php/sistema/mainCommand.php";
	ajaxCallback(params, url, method, resp_actualizar);
	return;
};

$(document).ready(inicio);



