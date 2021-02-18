<?php

include("conexion.php");
include("../conexion.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/scripts.php"?>
    <title>GRAFICOS CONTINGENCIA</title>
    <link rel="shortcut icon" href="../img/cedimed-icono.png" type="image/x-icon">
</head>

<body>
<?php 
if (empty($_SESSION['active'])){
    header('location: ../');
  }
 include "includes/header.php"; 
 ?>
   
    <div class="container" id="container">
        <div class="graficos">
        </div>
        <div class="form-group ">
            <label for="modalidad">Modalidad </label>
            <select name="modalidad" id="modalidad" name="modalidad" class="form-control select2">
                <option disabled selected value="">Seleccione Una Opción</option>
                <?php
                $conectar = new Conexion();
                $consultaSQL = "SELECT * FROM modalidad";
                $modalidades = $conectar->consultarDatos($consultaSQL);
                foreach ($modalidades as $modalidad) :
                ?>
                    <option value="<?php echo ($modalidad['id_modalidad']) ?>"><?php echo ($modalidad['nombre_mod']) ?></option>

                <?php endforeach;  ?>
            </select>
        </div>
        <div class="graficoSelect"></div>
        <div class="tablaContingencia"></div>
    </div>


    <?php include "includes/footer.php"?>

    <script>
        $(document).ready(function() {
            $('.graficos').load('graficos/barChartGeneral.php');

            $('#modalidad').change(function(data) {
                var idModalidad="id="+$('#modalidad').val();
                
                $.ajax({
                    type: "POST",
                    url: "php/consultarModalidad.php",
                    data:idModalidad,
                    success: function(data) {
                        console.log(data);
                        $('.graficoSelect').html(data);
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "php/consultaTablaModalidad.php",
                    data:idModalidad,
                    success: function(data) {
                        console.log(data);
                        $('.tablaContingencia').html(data);
                    }
                });
            })
        });
    </script>
</body>

</html>