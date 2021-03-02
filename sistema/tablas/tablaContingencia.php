<?php

include('../conexion.php');
$conectar = new ConexionContingencia();

$consultaSQL =   "SELECT * FROM pacientes_modalidad pm
                INNER JOIN entidad en ON en.id_entidad=pm.entidad
                INNER JOIN estudios es ON es.id_estudio=pm.estudio
                INNER JOIN modalidad mo ON mo.id_modalidad=pm.modalidad
                INNER JOIN asesores ase ON ase.id_asesor=pm.asesor 
                WHERE  pm.estado=0";
$contingencias = $conectar->consultarDatos($consultaSQL);
?>
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Lista Contingencia</h2>
            <ul class="nav navbar-right panel_toolbox">
                <button class="btn btn-dark" data-toggle="modal" data-target="#ingresarContingencia">Ingresar Contingencia</button>
            </ul>
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
                                    <th>Acciones</th>
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
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>

                            <tbody>


                                <?php foreach ($contingencias as $contingencia) :
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
                                        <td><h5><center><a href="" data-toggle="modal" data-target="#editarModal"><i class="" onclick="formEditarContingencia('<?php echo ($datos); ?>')"><i class="glyphicon glyphicon-edit text-info "></i></i></a></center></h5></td>
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
<script>

</script>

<script>
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('.tablaDinamica tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="col-12"/>' );
    } );
 
    // DataTable
    var table = $('.tablaDinamica').DataTable({
        "order": [
                [0, "desc"]
            ],
            "pageLength": 25,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
            },
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
 
} );
</script>