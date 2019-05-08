<?php

require "conexion.php";

//Leo los datos que paso desde AJAX
$user=pg_escape_string($_POST['user']);
$email=pg_escape_string($_POST['email']);
$nombre=pg_escape_string($_POST['nombre']);
$password=pg_escape_string($_POST['password']);

$pgsql = getConnect();
$query = "SELECT fn_revisaUsuario('$user')";
$result = pg_query($pgsql, $query) or die("Problemas con la consulta");
$val = pg_fetch_result($result,0);
if($val=='f')
    echo 5; //user en uso
else 
{
    unset($result);
    unset($val);
    
    $query="SELECT fn_validaAliasPw_r('$password')";
    $result = pg_query($pgsql, $query) or die("Problemas con la consulta");
    $val = pg_fetch_result($result,0);
    if($val ==1)
        echo 6; //Debe tener letras y números
    elseif ($val == 2)
        echo 7; //Debe tener mínimo 5 caracteres
        else 
        {
            $password = password_hash($password, PASSWORD_DEFAULT);
            unset($result);
            unset($val);
            //$query = "INSERT INTO Usuario1 (nombre, email, usuario, paswd) VALUES ('$nombre','$email','$user','$password')";
            $query ="SELECT fn_registroUsuario_i('$nombre','$email','$user','$password')";
            $result = pg_prepare($pgsql, "my_query", $query) or die('Ha fallado la query');
            $result = pg_execute($pgsql, "my_query", []) or die('Ha fallado la query');
            $val = pg_fetch_result($result,0);
            echo $val;
        }
}
