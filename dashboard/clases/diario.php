<?php
include_once '../bd/conbd.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
$IdUsuario = (isset($_POST['IdUsuario'])) ? $_POST['IdUsuario'] : '';
$IdEmpresa = (isset($_POST['IdEmpresa'])) ? $_POST['IdEmpresa'] : '';
$cmbtipo_diario = (isset($_POST['cmbtipo_diario'])) ? $_POST['cmbtipo_diario'] : '';
$cmbcategoria = (isset($_POST['cmbcategoria'])) ? $_POST['cmbcategoria'] : '';
$cmbtercero = (isset($_POST['cmbtercero'])) ? $_POST['cmbtercero'] : '';
$Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : '';
$Detalle = (isset($_POST['Detalle'])) ? $_POST['Detalle'] : '';
$Valor = (isset($_POST['Valor'])) ? $_POST['Valor'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$IdDiario = (isset($_POST['IdDiario'])) ? $_POST['IdDiario'] : '';

if($cmbtipo_diario==1){
    $Ingreso = $Valor;
    $Egreso = 0.00;
}if($cmbtipo_diario==2){
    $Egreso = $Valor;
    $Ingreso = 0.00;
}
switch($opcion){
    case 1: //alta
        $consulta = "CALL REGISTRO_DIARIO('$IdUsuario','$IdEmpresa','$cmbtipo_diario','$cmbcategoria','$cmbtercero','$Fecha','$Detalle','$Ingreso','$Egreso')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "CALL ACTUALIZA_DIARIO('$IdDiario','$IdEmpresa','$IdUsuario','$cmbtipo_diario','$cmbcategoria','$cmbtercero','$Fecha','$Detalle','$Ingreso','$Egreso')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);   
        break;      
    case 3://baja
        $consulta = "CALL ELIMINA_DIARIO('$IdDiario')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();    
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);        
        break;        
}
//print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>
