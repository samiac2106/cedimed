<?php
session_start();
include("../../db/Conexion.php");
$conectar= new Conexion();

$num_cita=$_POST ['nro_cita'];
$codigo=$_POST ['codigo'];
$valor_copago=$_POST['copago'];
$observaciones=$_POST['observaciones'];
$estado=$_POST['estado'];
$usuario=$_SESSION['iduser'];

/* Editar datos del paciente */
$consultaSQL="UPDATE admisiones SET cod_autorizacion='$codigo', valor_copago='$valor_copago', observaciones='$observaciones', estado='$estado', usuario_admisiones='$usuario', fecha=current_timestamp() WHERE num_cita='$num_cita'";
  $editar=$conectar->editarDatos($consultaSQL);

  echo json_encode($editar) ;