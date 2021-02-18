<?php

include("conexion.php");
include("../conexion.php");
session_start();
//llamar la clase conexión
$conectar = new Conexion();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/scripts.php"?>
    <title>REGISTRO CONTINGENCIA</title>
    <link rel="shortcut icon" href="../img/cedimed-icono.png" type="image/x-icon">
</head>

<body>
<?php 
if (empty($_SESSION['active'])){
    header('location: ../');
  }
 include "includes/header.php"; 
 ?>
 <br><br>
    <div class="container" id="container">
   
        <form id="registrarContingencia" method="POST">
            <div class="form-group">
                <label for="documento">Documento </label>
                <input type="number" class="form-control" id="documento" name="documento">
            </div>
            <div class="form-group">
                <label for="nombre">Nombres </label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
         
            <div class="form-group">
                <label for="telefono">Teléfonos </label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>

            <div class="form-group">
                <label for="entidad">Entidad </label>
                <select name="entidad" id="entidad" name="entidad" class="form-control select2">
                    <option disabled selected value="">Seleccione Una Opción</option>
                    <?php
                    $consultaSQL = "SELECT * FROM entidad";
                    $entidades = $conectar->consultarDatos($consultaSQL);
                    foreach ($entidades as $entidad) :
                    ?>
                        <option value="<?php echo ($entidad['id_entidad']) ?>"><?php echo ($entidad['nombre_entidad']) ?></option>

                    <?php endforeach;  ?>
                </select>
            </div>

            <div class="form-group">
                <label for="modalidad">Modalidad </label>
                <select name="modalidad" id="modalidad" name="modalidad" class="form-control select2">
                    <option disabled selected value="">Seleccione Una Opción</option>
                    <?php
                    $consultaSQL = "SELECT * FROM modalidad";
                    $modalidades = $conectar->consultarDatos($consultaSQL);
                    foreach ($modalidades as $modalidad) :
                    ?>
                        <option value="<?php echo ($modalidad['id_modalidad']) ?>"><?php echo ($modalidad['nombre_mod']) ?></option>

                    <?php endforeach;  ?>
                </select>
            </div>

            <div class="form-group">
                <label for="estudio">Estudio </label>
                <select name="estudio" id="estudio" name="estudio" class="form-control select2">
                    <option disabled selected value="">Seleccione Una Opción</option>
                    <?php
                    $consultaSQL = "SELECT * FROM estudios";
                    $estudios = $conectar->consultarDatos($consultaSQL);
                    foreach ($estudios as $estudio) :
                    ?>
                        <option value="<?php echo ($estudio['id_estudio']) ?>"><?php echo ($estudio['nombre_estudio']) ?></option>

                    <?php endforeach;  ?>
                </select>
            </div>
   <div class="form-group">
                <label for="apellido">Parte del cuerpo </label>
                <input type="text" class="form-control" id="apellido" name="apellido">
            </div>
            <div class="form-group">
                <label for="asesor">Asesor </label>
                <select name="asesor" id="asesor" name="asesor" class="form-control select2">
                    <option disabled selected value="">Seleccione Una Opción</option>
                    <?php
                    $consultaSQL = "SELECT * FROM asesores";
                    $asesores = $conectar->consultarDatos($consultaSQL);
                    foreach ($asesores as $asesor) :
                    ?>
                        <option value="<?php echo ($asesor['id_asesor']) ?>"><?php echo ($asesor['nombre_asesor']) ?></option>

                    <?php endforeach;  ?>
                </select>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones </label>
                <textarea name="observaciones" class="form-control" id="observaciones" cols="30" rows="10"></textarea>
            </div>
            <button type="button" class="btn btn-primary" onclick="guardarContingencia()"> Guardar </button>
        </form>
    </div>



</body>

<?php include "includes/footer.php"?>
<script>
    $(document).ready(function() {
        $('.select2').select2();


    });

    
</script>

</html>