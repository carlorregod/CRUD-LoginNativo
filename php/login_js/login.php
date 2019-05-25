<?php

require '../conexion.php';

class LoginJs
{
    private function _login_js()
    {
        $user = pg_escape_string($_POST['user']);
        $password = pg_escape_string($_POST['password']);
        $token = $_POST['token'];
        //Encriptando pw para comparar
        $pgsql = Conexion::getConnect();
        $query = "SELECT nombre, usuario, paswd FROM Usuario1 WHERE usuario='$user'";
        $resultado = $pgsql->query($query);
        $consulta = $resultado->fetchAll();
        $pass = password_verify($password, $consulta[0]['paswd']);
        if(!$pass)
        {
            return 'PasswordDistinto';
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
            //Cerrando conexiones...
            $resultado = null;
            $pgsql = null;
            return 'IngresoExitoso';
            exit;
        }
    }
    public function login_js()
    {
        return $this->_login_js();
    }
}

//Objeto de loginjs
$login = new LoginJs();
//Generando la respuesta
echo $login->login_js();

