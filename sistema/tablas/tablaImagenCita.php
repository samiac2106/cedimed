<?php
include("../../db/Conexion.php");
$conectar = new Conexion();
session_start();
?>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>General Copago</h2>
            <ul class="nav navbar-right panel_toolbox">
                <button class="btn btn-dark" data-toggle="modal" data-target="#registrarOrden">Registrar Orden Médica</button>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <p class="text-muted font-13 m-b-30">
                            Aquí se encuentra todas las citas realizadas de todos los asesores
                        </p>
                        <table id="datatable" class="table table table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha Registro</th>
                                    <th>Usuario</th>
                                    <th>Adjunto</th>
                                    <th>Pregunta</th>
                                    <th>Respuesta</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha Registro</th>
                                    <th>Usuario</th>
                                    <th>Adjunto</th>
                                    <th>Pregunta</th>
                                    <th>Respuesta</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <?php

                            $consultaSQL = "SELECT * FROM imgcitas ic 
                              INNER JOIN usuario us ON us.idusuario=ic.usuario WHERE estadoOrden=0";
                            $adjuntos = $conectar->consultarDatos($consultaSQL);
                            ?>
                            <?php foreach ($adjuntos as $adjunto) :

                                $editarAdjuntos=$adjunto['idImg']."||".$adjunto['respuesta'];
                            ?>
                                <tr>
                                    <td><?php echo $adjunto['idImg']; ?></td>
                                    <td><?php echo $adjunto['fechaIngreso']; ?></td>
                                    <td><?php echo $adjunto['nombre']; ?></td>
                                    <td><a target="_blank" href="<?php echo $adjunto['ruta'] . $adjunto['img']; ?>"><?php echo $adjunto['img']; ?></a></td>
                                    <td><?php echo $adjunto['pregunta']; ?></td>
                                    <td><?php echo $adjunto['respuesta']; ?></td>
                                    <td>
                                        <?php if ($_SESSION['idrol'] == 1) : ?>
                                            <h5>
                                                <center><a href="" data-toggle="modal" data-target="#editarAdjunto" onclick="formEditarAdjunto('<?php echo $editarAdjuntos ?>')"><i class="glyphicon glyphicon-edit text-info "></i></a></center>
                                            </h5>
                                            <?php else: ?>
                                                <h5>
                                                <center><a href="" data-toggle="modal" data-target="#finalizarAdjunto"onclick="formEditarAdjunto('<?php echo $editarAdjuntos ?>')"><i class="glyphicon glyphicon-ok text-info "></i></a></center>
                                            </h5>
                                        <?php endif ?>
                                       
                                    </td>
                                </tr>

                                <!-- Modal Ver Estado Admisiones-->
                                <div class="modal fade" id="modalAdmisiones<?php echo $copago['nro_cita'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Información del estado Admisiones</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">Nro Cita</div>
                                                    <div class="col-6"><?php echo $copago['nro_cita'] ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">Estado Admisiones</div>
                                                    <div class="col-6"><?php echo $copago['estado'] ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">Codigo de Autorizacion</div>
                                                    <div class="col-6"><?php echo $copago['cod_autorizacion'] ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">Valor Copago</div>
                                                    <div class="col-6"><?php echo $copago['valor_copago'] ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">Observaciones Copagos</div>
                                                    <div class="col-6"><?php echo $copago['observaciones_copago'] ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">Usuario Admisiones</div>
                                                    <div class="col-6"><?php echo $copago['nombre_admision'] ?></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#datatable tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="col-12"/>');
        });

        // DataTable
        var table = $('#datatable').DataTable({
            "order": [
                [0, "desc"]
            ],
            "pageLength": 25,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
            },
            initComplete: function() {
                // Apply the search
                this.api().columns().every(function() {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            }
        });

    });
</script>