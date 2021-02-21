<?php
include_once '../bd/conbd.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
$cmbempresa = (isset($_POST['cmbempresa'])) ? $_POST['cmbempresa'] : '';
$Descripcion = (isset($_POST['Descripcion'])) ? $_POST['Descripcion'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$IdCategoria = (isset($_POST['IdCategoria'])) ? $_POST['IdCategoria'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "CALL REGISTRO_CATEGORIA('$cmbempresa','$Descripcion')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "CALL ACTUALIZA_CATEGORIA('$IdCategoria','$cmbempresa','$Descripcion')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);   
        break;      
    case 3://baja
        $consulta = "CALL ELIMINA_OBRA('$IdObra')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();    
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);        
        break;        
}
//print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>