<?php
session_start();
if($_SESSION['idrol']!=1){
    header('location: ../');
}
include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <?php include "includes/scripts.php"?>

    <title>ADMINISTRADOR</title>
    <link rel="shortcut icon" href="../img/cedimed-icono.png" type="image/x-icon">
    <style>

    </style>
</head>

<body>
    <?php 

if (empty($_SESSION['active'])){
  header('location: ../');
}
include "includes/header.php"?>
    <section id="container">

        <a href="lista_empleados.php" class="btn_new" style="position:fixed ; top:150px; left: 0;">Lista Empleados</a>
        <a href="lista_entidades.php" class="btn_new" style="position:fixed ; top:200px; left: 0;">Lista Entidades</a>
        <a href="lista_estudios.php" class="btn_new" style="position:fixed ; top:250px; left: 0;">Lista Estudios</a>
        <a href="eliminar_citas.php" class="btn_new" style="position:fixed ; top:300px; left: 0;">Eliminar Citas</a>
        <a href="menu.php" class="btn_new" style="position:fixed ; top:350px; left: 0;">Editar Menú</a>



        <!-- cargar la informacion por medio de la clase -->
        <center>
            <div style="width:950px">
                <h1>Entidades </h1><a href="" class="btn btn-info" data-toggle="modal" data-target="#ingresarEntidad">Ingresar Entidad</a>
                <div class="tablaEntidad"></div>

            </div>
        </center>



    </section>


    <!-- modales -->
    <!-- Modal editar Entidad -->
    <div class="modal fade" id="editarEntidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center mx-auto">
                        <h2>Editar Entidad</h2>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formEditarEntidad">
                        <input type="hidden" name="idEntidad" class="idEntidad">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" class="nombre form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="obs">Observaciones:</label>
                            <input type="text" name="obs" class="obs form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <?php
            $query_estatus =mysqli_query($conexion,"SELECT * FROM estatus ");
            
           ?>
                            <label for="estado">estado:</label>
                            <select name="estado" class="estado custom-select">
                                <?Php while($estatus =mysqli_fetch_array($query_estatus)):?>
                                <option value="<?php echo($estatus['id'])?>"><?php echo($estatus['nombre_estatus'])?>
                                </option>
                                <?Php endwhile?>
                            </select>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editarEntidad()" data-dismiss="modal">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Ingresar Entidad -->
    <div class="modal fade" id="ingresarEntidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center mx-auto">
                        <h2>Ingresar Entidad</h2>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formIngresarEntidad">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" class="nombre form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="obs">Observaciones:</label>
                            <input type="text" name="obs" class="obs form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <?php
            $query_estatus =mysqli_query($conexion,"SELECT * FROM estatus ");
            
           ?>
                            <label for="estado">estado:</label>
                            <select name="estado" class="estado custom-select">
                            <option value="" disabled selected>Selecciona un estado</option>
                                <?Php while($estatus =mysqli_fetch_array($query_estatus)):?>
                                <option value="<?php echo($estatus['id'])?>"><?php echo($estatus['nombre_estatus'])?>
                                </option>
                                <?Php endwhile?>
                            </select>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="ingresarEntidad()" data-dismiss="modal">Ingresar Entidad</button>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
    $(document).ready(function() {
        /* llamar tabla entidad */
        $('.tablaEntidad').load('tablas/tablaEntidades.php')

        $('.fecha').val();



        $('.fecha').change(function() {
            cargarrangofecha();


        });

    })
    </script>


    <script type="text/javascript">
    function cargarrangofecha() {
        $.ajax({
            type: "POST",
            url: "php/cargar_rangofechas.php",
            data: "fecha=" + $('.fecha').val(),
            success: function(r) {
                $('#citassaeliminar').html(r);

            }
        });

    }
    </script>
    <!-- ************************************* -->
    <script>
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

    <script>
    $('#tablausuario,#tablaentidades,#tablaestudios').DataTable({
        "order": [
            [1, "asc"]
        ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
    })
    </script>

    <?php include "includes/footer.php"?>

</body>

</html>