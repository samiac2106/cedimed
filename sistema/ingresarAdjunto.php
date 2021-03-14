
<?php
session_start();
include("../db/Conexion.php");


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
                <div class="tablaImagen"></div>
            </div>
        </div>
    </div>

    <?php include("includes/scriptsDown.php") ?>
    <!-- Modal Registrar Paciente-->
    <div class="modal fade" id="registrarOrden" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Registrar Orden Médica</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="ingresarAdjunto.php"id="ingresarOrden" enctype="multipart/form-data" method="POST">
                        <div class="form-group col-12">
                            <label for="imgProducto">Adjuntar Archivo</label>
                            <input type="file" class="form-control" name="imgProducto" id="imgProducto" accept="image/png, .jpeg, .jpg, image/gif, .pdf">
                        </div>
                        <div class="form-group col-12">
                            <label for="pregunta">Pregunta</label>
                            <textarea class="form-control" name="pregunta" id="pregunta" rows="3"></textarea>
                        </div>
                        <hr>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-dark" >Guardar</button>
                    </form>
                </div>
               
            </div>
        </div>
    </div>



    <?php



$pregunta = $_POST['pregunta'];
$usuario = $_SESSION['iduser'];
$ruta = "../../imagenesCitas/";
$url_img =  basename($_FILES['imgProducto']['name']);


if (move_uploaded_file($_FILES['imgProducto']['tmp_name'], $ruta . $url_img)) {
    $conexion = new Conexion();
    $consultaSQL = ("INSERT INTO imgcitas(ruta,img, pregunta, usuario)
                     VALUES ('$ruta','$url_img','$pregunta',$usuario)");
    $ejecutar = $conexion->agregarDatos($consultaSQL);
}

    echo ("<script>
    Swal.fire({
        position: 'top-end',
        html: '<img src=\"../img/icono-cedimed.png\" ><br>',
        title: 'Orden Médica Guardada!!!!',
        showConfirmButton: false,
        timer: 2000
      }).then((result) => {
        window.location=\"listaImagenesCitas.php\";
    } )
    </script>");
    

?>
    <script>
        $(document).ready(function() {
            $('.tablaImagen').load('tablas/tablaImagenCita.php');

            $("#imgProducto").change(function() {
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg", "application/pdf"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]) || (imagefile == match[3]))) {
                    Swal.fire({
                        position: 'center',
                        html: '<img src="../img/icono-cedimed.png" ><br>',
                        title: 'Por favor inserta un formato válido (JPEG/JPG/PNG/PDF)',

                    });

                    $("#imgProducto").val('');
                    return false;
                }
            });
        })
    </script>
    <script>
        $('.select2').select2({
            width: 450,
        });
    </script>
</body>

</html>