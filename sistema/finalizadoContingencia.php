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
            <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Lista de Contingencias Finalizadas</h2>
            
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">



                        <table class="table table-hover table table-bordered tablaDinamica">
                            <thead>
                                <tr>
                                    <th>idConsulta</th>
                                    <th>Documento</th>
                                    <th>Nombres</th>
                                    <th>Teléfonos</th>
                                    <th>Entidad</th>
                                    <th>Modalidad</th>
                                    <th>Estudios</th>
                                    <th>Parte del cuerpo</th>
                                    <th>Asesor</th>
                                    <th>Observaciones</th>
                                    <th>Fecha</th>
                                   
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>idConsulta</th>
                                    <th>Documento</th>
                                    <th>Nombres</th>
                                    <th>Teléfonos</th>
                                    <th>Entidad</th>
                                    <th>Modalidad</th>
                                    <th>Estudios</th>
                                    <th>Parte del cuerpo</th>
                                    <th>Asesor</th>
                                    <th>Observaciones</th>
                                    <th>Fecha</th>
                                    
                                </tr>
                            </tfoot>

                            <tbody>


                                <?php 
                                $consultaSQL =   "SELECT * FROM pacientes_modalidad pm
                                INNER JOIN entidad en ON en.id_entidad=pm.entidad
                                INNER JOIN estudios es ON es.id_estudio=pm.estudio
                                INNER JOIN modalidad mo ON mo.id_modalidad=pm.modalidad
                                INNER JOIN asesores ase ON ase.id_asesor=pm.asesor 
                                WHERE  pm.estado=1";
                $contingencias = $conexion->consultarDatos($consultaSQL);
                                
                                foreach ($contingencias as $contingencia) :
                                    $datos = $contingencia['id_consulta'] . "||" . $contingencia['documento'] . "||" . $contingencia['nombres'] . "||"
                                        . $contingencia['apellidos'] . "||" . $contingencia['telefonos'] . "||" . $contingencia['id_entidad'] . "||"
                                        . $contingencia['id_modalidad'] . "||" . $contingencia['id_estudio'] . "||" . $contingencia['observaciones'] . "||" . $contingencia['estado'];

                                ?>

                                    <tr>
                                        <td><?php echo ($contingencia['id_consulta']);  ?></td>
                                        <td><?php echo ($contingencia['documento']);  ?></td>
                                        <td><?php echo ($contingencia['nombres']);  ?></td>
                                        <td><?php echo ($contingencia['telefonos']);  ?></td>
                                        <td><?php echo ($contingencia['nombre_entidad']);  ?></td>
                                        <td><?php echo ($contingencia['nombre_mod']);  ?></td>
                                        <td><?php echo ($contingencia['nombre_estudio']);  ?></td>
                                        <td><?php echo ($contingencia['apellidos']);   ?></td>
                                        <td><?php echo ($contingencia['nombre_asesor']);   ?></td>
                                        <td><?php echo ($contingencia['observaciones']);   ?></td>
                                        <td><?php echo ($contingencia['fecha_ingreso']);   ?></td>
                                        
                                    </tr>


                                <?php endforeach;   ?>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>

    <?php include("includes/scriptsDown.php") ?>

   



    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('.tablaDinamica tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" class="col-12"/>');
            });

            // DataTable
            var table = $('.tablaDinamica').DataTable({
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
</body>

</html>