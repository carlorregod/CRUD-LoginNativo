<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Login</title>
    </head>
    <body>
        <h2 class="p-3 mb-2 bg-primary text-white">Ingresar al sistema</h2>
		<form action="php/login/login.php" method="POST">
		<input type="hidden" name="token" id="token" value="<?php md5(time());?>">
       <table class="my-3 mx-5">  
       <tr>   
       		<td><label for="nombre">Alias usuario</label></td>
       		<td><input type="text" name="user" id="user" maxlength="50" required onkeypress="return soloNombre(event)"></td>
       	</tr>
       	<tr>
       		<td><label for="password">Contraseña</label></td>
       		<td><input type="password" name="password" id="password" required>
       	</tr>
       	<tr>
       		<td class="py-3" colspan="2"><input type="submit" name="btnIngresar" id="btnIngresar" class="btn btn-primary" value="Ingresar"></td>
       	</tr> 
       	<tr>
       		<td class="py-3" colspan="2"><input type="button" name="btnIngresar2" id="btnIngresar2" class="btn btn-primary" value="Ingresar por js" onclick="ingresar()"></td>
       	</tr>     
       </table>
       </form>
       <form action="register.php" method="POST">
       		<input type="submit" class="btn btn-primary my-2 mx-5" value="Registrarse">
       </form>
    </body>
    <footer>
    	<script src="https://code.jquery.com/jquery-3.4.0.js"
			  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
			  crossorigin="anonymous"></script> 
		<script src="js/utilidades.js"></script>	  
		<script src="js/login.js"></script>
    </footer>
</html>