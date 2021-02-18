<?php
include "../../conexion.php";
// print_r($_POST);
if (!empty($_POST)){
    //exttraer datos del producto
    if($_POST['action']=='infoconsulta'){
        $nro_cita=$_POST['emergente1'];

        $query= mysqli_query($conexion, "SELECT cl.idcliente, tp.tipo as 'tipodoc', cl.fecha_ingreso, cl.num_identificacion,cl.nombre, cl.sexo, cl.telefono, en.nombre as 'entidad', us.usuario as 'usuario', usa.nombre as 'usuarioact', cl.fecha_actualizacion
                                            FROM cliente cl
                                            INNER JOIN entidad en
                                            ON cl.entidad=en.id
                                            INNER JOIN usuario us
                                            ON cl.usuario=us.idusuario
                                            INNER JOIN tipo_documento tp
                                            ON cl.tipo_doc=tp.num
                                            INNER JOIN usuario usa
                                            ON cl.usuario_actualizacion=usa.idusuario
                                            WHERE cl.idcliente=$nro_cita");
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



<script>
   
</script>