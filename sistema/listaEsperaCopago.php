<?php
session_start();
include("../db/Conexion.php");
$conectar = new Conexion();

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

  <title>INICIO | </title>
  <?php include("includes/scriptsUp.php") ?>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include("includes/navBar.php") ?>
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="tablaEspera"></div>
      </div>
    </div>
  </div>

  <?php include("includes/scriptsDown.php") ?>


  
  </div>
  <script>
    $(document).ready(function() {

      $('.tablaEspera').load('tablas/tablaEsperaCopago.php');
    })
  </script>
  <script>
    $('.select2').select2({
      width: 450,
    });
  </script>

</body>

</html>