<?php
session_start();
include("conexion.php");
include("../db/Conexion.php");
$conectar = new ConexionContingencia();

if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../img/icono-cedimed.png" />

    <title>GRAFICOS CONTINGENCIA | </title>
    <?php include("includes/scriptsUp.php") ?>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include("includes/navBar.php") ?>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="graficos mt-5"></div>
                <div class="form-group mt-5">
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
                <div class="graficoSelect mt-5"></div>
                <div class="tablaContingencia mt-5"></div>
            </div>
        </div>
    </div>

    <?php include("includes/scriptsDown.php") ?>

   


   
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