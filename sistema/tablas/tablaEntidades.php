<?php 
session_start();
include "../../conexion.php";
?>
<table id="tablaentidades" class="display" >
         <thead>   
             <tr>
                
                <th>Cod Entidad</th>
                <th>Nombre</th>
                <th>Observaciones</th>
                <th>Estatus</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query=mysqli_query($conexion, "SELECT en.id, en.nombre, en.observaciones, es.nombre_estatus, es.id as 'idEstatus'
            FROM entidad en INNER JOIN estatus es on en.estatus = es.id 
                                            ");
            
            $result=mysqli_num_rows($query);

            if ($result>0){
                while($data=mysqli_fetch_array($query)):
                
                $datos=$data['id'].'||'.$data['nombre'].'||'.$data['observaciones'].'||'.$data['idEstatus'];
                ?>
                   

                    <tr>
                    <td><?php echo($data['id'])?></td>
                    <td><?php echo($data['nombre'])?></td>
                    <td><?php echo($data['observaciones'])?></td>
                    <td><?php echo($data['nombre_estatus'])?></td>
                    <td><div>
                    <a class="link_edit"href="" data-toggle="modal" data-target="#editarEntidad" onclick="formEditarEntidad('<?php echo($datos)?>')">Editar</a>
                    </div>
                    </td>
                    </tr>
                  
            
        <?php endwhile; }?>
         </tbody>   
          

        </table>


        <script>
         $('#tablausuario,#tablaentidades,#tablaestudios').DataTable({
        "order": [[ 1, "asc" ]],
        "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
   })
    </script>

