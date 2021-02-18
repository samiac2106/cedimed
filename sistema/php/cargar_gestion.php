<?php
include "../../conexion.php";
 session_start();
if (!empty($_POST)){
   /*  print_r($_POST);
    exit; */
      //exttraer datos del producto
    if($_POST['action']=='infogestion')
    {  
        
         $nro_gest=$_POST['emergente4'];

        $query= mysqli_query($conexion, "SELECT * FROM cita where nro_cita=$nro_gest");

        
        $result =mysqli_num_rows($query);       
        
        if($result>0){
            $data= mysqli_fetch_assoc($query);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit; 
           
        }
        echo 'error'; 
        exit;
    }

    if($_POST['action']=='addGestion')
    {  
        if (!empty($_POST['cita_gestion']) || !empty($_POST['txtgestion'])){
            $nro_cita=$_POST['cita_gestion'];
            $gestion=$_POST['txtgestion'];
            $usuario= $_SESSION['iduser'];

            $query_gestion=mysqli_query($conexion, "UPDATE cita SET gestion_pendiente='$gestion', 
                            fecha_actualizacion=current_timestamp(),usuario_actualizacion=$usuario
                            WHERE nro_cita=$nro_cita");
            
            $query= mysqli_query($conexion, "SELECT * FROM cita where nro_cita=$nro_cita");
            $data_gestion=mysqli_fetch_assoc($query);
            $data_gestion['nro_cita']=$nro_cita;
            echo json_encode($data_gestion, JSON_UNESCAPED_UNICODE);
            exit;
        } 
    }
} 
    exit;

?>
