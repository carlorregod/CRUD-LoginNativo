<?php

require "conexion.php";

class Registrar
{
    private function _registro()
    {
        //Leo los datos que paso desde AJAX. Sin constructores
        $user=pg_escape_string($_POST['user']);
        $email=pg_escape_string($_POST['email']);
        $nombre=pg_escape_string($_POST['nombre']);
        $password=pg_escape_string($_POST['password']);
        
        $pgsql = Conexion::getConnect();
        $query = "SELECT fn_revisaUsuario('$user')";
        $result = $pgsql->query($query) or die("Problemas con la consulta");
        $val = $result->fetchColumn();
        //Me entregará true si NO existe el usuario
        if($val==false)
            return 5; //user en uso
            else
            {
                unset($result);
                
                $query="SELECT fn_validaAliasPw_r('$password')";
                $result = $pgsql->query($query) or die("Problemas con la consulta");
                
                $val = $result->fetchColumn();
                if($val ==1)
                    return 6; //Debe tener letras y números
                    elseif ($val == 2)
                    return 7; //Debe tener mínimo 5 caracteres
                    else
                    {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        unset($result);
                        unset($val);
                        //$query = "INSERT INTO Usuario1 (nombre, email, usuario, paswd) VALUES ('$nombre','$email','$user','$password')";
                        $query ="SELECT fn_registroUsuario_i('$nombre','$email','$user','$password')";
                        $result = $pgsql->prepare($query) or die('Ha fallado la query');
                        $result->execute();
                        $val = $result->fetchColumn();
                        return $val;
                    }
            }
    }
    
    public function registro()
    {
        return $this->_registro();
    }
}
//Ejecución de la función
$registro = new Registrar();
echo $registro->registro();

