<?php
require_once '../php/conexion.php';

class MantenerConexion
{
    private static function _mantener_sesion()
    {
        //Gestión de errores
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        //Consulta en BD del token guardado cuando se inició sesión
        $pgsql=Conexion::getConnect();
        session_start();
        $usuario=$_SESSION['user'];
        $query="SELECT * FROM Usuario1 WHERE usuario='$usuario'";
        $res = $pgsql->query($query);
        $resultado = $res->fetchObject();
        $token=$resultado->token_remember;
        if(!isset($_SESSION['user']))
        {
            $res = null;
            $pgsql = null;
            header("Location: ../index.php");
            exit();
        }
        
        if($_SESSION["token"] != $token )
        {
            $res = null;
            $pgsql = null;
            header("Location: ../index.php");
            echo '<p>Token no validado</p>'; //Comentar esta linea en producción
            exit();
        }
        return;    
    }
    public static function mantener_sesion()
    {
        return self::_mantener_sesion();
    }
}