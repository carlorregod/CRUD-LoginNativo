<?php

require '../conexion.php';

class LoginA
{
    private static function _login()
    {
        $user = pg_escape_string($_POST['user']);
        $password = pg_escape_string($_POST['password']);
        $token = $_POST['token'];
        //Encriptando pw para comparar
        $pgsql = Conexion::getConnect();
        $query = "SELECT nombre, usuario, paswd FROM Usuario1 WHERE usuario='$user'";
        $resultado = $pgsql->prepare($query);
        $resultado->execute();
        $consulta = $resultado->fetchAll();
        $pass = password_verify($password, $consulta[0]['paswd']);
        if(!$pass)
        {
            $resultado = null;
            $pgsql = null;
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
            $pgsql->query($query);
            //Iniciar sesión
            session_start();
            $_SESSION['user'] =$user;
            $_SESSION['token'] =$token;
            $_SESSION['nombre'] =$nombre;
            $resultado = null;
            $pgsql = null;
            header('location: ../../sistema/main.php');
            exit;
        }
    }
    public static function login()
    {
        return self::_login();
    }
}
//Aplicando el login
echo LoginA::login();
