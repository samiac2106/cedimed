<?php
session_start();

include "../conexion.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"?>
    <title>COPAGOS</title>

    <link rel="shortcut icon" href="../img/cedimed-icono.png" type="image/x-icon">
    <style>

    </style>
</head>

<body>

    <?php 

if (empty($_SESSION['active'])){
  header('location: ../');
}
 include "includes/header.php"; 
 ?>
    <section id="container">


        <h1 class="listaa">Copagos </h1>
        <a href="registro_citas.php" class="btn_new">Registrar Cita</a>
        <a href="" class="btn_new" style="left:200px" data-toggle="modal" data-target="#consultas">Consultas</a>

        <div class="tablaGeneral"></div>
    </section>
    <!-- modal para hacer consultas a admisiones -->
    <div class="modal fade" id="consultas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center mx-auto">
                        <h2>Consultas sobre entidades</h2>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formConsultas">

                        <div class="form-group">
                            <label for="obs">Observaciones:</label>
                            <textarea name="obs" cols="30" rows="10" class="obs form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="consultas()" data-dismiss="modal">Guardar
                        cambios</button>
                </div>
            </div>
        </div>
    </div>


    <script>
    $('.tablaGeneral').load('tablas/tablaCopago.php')

    function openCorte(atributo, menutab) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(menutab).style.display = "block";
        atributo.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();
    </script>

   
    
    <?php include "includes/footer.php"?>
</body>

</html>