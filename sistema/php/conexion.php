<?php 
function conectmysql(){
  $conexionn = mysqli_connect('localhost', 'root', '', 'cita_cedimed');
  if (mysqli_connect_error($conexionn))
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();

  return $conexionn;

}

?>
