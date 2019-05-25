capsula = function(){
	//Limpieza formulario
	limpiaformulario = function() {
		$('#nombre').val('');
		$('#email').val('');
		$('#user').val('');
		$('#pass1').val('');
		$('#pass2').val('');
		return;
	};

	//Respuestas de la BD
	fn_respuesta=function(data) {
		//Respuesta que podrían entregar en forma de data desde la BD
		switch(data)
		{
		case '-1':
			alert('Debe completar todos los campos del formulario');
			break;
			
		case '1':
			alert('Ingrese un nombre válido');
			break;
		
		case '2':
			alert('Correo debe ser válido de la forma alguien@mail.com');
			break;
			
		case '3':
			alert('Alias del usuario debe poseer al menos, una letra y/o un número. Vuelva a ingresar.');
			break;
		
		case '4':
			alert('Alias del usuario debe poseer más de 5 caracteres. Número y letras obligatorio');
			break;
			
		case '5':
			alert('Usuario actualmente en uso, favor especificar otro nombre de usuario');
			break;
		
		case '6':
			alert('Contraseña debe poseer al menos, una letra y/o un número. Vuelva a ingresar.');
			break;
			
		case '7':
			alert('Contraseña debe poseer más de 5 caracteres. Número y letras obligatorio.');
			break;
			
		case '0':
			alert('Registro efectuado exitosamente.');
			limpiaformulario();
			break;
		
		default:
			alert('Hubo un problema, inténtelo más adelante '+data);
			break;	
		}
		return;
	};
	
	this.fn_respuesta = function(dato) {
		return _fn_respuesta(dato);
	};
	//Efectuar un registro
	_registro = function() {
		var nombre = $('#nombre').val();
		var email = $('#email').val();
		var user = $('#user').val();
		var password = $('#pass1').val();
		var pass2 = $('#pass2').val();
		
		if(nombre =='' || email ==''|| user ==''|| password ==''|| pass2 =='')
			{
				alert('Complete todos los campos del formulario');
				return;
			}
		//Validaciones con funciones externas
		
		if(!revisaNombreApellido(nombre))
			{
			alert('Ingrese un nombre válido')
			return;
			}
		if(!revisaEmail(email))
		{
			alert('Correo debe ser válido de la forma alguien@mail.com')
			return;
		}
		if(!revisaUser(user))
			return;
		//Validar pw coincidente
		if(password != pass2)
			{
				alert('Password no coinciden');
				return;
			}
		if(!revisaPassword(password) || !revisaPassword(pass2))
			return;
		//El AJAX
			parametros={
					'nombre':nombre,
					'email':email,
					'user':user,
					'password':password
			};
			url="php/formulario_registro.php";
			method="POST";
			ajaxCallback(parametros, url, method, fn_respuesta);
			return;
			
	};
	
	this.registro = function() {
		return _registro();
	};
	
};

caps = new capsula();
$('#btnEnviar').click(caps.registro);
