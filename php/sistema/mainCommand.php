<?php
require "../conexion.php";

$cmd = $_POST['cmd'];


switch($cmd)
{
    case "CargaTabla":
        $pgsql = getConnect();
        $query = "SELECT * FROM articulos1";
        $result = pg_query($pgsql, $query) or die("Problemas con la consulta");

        $lista="";
        while($fila = pg_fetch_object($result))
        {
            $lista .= '<tr><th>'.$fila->serie.'</th><td>'.$fila->producto.
            '</td><td>BOTON EDITAR</td><td>BOTON BORRAR</td></tr>';
        }
        pg_close($pgsql);
        echo $lista;
        break;
    
    default:
        break;
}


