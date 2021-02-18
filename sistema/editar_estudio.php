<?php
session_start();
if($_SESSION['idrol']!=1){
    header('location: ../');
}
include "../conexion.php";
    if(!empty($_POST)){
        $alert='';
        if(empty($_POST['nombre']) || empty($_POST['estatus']) ){
            $alert='<p class="msg_error">El nombre y el estatus no pueden quedar vacios!!!</p>';
        }else{
            
            $idestudio=$_POST['idestudio'];
            $nombre = $_POST['nombre'];
            $obs= $_POST['obs'];
            $estatus= $_POST['estatus'];
            

                $sql_update = mysqli_query($conexion, "UPDATE estudios SET nombre_estudio= '$nombre', observaciones='$obs',
                                            estatus='$estatus'
                                            WHERE id_estudio=$idestudio");

               if($sql_update){
                    $alert='<p class="msg_save">Estudio Actualizado Correctamente</p>';
                }else{
                    $alert='<p class="msg_error">Error al Actualizar el Estudio</p>';
                }       
            }
        }
    

//MOSTRAR DATOS

if (empty($_GET['id'])){
    header('location administrador.php');
}
$idestudios= $_GET['id'];

$sql=mysqli_query($conexion, "SELECT en.id_estudio, en.nombre_estudio, en.observaciones, est.nombre_estatus, est.id as 'idestatus'
FROM estudios en INNER JOIN estatus est on en.estatus = est.id WHERE en.id_estudio=$idestudios");

$result_sql=mysqli_num_rows($sql);

if ($result_sql==0){
    header('location administrador.php');
}else{
    while($data= mysqli_fetch_array($sql)){
        $idestudio= $data['id_estudio'];
        $nombre= $data['nombre_estudio'];
        $obs=$data['observaciones'];
        $nomestatus=$data['nombre_estatus'];
        $idestatus=$data['idestatus'];
       
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<?php include "includes/scripts.php"?>
    <title>ACTUALIZACION ESTUDIOS</title>
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
    <a href="lista_empleados.php" class="btn_new" style="position:fixed ; top:150px; left: 0;">Lista Empleados</a>
    <a href="lista_entidades.php" class="btn_new" style="position:fixed ; top:200px; left: 0;">Lista Entidades</a>
    <a href="lista_estudios.php" class="btn_new" style="position:fixed ; top:250px; left: 0;">Lista Estudios</a>
    <a href="eliminar_citas.php" class="btn_new" style="position:fixed ; top:300px; left: 0;">Eliminar Citas</a>
    <a href="menu.php" class="btn_new" style="position:fixed ; top:350px; left: 0;">Editar Menú</a>
 
        

        <form action="" method="post">
       <h1>Actualización de Estudios</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>
        <div>
            <input type="hidden" name="idestudio" id="idestudio" value="<?php echo $idestudio;?>">
            <label for="nombre">Nombre Entidad</label>
            <input type="text" name="nombre" id="nombre" placeholder="Ingrese Nombre y Apellido" autocomplete="off" value="<?php echo $nombre;?>">
        </div>
        <div>
            <label for="obs">Observaciones</label>
            <textarea name="obs" id="obs" cols="30" rows="5" value=""><?php echo $obs;?></textarea>
        </div>
        
        <div>
            <label for="estatus">Estatus</label>
            <?php
            $query_estatus =mysqli_query($conexion,"SELECT * FROM estatus ");
            $result_estatus = mysqli_num_rows($query_estatus);
            
            ?>
          <select name="estatus" id="estatus" class="itemunico">
              <?php echo "  <option value=\"".$idestatus."\">".$nomestatus."</option>";?>
          <option value="0" disabled >Seleccione una Opcion</option>  
            <?php 
           
            if ($result_estatus>0){
                while($estatus =mysqli_fetch_array($query_estatus)){
                    
                  echo "  <option value=\"".$estatus['id']."\">".$estatus['nombre_estatus']."</option>";
            }
            } ?>
          
           
          </select>
        </div>
        <input type="submit" value="Editar Entidad" class="btn-save">

        </form>


    </div>


</section>
	
</body>
</html>