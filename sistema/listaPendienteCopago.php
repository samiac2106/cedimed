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
          <form id="formEditarPaciente">
            <div class="row">
              <div class="form- col-3">
                <label for="tipo">Tipo </label>
                <input type="hidden" name="nro_cita" class="nro_cita">
                <select name="tipo" class="custom-select tipo" id="tipo">                 
                  <?php
                  $consultaSQL = "SELECT * FROM tipo_documento ORDER BY tipo";
                  $tipos = $conectar->consultarDatos($consultaSQL);
                  foreach ($tipos as $tipo) :
                  ?>
                    <option value="<?php echo ($tipo['num']) ?>"><?php echo ($tipo['tipo']) ?></option>
                  <?php endforeach ?>
                </select>

              </div>
              <div class="form-group col-9">
                <label for="documento">Nro de documento</label>
                <input type="number" class="form-control documento" id="documento" name="documento">
              </div>
            </div>

            <div class="form-group">
              <label for="nombres">Nombres y Apellidos</label>
              <input type="text" class="form-control nombres" id="nombres" name="nombres">
            </div>
            <div class="form-group">
              <label for="telefonos">Teléfonos</label>
              <input type="text" class="form-control telefonos" id="telefonos" name="telefonos">
            </div>
            <div class="form-group">
              <label for="estudio">Estudio</label>
              <input list="listaEstudio" name="estudio" id="estudio" class="form-control estudio">
              <datalist id="listaEstudio">
   
              <?php
                $consultaSQL = "SELECT * FROM estudios order by nombre_estudio ASC";
                $estudios = $conectar->consultarDatos($consultaSQL);
                foreach ($estudios as $estudio) :
                ?>
                  <option value="<?php echo ($estudio['nombre_estudio']) ?>"></option>
                <?php endforeach ?>
                 </datalist>
                        </div>

            <div class="form-group">
              <label for="entidad">Entidad</label>
              <input list="listaEntidad" name="entidad" id="entidad" class="form-control entidad"> 
              <datalist id="listaEntidad">                
              <?php
                $consultaSQL = "SELECT * FROM entidad order by nombre ASC";
                $entidades = $conectar->consultarDatos($consultaSQL);
                foreach ($entidades as $entidad) :
                ?>
                  <option value="<?php echo ($entidad['nombre']) ?>"> </option>
                <?php endforeach ?>
                </datalist>
            </div>

            <div class="form-group">
              <label for="vigencia">Vigencia Orden Medica</label>
              <input type="text" class="form-control vigencia"  id="vigencia" name="vigencia">
            </div>
            <div class="form-group">
              <label for="arl">ARL: Codigo - Nombre del médico y fecha de la orden </label>
              <input type="text" class="form-control arl"  id="arl" name="arl">
            </div>
            <div class="form-group">
              <label for="fecha">Fecha de la cita</label>
              <input type="date" class="form-control fecha" id="fecha"  name="fecha">
            </div>
            <div class="form-group">
              <label for="observaciones">Observaciones</label>
              <textarea name="observaciones" class="form-control observaciones" id="observaciones" name="observaciones"></textarea>

            </div>

            <div class="form-group">
              <label for="estado">Estado Cita</label>
             <select name="estado" id="estado" class="form-control estado">
             <option selected value="1">Pendiente</option>
             <option value="2">Gestionado</option>
             <option value="3">Cancelado</option>
             </select>
             
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-dark" onclick="editarPaciente()">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('.tablaPendiente').load('tablas/tablaPendienteCopago.php');
    })
  </script>
  <script>
    $('.select2').select2({
      width: 450,
    });
  </script>
</body>

</html>