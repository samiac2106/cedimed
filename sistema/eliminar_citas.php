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


<center><div style="width:600px">

<?php
if(!empty($_POST)){
    $fecha = $_POST['fecha'];
    $query=mysqli_query($conexion,"SELECT count(nro_cita) FROM cita where fecha<='$fecha'");
    $data=mysqli_fetch_array($query);
    
    if($data['count(nro_cita)']>0){
        
        $query_delete=mysqli_query($conexion, "DELETE FROM cita WHERE fecha <='$fecha' ");
        $delete_admisiones=mysqli_query($conexion, "DELETE FROM admisiones WHERE fecha <='$fecha' ");
        $alert="<p class=\"msg_save\">Se ha eliminado ".$data['count(nro_cita)']." registros correctamente.</p>";
    }else{
        $alert='<p class="msg_error">No hay ningun registro por eliminar</p>';
    }
 
}

?>
        <!-- <a href="registro_usuario.php" class="btn_new">Crear Entidad</a> -->
        <br><br>
        <form action="" method="post" >
       <h1>Eliminar Citas en Base de Datos</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>
        <div><h3> Al eliminar estos registros de la base de datos, se perderá la información completamente 
            y no se podrán recuperar. </h3></div>
        <div>
            
            <h2><div for="fecha">Eliminar Citas hasta:</div>
            <input type="datetime-local" name="fecha" id="fecha" class="fecha"></h2>
            
        </div>
            <h4><div id="citassaeliminar"></div></h4>
        
        <input type="submit" value="Eliminar" class="btn-save">
        
        

        </form>
</div></center>


       
    </section>
    <script type="text/javascript">
	$(document).ready(function(){
		$('.fecha').val();
		
		

		$('.fecha').change(function(){
			cargarrangofecha();
			
			
		});
	
	})
</script>


<script type="text/javascript">
	function cargarrangofecha(){
		$.ajax({
			type:"POST",
			url:"php/cargar_rangofechas.php",
			data:"fecha=" + $('.fecha').val(),
			success:function(r){
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
        "order": [[ 1, "asc" ]],
        "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
   })
    </script>
   
     
    
</body>
</html>