<?php
include_once '../bd/conbd.php';
//include_once 'seguridad.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
$cmbempresa = (isset($_POST['cmbempresa'])) ? $_POST['cmbempresa'] : '';
$cmbrol = (isset($_POST['cmbrol'])) ? $_POST['cmbrol'] : '';
$Usuario = (isset($_POST['Usuario'])) ? $_POST['Usuario'] : '';
$Clave = (isset($_POST['Clave'])) ? $_POST['Clave'] : '';
$cmbestado = (isset($_POST['cmbestado'])) ? $_POST['cmbestado'] : '';
$IdUsuario = (isset($_POST['IdUsuario'])) ? $_POST['IdUsuario'] : '';
//$pass = password_hash($Clave, PASSWORD_DEFAULT, ['cost' => 10]);
//$pass = seguridad::encryption($Clave);
//$pass = sha1($Clave);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
switch($opcion){
    case 1: //alta
        $consulta = "CALL REGISTRO_USUARIO('$cmbempresa','$cmbrol','$Usuario','$Clave')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "CALL ACTUALIZA_USUARIO('$IdUsuario','$cmbempresa','$cmbrol','$Usuario','$Clave','$cmbestado')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);   
        break;      
    case 3://baja
        $consulta = "CALL ELIMINA_USUARIO($IdUsuario)";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();    
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);        
        break;        
}
//print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>