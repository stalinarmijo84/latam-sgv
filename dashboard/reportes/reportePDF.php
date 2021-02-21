
<?php
include("conexion.php");
require_once("libs/dompdf/dompdf_config.inc.php");
$html='
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Table</title>
</head>
 <h1>Reportes</h1><img src="img/downalod-pdf.jpg" width="200px" height="100px"><br>
   <label>Nombre:<strong>Juan</strong></label><br>
   <label>Apellido:<strong>Peres Rosario</strong></label><br>
   <label>Cedula:<strong>021-3434675-8</strong></label>
   
    <table  border="1" cellpadding="1" cellspacing="1">
        <tr>
          <td><strong>Id</strong></td>
          <td><strong>Cliente</strong></td>
          <td><strong>Rnc</strong></td>
          <td><strong>Fecha de Compra</strong></td>
          <td><strong>Producto</strong></td>
          <td><strong>Cantidad</strong></td>
          <td><strong>Total</strong></td>
        </tr>';
 
          $total=0;
          $sql="SELECT * FROM `tbfactura`";
          $res=mysqli_query($GLOBALS['cn'],$sql)or die("problema con la consulta");
       
          while($data=mysqli_fetch_array($res)){  
         $html.='
          <tr>
            <td>'.$data["id_factura"].'</td>
            <td>'.$data["Cliente"].' </td>
            <td>'.$data["RNC"].'</td>
            <td>'.$data["Fecha"].'</td>
            <td>'.$data["producto"].'</td>
            <td>'.$data["precio"].'</td>
            <td>'.$data["total"].'</td>
          </tr>';
        
               $total+=$data['total'];
          }    
     $html.='
          <tr>
	        	<td colspan="6" class="text-right"><strong>TOTAL:</strong></td>
	        	<td><strong style="color:green;">$'.$total.'</strong> </td>
	      </tr>
      </table>
      <strong style="color:red;">Fecha:'.$hoy = date("Y-m-d H:i:s").'</strong>
<body>
</body>
</html>';
$codigo=utf8_encode($html);
$dompdf=new DOMPDF();
$dompdf->load_html($codigo);
ini_set("memory_limit","128M");
$dompdf->render();
$hoy = date("Y-m-d");
$dompdf->stream("Reporte_$hoy.pdf");
