<?php
    session_start();
    include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    
	<?php include "includes/scripts.php"?>
	<title>CONVENIO ENTIDADES</title>
	<link rel="shortcut icon" href="../img/cedimed-icono.png" type="image/x-icon">
	<style>
		
	</style>
</head>
<body>

<?php 
// session_start();
if (empty($_SESSION['active'])){
  header('location: ../');
}
include "includes/header.php"?>
	<section id="container">
  
  
  <div class="page-header text-left">
      <CENTer><h1>CONSULTA DE CONVENIO ENTIDADES </h1></CENTer>
    </div>
       
    <div >
      <div >
          <p><h3>LISTA DE ENTIDADES</h3> </p>
          <select id="entidades" name="entidades" class="select2">
          </select>

         
          <br>
      </div>
      <div>
        
        <div  id="resultado_estudios" ></div>
      
  
      </div>
      
    </div>
    <div >
      <div >
     
         <p id="resultado1" ></p>

        </div>
    </div>
  </div>
  </section>
  
  
  <script>
$('.select2').select2({
    containerCssClass: "wrap"
});
</script>


</body>
</html>




  
