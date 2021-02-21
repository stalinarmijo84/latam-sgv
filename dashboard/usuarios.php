<?php require_once "parte_superior.php"?>
<!-- End of Topbar -->
<!--INICIO del cont principal-->
<div class="container">
    <h3> Gestion de Usuarios</h3>
    <?php
    include_once 'bd/conbd.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $consulta = "CALL CONSULTA_USUARIO();";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Registrar nuevo</button>
                <a href="usuarios.php" type="button" class="btn btn-info">Refresh</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed"
                        style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Empresa</th>
                                <th>Rol</th>
                                <th>Usuario</th>
                                <th>Clave</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['IdUsuario'] ?></td>
                                <td><?php echo $dat['Empresa']?></td>
                                <td><?php echo $dat['Rol']?></td>
                                <td><?php echo $dat['Usuario']?></td>
                                <td><?php echo $dat['Clave']?></td>
                                <td><?php echo $dat['Estado']?></td>
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
                <form id="formUsuarios">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Seleccione la Empresa</label></br>
                            <select class="con_estilos" id="idcmbempresa" name="cmbempresa" required>
                                <?php
                                $consulta = "CALL LLENA_COMBO_EMPRESA()";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $empresas=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($empresas as $dato){
                                    echo '<option value="'.$dato['IdEmpresa'].'">'.$dato['Descripcion'].'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Seleccione el rol</label></br>
                            <select class="con_estilos" id="idcmbrol" name="cmbrol" required>
                                <?php
                                $consulta = "CALL LLENA_COMBO_ROL()";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $roles=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($roles as $dato){
                                    echo '<option value="'.$dato['IdRol'].'">'.$dato['Descripcion'].'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Seleccione el estado</label></br>
                            <select class="con_estilos" id="idcmbestado" name="cmbestado" required>
                                <?php
                                $consulta = "CALL LLENA_COMBO_ESTADO()";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $estado=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($estado as $dato){
                                    echo '<option value="'.$dato['IdEstado'].'">'.$dato['Estado'].'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Usuario:</label>
                            <input type="text" class="text_texto" id="Usuario" name="Usuario" require>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Clave:</label>
                            <input type="text" class="text_texto" id="Clave" name="Clave" require>
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
<script type="text/javascript" src="js/usuario.js"></script>
<script src="buscador/js/select2.js"></script>
</body>

</html>
<script>
    $(document).ready(function(){
        $('#idcmbempresa').select2();
        $('#idcmbrol').select2();
        $('#idcmbestado').select2();
        });
</script>