<?php
session_start();

include_once 'conbd.php';
//include_once 'dashboard/clases/seguridad.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
//recepción de datos enviados mediante POST desde ajax admin admin
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$consulta = "CALL LOGIN_USUARIO('$usuario','$password')";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach($data as $dat){
        $_SESSION["id_usuario"] =  $dat['IdUsuario'];
        $_SESSION["id_rol"] =  $dat['IdRol'];
        $_SESSION["r_rol"] =  $dat['Rol'];
        $_SESSION["u_usuario"] =  $dat['Usuario'];
        $_SESSION["id_empresa"] =  $dat['IdEmpresa'];
        $_SESSION["e_empresa"] =  $dat['Empresa'];
    }                   
}else{
    $_SESSION["id_usuario"] = null;
    $data=null;
}
print json_encode($data);
$conexion=null;
?>