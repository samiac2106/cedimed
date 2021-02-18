<?php
session_start();
if($_SESSION['idrol']>2 ){
    header('location: ../');
}
include "../conexion.php";
    

//MOSTRAR DATOS

if (empty($_GET['id'])){
    header('location lista_citas.php');
}
$nro_cita= $_GET['id'];

$sql= mysqli_query($conexion,"SELECT cl.idcliente, ci.fecha, ci.nro_cita, ci.vigencia_orden, ci.arl_codigo, ci.fecha_cita, ci.observaciones,
es.id_estudio, es.nombre_estudio as 'estudio', ad.id_admision, ea.estado as 'estado_admision', ec.estado as 'estado_cita' ,
us.usuario as 'asesor', concat(tp.tipo, ' ', cl.num_identificacion) as 'identificacion', cl.nombre as 'nombre_cliente'
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
                                where ci.nro_cita=$nro_cita");

$result_sql=mysqli_num_rows($sql);

if ($result_sql==0){
    header('location lista_citas.php');
}else{
    while($data= mysqli_fetch_array($sql)){
        $nro_cita= $data['nro_cita'];
        $nombre= $data['nombre_cliente'];
        $identificacion=$data['identificacion'];
        $estudio=$data['estudio'];
        $id_estudio=$data['id_estudio'];
        $fecha_cita=$data['fecha_cita'];
        $arl=$data['arl_codigo'];
        $vigencia=$data['vigencia_orden'];
        $observaciones=$data['observaciones'];
    }
}

if(!empty($_POST)){
    $alert='';
                
        $estudio=$_POST['estudio'];
        $fecha_cita = $_POST['fecha_cita'];
        $arl= $_POST['arl'];
        $vigencia= $_POST['vigencia'];
        $obs= $_POST['obs'];
        $usuario_id=$_SESSION['iduser'];
        

        $sql_update = mysqli_query($conexion, "UPDATE cita SET estudio= '$estudio', fecha_cita='$fecha_cita',
                                        usuario='$usuario_id', vigencia_orden='$vigencia', arl_codigo='$arl', observaciones='$obs', 
                                        usuario_actualizacion='$usuario_id', fecha_actualizacion = current_timestamp()
                                        WHERE nro_cita=$nro_cita");

           if($sql_update){
                $alert='<p class="msg_save">Paciente Actualizado Correctamente</p>';
            }else{
                $alert='<p class="msg_error">Error al Actualizar el Paciente</p>';
            }       
        }
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<?php include "includes/scripts.php"?>
    <title>ACTUALIZACION Citas</title>
    <link rel="shortcut icon" href="../img/cedimed-icono.png" type="image/x-icon">
	<style>
		
	</style>
</head>
<body>

<?php 

if (empty($_SESSION['active'])){
  header('location: ../');
}
include "includes/header.php"?>



<section id="container">

    <div class="form-register">
    <a href="registro_citas.php" class="btn_new" style="position:fixed ; top:150px; left: 0;">Registrar Nueva Cita</a>
    <a href="lista_citas.php" class="btn_new" style="position:fixed ; top:200px; left: 0;">Volver a Lista Copagos</a>
 
        

        <form action="" method="post">
       <h1>Actualización de Citas</h1>
       <hr>
       <center><h1 style="font-size: 40px; font-weight: bold;">Cita Nro: <?php echo $nro_cita;?></h1></center>
        <p class="alert"><?php echo isset($alert) ? $alert : '';?></p>
        
        <div>
            
            <label for="nombre">Nombre Paciente</label>
            <input type="text" name="nombre" id="nombre" placeholder="Ingrese Nombre y Apellido" autocomplete="off" value="<?php echo $identificacion.' '.$nombre;?>" disabled style="background-color: #8ebbcd;">
        </div>
        <div>
            <label for="estudio">Estudio</label>
            <?php
            $query_estudio =mysqli_query($conexion,"SELECT * FROM estudios ");
            $result_estudio = mysqli_num_rows($query_estudio);
            
            ?>
          <select name="estudio" id="estudio" class="itemunico select2">
              <?php echo "  <option value=\"".$id_estudio."\">".$estudio."</option>";?>
          <option value="0" disabled >Selecciones una Opcion</option>  
            <?php 
           
            if ($result_estudio>0){
                while($estudioquery =mysqli_fetch_array($query_estudio)){
                    
                  echo "  <option value=\"".$estudioquery['id_estudio']."\">".$estudioquery['nombre_estudio']."</option>";
            }
            } ?>
          
           
          </select>
        </div>
        <div>
            <label for="fecha_cita">Fecha Cita</label>
            <input type="date" name="fecha_cita" id="fecha_cita" autocomplete="off" value="<?php echo $fecha_cita;?>">
        </div>
        <div>
            <label for="arl">Si es ARL.....</label>
            <textarea  name="arl" id="arl" rows="4" cols="45"><?php echo $arl;?></textarea> 
        </div>
        <div>
           <label for="vigencia">Vigencia Orden</label>
            <input type="text" name="vigencia" id="vigencia" autocomplete="off" value="<?php echo $vigencia;?>">
        </div>
        <div>
            <label for="obs">Observaciones</label>
            <textarea  name="obs" id="obs" rows="4" cols="45"><?php echo $observaciones;?></textarea> 
        </div>
        <input type="submit" value="Editar Cita" class="btn-save">

        </form>


    </div>


</section>
	
</body>
</html>