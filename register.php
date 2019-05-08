
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Nuevo usuario</title>
    </head>
    <body>
        <h2 class="p-3 mb-2 bg-primary text-white">Registrar nuevo usuario</h2>

       <table class="my-3 mx-5">     
       	<tr>
       		<td><label for="nombre">Nombre y Apellido</label></td>
       		<td><input type="text" name="nombre" id="nombre" maxlength="100" required onkeypress="return soloNombreApellido(event)">
       	</tr>
       	<tr>
       		<td><label for="email">Correo electrónico</label></td>
       		<td><input type="email" name="email" id="email" maxlength="50" required onkeypress="return soloEmail(event)">
       	</tr>
       	<tr>
       		<td><label for="nombre">Alias usuario</label></td>
       		<td><input type="text" name="user" id="user" maxlength="50" required onkeypress="return soloNombre(event)">
       	</tr>
       	<tr>
       		<td><label for="pass1">Contraseña</label></td>
       		<td><input type="password" name="pass1" id="pass1" required>
       	</tr>
       	<tr>
       		<td><label for="pass2">Confirme contraseña</label></td>
       		<td><input type="password" name="pass2" id="pass2" required>
       	</tr>
       	<tr>
       		<td class="py-3" colspan="2"><button name="btnEnviar" id="btnEnviar" class="btn btn-primary">Registrar</button></td>
       	</tr>    
       </table>
       <form action="index.php" method="POST">
       		<input type="submit" class="btn btn-primary my-2 mx-5" value="Ingresar">
       </form>
    </body>
    <footer>
    	<script src="https://code.jquery.com/jquery-3.4.0.js"
			  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
			  crossorigin="anonymous"></script> 
		<script src="js/utilidades.js"></script>	  
		<script src="js/register.js"></script>
    </footer>
</html>