<?php
require "../conexion.php";


class ComandoMain
{
    public function __construct($comando, $identificador, $producto)
    {
        $this->cmd      = $comando;
        $this->id       = $identificador;
        $this->producto = $producto;
    }
    
    private function _main()
    {
        switch($this->cmd)
        {
            case "CargaTabla":
                $pgsql = Conexion::getConnect();
                $query = "SELECT * FROM articulos1 ORDER BY serie";
                $result = $pgsql->prepare($query);
                $result->execute() or die("Problemas con la consulta");
                $lista="";
                while($fila = $result->fetchObject())
                {
                    $lista .= '<tr><th>'.$fila->serie.'</th><td>'.$fila->producto.
                    '</td><td><button id="'.$fila->id.'" class="btn btn-outline-primary btnEditado">Editar</button>
            </td><td><button class="btn btn-outline-danger btnBorrado" id="'.$fila->id.'">Eliminar</button></td></tr>';
                }
                //Cerrando conexiones
                $result=null;
                $pgsql=null;
                return $lista;
                break;
                
            case "BorrarRegistro":
                $pgsql = Conexion::getConnect();
                $query = "DELETE FROM articulos1 WHERE id='$this->id'";
                $pgsql->query($query) or die("Problemas con la consulta");
                //Cerrando conexiones
                $pgsql=null;
                return "";
                break;
                
            case "EditarRegistro":
                $pgsql = Conexion::getConnect();
                $query = "SELECT * FROM articulos1 WHERE id='$this->id' LIMIT 1";
                $result = $pgsql->query($query) or die("Problemas con la consulta");
                $resultado = $result->fetch(PDO::FETCH_ASSOC);
                //Cerrando conexiones
                $result=null;
                $pgsql=null;
                return json_encode($resultado, JSON_FORCE_OBJECT);
                break;
                
            case "ActualizarRegistro":
                $pgsql = Conexion::getConnect();
                $query = "UPDATE articulos1 SET producto='$this->producto' WHERE id='$this->id'";
                $result = $pgsql->query($query) or die("Problemas con la consulta");
                $query = "SELECT * FROM articulos1 WHERE id='$this->id' LIMIT 1";
                unset($result);
                $result = $pgsql->query($query) or die("Problemas con la consulta");
                $resultado = $result->fetch(PDO::FETCH_ASSOC);
                $result=null;
                $pgsql=null;
                return json_encode($resultado, JSON_FORCE_OBJECT);
                break;
                
            default:
                break;
        }
    }
    
    public function main()
    {
        return $this->_main();
    }
}

//Lectura de variables desde formulario
$cmd = $_POST['cmd'];
$id = $_POST['id'];
$producto = $_POST['producto'];
//Entregando la respuesta del comando
$menu = new ComandoMain($cmd, $id, $producto);
echo $menu->main();
