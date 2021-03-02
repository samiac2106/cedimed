<?php 
session_start();

if(!empty($_SESSION['active'])){
    header('location: sistema/');
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

  <title> Cedimed </title>
  <link rel="shortcut icon" href="img/icono-cedimed.png" />
  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
  
  <!-- SweetAlert -->
  <link href="vendors/sweetalert2/sweetalert2.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form method="POST" id="formLogin">
            <h1>Inicio sesión</h1>
            <div>
              <input type="text" class="form-control" placeholder="Usuario"  id="usuario" name="usuario" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Contraseña" id="contraseña"name="contraseña" />
            </div>
            <div>
              <button type="submit" name="submit" id="submit" class="btn btn-dark submit">Ingresar</button>
             
            </div>

            <div class="separator">
             
              <div>
                <h1><img src="img/icono-cedimed.png" alt="icono_cedimed"></i> Cedimed</h1>
                <p>©<?php echo(date('Y'))?> Todos los derechos reservados. </p>
                <div class="sb-sidenav-footer">
                <div class="small">Creado Por:</div>
                William Reyes y Sandra Acevedo
            </div>
              </div>
            </div>
          </form>
        </section>
      </div>

    </div>
  </div>
  <script src="vendors/jquery/dist/jquery.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.js"></script>
  <script src="vendors/jquery/dist/popper.min.js"></script>
<script src="vendors/sweetalert2/sweetalert2.js"></script>
<script src="scripts.js"></script>
</body>

</html>