<?php
include "../../conexion.php";
 session_start();
if (!empty($_POST)){
    /* print_r($_POST);
    exit;  */
      //exttraer datos del producto
    if($_POST['action']=='cita_pendientead')
    {  
        
         $nro_cita=$_POST['cita_pendientead'];

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
        exit;  */
    if($_POST['action']=='addPendientead')
    {  
         
        if (!empty($_POST['cita_pendientead']) || !empty($_POST['txtpendientead'])){
            $nro_cita=$_POST['cita_pendientead'];
            $pendiente=$_POST['txtpendientead'];
            $usuario= $_SESSION['iduser'];

            $updatecita=mysqli_query($conexion, "UPDATE cita SET estado_admision=1
                            WHERE nro_cita=$nro_cita");
            $updateadmision=mysqli_query($conexion, "UPDATE admisiones SET estado=1, observaciones='$pendiente', 
            usuario_admisiones='$usuario' WHERE id_admision=$nro_cita");
            
            $query= mysqli_query($conexion, "SELECT * FROM admisiones where id_admision=$nro_cita");
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
