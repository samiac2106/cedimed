<?php
include "../../conexion.php";
 session_start();
if (!empty($_POST)){
    /* print_r($_POST);
    exit;  */
      //exttraer datos del producto
    if($_POST['action']=='cita_pendiente')
    {  
        
         $nro_cita=$_POST['cita_pendiente'];

        $query= mysqli_query($conexion, "SELECT * FROM cita where nro_cita=$nro_cita");

        
        $result =mysqli_num_rows($query);       
        
        if($result>0){
            $data= mysqli_fetch_assoc($query);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit; 
           
        }
        echo 'error'; 
        exit;
    }
//agregar texto pendiente a base de datos

/* print_r($_POST);
        exit; */ 
    if($_POST['action']=='addPendiente')
    {  
         
        if (!empty($_POST['cita_pendiente']) || !empty($_POST['txtpendiente'])){
            $nro_cita=$_POST['cita_pendiente'];
            $pendiente=$_POST['txtpendiente'];
            $usuario= $_SESSION['iduser'];

            $query_pendiente=mysqli_query($conexion, "UPDATE cita SET pendiente='$pendiente', 
                           estadocita=1, fecha_actualizacion=current_timestamp(),usuario_actualizacion=$usuario
                            WHERE nro_cita=$nro_cita");
            
            $query= mysqli_query($conexion, "SELECT * FROM cita where nro_cita=$nro_cita");
            $data_pendiente=mysqli_fetch_assoc($query);
            $data_pendiente['nro_cita']=$nro_cita;
            echo json_encode($data_pendiente, JSON_UNESCAPED_UNICODE);
            exit;
        } 
    }else{
        echo 'error';
        exit;
    }
} 
    exit;

?>
