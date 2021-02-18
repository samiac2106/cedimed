<?php
session_start();

include "../conexion.php";
    if(!empty($_POST)){
        $alert='';
        if(empty($_POST['identificacion_cliente']) || empty($_POST['estudio']) 
         ){
            $alert='<p class="msg_error">Faltan datos por ingresar</p>';
        }else{
            $numidentificacion = $_POST['identificacion_cliente'];
            $estudio= $_POST['estudio'];
            $fechacita= $_POST['fechacita'];
            $vigencia= $_POST['vigencia'];
            $arl=$_POST['arl'];
            $observaciones=$_POST['obs'];
            $usuario_id=$_SESSION['iduser'];
            $admision=$_POST['admision'];

            if($admision==0){
                 /* ingresa estado en admision */
            
            $insert_admmisiones = mysqli_query($conexion,"INSERT INTO admisiones(estado) VALUES (0)");
            /* selecciona el valor maximo de  id admision */
            $query_max = mysqli_query($conexion,"SELECT max(id_admision) as 'maxadmision' FROM admisiones");
            $data=mysqli_fetch_array($query_max);

            
            $maxadmision=$data['maxadmision'];

            /* llamar el idcliente con el post de la identificaion */
            $query = mysqli_query($conexion,"SELECT  idcliente FROM cliente where num_identificacion='$numidentificacion'");
            $selectcliente=mysqli_fetch_array($query);
            $idcliente=$selectcliente['idcliente'];

          /* ingreso de registros en citas */
           
            $query_insert = mysqli_query($conexion,"INSERT INTO cita(cliente,estudio, vigencia_orden, fecha_cita, arl_codigo, observaciones, usuario,num_admisiones, usuario_actualizacion) 
                                                    VALUES ('$idcliente','$estudio','$vigencia','$fechacita','$arl','$observaciones','$usuario_id','$maxadmision', '$usuario_id')");

            

            }else{
                $insert_admmisiones = mysqli_query($conexion,"INSERT INTO admisiones(estado) VALUES (3)");
                /* selecciona el valor maximo de  id admision */
                $query_max = mysqli_query($conexion,"SELECT max(id_admision) as 'maxadmision' FROM admisiones");
                $data=mysqli_fetch_array($query_max);
    
                
                $maxadmision=$data['maxadmision'];
    
                /* llamar el idcliente con el post de la identificaion */
                $query = mysqli_query($conexion,"SELECT  idcliente FROM cliente where num_identificacion='$numidentificacion'");
                $selectcliente=mysqli_fetch_array($query);
                $idcliente=$selectcliente['idcliente'];
    
              /* ingreso de registros en citas */
               
                $query_insert = mysqli_query($conexion,"INSERT INTO cita(cliente,estudio, vigencia_orden, fecha_cita, arl_codigo, observaciones, usuario,num_admisiones, usuario_actualizacion, estado_admision, estadocita ) 
                                                        VALUES ('$idcliente','$estudio','$vigencia','$fechacita','$arl','$observaciones','$usuario_id','$maxadmision', '$usuario_id', 3, 1)");
    
                

            }
            
           
                if($query_insert){  
                    $alert="<p class=\"msg_save\">Cita Creada Correctamente</p>";
                    
                }else{
                    $alert='<p class="msg_error">Error al crear la cita</p>';
                }       
            
        }
    }



?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<?php include "includes/scripts.php"?>
    <title>REGISTRO  DE CITAS</title>
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

<a href="registro_cliente.php" class="btn_new" style="position:fixed ; top:150px; left: 0;">Registrar Paciente</a>
<a href="lista_citas.php" class="btn_new" style="position:fixed ; top:200px; left: 0;">Ir a Lista Copagos</a>

    <div class="form-register">
          
       
        <form action="" method="post">
       <h1>Registro de Citas</h1>
      
        <hr>

        <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>
        <div>
        <div class="regcliente">
           
            <?php
            $query_idcliente =mysqli_query($conexion,"SELECT * FROM cliente order by num_identificacion asc");
            $result_idcliente = mysqli_num_rows($query_idcliente);
            
            ?>
            <label>Nro Identificacion (*)   
          <input list="identificacion_cliente" name="identificacion_cliente" class="identificacion_cliente"/></label>
          <datalist name="identificacion_cliente"id="identificacion_cliente">
            <?php 
            if ($result_idcliente>0){
                while($idcliente =mysqli_fetch_array($query_idcliente)){
                    
                  echo "  <option value=\"".$idcliente['num_identificacion']."\">";
            }
            } ?>
          
          </datalist>
          
        </div>
       
        <div id="existenciacliente"></div>
        <div>
            <label for="estudio">Estudio (*)</label>
            <?php
            $query_estudio =mysqli_query($conexion,"SELECT * FROM estudios ");
            $result_estudio = mysqli_num_rows($query_estudio);
            
            ?>
          <select name="estudio" id="estudio" class="select2">
          <option value="0" disabled selected>Seleccione una Opcion</option> 
            <?php 
            if ($result_estudio>0){
                while($estudio =mysqli_fetch_array($query_estudio)){
                    
                  echo "  <option value=\"".$estudio['id_estudio']."\">".$estudio['nombre_estudio']."</option>";
            }
            } ?>
          
           
          </select>
        </div>
        <div>
            <label for="fechacita">Fecha de la Cita (*)</label>
            <input type="date" name="fechacita" id="fechacita" >
        </div>
        
        <div>
            <label for="arl">CODIGO - NOMBRE DEL MEDICO Y FECHA DE LA ORDEN</label>
            <textarea  name="arl" id="arl" rows="5" cols="45" placeholder="Solo si es ARL (opcional)" ></textarea> 
        </div>
        <div>
            <label for="vigencia">Vigencia Orden</label>
            <input type="text" name="vigencia" id="vigencia" placeholder="Fecha de la vigencia" autocomplete="off">
        </div>
        
        <div>
            <label for="obs">Observaciones</label>
            <textarea  name="obs" id="obs" rows="5" cols="45" placeholder="Ingrese algunos comentarios sobre el proceso de la cita (opcional)"></textarea> 
        </div>
        <div>
            <label for="admision"></label>
            <select name="admision" id="admision">
                <option value="0">Copago</option>
                <option value="3">Pendiente personal</option>
            </select>
        </div>
        
        
        <input type="submit" value="Crear Cita" class="btn-save">

        </form>

      


    </div>



</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('.identificacion_cliente').val();
		
		

		$('.identificacion_cliente').change(function(){
			cargarcliente();
			
			
		});
	
	})
</script>


<script type="text/javascript">
	function cargarcliente(){
		$.ajax({
			type:"POST",
			url:"php/cargar_clientes.php",
			data:"identificacion_cliente=" + $('.identificacion_cliente').val(),
			success:function(r){
				$('#existenciacliente').html(r);
				
			}
		});
		
	}
</script>
<script>
$('.select2').select2({
    containerCssClass: "wrap"
});
</script>



</body>
</html>