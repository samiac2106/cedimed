


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

	<title>INSTRUCTIVO</title>
	<link rel="shortcut icon" href="../img/cedimed-icono.png" type="image/x-icon">
	<style>
		
	</style>
</head>
<body>
<?php
include "includes/header.php"
?>
<section id="container">
<div class="instructivo">
           
           <?php
           $query =mysqli_query($conexion,"SELECT * FROM instructivo order by nombre_estudio asc");
           $result = mysqli_num_rows($query);
           
           ?>
           <label>Buscar:   
         <input list="buscar" name="buscar" class="buscar"/></label>
         <datalist name="buscar"id="buscar">
           <?php 
           if ($result>0){
               while($buscar =mysqli_fetch_array($query)){
                   
                 echo "  <option value=\"".$buscar['nombre_estudio']."\">";
           }
           } ?>
         
         </datalist>
</div>    

    <div id="resultado"></div>

    </section>
    <script type="text/javascript">
	$(document).ready(function(){
		$('.buscar').val();
		
		

		$('.buscar').change(function(){
			cargarinstructivo();
            $('.buscar').val('');
			
		});
	
	})
</script>


<script type="text/javascript">
	function cargarinstructivo(){
		$.ajax({
			type:"POST",
			url:"php/cargar_instructivo.php",
			data:"buscar=" + $('.buscar').val(),
			success:function(r){
				$('#resultado').html(r);
				
			}
		});
		
	}
</script>
    
</body>
</html>




  
