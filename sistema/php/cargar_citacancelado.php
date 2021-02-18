<?php
include "../../conexion.php";
 session_start();
if (!empty($_POST)){
    /* print_r($_POST);
    exit;  */
      //exttraer datos del producto
    if($_POST['action']=='cita_cancelado')
    {  
        
         $nro_cita=$_POST['cita_cancelado'];

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
//cancelar cita

/* print_r($_POST);
        exit; */ 
    if($_POST['action']=='addCancelado')
    {  
         
        if (!empty($_POST['cita_cancelado'])){
            $nro_cita=$_POST['cita_cancelado'];
            $cancelado=$_POST['txtcancelado'];
            $usuario= $_SESSION['iduser'];

            $query_cancelado=mysqli_query($conexion, "UPDATE cita SET observaciones_pendiente='$cancelado', 
                           estadocita=3, fecha_actualizacion=current_timestamp(),usuario_actualizacion=$usuario
                            WHERE nro_cita=$nro_cita");
            
            $query= mysqli_query($conexion, "SELECT * FROM cita where nro_cita=$nro_cita");
            $data_cancelado=mysqli_fetch_assoc($query);
            $data_cancelado['nro_cita']=$nro_cita;
            echo json_encode($data_cancelado, JSON_UNESCAPED_UNICODE);
            exit;
        } 
    }else{
        echo 'error';
        exit;
    }
} 
    exit;

?>
