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
        <div class="tablaGeneral"></div>
      </div>
    </div>
  </div>

  <!-- Modal Ver Estado Citas-->
  <div class="modal fade" id="modalCitas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Información del estado Copago</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-6">Nro Cita</div>
                          <div class="col-6 cita"></div>
                        </div>
                        <div class="row">
                          <div class="col-6">Estado Cita</div>
                          <div class="col-6 estado"></div>
                        </div>
                      
                        <div class="row">
                        <div class="col-6">Observaciones De Gestión</div>
                        <div class="col-6 observaciones"></div>
                        </div>
                       </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    
                      </div>
                    </div>
                  </div>
                </div>
  <?php include("includes/scriptsDown.php") ?>

 
  <script>
    $(document).ready(function() {
      $('.tablaGeneral').load('tablas/tablaGeneralAdmisiones.php');
    })
  </script>
  <script>
    $('.select2').select2({
      width: 450,
    });
  </script>
</body>

</html>