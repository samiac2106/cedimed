<?php
session_start();

include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
    <?php include "includes/scripts.php"?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

	<title>LISTA DE EMPLEADOS</title>
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
        <h1>Lista de Paciente</h1>
        <a href="registro_cliente.php" class="btn_new">Crear Paciente</a>
        <br><br>
        <table id="tablapaciente" class="display" style="width:100%">
         <thead>   
             <tr>
                <th>Nro Paciente</th>
                <th>Fecha Ingreso</th>
                <th>Tipo Doc</th>
                <th>Identificación</th>
                <th>Nombre</th>
                <th>Sexo</th>
                <th>Teléfono</th>
                <th>Entidad</th>
                <th>Ingresado Por</th>
                <th>Ultima Actualización</th>
                <th>Actualizado Por</th>
                <th>.</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query= mysqli_query($conexion, "SELECT cl.idcliente, tp.tipo as 'tipodoc', 
            cl.fecha_ingreso, cl.num_identificacion,cl.nombre, cl.sexo, cl.telefono, 
            en.nombre as 'entidad', us.usuario as 'usuario', usa.nombre as 'usuarioact', 
            cl.fecha_actualizacion
            FROM cliente cl
            INNER JOIN entidad en
            ON cl.entidad=en.id
            INNER JOIN usuario us
            ON cl.usuario=us.idusuario
            INNER JOIN tipo_documento tp
            ON cl.tipo_doc=tp.num
            INNER JOIN usuario usa
            ON cl.usuario_actualizacion=usa.idusuario
            ");
            
            $result=mysqli_num_rows($query);
            
            

            if ($result>0){
                while($data=mysqli_fetch_array($query)){
                    echo "
                    <tr>
                    <td>".$data['idcliente']."</td>
                    <td>".$data['fecha_ingreso']."</td>
                    <td>".$data['tipodoc']."</td>
                    <td>".$data['num_identificacion']."</td>
                    <td>".$data['nombre']."</td>
                    <td>".$data['sexo']."</td>
                    <td>".$data['telefono']."</td>
                    <td>".$data['entidad']."</td>
                    <td>".$data['usuario']."</td>
                    <td>".$data['fecha_actualizacion']."</td>
                    <td>".$data['usuarioact']."</td>
                    <td><div>
                    <a class=\"link_edit\"href=\"editar_cliente.php?id=".$data['idcliente']."\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span></a>
                    </div></td>
                    </tr>
                    ";
                }
            }
            ?>
         </tbody>   
          

        </table>
    </section>
    <script>
         $('#tablapaciente').DataTable({
        "order": [[ 4, "asc" ]],
        "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
   })
    </script>

<?php include "includes/footer.php"?>    
</body>

</html>