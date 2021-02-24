<?php
include_once '../bd/conbd.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
$cmbtipo = (isset($_POST['cmbtipo'])) ? $_POST['cmbtipo'] : '';
$Nombres = (isset($_POST['Nombres'])) ? $_POST['Nombres'] : '';
$Apellidos = (isset($_POST['Apellidos'])) ? $_POST['Apellidos'] : '';
$Identificacion = (isset($_POST['Identificacion'])) ? $_POST['Identificacion'] : '';
$Direccion = (isset($_POST['Direccion'])) ? $_POST['Direccion'] : '';
$Telefono = (isset($_POST['Telefono'])) ? $_POST['Telefono'] : '';
$Email = (isset($_POST['Email'])) ? $_POST['Email'] : '';
$cmbiva = (isset($_POST['cmbiva'])) ? $_POST['cmbiva'] : '';
$cmbrenta = (isset($_POST['cmbrenta'])) ? $_POST['cmbrenta'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$IdTercero = (isset($_POST['IdTercero'])) ? $_POST['IdTercero'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "CALL REGISTRO_TERCERO('$cmbtipo','$Nombres','$Apellidos','$Identificacion','$Direccion','$Telefono','$Email','$cmbiva','$cmbrenta')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
    break;
    case 2: //modificación
        $consulta = "CALL ACTUALIZA_TERCERO('$IdTercero','$cmbtipo','$Nombres','$Apellidos','$Identificacion','$Direccion','$Telefono','$Email','$idRetencionIVA','$idRetencionRenta')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);   
    break;      
    case 3://baja
        $consulta = "CALL ELIMINA_TERCERO($IdTercero)";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();    
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);        
    break;        
}
//print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>
