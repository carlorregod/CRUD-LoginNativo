<?php 
class Conexion
{
    private static function _getConnect()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        //Declarando parámetros
        $host="localhost";
        $dbname="TablaPagina";
        $port="5432";
        $user="carlos";
        $password="2004330";
        //Cadena de argumentos de conexión
        $arg='pgsql:dbname='.$dbname.';host='.$host.';port='.$port.'';
        //Proceso de conexión
        $mbd = new PDO($arg, $user, $password) or die('Esto falló');
        return $mbd;
    }
    
    public static function getConnect()
    {
        return self::_getConnect();
    }
}



