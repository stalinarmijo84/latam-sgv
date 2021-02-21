<?php
include_once '../bd/conbd.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
$Descripcion = (isset($_POST['Descripcion'])) ? $_POST['Descripcion'] : '';
$Ruc = (isset($_POST['Ruc'])) ? $_POST['Ruc'] : '';
$Direccion = (isset($_POST['Direccion'])) ? $_POST['Direccion'] : '';
$Telefono = (isset($_POST['Telefono'])) ? $_POST['Telefono'] : '';
$Email = (isset($_POST['Email'])) ? $_POST['Email'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$IdEmpresa = (isset($_POST['IdEmpresa'])) ? $_POST['IdEmpresa'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "CALL REGISTRO_EMPRESA('$Descripcion','$Ruc','$Direccion','$Telefono','$Email')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "CALL ACTUALIZA_EMPRESA($IdEmpresa,'$Descripcion','$Ruc','$Direccion','$Telefono','$Email')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);   
        break;      
    case 3://baja
        $consulta = "CALL ELIMINA_EMPRESA($IdEmpresa)";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();    
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);        
        break;        
}
//print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>