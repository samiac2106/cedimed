<?php
include "../../conexion.php";
// print_r($_POST);
if (!empty($_POST)){
      //exttraer datos del producto
    if($_POST['action']=='infocitag'){
        $nro_cita=$_POST['emergente3g'];

        $query= mysqli_query($conexion, "SELECT  usa.nombre as 'usuario_actualizacion', ci.fecha_actualizacion, ci.nro_cita, ad.id_admision, ec.estado as 'estado_cita' ,
        ci.pendiente, ci.gestion_pendiente as 'gestion', ci.observaciones_pendiente
                                        FROM cita ci 
                                        INNER JOIN estudios es
                                        ON ci.estudio=es.id_estudio
                                        INNER JOIN estado_admisiones ea
                                        ON ci.estado_admision=ea.id
                                        INNER JOIN estado_cita ec
                                        ON ci.estadocita=ec.id
                                        INNER JOIN usuario us
                                        ON ci.usuario=us.idusuario
                                        INNER JOIN admisiones ad
                                        ON ci.num_admisiones=ad.id_admision
                                        INNER JOIN cliente cl
                                        ON ci.cliente=cl.idcliente
                                        INNER JOIN tipo_documento tp
                                        ON cl.tipo_doc=tp.num
                                        INNER JOIN usuario usa
                                        ON ci.usuario_actualizacion=usa.idusuario
                                        WHERE ci.nro_cita=$nro_cita");
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



