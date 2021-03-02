<?php
$idModalidad = $_POST['id'];
include('../conexion.php');
$conectar = new ConexionContingencia();

$consultaSQL =   "SELECT * FROM pacientes_modalidad pm
                INNER JOIN entidad en ON en.id_entidad=pm.entidad
                INNER JOIN estudios es ON es.id_estudio=pm.estudio
                INNER JOIN modalidad mo ON mo.id_modalidad=pm.modalidad
                INNER JOIN asesores ase ON ase.id_asesor=pm.asesor 
                WHERE pm.modalidad=$idModalidad and estado=0";
$contingencias = $conectar->consultarDatos($consultaSQL);
?>
<table class="table table-hover table-bordered tablaDinamica">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Teléfonos</th>
            <th>Entidad</th>
            <th>Modalidad</th>
            <th>Estudios</th>
            <th>Asesor</th>
            <th>Observaciones</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tfoot > 
        <tr>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Teléfonos</th>
            <th>Entidad</th>
            <th>Modalidad</th>
            <th>Estudios</th>
            <th>Asesor</th>
            <th>Observaciones</th>
            <th>Fecha</th>
        </tr>
    </tfoot>
    
    <tbody>
    

        <?php foreach ($contingencias as $contingencia) :  ?>
            <tr>
                <td><?php echo ($contingencia['documento']);  ?></td>
                <td><?php echo ($contingencia['nombres']);  ?></td>
                <td><?php echo ($contingencia['apellidos']);   ?></td>
                <td><?php echo ($contingencia['telefonos']);  ?></td>
                <td><?php echo ($contingencia['nombre_entidad']);  ?></td>
                <td><?php echo ($contingencia['nombre_mod']);  ?></td>
                <td><?php echo ($contingencia['nombre_estudio']);  ?></td>
                <td><?php echo ($contingencia['nombre_asesor']);   ?></td>
                <td><?php echo ($contingencia['observaciones']);   ?></td>
                <td><?php echo ($contingencia['fecha_ingreso']);   ?></td>
            </tr>
        <?php endforeach;   ?>

    </tbody>
    
</table>


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
                [1, "asc"]
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