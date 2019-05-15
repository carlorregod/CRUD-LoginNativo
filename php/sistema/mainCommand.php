<?php
require "../conexion.php";

$cmd = $_POST['cmd'];
$id = $_POST['id'];

switch($cmd)
{
    case "CargaTabla":
        $pgsql = getConnect();
        $query = "SELECT * FROM articulos1 ORDER BY serie";
        $result = pg_query($pgsql, $query) or die("Problemas con la consulta");
        $lista="";
        while($fila = pg_fetch_object($result))
        {
            $lista .= '<tr><th>'.$fila->serie.'</th><td>'.$fila->producto.
            '</td><td><button id="'.$fila->id.'" class="btn btn-outline-primary" onclick="editar(this)">Editar</button>      
            </td><td><button class="btn btn-outline-danger btnBorrado" id="'.$fila->id.'">Eliminar</button></td></tr>';
        }
        pg_close($pgsql);
        echo $lista;
        break;
        
    case "BorrarRegistro":       
        $pgsql = getConnect();
        $query = "DELETE FROM articulos1 WHERE id='$id'";
        $result = pg_query($pgsql, $query) or die("Problemas con la consulta");
        pg_close($pgsql);
        echo "";
        break;
        
    case "EditarRegistro":
        $pgsql = getConnect();
        $query = "SELECT * FROM articulos1 WHERE id='$id' LIMIT 1";
        $result = pg_query($pgsql, $query) or die("Problemas con la consulta");
        $resultado = pg_fetch_array($result);
        pg_close($pgsql);
        echo json_encode($resultado, JSON_FORCE_OBJECT);
        break;
        
    case "ActualizarRegistro":
        $producto = $_POST['producto'];
        $pgsql = getConnect();
        $query = "UPDATE articulos1 SET producto='$producto' WHERE id='$id'";
        $result = pg_query($pgsql, $query) or die("Problemas con la consulta");
        $query = "SELECT * FROM articulos1 WHERE id='$id' LIMIT 1";
        unset($result);
        $result = pg_query($pgsql, $query) or die("Problemas con la consulta");
        $resultado = pg_fetch_array($result);
        pg_close($pgsql);
        echo json_encode($resultado, JSON_FORCE_OBJECT);
        break;
        
    default:
        break;
}


