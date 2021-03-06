<?php
$documento=$_POST['documento'];
$nombres=$_POST['nombre'];
$apellidos=$_POST['apellido'];
$telefonos=$_POST['telefono'];
$entidad=$_POST['entidad'];
$modalidad=$_POST['modalidad'];
$estudio=$_POST['estudio'];
$observaciones=$_POST['observaciones'];
$estado=$_POST['estado'];
$id_consulta=$_POST['idConsulta'];

include ("../conexion.php");

$conexion= new ConexionContingencia();

$consultaSQL=("UPDATE pacientes_modalidad SET documento='$documento', nombres='$nombres', apellidos='$apellidos', 
telefonos='$telefonos',entidad='$entidad', estudio='$estudio', modalidad='$modalidad', observaciones='$observaciones',
 estado='$estado'
WHERE id_consulta='$id_consulta'");

$ejecutar=$conexion->editarDatos($consultaSQL);
echo $ejecutar;

