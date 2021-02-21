<?php
require_once "../bd/conbd.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$cmbempresa = (isset($_POST['cmbempresa'])) ? $_POST['cmbempresa'] : '';
$Fdesde = (isset($_POST['Fdesde'])) ? $_POST['Fdesde'] : '';
$Fhasta = (isset($_POST['Fhasta'])) ? $_POST['Fhasta'] : '';
header("Content-Type: application/vnd.ms-excel");
$hoy = date("Y-m-d");
header("Content-Disposition: attachment; filename=Reporte-$hoy.xls");
?>
<table border="1" cellpadding="1" cellspacing="1">
    <tr>
        <td><strong>Id</strong></td>
        <td><strong>Usuario</strong></td>
        <td><strong>Empresa</strong></td>
        <td><strong>Tipo</strong></td>
        <td><strong>Motivo</strong></td>
        <td><strong>Tercero</strong></td>
        <td><strong>Fecha</strong></td>
        <td><strong>Detalle</strong></td>
        <td><strong>Ingreso</strong></td>
        <td><strong>Egreso</strong></td>
    </tr>
    <?php
    $ingreso=0;
    $egreso=0;   
    $total=0; 
    $sql = "CALL REPORTE_DIARIO('$cmbempresa','$Fdesde','$Fhasta')";
    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    $dato=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach($dato as $data){  
    ?>
    <tr>
        <td><?php echo $data["IdDiario"];?></td>
        <td><?php echo $data["Usuario"];?> </td>
        <td><?php echo $data["Empresa"];?> </td>
        <td><?php echo $data["Tipo"];?> </td>
        <td><?php echo $data["Motivo"];?></td>
        <td><?php echo $data["Tercero"];?></td>
        <td><?php echo $data["Fecha"];?></td>
        <td><?php echo $data["Detalle"];?></td>
        <td><?php echo $data["Ingreso"];?></td>
        <td><?php echo $data["Egreso"];?></td>
    </tr>
    <?php
               $ingreso+=$data['Ingreso'];
               $egreso+=$data['Egreso'];
          }  
          $total=$ingreso-$egreso;
        ?> 
          <tr>
	        	<td colspan="8" class="text-left"><strong>SUMA:</strong></td>
                <td><strong style="color:green;">$<?php echo $ingreso;?></strong> </td>
                <td><strong style="color:green;">$<?php echo $egreso;?></strong> </td>
          </tr>
          <tr>
          <td colspan="8" class="text-left"><strong>TOTAL:</strong></td>
          <td colspan="2" class="text-center"><strong style="color:red;">$<?php echo $total;?></strong> </td>
          </tr>
</table>
</strong>