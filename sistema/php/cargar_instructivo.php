
        
<?php 
include "../../conexion.php";
      

$nombre=$_POST['buscar'];

	$query=mysqli_query($conexion,"SELECT * FROM instructivo WHERE nombre_estudio='$nombre'");

    $result= mysqli_num_rows($query);

    if ($result>0){
	$descripcion = mysqli_fetch_array($query);
	
	 

    echo  $descripcion['descripcion'];
    }
    

?>

