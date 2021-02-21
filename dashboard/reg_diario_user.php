<?php require_once "parte_superior.php"?>
<!-- End of Topbar -->
<!--INICIO del cont principal-->
<div class="container">
    <h3>Gestion de Ingresos/Egresos</h3>
    <?php
     include_once 'bd/conbd.php';
     $objeto = new Conexion();
     $conexion = $objeto->Conectar();
     $consulta = "CALL CONSULTA_DIARIO_USUARIO($IdEmpresa)";
     $resultado = $conexion->prepare($consulta);
     $resultado->execute();
     $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Registrar nuevo</button>
                <a href="reg_diario_user.php" type="button" class="btn btn-info">Refresh</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaDiarios" class="table table-striped table-bordered table-condensed"
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
                                <th>Estado</th>
                                <th>Acciones</th>
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
                                <td><?php echo $dat['Estado'] ?></td>
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
                <form id="formDiario">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Seleccione el tipo del diario</label></br>
                            <select class="con_estilos" id="idcmbtipo_diario" name="cmbtipo_diario" required>
                                <?php
                                 $consulta = "CALL LLENA_COMBO_TIPO()";
                                 $resultado = $conexion->prepare($consulta);
                                 $resultado->execute();
                                 $tipo=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                 foreach($tipo as $dato){
                                    echo '<option value="'.$dato['IdTipoDiario'].'">'.$dato['Descripcion'].'</option>';
                                  }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Seleccione el motivo</label></br>
                            <select class="con_estilos" id="idcmbcategoria" name="cmbcategoria" required>
                                <?php
                                 $consulta = "CALL CONSULTA_CATEGORIA_USUARIO($IdEmpresa)";
                                 $resultado = $conexion->prepare($consulta);
                                 $resultado->execute();
                                 $cuentas=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                 foreach($cuentas as $dato){
                                    echo '<option value="'.$dato['IdCategoria'].'">'.$dato['Descripcion'].'</option>';
                                  }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Seleccione Cliente/Proveedor</label></br>
                            <select class="con_estilos" id="idcmbtercero" name="cmbtercero" required>
                                <?php
                                 $consulta = "CALL LLENA_COMBO_TERCERO()";
                                 $resultado = $conexion->prepare($consulta);
                                 $resultado->execute();
                                 $cuentas=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                 foreach($cuentas as $dato){
                                    echo '<option value="'.$dato['IdTercero'].'">'.$dato['Tercero'].'</option>';
                                  }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="Fecha" class="col-form-label">Detalle:</label><br>
                        <input type="hidden" id="IdUsuario" name="IdUsuario" value="<?php echo $IdUsuario?>">
                        <input type="hidden" id="IdEmpresa" name="IdEmpresa" value="<?php echo $IdEmpresa?>">
                            <textarea class="textarea" id="Detalle" name="Detalle" rows="3" cols="50" required></textarea> 
                        </div>
                        <div class="form-group">
                            <label for="Fecha" class="col-form-label">Fecha:</label><br>
                            <input type="date" id="Fecha" name="Fecha" class="fecha" value="<?php echo $fecha_actual ?>"
                                required>
                            <input type="number" step="0.01" class="text_valor" id="Valor" name="Valor" required placeholder="Valor">
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
<script type="text/javascript" src="js/diario.js"></script>
<script src="buscador/js/select2.js"></script>
</body>

</html>
<script>
    $(document).ready(function(){
        $('#idcmbtipo_diario').select2();
        $('#idcmbcategoria').select2();
        $('#idcmbtercero').select2();
        });
</script>