<?php
session_start();
include "../db/Conexion.php";
$conectar = new Conexion();

if (empty($_SESSION['active'])) {
  header('location: ../');
}
$usuario = $_SESSION['iduser'];
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
  <?php include "includes/scriptsUp.php" ?>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include "includes/navBar.php" ?>
      <!-- page content -->
      <div class="right_col" role="main">
        <center>
          <h1 class="mb-5"><?php if ($_SESSION['sexo'] == 'hombre') {
                              echo "Bienvenido";
                            } else {
                              echo "Bienvenida";
                            } ?> al Sistema de Copagos Cedimed</h1>

          <!-- top tiles -->
          <hr>
          <div class=" tile_count mt-5 ">
            <div class="col-md-6 col-sm-4  tile_stats_count">
              <span class="count"></i>General Copago</span>
            </div>
            <div class="col-md-6 col-sm-4  tile_stats_count">
              <div class="count">General Admisiones</div>
            </div>
          </div>
          <div class="tile_count">
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"></i> Total Citas</span>
              <?php
              $consultaSQL = "SELECT count(nro_cita) as 'count' FROM cita WHERE estadocita<2";
              $result = $conectar->consultarDatos($consultaSQL);
              $totalCitas = $result[0]['count'];
              ?>
              <div class="count"><?php echo $totalCitas ?></div>

            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top">Total Espera</span>
              <?php
              $consultaSQL = "SELECT count(nro_cita) as 'count' FROM cita WHERE estadocita=0";
              $result = $conectar->consultarDatos($consultaSQL);
              $totalEspera = $result[0]['count'];
              ?>
              <div class="count"><?php echo $totalEspera ?></div>
              <span class="count_bottom font-italic"><?php echo round($totalEspera / $totalCitas * 100, 2) ?>%</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top">Total P.P</span>
              <?php
              $consultaSQL = "SELECT count(nro_cita) as 'count' FROM cita WHERE estadocita=1";
              $result = $conectar->consultarDatos($consultaSQL);
              $totalPendiente = $result[0]['count'];
              ?>
              <div class="count"><?php echo $totalPendiente ?></div>
              <span class="count_bottom font-italic"><?php echo round($totalPendiente / $totalCitas * 100, 2) ?>%</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top">Espera Adminsiones</span>
              <?php
              $consultaSQL = "SELECT count(ci.nro_cita) as 'count' FROM cita ci INNER JOIN admisiones ad 
                            ON ad.num_cita=ci.nro_cita WHERE ad.estado=0 AND ci.estadocita<2";
              $result = $conectar->consultarDatos($consultaSQL);
              $esperaAdminisiones = $result[0]['count'];
              ?>
              <div class="count"><?php echo $esperaAdminisiones ?></div>
              <span class="count_bottom font-italic"><?php echo round($esperaAdminisiones / $totalCitas * 100, 2) ?>%</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top">Pendiente Adminisiones</span>
              <?php
              $consultaSQL = "SELECT count(ci.nro_cita) as 'count' FROM cita ci INNER JOIN admisiones ad 
                            ON ad.num_cita=ci.nro_cita WHERE ad.estado=1 AND ci.estadocita<2";
              $result = $conectar->consultarDatos($consultaSQL);
              $pendienteAdminisiones = $result[0]['count'];
              ?>
              <div class="count"><?php echo $pendienteAdminisiones ?></div>
              <span class="count_bottom font-italic"><?php echo round($pendienteAdminisiones / $totalCitas * 100, 2) ?>%</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top">Gestionado Adminsiones</span>
              <?php
              $consultaSQL = "SELECT count(ci.nro_cita) as 'count' FROM cita ci INNER JOIN admisiones ad 
                            ON ad.num_cita=ci.nro_cita WHERE ad.estado=2 AND ci.estadocita<2";
              $result = $conectar->consultarDatos($consultaSQL);
              $gestionadoAdminisiones = $result[0]['count'];
              ?>
              <div class="count"><?php echo $gestionadoAdminisiones ?></div>
              <span class="count_bottom font-italic"><?php echo round($gestionadoAdminisiones / $totalCitas * 100, 2) ?>%</span>
            </div>
          </div>
          <div class=" tile_count mt-5 ">


<?php if($_SESSION['idrol']==2): 
  $consultaSQL = "SELECT count(nro_cita) as 'count' FROM cita WHERE usuario=$usuario";
  $result=$conectar->consultarDatos($consultaSQL);
  $cantUsuario=$result[0]['count'];
  if($cantUsuario>0):
  ?>
            <div class="col-md-12 col-sm-12  tile_stats_count">
              <div class="count ">Citas de <span class=" count text-lowercase"><?php echo $_SESSION['user']; ?></span></div>
            </div>
          </div>
          <div class="tile_count">
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"></i> Total Citas</span>
              <?php
              $consultaSQL = "SELECT count(nro_cita) as 'count' FROM cita WHERE estadocita<2 AND usuario='$usuario'";
              $result = $conectar->consultarDatos($consultaSQL);
              $citasUsuario = $result[0]['count'];
              ?>
              <div class="count"><?php echo $citasUsuario ?></div>
              <span class="count_bottom font-italic"><?php echo round($citasUsuario / $totalCitas * 100, 2) ?>%</span>
              <div><span class="count_bottom font-italic">Al Total de Citas</span></div>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top">Espera</span>
              <?php
              $consultaSQL = "SELECT count(nro_cita) as 'count' FROM cita WHERE estadocita=0 AND usuario='$usuario'";
              $result = $conectar->consultarDatos($consultaSQL);
              $esperaUsuario = $result[0]['count'];
              ?>
              <div class="count"><?php echo $esperaUsuario ?></div>
              <span class="count_bottom font-italic"><?php echo round($esperaUsuario / $citasUsuario * 100, 2) ?>%</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top">Pendiente Personal</span>
              <?php
              $consultaSQL = "SELECT count(nro_cita) as 'count' FROM cita WHERE estadocita=1 AND usuario='$usuario'";
              $result = $conectar->consultarDatos($consultaSQL);
              $pendienteUsuario = $result[0]['count'];
              ?>
              <div class="count"><?php echo $pendienteUsuario ?></div>
              <span class="count_bottom font-italic"><?php echo round($pendienteUsuario / $citasUsuario * 100, 2) ?>%</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top">Espera Adminsiones</span>
              <?php
              $consultaSQL = "SELECT count(ci.nro_cita) as 'count' FROM cita ci INNER JOIN admisiones ad 
                            ON ad.num_cita=ci.nro_cita WHERE ad.estado=0 AND ci.estadocita<2 AND usuario='$usuario'";
              $result = $conectar->consultarDatos($consultaSQL);
              $esperaAdminisiones = $result[0]['count'];
              ?>
              <div class="count"><?php echo $esperaAdminisiones ?></div>
              <span class="count_bottom font-italic"><?php echo round($esperaAdminisiones / $citasUsuario * 100, 2) ?>%</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top">Pendiente Adminisiones</span>
              <?php
              $consultaSQL = "SELECT count(ci.nro_cita) as 'count' FROM cita ci INNER JOIN admisiones ad 
                            ON ad.num_cita=ci.nro_cita WHERE ad.estado=1 AND ci.estadocita<2 AND usuario='$usuario'";
              $result = $conectar->consultarDatos($consultaSQL);
              $pendienteAdminisiones = $result[0]['count'];
              ?>
              <div class="count"><?php echo $pendienteAdminisiones ?></div>
              <span class="count_bottom font-italic"><?php echo round($pendienteAdminisiones / $citasUsuario * 100, 2) ?>%</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top">Gestionado Adminsiones</span>
              <?php
              $consultaSQL = "SELECT count(ci.nro_cita) as 'count' FROM cita ci INNER JOIN admisiones ad 
                            ON ad.num_cita=ci.nro_cita WHERE ad.estado=2 AND ci.estadocita<2 AND usuario='$usuario'";
              $result = $conectar->consultarDatos($consultaSQL);
              $gestionadoAdminisiones = $result[0]['count'];
              ?>
              <div class="count"><?php echo $gestionadoAdminisiones ?></div>
              <span class="count_bottom font-italic"><?php echo round($gestionadoAdminisiones / $citasUsuario * 100, 2) ?>%</span>
            </div>
          </div>
<?php endif?> 
<?php if(@$cantUsuario==0): ?>
  <div class="col-md-12 col-sm-12  tile_stats_count">
              <div class="count text-lowercase"><?php echo $_SESSION['user']?>, No posees citas por analizar</div>
            </div>
<?php endif ?>
<?php endif ?>
<?php if($_SESSION['idrol']==1):?>
<br><br><br><br><br><br><br><br><br><br><br>
<div class="barChartCopago"></div>
<?php endif?>
        </center>
      </div>
    </div>
  </div>
  <?php include "includes/scriptsDown.php" ?>
</body>
<script>
        $(document).ready(function() {
            $('.barChartCopago').load('graficos/barChartCopago.php');

        });
    </script>
</html>