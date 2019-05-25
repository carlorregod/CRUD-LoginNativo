encapsulamiento = function() {
	respuesta_inicio = function(resp) {
		$('#tablaProductos').html(resp);
	};

	_inicio = function() {
		params ='&cmd=CargaTabla';
		method="POST";
		url="../php/sistema/mainCommand.php";
		ajaxCallback(params, url, method, respuesta_inicio);
		return;
	};
	this.inicio = function() {
		return _inicio();
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
		_inicio();
		return;
	};
		
	_editar= function(eve) {
	var id = eve.id;
	params ='&cmd=EditarRegistro'+'&id='+id; 
	method="POST";
	url="../php/sistema/mainCommand.php";
	ajaxCallback(params, url, method, resp_edicion);
	return;
	};
	this.editar = function() {
		esto = this;
		return _editar(esto);
	};

	_actualizar= function(esto) {
	var id = esto.value;
	var producto = $('#txtNombreProducto').val();
	params ='&cmd=ActualizarRegistro'		+
			'&id='					+id 	+
			'&producto='			+producto; 
	method="POST";
	url="../php/sistema/mainCommand.php";
	ajaxCallback(params, url, method, resp_actualizar);
	return;
	};
	this.actualizar = function() {
		c = this;
		return _actualizar(c);
	};

	_borrar = function(erase) {
		var id = erase.id;
		row = $(erase).parents('tr');
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
	this.borrar = function()
	{
		c = this;
		return _borrar(c);
	};
};

//Objeto nuevo
var caps = new encapsulamiento();
//Carga de tabla
$(document).ready(caps.inicio);
//Borrar
$(document).on('click','.btnBorrado',caps.borrar);
//Editar, mostrar el modal
$(document).on('click','.btnEditado',caps.editar);
//Editar, actualizar el dato
$(document).on('click','#txtIdProducto',caps.actualizar);

