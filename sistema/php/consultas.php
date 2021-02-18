<?php
session_start();

include "../../conexion.php";

$observaciones=$_POST['obs'];
$usuario_id=$_SESSION['iduser'];

$insert_admmisiones = mysqli_query($conexion,"INSERT INTO admisiones(estado) VALUES (0)");
            /* selecciona el valor maximo de  id admision */
            $query_max = mysqli_query($conexion,"SELECT max(id_admision) as 'maxadmision' FROM admisiones");
            $data=mysqli_fetch_array($query_max);

            
            $maxadmision=$data['maxadmision'];

          /* ingreso de registros en citas */
           
            $query_insert = mysqli_query($conexion,"INSERT INTO cita(estudio, cliente, observaciones, usuario,num_admisiones, usuario_actualizacion) 
                                                    VALUES (0, 1, '$observaciones','$usuario_id','$maxadmision', '$usuario_id')");

      
if($query_insert){
    echo json_encode(1);
}else{
    echo json_encode("error");
}      
?>

