<?php 
session_start();
include "../../conexion.php";
?>
<table id="tablaestudios" class="display" >
         <thead>   
             <tr>
                
                <th>Cod Estudio</th>
                <th>Nombre</th>
                <th>Observaciones</th>
                <th>Estatus</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query=mysqli_query($conexion, "SELECT en.id_estudio, en.nombre_estudio, en.observaciones, est.nombre_estatus, en.estatus 
            FROM estudios en INNER JOIN estatus est on en.estatus = est.id");
            
            $result=mysqli_num_rows($query);

            if ($result>0){
                while($data=mysqli_fetch_array($query)):                
               
                $datos=$data['id_estudio'].'||'.$data['nombre_estudio'].'||'.$data['observaciones'].'||'.$data['estatus'];
                ?>
                    <tr>
                    <td><?php echo($data['id_estudio'])?></td>
                    <td><?php echo($data['nombre_estudio'])?></td>
                    <td><?php echo($data['observaciones'])?></td>
                    <td><?php echo($data['nombre_estatus'])?></td>
                    <td><div>
                    <a class="link_edit"href="" data-toggle="modal" data-target="#editarEstudios" onclick="formEditarEstudios('<?php echo($datos)?>')">Editar</a>
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

