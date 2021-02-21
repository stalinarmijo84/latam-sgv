<?php 
class Conexion{	  
    public static function Conectar() {        
        define('servidor', 'latamds.org');
        define('nombre_bd', 'latamdso_sgv');
        define('usuario', 'latamdso_sgv_admin');
        define('password', 'Sgv.2021*');					        
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
        try{
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);			
            return $conexion;
        }catch (Exception $e){
            die("El error de Conexión es: ". $e->getMessage());
        }
    }
}