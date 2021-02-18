<?php

include('../conexion.php');
$conectar = new Conexion();

$consultaSQL =   "SELECT * FROM pacientes_modalidad pm
                INNER JOIN entidad en ON en.id_entidad=pm.entidad
                INNER JOIN estudios es ON es.id_estudio=pm.estudio
                INNER JOIN modalidad mo ON mo.id_modalidad=pm.modalidad
                INNER JOIN asesores ase ON ase.id_asesor=pm.asesor 
                WHERE  pm.estado=0";
$contingencias = $conectar->consultarDatos($consultaSQL);
?>
<table class="table table-hover tablaDinamica">
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
            <th>Acciones</th>
        </tr>
    </thead>
    <tfoot>
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


        <?php foreach ($contingencias as $contingencia) :  
            $datos= $contingencia['id_consulta']."||".$contingencia['documento']."||".$contingencia['nombres']."||"
            .$contingencia['apellidos']."||".$contingencia['telefonos']."||".$contingencia['id_entidad']."||"
            .$contingencia['id_modalidad']."||".$contingencia['id_estudio']."||".$contingencia['observaciones']."||".$contingencia['estado'];
            
            ?>
        
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
                <td><a href="" data-toggle="modal" data-target="#editarModal" onclick="formEditarContingencia('<?php echo ($datos);?>')">Editar</a></td>
            </tr>
            

        <?php endforeach;   ?>

    </tbody>

</table>
<script>

</script>

<script>
    $(document).ready(function() {

      

        // DataTable
        var table = $('.tablaDinamica').DataTable({
            "order": [
                [1, "asc"]
            ],
            "pageLength": 25,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
            },
           
        });

    });
</script>