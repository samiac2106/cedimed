<?php
include "../../conexion.php";
// print_r($_POST);
if (!empty($_POST)){
      //exttraer datos del producto
    if($_POST['action']=='infoadmision'){
        $nro_admision=$_POST['emergente2'];

        $query= mysqli_query($conexion, "SELECT ad.id_admision, ad.cod_autorizacion, ad.copago, ad.valor_copago, ad.observaciones, 
                                        ea.estado, ci.nro_cita, us.nombre as 'usuario_admisiones' FROM admisiones ad 
                                        INNER JOIN estado_admisiones ea ON ad.estado=ea.id 
                                        INNER JOIN cita ci ON ad.id_admision=ci.num_admisiones 
                                        INNER JOIN usuario us ON ad.usuario_admisiones=us.idusuario 
                                        WHERE ad.id_admision=$nro_admision");
                                        $result =mysqli_num_rows($query);       
        
        if($result>0){
            $data= mysqli_fetch_array($query);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit;
           
        }
        echo 'error';
        exit;
       
    }
}

?>



