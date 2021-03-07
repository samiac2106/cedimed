<?php
session_start();
include("conexion.php");
include("../db/Conexion.php");
$conexion = new ConexionContingencia();

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
                <div class="tablaContingencia"></div>
            </div>
        </div>
    </div>

    <?php include("includes/scriptsDown.php") ?>

    <!-- modarl para registrar contingencia -->

    <div class="modal fade" id="ingresarContingencia" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar Contingencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="registrarContingencia" method="POST">
                        <div class="form-group">
                            <label for="documento">Documento </label>
                            <input type="number" class="form-control" id="documento" name="documento">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombres </label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfonos </label>
                            <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>

                        <div class="form-group">
                            <label for="entidad">Entidad </label>
                            <select name="entidad" id="entidad" name="entidad" class="form-control select2">
                                <option disabled selected value="">Seleccione Una Opción</option>
                                <?php
                                $consultaSQL = "SELECT * FROM entidad";
                                $entidades = $conexion->consultarDatos($consultaSQL);
                                foreach ($entidades as $entidad) :
                                ?>
                                    <option value="<?php echo ($entidad['id_entidad']) ?>"><?php echo ($entidad['nombre_entidad']) ?></option>

                                <?php endforeach;  ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="modalidad">Modalidad </label>
                            <select name="modalidad" id="modalidad" name="modalidad" class="form-control select2">
                                <option disabled selected value="">Seleccione Una Opción</option>
                                <?php
                                $consultaSQL = "SELECT * FROM modalidad";
                                $modalidades = $conexion->consultarDatos($consultaSQL);
                                foreach ($modalidades as $modalidad) :
                                ?>
                                    <option value="<?php echo ($modalidad['id_modalidad']) ?>"><?php echo ($modalidad['nombre_mod']) ?></option>

                                <?php endforeach;  ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estudio">Estudio </label>
                            <select name="estudio" id="estudio" name="estudio" class="form-control select2">
                                <option disabled selected value="">Seleccione Una Opción</option>
                                <?php
                                $consultaSQL = "SELECT * FROM estudios";
                                $estudios = $conexion->consultarDatos($consultaSQL);
                                foreach ($estudios as $estudio) :
                                ?>
                                    <option value="<?php echo ($estudio['id_estudio']) ?>"><?php echo ($estudio['nombre_estudio']) ?></option>

                                <?php endforeach;  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Parte del cuerpo </label>
                            <input type="text" class="form-control" id="apellido" name="apellido">
                        </div>

                        <div class="form-group">
                            <label for="observaciones">Observaciones </label>
                            <textarea name="observaciones" class="form-control" id="observaciones" cols="30" rows="10"></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                   <button type="button" class="btn btn-dark" data-dismiss="modal" onclick="guardarContingencia()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal para editar contingencia -->
    <div class="modal fade" id="editarModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="editarContingencia" method="POST">
                        <div class="form-group">
                            <label for="documento">Documento </label>
                            <input type="hidden" name="idConsulta" class="idConsulta" id="idConsulta">
                            <input type="number" class="form-control documento" id="documento" name="documento">

                        </div>
                        <div id="documento1"></div>
                        <div class="form-group">
                            <label for="nombre">Nombres </label>
                            <input type="text" class="form-control nombre" id="nombre" name="nombre">
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfonos </label>
                            <input type="text" class="form-control telefono" id="telefono" name="telefono">
                        </div>

                        <div class="form-group">
                            <label for="entidad">Entidad </label>
                            <select name="entidad" id="entidad" name="entidad" class="custom-select entidad">

                                <?php
                                $consultaSQL = "SELECT * FROM entidad";
                                $entidades = $conexion->consultarDatos($consultaSQL);
                                foreach ($entidades as $entidad) :
                                ?>
                                    <option value="<?php echo ($entidad['id_entidad']) ?>"><?php echo ($entidad['nombre_entidad']) ?></option>

                                <?php endforeach;  ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="modalidad">Modalidad </label>
                            <select name="modalidad" id="modalidad" name="modalidad" class="custom-select modalidad ">

                                <?php
                                $consultaSQL = "SELECT * FROM modalidad";
                                $modalidades = $conexion->consultarDatos($consultaSQL);
                                foreach ($modalidades as $modalidad) :
                                ?>
                                    <option value="<?php echo ($modalidad['id_modalidad']) ?>"><?php echo ($modalidad['nombre_mod']) ?></option>

                                <?php endforeach;  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="estudio">Estudio </label>
                            <select name="estudio" id="estudio" name="estudio" class="custom-select estudio">
                                <?php
                                $consultaSQL = "SELECT * FROM estudios";
                                $estudios = $conexion->consultarDatos($consultaSQL);
                                foreach ($estudios as $estudio) :
                                ?>
                                    <option value="<?php echo ($estudio['id_estudio']) ?>"><?php echo ($estudio['nombre_estudio']) ?></option>

                                <?php endforeach;  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Parte del cuerpo </label>
                            <input type="text" class="form-control apellido" id="apellido" name="apellido">
                        </div>

                        <div class="form-group">
                            <label for="observaciones">Observaciones </label>
                            <textarea name="observaciones" class="form-control observaciones " id="observaciones" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado </label>
                            <select name="estado" id="estado" name="estado" class="custom-select estado">
                                <option value="0">Activo</option>
                                <option value="1">Finalizado</option>
                            </select>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal" onclick="editarContingencia()">Guardar</button>


                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.tablaContingencia').load('tablas/tablaContingencia.php');
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: 450,
            });

            $('#modalidad').change(function(data) {
                var idModalidad = "id=" + $('#modalidad').val();

                $.ajax({
                    type: "POST",
                    url: "php/consultarModalidad.php",
                    data: idModalidad,
                    success: function(data) {
                        console.log(data);
                        $('.graficoSelect').html(data);
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "php/consultaTablaModalidad.php",
                    data: idModalidad,
                    success: function(data) {
                        console.log(data);
                        $('.tablaContingencia').html(data);
                    }
                });
            })
        });
    </script>
</body>

</html>