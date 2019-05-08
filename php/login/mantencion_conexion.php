<?php
require_once '../php/conexion.php';
function mantener_sesion()
{
    //Gestión de errores
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    //Consulta en BD del token guardado cuando se inició sesión
    $pgsql=getConnect();
    session_start();
    $usuario=$_SESSION['user'];
    $query="SELECT * FROM Usuario1 WHERE usuario='$usuario'";
    $resultado_=pg_query($pgsql,$query);
    $resultado=pg_fetch_object($resultado_);
    $token=$resultado->token_remember;
    if(!isset($_SESSION['user']))
    {
        header("Location: ../index.php");
        exit();
    }
    
    if($_SESSION["token"] != $token )
    {
        header("Location: ../index.php");
        echo '<p>Token no validado</p>'; //Comentar esta linea en producción
        exit();
    }
    return;
}