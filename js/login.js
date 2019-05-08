fn_callback_respuesta=function(respuesta) {
	if(respuesta == 'PasswordDistinto')
	{
		alert('Usuario y/o password no corresponden');
	}
	else
	{
		location.href='sistema/main.php';
	}
		
};

function ingresar() {
	//Recolección de valores
	user=$('#user').val();
	password=$('#password').val();
	token=$('#token').val();
	
	parametros={
			'user':user,
			'password':password,
			'token':token
	};
	method="POST";
	url="php/login_js/login.php";
	ajaxCallback(parametros, url, method, fn_callback_respuesta);
	return;
}


//$.ready = ingresar();
