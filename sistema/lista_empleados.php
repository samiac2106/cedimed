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


        <center>
            <div style="width:950px">
                <h1>Lista de empleados </h1><a href="" class="btn btn-info" data-toggle="modal"
                    data-target="#ingresarEmpleado">
                    Ingresar Empleado</a>
                <div class="tablaUsuario"></div>

            </div>
        </center>

    </section>

    <!-- modales -->
    <!-- Modal editar Entidad -->
    <div class="modal fade" id="editarEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center mx-auto">
                        <h2>Editar Empleado</h2>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formEditarEmpleado">
                        <input type="hidden" name="idusuario" class="idusuario">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" class="nombre form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <input type="text" name="sexo" class="sexo form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario" class="usuario form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="clave">Clave:</label>
                            <input type="text" name="clave" class="clave form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <?php
            $query_estatus =mysqli_query($conexion,"SELECT * FROM rol ");
            
           ?>
                            <label for="rol">Cargo:</label>
                            <select name="rol" class="rol custom-select">
                                <?Php while($estatus =mysqli_fetch_array($query_estatus)):?>
                                <option value="<?php echo($estatus['idrol'])?>"><?php echo($estatus['rol'])?>
                                </option>
                                <?Php endwhile?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="cedula">Cedula:</label>
                            <input type="text" name="cedula" class="cedula form-control" autocomplete="off">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editarEmpleado()"
                        data-dismiss="modal">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Ingresar empleado -->
    <div class="modal fade" id="ingresarEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center mx-auto">
                        <h2>Ingresar Empleado</h2>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formIngresarEmpleado">
                    <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" class="nombre form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <input type="text" name="sexo" class="sexo form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario" class="usuario form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="clave">Clave:</label>
                            <input type="text" name="clave" class="clave form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <?php
            $query_estatus =mysqli_query($conexion,"SELECT * FROM rol ");
            
           ?>
                            <label for="rol">Cargo:</label>
                            <select name="rol" class="rol custom-select">
                                <?Php while($estatus =mysqli_fetch_array($query_estatus)):?>
                                <option value="<?php echo($estatus['idrol'])?>"><?php echo($estatus['rol'])?>
                                </option>
                                <?Php endwhile?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="cedula">Cedula:</label>
                            <input type="text" name="cedula" class="cedula form-control" autocomplete="off">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="ingresarEmpleado()"
                        data-dismiss="modal">Ingresar Empleado</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
    $(document).ready(function() {
        /* llamar la tabla empleados  */
        $('.tablaUsuario').load('tablas/tablaEmpleados.php')
       
    })
    </script>



    <?php include "includes/footer.php"?>

</body>

</html>