<?php
session_start();
include("../db/Conexion.php");
$conectar = new Conexion();

if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../img/icono-cedimed.png" />

    <title>INICIO | </title>
    <?php include("includes/scriptsUp.php") ?>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include("includes/navBar.php") ?>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="tablaImagen"></div>
            </div>
        </div>
    </div>

    <?php include("includes/scriptsDown.php") ?>
    <!-- Modal Registrar Adjunto-->
    <div class="modal fade" id="registrarOrden" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Registrar Orden Médica</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="ingresarAdjunto.php" id="ingresarOrden" enctype="multipart/form-data" method="POST">
                        <div class="form-group col-12">
                            <label for="imgProducto">Adjuntar Archivo</label>
                            <input type="file" class="form-control" name="imgProducto" id="imgProducto" accept="image/png, .jpeg, .jpg, image/gif, .pdf">
                        </div>
                        <div class="form-group col-12">
                            <label for="pregunta">Pregunta</label>
                            <textarea class="form-control" name="pregunta" id="pregunta" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-dark">Guardar</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal editar Respuesta -->
    <div class="modal fade" id="editarAdjunto" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Responder</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editarOrden" method="POST">
                        <div class="form-group col-12">
                            <label for="idAdjunto">ID</label>
                            <input type="number" class="form-control idAdjunto" name="idAdjunto" readonly>
                        </div>
                        <div class="form-group col-12">
                            <label for="respuesta">Repuesta</label>
                            <textarea class="form-control respuesta" name="respuesta" rows="3"></textarea>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-dark" onclick="editarAdjunto()">Guardar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Finalizar Orden Medica -->

    <div class="modal fade" id="finalizarAdjunto" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Finalizar Orden Médica</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="finalizarOrden" method="POST">
                        <div class="form-group col-12">
                            
                            <input type="hidden" class="form-control idAdjunto" name="idAdjunto" readonly>
                        </div>
                        <div class="form-group col-12">
                           <h2>Desea Finalizar la Orden Médica N°<span class="idAdjunto"></span> ?</h2> 
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-dark" onclick="finalizarAdjunto()">Finalizar</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.tablaImagen').load('tablas/tablaImagenCita.php');

            $("#imgProducto").change(function() {
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg", "application/pdf"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]) || (imagefile == match[3]))) {
                    Swal.fire({
                        position: 'center',
                        html: '<img src="../img/icono-cedimed.png" ><br>',
                        title: 'Por favor inserta un formato válido (JPEG/JPG/PNG/PDF)',

                    });

                    $("#imgProducto").val('');
                    return false;
                }
            });
        })
    </script>
    <script>
        $('.select2').select2({
            width: 450,
        });
    </script>
</body>

</html>