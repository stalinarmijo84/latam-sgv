<?php require_once "parte_superior.php"?>
<!-- End of Topbar -->
<!--INICIO del cont principal-->
<div class="container">
    <h3>Gestion de reporte de Diarios</h3>
    <?php
    include_once 'bd/conbd.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $consulta = "CALL CONSULTA_REPORTE_DIARIO()";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <form action="reportes/reporteExcelDiario.php" method="POST" class="form-inline my-2 my-lg-0 sclass">
            <div class="form-group">
                <select class="con_estilos_reporte" id="idcmbempresa" name="cmbempresa" required
                    placeholder="Seleccione la empresa">
                    <?php
                    $consulta = "CALL LLENA_COMBO_EMPRESA()";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $empresa=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    foreach($empresa as $dato){
                        echo '<option value="'.$dato['IdEmpresa'].'">'.$dato['Descripcion'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="date" name="Fdesde" placeholder="Fecha desde" required class="fecha_reporte">
            </div>
            </br>
            <div class="form-group">
                <input type="date" name="Fhasta" placeholder="Fecha hasta" required class="fecha_reporte">
            </div>
            </br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Generar
                    Reporte </a></button>
            </div>
            <br>
            <div class="form-group">
                <a href="reporte_diario.php" type="button" class="btn btn-info btn-sm">Refresh</a>
            </div>
        </form>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaReporteDiario" class="table table-striped table-bordered table-condensed"
                        style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Tipo</th>
                                <th>Motivo</th>
                                <th>Fecha</th>
                                <th>Detalle</th>
                                <th>Ingreso</th>
                                <th>Egreso</th>
                                <th>Registro</th>
                                <th>.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['IdDiario'] ?></td>
                                <td><?php echo $dat['Tipo'] ?></td>
                                <td><?php echo $dat['Motivo'] ?></td>
                                <td><?php echo $dat['Fecha'] ?></td>
                                <td><?php echo $dat['Detalle'] ?></td>
                                <td><?php echo $dat['Ingreso'] ?></td>
                                <td><?php echo $dat['Egreso'] ?></td>
                                <td><?php echo $dat['FechaReg'] ?></td>
                                <td>.</td>
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
</div>
</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
        <span>Copyright &copy; Desarrollado por Latam Digital Solutions - 2021</span>
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
<script type="text/javascript" src="js/reporte_diario.js"></script>
<script src="buscador/js/select2.js"></script>
</body>

</html>
<script>
    $(document).ready(function(){
        $('#idcmbempresa').select2();
        });
</script>