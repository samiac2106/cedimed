<?php 
function conectmysql(){
  $conexion = mysqli_connect('localhost', 'root', '', 'cita_cedimed');
 /*  if (mysqli_connect_error($conexion)){
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
  } */
    

  return $conexion;

}

?>
