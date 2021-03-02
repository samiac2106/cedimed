<?php
session_start();
include("../../db/Conexion.php");
$conectar= new Conexion();

$num_cita=$_POST ['nro_cita'];
$tipo=$_POST ['tipo'];
$documento=$_POST['documento'];
$nombre=$_POST['nombres'];
$telefono=$_POST['telefonos'];
$estudio=$_POST['estudio'];
$entidad=$_POST['entidad'];
$vigencia=$_POST['vigencia'];
$arl=$_POST['arl'];
$fecha=$_POST['fecha'];
$observaciones=$_POST['observaciones'];
$estado=$_POST['estado'];

/* traer  id del estudio seleccionado */
$consultaSQL="SELECT * FROM estudios WHERE nombre_estudio='$estudio'";
$result=$conectar->consultarDatos($consultaSQL);
$estudio=$result[0]['id_estudio'];

/*traer el id de la entidad seleccionada */
$consultaSQL="SELECT * FROM entidad WHERE nombre='$entidad'";
$result=$conectar->consultarDatos($consultaSQL);
$entidad=$result[0]['id'];

/* Editar datos del paciente */
$consultaSQL="UPDATE cita SET identificacion='$documento', tipo_doc='$tipo', nombre='$nombre', telefono='$telefono', 
entidad='$entidad', vigencia_orden='$vigencia', fecha_cita='$fecha', estadocita='$estado', observaciones='$observaciones', estudio='$estudio', 
arl_codigo='$arl', fecha_actualizacion=current_timestamp() WHERE nro_cita='$num_cita'";
  $editar=$conectar->editarDatos($consultaSQL);

 

  echo json_encode($editar) ;