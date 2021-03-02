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
        <div class="tablaPendiente"></div>
      </div>
    </div>
  </div>

  <?php include("includes/scriptsDown.php") ?>


  <!-- Modal Editar Paciente -->
  <div class="modal fade" id="editarPaciente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Paciente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEditarAdmisiones">
          
           <input hidden="text" class="form-control nro_cita" id="nro_cita" name="nro_cita">
            
            <div class="form-group ">
              <label for="codigo">Codigo Autorizacion</label>
              <input type="text" class="form-control codigo" id="codigo" name="codigo">
            </div>

            <div class="form-group">
              <label for="copago">Valor Copago</label>
              <input type="text" class="form-control copago" id="copago" name="copago">
            </div>

            <div class="form-group">
              <label for="observaciones">Observaciones</label>
              <textarea name="observaciones" class="form-control observaciones" id="observaciones" name="observaciones"></textarea>
            </div>

            <div class="form-group">
              <label for="estado">Estado Cita</label>
              <select name="estado" id="estado" class="form-control estado">
                <option value="1">Pendiente</option>
                <option value="2">Gestionado</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-dark" onclick="editarAdmisiones()">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('.tablaPendiente').load('tablas/tablaPendienteAdmisiones.php');
    })
  </script>
  <script>
    $('.select2').select2({
      width: 450,
    });
  </script>
</body>

</html>