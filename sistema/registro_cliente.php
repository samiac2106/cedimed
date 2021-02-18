<?php
session_start();

include "../conexion.php";
    if(!empty($_POST)){
        $alert='';
        
        if(empty($_POST['tipodoc']) || empty($_POST['nombrecliente']) || empty($_POST['idcliente'])
        || empty($_POST['sexo'])  || empty($_POST['idcliente']) || empty($_POST['entidad'])){
            $alert='<p class="msg_error">Todos los campos son obligatorios</p>';
            
        }else{
            $tipodoc= $_POST['tipodoc'];
            $nombre = $_POST['nombrecliente'];
            $idcliente= $_POST['idcliente'];
            $sexo=$_POST['sexo'];
            $telefono= $_POST['telefono'];
            $entidad= $_POST['entidad'];
            $usuario_id=$_SESSION['iduser'];
                

            
            $query =mysqli_query($conexion,"SELECT * FROM cliente WHERE num_identificacion='$idcliente'");
            $result =mysqli_fetch_array($query);

            if ($result>0){
                $alert='<p class="msg_error">El Número de documento ya existe!!!</p>';
            }else{
                $query_insert = mysqli_query($conexion,"INSERT INTO cliente(tipo_doc,num_identificacion,nombre,sexo,telefono,entidad,usuario,usuario_actualizacion)
                                                            value($tipodoc,$idcliente,'$nombre','$sexo','$telefono',$entidad,$usuario_id,$usuario_id)");
                if($query_insert){
                    $alert='<p class="msg_save">Usuario Creado Correctamente</p>';
                }else{
                    $alert='<p class="msg_error">Error al crear el usuario</p>';
                }       
            }
        }
    }



?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<?php include "includes/scripts.php"?>
    <title>REGISTRO PACIENTES</title>
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
       <h1>Registro de Pacientes</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>
        <div>
            <label for="tipodoc">Tipo Documento (*)</label>
            <?php
            $query_tipodoc =mysqli_query($conexion,"SELECT * FROM tipo_documento order by tipo asc");
            $result_tipodoc= mysqli_num_rows($query_tipodoc);
            
            ?>
          <select name="tipodoc" id="tipodoc" class="" >
          <option value="0" disabled <?php if(empty($tipodoc)){echo "selected";} ?> value="<?php if(isset($tipodoc)) echo $tipodoc ?>">Seleccione una Opción</option>  
            <?php 
            if ($result_tipodoc>0){
                while($tipodoc =mysqli_fetch_array($query_tipodoc)){
                    
                  echo "  <option value=\"".$tipodoc['num']."\">".$tipodoc['tipo']."-".$tipodoc['nombre']."</option>";
            }
            } ?>
          
           
          </select>
        </div>
        <div>
            <label for="idcliente">Identificación (*)</label>
            <input value="<?php if (isset($idcliente)) echo $idcliente ?>" type="text" name="idcliente" id="idcliente" placeholder="Ingrese N° Identificación" autocomplete="off">
        </div>
        <div>
            <label for="nombrecliente">Nombre (*)</label>
            <input value="<?php if (isset($nombre)) echo $nombre ?> "type="text" name="nombrecliente" id="nombrecliente" placeholder="Ingrese el Nombre del Cliente" autocomplete="off">
        </div>
        <div>
          <label for="sexo">Sexo (*)</label>
          <select name="sexo" id="sexo">
           <option value="0" disabled selected>Seleccione una Opción</option>
            <option value="hombre">Hombre</option>  
          <option value="mujer">Mujer</option>  
          </select>
        </div>
        <div>
            <label for="telefono">Telefono (*)</label>
            <input type="text" name="telefono" id="telefono" placeholder="Ingrese los números de contactos" autocomplete="off">
        </div>
        <div>
            <label for="entidad">Entidad (*)</label>
            <?php
            $query_entidad =mysqli_query($conexion,"SELECT * FROM entidad order by nombre asc");
            $result_entidad= mysqli_num_rows($query_entidad);
            
            ?>
          <select name="entidad" id="entidad" class="select2">
          <option value="0" disabled selected>Seleccione una Opción</option> 
            <?php 
            if ($result_entidad>0){
                while($entidad =mysqli_fetch_array($query_entidad)){
                    
                  echo "  <option value=\"".$entidad['id']."\">".$entidad['nombre']."</option>";
            }
            } ?>
          
           
          </select>
        </div>
        
        <input type="submit" value="Crear Cliente" class="btn-save">

        </form>


    </div>


</section>
    
<script>
$('.select2').select2({
    containerCssClass: "wrap"
});
</script>
</body>
</html>