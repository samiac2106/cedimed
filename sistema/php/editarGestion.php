<?php
session_start();
include("../../db/Conexion.php");
$conectar= new Conexion();

$num_cita=$_POST ['nro_cita'];
$observaciones=$_POST['observaciones_pendiente'];
$usuario=$_SESSION['iduser'];


/* Editar datos del paciente */
$consultaSQL="UPDATE cita SET observaciones_pendiente='$observaciones', usuario_actualizacion='$usuario', fecha_actualizacion=current_timestamp() WHERE nro_cita='$num_cita'";
  $editar=$conectar->editarDatos($consultaSQL);

  echo json_encode($editar) ;