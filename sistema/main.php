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
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar registro:&nbsp </h5>
            <h5 class="modal-title" id="registroCustomID"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <table>
           	<tr>
           		<td>Nombre nuevo:</td>
           		<td><input type="text" id="txtNombreProducto" value="" placeholder="Ingrese nombre"/></td>
           	</tr>
           </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="txtIdProducto" onclick="actualizar(this)">Actualizar</button>
          </div>
        </div>
      </div>
    </div>
    
    
    
    <!-- Formulario -->
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
       		<input type="submit" class="btn btn-primary btn-block my-2 mx-2" value="Salir">
       	</form>

   		<button class="btn btn-primary btn-block my-2 mx-2" id="btnSalir" onclick="salida()">Salir por js</button>
    </body>
    <footer>
    	<script src="https://code.jquery.com/jquery-3.4.0.js"
			  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
			  crossorigin="anonymous"></script> 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="../js/utilidades.js"></script>
		<script src="../js/sistema/main.js"></script>	 
		<script src="../js/logout.js"></script>	  	  
    </footer>
</html>

