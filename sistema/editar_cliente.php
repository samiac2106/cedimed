<?php
session_start();

include "../conexion.php";
if(!empty($_POST)){
    $alert='';
    
    if(empty($_POST['tipodoc']) || empty($_POST['nombrecliente']) || empty($_POST['idcliente'])
    || empty($_POST['sexo'])  || empty($_POST['idcliente']) || empty($_POST['entidad'])){
        $alert='<p class="msg_error">Los campos son obligatorios</p>';
        
    }else{
        $idcliente=$_POST['id'];
        $tipodoc= $_POST['tipodoc'];
        $nombre = $_POST['nombrecliente'];
        $numdoc= $_POST['idcliente'];
        $sexo=$_POST['sexo'];
        $telefono= $_POST['telefono'];
        $entidad= $_POST['entidad'];
        $usuario_id=$_SESSION['iduser'];
            
        
        
        $query_update = mysqli_query($conexion,"UPDATE cliente SET tipo_doc=$tipodoc, 
            num_identificacion=$numdoc, nombre='$nombre', sexo='$sexo', telefono='$telefono',
            entidad=$entidad, fecha_actualizacion= current_timestamp(), usuario_actualizacion=$usuario_id
            WHERE idcliente=$idcliente");
            if($query_update){
                $alert='<p class="msg_save">Usuario Se Ha Actualizado Correctamente</p>';
            }else{
                $alert='<p class="msg_error">Error al Actualizar el usuario</p>';
            }       
        }
    }


//MOSTRAR DATOS

if (empty($_GET['id'])){
    header('location lista_cliente.php');
}
$idpost= $_GET['id'];

$query= mysqli_query($conexion, "SELECT cl.idcliente, cl.tipo_doc, cl.entidad as 'identidad', cl.idcliente, tp.tipo as 'tipodoc', 
            cl.fecha_ingreso, cl.num_identificacion,cl.nombre, cl.sexo, cl.telefono, 
            en.nombre as 'entidad', us.usuario as 'usuario', usa.nombre as 'usuarioact', 
            cl.fecha_actualizacion
            FROM cliente cl
            INNER JOIN entidad en
            ON cl.entidad=en.id
            INNER JOIN usuario us
            ON cl.usuario=us.idusuario
            INNER JOIN tipo_documento tp
            ON cl.tipo_doc=tp.num
            INNER JOIN usuario usa
            ON cl.usuario_actualizacion=usa.idusuario
            WHERE idcliente=$idpost");

$result_sql=mysqli_num_rows($query);

if ($result_sql==0){
    header('location lista_cliente.php');
}else{
    while($data= mysqli_fetch_array($query)){
        $idcliente= $data['idcliente'];
        $nombre= $data['nombre'];
        $identificacion=$data['num_identificacion'];
        $sexo=$data['sexo'];
        $telefono=$data['telefono'];
        $tipodoc=$data['tipodoc'];
        $ntipo=$data['tipo_doc'];
        $identidad=$data['identidad'];
        $entidad=$data['entidad'];
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<?php include "includes/scripts.php"?>
    <title>ACTUALIZACION PACIENTE</title>
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
<a href="registro_citas.php" class="btn_new" style="position:fixed ; top:150px; left: 0;">Registrar Cita</a>
<a href="lista_citas.php" class="btn_new" style="position:fixed ; top:200px; left: 0;">Ir a Lista Copagos</a>
<a href="lista_cliente.php" class="btn_new" style="position:fixed ; top:250px; left: 0;">Ir a Lista Pacientes</a>
    <div class="form-register">
        
        

    <form action="" method="post">
       <h1>Actualización de Pacientes</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>
        <div>
        <input type="hidden" name="id" id="id" value="<?php echo $idcliente;?>">
            <label for="tipodoc">Tipo Documento (*)</label>
            <?php
            $query_tipodoc =mysqli_query($conexion,"SELECT * FROM tipo_documento order by tipo asc");
            $result_tipodoc= mysqli_num_rows($query_tipodoc);
            
            ?>
          <select name="tipodoc" id="tipodoc" class="itemunico select2" >
          <?php echo "  <option value=\"".$ntipo."\">".$tipodoc."</option>";?>
          <option value="0" disabled>Seleccione una Opción</option>  
            <?php 
            if ($result_tipodoc>0){
                while($tipo =mysqli_fetch_array($query_tipodoc)){
                    
                  echo "  <option value=\"".$tipo['num']."\">".$tipo['tipo']."-".$tipo['nombre']."</option>";
            }
            } ?>
          
           
          </select>
        </div>
        <div>
            <label for="idcliente">Identificación (*)</label>
            <input value="<?php echo $identificacion ?>" type="text" name="idcliente" id="idcliente" placeholder="Ingrese N° Identificación" autocomplete="off">
        </div>
        <div>
            <label for="nombrecliente">Nombre (*)</label>
            <input value="<?php if (isset($nombre)) echo $nombre ?> "type="text" name="nombrecliente" id="nombrecliente" placeholder="Ingrese el Nombre del Cliente" autocomplete="off">
        </div>
        <div>
          <label for="sexo">Sexo (*)</label>
          <select name="sexo" id="sexo" class="itemunico">
          <?php echo "  <option value=\"".$sexo."\">".$sexo."</option>";?>  
           <option value="0" disabled >Seleccione una Opción</option>
            <option value="hombre">Hombre</option>  
          <option value="mujer">Mujer</option>  
          </select>
        </div>
        <div>
            <label for="telefono">Telefono (*)</label>
            <input value="<?php echo $telefono; ?>"type="text" name="telefono" id="telefono" placeholder="Ingrese los números de contactos" autocomplete="off">
        </div>
        <div>
            <label for="entidad">Entidad (*)</label>
            <?php
            $query_entidad =mysqli_query($conexion,"SELECT * FROM entidad order by nombre asc");
            $result_entidad= mysqli_num_rows($query_entidad);
            
            ?>
          <select name="entidad" id="entidad" class="select2 itemunico">
          <?php echo "  <option value=\"".$identidad."\">".$entidad."</option>";?>
          <option value="0" disabled >Seleccione una Opción</option> 
            <?php 
            if ($result_entidad>0){
                while($entidad =mysqli_fetch_array($query_entidad)){
                    
                  echo "  <option value=\"".$entidad['id']."\">".$entidad['nombre']."</option>";
            }
            } ?>
          
           
          </select>
        </div>
        
        <input type="submit" value="Editar Paciente" class="btn-save">

        </form>


    </div>


</section>
	
</body>
</html>