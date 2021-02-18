<?php 
require_once 'conexion.php';

function getListasRep(){
  $mysqli = conectmysql();
  $query = 'SELECT * FROM entidad where estatus=1 order by nombre ASC';
  $result = $mysqli->query($query);
 $listas = '<option value="0" disabled selected>Elige una opción</option>'; 
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $listas .= "<option value='$row[id]'>$row[nombre]</option>";
  }
  return $listas;
}

echo getListasRep();

?>
