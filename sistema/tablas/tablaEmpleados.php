<?php 
session_start();
include "../../conexion.php";
?>
<table id="tablausuario" class="display">
    <thead>
        <tr>
            <th>Identificación</th>
            <th>Nombre</th>
            <th>Sexo</th>
            <th>Usuario</th>
            <th>Clave</th>
            <th>Cargo</th>
            <th>Cedula</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
              $query=mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.usuario, u.cedula, u.sexo, u.clave, u.rol as 'idrol', r.rol , u.estatus , es.nombre_estatus
              FROM usuario u INNER JOIN rol r on u.rol = r.idrol INNER JOIN estatus es ON u.estatus=es.id
              where estatus>=1 ORDER BY u.nombre ASC");
            
            $result=mysqli_num_rows($query);

            if ($result>0){
                while($data=mysqli_fetch_array($query)):
                
                $datos=$data['idusuario'].'||'.$data['nombre'].'||'.$data['sexo'].'||'.$data['usuario'].'||'
                .$data['clave'].'||'.$data['idrol'].'||'.$data['cedula'].'||'.$data['estatus'];
                ?>


        <tr>
            <td><?php echo($data['idusuario'])?></td>
            <td><?php echo($data['nombre'])?></td>
            <td><?php echo($data['sexo'])?></td>
            <td><?php echo($data['usuario'])?></td>
            <td><?php echo($data['clave'])?></td>
            <td><?php echo($data['rol'])?></td>
            <td><?php echo($data['cedula'])?></td>
            <td><?php echo($data['nombre_estatus'])?></td>

            <td>
                <div>
                    <a class="link_edit" href="" data-toggle="modal" data-target="#editarEmpleado"
                        onclick="formEditarEmpleado('<?php echo($datos)?>')">Editar</a>
                </div>
            </td>
        </tr>


        <?php endwhile; }?>
    </tbody>

</table>

<script>
$('#tablausuario').DataTable({
    "order": [
        [1, "asc"]
    ],
    "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
    },
})
</script>