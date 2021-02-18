<?php
include "../../conexion.php";
 session_start();
if (!empty($_POST)){
    /* print_r($_POST);
    exit;  */
      //exttraer datos del producto
    if($_POST['action']=='cita_finalizadoadp')
    {  
        
         $nro_cita=$_POST['cita_finalizadoadp'];

        $query= mysqli_query($conexion, "SELECT * FROM admisiones where id_admision=$nro_cita");

        
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
    if($_POST['action']=='addFinalizadoadp')
    {  
         
        if (!empty($_POST['cita_finalizadoadp'])){
            $nro_cita=$_POST['cita_finalizadoadp'];
            $finalizado=$_POST['txtfinalizadoadp'];
            $codaut=$_POST['codautp'];
            $copago=$_POST['copagop'];
            $valor=$_POST['valorp'];
            $usuario= $_SESSION['iduser'];

            $updatecita=mysqli_query($conexion, "UPDATE cita SET estado_admision=2
                            WHERE nro_cita=$nro_cita");
            $updateadmision=mysqli_query($conexion, "UPDATE admisiones SET estado=2, observaciones='$finalizado', 
            usuario_admisiones='$usuario', cod_autorizacion='$codaut', copago='$copago', valor_copago='$valor' WHERE id_admision=$nro_cita");
            
            $query= mysqli_query($conexion, "SELECT * FROM admisiones where id_admision=$nro_cita");
            $data_finalizado=mysqli_fetch_assoc($query);
            $data_finalizado['id_admision']=$nro_cita;
            echo json_encode($data_finalizado, JSON_UNESCAPED_UNICODE);
            exit;
        } 
    }else{
        echo 'error';
        exit;
    }
} 
    exit;

?>
