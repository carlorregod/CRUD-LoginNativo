<?php

require '../conexion.php';

$user = pg_escape_string($_POST['user']);
$password = pg_escape_string($_POST['password']);
$token = $_POST['token'];
//Encriptando pw para comparar
$pgsql = getConnect();
$query = "SELECT nombre, usuario, paswd FROM Usuario1 WHERE usuario='$user'";
$resultado = pg_query($pgsql,$query);
$consulta = pg_fetch_all($resultado);
$pass = password_verify($password, $consulta[0]['paswd']);
if(!$pass) 
{
    header('location: ../../index.php');
    exit;
  
}
else
{ 
    //Capturando el nombre
    $nombre = $consulta[0]['nombre'];
    //Generación de token
    $token = crypt($_POST['token']);
    $query="UPDATE Usuario1 SET token_remember ='$token' WHERE usuario='$user'";
    pg_query($pgsql,$query);
    //Iniciar sesión
    session_start();
    $_SESSION['user'] =$user;
    $_SESSION['token'] =$token;
    $_SESSION['nombre'] =$nombre;
    header('location: ../../sistema/main.php');
    exit;
}