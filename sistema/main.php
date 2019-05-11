<?php 
require_once '../php/login/mantencion_conexion.php';
mantener_sesion();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Bienvenido</title>
    </head>
    <body>
       	<h2 class="p-3 mb-2 bg-primary text-white">Bienvenido al sistema <?php echo strtoupper($_SESSION['nombre']);?></h2>
        <table class="table table-sm px-4 py-4">
              <thead>
                <tr>
                  <th scope="col">Serie</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Actualizar</th>
                  <th scope="col">Borrar</th>
                </tr>
              </thead>
              <tbody id="tablaProductos">

              </tbody>
        </table>
       	<form action="../php/login/logout.php" method="POST">
       		<input type="submit" class="btn btn-primary my-2 mx-5" value="Salir">
       	</form>

   		<button class="btn btn-primary my-2 mx-5" id="btnSalir" onclick="salida()">Salir por js</button>
    </body>
    <footer>
    	<script src="https://code.jquery.com/jquery-3.4.0.js"
			  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
			  crossorigin="anonymous"></script> 
		<script src="../js/utilidades.js"></script>
		<script src="../js/sistema/main.js"></script>	 
		<script src="../js/logout.js"></script>	  	  
    </footer>
</html>

