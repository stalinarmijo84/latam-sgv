<?php
include_once '../bd/conbd.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
$cmbempresa = (isset($_POST['cmbempresa'])) ? $_POST['cmbempresa'] : '';
$Nombres = (isset($_POST['Nombres'])) ? $_POST['Nombres'] : '';
$Apellidos = (isset($_POST['Apellidos'])) ? $_POST['Apellidos'] : '';
$Identificacion = (isset($_POST['Identificacion'])) ? $_POST['Identificacion'] : '';
$Direccion = (isset($_POST['Direccion'])) ? $_POST['Direccion'] : '';
$Telefono = (isset($_POST['Telefono'])) ? $_POST['Telefono'] : '';
$Email = (isset($_POST['Email'])) ? $_POST['Email'] : '';
$cmbcargo = (isset($_POST['cmbcargo'])) ? $_POST['cmbcargo'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$IdEmpleado = (isset($_POST['IdEmpleado'])) ? $_POST['IdEmpleado'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "CALL REGISTRO_EMPLEADO('$cmbempresa','$Nombres','$Apellidos','$Identificacion','$Direccion','$Telefono','$Email','$cmbcargo')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "CALL ACTUALIZA_EMPLEADO('$IdEmpleado','$cmbempresa','$Nombres','$Apellidos','$Identificacion','$Direccion','$Telefono','$Email','$cmbcargo')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);   
        break;      
    case 3://baja
        $consulta = "CALL ELIMINA_EMPLEADO($IdEmpleado)";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();    
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);        
        break;        
}

//print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>


<?php require_once "parte_superior.php"?>
<!-- End of Topbar -->
<!--INICIO del cont principal-->
<div class="container">
    <h3>Gestion de Empleados</h3>
    <?php
include_once 'bd/conbd.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$consulta = "CALL CONSULTA_EMPLEADOS()";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Registrar nuevo</button>
                <a href="empleados.php" type="button" class="btn btn-info">Refresh</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaEmpleados" class="table table-striped table-bordered table-condensed"
                        style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Empresa</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Identificacion</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Cargo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['IdEmpleado'] ?></td>
                                <td><?php echo $dat['Empresa'] ?></td>
                                <td><?php echo $dat['Nombres'] ?></td>
                                <td><?php echo $dat['Apellidos'] ?></td>
                                <td><?php echo $dat['Identificacion'] ?></td>
                                <td><?php echo $dat['Direccion'] ?></td>
                                <td><?php echo $dat['Telefono'] ?></td>
                                <td><?php echo $dat['Email'] ?></td>
                                <td><?php echo $dat['Cargo'] ?></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex=null role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEmpleados">
                    <div class="modal-body">
                    <div class="form-group">
                            <label class="col-form-label">Seleccione la Empresa</label></br>
                            <select class="con_estilos" id="idcmbempresa" name="cmbempresa" required>
                                <?php
                                $consulta = "CALL LLENA_COMBO_EMPRESAS()";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $empleados=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($empleados as $dato){
                                    echo '<option value="'.$dato['IdEmpresa'].'">'.$dato['Descripcion'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nombres:</label>
                            <input type="text" class="text_texto" class="form-control" id="Nombres" name="Nombres" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Apellidos:</label>
                            <input type="text" class="text_texto" class="form-control" id="Apellidos" name="Apellidos" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Identificacion:</label>
                            <input type="text" class="text_texto" id="Identificacion" name="Identificacion" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Direccion:</label>
                            <textarea class="textarea" id="Direccion" name="Direccion" rows="3" cols="50" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Telefono:</label>
                            <input type="text" class="text_texto" id="Telefono" name="Telefono" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Correo:</label>
                            <input type="email" class="text_texto" id="Email" name="Email" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Seleccione el cargo</label></br>
                            <select class="con_estilos" id="idcmbcargo" name="cmbcargo" required>
                                <?php
                                $consulta = "CALL LLENA_COMBO_CARGO()";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $empleados=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($empleados as $dato){
                                    echo '<option value="'.$dato['IdCargo'].'">'.$dato['Descripcion'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--FIN del cont principal-->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Todos los derechos reservados.</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Confirma salir y cerrar Sesión?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="../bd/logout.php">Salir</a>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- datatables JS -->
<script type="text/javascript" src="vendor/datatables/datatables.min.js"></script>
<!-- código propio JS -->
<script type="text/javascript" src="js/empleado.js"></script>
<script src="buscador/js/select2.js"></script>
<script type="text/javascript" src="js/combo_buscar.js"></script>
</body>

</html>